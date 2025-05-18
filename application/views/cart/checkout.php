<div class="container" style="margin-top: 50px; margin-bottom: 50px;">
    <h2>Checkout</h2>

    <?php if ($this->session->flashdata('error')) : ?>
        <div class="alert alert-danger">
            <?= $this->session->flashdata('error'); ?>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header bg-success text-white" style="color: #ffffff !important;">
                    <h5 class="mb-0" style="color: #ffffff !important;">Informasi Pengiriman</h5>
                </div>
                <div class="card-body">
                    <?php echo form_open('cart/checkout', ['id' => 'checkout-form']); ?>
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Penerima</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?= $this->session->userdata('customer_name'); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?= $this->session->userdata('customer_email'); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Nomor Telepon</label>
                        <input type="text" class="form-control" id="phone" name="phone" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Alamat Pengiriman</label>
                        <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="notes" class="form-label">Catatan (opsional)</label>
                        <textarea class="form-control" id="notes" name="notes" rows="2"></textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow mb-4">
                <div class="card-header bg-success text-white" style="color: #ffffff !important;">
                    <h5 class="mb-0" style="color: #ffffff !important;">Ringkasan Pesanan</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <?php foreach ($cart_items as $item) : ?>
                                    <tr>
                                        <td>
                                            <?= $item->name; ?> <span class="text-muted">x <?= $item->qty; ?></span>
                                        </td>
                                        <td class="text-end">Rp <?= number_format($item->subtotal, 0, ',', '.'); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Total</th>
                                    <th class="text-end">Rp <?= number_format($total_price, 0, ',', '.'); ?></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="mt-2 mb-2 small">
                        <i class="bi bi-info-circle-fill me-2" style="color: red; font-size: 0.8rem;"></i>
                        <span style="color: red; font-style: italic; font-size: 0.8rem;">* Biaya yang tertera belum termasuk ongkir</span>
                    </div>

                    <div class="d-grid gap-2 mt-3">
                        <button type="submit" class="btn btn-success btn-lg">
                            <i class="bi bi-check2-circle"></i> Buat Pesanan
                        </button>
                        <a href="<?= base_url('cart'); ?>" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left"></i> Kembali ke Keranjang
                        </a>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>