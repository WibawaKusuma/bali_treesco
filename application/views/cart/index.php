<style>
    /* CSS untuk halaman keranjang responsif */
    .cart-item-card .card-body {
        padding: 0.75rem;
    }

    .cart-item-card .card-title {
        font-size: 1rem;
        margin-bottom: 0.5rem;
    }

    .cart-item-card .card-text {
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
    }

    .cart-item-card .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.75rem;
    }

    .cart-item-card .input-group .form-control {
        height: 30px;
        font-size: 0.9rem;
    }

    @media (max-width: 576px) {
        .cart-item-card .col-4 {
            padding-right: 0;
        }

        .cart-item-card .col-8 {
            padding-left: 10px;
        }

        .cart-item-card .card-body {
            padding: 0.5rem;
        }
    }
</style>

<div class="container" style="margin-top: 50px; margin-bottom: 50px;">
    <h2>Keranjang Belanja</h2>

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

    <?php if (empty($cart_items)) : ?>
        <div class="alert alert-info">
            Keranjang belanja Anda kosong. <a href="<?= base_url('landing/product'); ?>">Belanja sekarang</a>
        </div>
    <?php else : ?>
        <!-- Tampilan tabel untuk desktop -->
        <div class="table-responsive d-none d-md-block">
            <table class="table table-bordered table-hover">
                <thead class="table-success">
                    <tr>
                        <th>Produk</th>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cart_items as $item) : ?>
                        <tr>
                            <td>
                                <img src="<?= base_url('assets/img/product/' . $item->image); ?>" alt="<?= $item->name; ?>" class="img-thumbnail" style="max-width: 100px;">
                            </td>
                            <td><?= $item->name; ?></td>
                            <td>Rp <?= number_format($item->price, 0, ',', '.'); ?></td>
                            <td>
                                <div class="input-group" style="max-width: 150px;">
                                    <button type="button" class="btn btn-sm btn-outline-secondary qty-btn" data-action="decrease" data-id="<?= $item->id_cart; ?>">-</button>
                                    <input type="number" class="form-control text-center qty-input" value="<?= $item->qty; ?>" min="1" data-id="<?= $item->id_cart; ?>" readonly>
                                    <button type="button" class="btn btn-sm btn-outline-secondary qty-btn" data-action="increase" data-id="<?= $item->id_cart; ?>">+</button>
                                </div>
                            </td>
                            <td>Rp <?= number_format($item->subtotal, 0, ',', '.'); ?></td>
                            <td>
                                <a href="<?= base_url('cart/remove/' . $item->id_cart); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini dari keranjang?');">
                                    <i class="bi bi-trash"></i> Hapus
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" class="text-end"><strong>Total</strong></td>
                        <td colspan="2"><strong>Rp <?= number_format($total_price, 0, ',', '.'); ?></strong></td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!-- Tampilan card untuk mobile dan tablet -->
        <div class="d-md-none">
            <?php foreach ($cart_items as $item) : ?>
                <div class="card mb-3 cart-item-card">
                    <div class="row g-0">
                        <div class="col-4">
                            <img src="<?= base_url('assets/img/product/' . $item->image); ?>" alt="<?= $item->name; ?>" class="img-fluid rounded-start" style="object-fit: cover; height: 100%;">
                        </div>
                        <div class="col-8">
                            <div class="card-body">
                                <h5 class="card-title"><?= $item->name; ?></h5>
                                <p class="card-text">Harga: Rp <?= number_format($item->price, 0, ',', '.'); ?></p>

                                <div class="d-flex align-items-center mb-2">
                                    <span class="me-2">Jumlah:</span>
                                    <div class="input-group" style="max-width: 120px;">
                                        <button type="button" class="btn btn-sm btn-outline-secondary qty-btn" data-action="decrease" data-id="<?= $item->id_cart; ?>">-</button>
                                        <input type="number" class="form-control text-center qty-input" value="<?= $item->qty; ?>" min="1" data-id="<?= $item->id_cart; ?>" readonly>
                                        <button type="button" class="btn btn-sm btn-outline-secondary qty-btn" data-action="increase" data-id="<?= $item->id_cart; ?>">+</button>
                                    </div>
                                </div>

                                <p class="card-text"><strong>Subtotal: Rp <?= number_format($item->subtotal, 0, ',', '.'); ?></strong></p>

                                <a href="<?= base_url('cart/remove/' . $item->id_cart); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini dari keranjang?');">
                                    <i class="bi bi-trash"></i> Hapus
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Belanja</h5>
                    <p class="card-text fs-4 fw-bold">Rp <?= number_format($total_price, 0, ',', '.'); ?></p>
                </div>
            </div>
        </div>

        <!-- Tombol aksi -->
        <div class="d-flex flex-column flex-md-row justify-content-between mt-4">
            <a href="<?= base_url('landing/product'); ?>" class="btn btn-secondary mb-2 mb-md-0">
                <i class="bi bi-arrow-left"></i> Lanjutkan Belanja
            </a>
            <div class="d-flex flex-column flex-md-row">
                <a href="<?= base_url('cart/clear'); ?>" class="btn btn-outline-danger mb-2 mb-md-0 me-md-2" onclick="return confirm('Apakah Anda yakin ingin mengosongkan keranjang?');">
                    <i class="bi bi-trash"></i> Kosongkan Keranjang
                </a>
                <a href="<?= base_url('cart/checkout'); ?>" class="btn btn-success">
                    <i class="bi bi-check2-circle"></i> Checkout
                </a>
            </div>
        </div>
    <?php endif; ?>
</div>

<script>
    // Script untuk mengupdate jumlah produk di keranjang
    document.addEventListener('DOMContentLoaded', function() {
        // Tombol tambah/kurang jumlah
        const qtyBtns = document.querySelectorAll('.qty-btn');
        qtyBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const action = this.getAttribute('data-action');
                const id = this.getAttribute('data-id');
                const inputEl = document.querySelector(`.qty-input[data-id="${id}"]`);
                let qty = parseInt(inputEl.value);

                if (action === 'increase') {
                    qty += 1;
                } else if (action === 'decrease' && qty > 1) {
                    qty -= 1;
                }

                inputEl.value = qty;

                // Update keranjang via AJAX
                updateCart(id, qty);
            });
        });

        // Fungsi untuk mengupdate keranjang
        function updateCart(id_cart, qty) {
            fetch('<?= base_url('cart/update'); ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `id_cart=${id_cart}&qty=${qty}`
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        // Reload halaman untuk menampilkan perubahan
                        location.reload();
                    } else {
                        alert('Gagal mengupdate keranjang: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat mengupdate keranjang');
                });
        }
    });
</script>