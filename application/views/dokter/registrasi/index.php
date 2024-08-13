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
                                <a href="" class="badge btn-primary" data-bs-toggle="modal" data-bs-target="#addRowModal">
                                    <i class="fa fa-plus"></i>
                                    Add
                                </a>
                            </div>
                            <div class="p-1">
                                <a class="badge btn-warning" target="_blank" href="<?= base_url('output/data') . $title ?>"><i class="fa fa-download"></i> Download</a>
                            </div>
                        </div>


                        <!-- Table with stripped rows -->
                    </div>


                    <div class="modal fade" id="addRowModal" tabindex="-1">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah <?= $title ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="POST">
                                    <div class="modal-body">
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="regis" class="form-label">Nomor Registrasi</label>
                                                <input type="text" class="form-control" name="regis" id="regis" required>
                                                <?= form_error('regis', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="id_pasien" class="form-label">Pasien</label>
                                                <select id="id_pasien" class="form-select" name="id_pasien" required>
                                                    <option value="" hidden>
                                                        Pilih Pasien
                                                    </option>
                                                    <?php foreach ($dataMod as $row) : ?>
                                                        <option value="<?= $row->id ?>"><?= $row->nama ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <?= form_error('id_pasien', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="id_dokter" class="form-label">Dokter</label>
                                                <select id="id_dokter" class="form-select" name="id_dokter" required>
                                                    <option value="" hidden>
                                                        Pilih Dokter
                                                    </option>
                                                    <?php foreach ($dataMod2 as $row) : ?>
                                                        <option value="<?= $row->id ?>"><?= $row->nama ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <?= form_error('id_dokter', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="penjamin" class="form-label">Penjamin</label>
                                                <input type="text" class="form-control" name="penjamin" id="penjamin">
                                                <?= form_error('penjamin', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="asuransi" class="form-label">Asuransi</label>
                                                <input type="text" class="form-control" name="asuransi" id="asuransi">
                                                <?= form_error('asuransi', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <input type="submit" name="submit<?= $title ?>" class="btn btn-outline-success" value="Tambah">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div><!-- End Basic Modal-->

                    <?= $this->session->flashdata('registrasi'); ?>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="multi-filter-select" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>
                                            Pasien
                                        </th>
                                        <th>Dokter</th>
                                        <th>Penjamin</th>
                                        <th>Asuransi</th>
                                        <th>Tanggal Masuk</th>
                                        <th>Tanggal Keluar</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>
                                            Pasien
                                        </th>
                                        <th>Dokter</th>
                                        <th>Penjamin</th>
                                        <th>Asuransi</th>
                                        <th>Tanggal Masuk</th>
                                        <th>Tanggal Keluar</th>
                                        <th></th>
                                    </tr>
                                </tfoot>

                                <tbody>
                                    <?php $i = 1 ?>
                                    <?php foreach ($dataTab as $row) : ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td>
                                                <?php
                                                $pasien = $this->db->get_where('pasien', ['id' => $row->id_pasien])->row();
                                                $dokter = $this->db->get_where('dokter', ['id' => $row->id_dokter])->row();

                                                echo $pasien->nama;
                                                ?>
                                            </td>
                                            <td><?= $dokter->nama ?></td>
                                            <td><?= $row->penjamin ?></td>
                                            <td><?= $row->asuransi ?></td>
                                            <td><?= tanggal_indonesia(date('Y-m-d'), $row->tgl_masuk) ?></td>
                                            <td>
                                                <?php if ($row->tgl_keluar) {
                                                    echo tanggal_indonesia(date('Y-m-d'), $row->tgl_keluar);
                                                } else {
                                                    echo "Belum Keluar";
                                                } ?>
                                            </td>
                                            <td class="text-center">
                                                <?php if (!$row->tgl_keluar) : ?>
                                                    <a href="<?= base_url('dokter/pulang') . $title . '/' . $row->id ?>">
                                                        <span class="badge bg-success"><i class="bi bi-eye me-1"></i> Pulang</span>
                                                    </a>
                                                <?php endif; ?>
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