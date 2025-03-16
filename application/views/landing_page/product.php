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

  <div class="tab-content" data-aos="fade-up" data-aos-delay="200">
    <div class="tab-pane fade active show" id="menu-starters">
      <!-- <div class="tab-header text-center">
        <p>Menu</p>
        <h3>Starters</h3>
      </div> -->
      <div class="row gy-5" style="display:flex;justify-content:center;">
        <?php foreach ($detail as $k) : ?>
          <?php if ($k->status == 1) { ?>
            <div class="col-lg-3 menu-item" style="margin: 2%;">
              <a href="<?= base_url('assets/img/menu/coconut-milk2.jpg') ?>" class="glightbox">
                <img src="<?= base_url('assets/img/menu/coconut-milk2.jpg') ?>" class="menu-img img-fluid" alt="">
              </a>

              <!-- <a href="<?= base_url('assets/img/menu/' . $k->image . '.png') ?>" class="glightbox">
                <img src="<?= base_url('assets/img/menu/' . $k->image . '.png') ?>" class="menu-img img-fluid" alt="">
              </a> -->
              <hr>
              <h4><?= $k->name ?></h4>
              <p class="ingredients"> <i><?= $k->description ?></i> </p>
              <p class="price"> Rp.<?= $k->price ?> </p>
              <a href="https://wa.me/+6289690000509" target="_blank" class="btn btn-sm btn-success col-sm-12">
                Beli
              </a>
            </div>
            <!-- Menu Item -->
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
</div>

<!-- </section> -->
<!-- /Menu Section -->