<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Zayavkimodel extends CI_Model {
    
    public function get_all($limit=null,$offset=null) {
      $offset=$offset-1;
        $this->db->order_by('id desc'); 
        $ceh=$this->db->escape_str($this->session->userdata('ceh'));
        $query = $this->db->get_where('active_z', array('ceh' => $ceh),$limit,$offset); 
     
      return json_encode($query->result_array());
        
    }
    
     public function get_fulldata($offset=null,$limit=null) {
      
        $this->db->order_by('id desc'); 
        $ceh=$this->db->escape_str($this->session->userdata('ceh'));
        $query = $this->db->get_where('full_ceh', array('ceh' => $ceh),$limit, $offset); 
     
      return $query->result_array();
        
    }

    public function getlast($idl=null)
    {  
        $sql = "CALL get_last(?,?)";
        $parameters = array($this->session->userdata('ceh'),$idl);
        $query = $this->db->query($sql, $parameters);
       return json_encode($query->result_array());
    }

    
    public function get_z($numz) {
        $query = $this->db->get_where('active_z', array('id' => $numz)); 
        return $query->row_array();
    }
    
    public function get_wt() {
        $query = $this->db->get('sp_work_type'); 
        return $query->result_array();
    }
    
    public function get_tech() {
        $query = $this->db->get('tech'); 
       return json_encode($query->result_array());
    }
    
        public function get_nas() {
        
        $query = $this->db->get('nasel'); 
        return $query->result_array();
    }
    
        public function get_ul($town_num) {
        
        $sql = "SELECT nazv as value, id_ul as data FROM streets WHERE town=?";
        $query = $this->db->query($sql, array($town_num));
        return json_encode($query->result_array());
        
    }
    
    public function new_z($form=null, $tech=null) {
        //add zayavka
        $data = array(
                $this->session->userdata('ceh') ,
                $this->session->userdata('uid') ,
                $form[0],
                $form[1],
                $form[2],
                $form[5],
                $form[7],
                $form[6]
            );
        $sql = "INSERT INTO `zayavki` (ceh,user_id, nas, ul, n_dom, inv_n, work_type,tr_fio) VALUES(?,?,?,?,?,?,?,?)"; 
        $this->db->query($sql, $data);
        //------------------------
        $lid=$this->db->insert_id();
        //add works
        $this->addWorks('ins',$lid,$form[8]);
        
        //add tech
        if($tech){$this->addTech($lid,$tech);}
        return $lid;
    }
    
    public function edit_z($form=null, $tech=null) {
        //update zayavka
        $edit_ok=0;
        $data = array(
               'noadr' => $form[1],
               'inv_n' => $form[3],
               'work_type' => $form[4],
               'status'=>$form[6]
            );

            $this->db->where('id', $form[0]);
            $this->db->update('zayavki', $data); 
            $this->db->where('id_z', $form[0]);
            $this->db->update('nowater', array('bez_v'=>$form[2])); 

        //-----------------------------------------------
        //UPD works
        $this->addWorks('u',$form[0],$form[5]);
        
        //add tech
        if($tech){$this->addTech($form[0],$tech);}
       return $edit_ok;
       
        
    }
    
    protected function addWorks($action_type,$idz, $content) {
        $data=array($idz,$content);
        $sql="INSERT INTO `works_description` (wz_id, works_desc) VALUES(?,?)";
        if($action_type=='u'){$data=array($content,$idz); $sql="UPDATE `works_description` SET `works_desc`=? WHERE `wz_id`=?";}
        $this->db->query($sql, $data);
    }
    
    protected function addTech($idz,$tech_list) {
     $sql="INSERT INTO `zayavki_tech` (tz_id,t_gos,t_pl, t_prib, t_ub) VALUES(?,?,?,?,?)";
        for($i=0; $i<count($tech_list); $i++){ 
        $data=array($idz,$tech_list[$i][0],$tech_list[$i][1],$tech_list[$i][2],$tech_list[$i][3]);
        $this->db->query($sql, $data);
        }        
    }
    
    
}