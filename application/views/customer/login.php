<div class="container" style="margin-top: 50px; margin-bottom: 50px;">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-success text-white text-center">
                    <h4 class="text-white">Sign In</h4>
                </div>
                <div class="card-body">
                    <!-- Pesan informasi untuk login sebelum menambahkan ke keranjang -->
                    <div class="alert alert-info mb-4">
                        <i class="bi bi-info-circle-fill me-2"></i> Silakan login terlebih dahulu untuk dapat menambahkan produk ke keranjang belanja.
                    </div>

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

                    <?php echo form_open('customer/login'); ?>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                        <?php echo form_error('email', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                        <?php echo form_error('password', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-success">Login</button>
                    </div>
                    <?php echo form_close(); ?>

                    <div class="mt-3 text-center">
                        <p>Belum punya akun? <a href="<?= base_url('customer/register'); ?>">Daftar disini</a></p>
                        <p>Lupa password? <a href="<?= base_url('customer/forgot_password'); ?>">Reset password</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>