<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3"><?= $title ?></h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="<?= base_url() ?>">
                        <i class="icon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#"><?= ucwords($this->uri->segment(1)) ?></a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#"><?= $title ?></a>
                </li>
            </ul>
        </div>
        <div class="row">



            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex">
                            <div class="p-1 flex-grow-1">
                                <h4 class="card-title"><?= $title ?></h4>
                            </div>
                            <div class="p-1">
                                <a class="badge btn-warning" target="_blank" href="<?= base_url('output/data') . $title ?>"><i class="fa fa-download"></i> Download</a>
                            </div>
                        </div>
                    </div>


                    <?= $this->session->flashdata('medik'); ?>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="multi-filter-select" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>
                                            No RM
                                        </th>
                                        <th>Pasien</th>
                                        <th>Golongan Darah</th>
                                        <th>Tekanan Darah</th>
                                        <th>Karang Gigi</th>
                                        <th>Sakit Gigi</th>
                                        <th>Radang Gusi</th>
                                        <th>Pendarahan</th>
                                        <th>Pembengkakan</th>
                                        <th>Lainnya</th>
                                        <th>Resiko Penyakit</th>
                                        <th>Tgl Rekam</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>
                                            No RM
                                        </th>
                                        <th>Pasien</th>
                                        <th>Golongan Darah</th>
                                        <th>Tekanan Darah</th>
                                        <th>Karang Gigi</th>
                                        <th>Sakit Gigi</th>
                                        <th>Radang Gusi</th>
                                        <th>Pendarahan</th>
                                        <th>Pembengkakan</th>
                                        <th>Lainnya</th>
                                        <th>Resiko Penyakit</th>
                                        <th>Tgl Rekam</th>
                                        <th></th>
                                    </tr>
                                </tfoot>

                                <tbody>
                                    <?php $i = 1 ?>
                                    <?php foreach ($dataTab as $row) : ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td><?= $row->no_rm ?></td>
                                            <td>
                                                <?php
                                                $pasien = $this->db->get_where('pasien', ['id' => $row->id_pasien])->row();
                                                if ($pasien) {
                                                    echo $pasien->nama;
                                                } else {
                                                    'Belum diinput';
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($row->gol_darah) {
                                                    echo $row->gol_darah;
                                                } else {
                                                    'Belum diinput';
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($row->tek_darah == 1) {
                                                    echo 'Normal';
                                                } elseif ($row->tek_darah == 2) {
                                                    echo 'Rendah';
                                                } elseif ($row->tek_darah == 3) {
                                                    echo 'Tinggi';
                                                } else {
                                                    'Belum diinput';
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($row->karanggigi == 1) {
                                                    echo 'Ada';
                                                } elseif ($row->karanggigi == 0) {
                                                    echo 'Tidak Ada';
                                                } else {
                                                    'Belum diinput';
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($row->sakitgigi == 1) {
                                                    echo 'Ada';
                                                } elseif ($row->sakitgigi == 0) {
                                                    echo 'Tidak Ada';
                                                } else {
                                                    'Belum diinput';
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($row->radanggusi == 1) {
                                                    echo 'Ada';
                                                } elseif ($row->radanggusi == 0) {
                                                    echo 'Tidak Ada';
                                                } else {
                                                    'Belum diinput';
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($row->pendarahan == 1) {
                                                    echo 'Ada';
                                                } elseif ($row->pendarahan == 0) {
                                                    echo 'Tidak Ada';
                                                } else {
                                                    'Belum diinput';
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($row->bengkak == 1) {
                                                    echo 'Ada';
                                                } elseif ($row->bengkak == 0) {
                                                    echo 'Tidak Ada';
                                                } else {
                                                    'Belum diinput';
                                                }
                                                ?>
                                            </td>
                                            <td><?= $row->lainnya ?></td>
                                            <td><?= $row->resiko ?></td>
                                            <td><?= tanggal_indonesia(date('Y-m-d'), $row->tgl_dibuat) ?></td>
                                            <td class="text-center">
                                                <a href="<?= base_url('dokter/ubah') . $title . '/' . $row->id ?>">
                                                    <span class="badge bg-warning"><i class="bi bi-pencil-square me-1"></i> Ubah</span>
                                                </a>
                                                <a href="<?= base_url('dokter/hapus') . $title . '/' . $row->id ?>" onclick="return confirm('Apakah anda yakin')">
                                                    <span class="badge bg-danger"><i class="bi bi-trash me-1"></i> Hapus</span>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>