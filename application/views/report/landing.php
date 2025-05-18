<style>
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    .report-container {
        background: #fff;
        padding: 40px;
        max-width: 600px;
        width: 100%;
        text-align: center;
        border-radius: 16px;
        box-shadow: 0 15px 25px rgba(0, 0, 0, 0.1);
        margin: 50px auto;
    }

    .report-container h1 {
        font-size: 36px;
        color: #007bff;
        margin-bottom: 10px;
    }

    .report-container h2 {
        font-size: 24px;
        margin-bottom: 15px;
    }

    .report-container p {
        font-size: 16px;
        color: #777;
        margin-bottom: 20px;
    }

    .report-img {
        width: 100%;
        max-width: 250px;
        margin: 0 auto 20px;
    }

    .sidebar-info {
        background-color: #f8f9fa;
        border-left: 4px solid #007bff;
        padding: 15px 20px;
        margin: 20px auto;
        text-align: left;
        border-radius: 5px;
    }

    /* Responsivitas */
    @media (max-width: 767.98px) {
        .report-container {
            padding: 30px;
            margin: 30px auto;
        }

        .report-container h1 {
            font-size: 28px;
        }

        .report-container h2 {
            font-size: 20px;
        }

        .report-img {
            max-width: 200px;
        }
    }
</style>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="report-container">
        <img src="<?= base_url('assets/img/blocked.png') ?>" alt="Laporan" class="report-img">
        <h1>Modul Laporan</h1>
        <h2>Selamat Datang di Halaman Laporan</h2>
        <p>Halaman ini menyediakan akses ke berbagai jenis laporan untuk membantu Anda memantau dan menganalisis kinerja bisnis.</p>

        <div class="sidebar-info">
            <h4 style="color: #007bff; margin-bottom: 10px;"><i class="fas fa-info-circle mr-2"></i> Petunjuk Penggunaan</h4>
            <p style="font-size: 14px;">
                Untuk mengakses laporan tertentu, silakan pilih jenis laporan yang diinginkan melalui menu di <strong>sidebar sebelah kiri</strong>.
            </p>
        </div>
    </div>
</div>
<!-- /.container-fluid -->