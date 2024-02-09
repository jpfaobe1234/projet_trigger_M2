  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Gérer Etablissement</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <!-- card-header -->
            <div class="card-header">
              <div class="row">
                <div class="col-3">                  
                  <button type="button" class="btn btn-default btn-lg" onclick="modal_etab()"><i class="fas fa-plus"> </i> Nouveau</button>
                </div>
                <div class="col-3" id="alert_etab">

                </div>
              </div>
            </div>
            <!-- /.card-header -->

            <!-- card-body -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nom Etab</th>                    
                    <th>Budget</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody id="tbody_etab">
                  <?php 
                      $data = $this->db->get('etablissement')->result();               
                      foreach ($data as $row):
                    ?>
                    <tr>
                      <td><?php echo $row->id_etab ?></td>
                      <td><?php echo $row->nom_etab ?></td>
                      <td><?php echo $row->budget ?> Ar</td>
                      <td>
                        <button class="btn btn-xs btn-info" onclick="editer_etab(<?php echo $row->id_etab ?>)" title="Editer"><i class="fa fa-edit"></i></button>
                        <button class="btn btn-xs btn-danger" onclick="confirm_delete_etab(<?php echo $row->id_etab ?>)" title="Supprimer"><i class="fa fa-trash"></i></button>
                      </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>Etablissement</th>                    
                    <th>Dépense</th>
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
  <div class="modal fade" id="modal_etab" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Créer</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="form_etab" method="POST">
            <input type="text" id="id_etab" name="id_etab">
            <div class="card-body">
              <div class="form-group">
                <label>Nom Etablissement</label>
                  <input name="nom_etab" id="nom_etab" type="text" class="form-control" required>
              </div> 
              
              <div class="form-group">
                  <label>Budget</label>
                  <input name="budget" id="budget" type="number" class="form-control" required>
              </div>
            </div>
            <!-- /.card-body -->        
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
          <button type="submit" id="saveBtn" class="btn btn-primary">Sauvegarder</button>
        </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /modal ajouter -->

    <!-- Delete Modal HTML -->
    <div id="confirm_delete_etab" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content" id="form_delete_etab">
          <form method="POST">
            <div class="modal-header">						
              <h4 class="modal-title">Suppression</h4>
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
              <input type="hidden" id="id_delete_etab" name="id_delete_etab">
              <p>Voulez-vous vraiment supprimer ???</p>
              <p class="text-warning">Cette acion est irrenversible</p>
            </div>
            <div class="modal-footer">
              <input type="button" class="btn btn-default" data-dismiss="modal" value="Non">
              <input type="submit" class="btn btn-danger" name="btnDelete" value="Oui">
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- Delete  -->

  <script src="<?= base_url('assets/js_jp/etab.js') ?>"></script>
