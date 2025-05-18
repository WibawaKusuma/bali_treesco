<!-- Contact Section -->
<section id="contact" class="contact section">
  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <!-- <h2>Kontak</h2> -->
    <p style="color: #198754;"><span>Perlu Bantuan?</span> <span class="description-title" style="color: #198754;">Hubungi Kami</span></p>
  </div><!-- End Section Title -->

  <div class="container" data-aos="fade-up" data-aos-delay="100">

    <div class="mb-5">
      <!-- <iframe style="width: 100%; height: 400px;" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12097.433213460943!2d-74.0062269!3d40.7101282!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb89d1fe6bc499443!2sDowntown+Conference+Center!5e0!3m2!1smk!2sbg!4v1539943755621" frameborder="0" allowfullscreen=""></iframe> -->
      <!-- <iframe style="width: 100%; height: 400px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3004.2342095864765!2d115.23518267359732!3d-8.689619288505611!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd241aab844be9f%3A0x7bfef0260053104e!2sPrimakara%20University!5e1!3m2!1sid!2sid!4v1741507525028!5m2!1sid!2sid" frameborder="0" allowfullscreen="" loading="lazy"></iframe> -->
      <iframe style="width: 100%; height: 400px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3944.748216671673!2d115.20576007359595!3d-8.620153987593827!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd23f233522e0d5%3A0x31d8615b18e51493!2sJl.%20Lembusora%20No.20%2C%20Peguyangan%2C%20Kec.%20Denpasar%20Utara%2C%20Kota%20Denpasar%2C%20Bali%2080115!5e0!3m2!1sid!2sid!4v1744040079968!5m2!1sid!2sid" frameborder="0" allowfullscreen="" loading="lazy"></iframe>
    </div><!-- End Google Maps -->

    <div class=" row gy-4">

      <div class="col-md-6">
        <div class="info-item d-flex align-items-center" data-aos="fade-up" data-aos-delay="200">
          <i class="icon bi bi-geo-alt flex-shrink-0"></i>
          <div>
            <h3>Alamat</h3>
            <p><?= @$config['company_address'] ?> <?= @$config['company_city'] ?>, <?= @$config['company_province'] ?></p>
          </div>
        </div>
      </div><!-- End Info Item -->

      <div class="col-md-6">
        <div class="info-item d-flex align-items-center" data-aos="fade-up" data-aos-delay="300">
          <i class="icon bi bi-telephone flex-shrink-0"></i>
          <div>
            <h3>Telpon</h3>
            <p><?= @$config['company_phone'] ?></p>
            <p>&nbsp;</p>
          </div>
        </div>
      </div><!-- End Info Item -->

      <div class="col-md-6">
        <div class="info-item d-flex align-items-center" data-aos="fade-up" data-aos-delay="400">
          <i class="icon bi bi-envelope flex-shrink-0"></i>
          <div>
            <h3>Email</h3>
            <p><?= @$config['company_email'] ?></p>
          </div>
        </div>
      </div><!-- End Info Item -->

      <div class="col-md-6">
        <div class="info-item d-flex align-items-center" data-aos="fade-up" data-aos-delay="500">
          <i class="icon bi bi-clock flex-shrink-0"></i>
          <div>
            <h3>Jam Buka<br></h3>
            <p><strong>Sen-Sab:</strong> 11AM - 23PM; <strong>Minggu:</strong> Tutup</p>
          </div>
        </div>
      </div><!-- End Info Item -->

    </div>

    <form id="feedbackForm" class="php-email-form" data-aos="fade-up" data-aos-delay="600">
      <div class="row gy-4">

        <div class="col-md-6">
          <input type="text" name="name" class="form-control" placeholder="Nama Anda" required="">
        </div>

        <div class="col-md-6 ">
          <input type="email" class="form-control" name="email" placeholder="Email Anda" required="">
        </div>

        <div class="col-md-12">
          <input type="text" class="form-control" name="subject" placeholder="Subjek" required="">
        </div>

        <div class="col-md-12">
          <textarea class="form-control" name="message" rows="6" placeholder="Pesan" required=""></textarea>
        </div>

        <div class="col-md-12 text-center">
          <div class="loading">Loading</div>
          <div class="error-message"></div>
          <div class="sent-message">Pesan Anda telah terkirim. Terima kasih!</div>

          <button type="submit">Kirim Pesan</button>
        </div>

      </div>
    </form><!-- End Contact Form -->

  </div>

</section><!-- /Contact Section -->
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