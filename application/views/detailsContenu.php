<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">



    <title>Zoky Manoro - Detail</title>
    <link rel="icon" href="<?php echo base_url('uploads/zoky_manoro.jpg') ?>" type="image/png" sizes="16x16">

    <!-- <link href="<?php echo base_url('assets/index.css') ?>" rel="stylesheet" /> -->
    <!-- <link href="<?php echo base_url('assets/bootstrap.min.css') ?>" rel="stylesheet"> -->
    <link href="<?php echo base_url('assets/css/css2.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/main.css') ?>" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo base_url('assets/plugins/fontawesome-free/css/all.min.css') ?>">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->

    <link href="<?php echo base_url('assets/css/custom.css') ?>" rel="stylesheet">



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

        <section class="our-blog-section ptb-100 gray-light-bg">
            
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="section-heading mb-5">
                            <h2><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?= $titre ?></font></font></h2>
                            <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                <?= $contenu ?></font><font style="vertical-align: inherit;">
                            </font></font></p>
                        </div>                        
                    </div>
                    <!-- <img src="<?= $img ?>" style="max-height :500px;" alt="article" class="img-fluid" /> -->
                    <div class="col-md-4">
                        <?= $carresoul_info ?>
                    </div>
                </div>
                <br><br>
                <div class="row">
                    <div class="col-lg-8 col-md-12">
                        <!-- Post-->
                        <?=$card?>
                     
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="sidebar-right pl-4">

                            <!-- Search widget-->
                            <!-- <aside class="widget widget-search">
                                <form>
                                    <input class="form-control" type="search" placeholder="Type Search Words">
                                    <button class="search-button" type="submit"><span class="ti-search"></span></button>
                                </form>
                            </aside>

                            
                            <br><br> -->
                            <!-- Recent entries widget-->
                            <aside class="widget widget-recent-entries-custom">
                                <div class="widget-title">
                                    <h6>Information Recent</h6>
                                </div>
                                <ul>
                                    <?= $list_recent ?>
                                </ul>
                            </aside>

                            <!-- Subscribe widget-->
                            <!-- <aside class="widget widget-categories">
                                <div class="widget-title">
                                    <h6>Newsletter</h6>
                                </div>
                                <p>Enter your email address below to subscribe to my newsletter</p>
                                <form action="#" method="post" class="d-none d-md-block d-lg-block">
                                    <input type="text" class="form-control input" id="email-footer" name="email" placeholder="info@yourdomain.com">
                                    <button type="submit" class="btn primary-solid-btn btn-block btn-not-rounded mt-3">Subscribe</button>
                                </form>
                            </aside> -->

                            <!-- Tags widget-->
                            <!-- <aside class="widget widget-tag-cloud">
                                <div class="widget-title">
                                    <h6>Tags</h6>
                                </div>
                                <div class="tag-cloud"><a href="#">e-commerce</a><a href="#">portfolio</a><a href="#">responsive</a><a href="#">bootstrap</a><a href="#">business</a><a href="#">corporate</a></div>
                            </aside> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
        <span class="ti-rocket"></span>
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

</body>

</html>