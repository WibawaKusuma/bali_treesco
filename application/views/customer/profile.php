<div class="container" style="margin-top: 50px; margin-bottom: 50px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h4>Profil Saya</h4>
                </div>
                <div class="card-body">
                    <?php if ($this->session->flashdata('success')) : ?>
                        <div class="alert alert-success">
                            <?= $this->session->flashdata('success'); ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($this->session->flashdata('error')) : ?>
                        <div class="alert alert-danger">
                            <?= $this->session->flashdata('error'); ?>
                        </div>
                    <?php endif; ?>

                    <?php echo form_open('customer/profile'); ?>
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?= $customer->name; ?>" required>
                        <?php echo form_error('name', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    <div class="mb-3">
                        <label for="nickname" class="form-label">Nama Panggilan</label>
                        <input type="text" class="form-control" id="nickname" name="nickname" value="<?= isset($customer->nickname) ? $customer->nickname : ''; ?>" required>
                        <?php echo form_error('nickname', '<small class="text-danger">', '</small>'); ?>
                        <small class="text-muted">Nama ini akan ditampilkan sebagai nama user login Anda</small>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" value="<?= $customer->email; ?>" readonly>
                        <small class="text-muted">Email tidak dapat diubah</small>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Nomor Telepon</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="<?= $customer->phone; ?>" required>
                        <?php echo form_error('phone', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Alamat</label>
                        <textarea class="form-control" id="address" name="address" rows="3"><?= $customer->address; ?></textarea>
                    </div>
                    <hr>
                    <h5>Ubah Password</h5>
                    <p class="text-muted">Kosongkan jika tidak ingin mengubah password</p>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password Baru</label>
                        <input type="password" class="form-control" id="password" name="password">
                        <?php echo form_error('password', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Konfirmasi Password Baru</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                        <?php echo form_error('confirm_password', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>

            <div class="mt-4">
                <a href="<?= base_url('order'); ?>" class="btn btn-primary">Lihat Pesanan Saya</a>
                <a href="<?= base_url('customer/logout'); ?>" class="btn btn-danger float-end">Logout</a>
            </div>
        </div>
    </div>
</div>