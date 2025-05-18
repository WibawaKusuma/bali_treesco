<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Bali Treesco - <?= $title ?></title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="<?= base_url('assets/img/favicon-logo-bali-treeco.png') ?>" rel=" icon">
    <link href="<?= base_url('assets/img/apple-touch-icon.png') ?>" rel=" apple-touch-icon">

    <!-- Fonts -->
    <link href=" <?= base_url('https://fonts.googleapis.com') ?>" rel=" preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Amatic+SC:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?= base_url('assets/vendor/bootstrap/css/bootstrap.min.css') ?>" rel=" stylesheet">
    <link href="<?= base_url('assets/vendor/bootstrap-icons/bootstrap-icons.css') ?>" rel=" stylesheet">
    <link href="<?= base_url('assets/vendor/aos/aos.css') ?>" rel=" stylesheet">
    <link href="<?= base_url('assets/vendor/glightbox/css/glightbox.min.css') ?>" rel=" stylesheet">
    <link href="<?= base_url('assets/vendor/swiper/swiper-bundle.min.css') ?>" rel=" stylesheet">

    <!-- Main CSS File -->
    <link href="<?= base_url('assets/css/main.css') ?>" rel=" stylesheet">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .cart-count {
            position: relative;
            top: -8px;
            font-size: 10px;
            margin-left: -5px;
        }
    </style>


    <!-- =======================================================
  * Template Name: Yummy
  * Template URL: https://bootstrapmade.com/yummy-bootstrap-restaurant-website-template/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
    <style>
        * {
            font-family: 'Poppins', sans-serif !important;
        }

        html,
        body {
            height: 100%;
            margin: 0;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .main {
            flex: 1 0 auto;
        }

        .footer {
            flex-shrink: 0;
            margin-top: auto;
        }

        /* Responsif dropdown menu */
        @media (max-width: 1279px) {
            .navmenu .dropdown-menu {
                position: static;
                left: 0;
                right: 0;
                top: 100%;
                margin: 0;
                padding: 10px 0;
                z-index: 99;
                opacity: 1;
                visibility: hidden;
                background: #fff;
                box-shadow: none;
                transition: all 0.3s ease;
                display: none;
            }

            .navmenu .dropdown-menu.dropdown-active {
                display: block;
                visibility: visible;
                opacity: 1;
                margin-top: 8px;
                margin-bottom: 8px;
                padding-left: 15px;
            }

            .mobile-nav-active .navmenu ul {
                display: block;
            }

            .mobile-nav-active .navmenu ul li {
                position: relative;
            }
        }
    </style>
</head>

<body class="index-page">

    <header id="header" class="header d-flex align-items-center sticky-top">
        <div class="container position-relative d-flex align-items-center justify-content-between">

            <a href="index.html" class="logo d-flex align-items-center me-auto me-xl-0">
                <img src="<?= base_url('assets/img/logo-bali-treeco-round.png') ?>" alt="">
                <h1 class="sitename">Bali Treesco</h1>
                <span>.</span>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="<?= base_url('landing') ?>">Home<br></a></li>
                    <li><a href="<?= base_url('landing/about') ?>">About</a></li>
                    <li><a href=" <?= base_url('landing/product') ?>">Product</a></li>
                    <li><a href="<?= base_url('landing/contact') ?>">Contact</a></li>
                    <?php if (!$this->session->userdata('customer_logged_in')) : ?>
                        <li><a href="<?= base_url('customer/login') ?>">Login</a></li>
                    <?php endif; ?>
                    <?php if ($this->session->userdata('customer_logged_in')) : ?>
                        <li>
                            <a href="<?= base_url('cart') ?>">
                                <!-- <i class="bi bi-cart"></i>  -->
                                Chart
                                <span class="cart-count badge bg-danger rounded-pill" id="cart-count">0</span>
                            </a>
                        </li>
                        <li class="dropdown">
                            <a href="#">
                                <!-- <i class="bi bi-person-circle"></i>  -->
                                <span><?= $this->session->userdata('customer_name') ?></span>
                                <i class="bi bi-chevron-down toggle-dropdown"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="<?= base_url('customer/profile') ?>"><i class="bi bi-person me-2"></i>My Profile</a></li>
                                <li><a href="<?= base_url('order') ?>"><i class="bi bi-bag-check me-2"></i>My Order</a></li>
                                <li><a href="<?= base_url('customer/logout') ?>"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                </ul>
                <i class=" mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>
            <!-- <a class="btn-getstarted" href="index.html#book-a-table">Book a Table</a> -->
        </div>
    </header>

    <main class="main">