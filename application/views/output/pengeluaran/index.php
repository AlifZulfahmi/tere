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
            text-align: left;
        }

        .tabel1 th {
            background-color: lightgray;
        }
    </style>

</head>

<body>

    <table width="100%">
        <tr>
            <td align="top">
                <!-- <img src="{{asset('images/meteor-logo.png')}}" alt="" width="150" /> -->
            </td>
            <td align="right">
                <h3>Web Pengeluaran</h3>
                <pre></pre>
            </td>
        </tr>
    </table>

    <table width="100%">
        <tr>
            <td><strong>Dari:</strong> Admin</td>
            <td><strong>Periode:</strong> <?= tanggal_indonesia(date('Y-m-d', $start_date)) ?> s/d <?= tanggal_indonesia(date('Y-m-d', $end_date)) ?></td>
        </tr>
    </table>

    <br />

    <table width="100%" class="tabel1">
        <thead style="background-color: lightgray;">
            <tr>
                <th style="text-align: center;">#</th>
                <th style="text-align: center;">Tanggal</th>
                <th style="text-align: center;">Kategori</th>
                <th style="text-align: center;">Jumlah</th>
                <th style="text-align: center;">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
            foreach ($data1 as $row) : ?>
                <tr>
                    <th scope="row" style="text-align: center;"><?= $i++ ?></th>
                    <td style="text-align: center;"><?= tanggal_indonesia(date('Y-m-d', $row->tanggal_keluar)) ?> <?= date('H:i:s', $row->tanggal_keluar) ?></td>
                    <td style="text-align: center;"><?= $row->kategori ?></td>
                    <td style="text-align: right;"><?= number_format($row->jumlah, 2) ?></td>
                    <td style="text-align: left;"><?= $row->keterangan ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>

        <tfoot>
            <tr>
                <td colspan="3" style="text-align: right;">Total</td>
                <td style="text-align: right;" class="gray"><?= number_format($totalJumlah, 2) ?></td>
                <td></td>
            </tr>
        </tfoot>
    </table>
    <p style="font-size:x-small;text-align:right">Dicetak pada: <?= tanggal_indonesia(date('Y-m-d')) ?></p>

</body>

</html>