<div class="container">
    <div class="page-inner">
        <div class="row">
            <?= $this->session->flashdata('profil'); ?>
            <div class="col-xl-4">
                <?php

                if ($user->image == 'default') {
                    if ($user->jenis_kelamin == 'L') {
                        $fotoprofil = base_url('assets/img/user/default/') . 'L.jpg';
                    } else {
                        $fotoprofil = base_url('assets/img/user/default/') . 'P.jpg';
                    }
                } else {
                    $fotoprofil = base_url('assets/img/user/') . $user->image;
                }

                if ($user->role == 1) {
                    $namaRole = 'Admin';
                } elseif ($user->role == 2) {
                    $namaRole = 'Keuangan';
                } else {
                    $namaRole = 'Yayasan';
                }
                ?>
                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                        <img src="<?= $fotoprofil ?>" alt="Profile" class="rounded-circle" width="100">
                        <h2><?= $user->nama ?></h2>
                        <h3><?= $namaRole ?></h3>
                        <div class="social-links mt-2">
                            <a target="_blank" href="https://wa.me/62<?= substr($user->no_hp, 1) ?>" class="twitter"><i class="bi bi-whatsapp"></i></a>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-xl-8">

                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">

                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                            </li>

                        </ul>
                        <div class="tab-content pt-2">

                            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                <h5 class="card-title">Profile Details</h5>

                                <div class="row my-3">
                                    <div class="col-lg-3 col-md-4 label ">Nama</div>
                                    <div class="col-lg-9 col-md-8"><?= $user->nama ?></div>
                                </div>

                                <div class="row my-3">
                                    <div class="col-lg-3 col-md-4 label">Email</div>
                                    <div class="col-lg-9 col-md-8"><?= sumput($user->email) ?></div>
                                </div>

                                <div class="row my-3">
                                    <div class="col-lg-3 col-md-4 label">No Handphone</div>
                                    <div class="col-lg-9 col-md-8"><?= $user->no_hp ?></div>
                                </div>

                                <div class="row my-3">
                                    <div class="col-lg-3 col-md-4 label">Jenis Kelamin</div>
                                    <div class="col-lg-9 col-md-8">
                                        <?php
                                        if ($user->jenis_kelamin == 'L') {
                                            echo "Laki-laki";
                                        } else {
                                            echo "Perempuan";
                                        }
                                        ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Role</div>
                                    <div class="col-lg-9 col-md-8">
                                        <?php
                                        if ($user->role == 1) {
                                            echo "Admin";
                                        } elseif ($user->role == 2) {
                                            echo "Keuangan";
                                        } else {
                                            echo "Yayasan";
                                        }
                                        ?>
                                    </div>
                                </div>

                            </div>

                            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">


                                <!-- Profile Edit Form -->
                                <form method="post" enctype="multipart/form-data">
                                    <div class="row mb-3">
                                        <label for="image" class="col-md-4 col-lg-3 col-form-label">Foto Profil</label>
                                        <div class="col-md-8 col-lg-9">
                                            <img src="<?= $fotoprofil ?>" alt="Profile" width="100">
                                            <div class="pt-2">
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input class="form-control" type="file" name="image" id="image" accept="image/*">
                                                    </div>
                                                </div>
                                                <span class="small"><strong style="font-size: 10px;line-height:0.1;">Ukuran Foto tidak melebihi 5 MB dan Rekomendasi Rasio Aspek 1:1, Format (JPG/PNG/GIF)</strong></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="nama" class="col-md-4 col-lg-3 col-form-label">Nama</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="nama" type="text" class="form-control" id="nama" value="<?= $user->nama ?>">
                                            <?= form_error('nama', '<small class="text-danger">', '</small>'); ?>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input type="email" class="form-control" id="email" value="<?= sumput($user->email) ?>" disabled>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="no_hp" class="col-md-4 col-lg-3 col-form-label">No Handphone</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="no_hp" type="tel" class="form-control" id="no_hp" value="<?= $user->no_hp ?>">
                                            <?= form_error('no_hp', '<small class="text-danger">', '</small>'); ?>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="jenis_kelamin" class="col-md-4 col-lg-3 col-form-label">Jenis Kelamin</label>
                                        <div class="col-md-8 col-lg-9">
                                            <select id="jenis_kelamin" class="form-select" name="jenis_kelamin">
                                                <option value="<?= $user->jenis_kelamin ?>" hidden>
                                                    <?php if ($user->jenis_kelamin == 'L') : ?>
                                                        Laki-laki
                                                    <?php else : ?>
                                                        Perempuan
                                                    <?php endif; ?>
                                                </option>
                                                <option value="L">Laki-laki</option>
                                                <option value="P">Perempuan</option>
                                            </select>
                                            <?= form_error('jenis_kelamin', '<small class="text-danger">', '</small>'); ?>
                                        </div>
                                    </div>


                                    <div class="text-center">
                                        <input type="submit" name="submitProfil" class="btn btn-primary" value="Simpan Perubahan">
                                    </div>
                                </form><!-- End Profile Edit Form -->

                            </div>


                            <div class="tab-pane fade pt-3" id="profile-change-password">
                                <!-- Change Password Form -->
                                <form method="post">

                                    <div class="row mb-3">
                                        <label for="password" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="password" type="password" class="form-control" id="passwords">
                                            <?= form_error('password', '<small class="text-danger">', '</small><br>'); ?>
                                            <input type="checkbox" onclick="showPasswords()"> <small>Show</small>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="newpassword" type="password" class="form-control" id="newPassword">
                                            <?= form_error('newpassword', '<small class="text-danger">', '</small><br>'); ?>
                                            <input type="checkbox" onclick="showPasswordd()"> <small>Show</small>

                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                                            <?= form_error('renewpassword', '<small class="text-danger">', '</small><br>'); ?>
                                            <input type="checkbox" onclick="showPassworddd()"> <small>Show</small>
                                        </div>
                                    </div>

                                    <script>
                                        var x = document.getElementById("passwords");
                                        var y = document.getElementById("newPassword");
                                        var z = document.getElementById("renewPassword");

                                        function showPasswords() {
                                            if (x.type === "password") {
                                                x.type = "text";
                                            } else {
                                                x.type = "password";
                                            }
                                        }

                                        function showPasswordd() {
                                            if (y.type === "password") {
                                                y.type = "text";
                                            } else {
                                                y.type = "password";
                                            }
                                        }

                                        function showPassworddd() {
                                            if (z.type === "password") {
                                                z.type = "text";
                                            } else {
                                                z.type = "password";
                                            }
                                        }
                                    </script>

                                    <div class="text-center">
                                        <input type="submit" name="submitPassword" class="btn btn-primary" value="Ubah Password">
                                    </div>
                                </form><!-- End Change Password Form -->

                            </div>

                        </div><!-- End Bordered Tabs -->

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>