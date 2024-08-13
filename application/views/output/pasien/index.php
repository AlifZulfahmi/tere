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

        .tabel1 td,
        .tabel1 th {
            /* Styles table cells (both data and header cells) */
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
            /* Adjust as needed */
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
                <h3>Web Rekam Medis</h3>
                <pre></pre>
            </td>
        </tr>

    </table>

    <table width="100%">
        <tr>
            <td><strong>Dari:</strong> Admin Rekam Medis</td>
            <td><strong>Pasien:</strong> <?= $onePas->nama ?></td>
        </tr>

    </table>

    <br />

    <table width="100%" class="tabel1">
        <thead style="background-color: lightgray;">
            <tr>
                <th style="text-align: center;">#</th>
                <th style="text-align: center;">Invoice</th>
                <th style="text-align: center;">Nama Pasien</th>
                <th style="text-align: center;">NIK</th>
                <th style="text-align: center;">Tanggal</th>
                <th style="text-align: center;">Status</th>
                <th style="text-align: center;">Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row" style="text-align: center;">1</th>
                <td style="text-align: center;"><?= $onePem->invoice ?></td>
                <td style="text-align: center;"><?= $onePas->nama ?></td>
                <td style="text-align: center;"><?= $onePas->nik ?></td>
                <td style="text-align: center;"><?= tanggal_indonesia(date('Y-m-d', $onePem->tgl_dibuat)) ?> <?= date('H:i:s', $onePem->tgl_dibuat) ?></td>
                <td style="text-align: center;">
                    <?php
                    if ($onePem->status == 0) {
                        echo 'Belum Bayar';
                    } else {
                        echo 'Sudah Bayar';
                    }
                    ?>
                </td>
                <td style="text-align: right;">
                    <?= number_format($onePem->nominal, 0, ',', '.') ?>
                </td>
            </tr>
        </tbody>

        <tfoot>
            <tr>
                <td colspan="6" style="text-align: right;">Total</td>
                <td style="text-align: end;" class="gray"><?= money($onePem->nominal) ?></td>
            </tr>
        </tfoot>
    </table>
    <p style="font-size:x-small;text-align:right">Dicetak pada: <?= tanggal_indonesia(date('Y-m-d')) ?></p>

</body>

</html>