<?php

class Intromodel extends CI_Model {

	public function __construct()
	{
                parent::__construct();
		//$this->load->database();
	}

    public function get_us($name,$p)
	{
        $sql = "CALL getuser(?,?)";
        $parameters = array($name, md5($p));
        $query = $this->db->query($sql, $parameters);
        return $query->result();
	}
}