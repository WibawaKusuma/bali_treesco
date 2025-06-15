<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pendapatan</title>
    <style>
        body {
            font-family: 'Times New Roman', serif;
            margin: 0;
            padding: 30px;
            font-size: 12px;
            color: #000;
            line-height: 1.4;
        }

        .letterhead {
            border-bottom: 3px solid #2c5530;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .company-info {
            text-align: center;
            margin-bottom: 20px;
        }

        .company-name {
            font-size: 24px;
            font-weight: bold;
            color: #2c5530;
            margin: 0;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .company-details {
            font-size: 11px;
            color: #555;
            margin: 8px 0 0 0;
            line-height: 1.3;
        }

        .document-title {
            text-align: center;
            margin: 25px 0;
            padding: 15px 0;
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
        }

        .document-title h2 {
            margin: 0;
            font-size: 18px;
            color: #2c5530;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .period-info {
            font-size: 12px;
            color: #666;
            margin-top: 8px;
        }

        .summary-section {
            margin: 30px 0;
            border: 1px solid #dee2e6;
            background-color: #f8f9fa;
        }

        .summary-header {
            background-color: #2c5530;
            color: white;
            padding: 12px 15px;
            font-weight: bold;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .summary-content {
            padding: 20px;
        }

        .summary-table {
            width: 100%;
            border-collapse: collapse;
        }

        .summary-table td {
            padding: 8px 0;
            border-bottom: 1px dotted #ccc;
        }

        .summary-table td:first-child {
            width: 200px;
            font-weight: bold;
            color: #333;
        }

        .summary-table td:last-child {
            text-align: right;
            font-weight: bold;
            color: #2c5530;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin: 25px 0;
            border: 1px solid #000;
        }

        .data-table th {
            background-color: #2c5530;
            color: white;
            padding: 12px 8px;
            text-align: center;
            font-weight: bold;
            font-size: 11px;
            text-transform: uppercase;
            border: 1px solid #000;
            letter-spacing: 0.3px;
        }

        .data-table td {
            padding: 10px 8px;
            border: 1px solid #000;
            font-size: 11px;
            vertical-align: middle;
        }

        .data-table tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        .data-table tbody tr:nth-child(odd) {
            background-color: white;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .data-table tfoot tr {
            background-color: #e9ecef;
            font-weight: bold;
            border-top: 2px solid #000;
        }

        .data-table tfoot th {
            background-color: #2c5530;
            color: white;
            font-size: 12px;
        }

        .signature-section {
            margin-top: 50px;
            display: table;
            width: 100%;
        }

        .signature-left {
            display: table-cell;
            width: 50%;
            vertical-align: top;
        }

        .signature-right {
            display: table-cell;
            width: 50%;
            text-align: right;
            vertical-align: top;
        }

        .signature-box {
            border: 1px solid #000;
            padding: 15px;
            margin-top: 10px;
            min-height: 80px;
            background-color: #fafafa;
        }

        .signature-title {
            font-weight: bold;
            margin-bottom: 10px;
            color: #2c5530;
            text-transform: uppercase;
            font-size: 11px;
        }

        .signature-line {
            border-bottom: 1px solid #000;
            margin: 50px 0 10px 0;
            position: relative;
        }

        .signature-name {
            font-size: 11px;
            color: #666;
            text-align: center;
        }

        .document-footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #666;
            border-top: 1px solid #ccc;
            padding-top: 15px;
        }
    </style>
</head>

<body>
    <!-- Letterhead -->
    <div class="letterhead">
        <div class="company-info">
            <h1 class="company-name"><?= isset($config['company_name']) ? strtoupper($config['company_name']) : 'BALI TREESCO' ?></h1>
            <div class="company-details">
                <?= isset($config['company_address']) ? $config['company_address'] : 'Jl. Raya Bali Treesco, Denpasar, Bali' ?><br>
                Telp: <?= isset($config['company_phone']) ? $config['company_phone'] : '0812-3456-7890' ?> |
                Email: info@balitreesco.com | Website: www.balitreesco.com
            </div>
        </div>
    </div>

    <!-- Document Title -->
    <div class="document-title">
        <h2>Laporan Pendapatan</h2>
        <div class="period-info">Periode: <?= $from_date_formatted ?> s/d <?= $to_date_formatted ?></div>
    </div>

    <!-- Summary Section -->
    <div class="summary-section">
        <div class="summary-header">Ringkasan Pendapatan</div>
        <div class="summary-content">
            <table class="summary-table">
                <tr>
                    <td>Total Pendapatan</td>
                    <td>Rp <?= number_format($total_income, 0, ',', '.') ?></td>
                </tr>
                <tr>
                    <td>Jumlah Transaksi</td>
                    <td><?= $transaction_count ?> transaksi</td>
                </tr>
                <tr>
                    <td>Rata-rata per Transaksi</td>
                    <td>Rp <?= number_format($average_income, 0, ',', '.') ?></td>
                </tr>
            </table>
        </div>
    </div>

    <!-- Detail Transaksi -->
    <table class="data-table">
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 15%;">No. Invoice</th>
                <th style="width: 15%;">No. Pesanan</th>
                <th style="width: 15%;">Tanggal</th>
                <th style="width: 20%;">Customer</th>
                <th style="width: 15%;">Kasir</th>
                <th style="width: 15%;">Total</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            <?php foreach ($income_data as $data) : ?>
                <tr>
                    <td class="text-center"><?= $no++ ?></td>
                    <td class="text-center"><?= $data->no_invoice ?></td>
                    <td class="text-center"><?= $data->order_number ?></td>
                    <td class="text-center"><?= date('d/m/Y H:i', strtotime($data->created_at)) ?></td>
                    <td><?= $data->customer_name ?></td>
                    <td class="text-center"><?= $data->user_name ?></td>
                    <td class="text-right">Rp <?= number_format($data->total_price, 0, ',', '.') ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="6" class="text-right" style="padding: 15px 8px;">TOTAL KESELURUHAN</th>
                <th class="text-right" style="padding: 15px 8px;">Rp <?= number_format($total_income, 0, ',', '.') ?></th>
            </tr>
        </tfoot>
    </table>

    <!-- Signature Section -->
    <div class="signature-section">
        <div class="signature-left">
            <div class="signature-title">Diperiksa Oleh:</div>
            <div class="signature-box">
                <div class="signature-line"></div>
                <div class="signature-name">Manager</div>
            </div>
        </div>
        <div class="signature-right">
            <div class="signature-title">Dibuat Oleh:</div>
            <div class="signature-box">
                <div class="signature-line"></div>
                <div class="signature-name">Admin</div>
            </div>
        </div>
    </div>

    <!-- Document Footer -->
    <div class="document-footer">
        <p>Dokumen ini dibuat secara otomatis pada <?= date('d F Y, H:i') ?> WIB</p>
        <p>Denpasar, <?= date('d F Y') ?></p>
    </div>
</body>

</html>