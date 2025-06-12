<style>
    /* CSS untuk halaman keranjang responsif */
    .cart-item-card .card-body {
        padding: 0.75rem;
    }

    /* Efek hover dan transisi untuk card */
    .cart-item-card {
        transition: all 0.3s ease;
        border: none;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .cart-item-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
    }

    /* Efek untuk gambar */
    .cart-item-card img {
        transition: transform 0.3s ease;
    }

    .cart-item-card:hover img {
        transform: scale(1.05);
    }

    /* Style untuk table */
    .table {
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        overflow: hidden;
    }

    .table thead {
        background: linear-gradient(90deg, #1D6300 0%, #77BD27 50%, #DAB914 100%);
        color: white;
    }

    .table tbody tr {
        transition: all 0.2s ease;
    }

    .table tbody tr:hover {
        background-color: rgba(119, 189, 39, 0.05);
        transform: scale(1.01);
    }

    /* Style untuk buttons */
    .btn {
        transition: all 0.3s ease;
    }

    .btn-success {
        background: linear-gradient(90deg, #1D6300 0%, #77BD27 100%);
        border: none;
    }

    .btn-success:hover {
        background: linear-gradient(90deg, #77BD27 0%, #DAB914 100%);
        transform: translateY(-2px);
    }

    .btn-danger {
        transition: all 0.3s ease;
    }

    .btn-danger:hover {
        transform: translateY(-2px);
    }

    /* Style untuk input quantity */
    .input-group {
        transition: all 0.3s ease;
    }

    .input-group:focus-within {
        box-shadow: 0 0 0 0.2rem rgba(119, 189, 39, 0.25);
    }

    .qty-btn {
        transition: all 0.2s ease;
    }

    .qty-btn:hover {
        background-color: #77BD27;
        color: white;
        border-color: #77BD27;
    }

    /* Style untuk alerts */
    .alert {
        border: none;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .alert-success {
        background-color: rgba(119, 189, 39, 0.1);
        border-left: 4px solid #77BD27;
        color: #1D6300;
    }

    .alert-danger {
        background-color: rgba(220, 53, 69, 0.1);
        border-left: 4px solid #dc3545;
    }

    .alert-info {
        background-color: rgba(119, 189, 39, 0.1);
        border-left: 4px solid #77BD27;
        color: #1D6300;
    }

    /* Animasi loading untuk update keranjang */
    @keyframes updateSpinner {
        to {
            transform: rotate(360deg);
        }
    }

    .updating {
        position: relative;
        opacity: 0.7;
    }

    .updating::after {
        content: '';
        position: absolute;
        top: calc(50% - 10px);
        left: calc(50% - 10px);
        width: 20px;
        height: 20px;
        border: 2px solid #77BD27;
        border-top-color: transparent;
        border-radius: 50%;
        animation: updateSpinner 0.8s linear infinite;
    }

    /* Existing responsive styles */
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

<div class="container" style="margin-top: 50px; margin-bottom: 50px; height: 100vh;">
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
    // Existing script
    document.addEventListener('DOMContentLoaded', function() {
        // Add animation class when page loads
        document.querySelectorAll('.cart-item-card, .table, .alert').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(20px)';
            setTimeout(() => {
                el.style.transition = 'all 0.5s ease';
                el.style.opacity = '1';
                el.style.transform = 'translateY(0)';
            }, 100);
        });

        // Existing quantity buttons code
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

                // Add loading animation
                const cartItem = this.closest('.cart-item-card') || this.closest('tr');
                cartItem.classList.add('updating');

                // Update keranjang via AJAX
                updateCart(id, qty).finally(() => {
                    cartItem.classList.remove('updating');
                });
            });
        });

        // Modified updateCart function to return promise
        function updateCart(id_cart, qty) {
            return fetch('<?= base_url('cart/update'); ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `id_cart=${id_cart}&qty=${qty}`
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
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