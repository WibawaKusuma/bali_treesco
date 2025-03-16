<div class="container" style="max-width: 600px;">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white text-center">
            <h4 class="mb-0"><?= !empty($galery) ? 'Edit Galery' : 'Create Galery' ?></h4>
        </div>
        <div class="card-body">
            <form action="<?= !empty($galery) ? base_url('galery/update/' . $galery->id_galery) : base_url('galery/create_galery') ?>" method="post" enctype="multipart/form-data">

                <!-- Input ID (Hidden) -->
                <input type="hidden" name="p[id_galery]" value="<?= !empty($galery) ? $galery->id_galery : '' ?>">

                <!-- Input Nama -->
                <div class="form-group row">
                    <label for="name" class="col-12 col-sm-2 col-form-label">Nama</label>
                    <div class="col-12 col-sm-10">
                        <input type="text" id="name" name="p[name]" value="<?= !empty($galery) ? $galery->name : '' ?>" class="form-control" required>
                    </div>
                </div>

                <!-- Input Gambar -->
                <div class="form-group row">
                    <label for="image" class="col-12 col-sm-2 col-form-label">Gambar</label>
                    <div class="col-12 col-sm-10">
                        <input type="file" id="image" name="image" class="form-control" accept="image/*" <?= empty($galery) ? 'required' : '' ?>>

                        <?php if (!empty($galery) && !empty($galery->image)): ?>
                            <div class="mt-2">
                                <img src="<?= base_url('assets/img/galery/' . $galery->image) ?>" class="img-thumbnail" style="max-width: 50%;" alt="Current Image">
                                <input type="hidden" name="old_image" value="<?= $galery->image ?>">
                            </div>
                        <?php endif; ?>
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