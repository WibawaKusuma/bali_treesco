<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="text-center mb-0">Form Update Data Kandidat</h5>
                </div>
                <div class="card-body">
                    <form id="formUpdateKandidat" method="POST" enctype="multipart/form-data" action="<?= base_url('admin/update_kandidat/' . $detail_kandidat->id_detail); ?>">
                        <input type="hidden" id="id_detail" name="id_detail" value="<?= $detail_kandidat->id_detail; ?>">

                        <div class="mb-3">
                            <label for="no_acara" class="form-label">No Acara</label>
                            <input type="text" class="form-control" id="no_acara" name="no_acara" value="<?= $detail_kandidat->no_acara; ?>" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="nama_kandidat" class="form-label">Nama Kandidat</label>
                            <input type="text" class="form-control" id="nama_kandidat" name="nama_kandidat" value="<?= $detail_kandidat->nama_kandidat; ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="visi" class="form-label">Visi</label>
                            <textarea class="form-control" id="visi" name="visi" rows="2" required><?= $detail_kandidat->visi; ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="misi" class="form-label">Misi</label>
                            <textarea class="form-control" id="misi" name="misi" rows="3" required><?= $detail_kandidat->misi; ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Foto Kandidat</label>
                            <input type="file" class="form-control" id="image" name="image">
                            <small class="text-muted">Kosongkan jika tidak ingin mengganti foto.</small>
                            <div class="mt-3 text-center">
                                <label>Foto Lama:</label><br>
                                <img src="<?= base_url('assets/template/img/kandidat/' . $detail_kandidat->image); ?>" width="200px" alt="Foto Kandidat">
                            </div>
                        </div>

                        <div class="mb-3 text-center">
                            <button type="submit" class="btn btn-primary">Perbarui Kandidat</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>