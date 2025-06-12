<style>
  .team-member .social i {
    font-size: 20px;
    margin: 0 5px;
  }

  @media (max-width: 576px) {
    .team-member {
      font-size: 14px;
    }

    .team-member img {
      width: 100%;
      height: auto;
      max-width: 100%;
      border-radius: 10px;
    }

    .team-member .member-info h4 {
      font-size: 16px;
    }

    .team-member .member-info span {
      font-size: 13px;
    }

    .team-member .social {
      margin-top: 5px;
    }

    .team-member .social i {
      font-size: 10px !important;
      margin: 0 3px !important;
    }
  }

  @media (max-width: 768px) {
    .team-member {
      flex: 1 1 100%;
      max-width: 100%;
    }

    .section-title p {
      margin-bottom: 30px !important;
      font-size: 24px;
    }
  }

  /* .section-title {
    margin-bottom: 100px !important;
  } */
</style>



<!-- About Section -->
<!-- <section id="about" class="about section"> -->

<!-- Section Title -->
<div class="container section-title" data-aos="fade-up" style="margin-top: 3%; padding-top: 0%; margin-bottom: 3% !important;">
  <p style="color: #198754;"><span class="description-title" style="color: #198754;">Tentang Kami</span></p>
</div>

<div class="container">
  <div class="row gy-4">
    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
      <img src="<?= base_url('assets/img/profile/about.png') ?>" class="img-fluid mb-4" alt="" style="border-radius: 5%;">
    </div>
    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="250">
      <div class="content py-1 py-lg-1">
        <p class="" style="color: black;">
          Bali Treesco adalah perusahaan inovatif yang berfokus pada produksi dan distribusi produk berbasis kelapa berkualitas tinggi,
          seperti gula kelapa dan bubuk santan, yang diproduksi secara lokal di Bali. Kami berkomitmen untuk menyediakan alternatif pemanis alami yang lebih sehat,
          khususnya untuk penderita diabetes, dengan mengutamakan kualitas dan keberlanjutan dalam setiap proses produksi.
        </p>
        <p class="" style="color: black;">
          Kami bekerja sama dengan petani kelapa lokal untuk memastikan sumber daya yang kami gunakan bersifat etis dan ramah lingkungan.
          Proses produksi kami yang teliti, mulai dari pemanenan air nira hingga pengemasan produk akhir,
          menjamin bahwa setiap produk yang kami hasilkan memiliki standar kualitas yang tinggi dan manfaat kesehatan yang optimal.
        </p>
        <p class="" style="color: black;">
          Bali Treesco bertujuan untuk menjadi pemimpin dalam pasar produk kelapa alami,
          memberikan pilihan yang lebih sehat dan berkelanjutan bagi konsumen di seluruh dunia,
          sambil mendukung ekonomi lokal dan menjaga keberlanjutan alam Bali.
        </p>
      </div>
    </div>
  </div>
</div>

<!-- </section> -->
<!-- /About Section -->

<section id="chefs" class="chefs section">
  <div class="container section-title" data-aos="fade-up" style="margin-top: 3%; padding-top: 0%; margin-bottom: 3% !important;">
    <!-- <h2>Tim</h2> -->
    <p style="color: #198754;"><span class="description-title" style="color: #198754;">Tim Kami<br></span></p>
  </div>
  <div class="container d-flex justify-content-center">
    <div class="row gy-4 justify-content-center">


      <?php foreach (@$team as $k) : ?>
        <?php if ($k->status == 1) { ?>
          <!-- <div class="col-lg-2 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100"> -->
          <div class="col-6 col-sm-4 col-md-3 col-lg-2 d-flex align-items-stretch">
            <div class="team-member">
              <div class="member-img">
                <img src="<?= base_url('assets/img/team/' . $k->image) ?>" class="img-fluid" alt="">
                <div class="social">
                  <a href=""><i class="bi bi-twitter-x"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href="https://www.instagram.com/<?= htmlspecialchars($k->instagram) ?>/" target="_blank" rel="noopener noreferrer">
                    <i class="bi bi-instagram"></i>
                  </a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4><?= $k->name ?></h4>
                <span><?= $k->description ?></span>
              </div>
            </div>
          </div>
        <?php } ?>
      <?php endforeach ?>




      <!-- <div class="col-lg-2 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
        <div class="team-member">
          <div class="member-img">
            <img src="<?= base_url('assets/img/team/INTAN.png') ?>" class="img-fluid" alt="">
            <div class="social">
              <a href=""><i class="bi bi-twitter-x"></i></a>
              <a href=""><i class="bi bi-facebook"></i></a>
              <a href=""><i class="bi bi-instagram"></i></a>
              <a href=""><i class="bi bi-linkedin"></i></a>
            </div>
          </div>
          <div class="member-info">
            <h4>Intan</h4>
            <span>Hustler</span>
          </div>
        </div>
      </div> -->

      <!-- <div class="col-lg-2 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="300">
        <div class="team-member">
          <div class="member-img">
            <img src="<?= base_url('assets/img/team/ADHI.png') ?>" class="img-fluid" alt="">
            <div class="social">
              <a href=""><i class="bi bi-twitter-x"></i></a>
              <a href=""><i class="bi bi-facebook"></i></a>
              <a href=""><i class="bi bi-instagram"></i></a>
              <a href=""><i class="bi bi-linkedin"></i></a>
            </div>
          </div>
          <div class="member-info">
            <h4>Adhi</h4>
            <span>Hipster</span>
          </div>
        </div>
      </div>

      <div class="col-lg-2 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="400">
        <div class="team-member">
          <div class="member-img">
            <img src="<?= base_url('assets/img/team/ADI.png') ?>" class="img-fluid" alt="">
            <div class="social">
              <a href=""><i class="bi bi-twitter-x"></i></a>
              <a href=""><i class="bi bi-facebook"></i></a>
              <a href=""><i class="bi bi-instagram"></i></a>
              <a href=""><i class="bi bi-linkedin"></i></a>
            </div>
          </div>
          <div class="member-info">
            <h4>Adi</h4>
            <span>Hipster</span>
          </div>
        </div>
      </div>

      <div class="col-lg-2 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="400">
        <div class="team-member">
          <div class="member-img">
            <img src="<?= base_url('assets/img/team/ADI.png') ?>" class="img-fluid" alt="">
            <div class="social">
              <a href=""><i class="bi bi-twitter-x"></i></a>
              <a href=""><i class="bi bi-facebook"></i></a>
              <a href=""><i class="bi bi-instagram"></i></a>
              <a href=""><i class="bi bi-linkedin"></i></a>
            </div>
          </div>
          <div class="member-info">
            <h4>Agus</h4>
            <span>Hacker</span>
          </div>
        </div>
      </div> -->

    </div>
  </div>
</section>



<!-- Section Title -->
<!-- <div class="container section-title" data-aos="fade-up">
  <h2>Galeri</h2>
  <p><span>Cek</span> <span class="description-title">Galeri Kami</span></p>
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
    <div class="swiper-wrapper align-items-center">
      <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="<?= base_url('assets/img/team/LISSA.png') ?>"><img src="<?= base_url('assets/img/team/LISSA.png') ?>" class="img-fluid" alt=""></a></div>
      <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="<?= base_url('assets/img/team/INTAN.png') ?>"><img src="<?= base_url('assets/img/team/INTAN.png') ?>" class="img-fluid" alt=""></a></div>
      <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="<?= base_url('assets/img/team/ADHI.png') ?>"><img src="<?= base_url('assets/img/team/ADHI.png') ?>" class="img-fluid" alt=""></a></div>
      <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="<?= base_url('assets/img/team/ADI.png') ?>"><img src="<?= base_url('assets/img/team/ADI.png') ?>" class="img-fluid" alt=""></a></div>
      <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="<?= base_url('assets/img/team/ADHI.png') ?>"><img src="<?= base_url('assets/img/team/ADHI.png') ?>" class="img-fluid" alt=""></a></div>
      <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="<?= base_url('assets/img/team/LISSA.png') ?>"><img src="<?= base_url('assets/img/team/LISSA.png') ?>" class="img-fluid" alt=""></a></div>
    </div>
    <div class="swiper-pagination"></div>
  </div>
</div> -->