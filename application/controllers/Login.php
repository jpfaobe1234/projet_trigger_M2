<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library(['form_validation','session']);
		$this->load->model('LoginModel');        
	}

	public function index()
	{
		$this->load->view('login/login-view');
	}

	//verifier login 
	//connexion proces
    function connexion()
    {
        $userlogin = $_POST['login'];
        $password = $_POST['pass'];
        $sha_password = sha1($password);
        $where = array(
            'su_login' => $userlogin,
            'su_hash' => $sha_password,
                      );
        $login_data = $this->LoginModel->getWhere('systemusers', $where);
        if ($login_data) {
            $get_login = $login_data[0]->su_login;
            $get_password = $login_data[0]->su_hash;
            $get_useractive = $login_data[0]->su_isactive;
            
        } else {
            $this->session->set_flashdata('errorMessage',
                '<div align="center" style="background:red">
                    Login / Mot de passe incorrect !<br>
                    ou Compte désactivé !
                </div>');
            redirect('login'); 
        }
        if ($userlogin == $get_login && $sha_password == $get_password && $get_useractive == 1) {
            $userdata = array(
                'user_id' => $login_data[0]->su_id,
                'user_nom' => $login_data[0]->su_nom,
                'user_prenom' => $login_data[0]->su_prenom,
                'user_isactive' => $login_data[0]->su_isactive,
                'user_role' => $login_data[0]->su_role,
                'user_is_logged' => true,
            );
            $this->session->set_userdata($userdata);
            $this->session->set_flashdata('successMessage',
                '<div class="alert alert-success">
                <i class="glyphicon glyphicon-ok-sign"></i>
                Connexion établie ... Bienvenu '.$this->session->userdata['user_prenom'].' !</div>');

                $champs = array('su_lastconexion' => date('Y-m-d H:i'));
                $where = array('su_id' => $this->session->userdata('user_id'));
                $this->LoginModel->edit('systemusers', $champs, $where);

                $role = $this->session->userdata['user_role'];
                if ($role == 1) {
                    redirect(site_url('audit'));
                } else{
                    redirect(site_url('depense'));
                }
        } else {
            $this->session->set_flashdata('errorMessage',
                '<div align="center" class="alert alert-danger" style="background:red">
                    Login / Mot de passe incorrect !
                </div>');
            redirect('login');
        }        
    }

    /*deconnection*/
    public function logout()
    {
        $journal = array(
            'journal_content' => 'Deconnexion à la plateforme', 
            'journal_idaction' => 1, 
            'journal_iduser' => $this->session->userdata('user_id'),
            'journal_idrole' => $this->session->userdata('user_role'),
            'journal_datetime' => date('Y-m-d H:i:s'), 
            );
        if ($this->session->userdata('user_id')) {
            // $this->seb_model->add('journal', $journal);
        }
        $this->session->sess_destroy();
        redirect(site_url());
    }
}
