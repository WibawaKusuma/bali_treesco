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
        <a href="<?= base_url('admin/create') ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered text-center" id="example1">
                <thead class="thead-info">
                    <tr>
                        <th>Acara Vote</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th><i class="fa fa-gear"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($acaravote as $k): ?>
                        <tr>
                            <td><?= $k->nama_acara ?></td>
                            <td><?= $k->tanggal ?></td>
                            <!-- <td><?= $k->status ?></td> -->
                            <td><?php if ($k->status == 1) {
                                    echo '<p class="text-primary">MULAI</p>';
                                } else {
                                    echo '<p class="text-danger">BELUM MULAI</p>';
                                }
                                ?></td>
                            <td>
                                <a href="<?= base_url('admin/update_vote/' . $k->no_acara) ?>" class="btn btn-warning btn-sm">
                                    <i class="fa fa-pen"></i>
                                </a>
                                <a href="<?= base_url('admin/delete/' . $k->no_acara) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this reservation?');">
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


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
    $(document).ready(function() {
        setTimeout(function() {
            $('#success-alert').fadeOut('slow');
        }, 3000);
    });
</script>