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
                    <div class="card-header"><?= $title ?> - <?= $oneData->no_rm ?></div>
                    <div class="card-body">

                        <!-- Multi Columns Form -->
                        <form class="row g-3" method="post">
                            <input type="hidden" name="id" value="<?= $oneData->id ?>">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="gol_darah" class="form-label">Golongan Darah</label>
                                    <select id="gol_darah" class="form-select" name="gol_darah">
                                        <option value="<?= $oneData->gol_darah ?>" hidden>
                                            <?php
                                            if ($oneData->gol_darah) {
                                                echo $oneData->gol_darah;
                                            } else {
                                                echo 'Pilih Golongan Darah';
                                            }
                                            ?>
                                        </option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="O">O</option>
                                        <option value="AB">AB</option>
                                    </select>
                                    <?= form_error('gol_darah', '<small class="text-danger">', '</small>'); ?>
                                </div>
                                <div class="col-md-6">
                                    <label for="tek_darah" class="form-label">Tekanan Darah</label>
                                    <select id="tek_darah" class="form-select" name="tek_darah">
                                        <option value="<?= $oneData->tek_darah ?>" hidden>
                                            <?php
                                            if ($oneData->tek_darah == 1) {
                                                echo 'Normal';
                                            } elseif ($oneData->tek_darah == 2) {
                                                echo 'Rendah';
                                            } elseif ($oneData->tek_darah == 3) {
                                                echo 'Tinggi';
                                            } else {
                                                echo 'Pilih Tekanan Darah';
                                            }
                                            ?>
                                        </option>
                                        <option value="1">Normal</option>
                                        <option value="2">Rendah</option>
                                        <option value="3">Tinggi</option>
                                    </select>
                                    <?= form_error('tek_darah', '<small class="text-danger">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="ind1" class="form-label">Karang Gigi</label>
                                    <select id="ind1" class="form-select" name="ind1">
                                        <option value="<?= $oneData->karanggigi ?>" hidden>
                                            <?php
                                            if ($oneData->karanggigi == 1) {
                                                echo 'Ada';
                                            } else {
                                                echo 'Tidak Ada';
                                            }
                                            ?>
                                        </option>
                                        <option value="1">Ada</option>
                                        <option value="0">Tidak Ada</option>
                                    </select>

                                    <?= form_error('ind1', '<small class="text-danger">', '</small>'); ?>
                                </div>
                                <div class="col-md-4">
                                    <label for="ind2" class="form-label">Sakit Gigi</label>
                                    <select id="ind2" class="form-select" name="ind2">
                                        <option value="<?= $oneData->sakitgigi ?>" hidden>
                                            <?php
                                            if ($oneData->sakitgigi == 1) {
                                                echo 'Ada';
                                            } else {
                                                echo 'Tidak Ada';
                                            }
                                            ?>
                                        </option>
                                        <option value="1">Ada</option>
                                        <option value="0">Tidak Ada</option>
                                    </select>
                                    <?= form_error('ind2', '<small class="text-danger">', '</small>'); ?>
                                </div>
                                <div class="col-md-4">
                                    <label for="ind3" class="form-label">Radang Gusi</label>
                                    <select id="ind3" class="form-select" name="ind3">
                                        <option value="<?= $oneData->radanggusi ?>" hidden>
                                            <?php
                                            if ($oneData->radanggusi == 1) {
                                                echo 'Ada';
                                            } else {
                                                echo 'Tidak Ada';
                                            }
                                            ?>
                                        </option>
                                        <option value="1">Ada</option>
                                        <option value="0">Tidak Ada</option>
                                    </select>
                                    <?= form_error('ind3', '<small class="text-danger">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="ind4" class="form-label">Pendarahan</label>
                                    <select id="ind4" class="form-select" name="ind4">
                                        <option value="<?= $oneData->pendarahan ?>" hidden>
                                            <?php
                                            if ($oneData->pendarahan == 1) {
                                                echo 'Ada';
                                            } else {
                                                echo 'Tidak Ada';
                                            }
                                            ?>
                                        </option>
                                        <option value="1">Ada</option>
                                        <option value="0">Tidak Ada</option>
                                    </select>

                                    <?= form_error('ind4', '<small class="text-danger">', '</small>'); ?>
                                </div>
                                <div class="col-md-6">
                                    <label for="ind5" class="form-label">Pembengkakan</label>
                                    <select id="ind5" class="form-select" name="ind5">
                                        <option value="<?= $oneData->bengkak ?>" hidden>
                                            <?php
                                            if ($oneData->bengkak == 1) {
                                                echo 'Ada';
                                            } else {
                                                echo 'Tidak Ada';
                                            }
                                            ?>
                                        </option>
                                        <option value="1">Ada</option>
                                        <option value="0">Tidak Ada</option>
                                    </select>
                                    <?= form_error('ind5', '<small class="text-danger">', '</small>'); ?>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="lainnya" class="form-label">Lainnya</label>
                                    <input type="text" class="form-control" name="lainnya" id="lainnya" value="<?= $oneData->lainnya ?>">
                                    <?= form_error('lainnya', '<small class="text-danger">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="alergi_obat" class="form-label">Alergi Obat</label>
                                    <input type="text" class="form-control" name="alergi_obat" id="alergi_obat" value="<?= $oneData->alergi_obat ?>">
                                    <?= form_error('alergi_obat', '<small class="text-danger">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="alergi_makanan" class="form-label">Alergi Makanan</label>
                                    <input type="text" class="form-control" name="alergi_makanan" id="alergi_makanan" value="<?= $oneData->alergi_makanan ?>">
                                    <?= form_error('alergi_makanan', '<small class="text-danger">', '</small>'); ?>
                                </div>
                            </div>

                            <div class="text-end mt-5">
                                <a href="<?= base_url('dokter/medik') ?>" class="btn btn-secondary">Kembali</a>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form><!-- End Multi Columns Form -->

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>