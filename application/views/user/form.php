<div class="container" style="max-width: 800px;">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white text-center">
            <h4 class="mb-0"><?= !empty($member) ? 'Edit User' : 'Create User' ?></h4>
        </div>
        <div class="card-body">
            <form action="<?= !empty($member) ? base_url('user/update/' . $member->id_user) : base_url('user/create_user') ?>" method="post" enctype="multipart/form-data">

                <!-- Input ID (Hidden) -->
                <input type="hidden" name="p[id_user]" value="<?= !empty($member) ? $member->id_user : '' ?>">

                <!-- Input Nama -->
                <div class="form-group row">
                    <label for="name" class="col-12 col-sm-3 col-form-label">Nama</label>
                    <div class="col-12 col-sm-9">
                        <input type="text" id="name" name="p[name]" value="<?= !empty($member) ? $member->name : '' ?>" class="form-control" required>
                    </div>
                </div>

                <!-- Input Password -->
                <div class="form-group row">
                    <label for="password" class="col-12 col-sm-3 col-form-label">Password</label>
                    <div class="col-12 col-sm-9">
                        <?php if (!empty($member)): ?>
                            <input type="password" id="password" name="p[password]" class="form-control" placeholder="Kosongkan jika tidak ingin mengubah">
                            <small class="text-muted">Kosongkan jika tidak ingin mengubah password</small>
                        <?php else: ?>
                            <input type="password" id="password" name="p[password]" class="form-control" placeholder="Masukkan password" required>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Konfirmasi Password -->
                <div class="form-group row">
                    <label for="confirm_password" class="col-12 col-sm-3 col-form-label">Konfirmasi Password</label>
                    <div class="col-12 col-sm-9">
                        <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Ulangi password" <?= empty($member) ? 'required' : '' ?>>
                    </div>
                </div>

                <!-- Email -->
                <div class="form-group row">
                    <label for="email" class="col-12 col-sm-3 col-form-label">Email</label>
                    <div class="col-12 col-sm-9">
                        <input type="email" id="email" name="p[email]" value="<?= !empty($member) ? $member->email : '' ?>" class="form-control" required>
                    </div>
                </div>

                <!-- Status -->
                <div class="form-group row">
                    <label for="status" class="col-12 col-sm-3 col-form-label">Status</label>
                    <div class="col-12 col-sm-9">
                        <select id="status" name="p[status]" class="form-control" required>
                            <option value="1" <?= isset($member->status) && $member->status === '1' ? 'selected' : '' ?>>Aktif</option>
                            <option value="0" <?= isset($member->status) && $member->status === '0' ? 'selected' : '' ?>>Tidak Aktif</option>
                        </select>
                    </div>
                </div>


                <!-- Module -->
                <div class="form-group row">
                    <label class="col-12 col-sm-3 col-form-label">Permissions</label>
                    <div class="col-12 col-sm-9">
                        <?php foreach ($modules as $module): ?>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    name="modules[]"
                                    value="<?= $module->id_module ?>"
                                    id="module<?= $module->id_module ?>"
                                    <?= $module->status == 1 ? 'checked' : '' ?>>
                                <label class="form-check-label" for="module<?= $module->id_module ?>">
                                    <!-- <i class="<?= $module->icon ?>"> -->
                                    </i> <?= $module->name ?>
                                </label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>



                <!-- Tombol -->
                <div class="text-right">
                    <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> Save</button>
                    <a href="<?= base_url('admin') ?>" class="btn btn-sm btn-danger"><i class="fa fa-arrow-left"></i> Cancel</a>
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
    });
</script>