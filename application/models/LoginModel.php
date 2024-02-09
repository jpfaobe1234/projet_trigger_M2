<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginModel extends CI_Model {
    
	//recuperer tout les utilsateurs
    public function getAll($table){
        $query = $this->db->get($table);
		return $query->result();
    }

    //recuperer data avec specification
    public function getWhere($table, $where){
        $query = $this->db->get_where($table, $where);
		return $query->result();
    }

    //upadate data
    function edit($table,$champs,$where)
	{
		$this->db->where($where) ;
		$query = $this->db->update($table, $champs) ;
	}
    
}