<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail</title>
    <link href="<?php echo base_url('assets/bootstrap.min.css') ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('assets/plugins/fontawesome-free/css/all.min.css') ?>">
    <link href="<?php echo base_url('uploads/zoky_manoro.jpg'); ?>" rel="icon">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="<?php echo base_url('assets/jquery-3.5.1.slim.min.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>
        .image-container {
            margin-top: 20px;
        }
        .summary {
            margin-top: 20px;
            background-color: #eee;
            padding: 20px;
        }
        .content-section {
            margin-top: 20px;
        }
        .content-image {
            width: 100%;
            height: 200px;
        }
        .btn-retour {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
            /* animation: bounce 2s infinite; */
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-30px);
            }
            60% {
                transform: translateY(-15px);
            }
        }

        @media (max-width: 768px) {            
            .respons{
                display : none
            }
            .logo-zokymanoro{
                display: none;
            }
        }
    </style>
    
</head>  
<body>
    <?php include('topBar.php') ?> 
    <header class="header" style="padding-left:20px ; display: flex ; background-color: #F2DEDE ; margin-top: -20px">
        <div class="logo-zokymanoro" style="">
            <a href="<?= base_url('/') ?>">
                <img style="border-radius:35% ;" src="<?php echo base_url('uploads/zoky_manoro.jpg'); ?>" alt="" whidth="250px" height="120px">
            </a>
        </div>
        <div class="respons" style="margin-left: 30%; color: #2C4D6A ; text-align: center">
            <h2 style="padding-top:2%; word-wrap: break-word; max-width: 90%;"><?= strtoupper($titre); ?></h2>         
        </div>
    </header> 
    <div class="container">
        <div class="section">
            <div class="">
                <div class="col-md-8">
                    <div class="summary">
                        <h2><?= strtoupper($titre); ?></h2>
                        <p><?= $resume ?></p>
                    </div>
                    <div class="content-section">
                        <!-- Insérez votre contenu détaillé ici -->
                        <p><?= $contenu ?></p>
                    </div>
                </div>
                <div class="col-md-4 image-container">
                    <?php
                        if (!empty($piece_jointe)) {
                            $fichiers = explode(',', $piece_jointe);
                            foreach ($fichiers as $fichier) {
                                $file_extension = pathinfo($fichier, PATHINFO_EXTENSION);
                                $file_name = pathinfo($fichier, PATHINFO_FILENAME);
                                $file_path = base_url("uploads/".$fichier); 
                                if (in_array($file_extension, ['jpg', 'jpeg', 'png', 'gif', 'PNG'])) {
                                    echo '<div>
                                            <img src="' . $file_path . '" alt="Image de la publication" class="content-image">
                                            <h5 style="text-align: center;">'.$file_name.'</h5>
                                        </div>';
                                }elseif (in_array($file_extension, ['mp4', 'webm', 'ogg'])) {
                                    echo '<div><video width="320" height="240" controls>';
                                    echo '<source src="' . $file_path . '" type="video/mp4" class="content-image">';
                                    echo 'Votre navigateur ne prend pas en charge la lecture de vidéos.';
                                    echo '</video><h5>'.$file_name.'</h5></div>';
                                }elseif (in_array($file_extension, ['mp3', 'ogg', 'wav'])) {
                                    // Si c'est un fichier audio, utilisez la balise <audio>
                                    echo '<div><audio controls>';
                                    echo '<source src="' . $file_path . '" type="audio/mpeg" class="content-image">';
                                    echo 'Votre navigateur ne prend pas en charge la lecture audio.';
                                    echo '</audio></div><h5>'.$file_name.'</h5></div>';
                                }
                            }
                        } 
                    ?>
                </div>
            </div>
        </div>
        <form action="<?php echo site_url('rechercher') ?>" method="POST">
            <input type="hidden" value="<?= $info ?>" name="text_rechercher">
            <?php
                if ($info=="" || $info==NULL) { ?>
                    <a onclick="history.back()" class="btn-retour btn btn-primary"><i class="fas fa-arrow-left"></i> Retour </a>
            <?php
                }else {  ?>
                    <button type="submit" class="btn-retour btn btn-primary"><i class="fas fa-arrow-left"></i> Retour</button>;
            <?php
                }
            ?>
        </form>
    </div>
    <!-- footer -->
    <?php include('footer.php') ?> 
    <!-- footer -->
</body>
</html>