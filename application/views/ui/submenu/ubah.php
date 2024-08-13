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
                                <label for="menu_id" class="form-label">Menu</label>
                                <select id="menu_id" class="form-select" name="menu_id" required>
                                    <option value="<?= $oneData->menu_id ?>" hidden>
                                        <?= $oneData->menu ?>
                                    </option>
                                    <?php foreach ($dataTab as $row) : ?>
                                        <option value="<?= $row->id; ?>"><?= $row->menu; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?= form_error('menu_id', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="col-md-6">
                                <label for="title" class="form-label">Nama Submenu</label>
                                <input type="text" class="form-control" name="title" id="title" value="<?= $oneData->title ?>" required>
                                <?= form_error('title', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="col-md-6">
                                <label for="url_i" class="form-label">Link 1</label>
                                <input type="text" class="form-control" name="url_i" id="url_i" value="<?= $oneData->url_i ?>" required>
                                <?= form_error('url_i', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="col-md-6">
                                <label for="url_ii" class="form-label">Link 2</label>
                                <input type="text" class="form-control" name="url_ii" id="url_ii" value="<?= $oneData->url_ii ?>" required>
                                <?= form_error('url_ii', '<small class="text-danger">', '</small>'); ?>
                            </div>

                            <div class="col-md-6">
                                <label for="status" class="form-label">Status</label>
                                <select id="status" class="form-select" name="status" required>
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
                                <a href="<?= base_url('ui/submenu') ?>" class="btn btn-secondary">Kembali</a>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form><!-- End Multi Columns Form -->

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>