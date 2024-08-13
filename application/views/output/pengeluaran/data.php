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
            background-color: lightgray;
        }

        .tabel1 {
            border-collapse: collapse;
            width: 100%;
        }

        .tabel1 td,
        .tabel1 th {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
        }

        .tabel1 th {
            background-color: lightgray;
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
                <th>Tanggal</th>
                <th>Kategori</th>
                <th>Jumlah</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
            foreach ($data1 as $row) : ?>
                <tr>
                    <th scope="row"><?= $i++ ?></th>
                    <td><?= tanggal_indonesia(date('Y-m-d', $row->tanggal_keluar)) ?> <?= date('H:i:s', $row->tanggal_keluar) ?></td>
                    <td><?= $row->kategori ?></td>
                    <td><?= number_format($row->jumlah, 2) ?></td>
                    <td><?= $row->keterangan ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" style="text-align: right;">Total</td>
                <td><?= number_format($totalJumlah, 2) ?></td>
                <td></td>
            </tr>
        </tfoot>
    </table>

    <p style="font-size:x-small;text-align:right">Dicetak pada: <?= tanggal_indonesia(date('Y-m-d')) ?></p>

</body>

</html>