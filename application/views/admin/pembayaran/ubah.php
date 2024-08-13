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
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="id_pasien" class="form-label">Pasien</label>
                                    <select id="id_pasien" class="form-select" name="id_pasien" required>
                                        <option value="<?= $pasien->id ?>" hidden>
                                            <?= $pasien->nama ?> - <?= $pasien->nik ?> - <?= $pasien->id_rm ?>
                                        </option>
                                        <?php foreach ($dataMod as $row) : ?>
                                            <option value="<?= $row->id ?>"><?= $row->nama ?> - <?= $row->nik ?> - <?= $row->id_rm ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?= form_error('id_pasien', '<small class="text-danger">', '</small>'); ?>
                                </div>
                                <div class="col-md-6">
                                    <label for="nominal" class="form-label">Nominal</label>
                                    <input type="text" class="form-control" name="nominal" id="nominal" value="<?= $oneData->nominal ?>">
                                    <?= form_error('nominal', '<small class="text-danger">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="status" class="form-label">Status Pembayaran</label>
                                    <select id="status" class="form-select" name="status" required>
                                        <option value="<?= $oneData->status ?>" hidden>
                                            <?php
                                            if ($oneData->status == 0) {
                                                echo 'Belum Bayar';
                                            } else {
                                                echo 'Sudah Bayar';
                                            }
                                            ?>
                                        </option>
                                        <option value="0">Belum Bayar</option>
                                        <option value="1">Sudah Bayar</option>
                                    </select>
                                    <?= form_error('status', '<small class="text-danger">', '</small>'); ?>
                                </div>
                            </div>

                            <div class="text-end mt-5">
                                <a href="<?= base_url('dokter/registrasi') ?>" class="btn btn-secondary">Kembali</a>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form><!-- End Multi Columns Form -->

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>