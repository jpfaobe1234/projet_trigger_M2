<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sous_titreController extends CI_Controller {

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
	
	// public function index()
	// {				
	// 	$this->is_admin();
	// 	$data['idUser'] = $this->session->userdata('user_id');	/*get id connected*/
	// 	$data['roleUser'] = $this->session->userdata('user_role'); //getRole de l'utilisateur
	// 	$data['prenomUser'] = get_userName_byId($this->session->userdata('user_id')); //get prenom utilisateur
	// 	$this->load->view('admin/header-aside', $data);
	// 	$this->load->view('admin/info_view', $data);
	// 	$this->load->view('admin/footer');
	// }

	public function getAll(){
		$data = $this->InfoModel->getAll();
        echo json_encode($data);
	}

	public function getById($id){
		$id = $this->input->post('id'); 
        $data['data'] = $this->InfoModel->getById($id);
        echo json_encode($data['data']);		
	}

	//------------ Upadte ans SOUS-TITRE ----------------
	public function update()
	{

		$output = array('error' => false);

		// Configuration pour le téléchargement de fichiers
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'pdf|doc|docx|png|jpg';
		$config['allowed_types'] = 'pdf|doc|docx|png|jpg|pptx';
		$config['max_size'] = 3000000;

		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		$uploaded_files = array();

		if ($this->input->post('piece_default') == "") {
			$dataClient = array(
				'type' => $this->input->post('type'),
				'titre' => $this->input->post('titre'),
				'resume' => $this->input->post('resume'),
				'contenu' => $this->input->post('contenu'),
				'priorite' => $this->input->post('priorite'),
											
				'piece_jointe' => $this->input->post('piece_jointe_label'), // Stocker les noms des fichiers dans la base de données
			);

			$where = ['id'=>$this->input->post('id')];
			$this->InfoModel->update($dataClient, $where);

			// Envoyer une réponse JSON
			echo json_encode($output);
		}else {
			// Traiter chaque fichier
			for ($i = 0; $i < count($_FILES['piece_jointe']['name']); $i++) {
				$_FILES['file']['name']     = $_FILES['piece_jointe']['name'][$i];
				$_FILES['file']['type']     = $_FILES['piece_jointe']['type'][$i];
				$_FILES['file']['tmp_name'] = $_FILES['piece_jointe']['tmp_name'][$i];
				$_FILES['file']['error']    = $_FILES['piece_jointe']['error'][$i];
				$_FILES['file']['size']     = $_FILES['piece_jointe']['size'][$i];
	
				// Vérifier si le fichier peut être téléchargé
				if ($this->upload->do_upload('file')) {
					$data = $this->upload->data();
					$uploaded_files[] = $data['file_name'];
				} else {
					$output['error'] = true;
					$output['error_msg'] = $this->upload->display_errors();
				}
			}
	
			// Si le téléchargement des fichiers s'est bien passé
			if (!$output['error']) {
				// Préparer les données pour insertion dans la base de données
				$dataClient = array(
					'type' => $this->input->post('type'),
					'titre' => $this->input->post('titre'),
					'resume' => $this->input->post('resume'),
					'contenu' => $this->input->post('contenu'),
					'priorite' => $this->input->post('priorite'),
												
					'piece_jointe' => implode(',', $uploaded_files), // Stocker les noms des fichiers dans la base de données
				);
	
				$where = ['id'=>$this->input->post('id')];
				$this->InfoModel->update($dataClient, $where);
	
				// Envoyer une réponse JSON
				echo json_encode($output);
			} else {
				// En cas d'erreur, envoyer une réponse JSON avec un message d'erreur
				echo json_encode($output);
			}
		}

	}
	//----------------------------------------------

	//------------ Ajouter dans SOUS-TITRE ----------------
	public function add()
	{		
		try {
			// Configuration pour le téléchargement de fichiers

			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'pdf|doc|docx|png|jpg';
			$config['allowed_types'] = 'pdf|doc|docx|png|jpg|pptx';
			$config['max_size'] = 500240;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			$uploaded_files = array();
			$fichier = "";
			if (count($_FILES) > 0) {
				for ($i = 0; $i < count($_FILES['piece_jointe_sous_titre']['name']); $i++) {
					$_FILES['file']['name']     = $_FILES['piece_jointe_sous_titre']['name'][$i];
					$_FILES['file']['type']     = $_FILES['piece_jointe_sous_titre']['type'][$i];
					$_FILES['file']['tmp_name'] = $_FILES['piece_jointe_sous_titre']['tmp_name'][$i];
					$_FILES['file']['error']    = $_FILES['piece_jointe_sous_titre']['error'][$i];
					$_FILES['file']['size']     = $_FILES['piece_jointe_sous_titre']['size'][$i];
		
					// Vérifier si le fichier peut être téléchargé
					$this->upload->do_upload('file');
					$data = $this->upload->data();
					$uploaded_files[] = $data['file_name'];
				}			
				$fichier = implode(',', $uploaded_files);
			}
			// Préparer les données pour insertion dans la base de données
			$dataClient = [
				'index_sous_titre' => $this->input->post('index_sous_titre'),
				'sous_titre' => $this->input->post('sous_titre'),
				'contenu_sout_titre' => $this->input->post('contenu_sout_titre'),											
				'piece_jointe_sous_titre' => $fichier, // Stocker les noms des fichiers dans la base de données
			];
			
			// Insérer les données dans la base de données
			$req = $this->Sous_titreModel->add($dataClient);
			// Envoyer une réponse JSON
			echo json_encode(array('status' => 'OK', 'message' => " Ajout Resussit !!"));
		} catch (\Throwable $th) {
			echo json_encode(array('status' => 'error', 'message' =>  $th));
		}				
	}
	//----------------------------------------------


	//suppresion
	public function delete(){
        $where = ['id'=>$this->input->post('id')];
		$this->InfoModel->delete($where);
		echo json_encode(array('status' => 'OK', 'message' => "La suppression a été effectuée avec succès !!"));
    }
}