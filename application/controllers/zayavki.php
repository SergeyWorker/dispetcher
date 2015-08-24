<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Zayavki extends CI_Controller {
    private $title=array('title'=>'Текущие заявки');
    public function __construct() {
     
        parent::__construct();
        if(!$this->checkuser()){ return die();}
        $this->load->model('zayavkimodel');  
        
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
    public function index()
    {       $this->load->library('pagination');
            $config['base_url'] = base_url().'zayavki/';
       $config['total_rows'] = count(json_decode($this->zayavkimodel->get_all(null,null)));
         $config['per_page'] = 1; 
         $config['first_link'] = 'В начало';
        $config['last_link'] = 'В конец';
        $config['first_tag_open'] = '<p>';
        $config['first_tag_close'] = '</p>';
        $config['use_page_numbers'] = TRUE;
        //$config['page_query_string'] = TRUE;
       
        $config['uri_segment']=2;
        $config['num_links'] = 1;
        $this->pagination->initialize($config); 
        $this->load->view('templates/header', $this->title);
        $this->load->view('templates/menu');
        $this->load->view('pages/zayavki');
        $this->load->view('templates/footer');
    }


     /* public function loaddatas($offset=null) {
       $offset=$offset-1;
             $this->load->library('pagination');
        $config['base_url'] = base_url().'zayavki/';
        $config['total_rows'] = count($this->zayavkimodel->get_all(null,null));
       
        $config['per_page'] = 1; 
        $config['first_link'] = 'В начало';
        $config['last_link'] = 'В конец';
        $config['first_tag_open'] = '<p>';
        $config['first_tag_close'] = '</p>';
        $config['use_page_numbers'] = TRUE;
        //$config['page_query_string'] = TRUE;
        $data['full_d']=$this->zayavkimodel->get_all($offset,1);
        $config['uri_segment']=2;
        $config['num_links'] = 1;
        $this->pagination->initialize($config); 
       
            
      }*/
      
    public function allrecords($offset=null){ 

        echo $this->zayavkimodel->get_all(1,$offset);
       }
    
    public function rec_control() {
        echo $this->zayavkimodel->getlast($this->input->post('ids'));
        die();
    }
    
}
