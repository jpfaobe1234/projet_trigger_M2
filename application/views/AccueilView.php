<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">



    <title>Zoky Manoro - Accueil</title>
    <link rel="icon" href="<?php echo base_url('uploads/zoky_manoro.jpg') ?>" type="image/png" sizes="16x16">

    <!-- <link href="<?php echo base_url('assets/index.css') ?>" rel="stylesheet" /> -->
    <!-- <link href="<?php echo base_url('assets/bootstrap.min.css') ?>" rel="stylesheet"> -->
    <link href="<?php echo base_url('assets/css/css2.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/main.css') ?>" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo base_url('assets/plugins/fontawesome-free/css/all.min.css') ?>">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->

    <link href="<?php echo base_url('assets/css/custom.css') ?>" rel="stylesheet">


    <!-- SEO Meta description -->
    <!-- <meta name="description" content="Hostlar hosting template designed for all web hosting, business, multi purpose, domain sale websites, online business, personal hosting company and similar sites and many more.">
    <meta name="author" content="ThemeTags"> -->

    <script>
        base_url = "<?php echo base_url(); ?>";
    </script>

    <style>
        .single-blog-card:hover {
            transform: scale(1.05);
            transition: transform 0.3s ease-in-out;
            box-shadow: 0 6px 16px rgba(32,33,36,0.28);
        }
        .single-blog-card {
            box-shadow: 0 1px 6px rgba(332,33,36,0.28);
        }

    </style>
</head>

<body>

    <!--loader start-->
    <div id="preloader">
        <div class="loader1">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <!--loader end-->
    <!--header section start-->
    <?php include('Header/header.php') ?>
    <!--header section end-->

    <div class="main">

        <!--page hero section start  style="background: url('assets/img/hero-14.jpg')no-repeat center center / cover" -->
        <?php include('Hero/hero.php') ?>
        <!--page hero section end-->

        <!--blog section start-->
        <section class="our-blog-section ptb-100 gray-light-bg">
            <div class="container">
               
                <!-- Layout Filtre -->
                <?php include('Filtre/filtre.php') ?>

                <!--pagination start-->
                <!-- <div class="row">
                    <div class="col-md-12">
                        <nav class="custom-pagination-nav mt-4">
                            <ul class="pagination justify-content-center">
                                <li class="page-item"><a class="page-link" href="#"><span class="ti-angle-left"></span></a></li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#"><span class="ti-angle-right"></span></a></li>
                            </ul>
                        </nav>
                    </div>
                </div> -->
                <!--pagination end-->

            </div>
        </section>
    </div>

    <!--footer section start-->
    <?php include('Footer/footer.php') ?>

    <!--bottom to top button start-->
    <button class="scroll-top scroll-to-target" data-target="html">
        <span class="fas fa-arrow-up"></span>
    </button>
    <!--bottom to top button end-->


    <!--build:js-->
    <script src="<?php echo base_url('assets/jquery-3.2.1.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/vendors/jquery-3.5.1.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/vendors/bootstrap.bundle.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/vendors/bootstrap-slider.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/vendors/jquery.countdown.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/vendors/jquery.easing.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/vendors/owl.carousel.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/vendors/validator.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/vendors/jquery.rcounterup.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/vendors/magnific-popup.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/vendors/hs.megamenu.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/app.js'); ?>"></script>
    <!--endbuild-->
    <script src="<?php echo base_url('assets/js_jp/footer.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js_jp/accueil.js'); ?>"></script>

</body>

</html>