<style>
    /* CSS untuk halaman order responsif */
    .order-card {
        margin-bottom: 15px;
        border-radius: 8px;
        overflow: hidden;
    }

    .order-card .card-header {
        padding: 10px 15px;
        font-weight: 500;
    }

    .order-card .card-body {
        padding: 15px;
    }

    .order-card .order-info {
        margin-bottom: 10px;
        padding-bottom: 10px;
        border-bottom: 1px solid #eee;
    }

    .order-card .order-info:last-child {
        margin-bottom: 0;
        padding-bottom: 0;
        border-bottom: none;
    }

    .order-card .order-label {
        font-weight: 500;
        color: #666;
        font-size: 0.9rem;
    }

    .order-card .order-value {
        font-weight: 600;
    }

    .order-card .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.75rem;
    }

    @media (max-width: 576px) {
        .order-card .card-header {
            padding: 8px 12px;
        }

        .order-card .card-body {
            padding: 12px;
        }

        .order-card .btn-sm {
            margin-bottom: 5px;
        }
    }
</style>

<div class="container" style="margin-top: 50px; margin-bottom: 50px; height: 100vh;">
    <h2>Pesanan Saya</h2>

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

    <?php if (empty($orders)) : ?>
        <div class="alert alert-info">
            Anda belum memiliki pesanan. <a href="<?= base_url('landing/product'); ?>">Belanja sekarang</a>
        </div>
    <?php else : ?>
        <!-- Tampilan tabel untuk desktop -->
        <div class="table-responsive d-none d-md-block">
            <table class="table table-bordered table-hover">
                <thead class="table-success">
                    <tr>
                        <th>No. Pesanan</th>
                        <th>Tanggal</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order) : ?>
                        <tr>
                            <td><?= $order->order_number; ?></td>
                            <td><?= date('d-m-Y H:i', strtotime($order->created_at)); ?></td>
                            <td>Rp <?= number_format($order->total_price, 0, ',', '.'); ?></td>
                            <td>
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
                            </td>
                            <td>
                                <a href="<?= base_url('order/detail/' . $order->id_order); ?>" class="btn btn-primary btn-sm">
                                    <i class="bi bi-eye"></i> Detail
                                </a>

                                <?php if ($order->status === 'proses') : ?>
                                    <a href="<?= base_url('order/cancel/' . $order->id_order); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin membatalkan pesanan ini?');">
                                        <i class="bi bi-x-circle"></i> Batalkan
                                    </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Tampilan card untuk mobile dan tablet -->
        <div class="d-md-none">
            <?php foreach ($orders as $order) : ?>
                <div class="card order-card shadow-sm">
                    <div class="card-header bg-success text-white d-flex justify-content-between align-items-center" style="color: #ffffff !important;">
                        <span style="color: #ffffff !important;">Pesanan</span>
                        <?php
                        switch ($order->status) {
                            case 'proses':
                                echo '<span class="badge bg-info">Sedang Diproses</span>';
                                break;
                            case 'selesai':
                                echo '<span class="badge bg-success bg-opacity-75"><i class="bi bi-check-circle-fill me-1"></i> Selesai</span>';
                                break;
                            case 'batal':
                                echo '<span class="badge bg-danger">Dibatalkan</span>';
                                break;
                            default:
                                echo '<span class="badge bg-secondary">Unknown</span>';
                        }
                        ?>
                    </div>
                    <div class="card-body">
                        <div class="order-info">
                            <div class="order-label">Nomor Pesanan</div>
                            <div class="order-value">#<?= $order->order_number; ?></div>
                        </div>
                        <div class="order-info">
                            <div class="order-label">Tanggal Pesanan</div>
                            <div class="order-value"><?= date('d-m-Y H:i', strtotime($order->created_at)); ?></div>
                        </div>
                        <div class="order-info">
                            <div class="order-label">Total Pembayaran</div>
                            <div class="order-value">Rp <?= number_format($order->total_price, 0, ',', '.'); ?></div>
                        </div>
                        <div class="d-flex flex-wrap mt-3">
                            <a href="<?= base_url('order/detail/' . $order->id_order); ?>" class="btn btn-primary btn-sm me-2 mb-2">
                                <i class="bi bi-eye"></i> Lihat Detail
                            </a>

                            <?php if ($order->status === 'proses') : ?>
                                <a href="<?= base_url('order/cancel/' . $order->id_order); ?>" class="btn btn-danger btn-sm mb-2" onclick="return confirm('Apakah Anda yakin ingin membatalkan pesanan ini?');">
                                    <i class="bi bi-x-circle"></i> Batalkan
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="mt-4">
            <a href="<?= base_url('landing/product'); ?>" class="btn btn-success">
                <i class="bi bi-cart-plus"></i> Belanja Lagi
            </a>
        </div>
    <?php endif; ?>
</div>