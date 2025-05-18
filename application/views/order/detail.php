<style>
    /* CSS untuk halaman detail order responsif */
    .order-detail-card {
        margin-bottom: 20px;
        border-radius: 8px;
        overflow: hidden;
    }

    .order-detail-card .card-header {
        padding: 12px 15px;
    }

    .order-detail-card .card-body {
        padding: 15px;
    }

    .order-detail-info {
        margin-bottom: 8px;
    }

    .order-detail-info .label {
        font-weight: 500;
        color: #666;
        font-size: 0.9rem;
    }

    .order-detail-info .value {
        font-weight: 600;
    }

    .product-item-card {
        margin-bottom: 15px;
        border: 1px solid #eee;
        border-radius: 8px;
        overflow: hidden;
    }

    .product-item-card .card-body {
        padding: 12px;
    }

    .product-item-card .product-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 4px;
    }

    .product-item-card .product-name {
        font-weight: 600;
        margin-bottom: 5px;
    }

    .product-item-card .product-price {
        font-size: 0.9rem;
        color: #666;
        margin-bottom: 5px;
    }

    .product-item-card .product-qty {
        font-size: 0.9rem;
        color: #666;
        margin-bottom: 5px;
    }

    .product-item-card .product-subtotal {
        font-weight: 600;
        color: #198754;
    }

    @media (max-width: 767px) {
        .back-button {
            margin-bottom: 15px;
        }
    }
</style>

<div class="container" style="margin-top: 50px; margin-bottom: 50px;">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">
        <h2 class="mb-3 mb-md-0">Detail Pesanan</h2>
        <a href="<?= base_url('order'); ?>" class="btn btn-secondary back-button">
            <i class="bi bi-arrow-left"></i> Kembali ke Daftar Pesanan
        </a>
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

    <div class="row">
        <div class="col-md-6">
            <div class="card shadow order-detail-card mb-4">
                <div class="card-header bg-success text-white" style="color: #ffffff !important;">
                    <h5 class="mb-0" style="color: #ffffff !important;">Informasi Pesanan</h5>
                </div>
                <div class="card-body">
                    <div class="order-detail-info d-flex justify-content-between">
                        <div class="label">Nomor Pesanan:</div>
                        <div class="value">#<?= $order->order_number; ?></div>
                    </div>
                    <div class="order-detail-info d-flex justify-content-between">
                        <div class="label">Tanggal Pesanan:</div>
                        <div class="value"><?= date('d-m-Y H:i', strtotime($order->created_at)); ?></div>
                    </div>
                    <div class="order-detail-info d-flex justify-content-between">
                        <div class="label">Status:</div>
                        <div class="value">
                            <?php
                            switch ($order->status) {
                                case 'proses':
                                    echo '<span class="badge bg-info">Sedang Diproses</span>';
                                    break;
                                case 'selesai':
                                    echo '<span class="badge bg-success"><i class="bi bi-check-circle-fill me-1"></i> Selesai</span>';
                                    break;
                                case 'batal':
                                    echo '<span class="badge bg-danger">Dibatalkan</span>';
                                    break;
                                default:
                                    echo '<span class="badge bg-secondary">Unknown</span>';
                            }
                            ?>
                        </div>
                    </div>
                    <div class="order-detail-info d-flex justify-content-between">
                        <div class="label">Total Pembayaran:</div>
                        <div class="value">Rp <?= number_format($order->total_price, 0, ',', '.'); ?></div>
                    </div>

                    <?php if ($order->status === 'proses') : ?>
                        <div class="mt-3">
                            <a href="<?= base_url('order/cancel/' . $order->id_order); ?>" class="btn btn-danger w-100" onclick="return confirm('Apakah Anda yakin ingin membatalkan pesanan ini?');">
                                <i class="bi bi-x-circle"></i> Batalkan Pesanan
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow order-detail-card mb-4">
                <?php if ($order->status === 'selesai'): ?>
                    <div class="card-header bg-success text-white" style="color: #ffffff !important;">
                        <h5 class="mb-0" style="color: #ffffff !important;">Informasi Transaksi</h5>
                    </div>
                <?php else: ?>
                    <div class="card-header bg-warning text-white" style="color: #ffffff !important;">
                        <h5 class="mb-0" style="color: #ffffff !important;"><i class="bi bi-exclamation-triangle-fill me-2"></i>Informasi Pembayaran</h5>
                    </div>
                <?php endif; ?>
                <div class="card-body" <?= ($order->status !== 'selesai') ? 'style="border: 2px solidrgb(225, 201, 46); border-top: none;"' : '' ?>>
                    <?php if ($order->status === 'selesai'): ?>
                        <div class="text-center mb-3">
                            <i class="bi bi-check-circle-fill text-success" style="font-size: 3rem;"></i>
                        </div>
                        <div class="alert alert-success">
                            <p class="mb-1 text-center"><strong>Transaksi Telah Selesai</strong></p>
                            <p class="mb-0 text-center">Terima kasih telah berbelanja di Bali Treesco!</p>
                        </div>
                        <div class="order-detail-info d-flex justify-content-between mb-2">
                            <div class="label">Tanggal Selesai:</div>
                            <div class="value"><?= date('d-m-Y H:i', strtotime($order->updated_at)); ?></div>
                        </div>
                        <?php if (isset($invoice)): ?>
                            <div class="order-detail-info d-flex justify-content-between mb-2">
                                <div class="label">Nomor Invoice:</div>
                                <div class="value"><?= $invoice; ?></div>
                            </div>
                        <?php endif; ?>
                        <p class="mb-3">Pesanan Anda telah diproses dan diselesaikan. Jika Anda memiliki pertanyaan, silakan hubungi kami melalui WhatsApp ke nomor <strong>0812-3456-7890</strong>.</p>

                        <?php if (isset($invoice)): ?>
                            <div class="text-center">
                                <a href="<?= base_url('order/print_invoice/' . $order->id_order); ?>" target="_blank" class="btn btn-success">
                                    <i class="bi bi-printer-fill me-2"></i> Cetak Invoice
                                </a>
                            </div>
                        <?php endif; ?>
                    <?php else: ?>
                        <div class="mt-2 mb-2 small">
                            <i class="bi bi-info-circle-fill me-2" style="color: red; font-size: 0.8rem;"></i>
                            <span style="color: red; font-style: italic; font-size: 0.8rem;">* Biaya yang tertera belum termasuk ongkir</span>
                        </div>
                        <!-- <p>Silakan lakukan pembayaran ke rekening berikut:</p>
                        <div class="alert alert-info">
                            <p class="mb-1"><strong><?= isset($config['company_bank']) ? $config['company_bank'] : '-' ?></strong></p>
                            <p class="mb-1">No. Rekening: <?= isset($config['company_account']) ? $config['company_account'] : '-' ?></p>
                            <p class="mb-0">Atas Nama: <?= isset($config['account_name']) ? $config['account_name'] : '-' ?></p>
                        </div>
                        <div class="mt-2 mb-2 small">
                            <i class="bi bi-info-circle-fill me-2" style="color: red; font-size: 0.8rem;"></i>
                            <span style="color: red; font-style: italic; font-size: 0.8rem;">* Biaya yang tertera belum termasuk ongkir</span>
                        </div> -->
                        <?php
                        // Format nomor WhatsApp untuk URL (hapus karakter non-angka dan tambahkan kode negara)
                        $phone = isset($config['company_phone']) ? $config['company_phone'] : '0812-3456-7890';
                        $wa_number = preg_replace('/[^0-9]/', '', $phone);
                        // Jika dimulai dengan 0, ganti dengan 62
                        if (substr($wa_number, 0, 1) === '0') {
                            $wa_number = '62' . substr($wa_number, 1);
                        }
                        ?>
                        <!-- <p class="mt-3 mb-0">Setelah melakukan pembayaran, silakan konfirmasi melalui WhatsApp ke nomor <a href="https://wa.me/<?= $wa_number ?>?text=Halo%2C%20saya%20ingin%20konfirmasi%20pembayaran%20untuk%20pesanan%20%23<?= $order->order_number; ?>%20sebesar%20Rp%20<?= number_format($order->total_price, 0, ',', '.'); ?>." target="_blank" class="text-success"><strong><?= $phone ?></strong></a> dengan menyertakan bukti transfer dan nomor pesanan.</p> -->
                        <div class="alert alert-warning mt-3" style="border-left: 4px solid #dc3545;">
                            <h5 class="mb-2"><i class="bi bi-bell-fill me-2"></i>Penting!</h5>
                            <p class="mb-0">Setelah melakukan pemesanan, silakan konfirmasi melalui WhatsApp ke nomor <a href="https://wa.me/<?= $wa_number ?>?text=Halo%2C%20saya%20ingin%20konfirmasi%20pembayaran%20untuk%20pesanan%20%23<?= $order->order_number; ?>%20sebesar%20Rp%20<?= number_format($order->total_price, 0, ',', '.'); ?>." target="_blank" class="text-success"><strong><?= $phone ?></strong></a> dengan menyertakan nomor pesanan.</p>
                        </div>
                        <div class="text-center mt-3">
                            <a href="https://wa.me/<?= $wa_number ?>?text=Halo%2C%20saya%20ingin%20konfirmasi%20pembayaran%20untuk%20pesanan%20%23<?= $order->order_number; ?>%20sebesar%20Rp%20<?= number_format($order->total_price, 0, ',', '.'); ?>." target="_blank" class="btn btn-success btn-lg w-100">
                                <i class="bi bi-whatsapp me-2"></i><span style="font-size: 0.9rem;">Konfirmasi Pembayaran via WhatsApp</span>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Detail Produk untuk Desktop -->
    <div class="card shadow order-detail-card d-none d-md-block">
        <div class="card-header bg-success text-white" style="color: #ffffff !important;">
            <h5 class="mb-0" style="color: #ffffff !important;">Detail Produk</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Produk</th>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($order_details as $item) : ?>
                            <tr>
                                <td>
                                    <img src="<?= base_url('assets/img/product/' . $item->image); ?>" alt="<?= $item->name; ?>" class="img-thumbnail" style="max-width: 80px;">
                                </td>
                                <td><?= $item->name; ?></td>
                                <td>Rp <?= number_format($item->price, 0, ',', '.'); ?></td>
                                <td><?= $item->qty; ?></td>
                                <td>Rp <?= number_format($item->subtotal, 0, ',', '.'); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4" class="text-end"><strong>Total</strong></td>
                            <td><strong>Rp <?= number_format($order->total_price, 0, ',', '.'); ?></strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <!-- Detail Produk untuk Mobile -->
    <div class="d-md-none">
        <h5 class="mb-3">Detail Produk</h5>
        <?php foreach ($order_details as $item) : ?>
            <div class="card product-item-card">
                <div class="row g-0">
                    <div class="col-4">
                        <img src="<?= base_url('assets/img/product/' . $item->image); ?>" alt="<?= $item->name; ?>" class="product-img p-2">
                    </div>
                    <div class="col-8">
                        <div class="card-body">
                            <div class="product-name"><?= $item->name; ?></div>
                            <div class="product-price">Harga: Rp <?= number_format($item->price, 0, ',', '.'); ?></div>
                            <div class="product-qty">Jumlah: <?= $item->qty; ?></div>
                            <div class="product-subtotal">Subtotal: Rp <?= number_format($item->subtotal, 0, ',', '.'); ?></div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

        <div class="card mt-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Total Pembayaran</h5>
                    <div class="fs-5 fw-bold">Rp <?= number_format($order->total_price, 0, ',', '.'); ?></div>
                </div>
            </div>
        </div>
    </div>
</div>