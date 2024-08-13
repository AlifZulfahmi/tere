<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title><?= isset($title) ? $title : 'Laporan Jurnal Umum' ?></title>

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
                <h2><?= isset($title) ? $title : 'Laporan Jurnal Umum' ?></h2>
                <hr class="line-title">
                <?php
                // Debugging: Cek nilai dari $start_date dan $end_date
                log_message('debug', 'Start Date: ' . print_r($start_date, true));
                log_message('debug', 'End Date: ' . print_r($end_date, true));

                if (isset($start_date) && isset($end_date) && is_numeric($start_date) && is_numeric($end_date)) {
                    $start_date_formatted = date('Y-m-d', (int)$start_date);
                    $end_date_formatted = date('Y-m-d', (int)($end_date - 86400));
                ?>
                    <p><strong>Periode: <?= tanggal_indonesia($start_date_formatted) ?> s/d <?= tanggal_indonesia($end_date_formatted) ?></strong></p>
                <?php
                } else {
                ?>
                    <p><strong>Periode: Semua Data</strong></p>
                <?php
                }
                ?>


            </td>
        </tr>
    </table>

    <table width="100%">
        <tr>
            <td><strong>Dari:</strong> Admin Jurnal Umum</td>
            <td><strong>Tanggal:</strong> <?= tanggal_indonesia(date('Y-m-d')) ?></td>
        </tr>
    </table>

    <br />

    <table width="100%" class="tabel1">
        <thead>
            <tr>
                <th>#</th>
                <th>Tanggal</th>
                <th>Keterangan</th>
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
                        <td style="text-align: center;"><?= tanggal_indonesia(date('Y-m-d', $row->tanggal)) ?></td>
                        <td style="text-align: center;"><?= htmlspecialchars($row->keterangan) ?></td>
                        <td style="text-align: center;"><?= htmlspecialchars($row->ref) ?></td>
                        <td style="text-align: right;"><?= number_format($row->debet, 2, ',', '.') ?></td>
                        <td style="text-align: right;"><?= number_format($row->kredit, 2, ',', '.') ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" style="text-align: center;">Data tidak tersedia</td>
                </tr>
            <?php endif; ?>
        </tbody>

        <tfoot>
            <tr>
                <td colspan="4" style="text-align: right;">Total Jurnal</td>
                <td style="text-align: right;" class="gray"><?= isset($total_debet) ? number_format($total_debet, 2, ',', '.') : '0,00' ?></td>
                <td style="text-align: right;" class="gray"><?= isset($total_kredit) ? number_format($total_kredit, 2, ',', '.') : '0,00' ?></td>
            </tr>
        </tfoot>
    </table>

    <p style="font-size:x-small;text-align:right">Dicetak pada: <?= tanggal_indonesia(date('Y-m-d')) ?></p>

</body>

</html>