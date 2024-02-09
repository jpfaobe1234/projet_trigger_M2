  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Gérer Comptes Catégorie</h1>
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
                    <th>Nom Catégorie</th>
                    <th>action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    $data = $this->CategoriModel->getAll();               
                    foreach ($data as $row):
                  ?>
                  <tr>
                    <td><?php echo $row->nomCategori ?></td>
                    <td>
                      <button class="btn btn-xs btn-info" onclick="edit_categori(<?php echo $row->id ?>)" title="Editer"><i class="fa fa-edit"></i></button>
                      <a class="btn btn-xs btn-danger" href="<?php echo site_url('delete_categori/'.$row->id) ?>" title="Supprimer"><i class="fa fa-trash"></i></a>
                    </td>
                  </tr>
                  <?php endforeach ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>Nom Catégorie</th>
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
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Créer</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="userForm" action="<?php echo site_url('create_categori') ?>" method="POST">
            <input type="text" id="id" name="id" hidden>
            <div class="card-body">
              <div class="form-group">
                <label>Nom Catégorie</label>
                <input name="nomCategori" id="nomCategori" type="text" class="form-control" >
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
        
    })

    function vider(){
      $('#userForm')[0].reset()
    }

    function edit_categori(id){
        $.ajax({
            url: "<?php echo site_url('getUserToEdit/') ?>" + id,
            dataType: "JSON",
            success:function(user){
                $("#nomCategori").val(user[0].nomCategori);
                $("#userForm").attr('action',"<?php echo site_url('update_categori/') ?>"+id);

                $('#modal-ajouter').modal('show');
            }
        })
    }
</script>

