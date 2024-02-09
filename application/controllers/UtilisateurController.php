<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UtilisateurController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library(['form_validation','session']);
		$this->load->model('UtilisateurModel');
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
		$this->load->view('admin/utilisateurView', $data);
		$this->load->view('admin/footer');
	}
	/*get id connected*/
    public function get_id_connected()
    {
		return $this->session->userdata('user_id');
    }

    function create_user(){
        // $this->is_admin();
        $pass = $this->input->post('su_pass');
        $hash = sha1($pass);
        $champs = array(
            'su_prenom' => $this->input->post('su_prenom'), 
            'su_login' => $this->input->post('su_login'), 
            'su_role' => $this->input->post('su_role'), 
            'su_pass' => $pass, 
            'su_hash' => $hash, 
        );
        $req = $this->UtilisateurModel->add('systemusers', $champs);
        redirect('utilisateur');
    }


    function getUserToEdit()
    {
        // $this->is_admin();
        $this->db->select('su_prenom');
        $this->db->select('su_login');
        $this->db->select('su_pass');
        $this->db->select('su_role');
        $where = array(
            'su_id' => $this->uri->segment(2),
        );
        $req = $this->UtilisateurModel->getwhere('systemusers', $where);
        echo json_encode($req);
    }

    function update_user(){
        // $this->is_admin();
        $pass = $this->input->post('su_pass');
        $hash = sha1($pass);
        $champs = array(
            'su_prenom' => $this->input->post('su_prenom'), 
            'su_login' => $this->input->post('su_login'), 
            'su_role' => $this->input->post('su_role'), 
            'su_pass' => $pass, 
            'su_hash' => $hash, 
        );
        $where = array('su_id' => $this->uri->segment(2));
        $req = $this->UtilisateurModel->edit('systemusers', $champs, $where);
        redirect('utilisateur');  
    }

    function delete_user(){
        // $this->is_admin();
        $champs = array(
            'su_isactive' => 0, 
        );
        $where = array('su_id' => $this->uri->segment(2));
        $req = $this->UtilisateurModel->edit('systemusers', $champs, $where);
        redirect('utilisateur');  
    }
}