<header id="header" class="header-main">

        <!--main header menu start-->
        <div id="logoAndNav" class="main-header-menu-wrap white-bg border-bottom">
            <div class="container">
                <nav class="js-mega-menu navbar navbar-expand-md header-nav">
                    <!-- <?php include('topBar.php') ?>  -->
                    <!--logo start-->

                    <a class="navbar-brand" href="<?= base_url('/') ?>">
                        <img src="<?php echo base_url('uploads/zoky_manoro-pers.png'); ?>" width="100" alt="logo" class="img-fluid" />
                        <img src="<?php echo base_url('uploads/zoky_manoro-ltr.png'); ?>" width="140" alt="logo" class=" hidden" small-hidden/>
                    </a>

                    <!--logo end-->

                    <!--responsive toggle button start-->
                    <button type="button" class="navbar-toggler btn" aria-expanded="false" aria-controls="navBar" data-toggle="collapse" data-target="#navBar">
                        <span id="hamburgerTrigger">
                            <span class="fas fa-bars"></span>
                        </span>
                    </button>
                    <!--responsive toggle button end-->

                    <!--main menu start-->
                    <div id="navBar" class="collapse navbar-collapse">
                        <ul class="navbar-nav ml-auto main-navbar-nav">
                            <li class="nav-item hs-has-mega-menu custom-nav-item" data-position="left">
                                <a id="homeMegaMenu" class="nav-link custom-nav-link" href="accueil"><span class="fas fa-home mr-2"></span>Accueil</a>

                            </li>

                            <li class="nav-item hs-has-mega-menu custom-nav-item" data-max-width="720px" data-position="right">
                                <a id="login" class="nav-link custom-nav-link" href="login" ><span class="fas fa-user mr-2"></span> Login</a>

                            </li>
                            <li class="nav-item hs-has-mega-menu custom-nav-item" data-max-width="720px" data-position="right">
                                <a id="numero" class="nav-link custom-nav-link" href="#" ><span class="fas fa-phone mr-2"> +261 34 62 254 12</span></a>

                            </li>

                            <!-- <li class="nav-item header-nav-last-item d-flex align-items-center">
                                <a class="btn primary-solid-btn animated-btn" href="#" target="_blank">
                                    Get Started
                                </a>
                            </li> -->
                        </ul>
                    </div>
                    <!--main menu end-->
                </nav>
            </div>
        </div>
        <!--main header menu end-->
    </header>