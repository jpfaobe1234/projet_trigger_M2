$(document).ready(function() {
    // affichage_info_footer();
})
//-------------FIN READY -------------------

function detail(id) {
    $('#postForm'+id).submit();
}
//----- AFICHAGE INFO FOOTER --------
function affichage_info_footer(){
    $.ajax({
        type: "POST",
        url: base_url+'AccueilController/affichage_info_footer',
        contentType: false,
        processData: false,
        success: function(card) {
            $('#liste_info_footer').empty();
            $('#liste_info_footer').html(card);
        }
    })
}
//---------------------------------------------------

//-------- recherche filtrer ---------
$("#form_filter").off().submit(function (e) {
    e.preventDefault();
    var formData = new FormData(this); 
    afficher_recherche_filte(formData);
})

//------ affichage RECHERCHE FILTRE -----
function afficher_recherche_filte(formData){
    $.ajax({
        type: "POST",
        url: base_url+'AccueilController/recherche_filter',
        data: formData,
        contentType: false,
        processData: false,
        success: function(card) {
            // window.location.href = 'accueil';
            $('#affichage_card').empty();
            $('#affichage_card').html(card);
        }
    })
}
