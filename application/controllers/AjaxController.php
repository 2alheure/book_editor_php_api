<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * This class handles each and every AJAX call.
 * Its role is to check the request, obtain data, 
 * handle CORS, and respond to the client.
 */
class AjaxController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        // if (!$this->input->is_ajax_request()) {
        //     log_message('error', 'Non AJAX access attempted.');
        //     $this->stdJSONMessage(['error' => 'AJAX access only'], 403);
        //     die;
        // } else {
            $this->load->model('AjaxMap', 'map');
        // }
    }

    public function main() {
        // Récupérer requête
        $segment = $this->uri->segment(1);

        
        if (empty($segment)) {
            log_message('error', 'Empty segment.');
            $this->stdJSONMessage(['error' => 'Bad request'], 400);
            
        } else {
            // Récupérer le mapping pour la requête
            if (!($mapping = $this->map->getMap($segment))) {
                log_message('error', 'Unable to get mapping for '.$segment.'.');
                $this->stdJSONMessage(['error' => 'Not found'], 404);
                
            } else {
                // Checker domaine (CORS)
                if ($this->checkCORS($mapping)) {
                    // Checker les paramètres de la requête
                    if (!$this->checkParams($mapping)) {
                        log_message('error', 'Bad parameters for method '.$segment.'. Got GET ['.implode(', ', array_keys($this->input->get())).'] and POST ['.implode(', ', array_keys($this->input->post())).']');
                        $this->stdJSONMessage(['error' => 'Bad request parameters'], 400);
                        
                    } else {
                        // Checker le token
                        if (($userData = $this->checkToken($mapping)) === false) {
                            log_message('error', 'Invalid token error for '.$this->input->ip_address().'.');
                            $this->stdJSONMessage(['error' => 'Token error'], 403);
                            
                        } else {
                            $this->load->model('Ajax', 'ajax');
                            $this->ajax->setUserData($userData);
                            
                            // Exécuter le Query Builder retourné par la méthode de mapping
                            if (empty($ret = $this->ajax->{$segment}())) {
                                log_message('error', 'Unable to get data with '.$segment.'.');
                                $this->stdJSONMessage(null, 404);
                                
                            } else {
                                // Retourner la réponse en JSON, avec les bon headers pour le CORS
                                $tk = $this->writeAuthorization($this->ajax->getAuthorizationData());
                                
                                if ($segment == 'signin') $ret['token'] = $tk;
                                $this->stdJSONMessage($ret, 200, true);
                            }
                            log_message('error', $this->db->last_query());
                        }
                    }
                }
            }
        }
    }

    protected function checkToken($mapping) {
        if (empty($mapping)) return false;
        if (!isset($mapping['auth']) || !$mapping['auth']) return true;
        
        $token = $this->input->get_request_header('Authorization');
        if (empty($token)) return false;

        return AUTHORIZATION::validateToken($token);
    }

    protected function writeAuthorization($authorization) {
        if (!empty($authorization) && is_array($authorization)) {
            $this->output->set_header('Authorization: '.($tk = AUTHORIZATION::generateToken($authorization)));
            return $tk;
        }
    }

    protected function checkParams(Array $mapping = null) {
        if (empty($mapping)) return false;

        if (isset($mapping['params']['get'])) {
            foreach ($mapping['params']['get']['mandatory'] as $mandatory) {
                if (empty($this->input->get($mandatory))) {
                    log_message('error', 'Missing mandatory get parameter ('.$mandatory.').');
                    return false;
                }
            }

            foreach ($_GET as $name => $value) {
                if (!in_array($name, $mapping['params']['get']['mandatory']) && !in_array($name, $mapping['params']['get']['optional'])) {
                    log_message('error', 'Extra get parameter ('.$name.').');
                    return false;
                }
            }
        }

        if (isset($mapping['params']['post'])) {
            foreach ($mapping['params']['post']['mandatory'] as $mandatory) {
                if (empty($this->input->post($mandatory))) {
                    log_message('error', 'Missing mandatory post parameter ('.$mandatory.').');
                    return false;
                }
            }


            foreach ($_POST as $name => $value) {
                if (!in_array($name, $mapping['params']['post']['mandatory']) && !in_array($name, $mapping['params']['post']['optional'])) {
                    log_message('error', 'Extra post parameter ('.$name.').');
                    return false;
                }
            }
        }

        return true;
    }

    protected function checkCORS(Array $mapping = null) {
        if (empty($mapping)) return false;

        $origin = $this->input->get_request_header('Origin');

        if (empty($origin)) return true;

        $external_allowed_origins = array();

        $local_origins = array(
            'http://localhost',
            'http://localhost:8080',
            'https://localhost',
            'https://localhost:8080',
            'http://127.0.0.1',
            'http://127.0.0.1:8080',
            'https://127.0.0.1',
            'https://127.0.0.1:8080',
            'http://::1',
            'http://::1:8080',
            'https://::1',
            'https://::1:8080',
        );

        if (in_array($origin, array_merge($mapping['cors'], $local_origins, $external_allowed_origins))) {
            $this->output->set_header('Access-Control-Allow-Origin: '.$origin);
            $this->output->set_header('Access-Control-Max-Age: 3600');
            return true;
        }

        log_message('error', 'CORS error with '.$origin);
        return false;
    }

    protected function stdJSONMessage($msg = null, $code = 200, $status = false) {
        $this->output->set_content_type('application/json');
        $this->output->set_status_header($code);

        if (!empty($msg)) {
            if (!isset($msg['status'])) $msg['status'] = $status;
            echo json_encode($msg, JSON_NUMERIC_CHECK);
        } else echo json_encode(['status' => null]);
    }
}
