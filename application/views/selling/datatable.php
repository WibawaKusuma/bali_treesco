<!-- Alert for success message -->
<?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
        <?= $this->session->flashdata('success') ?>
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
                        <th>Nama Barang</th>
                        <th>Nama Pembeli</th>
                        <th>Jumlah Order</th>
                        <th>Nomor Pembeli</th>
                        <th>Tanggal Order</th>
                        <th>Status</th>
                        <!-- <th>Tahun</th>  -->
                        <th><i class="fa fa-gear"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    <?php foreach ($selling as $k): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $k->name ?></td>
                            <td><?= $k->customer_name ?></td>
                            <td><?= $k->qty ?></td>
                            <td><?= $k->customer_phone ?></td>
                            <td><?= $k->created_at ?></td>
                            <td>
                                <?php if ($k->status == 1 && $k->batal == 0): ?>
                                    <span class="badge bg-success">sudah realisasi</span>
                                <?php elseif ($k->status == 0 && $k->batal == 0): ?>
                                    <span class="badge bg-warning text-white">belum realisasi</span>
                                <?php else: ?>
                                    <span class="badge bg-danger">order batal</span>
                                <?php endif; ?>
                            </td>
                            <!-- <td>
                                <a href="<?= base_url('selling/update/' . $k->id_selling) ?>" class="btn btn-warning btn-sm">
                                    <i class="fa fa-rotate-right"></i> Proses
                                </a>
                            </td> -->
                            <td>
                                <a href="<?= base_url('selling/update/' . $k->id_selling) ?>" class="btn btn-info btn-sm text-white">
                                    <!-- <i class="fa fa-rotate-right"></i> -->
                                    proses
                                </a>
                            </td>


                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- jQuery inclusion -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Script for the alert -->
<script>
    // Set a timeout to hide the alert after 5 seconds
    $(document).ready(function() {
        setTimeout(function() {
            $('#success-alert').fadeOut('slow');
        }, 3000); // 5000 milliseconds = 5 seconds
    });
</script>