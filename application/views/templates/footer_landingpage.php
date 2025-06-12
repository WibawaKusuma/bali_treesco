</main>
<style>
    .container p {
        color: #fff;
    }

    h4 {
        color: #fff;
    }
</style>

<!-- <footer id="footer" class="footer" style="background-color: #f2f2f2;"> -->
<footer id="footer" class="footer" style="background: linear-gradient(to top, #0f2f00 0%, #3b5e1a 100%);">
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
                    <a href="<?= base_url('auth') ?>" title="Admin Login"><i class="bi bi-person-lock"></i></a>
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
        // Aktifkan menu berdasarkan URL saat ini
        let currentUrl = window.location.pathname; // Mendapatkan path URL
        let menuItems = document.querySelectorAll(".navmenu ul li a");

        menuItems.forEach(item => {
            if (item.href.includes(currentUrl)) {
                item.classList.add("active");
            }
        });

        // Tangani dropdown menu pada tampilan mobile
        document.querySelectorAll('.toggle-dropdown').forEach(function(toggle) {
            toggle.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();

                // Dapatkan parent li dan dropdown menu
                const parentLi = this.closest('.dropdown');
                const dropdownMenu = parentLi.querySelector('.dropdown-menu');

                // Toggle class dropdown-active
                dropdownMenu.classList.toggle('dropdown-active');
            });
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

<?php if ($this->session->userdata('customer_logged_in')) : ?>
    <!-- Script untuk mengupdate jumlah item di keranjang -->
    <script>
        // Fungsi untuk mengupdate jumlah item di keranjang
        function updateCartCount() {
            fetch('<?= base_url('cart/count_items') ?>')
                .then(response => response.json())
                .then(data => {
                    const cartCountElement = document.getElementById('cart-count');
                    if (cartCountElement) {
                        cartCountElement.textContent = data.count;

                        // Sembunyikan badge jika jumlah item 0
                        if (data.count === 0) {
                            cartCountElement.style.display = 'none';
                        } else {
                            cartCountElement.style.display = 'inline-block';
                        }
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        // Panggil fungsi saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function() {
            updateCartCount();
        });
    </script>
<?php endif; ?>

</body>

</html>