<div class="container" style="max-width: 1000px;">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white text-center">
            <h4 class="mb-0"><?= !empty($selling) ? 'Proses Selling' : 'Create Selling' ?></h4>
        </div>
        <div class="card-body">
            <?php
            // Cek apakah status pesanan sudah selesai (jika belum didefinisikan di atas)
            if (!isset($isCompleted)) {
                $isCompleted = false;
                if (isset($selling->original_status) && $selling->original_status == 'selesai') {
                    $isCompleted = true;
                } elseif (!isset($selling->original_status) && isset($selling->status) && $selling->status == 1 && isset($selling->batal) && $selling->batal == 0) {
                    $isCompleted = true;
                }
            }

            // Jika status selesai, form tidak perlu action
            $formAction = $isCompleted ? '#' : (!empty($selling) ? base_url('selling/update/' . $selling->id_selling) : base_url('selling/create_selling'));
            ?>
            <?php if ($isCompleted): ?>
                <div class="alert alert-info mb-4">
                    <i class="fa fa-info-circle mr-2"></i> Pesanan ini sudah selesai diproses dan tidak dapat diubah lagi.
                </div>
            <?php endif; ?>

            <form action="<?= $formAction ?>" method="post" enctype="multipart/form-data" <?= $isCompleted ? 'class="form-readonly"' : '' ?>>

                <!-- Input ID (Hidden) -->
                <input type="hidden" name="p[id_selling]" value="<?= !empty($selling) ? $selling->id_selling : '' ?>">

                <div class="row">
                    <div class="col-lg-6">
                        <!-- Informasi Customer -->
                        <div class="form-group row">
                            <label for="order_number" class="col-12 col-sm-3 col-form-label">No. Pesanan</label>
                            <div class="col-12 col-sm-9">
                                <input type="text" id="order_number" name="p[order_number]" value="<?= !empty($selling) ? $selling->order_number : '' ?>" class="form-control" required disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customer_name" class="col-12 col-sm-3 col-form-label">Nama</label>
                            <div class="col-12 col-sm-9">
                                <input type="text" id="customer_name" name="p[customer_name]" value="<?= !empty($selling) ? $selling->customer_name : '' ?>" class="form-control" required disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customer_phone" class="col-12 col-sm-3 col-form-label">Telpon</label>
                            <div class="col-12 col-sm-9">
                                <input type="text" id="customer_phone" name="p[customer_phone]" value="<?= !empty($selling) ? $selling->customer_phone : '' ?>" class="form-control" required disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="created_at" class="col-12 col-sm-3 col-form-label">Order Tgl</label>
                            <div class="col-12 col-sm-9">
                                <input type="text" id="created_at" name="p[created_at]" value="<?= !empty($selling) ? date('d M Y H:i', strtotime($selling->created_at)) : '' ?>" class="form-control" required disabled>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-6">
                        <!-- Informasi Produk dan Pesanan -->
                        <div class="form-group row">
                            <label for="name" class="col-12 col-sm-3 col-form-label">Produk</label>
                            <div class="col-12 col-sm-9">
                                <input type="text" id="name" name="p[name]" value="<?= !empty($selling) ? $selling->name : '' ?>" class="form-control" required disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="price" class="col-12 col-sm-3 col-form-label">Harga satuan</label>
                            <div class="col-12 col-sm-9">
                                <input type="text" id="price" name="p[price]" value="<?= !empty($selling) ? number_format($selling->price, 0, ',', '.') : '' ?>" class="form-control" required disabled>
                            </div>
                        </div>
                        <!-- Qty dan Total dihapus dari header, dipindahkan ke tabel detail -->
                        <input type="hidden" id="qty" name="p[qty]" value="<?= !empty($selling) ? $selling->qty : '' ?>">
                        <input type="hidden" id="total_price" name="p[total_price]" value="<?= !empty($selling) ? $selling->total_price : '' ?>">
                        <div class="form-group row">
                            <label for="status" class="col-12 col-sm-3 col-form-label">Status</label>
                            <div class="col-12 col-sm-9">
                                <?php
                                // Cek apakah ada status asli dari tr_order
                                if (isset($selling->original_status)) {
                                    // Gunakan status asli dari tr_order
                                    switch ($selling->original_status) {
                                        case 'proses':
                                            $status_text = 'Sedang Diproses';
                                            $status_class = 'badge badge-info text-white';
                                            break;
                                        case 'selesai':
                                            $status_text = 'Selesai';
                                            $status_class = 'badge badge-success';
                                            break;
                                        case 'batal':
                                            $status_text = 'Pesanan Dibatalkan';
                                            $status_class = 'badge badge-danger';
                                            break;
                                        default:
                                            $status_text = 'Status Tidak Diketahui';
                                            $status_class = 'badge badge-secondary';
                                    }
                                } else {
                                    // Fallback ke logika lama jika tidak ada status asli
                                    $status = isset($selling->status) ? $selling->status : null;
                                    $batal = isset($selling->batal) ? $selling->batal : null;

                                    if ($status == 1 && $batal == 0) {
                                        $status_text = 'Selesai';
                                        $status_class = 'badge badge-success';
                                    } elseif ($status == 0 && $batal == 0) {
                                        $status_text = 'Proses';
                                        $status_class = 'badge badge-info text-white';
                                    } else {
                                        $status_text = 'Dibatalkan';
                                        $status_class = 'badge badge-danger';
                                    }
                                }
                                ?>
                                <div class="p-2 <?= $status_class ?>" style="font-size: 1rem;">
                                    <?= $status_text ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Opsi Ongkir -->
                <?php if (!empty($order_details)): ?>
                    <hr>
                    <?php
                    // Cek apakah status pesanan sudah selesai
                    $isCompleted = false;
                    if (isset($selling->original_status) && $selling->original_status == 'selesai') {
                        $isCompleted = true;
                    } elseif (!isset($selling->original_status) && isset($selling->status) && $selling->status == 1 && isset($selling->batal) && $selling->batal == 0) {
                        $isCompleted = true;
                    }
                    ?>
                    <div class="row mb-3">
                        <div class="col-md-10">
                            <h5>Opsi Pengiriman</h5>
                            <?php if ($isCompleted): ?>
                                <!-- Tampilkan informasi ongkir tanpa input jika status selesai -->
                                <div class="d-flex align-items-center flex-wrap">
                                    <div class="form-check mr-4">
                                        <input class="form-check-input" type="radio" disabled <?= (empty($selling->shipping_cost) || $selling->shipping_cost <= 0) ? 'checked' : '' ?>>
                                        <label class="form-check-label">Tanpa Ongkir</label>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <div class="form-check mr-2">
                                            <input class="form-check-input" type="radio" disabled <?= (!empty($selling->shipping_cost) && $selling->shipping_cost > 0) ? 'checked' : '' ?>>
                                            <label class="form-check-label">Dengan Ongkir</label>
                                        </div>
                                        <?php if (!empty($selling->shipping_cost) && $selling->shipping_cost > 0): ?>
                                            <div>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Rp</span>
                                                    </div>
                                                    <input type="text" class="form-control" value="<?= number_format($selling->shipping_cost, 0, ',', '.') ?>" disabled>
                                                    <input type="hidden" name="p[shipping_cost]" value="<?= $selling->shipping_cost ?>">
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php else: ?>
                                <!-- Tampilkan input ongkir jika status belum selesai -->
                                <div class="d-flex align-items-center flex-wrap">
                                    <div class="form-check mr-4">
                                        <input class="form-check-input" type="radio" name="shipping_option" id="shipping-no" value="no" <?= (empty($selling->shipping_cost) || $selling->shipping_cost <= 0) ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="shipping-no">Tanpa Ongkir</label>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <div class="form-check mr-2">
                                            <input class="form-check-input" type="radio" name="shipping_option" id="shipping-yes" value="yes" <?= (!empty($selling->shipping_cost) && $selling->shipping_cost > 0) ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="shipping-yes">Dengan Ongkir</label>
                                        </div>
                                        <div id="shipping-cost-container" style="<?= (!empty($selling->shipping_cost) && $selling->shipping_cost > 0) ? '' : 'display: none;' ?>">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Rp</span>
                                                </div>
                                                <input type="number" id="shipping-cost" name="p[shipping_cost]" class="form-control" value="<?= !empty($selling->shipping_cost) ? $selling->shipping_cost : '0' ?>" min="0">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <hr>

                    <!-- Detail Pesanan -->
                    <h5 class="mb-3">Detail Pesanan</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-success">
                                <tr>
                                    <th>Produk</th>
                                    <th>Nama</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($order_details as $item): ?>
                                    <tr>
                                        <td class="text-center">
                                            <img src="<?= base_url('assets/img/product/' . $item->image); ?>" alt="<?= $item->name; ?>" class="img-thumbnail" style="max-width: 80px;">
                                        </td>
                                        <td><?= $item->name; ?></td>
                                        <td>Rp <?= number_format($item->price, 0, ',', '.'); ?></td>
                                        <td class="text-center">
                                            <?php if ($isCompleted): ?>
                                                <!-- Tampilkan qty tanpa input jika status selesai -->
                                                <span class="" style="font-size: 14px; padding: 8px 12px;"><?= $item->qty; ?></span>
                                                <input type="hidden" name="item_qty[<?= $item->id_order_detail; ?>]" value="<?= $item->qty; ?>">
                                            <?php else: ?>
                                                <!-- Tampilkan input qty jika status belum selesai -->
                                                <input type="number" class="form-control item-qty"
                                                    name="item_qty[<?= $item->id_order_detail; ?>]"
                                                    data-id="<?= $item->id_order_detail; ?>"
                                                    data-price="<?= $item->price; ?>"
                                                    value="<?= $item->qty; ?>"
                                                    min="1" style="width: 70px; margin: 0 auto;">
                                            <?php endif; ?>
                                        </td>
                                        <td class="item-subtotal">Rp <?= number_format($item->subtotal, 0, ',', '.'); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4" class="text-right"><strong>Subtotal Produk</strong></td>
                                    <td><strong id="subtotal-products">Rp <?= number_format($selling->total_price - (!empty($selling->shipping_cost) ? $selling->shipping_cost : 0), 0, ',', '.'); ?></strong></td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="text-right"><strong>Ongkir</strong></td>
                                    <td><strong id="shipping-cost-display">Rp <?= number_format(!empty($selling->shipping_cost) ? $selling->shipping_cost : 0, 0, ',', '.'); ?></strong></td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="text-right"><strong>Total Keseluruhan</strong></td>
                                    <td><strong id="grand-total">Rp <?= number_format($selling->total_price, 0, ',', '.'); ?></strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                <?php endif; ?>

                <!-- Tombol -->
                <hr>
                <div class="text-right">
                    <!-- Tombol sudah diatur di bawah berdasarkan status -->
                    <?php
                    // Tampilkan tombol berdasarkan status asli
                    if (isset($selling->original_status)) {
                        // Tombol Batal dan Proses hanya untuk status proses
                        if ($selling->original_status == 'proses'):
                    ?>
                            <button type="button" class="btn btn-sm btn-danger" id="btn-cancel" data-id="<?= $selling->id_selling ?>">
                                <i class="fa fa-times"></i> Batal
                            </button>
                            <button type="submit" class="btn btn-sm btn-success" id="btn-submit">
                                <i class="fa fa-save"></i> Proses
                            </button>
                        <?php
                        endif;

                        // Tombol Print untuk status selesai atau batal
                        if (in_array($selling->original_status, ['selesai', 'batal'])):
                        ?>
                            <button
                                type="button"
                                class="btn btn-sm btn-primary"
                                onclick="window.open('<?= site_url('selling/print_nota/' . $selling->id_selling) ?>', '_blank')">
                                <i class="fa fa-file"></i> Print
                            </button>
                        <?php
                        endif;
                    } else {
                        // Fallback ke logika lama jika tidak ada status asli
                        if (empty($selling) || ($selling->status != 1 && $selling->batal != 1)):
                        ?>
                            <button type="button" class="btn btn-sm btn-danger" id="btn-cancel" data-id="<?= $selling->id_selling ?>">
                                <i class="fa fa-times"></i> Batal
                            </button>
                            <button type="submit" class="btn btn-sm btn-success" id="btn-submit">
                                <i class="fa fa-save"></i> Proses
                            </button>
                        <?php
                        endif;

                        if (empty($selling) || ($selling->status == 1 && $selling->batal == 0) || ($selling->status == 0 && $selling->batal == 1)):
                        ?>
                            <button
                                type="button"
                                class="btn btn-sm btn-primary"
                                onclick="window.open('<?= site_url('selling/print_nota/' . $selling->id_selling) ?>', '_blank')">
                                <i class="fa fa-file"></i> Print
                            </button>
                    <?php
                        endif;
                    }
                    ?>

                    <a href="<?= base_url('selling') ?>" class="btn btn-sm btn-secondary"><i class="fa fa-arrow-left"></i> Back</a>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="<?= base_url('assets/js/lib/jquery/jquery-3.6.0.min.js') ?>"></script>
<script src="<?= base_url('assets/js/lib/sweetalert2/sweetalert2.all.min.js') ?>"></script>

<style>
    /* Style untuk form yang readonly */
    .form-readonly input[type="text"],
    .form-readonly input[type="number"],
    .form-readonly input[type="email"],
    .form-readonly input[type="tel"],
    .form-readonly input[type="date"],
    .form-readonly select,
    .form-readonly textarea {
        background-color: #f8f9fa;
        pointer-events: none;
    }

    .form-readonly .form-check-input {
        pointer-events: none;
    }

    .form-readonly button[type="submit"] {
        display: none;
    }
</style>

<script>
    $(document).ready(function() {
        // Cek apakah form dalam mode readonly
        const isFormReadonly = $('form').hasClass('form-readonly');

        // Fungsi untuk memformat angka ke format Rupiah
        function formatRupiah(angka) {
            return new Intl.NumberFormat('id-ID', {
                style: 'decimal',
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            }).format(angka);
        }

        // Fungsi untuk menghitung ulang total
        function recalculateTotal() {
            // Jika form readonly, tidak perlu menghitung ulang
            if (isFormReadonly) return;

            let subtotalProducts = 0;

            // Loop semua item untuk menghitung subtotal produk
            $('.item-qty').each(function() {
                let price = parseFloat($(this).data('price')) || 0;
                let qty = parseFloat($(this).val()) || 0;
                let subtotal = price * qty;

                // Update subtotal item ini
                $(this).closest('tr').find('.item-subtotal').text('Rp ' + formatRupiah(subtotal));

                // Tambahkan ke subtotal produk
                subtotalProducts += subtotal;
            });

            // Update subtotal produk di footer tabel
            $('#subtotal-products').text('Rp ' + formatRupiah(subtotalProducts));

            // Ambil nilai ongkir
            let shippingCost = parseFloat($('#shipping-cost').val()) || 0;

            // Update tampilan ongkir
            $('#shipping-cost-display').text('Rp ' + formatRupiah(shippingCost));

            // Hitung grand total (subtotal produk + ongkir)
            let grandTotal = subtotalProducts + shippingCost;

            // Update grand total di footer tabel
            $('#grand-total').text('Rp ' + formatRupiah(grandTotal));

            // Update hidden input untuk form submission
            $('#total_price').val(grandTotal);

            // Hitung total qty untuk hidden input
            let totalQty = 0;
            $('.item-qty').each(function() {
                totalQty += parseFloat($(this).val()) || 0;
            });
            $('#qty').val(totalQty);
        }

        // Hanya tambahkan event listener jika form tidak readonly
        if (!isFormReadonly) {
            // Event listener untuk perubahan qty
            $('.item-qty').on('input', function() {
                recalculateTotal();
            });

            // Event listener untuk radio button ongkir
            $('input[name="shipping_option"]').on('change', function() {
                if ($(this).val() === 'yes') {
                    $('#shipping-cost-container').show();
                } else {
                    $('#shipping-cost-container').hide();
                    $('#shipping-cost').val(0);
                }
                recalculateTotal();
            });

            // Event listener untuk perubahan nilai ongkir
            $('#shipping-cost').on('input', function() {
                recalculateTotal();
            });
        }
    });
</script>
<script>
    $(document).ready(function() {
        // Cek apakah form dalam mode readonly
        const isFormReadonly = $('form').hasClass('form-readonly');

        // Hanya tambahkan event listener jika form tidak readonly
        if (!isFormReadonly) {
            $('#btn-cancel').on('click', function() {
                const id = $(this).data('id');

                Swal.fire({
                    title: 'Batalkan pesanan?',
                    text: "Pesanan akan ditandai sebagai dibatalkan dan tidak dapat diubah kembali.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, batalkan!',
                    cancelButtonText: 'Tidak'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '<?= base_url("selling/cancel/") ?>' + id;
                    }
                });
            });

            $('#btn-submit').on('click', function(e) {
                e.preventDefault(); // Cegah form langsung submit

                Swal.fire({
                    title: 'Yakin ingin memproses order ini?',
                    text: "Pastikan semua data sudah benar.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, proses!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Submit form manual kalau user konfirmasi
                        $(this).closest('form').submit();
                    }
                });
            });
        } else {
            // Jika form readonly, sembunyikan tombol cancel
            $('#btn-cancel').hide();
        }
    });
</script>
<script>
    $('#btn-print').on('click', function() {
        var id = $(this).data('id');
        window.open('<?= base_url("selling/print_nota/") ?>' + id, '_blank');
    });
</script>