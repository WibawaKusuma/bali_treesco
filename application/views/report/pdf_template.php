<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pendapatan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            font-size: 12px;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #007bff;
            padding-bottom: 15px;
        }

        .header h1 {
            margin: 0;
            padding: 0;
            font-size: 20px;
            color: #007bff;
            text-transform: uppercase;
            font-weight: bold;
        }

        .header p {
            margin: 5px 0;
            font-size: 14px;
        }

        .header h2 {
            margin: 15px 0 5px;
            font-size: 18px;
            color: #444;
        }

        .info {
            margin-bottom: 25px;
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            border-left: 4px solid #007bff;
        }

        .info table {
            width: 100%;
        }

        .info table td {
            padding: 8px 5px;
        }

        .info table td:first-child {
            width: 180px;
            font-weight: bold;
            color: #555;
        }

        table.data {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        table.data th,
        table.data td {
            border: 1px solid #ddd;
            padding: 10px 8px;
            text-align: left;
        }

        table.data th {
            background-color: #007bff;
            color: white;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 11px;
        }

        table.data tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table.data tr:hover {
            background-color: #f1f1f1;
        }

        .text-right {
            text-align: right;
        }

        table.data tfoot tr {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .footer {
            margin-top: 40px;
            text-align: right;
            border-top: 1px solid #ddd;
            padding-top: 15px;
        }

        .footer p {
            margin: 5px 0;
            color: #555;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1><?= isset($config['company_name']) ? strtoupper($config['company_name']) : 'BALI TREESCO' ?></h1>
        <p><?= isset($config['company_address']) ? $config['company_address'] : 'Jl. Raya Bali Treesco, Denpasar, Bali' ?></p>
        <p>Telp: <?= isset($config['company_phone']) ? $config['company_phone'] : '0812-3456-7890' ?></p>
        <hr>
        <h2>LAPORAN PENDAPATAN</h2>
        <p>Periode: <?= $from_date_formatted ?> s/d <?= $to_date_formatted ?></p>
    </div>

    <div class="info">
        <table>
            <tr>
                <td>Total Pendapatan</td>
                <td>: Rp <?= number_format($total_income, 0, ',', '.') ?></td>
            </tr>
            <tr>
                <td>Jumlah Transaksi</td>
                <td>: <?= $transaction_count ?></td>
            </tr>
            <tr>
                <td>Rata-rata Transaksi</td>
                <td>: Rp <?= number_format($average_income, 0, ',', '.') ?></td>
            </tr>
        </table>
    </div>

    <table class="data">
        <thead>
            <tr>
                <th>No</th>
                <th>No. Invoice</th>
                <th>No. Pesanan</th>
                <th>Tanggal</th>
                <th>Customer</th>
                <th>Kasir</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            <?php foreach ($income_data as $data) : ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $data->no_invoice ?></td>
                    <td><?= $data->order_number ?></td>
                    <td><?= date('d/m/Y H:i', strtotime($data->created_at)) ?></td>
                    <td><?= $data->customer_name ?></td>
                    <td><?= $data->user_name ?></td>
                    <td class="text-right">Rp <?= number_format($data->total_price, 0, ',', '.') ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="6" class="text-right">Total</th>
                <th class="text-right">Rp <?= number_format($total_income, 0, ',', '.') ?></th>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        <p>Denpasar, <?= date('d F Y') ?></p>
        <br><br><br>
        <p>Admin</p>
    </div>
</body>

</html>