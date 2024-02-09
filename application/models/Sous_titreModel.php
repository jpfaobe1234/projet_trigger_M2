<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sous_titreModel extends CI_Model {

    //recuperer tout from table carrier
    public function getAll(){
        $query = $this->db->get('info');
		return $query->result();
    }

    //recuperer tout par ordre plus recent et par orde de priorité
    public function getAllRecentPriorite(){
        $this->db->order_by('id', 'DESC');
        $this->db->order_by('priorite', 'ASC');
        $query = $this->db->get('info');
		return $query->result();
    }

    //recupérer carrier order par le plus recent
    public function getAllOrderById__(){
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('info');
		return $query->result();
    }
    public function getAllOrderById(){
        // Jointure avec la table 'type'
        $this->db->select('info.*, categori.nomCategori'); // Sélectionnez les colonnes nécessaires
        $this->db->from('info'); // De la table 'info'
        $this->db->join('categori', 'categori.id = info.type', 'left'); // Jointure LEFT JOIN avec la table 'type'
        $this->db->order_by('info.id', 'DESC'); // Ordonner par 'id' en ordre décroissant
        $query = $this->db->get(); // Exécution de la requête
    
        return $query->result(); // Retourner les résultats
    }

    //recuper une ligne from data par ID
    public function getById($id){
        $this->db->select('*');
		$this->db->from('info');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->result();
    }

    // ----- update ---------//
	public function update($data, $where)
	{
		$this->db->where($where) ;
		$query = $this->db->update('sous_titre', $data) ;		
	}

    //adouter dans la base de donnée
    public function add($data)
	{
		$query = $this->db->insert('sous_titre', $data);
	}

    //suppresion dans la base de donnée
    public function delete($where){
        $query = $this->db->delete('info', $where);	
    }

}