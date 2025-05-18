<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Bali Treesco | <?= @$title ?></title>
    <link href="<?= base_url('assets/img/favicon-logo-bali-treeco.png') ?>" rel="icon">
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            margin: 20px;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header img {
            max-height: 80px;
        }

        .header h2 {
            margin: 0;
            /* color: #28a745; */
        }

        .header p {
            margin: 5px 0;
            color: #666;
        }

        .info {
            margin-bottom: 20px;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
        }

        .info-table td {
            padding: 8px 0;
            vertical-align: top;
        }

        .customer-info {
            width: 60%;
        }

        .order-info {
            width: 40%;
            text-align: right;
        }

        .invoice-box {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            margin-top: 20px;
            margin-bottom: 20px;
            background-color: #f9f9f9;
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            border: 1px solid #dee2e6;
        }

        .items-table th {
            background-color: #f8f9fa;
            color: #333;
            text-align: left;
            padding: 12px 8px;
            font-weight: bold;
            border: 1px solid #dee2e6;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .items-table td {
            padding: 10px 8px;
            border: 1px solid #dee2e6;
            vertical-align: middle;
        }

        .items-table tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        .items-table tbody tr:hover {
            background-color: #f1f1f1;
        }

        .items-table .text-right {
            text-align: right;
        }

        .items-table .text-center {
            text-align: center;
        }

        .total-table {
            width: 50%;
            border-collapse: collapse;
            margin-top: 15px;
            margin-left: auto;
            border: 1px solid #dee2e6;
        }

        .total-table td {
            padding: 8px 12px;
            border: 1px solid #dee2e6;
        }

        .total-table tr:last-child {
            background-color: #f8f9fa;
            font-weight: bold;
        }

        .total-table .total-label {
            text-align: left;
            width: 60%;
        }

        .total-table .total-value {
            text-align: right;
            width: 40%;
        }

        .status {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 3px;
            font-weight: bold;
            color: white;
        }

        .status-pending {
            background-color: #ffc107;
            color: #212529;
        }

        .status-processing {
            background-color: #17a2b8;
        }

        .status-completed {
            background-color: #28a745;
        }

        .status-cancelled {
            background-color: #dc3545;
        }

        .footer {
            text-align: center;
            font-size: 11px;
            margin-top: 30px;
            border-top: 1px solid #ddd;
            padding-top: 15px;
            color: #666;
        }

        .signature {
            margin-top: 40px;
            text-align: right;
        }

        .signature-line {
            display: inline-block;
            width: 200px;
            border-bottom: 1px solid #333;
            margin-bottom: 5px;
        }

        .signature-name {
            font-weight: bold;
        }

        @media print {
            body {
                margin: 0;
                padding: 15px;
            }
        }
    </style>
</head>

<body>

    <?php
    $img_path = FCPATH . 'assets/img/logo-bali-treeco2.png';
    $type = pathinfo($img_path, PATHINFO_EXTENSION);
    $data = file_get_contents($img_path);
    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

    // Format status
    $status_text = '';
    $status_class = '';
    switch ($selling->status) {
        case 'proses':
            $status_text = 'Sedang Diproses';
            $status_class = 'status-processing';
            break;
        case 'selesai':
            $status_text = 'Selesai';
            $status_class = 'status-completed';
            break;
        case 'batal':
            $status_text = 'Dibatalkan';
            $status_class = 'status-cancelled';
            break;
        default:
            $status_text = $selling->status == 1 ? 'Selesai' : 'Proses';
            $status_class = $selling->status == 1 ? 'status-completed' : 'status-processing';
    }
    ?>

    <div class="header">
        <img src="<?= $base64 ?>" alt="Logo Bali Tresco">
        <h2>INVOICE</h2>
        <p>Sweet by Nature, Healthy by Choice.</p>
        <p><?= @$config['company_website'] ?> | <?= @$config['company_phone'] ?></p>
        <?php if (!empty($config['company_address'])): ?>
            <p><?= $config['company_address'] ?></p>
        <?php endif; ?>
    </div>

    <div class="info">
        <table class="info-table">
            <tr>
                <td class="customer-info">
                    <strong>Kepada:</strong><br>
                    <?= $selling->customer_name ?><br>
                    <?= $selling->customer_phone ?><br>
                    <?php if (!empty($order->address)): ?>
                        <?= $order->address ?>
                    <?php endif; ?>
                </td>
                <td class="order-info">
                    <strong>No. Invoice:</strong> <?= !empty($order->no_invoice) ? $order->no_invoice : 'INV-' . date('Ymd', strtotime($selling->tgl_proses)) . '-' . sprintf('%03d', $selling->id_selling) ?><br>
                    <strong>No. Pesanan:</strong> <?= $order->order_number ?><br>
                    <strong>Tanggal Pesan:</strong> <?= date('d M Y H:i', strtotime($selling->tgl_order)) ?><br>
                    <strong>Tanggal Proses:</strong> <?= !empty($selling->tgl_proses) ? date('d M Y H:i', strtotime($selling->tgl_proses)) : '-' ?><br>
                    <strong>Status:</strong> <span <?= $status_class ?>"><?= $status_text ?></span>
                </td>
            </tr>
        </table>
    </div>

    <div class="invoice-box">
        <h3 style="margin-top: 0;">Detail Pesanan</h3>
        <table class="items-table">
            <thead>
                <tr>
                    <th style="width: 5%;">No</th>
                    <th style="width: 45%;">Produk</th>
                    <th style="width: 15%;" class="text-right">Harga</th>
                    <th style="width: 10%;" class="text-center">Qty</th>
                    <th style="width: 25%;" class="text-right">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $total = 0;
                foreach ($order_details as $item):
                    $subtotal = $item->price * $item->qty;
                    $total += $subtotal;
                ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $item->name ?></td>
                        <td class="text-right">Rp <?= number_format($item->price, 0, ',', '.') ?></td>
                        <td class="text-center"><?= $item->qty ?></td>
                        <td class="text-right">Rp <?= number_format($subtotal, 0, ',', '.') ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <table class="total-table">
            <tr>
                <td class="total-label">Subtotal Produk:</td>
                <td class="total-value">Rp <?= number_format($total, 0, ',', '.') ?></td>
            </tr>
            <?php if (!empty($order->shipping_cost) && $order->shipping_cost > 0): ?>
                <tr>
                    <td class="total-label">Ongkir:</td>
                    <td class="total-value">Rp <?= number_format($order->shipping_cost, 0, ',', '.') ?></td>
                </tr>
            <?php endif; ?>
            <tr>
                <td class="total-label"><strong>Total :</strong></td>
                <td class="total-value"><strong>Rp <?= number_format($selling->total_price, 0, ',', '.') ?></strong></td>
            </tr>
        </table>
    </div>

    <div class="signature">
        <div class="signature-line"></div>
        <div class="signature-name">Admin Bali Treesco</div>
    </div>

    <div class="footer">
        <p>Terima kasih atas kepercayaan Anda berbelanja di Bali Treesco.</p>
        <p>Invoice ini sah tanpa tanda tangan dan dapat digunakan untuk keperluan arsip.</p>
        <p>Untuk pertanyaan atau bantuan, silakan hubungi kami di <?= @$config['company_phone'] ?></p>
    </div>

</body>

</html>