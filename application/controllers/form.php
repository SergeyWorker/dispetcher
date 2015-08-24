<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Form extends CI_Controller {
    public function __construct() {
     
        parent::__construct();
	if(!$this->checkuser()) return die();
       $this->load->model('form_model');         
    }
    
    public function checkuser(){
    if(!$this->session->userdata('logged_in')){
                header( "Refresh:2;url=/" ); 
                header('Content-Type: text/html; charset=UTF-8');
                echo 'Вы не авторизованы';
                return false;
                                                }
    else {return true;}
    }
    public function index() {
        $data['view_edit']=0;
        $data['subbut']="<input type='submit' name='new_z' value='Н.заявка' />";
        $this->load->view('templates/header');
        $this->load->view('pages/form',$data);
       // $this->load->view('templates/footer');
    }
    
        public function updata($idz=null) {
        $data['subbut']="<input type='submit' name='edit_z' value='Редакция' />";
        $data['view_edit']=$this->form_model->get_z($idz);   
        print_r($data['view_edit']);
        $this->load->view('templates/header');
        $this->load->view('pages/form', $data);
      //  $this->load->view('templates/footer');
    }
    public function mtest(){
        echo $_POST['v'];
    }

}
