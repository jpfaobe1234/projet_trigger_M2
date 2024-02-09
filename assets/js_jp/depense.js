  $(document).ready(function() {
    
    save_method = 'add'; 
  })

  //--- modal ajouter -------
  function modal_depense(){
    vider();
    $("#modal_depense").modal(
      { backdrop: "static", keyboard: false },
      "show"
    );
  }
  //-------------------------------------------

  //--------- ajout dans INFO ----
  $("#form_depense").off().submit(function (e) {
    e.preventDefault();
    var formData = new FormData(this);    
    save_depense(formData);
  })
  //----------------------------------------

  //------ affichage NIVEAU ------
  function liste_depense() {
    $.ajax({
      url : base_url+"liste_depense",
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
    $("#designation_depense").val("");
    $("#id_depense").val("");
    $('#form_depense')[0].reset()
  }

  //ajouter et modifier am base 
  function save_depense(formData)
  {
    var url;

    if(save_method == 'add') {
        url = base_url+"create_depense";
    } else {
        url = base_url+"update_depense";
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
        $("#modal_depense").modal("hide");
        location.reload();
      },
      error: function(jqXHR, textStatus, errorThrown) {
        // Gestion des erreurs en cas d'échec de la requête
        alert("erreur Enregistrement"+ textStatus);
        console.error("Erreur lors de l'insertion des données : " + textStatus);
      }
    });
  }

  function editer_depense(id){
      save_method = 'update';
      $('#form_depense')[0].reset(); // reset form on modals
      $('.form-group').removeClass('has-error'); // clear error class
      $('.help-block').empty(); // clear error string

      var id = {"id":id };
      //Ajax Load data from ajax
      $.ajax({
          url : base_url+"getById_depense",
          data:id,
          type: "POST",
          dataType: "JSON",
          success: function(data)
          {
              console.log(data);
              var client = data[0];
              // Remplir les champs du formulaire avec les données du client
              $('[name="id_depense"]').val(client.id_dep);
              $('[name="etab"]').val(client.id_etab);
              $('[name="depense"]').val(client.dep);
            
              $("#modal_depense").modal(
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
  function confirm_delete_depense(id_depense){
    $('#id_delete_depense').val(id_depense);
    $("#confirm_delete_depense").modal(
      { backdrop: "static", keyboard: false },
      "show"
    );
  }
  // ----------------------------------------------

  //---- ajout dans INFO ----
  $("#form_delete_depense").submit(function (e) {
    e.preventDefault();
    // alert(e);
    supprimer_depense();
  })
  //-------------------------------

  //------- SUPPRESION NIVEAU ---------
  function supprimer_depense(){
    var id = {"id_depense": $("#id_delete_depense").val() };
    //Ajax Load data from ajax
    $.ajax({
      url : base_url+"delete_depense",
      data:id,
      type: "POST",
      dataType: "JSON",
      success: function(data)
      {
        $("#confirm_delete_depense").modal('hide');
        location.reload();
      },
      error: function (jqXHR, textStatus, errorThrown)
      {
        alert('Error deletting data from ajax');
      }
    });    
  }
  //----------------------------------------------------------

