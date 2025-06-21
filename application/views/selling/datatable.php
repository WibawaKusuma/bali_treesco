<style>
    /* CSS untuk status pesanan */
    .table-row-pending {
        background-color: #fff3cd !important;
        /* Warna kuning muda untuk pending */
    }

    .table-row-processing {
        background-color: #d1ecf1 !important;
        /* Warna biru muda untuk processing */
    }

    .table-row-completed {
        background-color: #d4edda !important;
        /* Warna hijau muda untuk completed */
    }

    .table-row-cancelled {
        background-color: #f8d7da !important;
        /* Warna merah muda untuk cancelled */
    }
</style>

<!-- Alert for success message -->
<?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
        <?= $this->session->flashdata('success') ?>
        <?php if ($this->session->flashdata('invoice_number')): ?>
            <br>
            <strong>Nomor Invoice:</strong> <?= $this->session->flashdata('invoice_number') ?>
        <?php endif; ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>



<div class="card">
    <!-- <div class="card-header text-right">
        <a href="<?= base_url('selling/create') ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></a>
    </div> -->
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered text-center" id="example1">
                <thead class="thead-info">
                    <tr>
                        <th>No</th>
                        <th>No. Pesanan</th>
                        <th>Nama Pembeli</th>
                        <th>Total Harga</th>
                        <th>Nomor Pembeli</th>
                        <th>Tanggal Order</th>
                        <th>Status</th>
                        <th><i class="fa fa-gear"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    <?php foreach ($selling as $k):
                        // Tentukan class untuk baris berdasarkan status
                        $row_class = '';

                        switch ($k->status) {
                            case 'pending':
                                $row_class = 'table-row-pending';
                                break;
                            case 'processing':
                                $row_class = 'table-row-processing';
                                break;
                            case 'completed':
                                $row_class = 'table-row-completed';
                                break;
                            case 'cancelled':
                                $row_class = 'table-row-cancelled';
                                break;
                        }
                    ?>
                        <tr class="<?= $row_class ?>">
                            <td><?= $no++ ?></td>
                            <td><?= $k->order_number ?></td>
                            <td><?= $k->customer_name ?></td>
                            <td>Rp <?= number_format($k->total_price, 0, ',', '.') ?></td>
                            <td><?= $k->customer_phone ?></td>
                            <td><?= date('d-m-Y H:i', strtotime($k->created_at)) ?></td>
                            <td>
                                <?php
                                switch ($k->status) {
                                    case 'proses':
                                        echo '<span class="badge badge-warning text-dark">Belum di Proses <span class="badge badge-danger ml-1">Baru</span></span>';
                                        break;
                                    case 'selesai':
                                        echo '<span class="badge badge-success"><i class="fa fa-check-circle mr-1"></i> Selesai</span>';
                                        break;
                                    case 'batal':
                                        echo '<span class="badge badge-danger">Dibatalkan</span>';
                                        break;
                                    default:
                                        echo '<span class="badge badge-secondary">Unknown</span>';
                                }
                                ?>
                            </td>
                            <td>
                                <?php if ($k->status == 'proses'): ?>
                                    <a href="<?= base_url('selling/update/' . $k->id_order) ?>" class="btn btn-info btn-sm text-white">
                                        <i class="fa fa-check-circle"></i> Proses
                                    </a>
                                <?php else: ?>
                                    <a href="<?= base_url('selling/update/' . $k->id_order) ?>" class="btn btn-primary btn-sm">
                                        <i class="fa fa-eye"></i> Lihat
                                    </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- jQuery inclusion -->
<script src="<?= base_url('assets/js/lib/jquery/jquery-3.6.0.min.js') ?>"></script>

<!-- Script for the alert -->
<script>
    $(document).ready(function() {
        // Set a timeout to hide the alert after 3 seconds
        setTimeout(function() {
            $('#success-alert').fadeOut('slow');
        }, 3000);

        // Initialize DataTable
        $('#example1').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "language": {
                "search": "Cari:",
                "lengthMenu": "Tampilkan _MENU_ data per halaman",
                "zeroRecords": "Tidak ada data yang ditemukan",
                "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                "infoEmpty": "Tidak ada data yang tersedia",
                "paginate": {
                    "next": "Selanjutnya",
                    "previous": "Sebelumnya"
                }
            }
        });
    });
</script>