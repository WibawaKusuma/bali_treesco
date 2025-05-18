<!-- CSS untuk tampilan sederhana -->
<style>
    .report-card {
        transition: all 0.3s ease;
        border: none;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        overflow: hidden;
    }
    
    .report-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .report-card .card-body {
        padding: 1.5rem;
    }
    
    .report-icon {
        font-size: 2.5rem;
        margin-bottom: 1rem;
    }
    
    .report-title {
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }
    
    .report-description {
        color: #6c757d;
        font-size: 0.9rem;
    }
</style>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h4 m-0">Laporan</h1>
    </div>
    
    <div class="row">
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card report-card">
                <div class="card-body text-center">
                    <div class="report-icon text-primary">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h5 class="report-title">Laporan Pendapatan</h5>
                    <p class="report-description">Lihat laporan pendapatan berdasarkan periode tertentu</p>
                    <a href="<?= base_url('report/income') ?>" class="btn btn-primary mt-3">Lihat Laporan</a>
                </div>
            </div>
        </div>
        
        <!-- Placeholder untuk laporan lain di masa depan -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card report-card bg-light">
                <div class="card-body text-center">
                    <div class="report-icon text-secondary">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <h5 class="report-title">Laporan Penjualan</h5>
                    <p class="report-description">Segera hadir</p>
                    <button class="btn btn-secondary mt-3" disabled>Segera Hadir</button>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card report-card bg-light">
                <div class="card-body text-center">
                    <div class="report-icon text-secondary">
                        <i class="fas fa-box"></i>
                    </div>
                    <h5 class="report-title">Laporan Stok</h5>
                    <p class="report-description">Segera hadir</p>
                    <button class="btn btn-secondary mt-3" disabled>Segera Hadir</button>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
