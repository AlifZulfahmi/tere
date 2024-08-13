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
                            <input type="hidden" name="id" value="<?= $oneData->id ?>">
                            <div class="col-md-6">
                                <label for="tanggal_masuk" class="form-label">Tanggal Masuk</label>
                                <input type="date" class="form-control" name="tanggal_masuk" id="tanggal_masuk" value="<?= date('Y-m-d', $oneData->tanggal_masuk) ?>" required>
                                <?= form_error('tanggal_masuk', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="col-md-6">
                                <label for="jumlah" class="form-label">Jumlah</label>
                                <input type="number" class="form-control" name="jumlah" id="jumlah" value="<?= $oneData->jumlah ?>" required>
                                <?= form_error('jumlah', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="col-md-6">
                                <label for="sumber" class="form-label">Sumber</label>
                                <select id="sumber" class="form-select" name="sumber" required>
                                    <option value="<?= $oneData->sumber ?>" hidden>
                                        <?= ucfirst($oneData->sumber) ?>
                                    </option>
                                    <option value="infaq">Infaq</option>
                                    <option value="donasi">Donasi</option>
                                    <option value="orang tua asuh">Orang Tua Asuh</option>
                                </select>
                                <?= form_error('sumber', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="col-md-6">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <input type="text" class="form-control" name="keterangan" id="keterangan" value="<?= $oneData->keterangan ?>" required>
                                <?= form_error('keterangan', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="col-md-6">
                                <label for="id_asrama" class="form-label">Asrama</label>
                                <select id="id_asrama" class="form-select" name="id_asrama">
                                    <option value="" hidden>Pilih Asrama</option>
                                    <?php foreach ($dataMod as $asrama) : ?>
                                        <option value="<?= $asrama->id ?>" <?= $oneData->id_asrama == $asrama->id ? 'selected' : '' ?>><?= $asrama->nama ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?= form_error('id_asrama', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="text-end mt-5">
                                <a href="<?= base_url('keuangan/pemasukan') ?>" class="btn btn-secondary">Kembali</a>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form><!-- End Multi Columns Form -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>