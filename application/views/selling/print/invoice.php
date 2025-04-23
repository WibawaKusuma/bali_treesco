<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Bali Treesco | <?= @$title ?></title>
    <link href="<?= base_url('assets/img/favicon-logo-bali-treeco.png') ?>" rel=" icon">
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            margin: 20px;
        }

        .header {
            text-align: center;
        }

        .header h2 {
            margin: 0;
        }

        .info,
        .footer {
            margin-top: 20px;
        }

        .info table {
            width: 100%;
        }

        .info td {
            padding: 5px 0;
        }

        .invoice-box {
            border: 1px solid #ccc;
            padding: 15px;
            margin-top: 20px;
        }

        .total {
            margin-top: 10px;
            font-weight: bold;
            text-align: right;
        }

        .footer {
            text-align: center;
            font-size: 11px;
            margin-top: 50px;
            border-top: 1px solid #ccc;
            padding-top: 10px;
        }
    </style>
</head>

<body>

    <?php
    $img_path = FCPATH . 'assets/img/logo-bali-treeco2.png';
    $type = pathinfo($img_path, PATHINFO_EXTENSION);
    $data = file_get_contents($img_path);
    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
    ?>

    <div class="header">
        <img src="<?= $base64 ?>" style="height: 10%;" alt="Logo Bali Tresco">
        <p>Sweet by Nature, Healthy by Choice.</p>
        <!-- <p>www.balitresco.com</p> -->
        <p><?= @$config['company_website'] ?> | <?= @$config['company_phone'] ?></p>
        <!-- <p><?= @$config['company_address'] ?></p> -->
    </div>

    <div class="info">
        <table>
            <tr>
                <td><strong>No. Transaksi:</strong> INV/BT/<?= $selling->id_selling ?></td>
                <td style="text-align: right;"><strong>Tanggal:</strong> <?= date('d M Y', strtotime($selling->tgl_proses)) ?></td>
            </tr>
            <tr>
                <td><strong>Nama Customer:</strong> <?= $selling->customer_name ?></td>
                <td style="text-align: right;"><strong>Status:</strong> <?= $selling->status == 1 ? 'Selesai' : 'Pending' ?></td>
            </tr>
        </table>
    </div>

    <div class="invoice-box">
        <!-- Isi tambahan invoice bisa ditambahkan di sini -->
    </div>

    <div class="footer">
        Terima kasih atas kepercayaan Anda. <br>
        Invoice ini sah tanpa tanda tangan dan dapat digunakan untuk keperluan arsip.
    </div>

</body>

</html>