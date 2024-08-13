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
                <th>Email</th>
                <th>Nama</th>
                <th>Spesialisasi</th>
                <th>Nomor SIP</th>
                <th>Nomor STR</th>
                <th>No HP</th>
                <th>Alamat Rumah / Praktek</th>
                <th>Status</th>
                <th>Tanggal Dibuat</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
            foreach ($data1 as $row) : ?>
                <tr>
                    <th scope="row"><?= $i++ ?></th>
                    <td><?php
                        if ($row->email) {
                            echo $row->email;
                        } else {
                            echo 'Akun belum dikaitkan';
                        }
                        ?></td>
                    <td><?= $row->nama ?></td>
                    <td><?= $row->spesialisasi ?></td>
                    <td><?= $row->sip ?></td>
                    <td><?= $row->str ?></td>
                    <td><?= $row->no_hp ?></td>
                    <td><?= $row->alamat ?></td>
                    <td><?php if ($row->status == 1) {
                            echo 'Aktif';
                        } else {
                            echo 'Nonaktif (Keluar/Cuti/Libur)';
                        } ?></td>
                    <td><?= tanggal_indonesia(date('Y-m-d', $row->tgl_dibuat)) ?></td>
                </tr>
            <?php endforeach; ?>
    </table>
    <p style="font-size:x-small;text-align:right">Dicetak pada: <?= tanggal_indonesia(date('Y-m-d')) ?></p>

</body>

</html>