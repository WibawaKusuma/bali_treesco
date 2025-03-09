<style>
    /* Styling untuk menyembunyikan radio button */
    .form-check-input {
        position: absolute;
        opacity: 0;
    }

    /* Styling tombol ketika radio dipilih */
    .form-check-input:checked+.form-check-label {
        background-color: #198754;
        /* Hijau untuk tombol "Ya" */
        color: #fff;
        border-color: #198754;
    }

    .form-check-input:checked+.form-check-label.btn-outline-danger {
        background-color: #dc3545;
        /* Merah untuk tombol "Tidak" */
        color: #fff;
        border-color: #dc3545;
    }

    /* Tambahan gaya untuk hover */
    .form-check-label:hover {
        background-color: #e9ecef;
        color: #495057;
    }
</style>
<div class="container">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><?= isset($vote) ? 'Edit Vote' : 'Create Vote' ?></h5>
        </div>
        <div class="card-body">
            <!-- Form -->
            <form action="<?= isset($vote) ? base_url('admin/update_vote/' . $vote->no_acara) : base_url('admin/create_vote') ?>" method="post">
                <div class="mb-3 row" hidden>
                    <label for="no_acara" class="col-sm-3 col-form-label">Nomor Acara</label>
                    <div class="col-sm-9">
                        <input type="text" id="no_acara" name="p[no_acara]" class="form-control" value="<?= isset($vote) ? $vote->no_acara : $no_acara ?>" readonly>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="nama_acara" class="col-sm-3 col-form-label">Nama Acara*</label>
                    <div class="col-sm-9">
                        <input type="text" id="nama_acara" name="p[nama_acara]" value="<?= isset($vote) ? $vote->nama_acara : '' ?>" class="form-control" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="tanggal" class="col-sm-3 col-form-label">Tanggal*</label>
                    <div class="col-sm-9">
                        <input type="date" id="tanggal" name="p[tanggal]" value="<?= isset($vote) ? date('Y-m-d', strtotime($vote->tanggal)) : '' ?>" class="form-control" required>
                    </div>
                </div>
                <!-- <div class="mb-3 row">
                    <label for="prodi" class="col-sm-3 col-form-label">Prodi*</label>
                    <div class="col-sm-9">
                        <select id="prodi" name="p[id_prodi]" class="form-control" required>
                            <option value="" disabled>-- Pilih Prodi --</option>
                            <?php foreach ($dropdown_prodi as $prodi): ?>
                                <option value="<?= $prodi->id_prodi ?>" <?= isset($vote) && $vote->id_prodi == $prodi->id_prodi ? 'selected' : '' ?>>
                                    <?= $prodi->deskripsi ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div> -->
                <div class="mb-3 row">
                    <label for="prodi" class="col-sm-3 col-form-label">Prodi*</label>
                    <div class="col-sm-9">
                        <select id="prodi" name="p[id_prodi]" class="form-control" required>
                            <option value="" disabled <?= !isset($vote) ? 'selected' : '' ?>>-- Pilih Prodi --</option>
                            <?php foreach ($dropdown_prodi as $prodi): ?>
                                <option value="<?= $prodi->id_prodi ?>" <?= isset($vote) && $vote->id_prodi == $prodi->id_prodi ? 'selected' : '' ?>>
                                    <?= $prodi->deskripsi ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="status" class="col-sm-3 col-form-label">Status</label>
                    <div class="col-sm-9 d-flex gap-3">
                        <!-- Radio button untuk "Ya" -->
                        <!-- <div class="form-check"> -->
                        <input class="form-check-input" type="radio" name="p[status]" id="status_ya" value="1"
                            <?= !empty($vote) && $vote->status == 1 ? 'checked' : '' ?>>
                        <label class="form-check-label btn btn-sm btn-outline-success px-4 py-2" for="status_ya">
                            <i class="bi bi-check-circle"></i> Aktif
                        </label>
                        <!-- </div> -->
                        <!-- Radio button untuk "Tidak" -->
                        <!-- <div class="form-check"> -->
                        <input class="form-check-input" type="radio" name="p[status]" id="status_tidak" value="0"
                            <?= !empty($vote) && $vote->status == 0 ? 'checked' : '' ?>>
                        <label class="form-check-label btn btn-sm btn-outline-danger px-4 py-2" for="status_tidak">
                            <i class="bi bi-x-circle"></i> Non-aktif
                        </label>
                        <!-- </div> -->
                    </div>
                </div>

                <br>
                <div class="text-end col-md-12">
                    <?php if (isset($vote)) { ?>
                        <a href="<?= base_url('admin') ?>" id="TambahKandidat" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Kandidat</a>
                    <?php } ?>
                </div><br>
                <?php if (isset($vote)) { ?>
                    <?php if (isset($detail_kandidat) && !empty($detail_kandidat)) { ?>
                        <!-- Alert for success message -->
                        <?php if ($this->session->flashdata('success')): ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
                                <?= $this->session->flashdata('success') ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php endif; ?>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th></th>
                                        <th>Nama Kandidat</th>
                                        <th>Visi</th>
                                        <th>Misi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($detail_kandidat as $kandidat) { ?>
                                        <tr>
                                            <td class="text-center" style="width: 10%;">
                                                <!-- Tombol Hapus, menggunakan SweetAlert -->
                                                <button class="btn btn-danger delete-btn fa fa-trash"
                                                    data-id="<?= $kandidat->id_detail ?>"
                                                    data-no-acara="<?= $no_acara ?>">
                                                </button>
                                                <a href="<?php echo base_url('admin/update_kandidat/' . $kandidat->id_detail) ?>" class="btn btn-warning fa fa-pen"></a>
                                            </td>
                                            <td style="width: 30%;"><?= htmlspecialchars($kandidat->nama_kandidat); ?></td>
                                            <td style="width: 30%;"><?= nl2br(htmlspecialchars($kandidat->visi)); ?></td>
                                            <td style="width: 30%;"><?= nl2br(htmlspecialchars($kandidat->misi)); ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    <?php } else { ?>
                        <div class="alert alert-warning" role="alert">
                            Tidak ada kandidat yang tersedia.
                        </div>
                    <?php } ?>
                <?php } ?>
                <div class="text-end"><br>
                    <!-- <?php if (isset($vote)) { ?>
                            <a href="<?= base_url('admin') ?>" id="TambahKandidat" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Kandidat</a>
                        <?php } ?> -->
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> <?= isset($vote) ? 'Update' : 'Save' ?></button>
                    <a href="<?= base_url('admin') ?>" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>






<?php if (isset($vote)) { ?>
    <div class="modal fade" id="modalTambahKandidat" tabindex="-1" aria-labelledby="modalTambahKandidatLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalTambahKandidatLabel">Tambah Kandidat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('admin/create_vote_detail/' . $no_acara) ?>" method="post" id="formTambahKandidat" enctype="multipart/form-data">
                        <div class="mb-3 row" hidden>
                            <label for="no_acara" class="col-sm-3 col-form-label">Nomor Acara</label>
                            <div class="col-sm-9">
                                <input type="text" id="no_acara" name="p[no_acara]" class="form-control" value="<?= $no_acara ?>" readonly>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="nama_kandidat" class="form-label">Nama Kandidat</label>
                            <input type="text" name="d[nama_kandidat]" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="visi" class="form-label">Visi</label>
                            <textarea name="d[visi]" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="misi" class="form-label">Misi</label>
                            <textarea name="d[misi]" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="col-sm-2 col-form-label">Gambar</label>
                            <div class="col-sm-6">
                                <input type="file" id="image" name="image" class="form-control" accept="image/*" <?= empty($acara) ? 'required' : '' ?>>
                                <?php if (!empty($acara) && !empty($acara->image)): ?>
                                    <div class="mt-2">
                                        <img src="<?= base_url('./assets/template/img/kandidat/' . $acara->image) ?>" class="img-thumbnail" width="150" alt="Current Image">
                                        <input type="hidden" name="old_image" value="<?= $acara->image ?>">
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="submit" id="submit_detail" class="btn btn-success">
                                <i class="fa fa-save"></i> Simpan Detail
                            </button>
                            <a href="<?php base_url('admin/update_vote') ?>" class="btn btn-warning">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


<?php } ?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.getElementById('TambahKandidat').addEventListener('click', function(e) {
        e.preventDefault();
        var myModal = new bootstrap.Modal(document.getElementById('modalTambahKandidat'));
        myModal.show();
    });

    document.getElementById('submit_detail').addEventListener('click', function(e) {

        document.getElementById('formTambahKandidat').submit();
    });

    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();

            const kandidatId = this.getAttribute('data-id');
            const noAcara = this.getAttribute('data-no-acara');

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data kandidat ini akan dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `<?= base_url('admin/hapus_kandidat/') ?>${kandidatId}/${noAcara}`;
                }
            });
        });
    });


    setTimeout(function() {
        var alert = document.getElementById('success-alert');
        if (alert) {
            alert.classList.remove('show');
            alert.classList.add('fade');

            setTimeout(function() {
                alert.remove();
            }, 500);
        }
    }, 5000); //5 detik
</script>