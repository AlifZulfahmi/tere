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
                        <div class="d-flex align-items-center">
                            <h4 class="card-title"><?= $title ?></h4>
                            <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal" data-bs-target="#addRowModal">
                                <i class="fa fa-plus"></i>
                                Add
                            </button>
                        </div>

                        <?= $this->session->flashdata('menu'); ?>
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
                                                    <label for="menu" class="form-label">Menu</label>
                                                    <input type="text" class="form-control" name="menu" id="menu" required>
                                                    <?= form_error('menu', '<small class="text-danger">', '</small>'); ?>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="link" class="form-label">Link</label>
                                                    <input type="text" class="form-control" name="link" id="link" required>
                                                    <?= form_error('link', '<small class="text-danger">', '</small>'); ?>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label for="icon" class="form-label">Ikon (Font Awesome 5)</label>
                                                    <input type="text" class="form-control" name="icon" id="icon" required>
                                                    <?= form_error('icon', '<small class="text-danger">', '</small>'); ?>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label for="for" class="form-label">Akses Menu</label>
                                                    <select id="for" class="form-select" name="for" required>
                                                        <option value="" hidden>
                                                            Pilih Akses
                                                        </option>
                                                        <option value="1">Admin</option>
                                                        <option value="2">Keuangan</option>
                                                        <option value="3">Ustadz</option>
                                                    </select>
                                                    <?= form_error('for', '<small class="text-danger">', '</small>'); ?>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="status" class="form-label">Status</label>
                                                    <select id="status" class="form-select" name="status" required>
                                                        <option value="" hidden>
                                                            Pilih Status
                                                        </option>
                                                        <option value="1">Aktif</option>
                                                        <option value="0">Nonaktif</option>
                                                    </select>
                                                    <?= form_error('status', '<small class="text-danger">', '</small>'); ?>
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
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="multi-filter-select" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Menu</th>
                                        <th>Link</th>
                                        <th>Ikon</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Menu</th>
                                        <th>Link</th>
                                        <th>Ikon</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php $i = 1 ?>
                                    <?php foreach ($dataTab as $row) : ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td><?= $row->menu ?></td>
                                            <td><?= $row->link ?></td>
                                            <td><?= $row->icon ?></td>
                                            <td><?= $row->status ?></td>
                                            <td class="text-center">
                                                <a href="<?= base_url('ui/ubah') . $title . '/' . $row->id ?>">
                                                    <span class="badge bg-warning"><i class="bi bi-pencil-square me-1"></i> Ubah</span>
                                                </a>
                                                <a href="<?= base_url('ui/hapus') . $title . '/' . $row->id ?>" onclick="return confirm('Apakah anda yakin')">
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