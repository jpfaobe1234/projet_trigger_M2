  $(document).ready(function() {
    
  })

  //--- modal ajouter INFOS -------
  function modal_info(){
    vider();
    save_method = 'add'; 
    $("#modal_info").modal(
      { backdrop: "static", keyboard: false },
      "show"
    );
  }
  //-------------------------------------------

  
  $('.view_piece').on('click', function(e) {
    e.preventDefault();
    window.open($(this).attr('href'), '_blank');
  }); 

  //---- ajout dans INFO ----
  $("#form").off().submit(function (e) {
    e.preventDefault();
    var formData = new FormData(this);     
    formData.append('piece_jointe_label', $("#piece_jointe_label").text());
    formData.append('index_sous_titre', $("#index_sous_titre").val());
    // formData.append('piece_jointe', "");
    
    var files = $('#piece_jointe')[0].files;
    if(files.length > 0){
      for (var i = 0; i < files.length; i++) {
        formData.append('piece_jointe[]', files[i]);
      }   
    }
    
    save(formData);
    // location.reload();
  })
  //---------------------------------

  //--- ajout dans sous-titre ----
  $("#form_sous_titre").submit(function (e) {
    e.preventDefault();
    var formData = new FormData(); 
    formData.append('index_sous_titre', $("#index_sous_titre").val());
    formData.append('sous_titre', $("#sous_titre").val());
    formData.append('contenu_sout_titre', $("#contenu_sout_titre").val());    
    var files = $('#piece_jointe_sous_titre')[0].files;
    if(files.length > 0){
      for (var i = 0; i < files.length; i++) {
        formData.append('piece_jointe_sous_titre[]', files[i]);
      }
    }else{
      formData.append('piece_jointe_sous_titre', '');
    }

    console.log("get from data ".formData);

    $.ajax({
      type: "POST",
      url: base_url+'add_sous_titre',
      dataType: "JSON",
      data: formData,
      contentType: false,
      processData: false,
      success: function(response) {
        $("#modal_sous_titre").modal("hide");
        alert("Ok !!! Reussit");
        plus_sous_titre();
      },
      error: function(jqXHR, textStatus, errorThrown) {
        // Gestion des erreurs en cas d'échec de la requête
        alert("erreur Enregistrement"+ textStatus);
        console.error("Erreur lors de l'insertion des données : " + textStatus);
      }
    });
  })
  //------------------------------------------------------------------

  //-- modal sous-titre ------
  function modal_sous_titre(){
    $("#modal_sous_titre").insertAfter("#modal-ajouter");
    let verif_index = $('#index_sous_titre').val();
    let dateIndex = new Date();
    let index = (verif_index=="") ? (Math.floor(dateIndex.getTime())) : (verif_index);
    $('#index_sous_titre').val(index);
    // $("#modal-ajouter").block();
    $("#modal_sous_titre").modal(
      { backdrop: "static", keyboard: false },
      "show"
    );
  }
  //---------------------------

  //---- Plus sous-titre ---------
  function plus_sous_titre(){
    $('#sous_titre').val("");
    $('#piece_jointe_sous_titre').val("");
    $('#contenu_sout_titre').val("");
  }
  //---------------------------------

  function vider(){
    $("#piece_jointe_label").text("");
    $("#index_sous_titre").val("");
    $('#form')[0].reset()
  }

  //ajouter et modifier am base 
  function save(formData) {
    var url;

    if(save_method == 'add') {
          url = base_url+"add_info";
      } else {
          url = base_url+"update_info";
      }
    $.ajax({
      type: "POST",
      url: url,
      dataType: "JSON",
      data: formData,
      contentType: false,
        processData: false,
      success: function(response) {
        alert("Ok !!! Reussit");
        vider();
        $("#modal_info").modal("hide");
        location.reload();
      },
      error: function(jqXHR, textStatus, errorThrown) {
        // Gestion des erreurs en cas d'échec de la requête
        alert("erreur Enregistrement"+ textStatus);
        console.error("Erreur lors de l'insertion des données : " + textStatus);
      }
    });
  }

  function editer(id){
    save_method = 'update';

      $('#form')[0].reset(); // reset form on modals
      $('.form-group').removeClass('has-error'); // clear error class
      $('.help-block').empty(); // clear error string
      $('.modal-title').text("FORMULAIRE"); 

      var id = {"id":id };
      //Ajax Load data from ajax
      $.ajax({
          url : base_url+"read_info",
          data:id,
          type: "POST",
          dataType: "JSON",
          success: function(data)
          {
              console.log(data);
                      var client = data[0];
              // Remplir les champs du formulaire avec les données du client
              $('[name="id"]').val(client.id);
              $('[name="categorie"]').val(client.id_categorie);
              $('[name="titre"]').val(client.titre);
              $('[name="resume"]').val(client.resume);
              $('[name="contenu"]').val(client.contenu);
              $('[name="niveau"]').val(client.id_niveau);
              $('[name="acces"]').val(client.id_acces);

              $('#piece_jointe_label').text(client.piece_jointe);

              $("#modal_info").modal(
                { backdrop: "static", keyboard: false },
                "show"
              );
              // alert($("#piece_jointe_label").text());
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
              alert('Error get data from ajax');
          }
      });
  }

  function supprimer(){
    var id = {"id": $("#delete_id").val() };
    //Ajax Load data from ajax
    $.ajax({
      url : base_url+"delete_info",
      data:id,
      type: "POST",
      dataType: "JSON",
      success: function(data)
      {
        var alert = `<div class="alert alert-success alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert">&times;</button>
                      <strong>Reussit!</strong>
                    </div>`;
        $('#alert').html(alert);
        location.reload();
      },
      error: function (jqXHR, textStatus, errorThrown)
      {
        alert('Error deletting data from ajax');
      }
    });
    
  }

