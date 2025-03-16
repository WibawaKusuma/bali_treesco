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
        <a href="<?= base_url('galery/create') ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered text-center" id="example1">
                <thead class="thead-info">
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <!-- <th>Type</th>
                        <th>Tahun</th> -->
                        <th><i class="fa fa-gear"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    <?php foreach ($galery as $k): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $k->name ?></td>
                            <!-- <td><?= $k->type ?></td>
                            <td><?= $k->tahun ?></td> -->
                            <td>
                                <a href="<?= base_url('galery/update/' . $k->id_galery) ?>" class="btn btn-warning btn-sm">
                                    <i class="fa fa-pen"></i>
                                </a>
                                <a href="<?= base_url('galery/delete/' . $k->id_galery) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this reservation?');">
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