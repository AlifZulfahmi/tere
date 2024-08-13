<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>

    <style type="text/css">
        * {
            font-family: Verdana, Arial, sans-serif;
        }

        table {
            font-size: x-small;
        }

        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
        }

        .gray {
            background-color: lightgray
        }

        .tabel1 {
            border-collapse: collapse;
            /* Merges borders for a clean look */
            width: 100%;
            /* Adjust as needed */
        }

        .tabel1 td {
            /* Styles table cells (both data and header cells) */
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
            /* Adjust as needed */
        }

        .tabel1 th {
            /* Styles table cells (both data and header cells) */
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
            background-color: lightgray;
            /* Adjust as needed */
        }
    </style>

</head>

<body>

    <table width="100%">
        <tr>
            <td style="text-align: center;">
                <h3><?= $title ?></h3>
            </td>
        </tr>
    </table>


    <table width="100%" class="tabel1">
        <thead>
            <tr>
                <th>#</th>
                <th>Invoice</th>
                <th>Nama Pasien</th>
                <th>No RM</th>
                <th>NIK</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Nominal</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
            foreach ($data1 as $row) : ?>
                <tr>
                    <th scope="row" style="text-align: center;"><?= $i++ ?></th>
                    <td style="text-align: center;"><?= $row->invoice ?></td>
                    <td style="text-align: center;"><?= $row->nama ?></td>
                    <td style="text-align: center;"><?= $row->id_rm ?></td>
                    <td style="text-align: center;"><?= $row->nik ?></td>
                    <td style="text-align: center;"><?= tanggal_indonesia(date('Y-m-d', $row->tgl_dibuat)) ?> <?= date('H:i:s', $row->tgl_dibuat) ?></td>
                    <td style="text-align: center;">
                        <?php
                        if ($row->status == 0) {
                            echo 'Belum Bayar';
                        } else {
                            echo 'Sudah Bayar';
                        }
                        ?>
                    </td>
                    <td style="text-align: right;">
                        <?= number_format($row->nominal, 0, ',', '.') ?>
                    </td>
                </tr>
            <?php endforeach; ?>
    </table>
    <p style="font-size:x-small;text-align:right">Dicetak pada: <?= tanggal_indonesia(date('Y-m-d')) ?></p>

</body>

</html>