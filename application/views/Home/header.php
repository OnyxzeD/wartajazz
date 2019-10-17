<?php
$method = $this->router->fetch_method();
$Menu = [
    'index'    => null,
    'partners' => null,
    'register' => null,
    'about'    => null,
    'contact'  => null
];
$Menu[$method] = 'active';
?>
<div class="container-fluid h-100">
    <div class="row h-100">
        <!-- Menu Area Start -->
        <div class="col-12 h-100">
            <div class="menu_area h-100">
                <nav class="navbar h-100 navbar-expand-lg align-items-center">
                    <!-- Logo -->
                    <a class="navbar-brand" href="<?= base_url(); ?>"><img
                                src="<?= base_url('assets/landing/img/logo-mosh.png'); ?>" alt="logo"></a>

                    <!-- Menu Area -->
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mosh-navbar"
                            aria-controls="mosh-navbar" aria-expanded="false" aria-label="Toggle navigation"><span
                                class="navbar-toggler-icon"></span></button>

                    <div class="collapse navbar-collapse justify-content-end" id="mosh-navbar">
                        <ul class="navbar-nav animated" id="nav">
                            <li class="nav-item <?= $Menu['index'] ?>">
                                <a class="nav-link" href="<?= base_url('/'); ?>">Home</a>
                            </li>
                            <!--<li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="moshDropdown" role="button"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pages</a>
                                <div class="dropdown-menu" aria-labelledby="moshDropdown">
                                    <a class="dropdown-item" href="index.php">Home</a>
                                    <a class="dropdown-item" href="about.php">About Us</a>
                                    <a class="dropdown-item" href="services.php">Services</a>
                                    <a class="dropdown-item" href="portfolio.php">Portfolio</a>
                                    <a class="dropdown-item" href="blog.php">Blog</a>
                                    <a class="dropdown-item" href="contact.php">Contact</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="elements.php">Elements</a>
                                </div>
                            </li>-->
                            <li class="nav-item <?= $Menu['partners'] ?>"><a class="nav-link"
                                                                             href="<?= site_url('Home/partners'); ?>">Partners</a>
                            </li>
                            <!-- <li class="nav-item"><a class="nav-link" href="#modal-wrapper" onclick="document.getElementById('modal-wrapper').style.display='block'">Login</a></li>-->
                            <li class="nav-item <?= $Menu['register'] ?>"><a class="nav-link"
                                                                             href="<?= site_url('register'); ?>">Register</a>
                            </li>
                            <li class="nav-item <?= $Menu['about'] ?>"><a class="nav-link" href="<?= site_url('Home/about'); ?>">About</a>
                            </li>
                            <li class="nav-item <?= $Menu['contact'] ?>"><a class="nav-link" href="<?= site_url('Home/contact'); ?>">Contact</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>
