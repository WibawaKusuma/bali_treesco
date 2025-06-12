<style>
  .contact .info-item {
    background: #ffffff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 5px 25px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
    height: 100%;
    border: 1px solid rgba(119, 189, 39, 0.1);
  }

  .contact .info-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
    border-color: #77BD27;
  }

  .contact .info-item i {
    width: 60px;
    height: 60px;
    background: linear-gradient(45deg, #1D6300, #77BD27);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 24px;
    margin-right: 15px;
    transition: all 0.3s ease;
  }

  .contact .info-item:hover i {
    background: linear-gradient(45deg, #77BD27, #DAB914);
    transform: rotate(360deg);
  }

  .contact .info-item h3 {
    font-size: 20px;
    font-weight: 600;
    margin-bottom: 10px;
    color: #1D6300;
  }

  .contact .info-item p {
    margin: 0;
    font-size: 15px;
    color: #666;
  }

  .contact .php-email-form {
    background: #ffffff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 5px 25px rgba(0, 0, 0, 0.05);
    border: 1px solid rgba(119, 189, 39, 0.1);
  }

  .contact .php-email-form input,
  .contact .php-email-form textarea {
    border: 1px solid rgba(119, 189, 39, 0.2);
    border-radius: 5px;
    padding: 12px 15px;
    transition: all 0.3s ease;
  }

  .contact .php-email-form input:focus,
  .contact .php-email-form textarea:focus {
    border-color: #77BD27;
    box-shadow: 0 0 0 0.2rem rgba(119, 189, 39, 0.25);
  }

  .contact .php-email-form button {
    background: linear-gradient(45deg, #1D6300, #77BD27);
    border: none;
    padding: 12px 40px;
    color: #fff;
    border-radius: 50px;
    transition: all 0.3s ease;
  }

  .contact .php-email-form button:hover {
    background: linear-gradient(45deg, #77BD27, #DAB914);
    transform: translateY(-2px);
  }

  .contact iframe {
    border-radius: 10px;
    box-shadow: 0 5px 25px rgba(0, 0, 0, 0.05);
    border: 1px solid rgba(119, 189, 39, 0.1);
  }

  @media (max-width: 768px) {
    .section-title p {
      margin-bottom: 30px !important;
      font-size: 24px;
    }

    .contact .info-item {
      padding: 20px;
    }

    .contact .php-email-form {
      padding: 20px;
    }
  }
</style>

<!-- Contact Section -->
<section id="contact" class="contact section">
  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up" style="padding-top: 0%; margin-bottom: 1% !important;">
    <p><span style="color: #198754;">Perlu Bantuan?</span> <br> <span class="description-title" style="color: #198754;">Hubungi Kami</span></p>
  </div>

  <div class="container" data-aos="fade-up" data-aos-delay="100">
    <div class="mb-5" data-aos="zoom-in">
      <iframe style="width: 100%; height: 400px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3944.748216671673!2d115.20576007359595!3d-8.620153987593827!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd23f233522e0d5%3A0x31d8615b18e51493!2sJl.%20Lembusora%20No.20%2C%20Peguyangan%2C%20Kec.%20Denpasar%20Utara%2C%20Kota%20Denpasar%2C%20Bali%2080115!5e0!3m2!1sid!2sid!4v1744040079968!5m2!1sid!2sid" loading="lazy"></iframe>
    </div>

    <div class="row gy-4">
      <div class="col-md-6">
        <div class="info-item d-flex align-items-center" data-aos="fade-right" data-aos-delay="200">
          <i class="bi bi-geo-alt flex-shrink-0"></i>
          <div>
            <h3>Alamat</h3>
            <p><?= @$config['company_address'] ?></p>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="info-item d-flex align-items-center" data-aos="fade-left" data-aos-delay="300">
          <i class="bi bi-telephone flex-shrink-0"></i>
          <div>
            <h3>Telpon</h3>
            <p><?= @$config['company_phone'] ?></p>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="info-item d-flex align-items-center" data-aos="fade-right" data-aos-delay="400">
          <i class="bi bi-envelope flex-shrink-0"></i>
          <div>
            <h3>Email</h3>
            <p><?= @$config['company_email'] ?></p>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="info-item d-flex align-items-center" data-aos="fade-left" data-aos-delay="500">
          <i class="bi bi-clock flex-shrink-0"></i>
          <div>
            <h3>Jam Buka</h3>
            <p><strong>Sen-Sab:</strong> 11AM - 23PM; <strong>Minggu:</strong> Tutup</p>
          </div>
        </div>
      </div>
    </div>

    <form id="feedbackForm" class="php-email-form mt-4" data-aos="fade-up" data-aos-delay="600">
      <div class="row gy-4">
        <div class="col-md-6">
          <input type="text" name="name" class="form-control" placeholder="Nama Anda" required>
        </div>

        <div class="col-md-6">
          <input type="email" class="form-control" name="email" placeholder="Email Anda" required>
        </div>

        <div class="col-md-12">
          <input type="text" class="form-control" name="subject" placeholder="Subjek" required>
        </div>

        <div class="col-md-12">
          <textarea class="form-control" name="message" rows="6" placeholder="Pesan" required></textarea>
        </div>

        <div class="col-md-12 text-center">
          <div class="loading">Loading</div>
          <div class="error-message"></div>
          <div class="sent-message">Pesan Anda telah terkirim. Terima kasih!</div>
          <button type="submit" style="background-color: #198754; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;">Kirim Pesan</button>
        </div>
      </div>
    </form>
  </div>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    $("#feedbackForm").submit(function(e) {
      e.preventDefault();

      let name = $("input[name='name']").val().trim();
      let email = $("input[name='email']").val().trim();
      let subject = $("input[name='subject']").val().trim();
      let message = $("textarea[name='message']").val().trim();

      if (name === "" || email === "" || subject === "" || message === "") {
        $(".error-message").text("Semua kolom harus diisi!").fadeIn();
        return;
      }

      $(".loading").fadeIn();
      $(".error-message").hide();
      $(".sent-message").hide();

      $.ajax({
        type: "POST",
        url: "<?= base_url('landing/send_feedback') ?>",
        data: $(this).serialize(),
        success: function(response) {
          $(".loading").fadeOut();
          console.log("Response:", response); // Log respons untuk debugging

          // Periksa apakah respons mengandung "success" (bukan hanya sama persis)
          if (response.includes("success")) {
            $(".sent-message").fadeIn();
            $("#feedbackForm")[0].reset();
          } else {
            $(".error-message").text("Terjadi kesalahan saat mengirim pesan. Silakan coba lagi.").fadeIn();
          }
        },
        error: function(xhr, status, error) {
          $(".loading").fadeOut();
          console.log("Error:", xhr.responseText); // Log error untuk debugging
          $(".error-message").text("Terjadi kesalahan. Silakan coba lagi nanti.").fadeIn();
        }
      });
    });
  });
</script>