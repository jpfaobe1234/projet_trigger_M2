<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//login
$route['login'] = 'Login/index';
$route['verifier-login'] = 'Login/connexion';
$route['logout'] = 'Login/logout';

//users
$route['utilisateur'] = 'UtilisateurController';
$route['create_user'] = 'UtilisateurController/create_user';
$route['read_utilisateur/(.+)'] = 'UtilisateurController/getUserToEdit/$1';
$route['update_user/(.+)'] = 'UtilisateurController/update_user/$1';
$route['delete_user/(.+)'] = 'UtilisateurController/delete_user/$1';

//---- DEPENSE ---------
$route['depense'] = 'DepenseController';
$route['liste_depense'] = 'DepenseController/liste_depense';
$route['create_depense'] = 'DepenseController/create';
$route['getById_depense'] = 'DepenseController/getById';
$route['update_depense'] = 'DepenseController/update';
$route['delete_depense'] = 'DepenseController/delete';
//---- -------------------------------------------

//---- etablissement ---------
$route['etab'] = 'EtabController';
$route['create_etab'] = 'EtabController/create';
$route['getById_etab'] = 'EtabController/getById';
$route['update_etab'] = 'EtabController/update';
$route['delete_etab'] = 'EtabController/delete';
//---- -------------------------------------------

//---- AUDIT ---------
$route['audit'] = 'AuditController';
//---- -------------------------------------------

