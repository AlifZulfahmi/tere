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
                        <form class="row g-3" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?= $oneData->id ?>">
                            <div class="col-md-6 mb-2">
                                <label for="id_user" class="form-label">Akun Pengguna</label>
                                <select id="id_user" class="form-select" name="id_user" required>
                                    <option value="<?= $oneData->id_user ?>" hidden>
                                        <?php
                                        $uhuy = $this->db->get_where('pengguna', ['id' => $oneData->id_user])->row();
                                        if ($oneData->id_user) {
                                            echo $uhuy->email;
                                        } else {
                                            echo "Belum Dikaitkan";
                                        }
                                        ?>
                                    </option>
                                    <?php foreach ($data1 as $row) : ?>
                                        <option value="<?= $row->id ?>"><?= $row->email ?> (<?= $row->nama ?>)</option>
                                    <?php endforeach; ?>
                                </select>
                                <?= form_error('id_user', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="id_asrama" class="form-label">Asrama</label>
                                <select id="id_asrama" class="form-select" name="id_asrama" required>
                                    <option value="<?= $oneData->id_asrama ?>" hidden>
                                        <?php
                                        $uhuy2 = $this->db->get_where('asrama', ['id' => $oneData->id_asrama])->row();
                                        if ($oneData->id_asrama) {
                                            echo $uhuy2->nama;
                                        } else {
                                            echo "Belum ada";
                                        }
                                        ?>
                                    </option>
                                    <?php foreach ($data1 as $row) : ?>
                                        <option value="<?= $row->id ?>"><?= $row->email ?> (<?= $row->nama ?>)</option>
                                    <?php endforeach; ?>
                                </select>
                                <?= form_error('id_asrama', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" class="form-control" name="nama" id="nama" value="<?= $oneData->nama ?>" required>
                                <?= form_error('nama', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="bidang" class="form-label">Bidang Pengajaran</label>
                                <input type="text" class="form-control" name="bidang" id="bidang" value="<?= $oneData->bidang ?>" required>
                                <?= form_error('bidang', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="image" class="col-form-label">Foto Profil</label>
                                <!-- <div class="input-group"> -->
                                <div class="custom-file">
                                    <input class="form-control" type="file" name="image" id="image" accept="image/*">
                                </div>
                                <!-- </div> -->
                                <span class="small"><strong style="font-size: 10px;line-height:0.1;">Ukuran Foto tidak melebihi 5 MB dan Rekomendasi Rasio Aspek 1:1, Format (JPG/PNG/GIF)</strong></span>
                            </div>
                            <div class="col-md-6 mb-2">
                                <img src="<?= base_url('assets/img/user/') . $uhuy->image; ?>" class="img-thumbnail">
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="jk" class="form-label">Jenis Kelamin</label>
                                <select id="jk" class="form-select" name="jk" required>
                                    <option value="<?= $oneData->jk ?>" hidden>
                                        <?php if ($oneData->jk == 'L') : ?>
                                            Laki-laki
                                        <?php else : ?>
                                            Perempuan
                                        <?php endif; ?>
                                    </option>
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                                <?= form_error('jk', '<small class="text-danger">', '</small>'); ?>
                            </div>

                            <div class="text-end mt-5">
                                <a href="<?= base_url('admin/yayasan') ?>" class="btn btn-secondary">Kembali</a>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form><!-- End Multi Columns Form -->

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>