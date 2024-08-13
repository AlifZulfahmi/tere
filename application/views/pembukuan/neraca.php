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
                                <a href="#" class="badge btn-primary" data-bs-toggle="modal" data-bs-target="#addRowModal">
                                    <i class="fa fa-plus"></i>
                                    Add
                                </a>
                            </div>
                            <div class="p-1">
                                <a class="badge btn-warning" target="_blank" href="<?= base_url('output/data') . $title ?>"><i class="fa fa-download"></i> Download</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Tabel Data Neraca Saldo -->
                        <div class="table-responsive">
                            <table id="multi-filter-select" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Akun</th>
                                        <th>Ref</th>
                                        <th>Debet</th>
                                        <th>Kredit</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Akun</th>
                                        <th>Ref</th>
                                        <th>Debet</th>
                                        <th>Kredit</th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php $i = 1 ?>
                                    <?php foreach ($dataTab as $row) : ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td><?= $row->pengguna_nama ?></td>
                                            <td><?= $row->ref ?></td>
                                            <td class="text-end"><?= number_format($row->debit, 0, ',', '.') ?></td>
                                            <td class="text-end"><?= number_format($row->kredit, 0, ',', '.') ?></td>
                                            <td class="text-center">
                                                <a href="<?= base_url('pembukuan/ubahNeracaSaldo/' . $row->id) ?>">
                                                    <span class="badge bg-warning"><i class="bi bi-pencil-square me-1"></i> Ubah</span>
                                                </a>
                                                <a href="<?= base_url('pembukuan/hapusNeracaSaldo/') . $row->id ?>" onclick="return confirm('Apakah anda yakin?')">
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

<!-- Modal Tambah Data -->
<div class="modal fade" id="addRowModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah <?= $title ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST">
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="pengguna" class="form-label">Akun</label>
                            <select id="pengguna" class="form-select" name="nama_pengguna" required>
                                <option value="" hidden>Pilih Pengguna</option>
                                <?php foreach ($dataMod as $row) : ?>
                                    <option value="<?= $row->nama ?>"><?= $row->nama ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?= form_error('pengguna', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="col-md-6">
                            <label for="ref" class="form-label">Ref</label>
                            <input type="text" class="form-control" name="ref" id="ref">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="debet" class="form-label">Debet</label>
                            <input type="number" class="form-control" name="debit" id="debet" step="0.01">
                        </div>
                        <div class="col-md-6">
                            <label for="kredit" class="form-label">Kredit</label>
                            <input type="number" class="form-control" name="kredit" id="kredit" step="0.01">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" name="submit<?= $title ?>" class="btn btn-outline-success" value="Tambah">
                </div>
            </form>
        </div>
    </div>
</div><!-- End Modal Tambah Data -->