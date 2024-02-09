<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CategoriModel extends CI_Model {
    function __construct()
	{
		
	}

    //recuperer tout from table carrier
    public function getAll(){
        $query = $this->db->where('etat', 1)->get('categori');
		return $query->result();
    }

    //get avec condition
    function getwhere($table,$where)
	{
		$query = $this->db->get_where($table, $where);
		return $query->result();
	}

    function add($table, $champs)
	{
		$query = $this->db->insert($table, $champs);
	}

    function edit($table,$champs,$where)
	{
		$this->db->where($where) ;
		$query = $this->db->update($table, $champs) ;
	}
	function delete($table,$where)
	{
		$this->db->where($where) ;
		$query = $this->db->delete($table, $where) ;
	}

}