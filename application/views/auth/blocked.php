<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akses Ditolak</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
        }

        body {
            background: #f9f9f9;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            color: #333;
        }

        .container {
            background: #fff;
            padding: 40px;
            max-width: 500px;
            width: 100%;
            text-align: center;
            border-radius: 16px;
            box-shadow: 0 15px 25px rgba(0, 0, 0, 0.1);
        }

        .container h1 {
            font-size: 48px;
            color: #ff4d4f;
            margin-bottom: 10px;
        }

        .container h2 {
            font-size: 24px;
            margin-bottom: 15px;
        }

        .container p {
            font-size: 16px;
            color: #777;
        }

        .btn-home {
            display: inline-block;
            margin-top: 25px;
            padding: 12px 24px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 10px;
            transition: background-color 0.3s ease, transform 0.3s ease;
            box-shadow: 0 4px 10px rgba(0, 123, 255, 0.3);
        }

        .btn-home:hover {
            background-color: #ffffff;
            transform: scale(1.05);
            box-shadow: 0 6px 15px rgba(0, 123, 255, 0.4);
        }

        .illustration {
            width: 100%;
            max-width: 180px;
            margin: 0 auto 20px;
        }
    </style>
</head>

<body>

    <div class="container">
        <img style="width: 100%;" src="<?= base_url('assets/img/blocked.png') ?>" alt="Blocked" class="illustration">
        <h1>403</h1>
        <h2>Mau Ngapain? Hayoo!</h2>
        <h2>Akses Ditolak</h2>
        <p>Oops! Kamu tidak punya izin untuk mengakses halaman ini.</p>
        <a href="<?= base_url('landing') ?>" class="btn-home">Kembali ke Beranda</a>
    </div>

</body>

</html>