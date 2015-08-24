<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Nohacks extends CI_Controller {
    
    public function __construct() {
     
        parent::__construct();
	 if(!$this->session->userdata('logged_in')){
                header( "Refresh:2;url=/" ); 
                header('Content-Type: text/html; charset=UTF-8');
                echo 'Вы не авторизованы';
                return false;
                                                }       
    }
    public function index() {
        $this->load->view('pages/nohacks');
    }
}