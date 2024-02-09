<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuditController extends CI_Controller {

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
		$this->load->view('dep/auditView', $data);
		$this->load->view('admin/footer');
	}    
}