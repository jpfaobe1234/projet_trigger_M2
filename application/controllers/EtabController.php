<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EtabController extends CI_Controller {

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
		$this->load->view('dep/etabView', $data);
		$this->load->view('admin/footer');
	}
    
	/*get id connected*/
    public function get_id_connected()
    {
		return $this->session->userdata('user_id');
    }

    function create(){
        try {
            $champs = array(
                'nom_etab' => $this->input->post('nom_etab'), 
                'budget' => $this->input->post('budget'), 
            );
            $req = $this->db->insert('etablissement', $champs);
            echo json_encode(["status" => 'success']);
        
        } catch (\Throwable $th) {
            echo json_encode(["error" => $th->getMessage()]);
        }
    }

    //----- READ ONE ETABLISSEMENT --------------------
    function getById()
    {
        try {
            $where = array(
                'id_etab' => $_POST['id_etab'],
            );
            $req = $this->db->get_where('etablissement', $where)->result();
            echo json_encode($req);
        } catch (\Throwable $th) {
            echo json_encode(["error" => $th->getMessage()]);
        }
    }
    //-------------------------------------------------

    //---- Update ETABLISSEMENT -------
    function update(){
        try {
            $champs = array(
                'nom_etab' => $this->input->post('nom_etab'), 
                'budget' => $this->input->post('budget'), 
            );
            $where = array('id_etab' => $_POST['id_etab']);
            $this->db->where($where);
            $req = $this->db->update('etablissement', $champs);
            echo json_encode(["status" => 'success']);
        } catch (\Throwable $th) {
            echo json_encode(["error" => $th->getMessage()]);
        }
    }
    //-----------------------------------------

    //-- DELETE ETABLISSEMENT -------------------------
    function delete(){
        try {
            $where = array('id_etab' => $_POST['id_etab']);
            $this->db->where($where);
            $req = $this->db->delete('etablissement', $where);
            echo json_encode(["status" => 'success']);
        } catch (\Throwable $th) {
            echo json_encode(["error" => $th->getMessage()]);
        }         
    }
    // ---------------------------------------------------
}