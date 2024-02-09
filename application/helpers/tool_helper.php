<?php

    function formaterText($text){

        $contenuFormate = $text;
        // Convertir les sauts de ligne en <br>
        $contenuFormate = nl2br($contenuFormate);

        // Remplacer les espaces multiples par des &nbsp;
        $contenuFormate = preg_replace('/ {2,}/', str_repeat('&nbsp;', 8), $contenuFormate);

        // Convertir le texte en gras : **texte** devient <strong>texte</strong>
        $contenuFormate = preg_replace('/\*\*(.*?)\*\*/', '<strong>$1</strong>', $contenuFormate);

        // Convertir le texte souligné : __texte__ devient <u>texte</u>
        $contenuFormate = preg_replace('/__(.*?)__/', '<u>$1</u>', $contenuFormate);

    return $contenuFormate;
    }

    function get_roleValue_byId($id)
    {
        $CI = &get_instance();
        $sql = "SELECT `su_role` FROM `systemusers` WHERE `su_id` = $id";
        $result = $CI->db->query($sql)->result();
        return $result[0]->su_role;
    }

    function get_userName_byId($id)
    {
        $CI = &get_instance();
        $sql = "SELECT `su_prenom` FROM `systemusers` WHERE `su_id` = $id";
        $result = $CI->db->query($sql)->result();
        return $result[0]->su_prenom;
    }