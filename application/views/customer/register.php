<style>
    /* Pastikan semua teks menggunakan font Poppins */
    * {
        font-family: 'Poppins', sans-serif !important;
    }

    .card {
        border: none;
        border-radius: 15px;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1) !important;
    }

    .card-header {
        padding: 20px;
        border: none;
    }

    .card-header h4 {
        font-size: 24px;
        font-weight: 600;
        margin: 0;
    }

    .form-label {
        color: #555;
        font-weight: 500;
        font-size: 14px;
    }

    .form-control {
        border-radius: 8px;
        padding: 12px 15px;
        border: 1px solid #ddd;
        transition: all 0.3s ease;
    }

    .btn-success {
        background: linear-gradient(90deg, #1D6300 0%, #77BD27 100%);
        border: none;
        padding: 12px;
        font-weight: 500;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .btn-success:hover {
        background: linear-gradient(90deg, #77BD27 0%, #DAB914 100%);
        transform: translateY(-2px);
    }

    .text-center a {
        color: #77BD27;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .text-center a:hover {
        color: #1D6300;
    }
</style>

<div class="container" style="margin-top: 80px; margin-bottom: 80px;">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-success text-white text-center">
                    <h4 class="text-white">Sign Up</h4>
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

                    <?php echo form_open('customer/register'); ?>
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?= set_value('name'); ?>" required>
                        <?php echo form_error('name', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    <div class="mb-3">
                        <label for="nickname" class="form-label">Nama Panggilan</label>
                        <input type="text" class="form-control" id="nickname" name="nickname" value="<?= set_value('nickname'); ?>" required>
                        <?php echo form_error('nickname', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?= set_value('email'); ?>" required>
                        <?php echo form_error('email', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                        <?php echo form_error('password', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Konfirmasi Password</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                        <?php echo form_error('confirm_password', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Nomor Telepon</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="<?= set_value('phone'); ?>" required>
                        <?php echo form_error('phone', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Alamat</label>
                        <textarea class="form-control" id="address" name="address" rows="3"><?= set_value('address'); ?></textarea>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-success">Register</button>
                    </div>
                    <?php echo form_close(); ?>

                    <div class="mt-3 text-center">
                        <p style="color: black;">Sudah punya akun? <a href="<?= base_url('customer/login'); ?>">Login disini</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>