<!-- CSS untuk tampilan sederhana -->
<style>
    .customer-card {
        transition: all 0.3s ease;
        border: none;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .customer-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .customer-card .card-body {
        padding: 1.5rem;
    }

    .customer-icon {
        font-size: 2.5rem;
        margin-bottom: 1rem;
    }

    .customer-title {
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .customer-description {
        color: #6c757d;
        font-size: 0.9rem;
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

        .card {
            margin-bottom: 1rem;
        }

        .text-xs {
            font-size: 0.7rem;
        }

        .stat-card {
            padding-left: 1rem;
            padding-right: 1rem;
        }
    }

    /* Perbaikan untuk tampilan mobile */
    @media (max-width: 575.98px) {
        .row.mb-4 {
            margin-left: -5px;
            margin-right: -5px;
        }

        .row.mb-4>div {
            padding-left: 5px;
            padding-right: 5px;
        }

        .stat-card {
            padding-left: 0.75rem;
            padding-right: 0.75rem;
        }

        .col-auto {
            display: none;
        }
    }

    /* Perbaikan tampilan tabel */
    .table th,
    .table td {
        vertical-align: middle;
        padding: 0.75rem 1rem;
    }

    .table th {
        font-weight: 600;
        background-color: #f8f9fc;
    }

    .table-hover tbody tr:hover {
        background-color: rgba(0, 123, 255, 0.05);
    }

    .table-bordered {
        border: 1px solid #e3e6f0;
    }

    .table-bordered th,
    .table-bordered td {
        border: 1px solid #e3e6f0;
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

    /* Padding untuk card statistik */
    .stat-card {
        padding-left: 1.5rem;
        padding-right: 1.5rem;
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 2rem 0 rgba(58, 59, 69, 0.15);
    }

    /* Perbaikan tampilan DataTable */
    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter {
        margin-bottom: 0.75rem;
    }

    .dataTables_wrapper .dataTables_info {
        padding-top: 0.5rem;
    }

    .dataTables_wrapper .dataTables_paginate {
        padding-top: 0.5rem;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        padding: 0.3rem 0.6rem;
    }
</style>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h4 m-0">Laporan Customer</h1>
        <a href="<?= base_url('report') ?>" class="btn btn-outline-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <!-- Statistik Customer -->
    <div class="row mb-4">
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-left-primary shadow h-100 stat-card">
                <div class="card-body py-2 px-0">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-2">
                                Total Customer</div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800"><?= count($customers) ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-primary opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-left-success shadow h-100 stat-card">
                <div class="card-body py-2 px-0">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-2">
                                Total Pesanan</div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800">
                                <?php
                                $total_orders = 0;
                                foreach ($customers as $customer) {
                                    $total_orders += $customer->total_orders;
                                }
                                echo $total_orders;
                                ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-shopping-cart fa-2x text-success opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-left-info shadow h-100 stat-card">
                <div class="card-body py-2 px-0">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-2">
                                Rata-rata Pesanan per Customer</div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800">
                                <?php
                                $avg_orders = count($customers) > 0 ? round($total_orders / count($customers), 1) : 0;
                                echo $avg_orders;
                                ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-info opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-left-warning shadow h-100 stat-card">
                <div class="card-body py-2 px-0">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-2">
                                Total Pendapatan</div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800">
                                <?php
                                $total_spent = 0;
                                foreach ($customers as $customer) {
                                    $total_spent += $customer->total_spent;
                                }
                                echo 'Rp ' . number_format($total_spent, 0, ',', '.');
                                ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-warning opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Data Customer -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Data Customer</h6>
                    <div class="small text-muted">Total: <?= count($customers) ?> customer</div>
                </div>
                <div class="card-body p-0">
                    <div class="mt-3 mb-3 text-center d-md-none px-3">
                        <small class="text-muted">Geser ke kanan/kiri untuk melihat data lengkap</small>
                    </div>
                    <div class="table-responsive px-3 py-2">
                        <table class="table table-hover table-bordered" id="example1" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 50px;">No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>No. Telepon</th>
                                    <th class="text-center">Jumlah Pesanan</th>
                                    <th class="text-right">Total Belanja</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($customers as $customer) : ?>
                                    <tr>
                                        <td class="text-center"><?= $no++; ?></td>
                                        <td><?= $customer->name; ?></td>
                                        <td><?= $customer->email; ?></td>
                                        <td><?= $customer->phone ?: '-'; ?></td>
                                        <td class="text-center"><?= $customer->total_orders; ?></td>
                                        <td class="text-right">Rp <?= number_format($customer->total_spent, 0, ',', '.'); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="4" class="text-right">Total</th>
                                    <th class="text-center"><?= $total_orders; ?></th>
                                    <th class="text-right">Rp <?= number_format($total_spent, 0, ',', '.'); ?></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<!-- Script untuk datatable -->
<script>
    // Pastikan tidak ada konflik jQuery
    var jq = $.noConflict();

    // Inisialisasi DataTable
    jq(function($) {
        $("#example1").DataTable({
            "responsive": true,
            "autoWidth": false,
            "scrollX": true,
            "order": [
                [5, "desc"]
            ], // Urutkan berdasarkan total belanja (kolom ke-6) secara descending
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
                    "width": "200px",
                    "targets": 1
                }, // Kolom Nama
                {
                    "width": "200px",
                    "targets": 2
                }, // Kolom Email
                {
                    "width": "150px",
                    "targets": 3
                }, // Kolom No. Telepon
                {
                    "width": "120px",
                    "targets": 4,
                    "className": "text-center"
                }, // Kolom Jumlah Pesanan
                {
                    "width": "150px",
                    "targets": 5,
                    "className": "text-right"
                } // Kolom Total Belanja
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
</script>