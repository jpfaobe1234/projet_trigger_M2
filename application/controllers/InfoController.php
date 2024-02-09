<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InfoController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library(['form_validation','session']);
		$this->load->model('InfoModel');
		$this->load->model('CategoriModel');
		$this->load->model('Sous_titreModel');
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
		$this->load->view('admin/info_view', $data);
		$this->load->view('admin/footer');
	}

	//---------------- Ajout INFO ----------------
	public function add()
	{		
		try {

			$index_sous_titre = $this->input->post('index_sous_titre');
			// Configuration pour le téléchargement de fichiers
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'pdf|doc|docx|png|jpg';
			$config['allowed_types'] = 'pdf|doc|docx|png|jpg|pptx';
			$config['max_size'] = 500240;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			$uploaded_files = array();
			$uploaded_files = array();

			$fichier = "";			
			// Traiter chaque fichier
			if ($_FILES['piece_jointe']['name'] != "") {
				for ($i = 0; $i < count($_FILES['piece_jointe']['name']); $i++) {
					$_FILES['file']['name']     = $_FILES['piece_jointe']['name'][$i];
					$_FILES['file']['type']     = $_FILES['piece_jointe']['type'][$i];
					$_FILES['file']['tmp_name'] = $_FILES['piece_jointe']['tmp_name'][$i];
					$_FILES['file']['error']    = $_FILES['piece_jointe']['error'][$i];
					$_FILES['file']['size']     = $_FILES['piece_jointe']['size'][$i];
		
					// Vérifier si le fichier peut être téléchargé
					$this->upload->do_upload('file');
					$data = $this->upload->data();
					$uploaded_files[] = $data['file_name'];
				}		
				$fichier = implode(',', $uploaded_files);			
			}

			$dataClient = array(
				'titre' => $this->input->post('titre'),
				'id_categorie' => $this->input->post('categorie'),
				'id_niveau' => $this->input->post('niveau'),
				'id_acces' => $this->input->post('acces'),
				'resume' => $this->input->post('resume'),
				'contenu' => $this->input->post('contenu'),
				'piece_jointe' => $fichier
			);

			$last_id_info = $this->InfoModel->add($dataClient);
			if ($index_sous_titre != "") {
				$where = ['index_sous_titre'=> $index_sous_titre];
				$data = ['id_info' => $last_id_info];
				$this->Sous_titreModel->update($data, $where);
			}
			echo json_encode(array('status' => 'ok', 'message' => 'OK'));
		} catch (\Throwable $th) {
			echo json_encode(array('status' => 'error', 'message' => $th->getMessage()));
		}		
	}
	//-----------------------------------------------------------------------------

	public function getAll(){
		$data = $this->InfoModel->getAll();
        echo json_encode($data);
	}

	public function getById($id){
		$id = $this->input->post('id'); 
        $data['data'] = $this->InfoModel->getById($id);
        echo json_encode($data['data']);	
	}

	//------------------ Upadte INFO -------
	public function update()
	{
		try {
			// Configuration pour le téléchargement de fichiers
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'pdf|doc|docx|png|jpg';
			$config['allowed_types'] = 'pdf|doc|docx|png|jpg|pptx';
			$config['max_size'] = 3000000;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			$uploaded_files = array();

			if ($_FILES['piece_jointe']['name'] == "") {
				$fichier = $this->input->post('piece_jointe_label');
			}else {
				// Traiter chaque fichier
				for ($i = 0; $i < count($_FILES['piece_jointe']['name']); $i++) {
					$_FILES['file']['name']     = $_FILES['piece_jointe']['name'][$i];
					$_FILES['file']['type']     = $_FILES['piece_jointe']['type'][$i];
					$_FILES['file']['tmp_name'] = $_FILES['piece_jointe']['tmp_name'][$i];
					$_FILES['file']['error']    = $_FILES['piece_jointe']['error'][$i];
					$_FILES['file']['size']     = $_FILES['piece_jointe']['size'][$i];
		
					// Vérifier si le fichier peut être téléchargé
					$this->upload->do_upload('file');
					$data = $this->upload->data();
					$uploaded_files[] = $data['file_name'];
				}
				$fichier = implode(',', $uploaded_files);
			} 
			$dataClient = array(
				'titre' => $this->input->post('titre'),
				'id_categorie' => $this->input->post('categorie'),
				'id_niveau' => $this->input->post('niveau'),
				'id_acces' => $this->input->post('acces'),
				'resume' => $this->input->post('resume'),
				'contenu' => $this->input->post('contenu'),
				'piece_jointe' => $fichier
			);
			$index_sous_titre = $this->input->post('index_sous_titre');

			$where = ['id'=>$this->input->post('id')];
			$this->InfoModel->update($dataClient, $where);
			if ($index_sous_titre != "") {
				$where = ['index_sous_titre'=> $index_sous_titre];
				$data = ['id_info' => $this->input->post('id')];
				$this->Sous_titreModel->update($data, $where);
			}
	
			echo json_encode(array('status' => 'ok'));

		} catch (\Throwable $th) {
			echo json_encode(array('status' => 'error', 'message' =>  $th));
		}

		

	}
	//----------------------------------------

	
	//suppresion
	public function delete(){
        $where = ['id'=>$this->input->post('id')];
		$dataClient = ['etat'=> 0];
		$this->InfoModel->update($dataClient, $where);
		echo json_encode(array('status' => 'OK', 'message' => "La suppression a été effectuée avec succès !!"));
    }
}