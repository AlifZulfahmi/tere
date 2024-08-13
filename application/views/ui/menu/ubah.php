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
                                <label for="menu" class="form-label">Nama</label>
                                <input type="text" class="form-control" name="menu" id="menu" value="<?= $oneData->menu ?>" required>
                                <?= form_error('menu', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="col-md-6">
                                <label for="link" class="form-label">Link</label>
                                <input type="text" class="form-control" name="link" id="link" value="<?= $oneData->link ?>" required>
                                <?= form_error('link', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="col-md-6">
                                <label for="icon" class="form-label">Ikon</label>
                                <input type="text" class="form-control" name="icon" id="icon" value="<?= $oneData->icon ?>" required>
                                <?= form_error('icon', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="col-md-6">
                                <label for="order" class="form-label">Urutan</label>
                                <input type="text" class="form-control" name="order" id="order" value="<?= $oneData->order ?>" required>
                                <?= form_error('order', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="col-md-6">
                                <label for="for" class="form-label">Akses</label>
                                <select id="for" class="form-select" name="for" required>
                                    <option value="<?= $oneData->for ?>" hidden>
                                        <?php if ($oneData->for == 1) : ?>
                                            Admin
                                        <?php elseif ($oneData->for == 2) : ?>
                                            Keuangan
                                        <?php else : ?>
                                            Ustadz
                                        <?php endif; ?>
                                    </option>
                                    <option value="1">Admin</option>
                                    <option value="2">Keuangan</option>
                                    <option value="3">Ustadz</option>
                                </select>
                                <?= form_error('for', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="col-md-6">
                                <label for="inputState" class="form-label">Status</label>
                                <select id="inputState" class="form-select" name="status" required>
                                    <option value="<?= $oneData->status ?>" hidden>
                                        <?php if ($oneData->status == 1) : ?>
                                            Aktif
                                        <?php else : ?>
                                            Nonaktif
                                        <?php endif; ?>
                                    </option>
                                    <option value="1">Aktif</option>
                                    <option value="0">Nonaktif</option>
                                </select>
                                <?= form_error('status', '<small class="text-danger">', '</small>'); ?>
                            </div>

                            <div class="text-end mt-5">
                                <a href="<?= base_url('ui/menu') ?>" class="btn btn-secondary">Kembali</a>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form><!-- End Multi Columns Form -->

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>