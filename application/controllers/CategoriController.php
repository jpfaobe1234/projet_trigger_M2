<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CategoriController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library(['form_validation','session']);
		$this->load->model('CategoriModel');
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
		$this->load->view('admin/categoriView', $data);
		$this->load->view('admin/footer');
	}
	/*get id connected*/
    public function get_id_connected()
    {
		return $this->session->userdata('user_id');
    }

    function create_categori(){
        $champs = array(
            'nomCategori' => $this->input->post('nomCategori'), 
        );
        $req = $this->CategoriModel->add('categori', $champs);
        redirect('categori');
    }


    function getUserToEdit()
    {
        $where = array(
            'id' => $this->uri->segment(2),
        );
        $req = $this->CategoriModel->getwhere('categori', $where);
        echo json_encode($req);
    }

    function update_categori(){
        $champs = array(
            'nomCategori' => $this->input->post('nomCategori'), 
        );
        $where = array('id' => $this->uri->segment(2));
        $req = $this->CategoriModel->edit('categori', $champs, $where);
        redirect('categori');  
    }

    function delete_categori(){
        $where = array('id' => $this->uri->segment(2));
        $req = $this->CategoriModel->delete('categori', $where);
        redirect('categori');  
    }
}