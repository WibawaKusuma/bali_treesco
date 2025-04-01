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
    <div class="card-header text-right">
        <a href="<?= base_url('product/create') ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered text-center" id="example1">
                <thead class="thead-info">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <!-- <th>Tahun</th>  -->
                        <th><i class="fa fa-gear"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    <?php foreach ($product as $k): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $k->name ?></td>
                            <td><?= $k->price ?></td>
                            <td>
                                <?php if ($k->status == 1): ?>
                                    <span class="badge bg-success">AKTIF</span>
                                <?php else: ?>
                                    <span class="badge bg-danger">NON-AKTIF</span>
                                <?php endif; ?>
                            </td>
                            <!-- <td><?= $k->tahun ?></td>  -->
                            <td>
                                <a href="<?= base_url('product/update/' . $k->id_product) ?>" class="btn btn-warning btn-sm">
                                    <i class="fa fa-pen"></i>
                                </a>
                                <a href="<?= base_url('product/delete/' . $k->id_product) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this reservation?');">
                                    <i class="fa fa-trash"></i>
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