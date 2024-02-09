  $(document).ready(function() {
    
    save_method = 'add'; 
  })

  //--- modal ajouter -------
  function modal_niveau(){
    vider();
    $("#modal_niveau").modal(
      { backdrop: "static", keyboard: false },
      "show"
    );
  }
  //-------------------------------------------

  //--------- ajout dans INFO ----
  $("#form_niveau").off().submit(function (e) {
    e.preventDefault();
    var formData = new FormData(this);    
    save_niveau(formData);
  })
  //----------------------------------------

  //------ affichage NIVEAU ------
  function liste_niveau() {
    $.ajax({
      url : base_url+"liste_niveau",
      type: "POST",
      success: function(tbody_niveau)
      {
        console.log(tbody_niveau);
        $('#example1').empty("");
        $('#example1').append(tbody_niveau);
      }
    })
  }
  //--------------------------------------

  function vider(){
    $("#designation_niveau").val("");
    $("#id_niveau").val("");
    $('#form_niveau')[0].reset()
  }

  //ajouter et modifier am base 
  function save_niveau(formData)
  {
    var url;

    if(save_method == 'add') {
        url = base_url+"create_niveau";
    } else {
        url = base_url+"update_niveau";
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
        $("#modal_niveau").modal("hide");
        location.reload();
      },
      error: function(jqXHR, textStatus, errorThrown) {
        // Gestion des erreurs en cas d'échec de la requête
        alert("erreur Enregistrement"+ textStatus);
        console.error("Erreur lors de l'insertion des données : " + textStatus);
      }
    });
  }

  function editer_niveau(id){
      save_method = 'update';
      $('#form_niveau')[0].reset(); // reset form on modals
      $('.form-group').removeClass('has-error'); // clear error class
      $('.help-block').empty(); // clear error string

      var id = {"id":id };
      //Ajax Load data from ajax
      $.ajax({
          url : base_url+"getById_niveau",
          data:id,
          type: "POST",
          dataType: "JSON",
          success: function(data)
          {
              console.log(data);
              var client = data[0];
              // Remplir les champs du formulaire avec les données du client
              $('[name="id_niveau"]').val(client.id_niveau);
              $('[name="designation_niveau"]').val(client.designation);
            
              $("#modal_niveau").modal(
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
  function confirm_delete_niveau(id_niveau){
    $('#id_delete_niveau').val(id_niveau);
    $("#confirm_delete_niveau").modal(
      { backdrop: "static", keyboard: false },
      "show"
    );
  }
  // ----------------------------------------------

  //---- ajout dans INFO ----
  $("#form_delete_niveau").submit(function (e) {
    e.preventDefault();
    // alert(e);
    supprimer_niveau();
  })
  //-------------------------------

  //------- SUPPRESION NIVEAU ---------
  function supprimer_niveau(){
    var id = {"id_niveau": $("#id_delete_niveau").val() };
    //Ajax Load data from ajax
    $.ajax({
      url : base_url+"delete_niveau",
      data:id,
      type: "POST",
      dataType: "JSON",
      success: function(data)
      {
        $("#confirm_delete_niveau").modal('hide');
        location.reload();
      },
      error: function (jqXHR, textStatus, errorThrown)
      {
        alert('Error deletting data from ajax');
      }
    });    
  }
  //----------------------------------------------------------

