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
                                <div class="col-md-4">
                                    <label for="ind1" class="form-label">Karang Gigi</label>
                                    <select id="ind1" class="form-select" name="ind1" required>
                                        <option value="<?= $oneData->ind1 ?>" hidden>
                                            <?php
                                            if ($oneData->ind1 == 0) {
                                                echo 'Tidak Ada';
                                            } elseif ($oneData->ind1 == 1) {
                                                echo 'Ada';
                                            } else {
                                                echo 'Pilih ';
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
                                    <select id="ind2" class="form-select" name="ind2" required>
                                        <option value="<?= $oneData->ind2 ?>" hidden>
                                            <?php
                                            if ($oneData->ind2 == 0) {
                                                echo 'Tidak Ada';
                                            } elseif ($oneData->ind2 == 1) {
                                                echo 'Ada';
                                            } else {
                                                echo 'Pilih ';
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
                                    <select id="ind3" class="form-select" name="ind3" required>
                                        <option value="<?= $oneData->ind3 ?>" hidden>
                                            <?php
                                            if ($oneData->ind3 == 0) {
                                                echo 'Tidak Ada';
                                            } elseif ($oneData->ind3 == 1) {
                                                echo 'Ada';
                                            } else {
                                                echo 'Pilih ';
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
                                    <select id="ind4" class="form-select" name="ind4" required>
                                        <option value="<?= $oneData->ind4 ?>" hidden>
                                            <?php
                                            if ($oneData->ind4 == 0) {
                                                echo 'Tidak Ada';
                                            } elseif ($oneData->ind4 == 1) {
                                                echo 'Ada';
                                            } else {
                                                echo 'Pilih ';
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
                                    <select id="ind5" class="form-select" name="ind5" required>
                                        <option value="<?= $oneData->ind5 ?>" hidden>
                                            <?php
                                            if ($oneData->ind5 == 0) {
                                                echo 'Tidak Ada';
                                            } elseif ($oneData->ind5 == 1) {
                                                echo 'Ada';
                                            } else {
                                                echo 'Pilih ';
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
                                    <label for="resiko" class="form-label">Resiko Penyakit</label>
                                    <input type="text" name="resiko" id="resiko" class="form-control" value="<?= $oneData->resiko ?>" required>
                                    <?= form_error('resiko', '<small class="text-danger">', '</small>'); ?>
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