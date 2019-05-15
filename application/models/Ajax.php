<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * This class handles all the methods used to obtain data for AJAX calls.
 */
class Ajax extends CI_Model {
    protected $sessionData;

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function setUserData($userData) {
        $this->sessionData = $userData;
    }

    public function getAuthorizationData() {
        return $this->sessionData;
    }

    protected function isLoggedIn() {
        if (!empty($this->sessionData) && isset($this->sessionData['id'])) return $this->sessionData['id'];
        else return false;
    }

    /**
     * This function aims to do multiple operations on a json object. This operation depends of the value of $operation.
     * $operation = get
     * 		Checks whether the $position is set in $json and return its value (or false if doesn't exist).
     * $operation = del
     * 		If $position exists into $json, deletes the item at $position and all its children.
     * $operation = set
     * 		If $position exists into $json, sets the item at $position to the value of $new_one. 
     */
    protected function operateJSON($json = [], $position = 'root', $operation = 'get', $new_one = []) {
        // pr($position);
        if ((!is_array($position) && $position != 'root') || $position[0] != 'root') return false;
        else {
            switch (sizeof($position)) {
                case 0: return false;	// Not valid
                case 1: {
                        switch ($operation) {
                            case 'get': return $json;	// = root
                            case 'del': 

                        }
                        case 2: {
                            return isset($json[$position[1]])? $json[$position[1]] : false;
                        }
                        default: {
                            if (isset($json[$position[1]]['content']))
                                return getJSON($json[$position[1]]['content'], array_merge(['root'], array_slice($position, 2)), $operation, $new_one);
                            else return false;
                        }
                    }
                }
                break;
                case 'del': {
                    if 
                }
                break;
                case 'set': {
                    
                }
                break;
            }
        }
        return false;
    }

    /**
     * Example of method which can be used. Each one has the same pattern.
     * It can use the body and url parameters.
     * It will receive only what's needed, due to the map of the AjaxMAP model.
     * @return $qBuilder
     */
    public function test() {
        $json = $this->db->select('content')
                        ->from('be_books')
                        ->where('id', $this->input->get('book_id'))
                        ->get()
                        ->row_array()['content'];

        $position = not_empty(explode('/', $this->input->get('position')));

        return array(
            'status' => true,
            'content' => $this->operateJSON(
                json_decode($json, true), 
                $position
            )
        );
    }

    public function signin() {
        $q = $this->db->select('id')
                      ->from('be_users')
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
            if (!($userID = $this->isLoggedIn())) return ['status' => false, 'error' => 'Vous n\'êtes pas identifié(e). Vous ne pouvez accéder à cette page.'];
        } else $userID = $this->input->get('user_id');

        $user = $this->db->select('be_users.id, be_users.pseudo, be_users.image')
                         ->select('COUNT(DISTINCT be_book_contributors.book_id) nbBooks')
                         ->select('COUNT(DISTINCT be_book_readers.id) nbReads')
                         ->select('SUM(DISTINCT be_books.downloads) nbDL')
                         ->select('COUNT(DISTINCT be_reviews.id) nbComments')
                         ->select('AVG(be_reviews.note) note')
                         ->from('be_users')
                         ->join('be_book_contributors', 'be_book_contributors.user_id = be_users.id', 'left')
                         ->join('be_books', 'be_book_contributors.book_id = be_books.id', 'left')
                         ->join('be_book_readers', 'be_book_readers.book_id = be_books.id', 'left')
                         ->join('be_reviews', 'be_reviews.book_id = be_books.id OR be_reviews.user_id = be_users.id', 'left')
                         ->where('be_users.id', $userID)
                         ->group_by('be_book_contributors.user_id')
                         ->get()
                         ->row_array();

        return $user;
    }

    public function book() {
        $book = $this->db->select('be_books.id, be_books.title, be_books.subtitle, be_books.image, be_books.description, be_books.downloads')
                         ->select('be_users.id AS author_id, be_users.pseudo, be_users.image AS author_image')
                         ->select('COUNT(DISTINCT be_book_readers.user_id) nbReads')
                         ->select('COUNT(DISTINCT be_reviews.user_id) nbComments')
                         ->select('AVG(DISTINCT be_reviews.note) note')
                         ->from('be_books')
                         ->join('be_book_contributors', 'be_book_contributors.book_id = be_books.id', 'left')
                         ->join('be_users', 'be_book_contributors.user_id = be_users.id', 'left')
                         ->join('be_reviews', 'be_reviews.book_id = be_books.id', 'left')
                         ->join('be_book_readers', 'be_book_readers.book_id = be_books.id', 'left')
                         ->where('be_books.id', $this->input->get('book_id'))
                         ->group_by('be_book_readers.user_id')
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
                'nbBooks' => $this->db->query('SELECT COUNT(DISTINCT be_book_contributors.book_id) a FROM be_book_contributors WHERE user_id = '.$book['author_id'])->row_array()['a'],
            ),
            'nbReads' => empty($book['nbReads'])? 0 : $book['nbReads'],
            'nbDL' => empty($book['downloads'])? 0 : $book['downloads'],
            'nbComments' => empty($book['nbComments'])? 0 : $book['nbComments'],
            'note' => empty($book['note'])? 0 : $book['note'],
            'isMine' => !empty($this->sessionData) && $this->sessionData['id'] == $book['author_id']
        );
    }

    public function homeBooks() {
        $userID = $this->isLoggedIn();
        $recos = array();
        $abos = array();
        $reads = array();
        $mines = array();

        if ($userID) {
            $mines = $this->db->select('be_books.id, be_books.title, be_books.subtitle, be_books.image')
                              ->select('be_users.id AS author_id, be_users.pseudo AS author')
                              ->from('be_books')
                              ->join('be_book_contributors', 'be_book_contributors.role_id = 2 AND be_book_contributors.book_id = be_books.id', 'left')
                              ->join('be_users', 'be_book_contributors.user_id = be_users.id', 'left')
                              ->where('be_book_contributors.user_id', $userID)
                              ->order_by('be_books.updated_at', 'DESC')
                              ->distinct()
                              ->get()
                              ->result_array();

            $reads = $this->db->select('be_books.id, be_books.title, be_books.subtitle, be_books.image')
                              ->select('be_users.id AS author_id, be_users.pseudo AS author')
                              ->from('be_books')
                              ->join('be_book_contributors', 'be_book_contributors.role_id = 2 AND be_book_contributors.book_id = be_books.id', 'left')
                              ->join('be_users', 'be_book_contributors.user_id = be_users.id', 'left')
                              ->join('be_book_readers', 'be_book_readers.user_id = be_users.id', 'left')     // Ne fonctionnera pas
                              ->where('be_book_readers.user_id', $userID)
                              ->order_by('be_book_readers.date', 'DESC')
                              ->get()
                              ->result_array();

            $abos = $this->db->select('be_books.id, be_books.title, be_books.subtitle, be_books.image')
                              ->select('be_users.id AS author_id, be_users.pseudo AS author')
                              ->from('be_books')
                              ->join('be_book_contributors', 'be_book_contributors.role_id = 2 AND be_book_contributors.book_id = be_books.id', 'left')
                              ->join('be_users', 'be_book_contributors.user_id = be_users.id', 'left')
                              ->join('be_user_subscribers', 'be_user_subscribers.user_id = be_users.id', 'left')
                              ->where('be_user_subscribers.subscriber_id', $userID)
                              ->order_by('be_books.created_at', 'DESC')
                              ->get()
                              ->result_array();
        }

        $not_in = array_merge($m = array_column($mines, 'id'),$r = array_column($reads, 'id'),$a = array_column($abos, 'id'));

        $recos = $this->db->select('be_books.id, be_books.title, be_books.subtitle, be_books.image')
                         ->select('be_users.id AS author_id, be_users.pseudo AS author')
                         ->from('be_books')
                         ->join('be_book_contributors', 'be_book_contributors.role_id = 2 AND be_book_contributors.book_id = be_books.id', 'left')
                         ->join('be_users', 'be_book_contributors.user_id = be_users.id', 'left')
                         ->order_by('RAND()')
                         ->limit(10);

        if (!empty($not_in)) $recos->where_not_in('be_books.id', $not_in);
        $recos = $recos->get()
                     ->result_array();
        
        foreach ($mines as &$mine) $mine['isMine'] = true;

        return array(
            'booksReco' => $recos,
            'booksSub' => $abos,
            'booksRead' => $reads,
            'booksMine' => $mines
        );
    }

    public function myBooks() {
        if (!($userID = $this->isLoggedIn())) return ['status' => false, 'error' => 'Vous n\'êtes pas identifié(e). Vous ne pouvez accéder à cette page.'];
        
        return array(
            'books' => array_map(function (&$v) {$v['isMine'] = true; return $v;}, 
            $this->db->select('be_books.id, be_books.title, be_books.subtitle, be_books.image')
                     ->select('be_users.id AS author_id, be_users.pseudo AS author')
                     ->from('be_books')
                     ->join('be_book_contributors', 'be_book_contributors.book_id = be_books.id', 'left')
                     ->join('be_users', 'be_book_contributors.user_id = be_users.id', 'left')
                     ->where('be_book_contributors.user_id', $userID)
                     ->order_by('be_books.updated_at', 'DESC')
                     ->distinct()
                     ->get()
                     ->result_array()
        ));


    }

    public function bookInsert() {
        $book = $this->input->post();
        if ($this->db->insert('be_books', $book)) {
            $bid = $this->db->insert_id();
            $this->db->insert('be_book_contributors', array(
                'book_id' => $bid,
                'user_id' => $this->sessionData['id']
            ));

            return ['id' => $bid];
        } else return array(
            'status' => false,
            'error' => 'Impossible de créer un livre avec ces données.'
        );
    }

    public function bookEdit() {
        if (!empty($bid = $this->input->post('id'))) {
            $book = $this->input->post();
            
            $b = $this->db->where('be_books.id', $book['id'])
                            ->update('be_books', $book);
        }

        if (isset($b) && $b || !empty($bid = $this->input->get('book_id'))) {
            if ($bid == 'new') return array(
                'id' => null,
                'title' => null,
                'subtitle' => null,
                'image' => null,
                'description' => null,
            );

            $a = $this->db->select('be_books.id, be_books.title, be_books.subtitle, be_books.image, be_books.description')
                            ->from('be_books')
                            ->join('be_book_contributors', 'be_book_contributors.book_id = be_books.id', 'left')
                            ->where('be_book_contributors.user_id', $this->sessionData['id'])
                            ->where('be_books.id', $bid)
                            ->get()
                            ->row_array();

            return $a;
        } else return ['status' => false, 'error' => 'Une erreur est survenue pendant le traitement de la requête. Veuillez réessayer plus tard.'];
    }

    public function search() {
        $books = $this->db->select('be_books.id, be_books.title, be_books.subtitle, be_books.image')
                          ->select('be_users.id AS author_id, be_users.pseudo AS author')
                          ->from('be_books')
                          ->join('be_book_contributors', 'be_book_contributors.role_id = 2 AND be_book_contributors.book_id = be_books.id', 'left')
                          ->join('be_users', 'be_book_contributors.user_id = be_users.id', 'left')
                          ->order_by('be_books.updated_at', 'DESC')
                          ->distinct();

        if (!empty($this->input->post('title'))) $books->like('be_books.title', $this->input->post('title'));
        if (!empty($this->input->post('subtitle'))) $books->like('be_books.subtitle', $this->input->post('subtitle'));
        if (!empty($this->input->post('author'))) $books->like('be_users.pseudo', $this->input->post('author'));
        
        if (!empty($this->input->post('generic'))) $books->or_like('CONCAT_WS(\'~\', be_users.pseudo, be_books.title, be_books.subtitle)', $this->input->post('generic'));

        return array('books' => $books->get()->result_array());
    }

    public function bookContent() {
        $book = $this->db->select('be_books.id, be_books.title, be_books.subtitle, be_books.image')
                     ->select('be_books.content')
                     ->from('be_books')
                     ->where('be_books.id', $this->input->get('book_id'))
                     ->get()
                     ->row_array();
        return array(
            'meta' => array(
                'id' => $book['id'],
                'title' => $book['title'],
                'subtitle' => $book['subtitle'],
                'image' => $book['image'],
            ),
            'content' => json_decode($book['content'], true)
        );
    }
}
