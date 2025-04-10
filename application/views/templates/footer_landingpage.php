</main>

<footer id="footer" class="footer" style="background-color: #f2f2f2;">

    <div class="container">
        <div class="row gy-3">
            <div class="col-lg-3 col-md-6 d-flex">
                <i class="bi bi-geo-alt icon"></i>
                <div class="address">
                    <h4>Alamat</h4>
                    <p><?= @$config['company_address'] ?>, <?= @$config['company_city'] ?>, <?= @$config['company_province'] ?></p>
                    <!-- <p><?= @$config['company_city'] ?>, <?= @$config['company_province'] ?></p> -->
                    <p></p>
                </div>

            </div>

            <div class="col-lg-3 col-md-6 d-flex">
                <i class="bi bi-telephone icon"></i>
                <div>
                    <h4>Kontak</h4>
                    <p>
                        <strong>Telpon:</strong> <span><?= @$config['company_phone'] ?></span><br>
                        <strong>Email:</strong> <span><?= @$config['company_email'] ?></span><br>
                    </p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 d-flex">
                <i class="bi bi-clock icon"></i>
                <div>
                    <h4>Jam Buka</h4>
                    <p>
                        <strong>Sen-Sab:</strong> <span>11AM - 23PM</span><br>
                        <strong>Minggu</strong>: <span>Tutup</span>
                    </p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <h4>Follow Us</h4>
                <div class="social-links d-flex">
                    <a href="#" class="twitter"><i class="bi bi-twitter-x"></i></a>
                    <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                    <a href="https://www.instagram.com/balitreesco/" target="_blank" class="instagram"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                    <a href="<?= base_url('auth') ?>"><i class="bi bi-arrow-right-circle-fill"></i></a>
                </div>
            </div>

        </div>
    </div>

    <div class="container copyright text-center mt-4">
        <p>© <span>Copyright</span> <strong class="px-1 sitename"><?= @$config['company_name'] ?></strong> <span>All Rights Reserved</span></p>
        <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you've purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
            <!-- Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> Distributed by <a href="https://themewagon.com">ThemeWagon</a> -->
        </div>
    </div>

</footer>

<!-- Scroll Top -->
<a href="#" id="scroll-top" style="background-color: #42704e;" class=" scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Preloader -->
<div id="preloader"></div>

<!-- <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../assets/vendor/php-email-form/validate.js"></script>
<script src="../assets/vendor/aos/aos.js"></script>
<script src="../assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="../assets/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="../assets/vendor/swiper/swiper-bundle.min.js"></script> -->

<!-- <script src="../assets/js/main.js"></script> -->

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let currentUrl = window.location.pathname; // Mendapatkan path URL
        let menuItems = document.querySelectorAll(".navmenu ul li a");

        menuItems.forEach(item => {
            if (item.href.includes(currentUrl)) {
                item.classList.add("active");
            }
        });
    });
</script>


<!-- Vendor JS Files -->
<script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= base_url('assets/vendor/php-email-form/validate.js') ?>"></script>
<script src="<?= base_url('assets/vendor/aos/aos.js') ?>"></script>
<script src="<?= base_url('assets/vendor/glightbox/js/glightbox.min.js') ?>"></script>
<script src="<?= base_url('assets/vendor/purecounter/purecounter_vanilla.js') ?>"></script>
<script src="<?= base_url('assets/vendor/swiper/swiper-bundle.min.js') ?>"></script>

<!-- Main JS File -->
<script src="<?= base_url('assets/js/main.js') ?>"></script>

</body>

</html>