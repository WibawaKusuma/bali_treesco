<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0"><?= !empty($galery) ? 'Edit galery' : 'Create galery' ?></h4>
        </div>
        <div class="card-body">
            <form action="<?= !empty($galery) ? base_url('galery/update/' . $galery->id_galery) : base_url('galery/create_galery') ?>" method="post" enctype="multipart/form-data">
                <div class="form-group row" hidden>
                    <label for="" class="col-sm-2 col-form-label">ID</label>
                    <div class="col-sm-6">
                        <input type="text" id="" name="p[id_galery]" value="<?= !empty($galery) ? $galery->id_galery : '' ?>" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-6">
                        <input type="text" id="name" name="p[name]" value="<?= !empty($galery) ? $galery->name : '' ?>" class="form-control" required>
                    </div>
                </div>
                <!-- Form Group untuk Upload Image -->
                <div class="form-group row">
                    <label for="image" class="col-sm-2 col-form-label">Gambar</label>
                    <div class="col-sm-6">
                        <input type="file" id="image" name="image" class="form-control" accept="image/*" <?= empty($galery) ? 'required' : '' ?>>
                        <?php if (!empty($galery) && !empty($galery->image)): ?>
                            <div class="mt-2">
                                <img src="<?= base_url('assets/img/galery/' . $galery->image) ?>" class="img-thumbnail" width="150" alt="Current Image">
                                <input type="hidden" name="old_image" value="<?= $galery->image ?>">
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-8 text-right">
                    <button type="submit" class="btn btn-primary"> <i class="fa fa-save"></i> Save</button>
                    <a href="<?= base_url('galery') ?>" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>