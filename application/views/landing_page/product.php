<style>
  .menu-item {
    padding: 15px;
    border-radius: 10px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease-in-out;
    background: #fff;
  }

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

  .konfirmasi {
    font-family: 'roboto';
  }

  @media (max-width: 768px) {
    .menu-item {
      margin: 10px auto;
      width: 90%;
    }

    .menu-img {
      width: 100%;
      height: auto;
    }

    .menu-item h5,
    .menu-item p {
      text-align: center;
    }

    form.d-flex {
      flex-direction: row;
      /* Menyusun elemen secara horizontal */
      justify-content: space-between;
      /* Memberikan jarak di antara elemen */
      align-items: center;
      /* Menjaga elemen tetap terjajar di tengah */
      width: 100%;
      /* Pastikan form memenuhi lebar */
    }

    /* Mengatur input qty dan button agar memiliki lebar 48% dan bersebelahan */
    form.d-flex input[name="qty"],
    form.d-flex button {
      width: 48%;
      /* Lebar masing-masing 48% */
    }
  }
</style>
<!-- Load SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Section Title -->
<div class="container section-title" data-aos="fade-up">
  <!-- <h2>Produk Kami</h2> -->
  <p style="color: #198754;"><span class="description-title" style="color: #198754;">Produk Kami</span></p>
</div><!-- End Section Title -->

<div class="container" style="margin-bottom: 10%;">
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
              <h5 style="font-family: calibri !important;"><?= $k->name ?></h5>
              <p class="ingredients" style="font-size: small;"><?= $k->description ?> </p>
              <p class="price"> Rp. <?= number_format($k->price, 0, ',', '.') ?> </p>

              <!-- Input untuk jumlah pesanan -->
              <form id="orderForm" action="<?= base_url('landing/process') ?>" method="post" class="d-flex justify-content-between align-items-center">
                <input type="hidden" name="id" value="<?= $k->id_product ?>">
                <input type="hidden" name="name" value="<?= $k->name ?>">
                <input type="hidden" name="price" value="<?= $k->price ?>">

                <!-- Input untuk menentukan jumlah -->
                <!-- <input type="number" name="qty" id="qty" class="form-control text-center" placeholder="Qty" min="1" value="1" style="margin-right: 10px;"> -->
                <input type="number" name="qty" class="form-control text-center" placeholder="Qty" min="1" value="1" style="margin-right: 10px;">


                <!-- Tombol Order -->
                <button type="button" class="btn btn-sm btn-success add-to-cart-btn"
                  data-id="<?= $k->id_product ?>"
                  data-name="<?= $k->name ?>"
                  data-price="<?= $k->price ?>">
                  <i class="bi bi-cart-plus"></i> Masuk Keranjang
                </button>

              </form>
            </div>
          <?php } ?>
        <?php endforeach; ?>
      </div>
    </div>
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






</div>
<script>
  // Saat tombol Tambah ke Keranjang diklik
  document.querySelectorAll('.add-to-cart-btn').forEach(function(btn) {
    btn.addEventListener('click', function() {
      var id_product = this.getAttribute('data-id');
      var productName = this.getAttribute('data-name');
      var productQty = this.closest('form').querySelector('input[name="qty"]').value;

      // Kirim data ke server untuk cek login terlebih dahulu
      var formData = new FormData();
      formData.append('id', id_product);
      formData.append('qty', productQty);

      // AJAX Request
      fetch('<?= base_url('landing/process') ?>', {
          method: 'POST',
          body: formData
        })
        .then(response => response.json())
        .then(data => {
          if (data.status === 'confirm_order') {
            // Jika sudah login, tampilkan konfirmasi pemesanan
            Swal.fire({
              title: 'Konfirmasi Pesanan',
              html: `Apakah Anda hendak memesan <strong>${data.product_name}</strong> dengan jumlah <strong>${data.qty}</strong>?`,
              icon: 'question',
              showCancelButton: true,
              confirmButtonColor: '#198754',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Ya, Tambahkan ke Keranjang',
              cancelButtonText: 'Batal'
            }).then((result) => {
              if (result.isConfirmed) {
                // Jika user mengkonfirmasi, lanjutkan proses tambah ke keranjang
                var cartFormData = new FormData();
                cartFormData.append('id', data.product_id);
                cartFormData.append('qty', data.qty);

                fetch('<?= base_url('landing/add_to_cart') ?>', {
                    method: 'POST',
                    body: cartFormData
                  })
                  .then(response => response.json())
                  .then(cartData => {
                    if (cartData.status === 'success') {
                      Swal.fire({
                        title: 'Berhasil!',
                        html: cartData.message,
                        icon: 'success',
                        confirmButtonText: 'OK'
                      }).then(() => {
                        // Refresh halaman untuk memperbarui tampilan keranjang
                        location.reload();
                      });
                    } else {
                      Swal.fire({
                        title: 'Error!',
                        text: cartData.message,
                        icon: 'error',
                        confirmButtonText: 'OK'
                      });
                    }
                  });
              }
            });
          } else if (data.status === 'login_required') {
            // Jika belum login, redirect ke halaman login
            window.location.href = '<?= base_url('customer/login') ?>';
          } else if (data.status === 'success') {
            // Jika langsung berhasil tambah ke keranjang (tidak seharusnya terjadi dengan alur baru)
            Swal.fire({
              title: 'Berhasil!',
              html: data.message,
              icon: 'success',
              confirmButtonText: 'OK'
            }).then(() => {
              // Refresh halaman untuk memperbarui tampilan keranjang
              location.reload();
            });
          } else {
            // Jika ada error lain
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
</script>



<!-- CSS untuk modal di tengah -->
<style>
  /* CSS untuk memastikan modal berada di tengah layar */
  .modal-dialog-centered {
    display: flex;
    align-items: center;
    min-height: calc(100% - 1rem);
  }

  /* Animasi untuk modal */
  .modal.fade .modal-dialog.modal-dialog-centered {
    transform: translate(0, -50px);
    transition: transform 0.3s ease-out;
  }

  .modal.show .modal-dialog.modal-dialog-centered {
    transform: translate(0, 0);
  }

  /* Styling tambahan untuk modal */
  #loginRegisterModal .modal-content {
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    border: none;
  }

  #loginRegisterModal .modal-header {
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
  }

  /* Responsif untuk layar kecil */
  @media (max-width: 576px) {
    #loginRegisterModal .modal-dialog {
      margin: 0.5rem;
      max-width: calc(100% - 1rem);
    }
  }
</style>

<!-- Modal Login dan Register -->
<div class="modal fade" id="loginRegisterModal" tabindex="-1" aria-labelledby="loginRegisterModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title" id="loginRegisterModalLabel">Login untuk Melanjutkan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Hidden fields untuk menyimpan data produk sementara -->
        <input type="hidden" id="temp_product_id">
        <input type="hidden" id="temp_product_qty">

        <div class="tab-content" id="loginRegisterTabContent">
          <!-- Tab Login -->
          <div class="tab-pane fade show active" id="login-tab-pane" role="tabpanel" aria-labelledby="login-tab" tabindex="0">
            <div class="p-3">
              <div id="login-alert" class="alert alert-danger" style="display: none;"></div>
              <form id="loginForm">
                <div class="mb-3">
                  <label for="login-email" class="form-label">Email</label>
                  <input type="email" class="form-control" id="login-email" name="email" required>
                </div>
                <div class="mb-3">
                  <label for="login-password" class="form-label">Password</label>
                  <input type="password" class="form-control" id="login-password" name="password" required>
                </div>
                <button type="submit" class="btn btn-success w-100 mb-3">Login</button>

                <div class="text-center mt-3">
                  <p>Belum punya akun? <a href="#" id="show-register" class="text-success">Registrasi sekarang</a></p>
                </div>
              </form>
            </div>
          </div>

          <!-- Tab Register -->
          <div class="tab-pane fade" id="register-tab-pane" role="tabpanel" aria-labelledby="register-tab" tabindex="0">
            <div class="p-3">
              <div id="register-alert" class="alert alert-danger" style="display: none;"></div>
              <form id="registerForm">
                <div class="mb-3">
                  <label for="register-name" class="form-label">Nama Lengkap</label>
                  <input type="text" class="form-control" id="register-name" name="name" required>
                </div>
                <div class="mb-3">
                  <label for="register-email" class="form-label">Email</label>
                  <input type="email" class="form-control" id="register-email" name="email" required>
                </div>
                <div class="mb-3">
                  <label for="register-password" class="form-label">Password</label>
                  <input type="password" class="form-control" id="register-password" name="password" required>
                </div>
                <div class="mb-3">
                  <label for="register-confirm-password" class="form-label">Konfirmasi Password</label>
                  <input type="password" class="form-control" id="register-confirm-password" name="confirm_password" required>
                </div>
                <div class="mb-3">
                  <label for="register-phone" class="form-label">Nomor Telepon</label>
                  <input type="text" class="form-control" id="register-phone" name="phone" required>
                </div>
                <div class="mb-3">
                  <label for="register-address" class="form-label">Alamat</label>
                  <textarea class="form-control" id="register-address" name="address" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-success w-100 mb-3">Register</button>

                <div class="text-center mt-3">
                  <p>Sudah punya akun? <a href="#" id="show-login" class="text-success">Login disini</a></p>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  // Tombol untuk beralih ke form register
  $('#show-register').on('click', function(e) {
    e.preventDefault();
    $('#login-tab-pane').removeClass('show active');
    $('#register-tab-pane').addClass('show active');
    $('#loginRegisterModalLabel').text('Registrasi Akun Baru');
  });

  // Tombol untuk beralih ke form login
  $('#show-login').on('click', function(e) {
    e.preventDefault();
    $('#register-tab-pane').removeClass('show active');
    $('#login-tab-pane').addClass('show active');
    $('#loginRegisterModalLabel').text('Login untuk Melanjutkan');
  });

  // Reset modal saat ditutup
  $('#loginRegisterModal').on('hidden.bs.modal', function() {
    $('#login-tab-pane').addClass('show active');
    $('#register-tab-pane').removeClass('show active');
    $('#loginRegisterModalLabel').text('Login untuk Melanjutkan');
    $('#login-alert, #register-alert').hide();
    $('#loginForm, #registerForm')[0].reset();
  });

  // Pastikan modal selalu berada di tengah saat ditampilkan
  $('#loginRegisterModal').on('show.bs.modal', function() {
    $(this).css('display', 'block');
    var modalDialog = $(this).find('.modal-dialog');
    // Hitung posisi tengah
    modalDialog.css({
      'margin-top': Math.max(0, ($(window).height() - modalDialog.height()) / 2)
    });
  });

  // Reposisi modal saat window di-resize
  $(window).resize(function() {
    if ($('#loginRegisterModal').hasClass('show')) {
      var modalDialog = $('#loginRegisterModal').find('.modal-dialog');
      modalDialog.css({
        'margin-top': Math.max(0, ($(window).height() - modalDialog.height()) / 2)
      });
    }
  });

  // Login Form Submit
  $('#loginForm').on('submit', function(e) {
    e.preventDefault();

    var email = $('#login-email').val();
    var password = $('#login-password').val();

    // AJAX untuk login
    $.ajax({
      url: '<?= base_url('customer/ajax_login') ?>',
      type: 'POST',
      data: {
        email: email,
        password: password
      },
      dataType: 'json',
      success: function(response) {
        if (response.status === 'success') {
          // Login berhasil
          $('#loginRegisterModal').modal('hide');

          // Ambil data produk yang disimpan
          var id_product = $('#temp_product_id').val();
          var qty = $('#temp_product_qty').val();

          // Dapatkan nama produk
          $.ajax({
            url: '<?= base_url('landing/get_product_name') ?>',
            type: 'POST',
            data: {
              id_product: id_product
            },
            dataType: 'json',
            success: function(response) {
              var productName = response.product_name || 'Produk';

              // Tampilkan konfirmasi terlebih dahulu
              Swal.fire({
                title: 'Konfirmasi Pesanan',
                html: `Apakah Anda hendak memesan <strong>${productName}</strong> dengan jumlah <strong>${qty}</strong>?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#198754',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Tambahkan ke Keranjang',
                cancelButtonText: 'Batal'
              }).then((result) => {
                if (result.isConfirmed) {
                  // Kirim data produk ke keranjang
                  var formData = new FormData();
                  formData.append('id', id_product);
                  formData.append('qty', qty);

                  fetch('<?= base_url('landing/process') ?>', {
                      method: 'POST',
                      body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                      if (data.status === 'success') {
                        Swal.fire({
                          title: 'Berhasil!',
                          html: data.message,
                          icon: 'success',
                          confirmButtonText: 'OK'
                        }).then(() => {
                          location.reload();
                        });
                      } else {
                        Swal.fire({
                          title: 'Error!',
                          text: data.message,
                          icon: 'error',
                          confirmButtonText: 'OK'
                        });
                      }
                    });
                }
              });
            },
            error: function() {
              // Jika gagal mendapatkan nama produk, gunakan nama generik
              var productName = 'Produk';

              // Tampilkan konfirmasi terlebih dahulu
              Swal.fire({
                title: 'Konfirmasi Pesanan',
                html: `Apakah Anda hendak memesan <strong>${productName}</strong> dengan jumlah <strong>${qty}</strong>?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#198754',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Tambahkan ke Keranjang',
                cancelButtonText: 'Batal'
              }).then((result) => {
                if (result.isConfirmed) {
                  // Kirim data produk ke keranjang
                  var formData = new FormData();
                  formData.append('id', id_product);
                  formData.append('qty', qty);

                  fetch('<?= base_url('landing/process') ?>', {
                      method: 'POST',
                      body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                      if (data.status === 'success') {
                        Swal.fire({
                          title: 'Berhasil!',
                          html: data.message,
                          icon: 'success',
                          confirmButtonText: 'OK'
                        }).then(() => {
                          location.reload();
                        });
                      } else {
                        Swal.fire({
                          title: 'Error!',
                          text: data.message,
                          icon: 'error',
                          confirmButtonText: 'OK'
                        });
                      }
                    });
                }
              });
            }
          });
        } else {
          // Login gagal
          $('#login-alert').html(response.message).show();
        }
      },
      error: function() {
        $('#login-alert').html('Terjadi kesalahan saat login. Silakan coba lagi.').show();
      }
    });
  });

  // Register Form Submit
  $('#registerForm').on('submit', function(e) {
    e.preventDefault();

    var name = $('#register-name').val();
    var email = $('#register-email').val();
    var password = $('#register-password').val();
    var confirm_password = $('#register-confirm-password').val();
    var phone = $('#register-phone').val();
    var address = $('#register-address').val();

    // Validasi password
    if (password !== confirm_password) {
      $('#register-alert').html('Password dan konfirmasi password tidak sama').show();
      return;
    }

    // AJAX untuk register
    $.ajax({
      url: '<?= base_url('customer/ajax_register') ?>',
      type: 'POST',
      data: {
        name: name,
        email: email,
        password: password,
        confirm_password: confirm_password,
        phone: phone,
        address: address
      },
      dataType: 'json',
      success: function(response) {
        if (response.status === 'success') {
          // Register berhasil, otomatis login
          $.ajax({
            url: '<?= base_url('customer/ajax_login') ?>',
            type: 'POST',
            data: {
              email: email,
              password: password
            },
            dataType: 'json',
            success: function(loginResponse) {
              if (loginResponse.status === 'success') {
                // Login berhasil
                $('#loginRegisterModal').modal('hide');

                // Ambil data produk yang disimpan
                var id_product = $('#temp_product_id').val();
                var qty = $('#temp_product_qty').val();

                // Dapatkan nama produk
                $.ajax({
                  url: '<?= base_url('landing/get_product_name') ?>',
                  type: 'POST',
                  data: {
                    id_product: id_product
                  },
                  dataType: 'json',
                  success: function(response) {
                    var productName = response.product_name || 'Produk';

                    // Tampilkan konfirmasi terlebih dahulu
                    Swal.fire({
                      title: 'Konfirmasi Pesanan',
                      html: `Apakah Anda hendak memesan <strong>${productName}</strong> dengan jumlah <strong>${qty}</strong>?`,
                      icon: 'question',
                      showCancelButton: true,
                      confirmButtonColor: '#198754',
                      cancelButtonColor: '#d33',
                      confirmButtonText: 'Ya, Tambahkan ke Keranjang',
                      cancelButtonText: 'Batal'
                    }).then((result) => {
                      if (result.isConfirmed) {
                        // Kirim data produk ke keranjang
                        var formData = new FormData();
                        formData.append('id', id_product);
                        formData.append('qty', qty);

                        fetch('<?= base_url('landing/process') ?>', {
                            method: 'POST',
                            body: formData
                          })
                          .then(response => response.json())
                          .then(data => {
                            if (data.status === 'success') {
                              Swal.fire({
                                title: 'Berhasil!',
                                html: data.message,
                                icon: 'success',
                                confirmButtonText: 'OK'
                              }).then(() => {
                                location.reload();
                              });
                            } else {
                              Swal.fire({
                                title: 'Error!',
                                text: data.message,
                                icon: 'error',
                                confirmButtonText: 'OK'
                              });
                            }
                          });
                      }
                    });
                  },
                  error: function() {
                    // Jika gagal mendapatkan nama produk, gunakan nama generik
                    var productName = 'Produk';

                    // Tampilkan konfirmasi terlebih dahulu
                    Swal.fire({
                      title: 'Konfirmasi Pesanan',
                      html: `Apakah Anda hendak memesan <strong>${productName}</strong> dengan jumlah <strong>${qty}</strong>?`,
                      icon: 'question',
                      showCancelButton: true,
                      confirmButtonColor: '#198754',
                      cancelButtonColor: '#d33',
                      confirmButtonText: 'Ya, Tambahkan ke Keranjang',
                      cancelButtonText: 'Batal'
                    }).then((result) => {
                      if (result.isConfirmed) {
                        // Kirim data produk ke keranjang
                        var formData = new FormData();
                        formData.append('id', id_product);
                        formData.append('qty', qty);

                        fetch('<?= base_url('landing/process') ?>', {
                            method: 'POST',
                            body: formData
                          })
                          .then(response => response.json())
                          .then(data => {
                            if (data.status === 'success') {
                              Swal.fire({
                                title: 'Berhasil!',
                                html: data.message,
                                icon: 'success',
                                confirmButtonText: 'OK'
                              }).then(() => {
                                location.reload();
                              });
                            } else {
                              Swal.fire({
                                title: 'Error!',
                                text: data.message,
                                icon: 'error',
                                confirmButtonText: 'OK'
                              });
                            }
                          });
                      }
                    });
                  }
                });
              } else {
                // Login gagal setelah register
                Swal.fire({
                  title: 'Registrasi Berhasil!',
                  text: 'Silakan login dengan akun baru Anda',
                  icon: 'success',
                  confirmButtonText: 'OK'
                }).then(() => {
                  // Pindah ke tab login
                  $('#login-tab').tab('show');
                });
              }
            }
          });
        } else {
          // Register gagal
          $('#register-alert').html(response.message).show();
        }
      },
      error: function() {
        $('#register-alert').html('Terjadi kesalahan saat registrasi. Silakan coba lagi.').show();
      }
    });
  });
</script>

<!-- </section> -->
<!-- /Menu Section -->