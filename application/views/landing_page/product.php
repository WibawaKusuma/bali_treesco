<style>
  .menu-item {
    padding: 15px;
    border-radius: 10px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease-in-out;
    background: #fff;
  }

  /* HOVER HANYA UNTUK GAMBAR */
  .menu-img {
    transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
  }

  .menu-img:hover {
    transform: scale(1.1);
    box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.3);
  }

  button {
    float: right;

  }
</style>
<!-- Load SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<!-- Menu Section -->
<!-- <section id="menu" class="menu section"> -->

<!-- Section Title -->
<div class="container section-title" data-aos="fade-up">
  <h2>Produk Kami</h2>
  <p><span>Cek</span> <span class="description-title">Produk Kami</span></p>
</div><!-- End Section Title -->

<div class="container" style="margin-bottom: 10%;">

  <!-- <ul class="nav nav-tabs d-flex justify-content-center" data-aos="fade-up" data-aos-delay="100">
    <li class="nav-item">
      <a class="nav-link active show" data-bs-toggle="tab" data-bs-target="#menu-starters">
        <h4>Starters</h4>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="tab" data-bs-target="#menu-breakfast">
        <h4>Breakfast</h4>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="tab" data-bs-target="#menu-lunch">
        <h4>Lunch</h4>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="tab" data-bs-target="#menu-dinner">
        <h4>Dinner</h4>
      </a>
    </li>
  </ul> -->

  <?php if ($this->session->flashdata('success')) : ?>
    <script>
      Swal.fire({
        title: 'Success!',
        text: '<?= $this->session->flashdata('success'); ?>',
        icon: 'success',
        confirmButtonText: 'OK'
      });
    </script>
  <?php endif; ?>

  <?php if ($this->session->flashdata('error')) : ?>
    <script>
      Swal.fire({
        title: 'Error!',
        text: '<?= $this->session->flashdata('error'); ?>',
        icon: 'error',
        confirmButtonText: 'OK'
      });
    </script>
  <?php endif; ?>



  <div class="tab-content" data-aos="fade-up" data-aos-delay="200">
    <!-- <div class="tab-pane fade active show" id="menu-starters">
      <div class="row gy-5" style="display:flex;justify-content:center;">
        <?php foreach ($detail as $k) : ?>
          <?php if ($k->status == 1) { ?>
            <div class="col-lg-3 menu-item" style="margin: 2%;">
              <a href="<?= base_url('assets/img/menu/coconut-milk2.jpg') ?>" class="glightbox">
                <img src="<?= base_url('assets/img/menu/coconut-milk2.jpg') ?>" class="menu-img img-fluid" alt="">
              </a>
              <hr>
              <h4><?= $k->name ?></h4>
              <p class="ingredients"> <i><?= $k->description ?></i> </p>
              <p class="price"> Rp.<?= $k->price ?> </p>
              <a href="https://wa.me/+6289690000509" target="_blank" class="btn btn-sm btn-success col-sm-12">
                Beli
              </a>
            </div>
          <?php } ?>
        <?php endforeach; ?>
      </div>
    </div> -->
    <div class="tab-pane fade active show" id="menu-starters">
      <div class="row gy-5" style="display:flex;justify-content:center;">
        <?php foreach ($detail as $k) : ?>
          <?php if ($k->status == 1) { ?>
            <div class="col-lg-2 menu-item" style="margin: 2%;">
              <a href="<?= base_url('assets/img/product/' . $k->image) ?>" class="glightbox">
                <img src="<?= base_url('assets/img/product/'  . $k->image) ?>" class="menu-img img-fluid" alt="">
              </a>
              <hr>
              <h4><?= $k->name ?></h4>
              <p class="ingredients"> <i><?= $k->description ?></i> </p>
              <p class="price"> Rp. <?= number_format($k->price, 0, ',', '.') ?> </p>

              <!-- Input untuk jumlah pesanan -->
              <form id="orderForm" action="<?= base_url('landing/process') ?>" method="post" class="d-flex justify-content-between align-items-center">
                <input type="hidden" name="id" value="<?= $k->id_product ?>">
                <input type="hidden" name="name" value="<?= $k->name ?>">
                <input type="hidden" name="price" value="<?= $k->price ?>">

                <!-- Input untuk menentukan jumlah -->
                <input type="number" name="qty" id="qty" class="form-control text-center" placeholder="Qty" min="1" value="1" style="margin-right: 10px;">

                <!-- Tombol Order -->
                <button type="button" class="btn btn-sm btn-success order-btn" data-name="<?= $k->name ?>" data-price="<?= $k->price ?>" data-qty="1">
                  Order
                </button>
              </form>
            </div>

          <?php } ?>
        <?php endforeach; ?>
      </div>
    </div>


    <!-- End Starter Menu Content -->

    <!-- <div class="tab-pane fade" id="menu-breakfast">
      <div class="tab-header text-center">
        <p>Menu</p>
        <h3>Breakfast</h3>
      </div>
      <div class="row gy-5">

        <div class="col-lg-4 menu-item">
          <a href="<?= base_url('assets/img/menu/menu-item-1.png') ?>" class="glightbox"><img src="<?= base_url('assets/img/menu/menu-item-1.png') ?>" class="menu-img img-fluid" alt=""></a>
          <h4>Magnam Tiste</h4>
          <p class="ingredients">
            Lorem, deren, trataro, filede, nerada
          </p>
          <p class="price">
            $5.95
          </p>
        </div>
      </div>
    </div> -->

    <!-- <div class="tab-pane fade" id="menu-lunch">
      <div class="tab-header text-center">
        <p>Menu</p>
        <h3>Lunch</h3>
      </div>
      <div class="row gy-5">

        <div class="col-lg-4 menu-item">
          <a href="<?= base_url('assets/img/menu/menu-item-1.png') ?>" class="glightbox"><img src="<?= base_url('assets/img/menu/menu-item-1.png') ?>" class="menu-img img-fluid" alt=""></a>
          <h4>Magnam Tiste</h4>
          <p class="ingredients">
            Lorem, deren, trataro, filede, nerada
          </p>
          <p class="price">
            $5.95
          </p>
        </div>
      </div>
    </div> -->

    <!-- <div class="tab-pane fade" id="menu-dinner">
      <div class="tab-header text-center">
        <p>Menu</p>
        <h3>Dinner</h3>
      </div>
      <div class="row gy-5">
        <div class="col-lg-4 menu-item">
          <a href="<?= base_url('assets/img/menu/menu-item-1.png') ?>" class="glightbox"><img src="<?= base_url('assets/img/menu/menu-item-1.png') ?>" class="menu-img img-fluid" alt=""></a>
          <h4>Magnam Tiste</h4>
          <p class="ingredients">
            Lorem, deren, trataro, filede, nerada
          </p>
          <p class="price">
            $5.95
          </p>
        </div>
      </div>
    </div> -->
  </div>

  <!-- Modal Konfirmasi Pembelian -->
  <!-- Modal Konfirmasi Pembelian -->
  <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="confirmModalLabel">Konfirmasi Pembelian</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p><strong>Nama Produk:</strong> <span id="productName"></span></p>
          <p><strong>Harga:</strong> Rp. <span id="productPrice"></span></p>
          <p><strong>Jumlah:</strong> <span id="productQty"></span></p>
          <p><strong>Total Harga:</strong> Rp. <span id="totalPrice"></span></p>

          <!-- Input Nama dan Nomor HP -->
          <div class="mb-3">
            <label for="customerName" class="form-label">Nama Pembeli</label>
            <input type="text" class="form-control" id="customerName" placeholder="Masukkan Nama" required>
          </div>
          <div class="mb-3">
            <label for="customerPhone" class="form-label">Nomor HP</label>
            <input type="text" class="form-control" id="customerPhone" placeholder="Masukkan Nomor HP" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="button" class="btn btn-primary" id="confirmOrder">Konfirmasi</button>
        </div>
      </div>
    </div>
  </div>




</div>
<script>
  // Saat tombol Order diklik
  // Saat tombol Order diklik
  document.querySelectorAll('.order-btn').forEach(function(btn) {
    btn.addEventListener('click', function() {
      var productName = this.getAttribute('data-name');
      var productPrice = this.getAttribute('data-price');
      var productQty = document.getElementById('qty').value;
      var totalPrice = productPrice * productQty;

      // Tampilkan data produk dan total harga di modal
      document.getElementById('productName').innerText = productName;
      document.getElementById('productPrice').innerText = productPrice;
      document.getElementById('productQty').innerText = productQty;
      document.getElementById('totalPrice').innerText = totalPrice;

      // Tampilkan modal konfirmasi
      var confirmModal = new bootstrap.Modal(document.getElementById('confirmModal'));
      confirmModal.show();

      // Ketika tombol Konfirmasi di modal diklik
      document.getElementById('confirmOrder').addEventListener('click', function() {
        var customerName = document.getElementById('customerName').value;
        var customerPhone = document.getElementById('customerPhone').value;

        if (!customerName || !customerPhone) {
          Swal.fire({
            title: 'Error!',
            text: 'Nama dan nomor HP harus diisi.',
            icon: 'error',
            confirmButtonText: 'OK'
          });
          return;
        }

        // Kirim data ke server dengan AJAX
        var formData = new FormData();
        formData.append('id', btn.getAttribute('data-id'));
        formData.append('name', productName);
        formData.append('price', productPrice);
        formData.append('qty', productQty);
        formData.append('customer_name', customerName);
        formData.append('customer_phone', customerPhone);

        // AJAX Request
        fetch('<?= base_url('landing/process') ?>', {
            method: 'POST',
            body: formData
          })
          .then(response => response.json())
          .then(data => {
            // Tampilkan SweetAlert sesuai dengan status respon
            if (data.status === 'success') {
              Swal.fire({
                title: 'Success!',
                text: data.message,
                icon: 'success',
                confirmButtonText: 'OK'
              }).then(function() {
                // Arahkan ke halaman lain setelah konfirmasi
                window.location.href = '<?= base_url('landing/product') ?>';
              });
            } else {
              Swal.fire({
                title: 'Error!',
                text: data.message,
                icon: 'error',
                confirmButtonText: 'OK'
              });
            }
          })
          .catch(error => {
            Swal.fire({
              title: 'Error!',
              text: 'Terjadi kesalahan saat mengirim data.',
              icon: 'error',
              confirmButtonText: 'OK'
            });
          });
      });
    });
  });
</script>



<!-- </section> -->
<!-- /Menu Section -->