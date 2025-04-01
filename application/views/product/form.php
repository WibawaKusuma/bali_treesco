<div class="container" style="max-width: 1000px;">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white text-center">
            <h4 class="mb-0"><?= !empty($product) ? 'Edit Product' : 'Create Product' ?></h4>
        </div>
        <div class="card-body">
            <form action="<?= !empty($product) ? base_url('product/update/' . $product->id_product) : base_url('product/create_product') ?>" method="post" enctype="multipart/form-data">

                <!-- Input ID (Hidden) -->
                <input type="hidden" name="p[id_product]" value="<?= !empty($product) ? $product->id_product : '' ?>">
                <input type="hidden" name="p[id_user]" value="<?= $user['id_user'] ?>">


                <!-- Input Nama -->
                <div class="form-group row">
                    <label for="name" class="col-12 col-sm-2 col-form-label">Nama</label>
                    <div class="col-12 col-sm-10">
                        <input type="text" id="name" name="p[name]" value="<?= !empty($product) ? $product->name : '' ?>" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="description" class="col-12 col-sm-2 col-form-label">Deskripsi</label>
                    <div class="col-12 col-sm-10">
                        <input type="text" id="description" name="p[description]" value="<?= !empty($product) ? $product->description : '' ?>" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="price" class="col-12 col-sm-2 col-form-label">Harga</label>
                    <div class="col-12 col-sm-10">
                        <input type="text" id="price" name="p[price]" value="<?= !empty($product) ? $product->price : '' ?>" class="form-control" required>
                    </div>
                </div>
                <?php if (!empty($product)) { ?>
                    <div class="form-group row">
                        <label for="stock" class="col-12 col-sm-2 col-form-label">Stok</label>
                        <div class="col-12 col-sm-10">
                            <input type="text" id="stock" name="p[stock]" value="<?= !empty($product) ? $product->stock : '' ?>" class="form-control" disabled>
                        </div>
                    </div>
                <?php }  ?>

                <div class="form-group row">
                    <label for="status" class="col-12 col-sm-2 col-form-label">Status</label>
                    <div class="col-12 col-sm-10">
                        <select id="status" name="p[status]" class="form-control" required>
                            <option value="1" <?= isset($product->status) && $product->status === '1' ? 'selected="selected"' : '' ?>>Aktif</option>
                            <option value="0" <?= isset($product->status) && $product->status === '0' ? 'selected="selected"' : '' ?>>Tidak Aktif</option>
                        </select>
                    </div>
                </div>


                <!-- Input Gambar -->
                <div class="form-group row">
                    <label for="image" class="col-12 col-sm-2 col-form-label">Gambar</label>
                    <div class="col-12 col-sm-10">
                        <input type="file" id="image" name="image" class="form-control" accept="image/*" <?= empty($product) ? 'required' : '' ?>>

                        <?php if (!empty($product) && !empty($product->image)): ?>
                            <div class="mt-2">
                                <img src="<?= base_url('assets/img/product/' . $product->image) ?>" class="img-thumbnail" style="max-width: 50%;" alt="Current Image">
                                <input type="hidden" name="old_image" value="<?= $product->image ?>">
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Tombol -->
                <div class="text-right">
                    <button type="submit" class="btn btn-sm btn-primary"> <i class="fa fa-save"></i> Save</button>
                    <a href="<?= base_url('product') ?>" class="btn btn-sm btn-danger"><i class="fa fa-arrow-left"></i> Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>