<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class UForm extends CI_Controller {
    
    public function __construct() {
     
        parent::__construct();
	if(!$this->checkuser()) return die();
       $this->load->model('zayavkimodel');         
    }
    
    
    private function checkuser(){
    if(!$this->session->userdata('logged_in')){
                header( "Refresh:2;url=/" ); 
                header('Content-Type: text/html; charset=UTF-8');
                echo 'Вы не авторизованы';
                return false;
                                                }
    else {return true;}
    }
    
    
    public function index() {
        $title=array('title'=>'Новая заявка');
        $data['work_type_list']=$this->zayavkimodel->get_wt();
        $data['nas_list']=$this->zayavkimodel->get_nas();
        $this->load->view('templates/header',$title);
        $this->load->view('templates/menu');
        $this->load->view('templates/newform',$data);
        $this->load->view('templates/footer');
    }
    
    public function updata($idz=null) {
       
        $title=array('title'=>'Редакция заявки');
        $data['view_edit']=$this->zayavkimodel->get_z($idz);  
        if($data['view_edit']){
        $data['work_type_list']=$this->zayavkimodel->get_wt();
        $this->load->view('templates/header',$title);
        $this->load->view('templates/menu');
        $this->load->view('templates/editform', $data);
        $this->load->view('templates/footer');
        }
        else{
            header( "Refresh:2;url=/zayavki" ); 
                header('Content-Type: text/html; charset=UTF-8');
                echo 'Такая заявка не существует';
        }
    }
    
    
    public function newdata(){
   
    $fields=array('nas','ul_id','nd','n_adr','n_water','inv','tr_fio','type_w','works');
    $values_z=array();
    $error=array();
    foreach ($fields as $value) {
       
        if(!empty($this->input->post($value))){$value_z[]=$this->input->post($value);}
        else{$error[]=$value; break;  }
    }
    if($error){redirect("/nohacks"); die();}
    $tech_arr=array();
    if($this->input->post('gosn1') && !empty($this->input->post('gosn1'))){$tech_arr=$this->check_tech(); }
    if($this->zayavkimodel->new_z($value_z, $tech_arr)){redirect("/zayavki");} 
    }
    
    
    public function editdata() {
    $fields=array('nz','n_adr','n_water','inv','type_w','works'); 
    $values_z=array();
    $error=array();
    foreach ($fields as $value) {
       
        if(!empty($this->input->post($value))){$value_z[]=$this->input->post($value);}
        else{$error[]=$value; break;  }
    }
    if($error){/*redirect("/nohacks");*/ print_r($error); die();}
    $value_z[]=$this->input->post('status');//add status
    $tech_arr=array();
    if($this->input->post('gosn1') && !empty($this->input->post('gosn1'))){$tech_arr=$this->check_tech(); }
//echo "<pre>";
//print_r($value_z);
//echo "</pre>";
    if($this->zayavkimodel->edit_z($value_z, $tech_arr)){redirect("/zayavki");} 
    }
    
    
    private function check_tech(){
       $tech_list=array();
       $tech_row=array();
       $tech_fields=array('gosn','pl','timep','timeu');
        $c=0;
            foreach($_POST as $k=>$v){
                        
                foreach($tech_fields as $subval){
               
                if(strpos($k,$subval)!==false ){
                    if(!empty($this->input->post($v))){$tech_row[]=$this->input->post($v); echo $c++; }    
                        if($c>3){$tech_list[]=$tech_row; $tech_row=array(); $c=0;}                    
                                   } 
                   }
        }
    
        return $tech_list;
    }
    
    
    public function get_tech(){
        echo $this->zayavkimodel->get_tech();
        die();
    }
    
     public function get_ul($ul){
       
           print $this->zayavkimodel->get_ul($ul);
    }
    
    public function vihod() {
        
        $this->session->unset_userdata('logged_in');      
        redirect("/");
    }

}
