<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-color: #306b40;
            --primary-light: #4c8a5e;
            --primary-dark: #1e4d2b;
            --secondary-color: #5d9c59;
            --text-color: #1e293b;
            --light-bg: #f1f5f9;
            --card-bg: #ffffff;
            --border-radius: 14px;
            --shadow-color: rgba(48, 107, 64, 0.15);
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light-bg);
            color: var(--text-color);
        }

        .dashboard-container {
            padding: 40px 0;
            min-height: 100vh;
            background-image:
                radial-gradient(at 80% 10%, rgba(48, 107, 64, 0.05) 0px, transparent 50%),
                radial-gradient(at 20% 90%, rgba(93, 156, 89, 0.05) 0px, transparent 50%);
        }

        .dashboard-header {
            margin-bottom: 30px;
            text-align: center;
        }

        .dashboard-title {
            font-size: 28px;
            font-weight: 600;
            color: var(--primary-dark);
            margin-bottom: 10px;
            position: relative;
            display: inline-block;
            padding-bottom: 10px;
        }

        .dashboard-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
            border-radius: 3px;
        }

        .module-grid {
            margin: 0 auto;
            padding: 10px 0;
        }

        .module-item {
            padding: 12px;
            margin-bottom: 20px;
            transition: transform 0.3s ease;
        }

        .card {
            border: none;
            border-radius: var(--border-radius);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
            transition: all 0.3s ease;
            background-color: var(--card-bg);
            height: 100%;
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .card:hover {
            box-shadow: 0 10px 25px var(--shadow-color);
            transform: translateY(-5px);
        }

        .card-body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 25px 20px;
            position: relative;
            z-index: 1;
            flex-grow: 1;
        }

        .icon-container {
            margin-bottom: 18px;
            position: relative;
        }

        .icon {
            width: 70px;
            height: 70px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 28px;
            color: var(--primary-color);
            transition: all 0.3s ease;
            position: relative;
            z-index: 1;
        }

        .icon::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background-color: rgba(48, 107, 64, 0.1);
            border-radius: 16px;
            z-index: -1;
            transition: all 0.3s ease;
            transform: rotate(0deg);
        }

        .card:hover .icon::before {
            background-color: var(--primary-color);
            transform: rotate(45deg);
        }

        .card:hover .icon {
            color: white;
        }

        .module-title {
            margin: 10px 0 0;
            font-size: 16px;
            font-weight: 500;
            text-align: center;
            color: var(--text-color);
            transition: color 0.3s ease;
        }

        .card:hover .module-title {
            color: var(--primary-color);
        }

        .module-link {
            text-decoration: none;
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            height: 100%;
        }

        .card::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.3s ease;
        }

        .card:hover::after {
            transform: scaleX(1);
        }

        @media (max-width: 1200px) {
            .module-item {
                padding: 10px;
            }
        }

        @media (max-width: 992px) {
            .module-item {
                width: 33.33%;
            }

            .icon {
                width: 65px;
                height: 65px;
                font-size: 26px;
            }

            .dashboard-title {
                font-size: 24px;
            }
        }

        @media (max-width: 768px) {
            .module-item {
                width: 50%;
            }

            .icon {
                width: 60px;
                height: 60px;
                font-size: 24px;
            }

            .dashboard-container {
                padding: 30px 0;
            }
        }

        @media (max-width: 576px) {
            .module-item {
                width: 100%;
                max-width: 300px;
                margin-left: auto;
                margin-right: auto;
            }

            .dashboard-title {
                font-size: 22px;
            }
        }
    </style>
</head>

<body>

    <div class="dashboard-container">
        <div class="container">
            <!-- <div class="dashboard-header">
                <h1 class="dashboard-title">Dashboard Admin</h1>
            </div> -->

            <div class="row module-grid">
                <?php foreach ($module as $k) : ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 module-item">
                        <div class="card">
                            <div class="card-body">
                                <a href="<?= base_url($k->url) ?>" class="module-link" title="<?= $k->name ?>">
                                    <div class="icon-container">
                                        <div class="icon">
                                            <i class="<?= $k->icon ?>"></i>
                                        </div>
                                    </div>
                                    <h5 class="module-title"><?= $k->name ?></h5>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- Flashdata SweetAlert -->
    <?php if ($this->session->flashdata('sweet_alert')) : ?>
        <script>
            const swalData = <?= $this->session->flashdata('sweet_alert'); ?>;
            Swal.fire({
                icon: swalData.type,
                title: swalData.title,
                text: swalData.text
            });
        </script>
    <?php endif; ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Enhanced Animation Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Animate dashboard title
            const dashboardTitle = document.querySelector('.dashboard-title');
            if (dashboardTitle) {
                dashboardTitle.style.opacity = '0';
                dashboardTitle.style.transform = 'translateY(-20px)';

                setTimeout(() => {
                    dashboardTitle.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                    dashboardTitle.style.opacity = '1';
                    dashboardTitle.style.transform = 'translateY(0)';
                }, 100);
            }

            // Staggered animation for module items
            const moduleItems = document.querySelectorAll('.module-item');
            moduleItems.forEach((item, index) => {
                item.style.opacity = '0';
                item.style.transform = 'translateY(20px)';

                setTimeout(() => {
                    item.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                    item.style.opacity = '1';
                    item.style.transform = 'translateY(0)';
                }, 300 + (80 * index));
            });

            // Add subtle hover effect to cards
            moduleItems.forEach(item => {
                const card = item.querySelector('.card');

                item.addEventListener('mouseenter', function() {
                    moduleItems.forEach(otherItem => {
                        if (otherItem !== item) {
                            otherItem.style.opacity = '0.7';
                        }
                    });
                });

                item.addEventListener('mouseleave', function() {
                    moduleItems.forEach(otherItem => {
                        otherItem.style.opacity = '1';
                    });
                });
            });
        });
    </script>
</body>

</html>