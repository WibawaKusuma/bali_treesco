<!-- CSS untuk tampilan sederhana -->
<style>
    /* Gaya umum */
    body {
        background-color: #f8f9fa;
    }

    .card {
        border: none;
        border-radius: 4px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        margin-bottom: 1rem;
    }

    .card-body {
        padding: 2.25rem;
    }

    .card-title {
        color: #333;
        font-weight: 600;
    }

    /* Tombol */
    .btn {
        border-radius: 4px;
        font-weight: 500;
    }

    /* Tabel */
    .table {
        color: #333;
    }

    .table thead th {
        background-color: #f8f9fa;
        border-bottom: 1px solid #dee2e6;
        font-weight: 600;
    }

    .table-hover tbody tr:hover {
        background-color: rgba(0, 123, 255, 0.05);
    }

    /* Margin */
    .me-2 {
        margin-right: 0.5rem !important;
    }

    /* Responsivitas */
    @media (max-width: 767.98px) {
        .card-body {
            padding: 1rem;
        }

        .table-responsive {
            font-size: 0.9rem;
        }

        .btn {
            padding: 0.375rem 0.75rem;
            font-size: 0.9rem;
        }

        .h4 {
            font-size: 1.2rem;
        }

        .h5 {
            font-size: 1rem;
        }

        .small {
            font-size: 0.75rem;
        }

        .fa-2x {
            font-size: 1.5rem;
        }

        .d-flex {
            flex-wrap: wrap;
        }

        .me-2 {
            margin-right: 0.5rem !important;
            margin-bottom: 0.5rem !important;
        }

        .input-group-text {
            font-size: 0.9rem;
        }

        .form-control {
            font-size: 0.9rem;
        }

        .stat-card {
            padding-left: 1rem;
            padding-right: 1rem;
        }

        .text-xs {
            font-size: 0.7rem;
        }

        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter {
            text-align: left;
            margin-bottom: 0.5rem;
        }

        .dataTables_wrapper .dataTables_info {
            padding-top: 0.5rem;
        }

        .dataTables_wrapper .dataTables_paginate {
            padding-top: 0.5rem;
            font-size: 0.9rem;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 0.3rem 0.6rem;
        }
    }

    /* Tampilan mobile kecil */
    @media (max-width: 575.98px) {
        .stat-card {
            padding-left: 0.75rem;
            padding-right: 0.75rem;
        }

        .h4 {
            font-size: 1.1rem;
        }

        .text-xs {
            font-size: 0.65rem;
        }

        .col-auto {
            display: none;
        }
    }

    /* Tablet responsiveness */
    @media (min-width: 768px) and (max-width: 991.98px) {
        .card-body {
            padding: 1.25rem;
        }

        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter {
            margin-bottom: 0.75rem;
        }
    }

    /* Datepicker styles */
    .datepicker {
        z-index: 1060 !important;
    }

    /* jQuery UI Datepicker styles */
    .ui-datepicker {
        z-index: 9999 !important;
        font-family: 'Poppins', sans-serif;
        font-size: 14px;
        padding: 10px;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        border: none;
        width: 280px;
        display: block !important;
    }

    /* Perbaikan tampilan input tanggal */
    .input-group.date {
        position: relative;
        z-index: 1;
    }

    .input-group.date input[type="text"] {
        cursor: pointer;
        background-color: #fff;
    }

    .input-group.date .input-group-append {
        cursor: pointer;
    }

    .ui-datepicker .ui-datepicker-header {
        background: #007bff;
        color: white;
        border: none;
    }

    .ui-datepicker .ui-datepicker-title {
        font-weight: bold;
    }

    .ui-datepicker th {
        color: #555;
        font-weight: bold;
    }

    .ui-datepicker td a.ui-state-default {
        text-align: center;
        background: #f8f9fa;
        border: none;
        color: #333;
    }

    .ui-datepicker td a.ui-state-default.ui-state-hover {
        background: #e9ecef;
    }

    .ui-datepicker td a.ui-state-default.ui-state-active {
        background: #007bff;
        color: white;
    }

    .ui-datepicker .ui-datepicker-prev,
    .ui-datepicker .ui-datepicker-next {
        background: transparent;
        border: none;
        cursor: pointer;
    }

    .ui-datepicker .ui-datepicker-prev span,
    .ui-datepicker .ui-datepicker-next span {
        filter: brightness(0) invert(1);
    }

    /* Perbaikan tampilan tabel */
    .table th,
    .table td {
        vertical-align: middle;
    }

    .table-hover tbody tr:hover {
        background-color: rgba(0, 123, 255, 0.05);
    }

    /* Perbaikan tampilan card */
    .card {
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
        border: none;
        margin-bottom: 1.5rem;
    }

    .card-header {
        background-color: #f8f9fc;
        border-bottom: 1px solid #e3e6f0;
        padding: 1rem 1.25rem;
    }

    /* Styling untuk card statistik */
    .border-left-primary,
    .border-left-success,
    .border-left-info,
    .border-left-warning {
        border-left: 0.25rem solid;
        border-radius: 0.35rem;
        transition: all 0.3s ease;
        padding-left: 1.5rem;
        padding-right: 1.5rem;
    }

    /* Padding untuk card statistik */
    .stat-card {
        padding-left: 1.5rem;
        padding-right: 1.5rem;
    }

    .border-left-primary {
        border-left-color: #4e73df;
    }

    .border-left-success {
        border-left-color: #1cc88a;
    }

    .border-left-info {
        border-left-color: #36b9cc;
    }

    .border-left-warning {
        border-left-color: #f6c23e;
    }

    /* Hover effect untuk card */
    .border-left-primary:hover,
    .border-left-success:hover,
    .border-left-info:hover,
    .border-left-warning:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 2rem 0 rgba(58, 59, 69, 0.15);
    }

    /* Warna ikon */
    .text-primary-icon {
        color: rgba(78, 115, 223, 0.7);
    }

    .text-success-icon {
        color: rgba(28, 200, 138, 0.7);
    }

    .text-info-icon {
        color: rgba(54, 185, 204, 0.7);
    }

    .text-warning-icon {
        color: rgba(246, 194, 62, 0.7);
    }
</style>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h4 m-0">Laporan Pendapatan</h1>
        <a href="<?= base_url('report') ?>" class="btn btn-outline-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="row mb-3">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-header py-3 bg-primary">
                    <h6 class="m-0 font-weight-bold text-white">Filter Laporan</h6>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('report/income'); ?>" method="get" class="row align-items-end">
                        <div class="col-md-4 col-sm-6 mb-2">
                            <label for="from_date" class="form-label">Dari Tanggal:</label>
                            <div class="input-group">
                                <input type="date" class="form-control" id="from_date" name="from_date" value="<?= $from_date; ?>" required>
                                <div class="input-group-append">
                                    <div class="input-group-text"><i class="fas fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 mb-2">
                            <label for="to_date" class="form-label">Sampai Tanggal:</label>
                            <div class="input-group">
                                <input type="date" class="form-control" id="to_date" name="to_date" value="<?= $to_date; ?>" required>
                                <div class="input-group-append">
                                    <div class="input-group-text"><i class="fas fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12 mb-2">
                            <div class="d-flex flex-wrap">
                                <button type="submit" class="btn btn-primary me-2 mb-2">
                                    <i class="fas fa-filter"></i> Filter
                                </button>
                                <a href="<?= base_url('report/export_pdf?from_date=' . $from_date . '&to_date=' . $to_date); ?>" class="btn btn-danger me-2 mb-2" target="_blank">
                                    <i class="fas fa-file-pdf"></i> Export PDF
                                </a>
                                <a href="<?= base_url('report/export_excel?from_date=' . $from_date . '&to_date=' . $to_date); ?>" class="btn btn-success mb-2">
                                    <i class="fas fa-file-excel"></i> Export Excel
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Ringkasan Laporan -->
    <div class="row mb-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Ringkasan Laporan</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Total Pendapatan -->
                        <div class="col-xl-3 col-md-6 col-sm-6 mb-3">
                            <div class="card border-left-primary shadow h-100 stat-card">
                                <div class="card-body py-2 px-0">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Pendapatan</div>
                                            <div class="h4 mb-0 font-weight-bold text-gray-800">Rp <?= number_format($total_income, 0, ',', '.'); ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-money-bill-wave fa-2x text-primary-icon"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Jumlah Transaksi -->
                        <div class="col-xl-3 col-md-6 col-sm-6 mb-3">
                            <div class="card border-left-success shadow h-100 stat-card">
                                <div class="card-body py-2 px-0">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah Transaksi</div>
                                            <div class="h4 mb-0 font-weight-bold text-gray-800"><?= $transaction_count; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-shopping-cart fa-2x text-success-icon"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Rata-rata Transaksi -->
                        <div class="col-xl-3 col-md-6 col-sm-6 mb-3">
                            <div class="card border-left-info shadow h-100 stat-card">
                                <div class="card-body py-2 px-0">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Rata-rata Transaksi</div>
                                            <div class="h4 mb-0 font-weight-bold text-gray-800">Rp <?= number_format($average_income, 0, ',', '.'); ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calculator fa-2x text-info-icon"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Periode Laporan -->
                        <div class="col-xl-3 col-md-6 col-sm-6 mb-3">
                            <div class="card border-left-warning shadow h-100 stat-card">
                                <div class="card-body py-2 px-0">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Periode Laporan</div>
                                            <div class="h4 mb-0 font-weight-bold text-gray-800"><?= date('d/m/Y', strtotime($from_date)); ?> s/d <?= date('d/m/Y', strtotime($to_date)); ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-warning-icon"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik Pendapatan Harian -->
    <div class="row mb-3" hidden>
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Grafik Pendapatan Harian</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Opsi Grafik:</div>
                            <a class="dropdown-item" href="#" onclick="downloadChart('dailyIncomeChart', 'grafik_pendapatan.png'); return false;">Download Gambar</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" onclick="toggleChartType(); return false;">Ubah Tipe Grafik</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div style="height: 300px;">
                        <canvas id="dailyIncomeChart"></canvas>
                    </div>
                    <div class="mt-2 text-center d-md-none">
                        <small class="text-muted">Geser ke kanan/kiri untuk melihat data lengkap</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Diagram Batang Produk Terjual -->
    <div class="row mb-3" hidden>
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Ringkasan Produk Terjual</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink2">
                            <div class="dropdown-header">Opsi Grafik:</div>
                            <a class="dropdown-item" href="#" onclick="downloadChart('productCategoryChart', 'grafik_produk.png'); return false;">Download Gambar</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" onclick="toggleCategoryChartType(); return false;">Ubah Tipe Grafik</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-8">
                            <div style="height: 300px;">
                                <canvas id="productCategoryChart"></canvas>
                            </div>
                            <div class="mt-2 text-center d-md-none">
                                <small class="text-muted">Geser ke kanan/kiri untuk melihat data lengkap</small>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card border-left-success shadow h-100">
                                <div class="card-body">
                                    <h6 class="font-weight-bold text-success mb-3">Ringkasan Produk</h6>
                                    <div class="table-responsive">
                                        <table class="table table-sm table-borderless">
                                            <tbody id="categorySummary">
                                                <!-- Data produk akan diisi oleh JavaScript -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Data Pendapatan -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Pendapatan</h6>
                </div>
                <div class="card-body">
                    <div class="mt-2 mb-3 text-center d-md-none">
                        <small class="text-muted">Geser ke kanan/kiri untuk melihat data lengkap</small>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="example1" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 50px;">No</th>
                                    <th>No. Invoice</th>
                                    <th>Tanggal</th>
                                    <th>Customer</th>
                                    <th class="text-right">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($income_data)) : ?>
                                    <tr>
                                        <td colspan="5" class="text-center">Tidak ada data untuk periode ini</td>
                                    </tr>
                                <?php else : ?>
                                    <?php $no = 1; ?>
                                    <?php foreach ($income_data as $data) : ?>
                                        <tr>
                                            <td class="text-center"><?= $no++; ?></td>
                                            <!-- <td><a href="<?= base_url('order/invoice/' . $data->id_selling); ?>" target="_blank"><?= $data->no_invoice; ?></a></td> -->
                                            <td><?= $data->no_invoice; ?></td>
                                            <td><?= date('d/m/Y H:i', strtotime($data->created_at)); ?></td>
                                            <td><?= $data->customer_name ?: '-'; ?></td>
                                            <td class="text-right">Rp <?= number_format($data->total_price, 0, ',', '.'); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                            <tfoot>
                                <tr class="bg-light">
                                    <th colspan="4" class="text-right">Total</th>
                                    <th class="text-right">Rp <?= number_format($total_income, 0, ',', '.'); ?></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Fungsi untuk mengubah tipe grafik
        function toggleChartType() {
            if (myLineChart.config.type === 'line') {
                myLineChart.config.type = 'bar';
            } else {
                myLineChart.config.type = 'line';
            }
            myLineChart.update();
        }

        // Fungsi untuk mengubah tipe grafik kategori
        function toggleCategoryChartType() {
            if (categoryChart.config.type === 'bar') {
                categoryChart.config.type = 'pie';
                // Sesuaikan opsi untuk pie chart
                categoryChart.options.scales.x.display = false;
                categoryChart.options.scales.y.display = false;
                categoryChart.options.plugins.legend.display = true;
            } else {
                categoryChart.config.type = 'bar';
                // Kembalikan opsi untuk bar chart
                categoryChart.options.scales.x.display = true;
                categoryChart.options.scales.y.display = true;
                categoryChart.options.plugins.legend.display = false;
            }
            categoryChart.update();
        }

        // Fungsi untuk download grafik sebagai gambar
        function downloadChart(chartId, filename) {
            var canvas = document.getElementById(chartId);
            var image = canvas.toDataURL("image/png");
            var link = document.createElement('a');
            link.download = filename;
            link.href = image;
            link.click();
        }
    </script>

</div>
<!-- /.container-fluid -->

<!-- Script untuk validasi tanggal dan grafik -->
<script>
    // Pastikan tidak ada konflik jQuery
    var jq = $.noConflict();

    // Inisialisasi validasi tanggal
    jq(function($) {
        // Dapatkan tanggal hari ini dalam format YYYY-MM-DD
        var today = new Date().toISOString().split('T')[0];

        // Set atribut max pada input tanggal agar tidak bisa memilih tanggal di masa depan
        $('#from_date, #to_date').attr('max', today);

        // Event listener untuk input tanggal
        $('#from_date').on('change', function() {
            var fromDate = $(this).val();
            $('#to_date').attr('min', fromDate);

            // Jika tanggal akhir lebih awal dari tanggal awal, sesuaikan
            if ($('#to_date').val() && $('#to_date').val() < fromDate) {
                $('#to_date').val(fromDate);
            }
        });

        $('#to_date').on('change', function() {
            var toDate = $(this).val();
            $('#from_date').attr('max', toDate);

            // Jika tanggal awal lebih akhir dari tanggal akhir, sesuaikan
            if ($('#from_date').val() && $('#from_date').val() > toDate) {
                $('#from_date').val(toDate);
            }
        });

        // Validasi tanggal sebelum submit
        $('form').submit(function(e) {
            var fromDate = $('#from_date').val();
            var toDate = $('#to_date').val();

            if (!fromDate || !toDate) {
                alert('Silakan pilih rentang tanggal terlebih dahulu');
                e.preventDefault();
                return false;
            }

            var fromDateObj = new Date(fromDate);
            var toDateObj = new Date(toDate);

            if (fromDateObj > toDateObj) {
                alert('Tanggal awal tidak boleh lebih besar dari tanggal akhir');
                e.preventDefault();
                return false;
            }

            return true;
        });

        // Tambahkan event click pada ikon kalender untuk fokus ke input
        $('.input-group-text').on('click', function() {
            $(this).closest('.input-group').find('input[type="date"]').focus();
        });
    });

    // Inisialisasi DataTable
    jq(function($) {
        $("#example1").DataTable({
            "responsive": true,
            "autoWidth": false,
            "scrollX": true,
            "order": [
                [2, "desc"]
            ], // Urutkan berdasarkan tanggal (kolom ke-3) secara descending
            "language": {
                "lengthMenu": "Tampilkan _MENU_ data per halaman",
                "zeroRecords": "Data tidak ditemukan",
                "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                "infoEmpty": "Tidak ada data yang tersedia",
                "infoFiltered": "(difilter dari _MAX_ total data)",
                "search": "Cari:",
                "paginate": {
                    "first": "Pertama",
                    "last": "Terakhir",
                    "next": "Selanjutnya",
                    "previous": "Sebelumnya"
                }
            },
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "Semua"]
            ],
            "columnDefs": [{
                    "width": "50px",
                    "targets": 0
                }, // Kolom No
                {
                    "width": "120px",
                    "targets": 1
                }, // Kolom No. Invoice
                {
                    "width": "120px",
                    "targets": 2
                }, // Kolom Tanggal
                {
                    "width": "200px",
                    "targets": 3
                }, // Kolom Customer
                {
                    "width": "100px",
                    "targets": 4,
                    "className": "text-right"
                } // Kolom Total
            ],
            "dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            "drawCallback": function(settings) {
                // Tambahkan class untuk styling yang lebih baik
                $('.dataTables_wrapper .dataTables_length select').addClass('custom-select custom-select-sm form-control form-control-sm');
                $('.dataTables_wrapper .dataTables_filter input').addClass('form-control form-control-sm');
            }
        });
    });

    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.font.family = 'Poppins, -apple-system, system-ui, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif';
    Chart.defaults.color = '#858796';

    // Fungsi untuk format angka
    function number_format(number, decimals, dec_point, thousands_sep) {
        // *     example: number_format(1234.56, 2, ',', ' ');
        // *     return: '1 234,56'
        number = (number + '').replace(',', '').replace(' ', '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? '.' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? ',' : dec_point,
            s = '',
            toFixedFix = function(n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
    }

    // Data untuk grafik
    var dailyIncomeData = <?= json_encode($daily_income); ?>;
    var labels = [];
    var data = [];

    // Siapkan data untuk grafik
    dailyIncomeData.forEach(function(item) {
        labels.push(item.date);
        data.push(item.total);
    });

    // Fungsi untuk memformat tanggal
    function formatDate(dateStr) {
        var date = new Date(dateStr);
        var day = ('0' + date.getDate()).slice(-2);
        var month = ('0' + (date.getMonth() + 1)).slice(-2);
        return day + '/' + month;
    }

    // Memformat label tanggal untuk tampilan yang lebih baik
    var formattedLabels = [];
    for (var i = 0; i < labels.length; i++) {
        formattedLabels.push(formatDate(labels[i]));
    }

    // Buat grafik pendapatan harian
    var ctx = document.getElementById("dailyIncomeChart");
    if (ctx && typeof Chart !== 'undefined') {
        var myLineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: formattedLabels,
                datasets: [{
                    label: "Pendapatan",
                    tension: 0.3,
                    backgroundColor: "rgba(78, 115, 223, 0.05)",
                    borderColor: "rgba(78, 115, 223, 1)",
                    pointRadius: 3,
                    pointBackgroundColor: "rgba(78, 115, 223, 1)",
                    pointBorderColor: "rgba(78, 115, 223, 1)",
                    pointHoverRadius: 3,
                    pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                    pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                    pointHitRadius: 10,
                    pointBorderWidth: 2,
                    data: data,
                    fill: true
                }],
            },
            options: {
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        left: 10,
                        right: 25,
                        top: 25,
                        bottom: 0
                    }
                },
                scales: {
                    x: {
                        time: {
                            unit: 'date'
                        },
                        grid: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            maxTicksLimit: 10,
                            font: {
                                size: 10
                            }
                        }
                    },
                    y: {
                        ticks: {
                            maxTicksLimit: 5,
                            padding: 10,
                            // Include a rupiah sign in the ticks
                            callback: function(value, index, values) {
                                return 'Rp ' + number_format(value);
                            },
                            font: {
                                size: 10
                            }
                        },
                        grid: {
                            color: "rgb(234, 236, 244)",
                            zeroLineColor: "rgb(234, 236, 244)",
                            drawBorder: false,
                            borderDash: [2],
                            zeroLineBorderDash: [2]
                        },
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: "rgb(255,255,255)",
                        bodyColor: "#858796",
                        titleMarginBottom: 10,
                        titleColor: '#6e707e',
                        titleFont: {
                            size: 14,
                            family: 'Poppins, sans-serif'
                        },
                        borderColor: '#dddfeb',
                        borderWidth: 1,
                        padding: 15,
                        displayColors: false,
                        intersect: false,
                        mode: 'index',
                        caretPadding: 10,
                        callbacks: {
                            title: function(tooltipItems) {
                                // Tampilkan tanggal lengkap di tooltip
                                var index = tooltipItems[0].dataIndex;
                                var originalDate = new Date(labels[index]);
                                return originalDate.toLocaleDateString('id-ID', {
                                    day: '2-digit',
                                    month: '2-digit',
                                    year: 'numeric'
                                });
                            },
                            label: function(context) {
                                var datasetLabel = context.dataset.label || '';
                                return datasetLabel + ': Rp ' + number_format(context.parsed.y);
                            }
                        }
                    }
                },
                responsive: true
            }
        });
    } else {
        console.error('Chart.js tidak tersedia atau elemen canvas tidak ditemukan untuk grafik pendapatan harian');
    }

    // Data untuk diagram batang kategori produk
    // Debug: Tampilkan data produk
    console.log('Product Categories Data:', <?= json_encode(isset($product_categories) ? $product_categories : []); ?>);

    // Gunakan data dummy jika tidak ada data
    var categoryData = <?= json_encode(isset($product_categories) && !empty($product_categories) ? $product_categories : [
                            ['category' => 'Coconut Milk Powder', 'count' => 10, 'total' => 550000],
                            ['category' => 'Organic Coconut Sugar', 'count' => 8, 'total' => 280000],
                            ['category' => 'Virgin Coconut Oil', 'count' => 5, 'total' => 400000],
                            ['category' => 'testing 2', 'count' => 3, 'total' => 60000]
                        ]); ?>;

    // Siapkan data untuk diagram batang kategori
    var categoryLabels = [];
    var categoryCount = [];
    var categoryTotal = [];
    var backgroundColors = [
        'rgba(78, 115, 223, 0.8)',
        'rgba(28, 200, 138, 0.8)',
        'rgba(246, 194, 62, 0.8)',
        'rgba(231, 74, 59, 0.8)',
        'rgba(54, 185, 204, 0.8)',
        'rgba(104, 109, 224, 0.8)',
        'rgba(129, 236, 236, 0.8)',
        'rgba(250, 177, 160, 0.8)',
        'rgba(253, 121, 168, 0.8)',
        'rgba(120, 111, 166, 0.8)'
    ];

    // Siapkan data untuk diagram batang kategori
    categoryData.forEach(function(item, index) {
        categoryLabels.push(item.category);
        categoryCount.push(item.count);
        categoryTotal.push(item.total);
    });

    // Isi tabel ringkasan kategori
    var categorySummaryHtml = '';
    categoryData.forEach(function(item, index) {
        var color = backgroundColors[index % backgroundColors.length];
        categorySummaryHtml += '<tr>' +
            '<td><i class="fas fa-square" style="color: ' + color + '"></i> ' + item.category + '</td>' +
            '<td class="text-right">' + item.count + ' item</td>' +
            '<td class="text-right">Rp ' + number_format(item.total) + '</td>' +
            '</tr>';
    });
    document.getElementById('categorySummary').innerHTML = categorySummaryHtml;

    // Debug: Periksa apakah Chart.js tersedia
    console.log('Chart object available:', typeof Chart !== 'undefined');
    console.log('Canvas element found:', document.getElementById("productCategoryChart") !== null);

    // Buat diagram batang kategori produk
    var ctxCategory = document.getElementById("productCategoryChart");
    if (ctxCategory && typeof Chart !== 'undefined') {
        var categoryChart = new Chart(ctxCategory, {
            type: 'bar',
            data: {
                labels: categoryLabels,
                datasets: [{
                    label: "Jumlah Terjual",
                    backgroundColor: backgroundColors,
                    borderColor: "rgba(78, 115, 223, 1)",
                    borderWidth: 1,
                    data: categoryCount,
                }],
            },
            options: {
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        left: 10,
                        right: 25,
                        top: 25,
                        bottom: 0
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            font: {
                                size: 10
                            }
                        }
                    },
                    y: {
                        ticks: {
                            maxTicksLimit: 5,
                            padding: 10,
                            precision: 0,
                            font: {
                                size: 10
                            }
                        },
                        grid: {
                            color: "rgb(234, 236, 244)",
                            zeroLineColor: "rgb(234, 236, 244)",
                            drawBorder: false,
                            borderDash: [2],
                            zeroLineBorderDash: [2]
                        },
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: "rgb(255,255,255)",
                        bodyColor: "#858796",
                        titleMarginBottom: 10,
                        titleColor: '#6e707e',
                        titleFont: {
                            size: 14,
                            family: 'Poppins, sans-serif'
                        },
                        borderColor: '#dddfeb',
                        borderWidth: 1,
                        padding: 15,
                        displayColors: false,
                        intersect: false,
                        mode: 'index',
                        caretPadding: 10,
                        callbacks: {
                            title: function(tooltipItems) {
                                return tooltipItems[0].label;
                            },
                            label: function(context) {
                                return 'Jumlah: ' + context.parsed.y + ' item';
                            },
                            afterLabel: function(context) {
                                var index = context.dataIndex;
                                return 'Total: Rp ' + number_format(categoryTotal[index]);
                            }
                        }
                    }
                },
                responsive: true
            }
        });
    } else {
        console.error('Chart.js tidak tersedia atau elemen canvas tidak ditemukan untuk grafik kategori produk');
    }
</script>