<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_Controller extends CI_Controller{
    public $userId;
    
    function __construct(){
        parent::__construct();
        require_once APPPATH . 'config/tablenames_constants.php';
    }
}

class Admin_Controller extends MY_Controller{
    function __construct(){
        parent::__construct();
        if ($this->router->fetch_class() != "account" && $this->router->fetch_method() != "login") {
            if (!isset($this->session->userdata['valid_login'])) {
                redirect(base_url());
            }
        }
    }    
}

class Affiliate_Controller extends MY_Controller{
    function __construct(){
        parent::__construct();
        if ($this->router->fetch_class() != "account" && $this->router->fetch_method() != "login") {
            if (!isset($this->session->userdata['valid_login'])) {
                redirect(base_url());
            }
            
            $this->userId = $this->session->userdata['valid_login']['id'];
        }
    }    
}