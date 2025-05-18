<div class="container" style="margin-top: 50px; margin-bottom: 50px;">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-success text-white text-center">
                    <h4 class="text-white">Reset Password</h4>
                </div>
                <div class="card-body">
                    <div class="alert alert-info mb-4">
                        <i class="bi bi-info-circle-fill me-2"></i> Masukkan email Anda untuk menerima link reset password.
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

                    <?php echo form_open('customer/forgot_password'); ?>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                        <?php echo form_error('email', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-success">Kirim Link Reset Password</button>
                    </div>
                    <?php echo form_close(); ?>

                    <div class="mt-3 text-center">
                        <p>Ingat password? <a href="<?= base_url('customer/login'); ?>">Login disini</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>