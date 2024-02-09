$(document).ready(function() {
    affichage_info_footer();
})
//-------------FIN READY -------------------

//----- AFICHAGE INFO FOOTER --------
function affichage_info_footer(){
    $.ajax({
        type: "POST",
        url: base_url+'AccueilController/affichage_info_footer',
        contentType: false,
        processData: false,
        success: function(liste_info_footer) {
            $('#liste_info_footer').empty();
            $('#liste_info_footer').html(liste_info_footer);
        }
    })
}
//---------------------------------------------------