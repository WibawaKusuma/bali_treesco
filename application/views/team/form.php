<div class="container py-4" style="max-width: 1000px;">
    <div class="card shadow-lg border-0 rounded-lg">
        <div class="card-header bg-primary text-white text-center py-3">
            <h4 class="mb-0">
                <i class="fas fa-<?= !empty($team) ? 'edit' : 'plus-circle' ?> me-2"></i>
                <?= !empty($team) ? 'Edit Anggota Tim' : 'Tambah Anggota Tim Baru' ?>
            </h4>
        </div>
        <div class="card-body p-4">
            <form action="<?= !empty($team) ? base_url('team/update/' . $team->id_team) : base_url('team/create_team') ?>" method="post" enctype="multipart/form-data">

                <!-- Input ID (Hidden) -->
                <input type="hidden" name="p[id_team]" value="<?= !empty($team) ? $team->id_team : '' ?>">

                <div class="row">
                    <div class="col-md-8">
                        <!-- Informasi Dasar -->
                        <div class="card mb-4 border-0 shadow-sm">
                            <div class="card-header bg-light">
                                <h5 class="mb-0"><i class="fas fa-user me-2"></i>Informasi Dasar</h5>
                            </div>
                            <div class="card-body">
                                <!-- Input Nama -->
                                <div class="form-group mb-3">
                                    <label for="name" class="form-label fw-bold">Nama Lengkap</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="fas fa-user"></i></span>
                                        <input type="text" id="name" name="p[name]" value="<?= !empty($team) ? $team->name : '' ?>"
                                            class="form-control" placeholder="Masukkan nama lengkap" required>
                                    </div>
                                    <small class="text-muted">Nama akan ditampilkan sebagai nama anggota tim</small>
                                </div>

                                <!-- Input Deskripsi -->
                                <div class="form-group mb-3">
                                    <label for="description" class="form-label fw-bold">Deskripsi / Jabatan</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="fas fa-briefcase"></i></span>
                                        <input type="text" id="description" name="p[description]" value="<?= !empty($team) ? $team->description : '' ?>"
                                            class="form-control" placeholder="Masukkan deskripsi atau jabatan" required>
                                    </div>
                                    <!-- <small class="text-muted">Contoh: Marketing Manager, CEO, Designer, dll</small> -->
                                </div>

                                <!-- Input Status -->
                                <div class="form-group">
                                    <label for="status" class="form-label fw-bold">Status</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="fas fa-toggle-on"></i></span>
                                        <select id="status" name="p[status]" class="form-select" required>
                                            <option value="">-- Pilih Status --</option>
                                            <option value="1" <?= isset($team->status) && $team->status === '1' ? 'selected="selected"' : '' ?>>Aktif</option>
                                            <option value="0" <?= isset($team->status) && $team->status === '0' ? 'selected="selected"' : '' ?>>Tidak Aktif</option>
                                        </select>
                                    </div>
                                    <!-- <small class="text-muted">Anggota tim dengan status tidak aktif tidak akan ditampilkan</small> -->
                                </div>
                            </div>
                        </div>

                        <!-- Informasi Kontak -->
                        <div class="card mb-4 border-0 shadow-sm">
                            <div class="card-header bg-light">
                                <h5 class="mb-0"><i class="fas fa-address-book me-2"></i>Informasi Kontak</h5>
                            </div>
                            <div class="card-body">
                                <!-- Input Instagram -->
                                <div class="form-group mb-3">
                                    <label for="instagram" class="form-label fw-bold">Instagram</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="fab fa-instagram"></i></span>
                                        <input type="text" id="instagram" name="p[instagram]" value="<?= !empty($team) ? $team->instagram : '' ?>"
                                            class="form-control" placeholder="Masukkan username Instagram (tanpa @)" required>
                                    </div>
                                    <small class="text-muted">Contoh: balitreesco (tanpa @)</small>
                                </div>

                                <!-- Input TikTok -->
                                <div class="form-group mb-3">
                                    <label for="tiktok" class="form-label fw-bold">TikTok</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="fab fa-tiktok"></i></span>
                                        <input type="text" id="tiktok" name="p[tiktok]" value="<?= !empty($team) ? $team->tiktok : '' ?>"
                                            class="form-control" placeholder="Masukkan username TikTok (tanpa @)" required>
                                    </div>
                                    <small class="text-muted">Contoh: balitreesco (tanpa @)</small>
                                </div>

                                <!-- Input Phone -->
                                <div class="form-group">
                                    <label for="phone" class="form-label fw-bold">Nomor WhatsApp</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="fab fa-whatsapp"></i></span>
                                        <input type="text" id="phone" name="p[phone]" value="<?= !empty($team) ? $team->phone : '' ?>"
                                            class="form-control" placeholder="Masukkan nomor WhatsApp (format: 628xxxxxxxxxx)" required>
                                    </div>
                                    <small class="text-muted">Contoh: 6281234567890 (tanpa tanda + atau spasi)</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <!-- Input Gambar -->
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-light">
                                <h5 class="mb-0"><i class="fas fa-image me-2"></i>Foto Profil</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="custom-file-container">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text bg-light"><i class="fas fa-upload"></i></span>
                                            <input type="file" id="image" name="image" class="form-control"
                                                accept="image/*" <?= empty($team) ? 'required' : '' ?>>
                                        </div>

                                        <div class="image-preview mt-3 text-center">
                                            <?php if (!empty($team) && !empty($team->image)): ?>
                                                <div class="current-image">
                                                    <p class="text-muted mb-2">Foto Saat Ini:</p>
                                                    <div class="position-relative d-inline-block">
                                                        <img src="<?= base_url('assets/img/team/' . $team->image) ?>"
                                                            class="img-thumbnail" style="max-height: 250px;" alt="Current Image">
                                                        <input type="hidden" name="old_image" value="<?= $team->image ?>">
                                                    </div>
                                                </div>
                                            <?php else: ?>
                                                <div class="no-image-placeholder p-4 bg-light rounded text-center">
                                                    <i class="fas fa-user-circle fa-5x text-muted mb-2"></i>
                                                    <p class="text-muted">Belum ada foto. Silakan pilih file gambar.</p>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <small class="text-muted d-block mt-2">Format yang didukung: JPG, JPEG, PNG. Ukuran maksimal: 2MB</small>
                                        <!-- <small class="text-muted d-block">Disarankan menggunakan foto dengan rasio 1:1 (persegi)</small> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <!-- Tombol -->
                <div class="d-flex justify-content-between">
                    <a href="<?= base_url('team') ?>" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fas fa-save me-1"></i> <?= !empty($team) ? 'Update' : 'Simpan' ?>
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
                    previewTitle.textContent = 'Preview Foto:';

                    const previewImg = document.createElement('img');
                    previewImg.src = e.target.result;
                    previewImg.className = 'img-thumbnail';
                    previewImg.style.maxHeight = '250px';

                    previewContainer.appendChild(previewTitle);
                    previewContainer.appendChild(previewImg);
                    imagePreview.appendChild(previewContainer);
                }

                reader.readAsDataURL(this.files[0]);
            }
        });
    });
</script>