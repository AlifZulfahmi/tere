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
    </style>

</head>

<body>

    <table width="100%">
        <tr>
            <td style="text-align: center;">
                <h3><?= htmlspecialchars($title) ?></h3>
                <?php
                // Pastikan start_date dan end_date adalah Unix timestamps
                $start_date_formatted = isset($start_date) && is_numeric($start_date) ? date('Y-m-d', $start_date) : 'Tanggal Tidak Tersedia';
                $end_date_formatted = isset($end_date) && is_numeric($end_date) ? date('Y-m-d', $end_date - 86400) : 'Tanggal Tidak Tersedia';
                ?>
                <p><strong>Periode: <?= tanggal_indonesia($start_date_formatted) ?> s/d <?= tanggal_indonesia($end_date_formatted) ?></strong></p>
            </td>




        </tr>
    </table>

    <table width="100%" class="tabel1">
        <thead>
            <tr>
                <th rowspan="2">No</th>
                <th rowspan="2">Tanggal</th>
                <th rowspan="2">Keterangan</th>
                <th rowspan="2">Ref</th>
                <th colspan="2">Saldo</th>
            </tr>
            <tr>
                <th>Debet</th>
                <th>Kredit</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            <?php foreach ($data1 as $row) : ?>
                <tr>
                    <th scope="row"><?= $i++ ?></th>
                    <td><?= tanggal_indonesia(date('Y-m-d', isset($row->tanggal) && is_numeric($row->tanggal) ? $row->tanggal : time())) ?></td>
                    <td><?= htmlspecialchars($row->keterangan) ?></td>
                    <td><?= htmlspecialchars($row->ref) ?></td>
                    <td><?= number_format($row->debet, 0, ',', '.') ?></td>
                    <td><?= number_format($row->kredit, 0, ',', '.') ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4">Total</td>
                <td><?= isset($total_debet) ? number_format($total_debet, 2, ',', '.') : '0,00' ?></td>
                <td><?= isset($total_kredit) ? number_format($total_kredit, 2, ',', '.') : '0,00' ?></td>
            </tr>
        </tfoot>
    </table>

    <p style="font-size:x-small;text-align:right">Dicetak pada: <?= tanggal_indonesia(date('Y-m-d')) ?></p>

</body>

</html>