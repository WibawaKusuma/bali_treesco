<div class="container py-4" style="max-width: 800px;">
    <div class="card shadow-lg border-0 rounded-lg">
        <div class="card-header bg-primary text-white text-center py-3">
            <h4 class="mb-0">
                <i class="fa fa-<?= !empty($galery) ? 'edit' : 'plus-circle' ?> me-2"></i>
                <?= !empty($galery) ? 'Edit Galeri' : 'Tambah Galeri Baru' ?>
            </h4>
        </div>
        <div class="card-body p-4">
            <form action="<?= !empty($galery) ? base_url('galery/update/' . $galery->id_galery) : base_url('galery/create_galery') ?>" method="post" enctype="multipart/form-data">

                <!-- Input ID (Hidden) -->
                <input type="hidden" name="p[id_galery]" value="<?= !empty($galery) ? $galery->id_galery : '' ?>">

                <div class="row">
                    <div class="col-md-6">
                        <!-- Input Nama -->
                        <div class="form-group mb-4">
                            <label for="name" class="form-label fw-bold">Nama Galeri</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="fa fa-image"></i></span>
                                <input type="text" id="name" name="p[name]" value="<?= !empty($galery) ? $galery->name : '' ?>"
                                    class="form-control" placeholder="Masukkan nama galeri" required>
                            </div>
                            <small class="text-muted">Nama galeri akan ditampilkan sebagai judul</small>
                        </div>

                        <!-- Input Status -->
                        <div class="form-group mb-4">
                            <label for="status" class="form-label fw-bold">Status</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="fa fa-toggle-on"></i></span>
                                <select id="status" name="p[status]" class="form-select" required>
                                    <option value="">-- Pilih Status --</option>
                                    <option value="1" <?= isset($galery->status) && $galery->status === '1' ? 'selected="selected"' : '' ?>>Aktif</option>
                                    <option value="0" <?= isset($galery->status) && $galery->status === '0' ? 'selected="selected"' : '' ?>>Tidak Aktif</option>
                                </select>
                            </div>
                            <small class="text-muted">Galeri dengan status tidak aktif tidak akan ditampilkan</small>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <!-- Input Gambar -->
                        <div class="form-group mb-4">
                            <label for="image" class="form-label fw-bold">Gambar</label>
                            <div class="custom-file-container">
                                <div class="input-group mb-3">
                                    <span class="input-group-text bg-light"><i class="fa fa-upload"></i></span>
                                    <input type="file" id="image" name="image" class="form-control"
                                        accept="image/*" <?= empty($galery) ? 'required' : '' ?>>
                                </div>

                                <div class="image-preview mt-3 text-center">
                                    <?php if (!empty($galery) && !empty($galery->image)): ?>
                                        <div class="current-image">
                                            <p class="text-muted mb-2">Gambar Saat Ini:</p>
                                            <div class="position-relative d-inline-block">
                                                <img src="<?= base_url('assets/img/galery/' . $galery->image) ?>"
                                                    class="img-thumbnail" style="max-height: 200px;" alt="Current Image">
                                                <input type="hidden" name="old_image" value="<?= $galery->image ?>">
                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <div class="no-image-placeholder p-4 bg-light rounded text-center">
                                            <i class="fa fa-image fa-3x text-muted mb-2"></i>
                                            <p class="text-muted">Belum ada gambar. Silakan pilih file gambar.</p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <small class="text-muted d-block mt-2">Format yang didukung: JPG, JPEG, PNG. Ukuran maksimal: 2MB</small>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <!-- Tombol -->
                <div class="d-flex justify-content-between">
                    <a href="<?= base_url('galery') ?>" class="btn btn-outline-secondary">
                        <i class="fa fa-arrow-left me-1"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fa fa-save me-1"></i> <?= !empty($galery) ? 'Update' : 'Simpan' ?>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Script untuk preview gambar -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const imageInput = document.getElementById('image');
        const imagePreview = document.querySelector('.image-preview');

        imageInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    // Hapus placeholder atau gambar lama jika ada
                    while (imagePreview.firstChild) {
                        imagePreview.removeChild(imagePreview.firstChild);
                    }

                    // Buat elemen preview baru
                    const previewContainer = document.createElement('div');
                    previewContainer.className = 'mt-3';

                    const previewTitle = document.createElement('p');
                    previewTitle.className = 'text-muted mb-2';
                    previewTitle.textContent = 'Preview Gambar:';

                    const previewImg = document.createElement('img');
                    previewImg.src = e.target.result;
                    previewImg.className = 'img-thumbnail';
                    previewImg.style.maxHeight = '200px';

                    previewContainer.appendChild(previewTitle);
                    previewContainer.appendChild(previewImg);
                    imagePreview.appendChild(previewContainer);
                }

                reader.readAsDataURL(this.files[0]);
            }
        });
    });
</script>