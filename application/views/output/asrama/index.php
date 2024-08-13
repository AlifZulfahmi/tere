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
                <!-- Optional logo or image -->
            </td>
            <td align="right">
                <h3><?= $title ?></h3>
                <pre></pre>
            </td>
        </tr>
    </table>

    <table width="100%">
        <tr>
            <td><strong>Dari:</strong> Admin Data Asrama</td>
            <td><strong>Tanggal:</strong> <?= tanggal_indonesia(date('Y-m-d')) ?></td>
        </tr>
    </table>

    <br />

    <table width="100%" class="tabel1">
        <thead style="background-color: lightgray;">
            <tr>
                <th style="text-align: center;">#</th>
                <th style="text-align: center;">Nama Asrama</th>
                <th style="text-align: center;">Nama Musyrif</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
            foreach ($data1 as $row) : ?>
                <tr>
                    <th scope="row" style="text-align: center;"><?= $i++ ?></th>
                    <td style="text-align: center;"><?= $row->nama ?></td>
                    <td style="text-align: center;"><?= $row->musyrif ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>

        <tfoot>
            <tr>
                <td colspan="2" style="text-align: right;">Total Asrama</td>
                <td style="text-align: center;" class="gray"><?= count($data1) ?></td>
            </tr>
        </tfoot>
    </table>

    <p style="font-size:x-small;text-align:right">Dicetak pada: <?= tanggal_indonesia(date('Y-m-d')) ?></p>

</body>

</html>