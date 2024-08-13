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
                                <a class="badge btn-warning" target="_blank" href="<?= base_url('output/dataJurnal') ?>?tahun=<?= $this->input->get('tahun') ?>&bulan=<?= $this->input->get('bulan') ?>">
                                    <i class="fa fa-download"></i> Download
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Filter Tahun dan Bulan -->
                        <form method="GET" action="<?= base_url('keuangan/jurnal') ?>" class="mb-3">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="tahun" class="form-label">Tahun</label>
                                    <select id="tahun" name="tahun" class="form-select">
                                        <option value="">Semua tahun</option>
                                        <?php
                                        $current_year = date('Y');
                                        for ($i = $current_year; $i >= $current_year - 10; $i--) : ?>
                                            <option value="<?= $i ?>" <?= $i == $this->input->get('tahun') ? 'selected' : '' ?>>
                                                <?= $i ?>
                                            </option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="bulan" class="form-label">Bulan</label>
                                    <select id="bulan" name="bulan" class="form-select">
                                        <option value="">Semua Bulan</option>
                                        <?php
                                        $months = [
                                            1 => 'Januari',
                                            2 => 'Februari',
                                            3 => 'Maret',
                                            4 => 'April',
                                            5 => 'Mei',
                                            6 => 'Juni',
                                            7 => 'Juli',
                                            8 => 'Agustus',
                                            9 => 'September',
                                            10 => 'Oktober',
                                            11 => 'November',
                                            12 => 'Desember'
                                        ];
                                        foreach ($months as $num => $name) : ?>
                                            <option value="<?= $num ?>" <?= $num == $this->input->get('bulan') ? 'selected' : '' ?>>
                                                <?= $name ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-3 d-flex align-items-end">
                                    <button type="submit" class="btn btn-outline-primary">Filter</button>
                                </div>
                            </div>
                        </form>

                        <!-- Tabel Data Jurnal -->
                        <div class="table-responsive">
                            <table id="multi-filter-select" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Keterangan</th>
                                        <th>Debet</th>
                                        <th>Kredit</th>
                                        <th>Ref</th> <!-- Added Ref Column -->
                                        <th></th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Keterangan</th>
                                        <th>Debet</th>
                                        <th>Kredit</th>
                                        <th>Ref</th> <!-- Added Ref Column -->
                                        <th></th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php $i = 1 ?>
                                    <?php foreach ($dataTab as $row) : ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td><?= tanggal_indonesia(date('Y-m-d', $row->tanggal)) ?></td>
                                            <td><?= $row->keterangan ?></td>
                                            <td class="text-end"><?= number_format($row->debet, 0, ',', '.') ?></td>
                                            <td class="text-end"><?= number_format($row->kredit, 0, ',', '.') ?></td>
                                            <td class="text-center"><?= htmlspecialchars($row->ref) ?></td> <!-- Added Ref Data -->
                                            <td class="text-center">
                                                <a href="<?= base_url('keuangan/ubahJurnal/' . $row->id) ?>">
                                                    <span class="badge bg-warning"><i class="bi bi-pencil-square me-1"></i> Ubah</span>
                                                </a>
                                                <a href="<?= base_url('keuangan/hapusJurnal/') . $row->id ?>" onclick="return confirm('Apakah anda yakin')">
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
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" class="form-control" name="tanggal" id="tanggal" required>
                            <?= form_error('tanggal', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <input type="text" class="form-control" name="keterangan" id="keterangan" required>
                            <?= form_error('keterangan', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="debet" class="form-label">Debet</label>
                            <input type="number" class="form-control" name="debet" id="debet" step="0.01">
                            <?= form_error('debet', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="col-md-6">
                            <label for="kredit" class="form-label">Kredit</label>
                            <input type="number" class="form-control" name="kredit" id="kredit" step="0.01">
                            <?= form_error('kredit', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="ref" class="form-label">Ref</label>
                            <input type="text" class="form-control" name="ref" id="ref">
                            <?= form_error('ref', '<small class="text-danger">', '</small>'); ?>
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