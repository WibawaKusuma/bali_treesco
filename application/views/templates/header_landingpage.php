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
    <link href="<?= base_url('assets/css/fonts.css') ?>" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?= base_url('assets/vendor/bootstrap/css/bootstrap.min.css') ?>" rel=" stylesheet">
    <link href="<?= base_url('assets/vendor/bootstrap-icons/bootstrap-icons.css') ?>" rel=" stylesheet">
    <link href="<?= base_url('assets/vendor/aos/aos.css') ?>" rel=" stylesheet">
    <link href="<?= base_url('assets/vendor/glightbox/css/glightbox.min.css') ?>" rel=" stylesheet">
    <link href="<?= base_url('assets/vendor/swiper/swiper-bundle.min.css') ?>" rel=" stylesheet">

    <!-- Main CSS File -->
    <link href="<?= base_url('assets/css/main.css') ?>" rel=" stylesheet">

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="<?= base_url('assets/js/lib/sweetalert2/sweetalert2.min.css') ?>">
    <script src="<?= base_url('assets/js/lib/sweetalert2/sweetalert2.all.min.js') ?>"></script>

    <style>
        .cart-count {
            position: relative;
            top: -6px;
            font-size: 9px;
            margin-left: -4px;
        }

        /* Tambahkan style untuk header */
        .header {
            transition: all 0.5s ease-in-out !important;
            position: fixed !important;
            width: 100%;
            top: 0;
            z-index: 997;
        }

        .header.header-scrolled {
            transform: translateY(-100%);
            opacity: 0;
        }

        .header.header-shown {
            transform: translateY(0);
            opacity: 1;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
        }

        /* Style untuk nama customer */
        .navmenu .dropdown>a span {
            color: #fff !important;
        }

        .navmenu .dropdown>a:hover span {
            opacity: 0.8;
        }

        /* Mobile styles */
        @media (max-width: 1199px) {
            .navmenu ul {
                /* background: linear-gradient(90deg, #1D6300 0%, #77BD27 50%, #DAB914 100%) !important; */
                background: #436646 !important;
            }

            .navmenu a,
            .navmenu a:focus {
                color: #fff !important;
            }

            .navmenu .dropdown>a span {
                color: #fff !important;
                font-weight: 600;
                font-size: 16px;
            }

            .navmenu .dropdown .dropdown-menu {
                background: rgba(255, 255, 255, 0.1) !important;
                margin: 5px 15px !important;
                border-radius: 5px;
            }

            .navmenu .dropdown .dropdown-menu a {
                color: #fff !important;
                padding: 10px 20px;
            }

            .navmenu .dropdown .dropdown-menu a:hover {
                background: rgba(255, 255, 255, 0.2);
            }

            .mobile-nav-toggle {
                color: #fff !important;
            }

            .navmenu .dropdown>a i {
                background: rgba(255, 255, 255, 0.2) !important;
                color: #fff !important;
            }
        }

        /* Sesuaikan margin-top pada main */
        .main {
            margin-top: 60px !important;
        }

        /* Tambahkan style untuk hero section */
        .hero {
            margin-top: -60px !important;
            padding-top: 60px !important;
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

        .cart-count {
            position: relative;
            top: -6px;
            font-size: 9px;
            margin-left: -4px;
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
        }

        /* Desktop dropdown menu */
        @media (min-width: 1280px) {
            .navmenu .dropdown ul {
                min-width: 200px !important;
                width: auto !important;
            }

            .navmenu .dropdown ul li a {
                width: 100% !important;
                display: block !important;
                white-space: nowrap !important;

            }
        }
    </style>
</head>

<body class="index-page">

    <header id="header" class="header d-flex align-items-center sticky-top">
        <div class="container position-relative d-flex align-items-center justify-content-between">

            <a href="<?= base_url('landing') ?>" class="logo d-flex align-items-center me-auto me-xl-0">
                <img src="<?= base_url('assets/img/logo-bali-treeco-round.png') ?>" alt="">
                <h1 class="sitename">Bali Treesco</h1>
                <span>.</span>
            </a>

            <!-- <nav id="navmenu" class="navmenu">
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
                                Chart
                                <span class="cart-count badge bg-danger rounded-pill" id="cart-count">0</span>
                            </a>
                        </li>
                        <li class="dropdown">
                            <a>
                                <span><?= $this->session->userdata('customer_name') ?></span>
                                <i class="bi bi-chevron-down toggle-dropdown"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="<?= base_url('customer/profile') ?>"></i>My Profile</a></li>
                                <li><a href="<?= base_url('order') ?>"></i>My Order</a></li>
                                <li><a href="<?= base_url('customer/logout') ?>"></i>Logout</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list" style="color: #162117;"></i>
            </nav> -->
            <nav id="navmenu" class="navmenu">
                <ul>
                    <?php if ($this->session->userdata('customer_logged_in')) : ?>
                        <li class="dropdown">
                            <a>
                                <span><?= $this->session->userdata('customer_name') ?></span>
                                <i class="bi bi-chevron-down toggle-dropdown"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="<?= base_url('customer/profile') ?>"></i>My Profile</a></li>
                                <li><a href="<?= base_url('order') ?>"></i>My Order</a></li>
                                <li><a href="<?= base_url('customer/logout') ?>"></i>Logout</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="<?= base_url('cart') ?>">
                                Chart
                                <span class="cart-count badge bg-danger rounded-pill" id="cart-count">0</span>
                            </a>
                        </li>
                    <?php endif; ?>
                    <li><a href="<?= base_url('landing') ?>">Home<br></a></li>
                    <li><a href="<?= base_url('landing/about') ?>">About</a></li>
                    <li><a href=" <?= base_url('landing/product') ?>">Product</a></li>
                    <li><a href="<?= base_url('landing/contact') ?>">Contact</a></li>
                    <?php if (!$this->session->userdata('customer_logged_in')) : ?>
                        <li><a href="<?= base_url('customer/login') ?>">Login</a></li>
                    <?php endif; ?>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list" style="color: #162117;"></i>
            </nav>
        </div>
    </header>

    <main class="main">

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                let lastScrollTop = 0;
                let header = document.querySelector('.header');
                let scrollThreshold = 100; // Jarak scroll sebelum header hilang
                let isScrollingUp = false;
                let scrollTimer = null;

                window.addEventListener('scroll', function() {
                    let currentScroll = window.pageYOffset || document.documentElement.scrollTop;

                    // Clear timeout sebelumnya
                    if (scrollTimer !== null) {
                        clearTimeout(scrollTimer);
                    }

                    if (currentScroll > scrollThreshold) {
                        if (currentScroll > lastScrollTop) {
                            // Scrolling down
                            if (!header.classList.contains('header-scrolled')) {
                                header.classList.add('header-scrolled');
                                header.classList.remove('header-shown');
                            }
                        } else {
                            // Scrolling up
                            if (header.classList.contains('header-scrolled')) {
                                header.classList.remove('header-scrolled');
                                header.classList.add('header-shown');
                            }
                        }
                    } else {
                        // Di atas threshold
                        header.classList.remove('header-scrolled');
                        header.classList.remove('header-shown');
                    }

                    // Set timeout baru
                    scrollTimer = setTimeout(function() {
                        if (currentScroll <= scrollThreshold) {
                            header.classList.remove('header-scrolled');
                            header.classList.remove('header-shown');
                        }
                    }, 150);

                    lastScrollTop = currentScroll;
                }, {
                    passive: true
                });
            });
        </script>