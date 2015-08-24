<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Form_model extends CI_Model {

    public function get_z($numz) {
         $sql_alone="SELECT z.id_z, z.nas, ns.nasname, .z.ul, z.status, ns.nazv, z.n_dom, z.noadr, 
                        z.work_type, z.tr_fio, z.inv_n
                FROM zayavki z, nas_streets ns WHERE z.id_z=? AND ns.id=z.ul"; 
        $stmt = $this->db->conn_id->prepare($sql_alone);
        $stmt->bindParam(1, $numz, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}
