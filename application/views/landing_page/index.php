<style>
  /* Tampilan untuk tablet */
  @media (max-width: 768px) {
    .section-title p {
      margin-bottom: 30px !important;
      font-size: 24px;
    }
  }
</style>
<!-- Hero Section -->
<section id="hero" class="hero section light-background">
  <div class="container">
    <div class="row gy-4 justify-content-center justify-content-lg-between">
      <div class="col-lg-5 order-2 order-lg-1 d-flex flex-column justify-content-center mb-5">
        <h1 data-aos="fade-up">Bali Treesco.</h1>
        <p data-aos="fade-up" data-aos-delay="100" style="color: #2b452c;">Sweet by Nature, Healthy by Choice.</p>
        <div class="d-flex" data-aos="fade-up" data-aos-delay="200">
          <a href="<?php echo base_url('landing/product') ?>" class="btn-get-started">Lihat Produk</a>
          <!-- <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="glightbox btn-watch-video d-flex align-items-center"><i class="bi bi-play-circle"></i><span>Watch Video</span></a> -->
          <a href="https://youtu.be/1HjQQEdO9S8?si=cyMsN6MJdo6b0RN1" class="glightbox btn-watch-video d-flex align-items-center"><i class="bi bi-play-circle"></i><span>Watch Video</span></a>
        </div>
      </div>
      <div class="col-lg-5 order-1 order-lg-2 hero-img" data-aos="zoom-out">
        <img src="<?= base_url('assets/img/logo-bali-treeco.png') ?>" class="img-fluid animated" alt="">
      </div>
    </div>
  </div>
</section><!-- /Hero Section -->



<!-- Why Us Section -->
<section id="why-us" class="why-us section">
  <div class="container">
    <div class="row gy-4">
      <div class="col-lg-4 rounded-5" data-aos="fade-up" data-aos-delay="100">
        <div class="why-box text-center" style="background-color: #ffffff;">
          <h3 style="color: #37373F;">Mengapa Memilih Bali Treesco?</h3>
          <div class="text-center">
            <img src="<?= base_url('assets/img/logo-bali-treeco-round.png') ?>" style="width: 50%;" alt="">
          </div>
        </div>
      </div>
      <!-- End Why Box -->

      <div class="col-lg-8 d-flex align-items-stretch">
        <div class="row gy-4" data-aos="fade-up" data-aos-delay="200">
          <div class="col-xl-4">
            <div class="icon-box d-flex flex-column justify-content-center align-items-center">
              <i class="bi bi-clipboard-data"></i>
              <h4>Sehat & Alami</h4>
              <p>Gula kelapa kami memiliki indeks glikemik rendah, cocok untuk penderita diabetes dan gaya hidup sehat.</p>
            </div>
          </div><!-- End Icon Box -->
          <div class="col-xl-4">
            <div class="icon-box d-flex flex-column justify-content-center align-items-center">
              <i class="bi bi-clipboard-data"></i>
              <h4>Sehat & Alami</h4>
              <p>Gula kelapa kami memiliki indeks glikemik rendah, cocok untuk penderita diabetes dan gaya hidup sehat.</p>
            </div>
          </div><!-- End Icon Box -->
          <div class="col-xl-4">
            <div class="icon-box d-flex flex-column justify-content-center align-items-center">
              <i class="bi bi-clipboard-data"></i>
              <h4>Sehat & Alami</h4>
              <p>Gula kelapa kami memiliki indeks glikemik rendah, cocok untuk penderita diabetes dan gaya hidup sehat.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- Section Title -->
<div class="container section-title" data-aos="fade-up" style="margin-top: 5%; padding-top: 0%; padding-bottom: 5px !important;">
  <!-- <h2>Galeri</h2> -->
  <p style="color: #198754;"><span class="description-title" style="color: #198754;">Galeri Kami</span></p>
</div>


<div class="container section" data-aos="fade-up" data-aos-delay="100">
  <div class="swiper init-swiper">
    <script type="application/json" class="swiper-config">
      {
        "loop": true,
        "speed": 600,
        "autoplay": {
          "delay": 5000
        },
        "slidesPerView": "auto",
        "centeredSlides": true,
        "pagination": {
          "el": ".swiper-pagination",
          "type": "bullets",
          "clickable": true
        },
        "breakpoints": {
          "320": {
            "slidesPerView": 1,
            "spaceBetween": 0
          },
          "768": {
            "slidesPerView": 3,
            "spaceBetween": 20
          },
          "1200": {
            "slidesPerView": 5,
            "spaceBetween": 20
          }
        }
      }
    </script>
    <div class="swiper-wrapper align-items-center" style="margin-bottom: 5px;">
      <?php foreach (@$galery as $k) : ?>
        <?php if ($k->status == 1) { ?>
          <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="<?= base_url('assets/img/galery/' . $k->image) ?>"><img src="<?= base_url('assets/img/galery/' . $k->image) ?>" class="img-fluid" alt=""></a></div>
        <?php } ?>
      <?php endforeach ?>
    </div>
    <div class="swiper-pagination"></div>
  </div>
</div>

<!-- </section> -->
<!-- /Gallery Section -->