<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Aluh Trans | <?= $title ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('assets/template') ?>/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url('assets/template') ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/template') ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets/template') ?>/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5 col-lg-7 mx-auto">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg">
                    <div class="p-5">
                        <div class="text-center" hidden>
                            <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                        </div>
                        <div class="text-center" style="margin-bottom: 20px;">
                            <img src="<?= base_url('assets/template') ?>/img/logo/logo_login2.png" alt="" height="150px">
                        </div>
                        <form class="user" method="post" action="<?= base_url("auth/registration") ?>">

                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" name="name" id="name" placeholder="Full name" value="<?= set_value('name') ?>">
                                <?= form_error('name', '<small class="text-danger pl-4">', '</small>') ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" name="email" id="email" placeholder="Email Address" value="<?= set_value('email') ?>">
                                <?= form_error('email', '<small class="text-danger pl-4">', '</small>') ?>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" class="form-control form-control-user" id="password1" name="password1" placeholder="Password">
                                    <?= form_error('password1', '<small class="text-danger pl-4 ">', '</small>') ?>
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="Repeat Password">
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" name="no_telpon" id="no_telpon" placeholder="Telephone Nomber " value="<?= set_value('no_telpon') ?>">
                                <?= form_error('no_telpon', '<small class="text-danger pl-4">', '</small>') ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" name="address" id="address" placeholder="Address " value="<?= set_value('address') ?>">
                                <?= form_error('address', '<small class="text-danger pl-4">', '</small>') ?>
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Register Account
                            </button>
                        </form>
                        <hr>
                        <div class="text-center" hidden>
                            <a class="small" href="forgot-password.html">Forgot Password?</a>
                        </div>
                        <div class="text-center">
                            <a class="small" href="<?= base_url('auth') ?>">Already have an account? Login!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>