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
                                <a class="badge btn-warning" target="_blank" href="<?= base_url('output/data') . $title ?>"><i class="fas fa-file-pdf"></i> Download</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="multi-filter-select" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Jumlah</th>
                                        <th>Sumber/Kategori</th>
                                        <th>Keterangan</th>
                                        <th>Asrama</th>
                                        <th>Jenis</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Jumlah</th>
                                        <th>Sumber/Kategori</th>
                                        <th>Keterangan</th>
                                        <th>Asrama</th>
                                        <th>Jenis</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($pembukuan as $row) : ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td><?= tanggal_indonesia(date('Y-m-d', $row['tanggal'])); ?> <?= date('H:i:s', $row['tanggal']) ?></td>
                                            <td><?= number_format($row['jumlah'], 0, ',', '.'); ?></td>
                                            <td><?= ucfirst($row['sumber_kategori']) ?></td>
                                            <td><?= $row['keterangan'] ?></td>
                                            <td><?= $row['asrama'] ?></td>
                                            <td><?= $row['jenis'] ?></td>
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