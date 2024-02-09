

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Gérer Informations</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <div class="row">
                <div class="col-3">                  
                  <button type="button" class="btn btn-default btn-lg" onclick="modal_info()"><i class="fas fa-plus"> </i> Nouveau</button>
                </div>
                <div class="col-3" id="alert">

                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Titre</th>
                    <th>Catégorie</th>
                    <th>Priorité</th>
                    <th>Accès</th>
                    <th>Pieces jointes</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    $n = 1;
                    $data = $this->db->select('info.*, 
                      categori.nomCategori AS design_categorie, 
                      niveau.designation AS design_niveau,
                      acces.designation AS design_acces')
                      ->join('categori', 'categori.id = info.id_categorie', 'left')
                      ->join('niveau', 'niveau.id_niveau = info.id_niveau', 'left')
                      ->join('acces', 'acces.id_acces = info.id_acces', 'left')
                      ->where('info.etat', 1)->get('info')->result();
                    foreach ($data as $row):                    
                  ?>
                  <tr>
                    <td><?php echo $n++ ?></td>
                    <td><?php echo $row->titre ?></td>
                    <td><?php echo $row->design_categorie ?></td>
                    <td><?php echo $row->design_niveau ?></td>
                    <td><?php echo $row->design_acces ?></td>
                    <td>
                      <?php
                          $fichiers = explode(',', $row->piece_jointe);
                              foreach ($fichiers as $fichier) {
                      ?>
                      <a href="<?php echo base_url("uploads/".$fichier); ?>" class="view_piece"><?php echo ($fichier=="")?("Aucune image"):($fichier)  ?><br></a>                      
                      <?php } ?>
                    </td>
                    <td>
                      <?php if ($roleUser == 0 || $roleUser == 1): ?>
                        <a href="<?php echo site_url('detailAccueil/'.$row->id) ?>" >
                          <a class="primary primary mr-1" title="Voir detail"><i class="fa fa-list-alt"></i></a>
                        </a>
                        <a class="info info text-green" href="#" onclick="editer(<?php echo $row->id ?>)" title="Editer"><i class="fa fa-edit"></i></button>
                        <a class="danger danger mr-1 text-red" onclick="$('#delete_id').val(`<?php echo $row->id ?>`)" href="#deleteEmployeeModal" data-toggle="modal" title="Supprimer"><i class="fa fa-trash"></i></a>
                      <?php else: ?>
                        <a href="<?php echo site_url('detailAccueil/'.$row->id) ?>" >
                          <a class="primary primary mr-1" title="Voir detail"><i class="fa fa-list-alt"></i></a>
                        </a>
                        <button class="btn btn-xs btn-info" onclick="editer(<?php echo $row->id ?>)" title="Editer"><i class="fa fa-edit"></i></button>
                      <?php endif ?>
                        </td>
                  </tr>                                        
                  <?php endforeach ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>#</th>
                    <th>Titre</th>
                    <th>Catégorie</th>
                    <th>Priorité</th>
                    <th>Accès</th>
                    <th>Pieces jointes</th>
                    <th>Action</th>
                  </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- modal ajouter -->
  <div class="modal fade" id="modal_info" static style="display: none; overflow:scroll" aria-hidden="true">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Formulaire</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form role="form" id="form">
            <input type="text" id="id" name="id" hidden>
            <div class="card-body">

              <div class="row">
                <div class="col-md-7">
                  <div class="form-group">
                    <label>Titre</label>
                    <input name="titre" id="titre" type="text" class="form-control" required>
                  </div>
                </div> 
                <div class="col-md-5">
                  <div class="form-group">
                    <label>Fichiers</label>
                    <input name="piece_jointe" id="piece_jointe" type="file" accept="image/*" class="form-control-file" multiple>
                    <p id="piece_jointe_label" style="width: auto"></p>
                  </div>
                </div>
              </div>

              <div class="col-12">
                <div class="form-group">
                  <label>Résumé du contenu</label>
                  <textarea class="form-control" name="resume" id="resume" style="height:50px"></textarea>
                </div>  
                <div class="form-group">
                  <label>Contenu</label>
                  <textarea class="form-control" name="contenu" id="contenu" style="height:100px"></textarea>
                </div>
              </div>
              
              <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <label>Catégorie</label>
                    <select class="form-control" name="categorie" id="categorie" required>
                      <option value=""></option>
                      <?php 
                        $categories = $this->CategoriModel->getAll();
                        foreach ($categories as $categori) { ?>
                          <option value="<?= $categori->id?>"><?= $categori->nomCategori?></option>                       
                      <?php
                        }
                      ?>
                      <!-- <option value="0">Autres</option> -->
                    </select>
                  </div>
                </div> 
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Ordre de priorité</label>
                    <select class="form-control" name="niveau" id="niveau" required>
                      <option value=""></option>
                      <?php 
                          $niveaux = $this->db->where_in('etat', array(1, -1))
                            ->order_by('etat', 'ASC')
                            ->order_by('designation', 'ASC')
                            ->get('niveau')->result();
                          foreach ($niveaux as $niveau) { ?>
                            <option value="<?= $niveau->id_niveau?>"><?= $niveau->designation?></option>                       
                        <?php
                          }
                        ?>   
                        <!-- <option value="0">Autres</option>                   -->
                    </select>
                  </div> 
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Accès</label>
                    <select class="form-control" name="acces" id="acces" required>
                      <?php 
                          $access = $this->db->where('etat', 1)->get('acces')->result();
                          foreach ($access as $acces) { ?>
                            <option value="<?= $acces->id_acces ?>"><?= $acces->designation?></option>                       
                        <?php
                          }
                        ?>                      
                    </select>
                  </div>
                </div> 
              </div>
            </div>
            <!-- /.card-body -->        
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
          <button type="button" class="btn btn-secondary" onclick="modal_sous_titre()"><i>+</i> Ajouter Sous-titre</button>
          <button type="submit" class="btn btn-primary">Sauvegarder</button>
        </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /modal ajouter -->

<!-- modal SOUT-TITRE -->
<div class="modal fade" id="modal_sous_titre" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Formulaire Sous-titre</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form role="form" id="form_sous_titre" method="POST">
          <div class="modal-body">
            <input type="text" id="index_sous_titre" name="index_sous_titre">
            <div class="card-body">

              <div class="row">
                <div class="col-md-7">
                  <div class="form-group">
                    <label>Titre</label>
                    <input name="sous_titre" id="sous_titre" type="text" class="form-control" required>
                  </div>
                </div>                
                <div class="col-md-5">
                  <div class="form-group">
                    <label>Fichiers</label>
                    <input name="piece_jointe_sous_titre" id="piece_jointe_sous_titre" type="file" accept="image/*" class="form-control-file" multiple>
                    <p id="piece_jointe_label_sous_titre"></p>
                  </div> 
                </div>
              </div>

              <div class="col-12"> 
                <div class="form-group">
                  <label>Contenu</label>
                  <textarea class="form-control" name="contenu_sout_titre" id="contenu_sout_titre" style="height: 200px" required></textarea>
                </div>
              </div>
            </div>
            <!-- /.card-body -->        
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
              <button type="submit" class="btn btn-primary" onclick="">Sauvegarder</button>
            </div>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /modal SOUT-TITRE -->

  <!-- Delete Modal HTML -->
  <div id="deleteEmployeeModal" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="#" method="POST">
          <div class="modal-header">						
            <h4 class="modal-title"></h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
          <input type="hidden" id="delete_id" name="delete_id">
            <p>Voulez-vous vraiment supprimer ???</p>
            <p class="text-warning">Cette acion est irrenversible</p>
          </div>
          <div class="modal-footer">
            <input type="button" class="btn btn-default" data-dismiss="modal" value="Non">
            <input type="submit" onclick="supprimer()" class="btn btn-danger" name="btnDelete" value="Oui">
          </div>
        </form>
      </div>
    </div>
  </div>

<script src="<?= base_url('assets/js_jp/info.js') ?>"></script>


 
  