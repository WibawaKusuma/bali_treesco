<div class="container py-4" style="max-width: 800px;">
    <div class="card shadow-lg border-0 rounded-lg">
        <div class="card-header bg-primary text-white text-center py-3">
            <h4 class="mb-0">
                <i class="fas fa-<?= !empty($member) ? 'edit' : 'user-plus' ?> me-2"></i>
                <?= !empty($member) ? 'Edit Pengguna' : 'Tambah Pengguna Baru' ?>
            </h4>
        </div>
        <div class="card-body p-4">
            <form action="<?= !empty($member) ? base_url('user/update/' . $member->id_user) : base_url('user/create_user') ?>" method="post" enctype="multipart/form-data">

                <!-- Input ID (Hidden) -->
                <input type="hidden" name="p[id_user]" value="<?= !empty($member) ? $member->id_user : '' ?>">

                <div class="row">
                    <div class="col-md-12">
                        <!-- Informasi Akun -->
                        <div class="card mb-4 border-0 shadow-sm">
                            <div class="card-header bg-light">
                                <h5 class="mb-0"><i class="fas fa-user-shield me-2"></i>Informasi Akun</h5>
                            </div>
                            <div class="card-body">
                                <!-- Input Nama -->
                                <div class="form-group mb-3">
                                    <label for="name" class="form-label fw-bold">Nama Lengkap</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="fas fa-user"></i></span>
                                        <input type="text" id="name" name="p[name]" value="<?= !empty($member) ? $member->name : '' ?>"
                                            class="form-control" placeholder="Masukkan nama lengkap" required>
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="form-group mb-3">
                                    <label for="email" class="form-label fw-bold">Email</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="fas fa-envelope"></i></span>
                                        <input type="email" id="email" name="p[email]" value="<?= !empty($member) ? $member->email : '' ?>"
                                            class="form-control" placeholder="Masukkan alamat email" required>
                                    </div>
                                    <small class="text-muted">Email akan digunakan untuk login dan notifikasi</small>
                                </div>

                                <!-- Input Password -->
                                <div class="form-group mb-3">
                                    <label for="password" class="form-label fw-bold">Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="fas fa-lock"></i></span>
                                        <?php if (!empty($member)): ?>
                                            <input type="password" id="password" name="p[password]" class="form-control"
                                                placeholder="Kosongkan jika tidak ingin mengubah">
                                        <?php else: ?>
                                            <input type="password" id="password" name="p[password]" class="form-control"
                                                placeholder="Masukkan password" required>
                                        <?php endif; ?>
                                        <button class="btn btn-outline-secondary toggle-password" type="button" tabindex="-1">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                    <?php if (!empty($member)): ?>
                                        <small class="text-muted">Kosongkan jika tidak ingin mengubah password</small>
                                    <?php else: ?>
                                        <small class="text-muted">Gunakan kombinasi huruf, angka, dan simbol</small>
                                    <?php endif; ?>
                                </div>

                                <!-- Konfirmasi Password -->
                                <div class="form-group mb-3">
                                    <label for="confirm_password" class="form-label fw-bold">Konfirmasi Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="fas fa-lock"></i></span>
                                        <input type="password" id="confirm_password" name="confirm_password" class="form-control"
                                            placeholder="Ulangi password" <?= empty($member) ? 'required' : '' ?>>
                                        <button class="btn btn-outline-secondary toggle-password" type="button" tabindex="-1">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                    <small class="text-muted">Masukkan password yang sama untuk konfirmasi</small>
                                </div>

                                <!-- Status -->
                                <div class="form-group mb-3">
                                    <label for="status" class="form-label fw-bold">Status Akun</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="fas fa-toggle-on"></i></span>
                                        <select id="status" name="p[status]" class="form-select" required>
                                            <option value="">-- Pilih Status --</option>
                                            <option value="1" <?= isset($member->status) && $member->status === '1' ? 'selected' : '' ?>>Aktif</option>
                                            <option value="0" <?= isset($member->status) && $member->status === '0' ? 'selected' : '' ?>>Tidak Aktif</option>
                                        </select>
                                    </div>
                                    <small class="text-muted">Pengguna dengan status tidak aktif tidak dapat login</small>
                                </div>
                            </div>
                        </div>

                        <!-- Permissions -->
                        <div class="card mb-4 border-0 shadow-sm">
                            <div class="card-header bg-light">
                                <h5 class="mb-0"><i class="fas fa-shield-alt me-2"></i>Hak Akses</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="row">
                                        <?php foreach ($modules as $module): ?>
                                            <div class="col-md-6 mb-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="modules[]"
                                                        value="<?= $module->id_module ?>"
                                                        id="module<?= $module->id_module ?>"
                                                        <?= $module->status == 1 ? 'checked' : '' ?>>
                                                    <label class="form-check-label" for="module<?= $module->id_module ?>">
                                                        <!-- <i class="fas fa-<?= !empty($module->icon) ? $module->icon : 'circle' ?> me-1 text-primary"></i> -->
                                                        <?= $module->name ?>
                                                    </label>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <small class="text-muted mt-2 d-block">Pilih modul yang dapat diakses oleh pengguna ini</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <!-- Tombol -->
                <div class="d-flex justify-content-between">
                    <a href="<?= base_url('admin') ?>" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fas fa-save me-1"></i> <?= !empty($member) ? 'Update' : 'Simpan' ?>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Script SweetAlert dan Validasi -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(function() {
        // Validasi form saat submit
        $('form').on('submit', function(e) {
            var password = $('#password').val();
            var confirm = $('#confirm_password').val();

            // Cek jika password tidak kosong dan tidak cocok
            if (password !== '' && password !== confirm) {
                e.preventDefault(); // Gagal submit form

                // Menampilkan SweetAlert
                Swal.fire({
                    icon: 'error',
                    title: 'Password dan konfirmasi password tidak cocok!',
                    showConfirmButton: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Redirect ke direktori lain setelah menekan OK
                        window.location.href = '<?= base_url('user') ?>'; // Ganti dengan URL yang sesuai
                    }
                });
            }
        });

        // Toggle password visibility
        $('.toggle-password').on('click', function() {
            const passwordInput = $(this).closest('.input-group').find('input');
            const icon = $(this).find('i');

            // Toggle input type
            if (passwordInput.attr('type') === 'password') {
                passwordInput.attr('type', 'text');
                icon.removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                passwordInput.attr('type', 'password');
                icon.removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });
    });
</script>