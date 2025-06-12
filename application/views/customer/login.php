<style>
    .login-section {
        background-color: #f8f9fa;
        min-height: 100vh;
        display: flex;
        align-items: center;
        padding: 40px 0;
        margin-top: -60px;
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
        background: linear-gradient(90deg, #1D6300 0%, #77BD27 50%, #DAB914 100%) !important;
        padding: 20px;
        border: none;
    }

    .card-header h4 {
        font-size: 24px;
        font-weight: 600;
        margin: 0;
        font-family: 'Poppins', sans-serif;
    }

    .card-body {
        padding: 30px;
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

    .form-control:focus {
        border-color: #77BD27;
        box-shadow: 0 0 0 0.2rem rgba(119, 189, 39, 0.25);
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

    .alert {
        border-radius: 8px;
        border: none;
    }

    .alert-info {
        background-color: rgba(119, 189, 39, 0.1);
        border-left: 4px solid #77BD27;
        color: #1D6300;
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

    @media (max-width: 768px) {
        .card-body {
            padding: 20px;
        }
    }
</style>

<div class="login-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card shadow" data-aos="fade-up" data-aos-delay="100">
                    <div class="card-header text-center">
                        <h4 class="text-white">Sign In</h4>
                    </div>
                    <div class="card-body">
                        <!-- Pesan informasi untuk login -->
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

                        <div class="mt-4 text-center">
                            <p style="color: #555; margin-bottom: 8px;">Belum punya akun? <a href="<?= base_url('customer/register'); ?>">Daftar disini</a></p>
                            <p style="color: #555;">Lupa password? <a href="<?= base_url('customer/forgot_password'); ?>">Reset password</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>