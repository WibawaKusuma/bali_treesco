<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">


    <style>
        p h1 h2 h3 h4 h5 {
            font-family: 'Poppins', sans-serif !important;
        }

        .icon {
            width: 80px;
            height: 80px;
            background-color: #f8f9fa;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 40px;
            color: #2e6b3e;
            transition: all 0.3s ease-in-out;
        }

        .card {
            border: none;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background-color: #ffffff;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.15);
        }

        .icon-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 10px;
        }

        .card-body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        h5 {
            margin: 10px 0 0;
            font-size: 18px;
            text-align: center;
            text-transform: capitalize;
            /* font-weight: 600; */
            color: #333;
        }

        .module-link {
            text-decoration: none;
        }

        @media (max-width: 768px) {
            .col-sm-3 {
                width: 50%;
                margin-bottom: 15px;
            }
        }

        @media (max-width: 576px) {
            .col-sm-3 {
                width: 100%;
            }
        }
    </style>
</head>

<body>

    <div class="row justify-content-center">
        <div class="row" style="width: 80%;">
            <?php foreach ($module as $k) : ?>
                <?php if ($k->status == 1) : ?>
                    <div class="col-sm-3">
                        <div class="card">
                            <div class="card-body">
                                <a href="<?= base_url($k->url) ?>" class="module-link d-flex align-items-center flex-column" title="<?= $k->name ?>">
                                    <div class="icon-container">
                                        <i class="<?= $k->icon ?> icon"></i>
                                    </div>
                                    <h5><?= $k->name ?></h5>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
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

</body>

</html>