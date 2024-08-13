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
                <h3><?= $title ?></h3>
            </td>
        </tr>
    </table>

    <table width="100%" class="tabel1">
        <thead>
            <tr>
                <th rowspan="2">No</th>
                <th rowspan="2">Akun</th>
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
                    <td><?= $row->pengguna_nama ?></td>
                    <td><?= $row->ref ?></td>
                    <td><?= number_format($row->debit, 0, ',', '.') ?></td>
                    <td><?= number_format($row->kredit, 0, ',', '.') ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3">Total</td>
                <td><?= number_format($total_debet, 2) ?></td>
                <td><?= number_format($total_kredit, 2) ?></td>
            </tr>
        </tfoot>
    </table>

    <p style="font-size:x-small;text-align:right">Dicetak pada: <?= tanggal_indonesia(date('Y-m-d')) ?></p>

</body>

</html>