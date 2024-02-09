<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NiveauController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library(['form_validation','session']);
	}
    
    //vefirification session
	public function is_admin()
    {
        $profile = $this->session->userdata('user_role');
        if (isset($profile)) {
            if ($profile == 0 || $profile == 1 || $profile == 2) {
                return true;
            } else {
                redirect('logout');
            }
        } else {
            redirect('logout');
        }
    }

	public function index()
	{		
        $this->is_admin();
        $data['idUser'] = $this->session->userdata('user_id');	/*get id connected*/
		$data['roleUser'] = $this->session->userdata('user_role'); //getRole de l'utilisateur
		$data['prenomUser'] = get_userName_byId($this->session->userdata('user_id')); //get prenom utilisateur
		$this->load->view('admin/header-aside', $data);
		$this->load->view('admin/niveauView', $data);
		$this->load->view('admin/footer');
	}
    
	/*get id connected*/
    public function get_id_connected()
    {
		return $this->session->userdata('user_id');
    }


    //------ LISTE ------
    function liste_niveau(){
        $data = $this->db->get('niveau')->result();
        $tbody = "
            <thead>
                <tr>
                <th>Designation Niveau</th>
                <th>Action</th>
                </tr>
            </thead>
            <tbody>
        ";
        foreach ($data as $row){
            $tbody .= " 
                <tr>
                    <td>{$row->designation}</td>
                    <td>
                        <button class='btn btn-xs btn-info' onclick='editer_niveau({$row->id_niveau})' title='Editer'><i class='fa fa-edit'></i></button>
                        <a class='btn btn-xs btn-danger' href='{$row->id_niveau}' title='Supprimer'><i class='fa fa-trash'></i></a>
                    </td>
                </tr>
            ";
        }
        $tbody .= "</tbody>";
        echo $tbody;
    }
    //-----------------------------------------------------------------------------------

    function create(){
        try {
            $champs = array(
                'designation' => $this->input->post('designation_niveau'), 
            );
            $req = $this->db->insert('niveau', $champs);
            echo json_encode(["status" => 'success']);
        
        } catch (\Throwable $th) {
            echo json_encode(["error" => $th->getMessage()]);
        }
    }

    //----- READ ONE NIVEAU --------------------
    function getById()
    {
        try {
            $where = array(
                'id_niveau' => $_POST['id'],
            );
            $req = $this->db->get_where('niveau', $where)->result();
            // var_dump($req); die;
            echo json_encode($req);
        } catch (\Throwable $th) {
            echo json_encode(["error" => $th->getMessage()]);
        }
    }
    //-------------------------------------------------

    //---- Update NIVEAU -------
    function update(){
        try {
            $champs = array(
                'designation' =>$_POST['designation_niveau'], 
            );
            $where = array('id_niveau' => $_POST['id_niveau']);
            $this->db->where($where);
            $req = $this->db->update('niveau', $champs);
            echo json_encode(["status" => 'success']);
        } catch (\Throwable $th) {
            echo json_encode(["error" => $th->getMessage()]);
        }
    }
    //-----------------------------------------

    //-- DELETE NIVEAU -------------------------
    function delete(){
        try {
            $champs = array(
                'etat' =>0, 
            );
            $where = array('id_niveau' => $_POST['id_niveau']);
            $this->db->where($where);
            $req = $this->db->update('niveau', $champs);
            echo json_encode(["status" => 'success']);
        } catch (\Throwable $th) {
            echo json_encode(["error" => $th->getMessage()]);
        }         
    }
    // ---------------------------------------------------
}