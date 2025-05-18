<!-- CSS untuk tampilan sederhana -->

<style>
    /* * {
        font-family: 'Poppins', sans-serif !important;
    } */

    .report-card {
        transition: all 0.3s ease;
        border: none;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .report-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
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

    .dashboard-card {
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        border-left: 4px solid;
        padding: 10px;
    }

    .dashboard-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
    }

    .dashboard-card.primary {
        border-left-color: #4e73df;
    }

    .dashboard-card.success {
        border-left-color: #1cc88a;
    }

    .dashboard-card.info {
        border-left-color: #36b9cc;
    }

    .dashboard-card.warning {
        border-left-color: #f6c23e;
    }

    .dashboard-value {
        font-size: 1.8rem;
        font-weight: 700;
    }

    .dashboard-label {
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #6c757d;
    }

    .chart-container {
        height: 300px;
        position: relative;
    }
</style>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h4 m-0">Dashboard Laporan</h1>
        <div>
            <form action="<?= base_url('report') ?>" method="get" class="form-inline">
                <div class="input-group input-group-sm mr-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Dari</span>
                    </div>
                    <input type="date" class="form-control" name="from_date" value="<?= isset($_GET['from_date']) ? $_GET['from_date'] : date('Y-m-01') ?>">
                </div>
                <div class="input-group input-group-sm mr-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Sampai</span>
                    </div>
                    <input type="date" class="form-control" name="to_date" value="<?= isset($_GET['to_date']) ? $_GET['to_date'] : date('Y-m-d') ?>">
                </div>
                <button type="submit" class="btn btn-sm btn-primary">Filter</button>
            </form>
        </div>
    </div>

    <!-- Statistik Utama -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card dashboard-card primary h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="dashboard-label mb-1">Total Pendapatan</div>
                            <div class="dashboard-value text-primary">Rp <?= number_format($total_income, 0, ',', '.') ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-money-bill-wave fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card dashboard-card success h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="dashboard-label mb-1">Jumlah Transaksi</div>
                            <div class="dashboard-value text-success"><?= $transaction_count ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card dashboard-card info h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="dashboard-label mb-1">Jumlah Customer</div>
                            <div class="dashboard-value text-info"><?= $customer_count ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card dashboard-card warning h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="dashboard-label mb-1">Jumlah Produk</div>
                            <div class="dashboard-value text-warning"><?= $product_count ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-box fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik dan Statistik Lainnya -->
    <div class="row">
        <!-- Grafik Pendapatan Harian -->
        <div class="col-lg-8 mb-4">
            <div class="card shadow">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-primary">
                    <h6 class="m-0 font-weight-bold text-white">Pendapatan Harian</h6>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="dailyIncomeChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Produk Terlaris -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-success">
                    <h6 class="m-0 font-weight-bold text-white">Produk Terlaris</h6>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="productChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigasi Laporan -->
    <div class="row" hidden>
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

        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card report-card">
                <div class="card-body text-center">
                    <div class="report-icon text-success">
                        <i class="fas fa-users"></i>
                    </div>
                    <h5 class="report-title">Laporan Customer</h5>
                    <p class="report-description">Lihat data customer dan riwayat transaksi mereka</p>
                    <a href="<?= base_url('report/customer') ?>" class="btn btn-success mt-3">Lihat Laporan</a>
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

<!-- Script untuk Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Tambahkan format tanggal DD/MM/YYYY untuk input date
        var fromDateInput = document.querySelector('input[name="from_date"]');
        var toDateInput = document.querySelector('input[name="to_date"]');

        // Tampilkan tanggal yang dipilih dalam format yang lebih mudah dibaca
        var fromDateDisplay = fromDateInput.value ? new Date(fromDateInput.value) : new Date();
        var toDateDisplay = toDateInput.value ? new Date(toDateInput.value) : new Date();

        // Tambahkan informasi periode yang dipilih
        var periodInfo = document.createElement('div');
        periodInfo.className = 'text-muted mt-2 small';
        periodInfo.innerHTML = 'Menampilkan data dari ' +
            fromDateDisplay.getDate() + '/' + (fromDateDisplay.getMonth() + 1) + '/' + fromDateDisplay.getFullYear() +
            ' sampai ' +
            toDateDisplay.getDate() + '/' + (toDateDisplay.getMonth() + 1) + '/' + toDateDisplay.getFullYear();

        var filterForm = document.querySelector('form.form-inline');
        filterForm.parentNode.appendChild(periodInfo);

        // Data untuk grafik pendapatan harian
        var dailyIncomeData = <?= json_encode($daily_income) ?>;
        var labels = dailyIncomeData.map(function(item) {
            // Format tanggal menjadi DD/MM
            var date = new Date(item.date);
            return date.getDate() + '/' + (date.getMonth() + 1);
        });
        var values = dailyIncomeData.map(function(item) {
            return item.total;
        });

        // Buat grafik pendapatan harian
        var dailyIncomeCtx = document.getElementById('dailyIncomeChart').getContext('2d');
        var dailyIncomeChart = new Chart(dailyIncomeCtx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Pendapatan (Rp)',
                    data: values,
                    backgroundColor: 'rgba(78, 115, 223, 0.7)',
                    borderColor: 'rgba(78, 115, 223, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                            }
                        }
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Pendapatan Harian dalam Periode yang Dipilih',
                        font: {
                            size: 14,
                            family: 'Poppins, sans-serif'
                        }
                    }
                }
            }
        });

        // Data untuk grafik produk terlaris
        var productData = <?= json_encode($product_categories) ?>;
        var productLabels = productData.map(function(item) {
            return item.category;
        }).slice(0, 5); // Ambil 5 teratas
        var productValues = productData.map(function(item) {
            return item.count;
        }).slice(0, 5); // Ambil 5 teratas

        // Buat grafik produk terlaris
        var productCtx = document.getElementById('productChart').getContext('2d');
        var productChart = new Chart(productCtx, {
            type: 'doughnut',
            data: {
                labels: productLabels,
                datasets: [{
                    data: productValues,
                    backgroundColor: [
                        'rgba(28, 200, 138, 0.7)',
                        'rgba(54, 185, 204, 0.7)',
                        'rgba(246, 194, 62, 0.7)',
                        'rgba(231, 74, 59, 0.7)',
                        'rgba(133, 135, 150, 0.7)'
                    ],
                    borderColor: [
                        'rgba(28, 200, 138, 1)',
                        'rgba(54, 185, 204, 1)',
                        'rgba(246, 194, 62, 1)',
                        'rgba(231, 74, 59, 1)',
                        'rgba(133, 135, 150, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right'
                    },
                    title: {
                        display: true,
                        text: 'Produk Terlaris',
                        font: {
                            size: 14,
                            family: 'Poppins, sans-serif'
                        }
                    }
                }
            }
        });

        // Tambahkan event listener untuk input tanggal
        fromDateInput.addEventListener('change', function() {
            if (toDateInput.value && this.value > toDateInput.value) {
                alert('Tanggal awal tidak boleh lebih besar dari tanggal akhir');
                this.value = toDateInput.value;
            }
        });

        toDateInput.addEventListener('change', function() {
            if (fromDateInput.value && this.value < fromDateInput.value) {
                alert('Tanggal akhir tidak boleh lebih kecil dari tanggal awal');
                this.value = fromDateInput.value;
            }
        });
    });
</script>