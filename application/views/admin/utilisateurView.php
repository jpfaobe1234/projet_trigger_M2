  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Gérer Comptes Utilisateurs</h1>
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
                  <button type="button" class="btn btn-default btn-lg" data-toggle="modal" data-target="#modal-ajouter" onclick="vider()"><i class="fas fa-plus"> </i> Nouveau</button>
                </div>
                <div class="col-3" id="alert">

                </div>
              </div>
            </div>
            <!-- /.card-header -->

            <!-- card-body -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Prénom</th>
                    <th>Login</th>
                    <th>Type de compte</th>
                    <th>action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    if ($roleUser == 0 || $roleUser == 1) {
                      $whereusers = array(
                        'su_isactive' => 1,
                        'su_role >=' => 1
                      );
                    }else {
                      $whereusers = array(
                        'su_isactive' => 1,
                        'su_id' => $idUser
                      );
                    }
                    
                    $this->db->order_by('su_role', 'DESC');
                    $data = $this->UtilisateurModel->getwhere('systemusers', $whereusers);               
                    foreach ($data as $row):
                  ?>
                  <tr>
                    <td><?php echo $row->su_prenom ?></td>
                    <td><?php echo $row->su_login ?></td>
                    <td>
                    <?php if ($row->su_role == 1): ?>
                      ADMIN
                    <?php else: ?>
                      OPERATEUR DE SAISI
                    <?php endif ?>
                    </td>
                    <td>
                      <?php if ($row->su_role == 0): ?>
                      <?php else: ?>
                        <button class="btn btn-xs btn-info" onclick="edit_user(<?php echo $row->su_id ?>)" title="Editer"><i class="fa fa-edit"></i></button>
                        <a class="btn btn-xs btn-danger" href="<?php echo site_url('delete_user/'.$row->su_id) ?>" title="Supprimer"><i class="fa fa-trash"></i></a>
                      <?php endif ?>
                    </td>
                  </tr>
                  <?php endforeach ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>Prénom</th>
                    <th>Login</th>
                    <th>Type de compte</th>
                    <th>action</th>
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
  <div class="modal fade" id="modal-ajouter" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Créer</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="userForm" action="<?php echo site_url('create_user') ?>" method="POST">
            <input type="text" id="id" name="id" hidden>
            <div class="card-body">
                  <div class="form-group">
                    <label>Prenom</label>
                    <input name="su_prenom" id="su_prenom" type="text" class="form-control" >
                  </div>
                  <div class="form-group">
                    <label>Login</label>
                    <input name="su_login" id="su_login" type="text" class="form-control">
                  </div>
                <div class="form-group">
                  <label>Mot de Passe</label>
                  <input name="su_pass" id="su_pass" type="password" class="form-control">
                </div> 
                <div class="form-group">
                  <label>Retapez le mot de passe</label>
                  <input type="password" name="su_pass" id="su_confpass" class="form-control" placeholder="" required>
                  <div style="text-align: right" id="erroMsgPass"></div>
                </div>
                <div class="form-group">
                  <label>Type de compte</label>
                  <select class="form-control" name="su_role" id="su_role" required>
                      <!-- <option value="0">Super Admin</option> -->
                      <?php if ($roleUser == 2): ?>
                        <option value="2">OPERATEUR DE SAISI</option>
                      <?php else: ?>
                        <option value="1">ADMIN</option>
                        <option value="2">OPERATEUR DE SAISI</option>
                      <?php endif ?>
                  </select>
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


<script>
  $(document).ready(function(){
        $("#su_confpass,#su_pass").on("keyup",function(){
            var pass = $("#su_pass").val();
            var confpass = $("#su_confpass").val();
            if (confpass == '') {
                $("#saveBtn").attr('disabled', true);
                $("#erroMsgPass").html('Retapez le même mot de passe !').css('color','red');
            } else if (pass != confpass) {
                $("#saveBtn").attr('disabled', true);
                $("#erroMsgPass").html('Mots de passe non identiques !').css('color','red');
            } else {
                $("#saveBtn").attr('disabled', false);
                $("#erroMsgPass").html('Mot de passe OK !').css('color','green');
            }
        })
    })

    function vider(){
      $('#userForm')[0].reset()
    }

    function edit_user(id){
        $.ajax({
            url: "<?php echo site_url('read_utilisateur/') ?>" + id,
            dataType: "JSON",
            success:function(user){
                $("#su_prenom").val(user[0].su_prenom);
                $("#su_login").val(user[0].su_login);
                $("#su_pass").val(user[0].su_pass);
                $("#su_confpass").val(user[0].su_pass);
                $("#su_role").val(user[0].su_role);
                $("#saveBtn").attr('disabled', false);
                $("#erroMsgPass").html('');
                $("#userForm").attr('action',"<?php echo site_url('update_user/') ?>"+id);

                $('#modal-ajouter').modal('show');
            }
        })
    }
</script>

