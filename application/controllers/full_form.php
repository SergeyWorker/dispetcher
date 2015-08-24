<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Full_form extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('zayavkimodel'); 
    }
    
    private $title=array('title'=>'Полная форма');
        public function index($offset=null) {
            
            ///////////////////////////////////////////////////////
            $client = new SoapClient("http://disp/describe.wsdl");
            print_r($client->__getFunctions());
            print $client->countAll();
  //print($client->getQuote("ibm"));  
            ///////////////////////////////////////////////////////
            $offset=$offset-1;
             $this->load->library('pagination');
        $config['base_url'] = base_url().'full_form/';
        $config['total_rows'] = count($this->zayavkimodel->get_fulldata(null,null));
       
        $config['per_page'] = 1; 
        $config['first_link'] = 'В начало';
        $config['last_link'] = 'В конец';
        $config['first_tag_open'] = '<p>';
        $config['first_tag_close'] = '</p>';
        $config['use_page_numbers'] = TRUE;
        //$config['page_query_string'] = TRUE;
        $data['full_d']=$this->zayavkimodel->get_fulldata($offset,1);
        $config['uri_segment']=2;
        $config['num_links'] = 1;
        $this->pagination->initialize($config); 
                $this->load->view('templates/header', $this->title);
                $this->load->view('templates/menu');
                $this->load->view('pages/full_view', $data);
                $this->load->view('templates/footer',$config);

        }
     
}
