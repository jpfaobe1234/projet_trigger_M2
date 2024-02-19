<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>TRIGGER</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- summernote -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/summernote/summernote-bs4.css') ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/fontawesome-free/css/all.min.css') ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/adminlte.min.css') ?>">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- jQuery -->
  <script src="<?php echo base_url('assets/plugins/jquery/jquery.min.js') ?>"></script>
  <script>
        base_url = "<?php echo base_url(); ?>";
  </script>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <a class="nav-link" href="<?php echo site_url('utilisateur') ?>">Bonjour <i class="fas fa-user"></i> <?= $prenomUser ?></a>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo base_url('uploads/CV.jpg') ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <?php $roleUser = ($roleUser == 1) ? "Administrateur" : "Simple User" ?>
          <a href="#" class="d-block"><?= $roleUser ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          
          <li class="nav-item">
            <a href="<?php echo site_url('depense') ?>" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Gérer Dépense
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo site_url('etab') ?>" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Gérer Etablissement
              </p>
            </a>
          </li>
          <?php if ($roleUser == 1) { ?>
            <li class="nav-item">
              <a href="<?php echo site_url('audit') ?>" class="nav-link">
                <i class="nav-icon fas fa-book"></i>
                <p>
                  Audit
                </p>
              </a>
            </li>
          <?php } ?>
          <li class="nav-item">
            <a href="<?php echo site_url('utilisateur') ?>" class="nav-link">
              <i class="nav-icon far fa-user"></i>
              <p>
                Gérer Utilisateur
              </p>
            </a>
          </li>
          <li class="nav-header">Quitter</li>
          <li class="nav-item info">
            <a href="<?= site_url('logout') ?>" class="nav-link">
              <i class="nav-icon fas fa-trash"></i>
              <p>Déconnecter</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>