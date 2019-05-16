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
            'content' => getJSON(
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
                              ->join('be_book_readers', 'be_book_readers.book_id = be_books.id', 'left')     // Ne fonctionnera pas
                              ->where('be_book_readers.user_id', $userID)
                              ->order_by('be_book_readers.date', 'DESC')
                              ->get()
                              ->result_array();
                              log_message('error',$this->db->last_query());

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
                     ->select('be_books.content, be_book_contributors.user_id AS author_id')
                     ->from('be_books')
                     ->join('be_book_contributors', 'be_book_contributors.role_id = 2 AND be_book_contributors.book_id = be_books.id')
                     ->where('be_books.id', $this->input->get('book_id'))
                     ->get()
                     ->row_array();

        if ($this->isLoggedIn() && $book['author_id'] != $this->sessionData['id']) {
            $this->db->replace('be_book_readers', array(
                'user_id' => $this->sessionData['id'],
                'book_id' => $this->input->get('book_id'),
            ));
        }

        $getJson = getJSON(json_decode($book['content'], true), not_empty(explode('/', $this->input->get('position'))));

        return array(
            'meta' => array(
                'id' => $book['id'],
                'title' => $book['title'],
                'subtitle' => $book['subtitle'],
                'image' => $book['image'],
            ),
            'content' => $this->input->get('position')=='root'? $getJson : [$getJson]
        );
    }

    public function updateBloc() {
        $json = $this->db->select('content')
                        ->from('be_books')
                        ->join('be_book_contributors', 'be_book_contributors.role_id = 2 AND be_book_contributors.book_id = be_books.id')
                        ->where('be_book_contributors.user_id', $this->sessionData['id'])
                        ->where('be_books.id', $this->input->get('book_id'))
                        ->get()
                        ->row_array()['content'];

        $json = json_decode($json, true);
        
        if (empty($json)) return array(
            'status' => false,
            'error' => 'Impossible de récupérer les informations sur ce livre pour cet utilisateur.'
        );

        else {
            $position = explode('/', $this->input->get('position'));
            $isNew = $position[sizeof($position)-1] == 'new';
            if ($isNew) $position = array_slice($position, 0, -1);
            
            $getJson = getJSON($json, $position);

            if ($getJson === false) return array(
                'status' => false,
                'error' => 'Une erreur est survenue pendant le traitement de la requête. Traitement impossible.'
            );

            if ($isNew) {
                $content = $getJson;
                $content['content'][] = json_decode($this->input->post('content'), true);
            } else $content = json_decode($this->input->post('content'), true);

            $updateJson = updateJson($json, $position, $content);
            if (!$updateJson || !$this->db->where('be_books.id', $this->input->get('book_id'))->update('be_books', ['content' => json_encode($updateJson), 'updated_at' => null]))  {
                
                return array(
                    'status' => false,
                    'error' => 'Une erreur est survenue pendant le traitement de la requête. Modification du livre impossible.'
                );
            } else return ['content' => $updateJson];
        }
    }

    public function deleteBloc() {
        $json = $this->db->select('content')
                        ->from('be_books')
                        ->join('be_book_contributors', 'be_book_contributors.role_id = 2 AND be_book_contributors.book_id = be_books.id')
                        ->where('be_book_contributors.user_id', $this->sessionData['id'])
                        ->where('be_books.id', $this->input->get('book_id'))
                        ->get()
                        ->row_array()['content'];

        $json = json_decode($json, true);

        if (empty($json)) return array(
            'status' => false,
            'error' => 'Impossible de récupérer les informations sur ce livre pour cet utilisateur.'
        );

        else {
            $position = explode('/', $this->input->get('position'));
            $deleteJson = deleteJson($json, $position);

            if (!$deleteJson || !$this->db->where('be_books.id', $this->input->get('book_id'))->update('be_books', ['content' => json_encode($deleteJson), 'updated_at' => null])) return array(
                'status' => false,
                'error' => 'Une erreur est survenue pendant le traitement de la requête. Suppression impossible.'
            );
            else return ['content' => $deleteJson];
        }
    }
}
