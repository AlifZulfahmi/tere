<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($title) ?></title>

    <style type="text/css">
        * {
            font-family: Verdana, Arial, sans-serif;
        }

        table {
            font-size: x-small;
            border-collapse: collapse;
            width: 100%;
        }

        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
        }

        .gray {
            background-color: lightgray;
        }

        .tabel1 td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
        }

        .tabel1 th {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
            background-color: lightgray;
        }

        .tableKop td {
            padding: 8px;
            text-align: center;
        }

        .tableKop th {
            padding: 8px;
            text-align: center;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h3 {
            margin: 0;
        }

        .header p {
            margin: 0;
        }

        .footer {
            font-size: x-small;
            text-align: right;
            margin-top: 40px;
            align-items: right;
            justify-content: right;
        }

        .table2 tr,
        .table2 td {
            font-size: 10px;
            border: 1px solid #000;
        }

        .signature {
            margin-top: 40px;
            text-align: right;
            font-size: small;
        }
    </style>
</head>

<body>
    <table class="tableKOP" style="border-color: black !important;border-bottom-style:double !important;line-height:1.2;">
        <tr>
            <td style="width: 15% !important;" class="text-start">
                <img src="<?= base_url('assets/img/LogoPPTQ.png'); ?>" width="150">
            </td>
            <td style="text-align: center;">
                <span style="font-size: 15px;">SISTEM INFORMASI KEUANGAN</span><br>
                <span style="font-size: 15px;"><?= isset($title) ? strtoupper(htmlspecialchars($title)) : strtoupper('Laporan Keuangan') ?></span><br>
                <span style="font-size: 15px;"><?= base_url() ?></span>
            </td>
            <td style="width: 15% !important;" class="text-end text-right">
                <img src="<?= base_url('assets/img/LogoSAHAL.png'); ?>" width="150">
            </td>
        </tr>
    </table>
    <div class="header">
        <?php
        // Format start_date and end_date
        $start_date_formatted = isset($start_date) ? tanggal_indonesia($start_date) : 'Tanggal Tidak Tersedia';
        $end_date_formatted = isset($end_date) ? tanggal_indonesia($end_date) : 'Tanggal Tidak Tersedia';
        ?>
        <h5><strong>Periode: <?= $start_date_formatted ?> s/d <?= $end_date_formatted ?></strong></h5>
    </div>

    <table width="100%" class="tabel1">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Saldo Awal</th>
                <th>Pemasukan</th>
                <th>Pengeluaran</th>
                <th>Saldo Akhir</th>
            </tr>
        </thead>
        <tbody>
            <?php if (isset($dataTransaksi) && is_array($dataTransaksi) && !empty($dataTransaksi)): ?>
                <?php $i = 1; ?>
                <?php foreach ($dataTransaksi as $row): ?>
                    <tr>
                        <th scope="row"><?= $i++ ?></th>
                        <td><?= tanggal_indonesia(date('Y-m-d', $row['tanggal'])) ?></td>
                        <td><?= number_format($row['saldo_awal'], 0, ',', '.') ?></td>
                        <td><?= number_format($row['tipe'] === 'pemasukan' ? $row['jumlah'] : 0, 0, ',', '.') ?></td>
                        <td><?= number_format($row['tipe'] === 'pengeluaran' ? $row['jumlah'] : 0, 0, ',', '.') ?></td>
                        <td><?= number_format($row['saldo_akhir'], 0, ',', '.') ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" style="text-align: center;">Data tidak tersedia</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="signature">
        <p><?= tanggal_indonesia(date('Y-m-d')) ?><br>
            Kepala Pesantren<br><br><br><br><br>
            <span>Shelin</span>
        </p>
    </div>
</body>

</html>