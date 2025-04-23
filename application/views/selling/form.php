<div class="container" style="max-width: 1000px;">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white text-center">
            <h4 class="mb-0"><?= !empty($selling) ? 'Proses Selling' : 'Create Selling' ?></h4>
        </div>
        <div class="card-body">
            <form action="<?= !empty($selling) ? base_url('selling/update/' . $selling->id_selling) : base_url('selling/create_selling') ?>" method="post" enctype="multipart/form-data">

                <!-- Input ID (Hidden) -->
                <input type="hidden" name="p[id_selling]" value="<?= !empty($selling) ? $selling->id_selling : '' ?>">

                <div class="row">
                    <div class="col-lg-6">
                        <!-- Input Nama -->
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
                                <input type="text" id="created_at" name="p[created_at]" value="<?= !empty($selling) ? date('d M Y', strtotime($selling->created_at)) : '' ?>" class="form-control" required disabled>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-6">
                        <!-- Input Nama -->
                        <div class="form-group row">
                            <label for="name" class="col-12 col-sm-3 col-form-label">Nama</label>
                            <div class="col-12 col-sm-9">
                                <input type="text" id="name" name="p[name]" value="<?= !empty($selling) ? $selling->name : '' ?>" class="form-control" required disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="price" class="col-12 col-sm-3 col-form-label">Harga satuan</label>
                            <div class="col-12 col-sm-9">
                                <input type="text" id="price" name="p[price]" value="<?= !empty($selling) ? $selling->price : '' ?>" class="form-control" required disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="qty" class="col-12 col-sm-3 col-form-label">Qty</label>
                            <div class="col-12 col-sm-9">
                                <input type="text" id="qty" name="p[qty]" value="<?= !empty($selling) ? $selling->qty : '' ?>" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="total_price" class="col-12 col-sm-3 col-form-label">Total</label>
                            <div class="col-12 col-sm-9">
                                <input type="text" id="total_price" name="p[total_price]" value="<?= !empty($selling) ? $selling->total_price : '' ?>" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="status" class="col-12 col-sm-3 col-form-label">Status</label>
                            <div class="col-12 col-sm-9">
                                <?php
                                $status = isset($selling->status) ? $selling->status : null;
                                $batal = isset($selling->batal) ? $selling->batal : null;

                                if ($status == 1 && $batal == 0) {
                                    $status_text = 'Sudah Realisasi';
                                    $status_class = 'badge badge-success';
                                } elseif ($status == 0 && $batal == 0) {
                                    $status_text = 'Belum Realisasi';
                                    $status_class = 'badge badge-warning text-white';
                                } else {
                                    $status_text = 'Order Batal';
                                    $status_class = 'badge badge-danger';
                                }
                                ?>
                                <div class="p-2 <?= $status_class ?>" style="font-size: 1rem;">
                                    <?= $status_text ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tombol -->
                <hr>
                <div class="text-right">
                    <!-- <a href="<?= base_url('selling/cancel/' . $selling->id_selling) ?>" class="btn btn-sm btn-secondary" onclick="return confirm('Yakin ingin membatalkan transaksi ini?');">
                        <i class="fa fa-times"></i> Batal
                    </a> -->
                    <!-- Tombol batal -->
                    <!-- <button type="submit" class="btn btn-sm btn-success"> <i class="fa fa-save"></i> Proses</button> -->
                    <?php if (empty($selling) || ($selling->status != 1 && $selling->batal != 1)): ?>
                        <button type="button" class="btn btn-sm btn-danger" id="btn-cancel" data-id="<?= $selling->id_selling ?>">
                            <i class="fa fa-times"></i> Batal
                        </button>
                        <button type="submit" class="btn btn-sm btn-success" id="btn-submit">
                            <i class="fa fa-save"></i> Proses
                        </button>
                    <?php endif; ?>

                    <?php if (
                        empty($selling) ||
                        ($selling->status == 1 && $selling->batal == 0) ||
                        ($selling->status == 0 && $selling->batal == 1)
                    ): ?>
                        <button
                            type="button"
                            class="btn btn-sm btn-primary"
                            onclick="window.open('<?= site_url('selling/print_nota/' . $selling->id_selling) ?>', '_blank')">
                            <i class="fa fa-file"></i> Print
                        </button>
                    <?php endif; ?>



                    <a href="<?= base_url('selling') ?>" class="btn btn-sm btn-secondary"><i class="fa fa-arrow-left"></i> Back</a>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        $('#qty').on('input', function() {
            // Ambil nilai dan pastikan jadi angka
            let price = parseFloat($('#price').val().replace(/[^0-9.-]/g, '')) || 0;
            let qty = parseFloat($('#qty').val()) || 0;
            let total = price * qty;

            // Tampilkan hasil ke kolom total
            // $('#total_price').val(total.toLocaleString('id-ID'));
            $('#total_price').val(total);

        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#btn-cancel').on('click', function() {
            const id = $(this).data('id');

            Swal.fire({
                title: 'Batalkan transaksi?',
                text: "Transaksi akan ditandai sebagai dibatalkan.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, batalkan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '<?= base_url("selling/cancel/") ?>' + id;
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function() {
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
    });
</script>
<script>
    $('#btn-print').on('click', function() {
        var id = $(this).data('id');
        window.open('<?= base_url("selling/print_nota/") ?>' + id, '_blank');
    });
</script>