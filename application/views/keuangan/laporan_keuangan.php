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
                                <a href="#" class="badge btn-warning" data-bs-toggle="modal" data-bs-target="#downloadModal">
                                    <i class="fa fa-download"></i>
                                    Download
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- Modal for downloading report -->
                    <div class="modal fade" id="downloadModal" tabindex="-1" aria-labelledby="downloadModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="downloadModalLabel">Download Laporan Keuangan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="<?= base_url('output/dataLaporan') ?>" method="post" target="_blank">
                                    <div class="modal-body">
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="start_date" class="form-label">Tanggal Awal</label>
                                                <input type="date" class="form-control" name="start_date" id="start_date" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="end_date" class="form-label">Tanggal Akhir</label>
                                                <input type="date" class="form-control" name="end_date" id="end_date" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Download</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?= $this->session->flashdata('pemasukan'); ?>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="multi-filter-select" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Saldo Awal</th>
                                        <th>Pemasukan</th>
                                        <th>Pengeluaran</th>
                                        <th>Saldo Akhir</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Saldo Awal</th>
                                        <th>Pemasukan</th>
                                        <th>Pengeluaran</th>
                                        <th>Saldo Akhir</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($dataTransaksi as $row) : ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td><?= tanggal_indonesia(date('Y-m-d', $row['tanggal'])); ?></td>
                                            <td><?= number_format($row['saldo_awal'], 0, ',', '.'); ?></td>
                                            <td><?= number_format($row['pemasukan'], 0, ',', '.'); ?></td>
                                            <td><?= number_format($row['pengeluaran'], 0, ',', '.'); ?></td>
                                            <td><?= number_format($row['saldo_akhir'], 0, ',', '.'); ?></td>
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