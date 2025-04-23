<body class="hold-transition sidebar-mini sidebar-collapse">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            <!-- <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button> -->



            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">
                <div class="topbar-divider d-none d-sm-block"></div>

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small">Hai! <?= @$user['name']; ?></span>
                        <img class="img-profile rounded-circle" style="width: 30px;" src=" <?= base_url('assets/img/profile/default.png') ?>">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#profileModal">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            My Profile
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?= base_url('auth/logout'); ?>" aria-labelledby="userDropdown"">
                            <i class=" fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Modal -->
        <div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="profileModalLabel">My Profile</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4 text-center">
                                <img src="<?= base_url('assets/img/profile/default.png') ?>" class="img-thumbnail mb-2" width="150">
                            </div>
                            <div class="col-md-8">
                                <!-- <ul class="list-group list-group-flush mb-3">
                                    <li class="list-group-item"><strong>Nama:</strong> <?= $user['name'] ?></li>
                                    <li class="list-group-item"><strong>Email:</strong> <?= $user['email'] ?></li>
                                </ul> -->
                                <div class="form-group">
                                    <label for="current_password">Nama</label>
                                    <input type="nama" class="form-control" name="" value="<?= $user['name'] ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="current_password">Email</label>
                                    <input type="email" class="form-control" name="" value="<?= $user['email'] ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="current_password">Password Lama</label>
                                    <input type="password" class="form-control" name="" value="<?= $user['password'] ?>" disabled>
                                </div>

                                <!-- Form Ubah Password -->
                                <form method="post" action="<?= base_url('admin/update_password') ?>">
                                    <!-- <div class="form-group">
                                        <label for="current_password">Password Lama</label>
                                        <input type="password" class="form-control" name="current_password" required>
                                    </div> -->
                                    <div class="form-group">
                                        <label for="new_password">Password Baru</label>
                                        <input type="password" class="form-control" name="new_password" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="confirm_password">Konfirmasi Password Baru</label>
                                        <input type="password" class="form-control" name="confirm_password" required>
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-primary mt-2">Ubah Password</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>