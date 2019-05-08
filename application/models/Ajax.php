<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * This class handles all the methods used to obtain data for AJAX calls.
 */
class Ajax extends CI_Model {
    protected $user;
    protected $sessionData;

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function setUserData($userData) {
        $this->user = $userData;
    }

    public function getAuthorizationData() {
        return $this->sessionData;
    }

    protected function isLoggedIn() {
        return !empty($this->sessionData) && isset($this->sessionData['id']);
    }

    /**
     * Example of method which can be used. Each one has the same pattern.
     * It can use the body and url parameters.
     * It will receive only what's needed, due to the map of the AjaxMAP model.
     * @return $qBuilder
     */
    public function test() {
        return $this->db->select('*')
                        ->from('users')
                        ->order_by('id')
                        ->get()
                        ->result_array();
    }

    public function signin() {
        $q = $this->db->select('id')
                      ->from('users')
                      ->where([
                          'login' => $this->input->post('login'),
                          'password' => $this->input->post('password'),
                        ])
                      ->get()
                      ->row_array();

        if (empty($q)) return ['status' => false, 'error' => 'Mauvais identifiants.'];
        else {
            $this->sessionData = ['id' => $q['id']];
            return ['status' => true, 'id' => $q['id']];
        }
    }

    public function user() {
        if ($this->input->get('user_id') === "me") {
            if ($this->isLoggedIn()) $userID = $this->sessionData['id'];
            else return ['status' => false, 'error' => 'Vous n\'êtes pas identifié(e). Vous ne pouvez accéder à cette page.'];
        } else $userID = $this->input->get('user_id');

        $user = $this->db->select('users.id, users.pseudo, users.image')
                         ->select('COUNT(DISTINCT book_contributors.book_id) nbBooks')
                         ->select('COUNT(DISTINCT book_readers.id) nbReads')
                         ->select('SUM(DISTINCT books.downloads) nbDL')
                         ->select('COUNT(DISTINCT reviews.id) nbComments')
                         ->select('AVG(reviews.note) note')
                         ->from('users')
                         ->join('book_contributors', 'book_contributors.user_id = users.id', 'left')
                         ->join('books', 'book_contributors.book_id = books.id', 'left')
                         ->join('book_readers', 'book_readers.book_id = books.id', 'left')
                         ->join('reviews', 'reviews.book_id = books.id OR reviews.user_id = users.id', 'left')
                         ->where('users.id', $userID)
                         ->group_by('book_contributors.user_id')
                         ->get()
                         ->row_array();

        return $user;
    }

    public function book() {
        $book = $this->db->select('books.id, books.title, books.subtitle, books.image, books.description, books.downloads')
                         ->select('users.id AS author_id, users.pseudo, users.image AS author_image')
                         ->select('COUNT(DISTINCT book_readers.user_id) nbReads')
                         ->select('COUNT(DISTINCT reviews.user_id) nbComments')
                         ->select('AVG(DISTINCT reviews.note) note')
                         ->from('books')
                         ->join('book_contributors', 'book_contributors.book_id = books.id', 'left')
                         ->join('users', 'book_contributors.user_id = users.id', 'left')
                         ->join('reviews', 'reviews.book_id = books.id', 'left')
                         ->join('book_readers', 'book_readers.book_id = books.id', 'left')
                         ->where('books.id', $this->input->get('book_id'))
                         ->group_by('book_readers.user_id')
                         ->get()
                         ->row_array();

        return array(
            'id' => $book['id'],
            'title' => $book['title'],
            'subtitle' => $book['subtitle'],
            'image' => $book['image'],
            'desc' => $book['description'],
            'author' => array(
                'id' => $book['author_id'],
                'pseudo' => $book['pseudo'],
                'image' => $book['author_image'],
                'nbBooks' => $this->db->query('SELECT COUNT(DISTINCT book_contributors.book_id) a FROM book_contributors WHERE user_id = '.$book['author_id'])->row_array()['a'],
            ),
            'nbReads' => empty($book['nbReads'])? 0 : $book['nbReads'],
            'nbDL' => empty($book['downloads'])? 0 : $book['downloads'],
            'nbComments' => empty($book['nbComments'])? 0 : $book['nbComments'],
            'note' => empty($book['note'])? 0 : $book['note'],
            'isMine' => !empty($this->sessionData) && $this->sessionData['id'] == $book['author_id']
        );
    }

    public function homeBooks() {
        $recos = $this->db->select('GROUP_CONCAT(CONCAT_WS(\' | \', title, subtitle)) recos')
                         ->from('books')
                         ->join('book_contributors', 'book_contributors.role_id = 2 AND book_contributors.book_id = books.id', 'left')
                         ->group_by('books.id');
        
        $this->sessionData['id'] = 4;               

        if ($this->isLoggedIn()) {
            $recos->where('book_contributors.user_id <> '.$this->sessionData['id'])
                  ->join('user_subscribers', 'user_subscribers.user_id = book_contributors.user_id', 'left')
                  ->where('user_subscribers.subscriber_id <> '.$this->sessionData['id']);
        }

        return $recos->get()->result_array();
    }
}
