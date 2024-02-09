  $(document).ready(function() {
    
    save_method = 'add'; 
  })

  //--- modal ajouter -------
  function modal_etab(){
    vider();
    $("#modal_etab").modal(
      { backdrop: "static", keyboard: false },
      "show"
    );
  }
  //-------------------------------------------

  //--------- ajout dans INFO ----
  $("#form_etab").off().submit(function (e) {
    e.preventDefault();
    var formData = new FormData(this);    
    save_etab(formData);
  })
  //----------------------------------------

  function vider(){
    $("#designation_etab").val("");
    $("#id_etab").val("");
    $('#form_etab')[0].reset()
  }

  //ajouter et modifier am base 
  function save_etab(formData)
  {
    var url;

    if(save_method == 'add') {
        url = base_url+"create_etab";
    } else {
        url = base_url+"update_etab";
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
        $("#modal_etab").modal("hide");
        location.reload();
      },
      error: function(jqXHR, textStatus, errorThrown) {
        // Gestion des erreurs en cas d'échec de la requête
        alert("erreur Enregistrement"+ textStatus);
        console.error("Erreur lors de l'insertion des données : " + textStatus);
      }
    });
  }

  function editer_etab(id){
      save_method = 'update';
      $('#form_etab')[0].reset(); // reset form on modals
      $('.form-group').removeClass('has-error'); // clear error class
      $('.help-block').empty(); //clear error string

      var id = {"id_etab":id };
      //Ajax Load data from ajax
      $.ajax({
          url : base_url+"getById_etab",
          data:id,
          type: "POST",
          dataType: "JSON",
          success: function(data)
          {
              console.log(data);
              var client = data[0];
              $('[name="id_etab"]').val(client.id_etab);
              $('[name="nom_etab"]').val(client.nom_etab);
              $('[name="budget"]').val(client.budget);
            
              $("#modal_etab").modal(
                { backdrop: "static", keyboard: false },
                "show"
              );
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
              alert('Error get data from ajax');
          }
      });
  }

  ///---- confirme delete NIVEAU ------
  function confirm_delete_etab(id_depense){
    $('#id_delete_etab').val(id_depense);
    $("#confirm_delete_etab").modal(
      { backdrop: "static", keyboard: false },
      "show"
    );
  }
  // ----------------------------------------------

  //---- ajout dans INFO ----
  $("#form_delete_etab").submit(function (e) {
    e.preventDefault();
    // alert(e);
    supprimer_etab();
  })
  //-------------------------------

  //------- SUPPRESION NIVEAU ---------
  function supprimer_etab(){
    var id = {"id_etab": $("#id_delete_etab").val() };
    //Ajax Load data from ajax
    $.ajax({
      url : base_url+"delete_etab",
      data:id,
      type: "POST",
      dataType: "JSON",
      success: function(data)
      {
        $("#confirm_delete_etab").modal('hide');
        location.reload();
      },
      error: function (jqXHR, textStatus, errorThrown)
      {
        alert('Error deletting data from ajax');
      }
    });    
  }
  //----------------------------------------------------------

