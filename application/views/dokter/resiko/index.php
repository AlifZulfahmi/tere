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
                                                <label for="ind1" class="form-label">Karang Gigi</label>
                                                <select id="ind1" class="form-select" name="ind1" required>
                                                    <option value="" hidden>
                                                        Pilih
                                                    </option>
                                                    <option value="1">Ada</option>
                                                    <option value="0">Tidak Ada</option>
                                                </select>
                                                <?= form_error('ind1', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="ind2" class="form-label">Sakit Gigi</label>
                                                <select id="ind2" class="form-select" name="ind2">
                                                    <option value="" hidden>
                                                        Pilih
                                                    </option>
                                                    <option value="1">Ada</option>
                                                    <option value="0">Tidak Ada</option>
                                                </select>
                                                <?= form_error('ind2', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <label for="ind3" class="form-label">Radang Gusi</label>
                                                <select id="ind3" class="form-select" name="ind3" required>
                                                    <option value="" hidden>
                                                        Pilih
                                                    </option>
                                                    <option value="1">Ada</option>
                                                    <option value="0">Tidak Ada</option>
                                                </select>
                                                <?= form_error('ind3', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="ind4" class="form-label">Pendarahan</label>
                                                <select id="ind4" class="form-select" name="ind4" required>
                                                    <option value="" hidden>
                                                        Pilih
                                                    </option>
                                                    <option value="1">Ada</option>
                                                    <option value="0">Tidak Ada</option>
                                                </select>
                                                <?= form_error('ind4', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="ind5" class="form-label">Pembengkakan</label>
                                                <select id="ind5" class="form-select" name="ind5" required>
                                                    <option value="" hidden>
                                                        Pilih
                                                    </option>
                                                    <option value="1">Ada</option>
                                                    <option value="0">Tidak Ada</option>
                                                </select>
                                                <?= form_error('ind5', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <label for="resiko" class="form-label">Resiko Penyakit</label>
                                                <input type="text" name="resiko" id="resiko" class="form-control" required>
                                                <?= form_error('resiko', '<small class="text-danger">', '</small>'); ?>
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

                    <?= $this->session->flashdata('resiko'); ?>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="multi-filter-select" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Karang Gigi</th>
                                        <th>Sakit Gigi</th>
                                        <th>Radang Gusi</th>
                                        <th>Pendarahan</th>
                                        <th>Pembengkakan</th>
                                        <th>Resiko</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Karang Gigi</th>
                                        <th>Sakit Gigi</th>
                                        <th>Radang Gusi</th>
                                        <th>Pendarahan</th>
                                        <th>Pembengkakan</th>
                                        <th>Resiko</th>
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