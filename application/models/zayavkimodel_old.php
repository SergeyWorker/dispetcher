<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Zayavkimodel extends CI_Model {
    
    public function get_all($ceh=null) {
      
        $stmt = $this->db->conn_id->prepare("SELECT * FROM active_z az WHERE az.ceh=?  ORDER BY id DESC;");
        $stmt->bindParam(1, $ceh, PDO::PARAM_INT);
        $stmt->execute();
        return json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
        
    }

    public function getlast($idl=null, $cehn=null)
    {
	$stmt = $this->db->conn_id->prepare("CALL get_last(?,?)");
        $stmt->bindParam(1, $cehn, PDO::PARAM_INT);
        $stmt->bindParam(2, $idl, PDO::PARAM_INT);
        $stmt->execute();
            return json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    
     public function get_z($numz) {
        
        $stmt = $this->db->conn_id->prepare("SELECT * FROM active_z WHERE id=?");
        $stmt->bindParam(1, $numz, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function get_wt() {
        $stmt = $this->db->conn_id->prepare("SELECT * FROM sp_work_type");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function get_tech() {
        $stmt = $this->db->conn_id->prepare("SELECT gosn FROM tech");
        $stmt->execute();

        return json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    }
    
        public function get_nas() {
        $stmt = $this->db->conn_id->prepare("SELECT * FROM nasel");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
        public function get_ul($town_num) {
        
        $stmt = $this->db->conn_id->prepare("SELECT nazv as value, id_ul as data FROM streets WHERE town=?");
        $stmt->bindParam(1, $town_num, PDO::PARAM_INT);
        $stmt->execute();

        return json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
        
    }
    
    public function new_z($form=null, $tech=null) {
        //add zayavka
        $stmt = $this->db->conn_id->prepare("INSERT INTO `zayavki` (ceh,user_id, nas, ul, n_dom, inv_n, work_type,tr_fio) VALUES(?,?,?,?,?,?,?,?)");
        $stmt->bindParam(1, $this->session->userdata('ceh'), PDO::PARAM_INT);
        $stmt->bindParam(2, $this->session->userdata('uid'), PDO::PARAM_INT);
        $stmt->bindParam(3, $form[0], PDO::PARAM_INT);
        $stmt->bindParam(4, $form[1], PDO::PARAM_INT);
        $stmt->bindParam(5, $form[2], PDO::PARAM_STR,4);
        $stmt->bindParam(6, $form[5], PDO::PARAM_INT);
        $stmt->bindParam(7, $form[7], PDO::PARAM_INT,2);
        $stmt->bindParam(8, $form[6], PDO::PARAM_STR,25);
        
        $stmt->execute();
        //-----------------------------------------------
        $lid=$this->db->conn_id->lastInsertId();
        //add works
        $this->addWorks('ins',$lid,$form[8]);
        
        //add tech
        if($tech){$this->addTech($lid,$tech);}
    }
    
    public function edit_z($form=null, $tech=null) {
        //update zayavka
        $edit_ok=0;
        $sql_up="UPDATE `zayavki` SET noadr=:noadr, inv_n=:inv, work_type=:w_type, status=:status WHERE id=:numz; "
                . "UPDATE `nowater` SET bez_v=:no_water WHERE id_z=:numz";
        $stmt=$this->db->conn_id->prepare($sql_up);       

        $stmt->bindParam(':numz', $form[0], PDO::PARAM_INT);
        $stmt->bindParam(':noadr', $form[1], PDO::PARAM_STR);
        $stmt->bindParam(':no_water', $form[2], PDO::PARAM_STR);
        $stmt->bindParam(':inv', $form[3], PDO::PARAM_INT);
        $stmt->bindParam(':w_type', $form[4], PDO::PARAM_INT);
        $stmt->bindParam(':status', $form[6], PDO::PARAM_BOOL);
        
        if($stmt->execute()){$edit_ok=1;}
$this->db->conn_id->close();
        //-----------------------------------------------
        //UPD works
        $this->addWorks('u',$form[0],$form[5]);
        
        //add tech
        if($tech){$this->addTech($form[0],$tech);}
       // return $edit_ok;
        return 0;
        
    }
    
    protected function addWorks($action_type,$idz, $content) {
        
        $sql="INSERT INTO `works_description` (wz_id, works_desc) VALUES(:numz,:content_w)";
        if($action_type=='u'){$sql="UPDATE `works_description` SET `works_desc`=:content_w WHERE `wz_id`=:numz";}
      
        $stmt = $this->db->conn_id->prepare($sql);
        $stmt->bindParam('numz', $idz, PDO::PARAM_INT);
        $stmt->bindParam('content_w', $content, PDO::PARAM_LOB);
        if($stmt->execute()){echo $action_type,$idz, $content;}
      
    }
    
    protected function addTech($idz,$tech_list) {
     
        $stmt = $this->db->conn_id->prepare("INSERT INTO `zayavki_tech` (tz_id,t_gos,t_pl, t_prib, t_ub) VALUES(?,?,?,?,?)");
          
                    for($i=0; $i<count($tech_list); $i++){ 

                    $stmt->bindParam(1, $idz, PDO::PARAM_INT);
                    $stmt->bindParam(2, $tech_list[$i][0], PDO::PARAM_STR);
                    $stmt->bindParam(3, $tech_list[$i][1], PDO::PARAM_STR);
                    $stmt->bindParam(4, $tech_list[$i][2], PDO::PARAM_STR);
                    $stmt->bindParam(5, $tech_list[$i][3], PDO::PARAM_STR);
                    $stmt->execute();
                    }        
    }
    
    
}