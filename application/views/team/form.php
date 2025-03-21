<div class="container" style="max-width: 1000px;">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white text-center">
            <h4 class="mb-0"><?= !empty($team) ? 'Edit Product' : 'Create Product' ?></h4>
        </div>
        <div class="card-body">
            <form action="<?= !empty($team) ? base_url('team/update/' . $team->id_team) : base_url('team/create_team') ?>" method="post" enctype="multipart/form-data">

                <!-- Input ID (Hidden) -->
                <input type="hidden" name="p[id_team]" value="<?= !empty($team) ? $team->id_team : '' ?>">

                <!-- Input Nama -->
                <div class="form-group row">
                    <label for="name" class="col-12 col-sm-2 col-form-label">Nama</label>
                    <div class="col-12 col-sm-10">
                        <input type="text" id="name" name="p[name]" value="<?= !empty($team) ? $team->name : '' ?>" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="description" class="col-12 col-sm-2 col-form-label">Deskripsi</label>
                    <div class="col-12 col-sm-10">
                        <input type="text" id="description" name="p[description]" value="<?= !empty($team) ? $team->description : '' ?>" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="instagram" class="col-12 col-sm-2 col-form-label">Instagram</label>
                    <div class="col-12 col-sm-10">
                        <input type="text" id="instagram" name="p[instagram]" value="<?= !empty($team) ? $team->instagram : '' ?>" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="tiktok" class="col-12 col-sm-2 col-form-label">tiktok</label>
                    <div class="col-12 col-sm-10">
                        <input type="text" id="tiktok" name="p[tiktok]" value="<?= !empty($team) ? $team->tiktok : '' ?>" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="phone" class="col-12 col-sm-2 col-form-label">phone</label>
                    <div class="col-12 col-sm-10">
                        <input type="text" id="phone" name="p[phone]" value="<?= !empty($team) ? $team->phone : '' ?>" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="status" class="col-12 col-sm-2 col-form-label">Status</label>
                    <div class="col-12 col-sm-10">
                        <select id="status" name="p[status]" class="form-control" required>
                            <option value="1" <?= isset($team->status) && $team->status === '1' ? 'selected="selected"' : '' ?>>Aktif</option>
                            <option value="0" <?= isset($team->status) && $team->status === '0' ? 'selected="selected"' : '' ?>>Tidak Aktif</option>
                        </select>
                    </div>
                </div>


                <!-- Input Gambar -->
                <div class="form-group row">
                    <label for="image" class="col-12 col-sm-2 col-form-label">Gambar</label>
                    <div class="col-12 col-sm-10">
                        <input type="file" id="image" name="image" class="form-control" accept="image/*" <?= empty($team) ? 'required' : '' ?>>

                        <?php if (!empty($team) && !empty($team->image)): ?>
                            <div class="mt-2">
                                <img src="<?= base_url('assets/img/team/' . $team->image) ?>" class="img-thumbnail" style="max-width: 50%;" alt="Current Image">
                                <input type="hidden" name="old_image" value="<?= $team->image ?>">
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Tombol -->
                <div class="text-right">
                    <button type="submit" class="btn btn-sm btn-primary"> <i class="fa fa-save"></i> Save</button>
                    <a href="<?= base_url('team') ?>" class="btn btn-sm btn-danger"><i class="fa fa-arrow-left"></i> Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>