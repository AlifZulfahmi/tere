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
                <th>Nomor Registrasi</th>
                <th>Nama Pasien</th>
                <th>Nomor RM</th>
                <th>NIK</th>
                <th>Dokter</th>
                <th>Tanggal Masuk</th>
                <th>Tanggal Pulang</th>
                <th>Penjamin</th>
                <th>Asuransi</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
            foreach ($data1 as $row) : ?>
                <tr>
                    <th scope="row"><?= $i++ ?></th>
                    <td><?= $row->regis ?></td>
                    <td><?= $row->nama ?></td>
                    <td>
                        <?= $row->id_rm ?>
                    </td>
                    <td><?= $row->nik ?></td>
                    <td><?= $row->dokter ?></td>
                    <td><?= tanggal_indonesia(date('Y-m-d', $row->tgl_masuk)) ?> <?= date('H:i:s', $row->tgl_masuk) ?></td>
                    <td>
                        <?php
                        if ($row->tgl_keluar) {
                            echo tanggal_indonesia(date('Y-m-d', $row->tgl_keluar)) . ' ' . date('H:i:s', $row->tgl_keluar);
                        } else {
                            echo 'Belum Pulang';
                        }
                        ?>
                    </td>
                    <td><?= $row->penjamin ?></td>
                    <td><?= $row->asuransi ?></td>
                </tr>
            <?php endforeach; ?>
    </table>
    <p style="font-size:x-small;text-align:right">Dicetak pada: <?= tanggal_indonesia(date('Y-m-d')) ?></p>

</body>

</html>