<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zoky Manoro - Accueil</title>
    <!-- <link href="<?php echo base_url('assets/index.css') ?>" rel="stylesheet" /> -->
    <link href="<?php echo base_url('assets/bootstrap.min.css') ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('assets/plugins/fontawesome-free/css/all.min.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="<?php echo base_url('assets/jquery-3.2.1.min.js') ?>"></script> 

    
    <link href="<?php echo base_url('uploads/zoky_manoro.jpg'); ?>" rel="icon">

    <style>        
        body{
           
        }
        /* Style pour les cartes de publication */
        .carree {
            display: flex;
            flex-wrap: wrap;
            /* justify-content: space-between; */
            padding: 20px;
            
        }

        .card {
            position: relative;
            flex: 0 1 calc(25% - 20px); /* Rendre les cartes plus petites sur les grands écrans */
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin: 10px;
            height: 400px;
        }
        .card:hover {
            transform: scale(1.05);
            transition: transform 0.3s ease-in-out;
        }
        .card-header{
            height: 15%;
            overflow-y: auto;
        } 
        .card-body {
            /* padding: 20px; */
            height: 60%;
        }
        .card-footer{
            height: 25%;
            overflow-y: auto;
        } 
        .card-body img, video, audio, .video {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 8px 8px 0 0;
        }    

        .card h2 {
            font-size: 200px;
            margin: 0 0 5px;
        }
        .card h1 {
            font-size: 20px;
            margin: 0 0 10px;
        }

        .card p {
            font-size: 18px;
            color: black;
            margin: 0;
        }
        .first-group{
            width: 100%
        }
        .btn-detail {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .card:hover .btn-detail {
            opacity: 1;
        }

        @media (max-width: 992px) {
            .card {
                flex: 0 1 calc(50% - 20px); /* 2 cartes par ligne sur les écrans moyens */
            }
            .logo-zokymanoro{
                display: none;
            }
        }

        @media (max-width: 768px) {
            .carree {
                padding: 10px;
            }
            .card {
                flex: 0 1 calc(50% - 20px); /* 2 cartes par ligne sur les petits écrans */
            }
            .logo-zokymanoro{
                display: none;
            }
            .respons{
                display : none
            }
        }

        @media (max-width: 576px) {
            .card {
                flex: 0 1 90%; /* 1 carte par ligne sur les très petits écrans */
            }
            .card-body {
                /* padding: 20px; */
                height: 250px;
            }
        }
        

    
    </style>
    
</head>  
<body>
    <?php include('topBar.php') ?> 
    <header class="header" style="padding-left:20px; display: flex ; background-color:#F2DEDE ; margin-top: -20px">
        <div class="logo-zokymanoro" style="">
            <a href="<?= base_url('/') ?>">
                <img style="border-radius:35% ;" src="<?php echo base_url('uploads/zoky_manoro.jpg'); ?>" alt="" whidth="250px" height="120px">
            </a>
        </div>
        <div class="respons" style="color: #2C4D6A ; text-align: center">
            <h2 style="margin-left: 40%;">
                    TONGASOA ETO @ TRANOKALA ZOKY MANORO
            </h2> 
        </div>
    </header>

    <!-- barre de recherche -->
    <style>
        .search-container {
            max-width: 680px;
            margin: 20px auto;
        }

        .search-box {
            display: flex;
            align-items: center;
            border: 1px solid #dfe1e5;
            border-radius: 24px;
            padding: 10px 20px;
            box-shadow: 0 1px 6px rgba(32,33,36,0.28);
        }

        .search-box input[type="search"] {
            border: none;
            margin-right: 10px;
            font-size: 16px;
            width: 100%;
        }

        .search-box input[type="search"]:focus {
            outline: none;
        }

        .search-box button {
            background: none;
            border: none;
            padding: 0;
            cursor: pointer;
        }

        .search-box img {
            width: 20px;
            height: 20px;
        }

    </style>
    <div class="search-container">
        <form action="<?php echo site_url('rechercher') ?>" method="POST">
            <div class="search-box">
                <input type="search" name="text_rechercher" placeholder="Soratana eto ...">
                <button type="submit">
                    <i class="fa fa-search"></i>
                </button>     
            </div>
        </form>
    </div>

    <!-- fin barre de recherche -->
    <div class="section">
        <div class="carree" id="carree">
            <?php 
                if ($data == NULL) { ?>
                    <div class="alert alert-danger" style="margin-left: 10% ; justify-content: center">
                        <h1>Tsy misy misy ato amin'ny Zoky Manoro ny zavatra tadivinao</h1>
                        <a href="<?= base_url("accueil")?>" class="alert-link">Tsindrio eto raha hiverina</a>
                    </div>
            <?php  } 
                foreach ($data as $row):
            ?>
                <div class="card">
                        <div class="card-header">
                            <h1>
                                <?= strtoupper($row->titre) ?> 

                            </h1>
                        </div>               
                        <div class="card-body" id="cart" onclick="location.href='<?php echo site_url('detailAccueil/'.$row->id.'/'.$info) ?>'">
                            <?php
                                $fichiers = explode(',', $row->piece_jointe);
                                foreach ($fichiers as $fichier) {
                                    $resume = formaterText($row->resume);
                            ?>
                            <img src="<?php echo base_url("uploads/".$fichier); ?>" alt="" class="img-fluid">
                            <?php   
                                break;                   
                                } 
                            ?>
                        </div>
                        <div class="card-footer">
                            <p style=""><?= ($resume) ?></p>
                        </div>
                    </div>

            <?php endforeach ?>
            
        </div>
    </div>   

    <!-- footer -->
    <?php include('footer.php') ?> 
    <!-- footer -->
    
    <script>

        $(document).ready(function(){
            $("#post_title").on("keyup", function(){
                var value = $(this).val();
            })
        })

        
        
    </script>
</body>
</html>