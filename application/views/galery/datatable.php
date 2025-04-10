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
                        <th>Status</th>
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
                            <td>
                                <?php if ($k->status == 1): ?>
                                    <span class="badge bg-success">AKTIF</span>
                                <?php else: ?>
                                    <span class="badge bg-danger">NON-AKTIF</span>
                                <?php endif; ?>
                            </td>
                            <!-- <td><?= $k->type ?></td>
                            <td><?= $k->tahun ?></td> -->
                            <td>
                                <a href="<?= base_url('galery/update/' . $k->id_galery) ?>" class="btn btn-warning btn-sm">
                                    <i class="fa fa-pen"></i>
                                </a>
                                <a href="#" class="btn btn-danger btn-sm btn-delete" data-id="<?= $k->id_galery ?>">
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

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Script for the alert -->
<script>
    // Set a timeout to hide the alert after 5 seconds
    $(document).ready(function() {
        setTimeout(function() {
            $('#success-alert').fadeOut('slow');
        }, 3000); // 5000 milliseconds = 5 seconds
    });

    $(document).on('click', '.btn-delete', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        Swal.fire({
            title: 'Apakah kamu yakin?',
            text: "Data ini akan dihapus secara permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '<?= base_url("galery/delete/") ?>' + id;
            }
        });
    });
</script>