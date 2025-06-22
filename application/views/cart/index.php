<!-- Tambahkan viewport meta tag di awal file -->
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">

<style>
    /* CSS untuk halaman keranjang responsif - Mobile First Approach */
    html,
    body {
        overflow-x: hidden;
    }

    /* Container responsif */
    .cart-container {
        width: 100%;
        max-width: 100%;
        padding: 1rem;
        margin-top: 3rem;
        margin-bottom: 5rem;
        overflow-x: hidden;
    }

    /* Reset untuk layout flexbox */
    .row {
        margin-left: -10px;
        margin-right: -10px;
    }

    /* Style default untuk kartu item */
    .cart-item-card {
        transition: all 0.3s ease;
        border: none;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        margin-bottom: 1rem;
    }

    .cart-item-card .card-body {
        padding: 0.75rem;
    }

    .cart-item-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
    }

    /* Style gambar produk */
    .cart-item-card img {
        object-fit: cover;
        height: 100%;
        width: 100%;
        border-radius: 5px 0 0 5px;
        transition: transform 0.3s ease;
    }

    .cart-item-card:hover img {
        transform: scale(1.05);
    }

    /* Layout untuk tampilan mobile */
    .cart-image-col {
        width: 38%;
        padding-right: 0;
    }

    .cart-info-col {
        width: 62%;
        padding-left: 10px;
    }

    /* Card title dan text */
    .cart-item-card .card-title {
        font-size: 1rem;
        margin-bottom: 0.3rem;
        font-weight: 600;
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }

    /* Style info harga */
    .price-info {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
    }

    /* Style quantity container - penting untuk semua ukuran */
    .qty-container {
        max-width: 110px;
        margin: 0;
        height: auto;
    }

    .qty-container .qty-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 2rem;
        min-height: 2rem;
        font-size: 1rem;
        font-weight: bold;
        padding: 0;
        touch-action: manipulation;
    }

    .qty-container .qty-input {
        text-align: center;
        font-weight: 500;
        min-width: 2.5rem;
        height: auto;
        padding: 0;
    }

    /* Style untuk subtotal - dengan pendekatan relatif */
    .subtotal-line {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-top: 1px dashed #dee2e6;
        border-bottom: 1px dashed #dee2e6;
        background-color: #f8fdf5;
        margin-left: -0.75rem;
        margin-right: -0.75rem;
        padding: 0.5rem 0.75rem;
        font-size: 0.95rem;
        margin-top: 0.5rem;
        margin-bottom: 0.5rem;
    }

    /* Style tombol hapus */
    .btn {
        transition: all 0.3s ease;
        font-size: 0.875rem;
    }

    .btn-success {
        background: linear-gradient(90deg, #1D6300 0%, #77BD27 100%);
        border: none;
    }

    .btn-danger {
        transition: all 0.3s ease;
    }

    /* Card total belanja */
    .total-card {
        position: sticky;
        bottom: 1rem;
        z-index: 10;
        margin-bottom: 0 !important;
        border-radius: 0.5rem;
        animation: pulse-gentle 2s infinite;
        border-width: 2px;
        background-color: #f8fdf5;
        box-shadow: 0 4px 12px rgba(119, 189, 39, 0.15);
        border-color: #77BD27 !important;
    }

    .total-card .card-body {
        padding: 0.75rem;
    }

    .highlight-total {
        position: relative;
        padding: 0.25rem 0.5rem;
        background-color: rgba(119, 189, 39, 0.15);
        border-radius: 4px;
        color: #1D6300 !important;
        font-weight: 600;
    }

    /* Cart count header */
    .cart-count-header {
        background-color: #f8fdf5;
        padding: 0.5rem 0.75rem;
        border-radius: 8px;
        border-left: 3px solid #77BD27;
        margin-bottom: 1rem;
    }

    .bg-success {
        background-color: #77BD27 !important;
    }

    /* Spacing untuk memberi ruang di bawah item terakhir */
    .spacer {
        height: 4rem;
    }

    /* Style untuk alert */
    .alert {
        border: none;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    /* Style untuk tabel di desktop */
    .table {
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        overflow: hidden;
    }

    .table thead {
        background: linear-gradient(90deg, #1D6300 0%, #77BD27 50%, #DAB914 100%);
        color: white;
    }

    /* Animasi loading */
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

    @keyframes pulse-gentle {
        0% {
            box-shadow: 0 4px 12px rgba(119, 189, 39, 0.15);
        }

        50% {
            box-shadow: 0 4px 20px rgba(119, 189, 39, 0.25);
        }

        100% {
            box-shadow: 0 4px 12px rgba(119, 189, 39, 0.15);
        }
    }

    /* iOS specific fixes using feature detection */
    @supports (-webkit-touch-callout: none) {

        /* Perbaikan untuk iOS secara umum */
        .cart-info-col .card-body {
            padding-left: 0.75rem;
            padding-right: 0.75rem;
        }

        .subtotal-line {
            margin-left: -0.75rem;
            margin-right: -0.75rem;
            padding-left: 0.75rem;
            padding-right: 0.75rem;
            background-color: #f9fff4;
        }

        /* Fix untuk scrolling */
        body {
            -webkit-overflow-scrolling: touch;
        }
    }

    /* Media query untuk layar yang lebih besar */
    @media (min-width: 576px) {
        .cart-container {
            padding: 1.5rem;
        }

        .cart-item-card .card-body {
            padding: 1rem;
        }

        .cart-image-col {
            width: 35%;
        }

        .cart-info-col {
            width: 65%;
        }

        .qty-container {
            max-width: 130px;
        }

        .qty-container .qty-btn {
            min-width: 2.25rem;
            min-height: 2.25rem;
        }

        .card-title {
            font-size: 1.1rem;
        }
    }

    @media (min-width: 768px) {
        .cart-container {
            padding: 2rem;
        }

        .qty-container {
            max-width: 150px;
        }

        /* Pada layar besar, gunakan layout desktop */
        /* (Style untuk desktop view disediakan oleh Bootstrap) */
    }

    /* Fix untuk tampilan pada perangkat dengan layar sangat kecil */
    @media (max-width: 320px) {
        .cart-image-col {
            width: 40%;
        }

        .cart-info-col {
            width: 60%;
        }

        .cart-item-card .card-body {
            padding: 0.5rem;
        }

        .qty-container {
            max-width: 90px;
        }

        .qty-container .qty-btn {
            min-width: 1.75rem;
            min-height: 1.75rem;
        }

        .qty-container .qty-input {
            min-width: 2rem;
        }

        .subtotal-line {
            font-size: 0.85rem;
        }
    }
</style>

<!-- Load SweetAlert -->
<link rel="stylesheet" href="<?= base_url('assets/js/lib/sweetalert2/sweetalert2.min.css') ?>">
<script src="<?= base_url('assets/js/lib/sweetalert2/sweetalert2.all.min.js') ?>"></script>

<!-- Load Bootstrap Icons jika belum ada -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

<script>
    // Fungsi konfirmasi di scope global
    function confirmDelete(url, productName) {
        Swal.fire({
            title: 'Konfirmasi Hapus',
            html: `Apakah Anda yakin ingin menghapus <strong>${productName}</strong> dari keranjang?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    }

    function confirmClearCart(url) {
        Swal.fire({
            title: 'Kosongkan Keranjang?',
            text: 'Apakah Anda yakin ingin mengosongkan keranjang belanja?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Kosongkan!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    }

    // Deteksi perangkat mobile
    function isMobileDevice() {
        return (typeof window.orientation !== "undefined") || (navigator.userAgent.indexOf('IEMobile') !== -1);
    }

    // Deteksi perangkat iOS
    function isIOS() {
        return /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream;
    }

    // Deteksi perangkat Android
    function isAndroid() {
        return /Android/.test(navigator.userAgent);
    }

    // Event listener untuk DOM Content Loaded
    document.addEventListener('DOMContentLoaded', function() {
        // Mendeteksi perangkat dan menerapkan class yang sesuai
        if (isMobileDevice()) {
            document.body.classList.add('mobile-device');

            if (isIOS()) {
                document.body.classList.add('ios-device');
            } else if (isAndroid()) {
                document.body.classList.add('android-device');
            }
        }

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
            // Menambahkan touch-action: manipulation untuk menghindari delay di browser mobile
            btn.style.touchAction = 'manipulation';

            btn.addEventListener('click', function(e) {
                // Mencegah double tap pada perangkat mobile
                e.preventDefault();

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
                        Swal.fire({
                            title: 'Error!',
                            text: 'Gagal mengupdate keranjang: ' + data.message,
                            icon: 'error',
                            confirmButtonColor: '#198754'
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        title: 'Error!',
                        text: 'Terjadi kesalahan saat mengupdate keranjang',
                        icon: 'error',
                        confirmButtonColor: '#198754'
                    });
                });
        }

        // Animasi untuk total card
        const totalCard = document.querySelector('.total-card');
        if (totalCard) {
            totalCard.style.transition = 'transform 0.5s ease';
            setTimeout(() => {
                totalCard.style.transform = 'translateY(5px)';
            }, 1000);
            setTimeout(() => {
                totalCard.style.transform = 'translateY(0)';
            }, 1500);
        }
    });
</script>

<div class="container cart-container">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4">Keranjang Belanja</h2>

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
                                        <button class="btn btn-danger btn-sm" onclick="confirmDelete('<?= base_url('cart/remove/' . $item->id_cart); ?>', '<?= $item->name; ?>')">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
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
                <div class="d-md-none mobile-cart-view">
                    <div class="mb-4 cart-count-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="small"><?= count($cart_items); ?> item dalam keranjang</span>
                            <span class="badge bg-success"><?= count($cart_items); ?></span>
                        </div>
                    </div>
                    <?php foreach ($cart_items as $item) : ?>
                        <div class="card mb-3 cart-item-card">
                            <div class="row g-0">
                                <div class="col-4 cart-image-col">
                                    <img src="<?= base_url('assets/img/product/' . $item->image); ?>" alt="<?= $item->name; ?>" class="img-fluid rounded-start h-100">
                                </div>
                                <div class="col-8 cart-info-col">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $item->name; ?></h5>
                                        <div class="price-info mb-1">
                                            <span>Harga:</span>
                                            <span class="fw-medium">Rp <?= number_format($item->price, 0, ',', '.'); ?></span>
                                        </div>

                                        <div class="d-flex align-items-center mb-2">
                                            <span class="me-2 small">Jumlah:</span>
                                            <div class="input-group input-group-sm qty-container">
                                                <button type="button" class="btn btn-sm btn-outline-secondary qty-btn" data-action="decrease" data-id="<?= $item->id_cart; ?>">-</button>
                                                <input type="number" class="form-control form-control-sm text-center qty-input" value="<?= $item->qty; ?>" min="1" data-id="<?= $item->id_cart; ?>" readonly>
                                                <button type="button" class="btn btn-sm btn-outline-secondary qty-btn" data-action="increase" data-id="<?= $item->id_cart; ?>">+</button>
                                            </div>
                                        </div>

                                        <div class="subtotal-line">
                                            <span>Subtotal:</span>
                                            <span class="text-success fw-bold">Rp <?= number_format($item->subtotal, 0, ',', '.'); ?></span>
                                        </div>

                                        <button class="btn btn-danger btn-sm w-100" onclick="confirmDelete('<?= base_url('cart/remove/' . $item->id_cart); ?>', '<?= $item->name; ?>')">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <div class="spacer"></div>

                    <div class="card mb-3 border-success total-card">
                        <div class="card-body py-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title fw-bold mb-0">Total Belanja</h5>
                                <p class="card-text fs-5 fw-bold mb-0 highlight-total">Rp <?= number_format($total_price, 0, ',', '.'); ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tombol aksi -->
                <div class="d-flex flex-column flex-md-row justify-content-between mt-4 action-buttons">
                    <a href="<?= base_url('landing/product'); ?>" class="btn btn-secondary mb-2 mb-md-0">
                        <i class="bi bi-arrow-left"></i> Lanjutkan Belanja
                    </a>
                    <div class="d-flex flex-column flex-md-row gap-2">
                        <button class="btn btn-outline-danger mb-2 mb-md-0 me-md-2" onclick="confirmClearCart('<?= base_url('cart/clear'); ?>')">
                            <i class="bi bi-trash"></i> Kosongkan Keranjang
                        </button>
                        <a href="<?= base_url('cart/checkout'); ?>" class="btn btn-success">
                            <i class="bi bi-check2-circle"></i> Checkout
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
</div>