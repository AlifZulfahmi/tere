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
                <th>Karang Gigi</th>
                <th>Sakit Gigi</th>
                <th>Radang Gusi</th>
                <th>Pendarahan</th>
                <th>Pembekakan</th>
                <th>Resiko</th>
                <th>Tgl Dibuat</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
            foreach ($data1 as $row) : ?>
                <tr>
                    <th scope="row"><?= $i++ ?></th>
                    <td>
                        <?php
                        if ($row->ind1 == 1) {
                            echo 'Ada';
                        } else {
                            echo 'Tidak Ada';
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if ($row->ind2 == 1) {
                            echo 'Ada';
                        } else {
                            echo 'Tidak Ada';
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if ($row->ind3 == 1) {
                            echo 'Ada';
                        } else {
                            echo 'Tidak Ada';
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if ($row->ind4 == 1) {
                            echo 'Ada';
                        } else {
                            echo 'Tidak Ada';
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if ($row->ind5 == 1) {
                            echo 'Ada';
                        } else {
                            echo 'Tidak Ada';
                        }
                        ?>
                    </td>
                    <td><?= $row->resiko ?></td>
                    <td><?= tanggal_indonesia(date('Y-m-d', $row->tgl_dibuat)) ?></td>
                </tr>
            <?php endforeach; ?>
    </table>
    <p style="font-size:x-small;text-align:right">Dicetak pada: <?= tanggal_indonesia(date('Y-m-d')) ?></p>

</body>

</html>