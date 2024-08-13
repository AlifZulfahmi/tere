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
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: lightgray;
        }

        .tfoot-total {
            font-weight: bold;
        }

        .gray {
            background-color: lightgray;
        }

        .right-align {
            text-align: right;
        }

        .left-align {
            text-align: left;
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

    <table width="100%">
        <tr>
            <td><strong>Dari:</strong> Admin</td>
            <td><strong>Periode:</strong> <?= tanggal_indonesia(date('Y-m-d', $start_date)) ?> s/d <?= tanggal_indonesia(date('Y-m-d', $end_date)) ?></td>
        </tr>
    </table>

    <br />

    <!-- Combined Table for Pemasukan and Pengeluaran -->
    <table class="tabel1">
        <thead>
            <tr>
                <th>#</th>
                <th>Tanggal</th>
                <th>Kategori/Sumber</th>
                <th>Jumlah</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <!-- Pemasukan Section -->
            <?php $i = 1;
            foreach ($pemasukan as $row) : ?>
                <tr>
                    <th scope="row"><?= $i++ ?></th>
                    <td><?= tanggal_indonesia(date('Y-m-d', $row->tanggal_masuk)) ?> <?= date('H:i:s', $row->tanggal_masuk) ?></td>
                    <td>Pemasukan: <?= $row->sumber ?></td>
                    <td class="right-align"><?= number_format($row->jumlah, 2) ?></td>
                    <td class="left-align"><?= $row->keterangan ?></td>
                </tr>
            <?php endforeach; ?>

            <!-- Pengeluaran Section -->
            <?php foreach ($pengeluaran as $row) : ?>
                <tr>
                    <th scope="row"><?= $i++ ?></th>
                    <td><?= tanggal_indonesia(date('Y-m-d', $row->tanggal_keluar)) ?> <?= date('H:i:s', $row->tanggal_keluar) ?></td>
                    <td>Pengeluaran: <?= $row->kategori ?></td>
                    <td class="right-align"><?= number_format($row->jumlah, 2) ?></td>
                    <td class="left-align"><?= $row->keterangan ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>

        <tfoot>
            <tr>
                <td colspan="3" class="tfoot-total">Total Pemasukan</td>
                <td class="right-align"><?= number_format($totalPemasukan, 2) ?></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="3" class="tfoot-total">Total Pengeluaran</td>
                <td class="right-align"><?= number_format($totalPengeluaran, 2) ?></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="3" class="tfoot-total">Saldo Bersih</td>
                <td class="right-align gray"><?= number_format($netto, 2) ?></td>
                <td></td>
            </tr>
        </tfoot>
    </table>

    <p style="font-size:x-small;text-align:right">Dicetak pada: <?= tanggal_indonesia(date('Y-m-d')) ?></p>

</body>

</html>