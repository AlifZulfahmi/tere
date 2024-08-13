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
                    <!-- Modal for adding new record -->
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
                                                <label for="tanggal_keluar" class="form-label">Tanggal Keluar</label>
                                                <input type="date" class="form-control" name="tanggal_keluar" id="tanggal_keluar" required>
                                                <?= form_error('tanggal_keluar', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="jumlah" class="form-label">Jumlah</label>
                                                <input type="number" step="0.01" class="form-control" name="jumlah" id="jumlah" required>
                                                <?= form_error('jumlah', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="kategori" class="form-label">Kategori</label>
                                                <select id="kategori" class="form-select" name="kategori" required>
                                                    <option value="" hidden>Pilih Kategori</option>
                                                    <option value="personalia">Personalia</option>
                                                    <option value="operasional">Operasional</option>
                                                    <option value="pemeliharaan">Pemeliharaan</option>
                                                    <option value="konsumsi">Konsumsi</option>
                                                    <option value="lainya">Lainya</option>
                                                </select>
                                                <?= form_error('kategori', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="keterangan" class="form-label">Keterangan</label>
                                                <input type="text" class="form-control" name="keterangan" id="keterangan" required>
                                                <?= form_error('keterangan', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="id_asrama" class="form-label">Asrama</label>
                                                <select id="id_asrama" class="form-select" name="id_asrama">
                                                    <option value="" hidden>Pilih Asrama</option>
                                                    <?php foreach ($dataMod as $asrama) : ?>
                                                        <option value="<?= $asrama->id ?>"><?= $asrama->nama ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <?= form_error('id_asrama', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="submit" name="submit<?= $title ?>" class="btn btn-outline-success" value="Tambah">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div><!-- End Basic Modal-->

                    <?= $this->session->flashdata('pengeluaran'); ?>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="multi-filter-select" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal Keluar</th>
                                        <th>Jumlah</th>
                                        <th>Kategori</th>
                                        <th>Keterangan</th>
                                        <th>Asrama</th> <!-- New column -->
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal Keluar</th>
                                        <th>Jumlah</th>
                                        <th>Kategori</th>
                                        <th>Keterangan</th>
                                        <th>Asrama</th> <!-- New column -->
                                        <th>Action</th>
                                    </tr>
                                </tfoot>

                                <tbody>
                                    <?php $i = 1 ?>
                                    <?php foreach ($dataTab as $row) : ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td><?= tanggal_indonesia(date('Y-m-d', $row->tanggal_keluar)); ?></td>
                                            <td><?= number_format($row->jumlah, 2, ',', '.'); ?></td>
                                            <td><?= ucfirst($row->kategori) ?></td>
                                            <td><?= $row->keterangan ?></td>
                                            <td><?= $row->asrama ?></td> <!-- Displaying asrama name -->
                                            <td class="text-center">
                                                <a href="<?= base_url('keuangan/ubahPengeluaran/' . $row->id) ?>">
                                                    <span class="badge bg-warning"><i class="bi bi-pencil-square me-1"></i> Ubah</span>
                                                </a>
                                                <a href="<?= base_url('keuangan/hapusPengeluaran/') . $row->id ?>" onclick="return confirm('Apakah anda yakin')">
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