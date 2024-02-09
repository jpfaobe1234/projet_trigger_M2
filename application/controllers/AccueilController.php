<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AccueilController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library(['form_validation','session']);
		$this->load->model('InfoModel');        
	}

    //------ Recherche Filter ---------
    public function recherche_filter(){
        $id_categorie = $_POST['filtre_categorie'];

        if ($id_categorie == 0) {
            $data = $this->db->select('*')
                ->where('etat', 1)
                ->limit(15)->get('info')->result();            
        } else if ($id_categorie != 0 ) {
            $data = $this->db->select('*')
                ->where('id_categorie', $id_categorie)
                ->where('etat', 1)
                ->limit(15)->get('info')->result(); 
        } 
        
        $card = "";
        if (count($data) == 0) {
            $card = '
                <div class="alert alert-danger" style="margin-left: 10% ; justify-content: center">
                    <h1>Mankasitraka anao nitsidika ny tranokala Zoky Manoro.</h1>
                    <h4>Raha ilaina dia manaingna anao : </h4>
                    <p>hitsidika ny pejy Facebook <a style="style: none; color: blue" href="https://www.facebook.com/zokymanoro" target="_blank">www.facebook.com/zokymanoro</a></p>
                    <p>na hiantso ny laharana Whatsapp <strong style="color: blue">.+261.34.52.928.15.</strong></p>
                    <p>na koa handefa hafatra amin\'ny mailaka <strong style="color: blue"> a d o l p h e @ z o k y m a n o r o . c o m</strong></p>
                    <a style="style: none; color: blue" href="'.base_url("accueil").'" class="alert-link">Tsindrio eto raha hiverina</a>
                </div>
            ';
        } else {
            foreach ($data as $value) {
                $fichiers = explode(',', $value->piece_jointe);
                foreach ($fichiers as $fichier) {
                    $altern_image = "";
                    if ($fichier == "" ) {
                        $altern_image = substr($value->contenu,0,150);
                    }
                    $img = ($fichier == "" ) ? base_url() . 'assets/img/no_image.png' : base_url() . 'uploads/' . $fichier ;
                    break;
                }
                // <img src="'.$img. '" style="height: 250px;"  class="card-img-top position-relative" alt="blog">
                $card .= '
                    <div class="col-md-4" onclick="detail('.$value->id. ')">
                        <form action="details" method="post" id="postForm'.$value->id.'">
                            <input type="hidden" name="id" value="'.$value->id. '">
                            
                            <div class="single-blog-card card border-0 shadow-sm" style="cursor: pointer;">
                                <p class="lead text-white text-center"
                                    style="height: 250px;
                                        background: url('.$img.') ;
                                        background-size: 100% 100%;" > 
                                    '.$altern_image.'</p>
    
                                <div class="card-body">
                                    <h4 class="h6 card-title">' .$value->titre. '</h4>
                                    <p class="">' .substr($value->resume,0,255). '</p>                                                        
                                </div>
                            </div>                                            
                        </form>
                    </div>
                                            
                ';
            }
        }
        echo $card;
    }

    //----------------------------------------

    //------ AFFICHAGE FILTRE ------
    public function afficher_filte(){
        
        //-------- FILTRE Categorie -----------------------------
            $categ = $this->db->select("*")->from("categori")->where("etat",1)->get()->result();
            $categFiltre = '
                <form id="form_filter" method="POST">
                    <div class="domain-filter-title">
                        <h5 style="font-size:15px" class="mb-0">Categorie<span class="ti-angle-down float-right"></span></h5>
                        </div> 
                        <ul class="list-unstyled domain-filter-list mt-3">
                            <li class="form-check">
                                <label class="form-check-label">
                                    <input name="filtre_categorie" type="radio" class="form-check-input" value="0" checked> Tous
                                </label>
                            </li>
                ';                
            foreach ($categ as $value) {  
                $categFiltre .= '            
                    <li class="form-check">
                        <label class="form-check-label">
                            <input name="filtre_categorie" type="radio" class="form-check-input" value="'.$value->id.'"> '.$value->nomCategori.'
                        </label>
                    </li>
                ';        
            }

            $categFiltre .= '</ul>';
        //-------------------------------------------------------------------

        $affichage_filter = 
            $categFiltre .
                '<button type="submit" class="btn btn-block outline-btn mt-3">Appliquer</button>
            </form>';
        return $affichage_filter;

        //-------- FILTER NIVEAU -----------------------------------------
            // $niveau = $this->db->select("*")->from("niveau")->where_in('etat', array(1, -1))->get()->result();

            // $niveauFiltre = ' <br>
            //     <div class="domain-filter-title1">
            //         <h5 style="font-size:15px" class="mb-0">Niveau<span class="ti-angle-down float-right"></span></h5>
            //     </div> 
            //     <ul class="list-unstyled domain-filter-list1 mt-3">
            //         <li class="form-check">
            //             <label class="form-check-label">
            //                 <input name="filtre_niveau" type="radio" class="form-check-input" value="0" checked> Tous
            //             </label>
            //         </li>
            //     ';

            // foreach ($niveau as $value) {
                
            //     $niveauFiltre .= '
                
            //         <li class="form-check">
            //             <label class="form-check-label">
            //                 <input name="filtre_niveau" type="radio" class="form-check-input" value="'.$value->id_niveau.'"> '.$value->designation.'
            //             </label>
            //         </li>

            //     ';
            
            // }

            // $niveauFiltre .= '</ul>';
    //--------------------------------------------------------

    }
    //-------------------------------------------

    public function index($data = array())
	{	

        $data['info'] = "";

        $card = "";

        if (isset($_POST['text_rechercher'])) {
            // var_dump($_POST['text_rechercher']); die;
            $info = $_POST['text_rechercher'];
            $likeInfo = '%'.$this->db->escape_like_str($info).'%'; //netoyer les data
            //requette preparer pour mesurer la securité
            $sql = "SELECT * FROM `info` WHERE `etat`=1 AND `titre` LIKE ? OR `contenu` LIKE ? OR `resume` LIKE ?  LIMIT 9";
            $data = $this->db->query($sql, array($likeInfo, $likeInfo, $likeInfo))->result();
            
        } else {
            $data = $this->db->select("*")->where('etat', 1)->from("info")->limit(9)->get()->result();            
        }   

        $data_manoro = $this->db->select("*")->from("info")->limit(9)->get()->result();            
        
        if (count($data) == 0) {
            $card = '
                <div class="alert alert-danger" style="margin-left: 10% ; justify-content: center">
                    <h1>Mankasitraka anao nitsidika ny tranokala Zoky Manoro.</h1>
                    <h4>Raha ilaina dia manaingna anao : </h4>
                    <p>hitsidika ny pejy Facebook <a style="style: none; color: blue" href="https://www.facebook.com/zokymanoro" target="_blank">www.facebook.com/zokymanoro</a></p>
                    <p>na hiantso ny laharana Whatsapp <strong style="color: blue">.+261.34.52.928.15.</strong></p>
                    <p>na koa handefa hafatra amin\'ny mailaka <strong style="color: blue"> a d o l p h e @ z o k y m a n o r o . c o m</strong></p>
                    <a style="style: none; color: blue" href="'.base_url("accueil").'" class="alert-link">Tsindrio eto raha hiverina</a>
                </div>
            ';
        } else {
            foreach ($data as $value) {
                $fichiers = explode(',', $value->piece_jointe);
                foreach ($fichiers as $fichier) {
                    $altern_image = "";
                    if ($fichier == "" ) {
                        $altern_image = substr($value->contenu,0,150);
                    }
                    $img = ($fichier == "" ) ? base_url() . 'assets/img/no_image.png' : base_url() . 'uploads/' . $fichier ;
                    break;
                }
                // <img src="'.$img. '" style="height: 250px;"  class="card-img-top position-relative" alt="blog">
                $card .= '
                    <div class="col-md-4" onclick="detail('.$value->id. ')">
                        <form action="details" method="post" id="postForm'.$value->id.'">
                            <input type="hidden" name="id" value="'.$value->id. '">
                            
                            <div class="single-blog-card card border-0 shadow-sm" style="cursor: pointer;">
                                <p class="lead text-white text-center"
                                    style="height: 250px;
                                        background: url('.$img.') ;
                                        background-size: 100% 100%;" >
                                    '.$altern_image.'</p>
    
                                <div class="card-body">
                                    <h4 class="h6 card-title">' .$value->titre. '</h4>
                                    <p class="">' .substr($value->resume,0,255). '</p>                                                       
                                </div>
                            </div>                                            
                        </form>
                    </div>
                                            
                ';
            }
        }

        $affichage_filter = $this->afficher_filte();

        $valeur['card'] = $card ;
        $valeur['filtre'] = $affichage_filter ;
        
        $this->load->view('AccueilView', $valeur);
    }

    
    public function details()
	{	
        
        $card = "";

        $data = $this->db->select("*")->from("info")->where("id",$_POST["id"])->get()->row();

        $fichiers = explode(',', $data->piece_jointe);
        $img_carresoul ="";
        if ($data->piece_jointe != "") {
            foreach ($fichiers as $key => $fichier) {
                
                $img = ($fichier == "" ) ? base_url() . 'assets/img/team-2.jpg' : base_url() . 'uploads/' . $fichier ;
                // $img = ($data->piece_jointe == "" ) ? base_url() . 'assets/img/hero-10.jpg' : base_url() . 'uploads/' . $data->piece_jointe ;
                $active_class = ($key == 0) ? 'active' : '';
                $img_carresoul .= 
                    '<div class="carousel-item '.$active_class.'">
                        <img src="'. $img .'" style="height: 300px;" class="d-block w-100" alt="article">
                    </div>';
            }
            $carresoul_info = '
                <div id="carouselExample" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        '.$img_carresoul.'
                    </div>
                    <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true" style="background-color: blue; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExample" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true" style="background-color: blue; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            ';            
        } else {
            $carresoul_info = '';
        }
        
            
        $valeur['carresoul_info'] = $carresoul_info;
        $valeur['titre'] = $data->titre;
        $valeur['resume'] = $data->resume;
        $valeur['contenu'] = $data->contenu;

        //-------affichage detail INFO
            $data = $this->db->select("*")->from("sous_titre")->where("id_info",$_POST["id"])->get()->result();
            
            foreach ($data as $value) {
                $fichiers = explode(',', $value->piece_jointe_sous_titre);
                if ($value->piece_jointe_sous_titre != "") {
                    $img_carresoul ="";
                    foreach ($fichiers as $key => $fichier) {
                        $img = base_url() . 'uploads/' . $fichier ;
                        
                        $active_class = ($key == 0) ? 'active' : '';
                        $img_carresoul .= 
                            '<div class="carousel-item '.$active_class.'">
                                <img src="'. $img .'" style="height: 300px;" class="d-block w-100" alt="article">
                            </div>';
                    }
                    $carresoul = '
                        <div id="carouselExample2" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                '.$img_carresoul.'
                            </div>
                            <a class="carousel-control-prev" href="#carouselExample2" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true" style="background-color: blue; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExample2" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true" style="background-color: blue; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    ';
                } else {
                    $carresoul = '';
                }

                $card .= '
                    <article class="post">
                        <h4 class="post-title">'.$value->sous_titre.'</h4>
                        <div class="post-preview">
                            '.$carresoul.'
                        </div>
                        
                        <div class="post-wrapper">
                            <div class="post-header">
                            </div>
                            <div class="post-content">
                                <p>'.$value->contenu_sout_titre.'</p>                    
                            </div>
                        </div>
                    </article>
                ';
            }
            $valeur['card'] = $card ;
        //------------------------------------------------------------------

        //---- Affichage INFO recents ----------
            $data = $this->db->select("*")->where('etat', 1)->from("info")->limit(5)->get()->result();            
            $list_recent = "";
            foreach ($data as $value) {
                $fichiers = explode(',', $value->piece_jointe);
                foreach ($fichiers as $fichier) {
                    $altern_image = "";
                    $img = ($fichier == "" ) ? base_url() . 'assets/img/team-2.jpg' : base_url() . 'uploads/' . $fichier ;
                    break;
                }
                $list_recent .= '
                    <form action="details" method="post" id="postForm'.$value->id.'" style="cursor: pointer;">

                        <input type="hidden" name="id" value="'.$value->id. '">
                        <li class="clearfix" onclick="detail('.$value->id. ')">
                            <div class="wi"><img src="'.$img.'" alt="recent post" class="img-fluid rounded" /></div>
                            <div class="wb"><strong style="color : black">'.$value->titre.'</strong><br>' .substr($value->resume,0,255). '<span class="post-date"></span></div>
                        </li>   
                    </form>
                ';
            }
            $valeur['list_recent'] = $list_recent;
        //-------------------------------------------------------
        
        $affichage_filter = $this->afficher_filte();
        $valeur['filtre'] = $affichage_filter ;
		$this->load->view('detailsContenu', $valeur);
	}

    //get data par ordre le plus recent et par ordre de priorité
    public function getAllRecentPriorite(){
        return $this->InfoModel->getAllRecentPriorite();
    }
    //--------------------------------------------------------------------

    //---------- ACCUEIL ----------
    public function detailAccueil(){
        $data['info'] = "";
        $id = $this->uri->segment(2);        
        $data= $this->InfoModel->getById($id);
        foreach ($data as $row) {
            $data['titre'] = $row->titre;
            $data['type'] = $row->type;
            $data['resume'] = formaterText($row->resume);
            $data['contenu'] = formaterText($row->contenu);
            $data['piece_jointe'] = $row->piece_jointe;            
        }
        $data['info'] = $this->uri->segment(3); 
        $this->load->view('detailAccueil', $data);
    }
    //---------------------------------------------

    //------ AFFICHAGE INFO FOOTER -------
    public function affichage_info_footer(){
        try {
            $data = $this->db->select("*")->where('etat', 1)
                ->from("info")
                ->where("id_niveau", -1)->limit(9)->get()->result();
            $li_footer='';
            if (count($data) == 0) {
                $ul_footer ='
                        <div class="col-md-4 text-center">
                            <div class="footer-nav-wrap text-white px-4">
                                <h4 class="text-white">MAHAKASIKA ZOKY MANORO</h4>
                                <p class="text-justify">Zoky Manoro dia manoro sy mitarika hianatra.</p>                                
                            </div>
                        </div><hr style="color: black">
                        <div class="col-md-4 text-center">
                            <div class="footer-nav-wrap text-white px-4"><p>Tsidiho ny pejy Facebook <a style="style: none; color: orange" href="https://www.facebook.com/zokymanoro" target="_blank">www.facebook.com/zokymanoro</a></p>
                                <p>na miantso ny laharana Whatsapp <strong style="color: orange">.+261.34.52.928.15.</strong></p>
                                <p>na koa mandefasa hafatra <br><strong style="color: orange"> a d o l p h e @ zokymanoro . com</strong></p>                    
                            </div>
                        </div>

                        <div class="col-md-4 text-center">
                            <div class="footer-nav-wrap text-white">
                                <h4 class="text-white">METY HANAMPY ANAO</h4>
                                <ul class="footer-links">
                                    <li class="nav-item">
                                        <a class="nav-link" href="https://www.zokymanoro.com/" target="_blank">www.zokymanoro.com</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="https://emishop.zokymanoro.com/" target="_blank">emishop.zokymanoro.com</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                ';
            } else {
                foreach ($data as $key => $value) {
                    $li_footer .='   
                        <form action="details" method="post" id="postForm'.$value->id.'">                 
                            <input type="hidden" name="id" value="'.$value->id. '">
                            <li class="nav-item" onclick="detail('.$value->id. ')">
                                <strong style="cursor: pointer; color: orange"">'.$value->titre.'</strong>
                            </li>
                        </form>'
                    ;
                }
                $ul_footer = "
                    <ul class='footer-links'>
                        <h4 class='text-white'>INFORMATIONS</h4>
                        {$li_footer}
                    </ul>
                ";                
            }
            echo $ul_footer;

        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }
    //---------------------------------------------------
}

  