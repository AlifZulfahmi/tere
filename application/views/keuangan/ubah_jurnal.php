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
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><?= $title ?></div>
                    <div class="card-body">
                        <!-- Multi Columns Form -->
                        <form class="row g-3" method="post">
                            <input type="hidden" name="id" value="<?= $jurnal->id ?>">
                            <div class="col-md-6">
                                <label for="tanggal" class="form-label">Tanggal</label>
                                <input type="date" class="form-control" name="tanggal" id="tanggal" value="<?= date('Y-m-d', $jurnal->tanggal) ?>" required>
                                <?= form_error('tanggal', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="col-md-6">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <input type="text" class="form-control" name="keterangan" id="keterangan" value="<?= $jurnal->keterangan ?>" required>
                                <?= form_error('keterangan', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="col-md-6">
                                <label for="debet" class="form-label">Debet</label>
                                <input type="number" class="form-control" name="debet" id="debet" value="<?= $jurnal->debet ?>" step="0.01">
                                <?= form_error('debet', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="col-md-6">
                                <label for="kredit" class="form-label">Kredit</label>
                                <input type="number" class="form-control" name="kredit" id="kredit" value="<?= $jurnal->kredit ?>" step="0.01">
                                <?= form_error('kredit', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="col-md-6">
                                <label for="ref" class="form-label">Reference</label>
                                <input type="text" class="form-control" name="ref" id="ref" value="<?= $jurnal->ref ?>">
                                <?= form_error('ref', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="text-end mt-5">
                                <a href="<?= base_url('keuangan/jurnal') ?>" class="btn btn-secondary">Kembali</a>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form><!-- End Multi Columns Form -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>