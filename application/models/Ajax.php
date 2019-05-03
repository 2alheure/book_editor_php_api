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

        if (empty($q)) return ['error' => 'Invalid identifiers.'];
        else {
            $this->sessionData = ['id' => $q['id']];
            return ['success' => 'Auth success.', 'id' => $q['id']];
        }
    }

}
