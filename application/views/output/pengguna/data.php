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
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>No HP</th>
                <th>Jenis Kelamin</th>
                <th>Tanggal Dibuat</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
            foreach ($data1 as $row) : ?>
                <tr>
                    <th scope="row"><?= $i++ ?></th>
                    <td><?= $row->nama ?></td>
                    <td><?= $row->email ?></td>
                    <td>
                        <?php
                        if ($row->role == 1) {
                            echo 'Admin';
                        } elseif ($row->role == 2) {
                            echo 'Keuangan';
                        } else {
                            echo 'Yayasan';
                        }
                        ?>
                    </td>
                    <td><?= $row->no_hp ?></td>
                    <td><?= $row->jenis_kelamin ?></td>
                    <td><?= tanggal_indonesia(date('Y-m-d', $row->tgl_dibuat)) ?> <?= date('H:i:s', $row->tgl_dibuat) ?></td>
                    <td>
                        <?php
                        if ($row->status == 0) {
                            echo 'Nonaktif';
                        } else {
                            echo 'Aktif';
                        }
                        ?>
                    </td>
                </tr>
            <?php endforeach; ?>
    </table>
    <p style="font-size:x-small;text-align:right">Dicetak pada: <?= tanggal_indonesia(date('Y-m-d')) ?></p>

</body>

</html>