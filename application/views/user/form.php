<div class="container" style="max-width: 600px;">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white text-center">
            <h4 class="mb-0"><?= !empty($member) ? 'Edit User' : 'Create User' ?></h4>
        </div>
        <div class="card-body">
            <form action="<?= !empty($member) ? base_url('user/update/' . $member->id_user) : base_url('user/create_user') ?>" method="post" enctype="multipart/form-data">

                <!-- Input ID (Hidden) -->
                <input type="hidden" name="p[id_user]" value="<?= !empty($member) ? $member->id_user : '' ?>">

                <!-- Input Nama -->
                <div class="form-group row">
                    <label for="name" class="col-12 col-sm-3 col-form-label">Nama</label>
                    <div class="col-12 col-sm-9">
                        <input type="text" id="name" name="p[name]" value="<?= !empty($member) ? $member->name : '' ?>" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="col-12 col-sm-3 col-form-label">Password</label>
                    <div class="col-12 col-sm-9">
                        <input type="password" id="password" name="p[password]" value="<?= !empty($member) ? $member->password : '' ?>" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-12 col-sm-3 col-form-label">Email</label>
                    <div class="col-12 col-sm-9">
                        <input type="email" id="email" name="p[email]" value="<?= !empty($member) ? $member->email : '' ?>" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="status" class="col-12 col-sm-3 col-form-label">Status</label>
                    <div class="col-12 col-sm-9">
                        <select id="status" name="p[status]" class="form-control" required>
                            <option value="1" <?= isset($member->status) && $member->status === '1' ? 'selected="selected"' : '' ?>>Aktif</option>
                            <option value="0" <?= isset($member->status) && $member->status === '0' ? 'selected="selected"' : '' ?>>Tidak Aktif</option>
                        </select>
                    </div>
                </div>

                <!-- Tombol -->
                <div class="text-right">
                    <button type="submit" class="btn btn-sm btn-primary"> <i class="fa fa-save"></i> Save</button>
                    <a href="<?= base_url('galery') ?>" class="btn btn-sm btn-danger"><i class="fa fa-arrow-left"></i> Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>