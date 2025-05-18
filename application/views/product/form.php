<div class="container py-4" style="max-width: 1000px;">
    <div class="card shadow-lg border-0 rounded-lg">
        <div class="card-header bg-primary text-white text-center py-3">
            <h4 class="mb-0">
                <i class="fas fa-<?= !empty($product) ? 'edit' : 'plus-circle' ?> me-2"></i>
                <?= !empty($product) ? 'Edit Produk' : 'Tambah Produk Baru' ?>
            </h4>
        </div>
        <div class="card-body p-4">
            <form action="<?= !empty($product) ? base_url('product/update/' . $product->id_product) : base_url('product/create_product') ?>" method="post" enctype="multipart/form-data">

                <!-- Input ID (Hidden) -->
                <input type="hidden" name="p[id_product]" value="<?= !empty($product) ? $product->id_product : '' ?>">
                <input type="hidden" name="p[id_user]" value="<?= $user['id_user'] ?>">

                <div class="row">
                    <div class="col-md-8">
                        <!-- Informasi Produk -->
                        <div class="card mb-4 border-0 shadow-sm">
                            <div class="card-header bg-light">
                                <h5 class="mb-0"><i class="fas fa-box me-2"></i>Informasi Produk</h5>
                            </div>
                            <div class="card-body">
                                <!-- Input Nama -->
                                <div class="form-group mb-3">
                                    <label for="name" class="form-label fw-bold">Nama Produk</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="fas fa-tag"></i></span>
                                        <input type="text" id="name" name="p[name]" value="<?= !empty($product) ? $product->name : '' ?>"
                                            class="form-control" placeholder="Masukkan nama produk" required>
                                    </div>
                                    <small class="text-muted">Nama produk akan ditampilkan sebagai judul produk</small>
                                </div>

                                <!-- Input Deskripsi -->
                                <div class="form-group mb-3">
                                    <label for="description" class="form-label fw-bold">Deskripsi Produk</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="fas fa-align-left"></i></span>
                                        <textarea id="description" name="p[description]" class="form-control"
                                            placeholder="Masukkan deskripsi produk" rows="3" required><?= !empty($product) ? $product->description : '' ?></textarea>
                                    </div>
                                    <small class="text-muted">Berikan deskripsi yang jelas tentang produk Anda</small>
                                </div>

                                <!-- Input Harga -->
                                <div class="form-group mb-3">
                                    <label for="price" class="form-label fw-bold">Harga</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="fas fa-money-bill-wave"></i></span>
                                        <span class="input-group-text bg-light">Rp</span>
                                        <input type="number" id="price" name="p[price]" value="<?= !empty($product) ? $product->price : '' ?>"
                                            class="form-control" placeholder="Masukkan harga produk" min="0" required>
                                    </div>
                                    <small class="text-muted">Masukkan harga dalam format angka tanpa titik atau koma</small>
                                </div>

                                <!-- Input Stok (jika edit) -->
                                <?php if (!empty($product)) { ?>
                                    <div class="form-group mb-3">
                                        <label for="stock" class="form-label fw-bold">Stok</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light"><i class="fas fa-cubes"></i></span>
                                            <input type="text" id="stock" name="p[stock]" value="<?= !empty($product) ? $product->stock : '' ?>"
                                                class="form-control bg-light" placeholder="Stok produk" disabled>
                                        </div>
                                        <small class="text-muted">Stok diperbarui otomatis saat ada transaksi</small>
                                    </div>
                                <?php }  ?>

                                <!-- Input Status -->
                                <div class="form-group">
                                    <label for="status" class="form-label fw-bold">Status Produk</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="fas fa-toggle-on"></i></span>
                                        <select id="status" name="p[status]" class="form-select" required>
                                            <option value="">-- Pilih Status --</option>
                                            <option value="1" <?= isset($product->status) && $product->status === '1' ? 'selected="selected"' : '' ?>>Aktif</option>
                                            <option value="0" <?= isset($product->status) && $product->status === '0' ? 'selected="selected"' : '' ?>>Tidak Aktif</option>
                                        </select>
                                    </div>
                                    <small class="text-muted">Produk dengan status tidak aktif tidak akan ditampilkan</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <!-- Input Gambar -->
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-light">
                                <h5 class="mb-0"><i class="fas fa-image me-2"></i>Foto Produk</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="custom-file-container">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text bg-light"><i class="fas fa-upload"></i></span>
                                            <input type="file" id="image" name="image" class="form-control"
                                                accept="image/*" <?= empty($product) ? 'required' : '' ?>>
                                        </div>

                                        <div class="image-preview mt-3 text-center">
                                            <?php if (!empty($product) && !empty($product->image)): ?>
                                                <div class="current-image">
                                                    <p class="text-muted mb-2">Foto Produk Saat Ini:</p>
                                                    <div class="position-relative d-inline-block">
                                                        <img src="<?= base_url('assets/img/product/' . $product->image) ?>"
                                                            class="img-thumbnail" style="max-height: 250px;" alt="Current Image">
                                                        <input type="hidden" name="old_image" value="<?= $product->image ?>">
                                                    </div>
                                                </div>
                                            <?php else: ?>
                                                <div class="no-image-placeholder p-4 bg-light rounded text-center">
                                                    <i class="fas fa-box-open fa-5x text-muted mb-2"></i>
                                                    <p class="text-muted">Belum ada foto. Silakan pilih file gambar.</p>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <small class="text-muted d-block mt-2">Format yang didukung: JPG, JPEG, PNG. Ukuran maksimal: 2MB</small>
                                        <small class="text-muted d-block">Gunakan foto dengan kualitas baik untuk menarik minat pembeli</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <!-- Tombol -->
                <div class="d-flex justify-content-between">
                    <a href="<?= base_url('product') ?>" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fas fa-save me-1"></i> <?= !empty($product) ? 'Update' : 'Simpan' ?>
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

        // Format input harga
        const priceInput = document.getElementById('price');
        if (priceInput) {
            priceInput.addEventListener('input', function() {
                // Hapus karakter selain angka
                this.value = this.value.replace(/[^\d]/g, '');
            });
        }
    });
</script>