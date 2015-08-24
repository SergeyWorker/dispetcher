<?php

class Zayavkimodel_ar extends CI_Model{
    
    
    public function edit_z($form=null, $tech=null) {
        //update zayavka
        $edit_ok=0;
        /*$sql_up="UPDATE `zayavki` SET noadr=:noadr, inv_n=:inv, work_type=:w_type, status=:status WHERE id=:numz; "
                . "UPDATE `nowater` SET bez_v=:no_water WHERE id_z=:numz";
        $stmt = $this->db->conn_id->prepare($sql_up);       

        $stmt->bindParam(':numz', $form[0], PDO::PARAM_INT);
        $stmt->bindParam(':noadr', $form[1], PDO::PARAM_STR);
        $stmt->bindParam(':no_water', $form[2], PDO::PARAM_STR);
        $stmt->bindParam(':inv', $form[3], PDO::PARAM_INT);
        $stmt->bindParam(':w_type', $form[4], PDO::PARAM_INT);
        $stmt->bindParam(':status', $form[6], PDO::PARAM_BOOL);
        
        if($stmt->execute()){$edit_ok=1;}*/

        //-----------------------------------------------
        //UPD works
        $this->addWorks('u',$form[0],$form[5]);
        
        //add tech
       // if($tech){$this->addTech($form[0],$tech);}
       // return $edit_ok;
        return 0;
    }
    
    

    protected function addWorks($action_type,$idz, $content) {
         //$this->load->database();
       /* $sql="INSERT INTO `works_description` (wz_id, works_desc) VALUES(:numz,:content_w)";
        if($action_type=='u'){$sql="UPDATE `works_description` SET `works_desc`=:content_w WHERE `wz_id`=:numz";}
      
        $stmt = $this->db->conn_id->prepare($sql);
        $stmt->bindParam('numz', $idz, PDO::PARAM_INT);
        $stmt->bindParam('content_w', $content, PDO::PARAM_LOB);
        if($stmt->execute()){echo $action_type,$idz, $content;}*/
   // $sql = "UPDATE table(`works_description`) SET `works_desc`=:content_w WHERE `wz_id`=:numz"; 
$content="<script>alert();</script>";
        $data = array('works_desc' => $this->db->escape($content));

$where = "wz_id = ".$idz; 

 $this->db->update('works_description', $data, $where);
 $query = $this->db->get('works_description');

foreach ($query->result() as $row)
{
    echo $row->works_desc;
}
    //  $this->db->update_string($str);

//$data = array(
//               'title' => $title,
//               'name' => $name,
//               'date' => $date
//            );
//
//$this->db->where('id', $id);
//$this->db->update('mytable', $data); 

    }
  
}
