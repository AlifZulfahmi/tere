<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title><?= isset($title) ? $title : 'Laporan Neraca Saldo' ?></title>

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

        .tabel1 td,
        .tabel1 th {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        .tabel1 th {
            text-align: center;
            background-color: lightgray;
        }
    </style>

</head>

<body>

    <table width="100%">
        <tr>
            <td align="top">
                <!-- Optional logo or image -->
            </td>
            <td align="right">
                <h3><?= isset($title) ? $title : 'Laporan Neraca Saldo' ?></h3>
                <!-- Removed period filter as it's not needed -->
            </td>
        </tr>
    </table>

    <table width="100%">
        <tr>
            <td><strong>Dari:</strong> Admin Neraca Saldo</td>
        </tr>
    </table>

    <br />

    <table width="100%" class="tabel1">
        <thead>
            <tr>
                <th>No</th>
                <th>Akun</th>
                <th>Ref</th>
                <th>Debet</th>
                <th>Kredit</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($data1)): ?>
                <?php $i = 1; ?>
                <?php foreach ($data1 as $row): ?>
                    <tr>
                        <th scope="row" style="text-align: center;"><?= $i++ ?></th>
                        <td style="text-align: center;"><?= htmlspecialchars($row->pengguna_nama) ?></td>
                        <td style="text-align: center;"><?= htmlspecialchars($row->ref) ?></td>
                        <td style="text-align: right;"><?= number_format($row->debit, 2) ?></td>
                        <td style="text-align: right;"><?= number_format($row->kredit, 2) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" style="text-align: center;">Data tidak tersedia</td>
                </tr>
            <?php endif; ?>
        </tbody>

        <tfoot>
            <tr>
                <td colspan="3" style="text-align: right;">Total Neraca</td>
                <td style="text-align: right;" class="gray"><?= isset($total_debit) ? number_format($total_debit, 2) : '0.00' ?></td>
                <td style="text-align: right;" class="gray"><?= isset($total_kredit) ? number_format($total_kredit, 2) : '0.00' ?></td>
            </tr>
        </tfoot>
    </table>

    <p style="font-size:x-small;text-align:right">Dicetak pada: <?= tanggal_indonesia(date('Y-m-d')) ?></p>

</body>

</html>