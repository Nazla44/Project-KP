<footer class="footer-section">
    <div class="footer-main">
        <div class="container-xl mt-5">
            <div class="row g-5">
                <div class="col-lg-4">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <img src="<?php echo e(asset('assets/image/icon-stpi.png')); ?>" alt="STPI Logo" class="footer-logo">
                    </div>
                    <p class="footer-address">
                        Klinik JRC-PPTI, Jl. Sultan Iskandar Muda No.66A Lt 3,
                        Kby. Lama Utara, Kec. Kby. Lama, Kota Jakarta Selatan,
                        Daerah Khusus Ibukota Jakarta 12240
                    </p>
                    <p class="footer-contact mb-1">+62 852-8229-8824</p>
                    <p class="footer-contact">admin@stoptbindonesia.org</p>
                </div>

                <div class="col-6 col-lg-2 py-5">
                    <h6 class="footer-heading">INFORMASI</h6>
                    <ul class="footer-links">
                        <li><a href="#">Publikasi STPI</a></li>
                        <li><a href="#">Relawan</a></li>
                        <li><a href="#">Direktori Mitra STPI</a></li>
                    </ul>
                </div>

                <div class="col-6 col-lg-2 py-5">
                    <h6 class="footer-heading">TENTANG KAMI</h6>
                    <ul class="footer-links">
                        <li><a href="<?php echo e(route('about')); ?>">Tentang Kami</a></li>
                        <li><a href="<?php echo e(route('careers')); ?>">Karir</a></li>
                        <li><a href="<?php echo e(route('accountability')); ?>">Akuntabilitas</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 py-5">
                    <h6 class="footer-heading">NEWS LETTER</h6>
                    <form class="newsletter-wrap d-flex flex-column gap-2" id="newsletterForm">
                        <input type="email" name="email" placeholder="Email anda" class="newsletter-input" required>
                        <button type="submit" class="newsletter-btn">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container-xl px-4 px-lg-5">
            <div class="d-flex align-items-center justify-content-center gap-2 py-3 flex-wrap">
                <span>© 2026 STPI. All Rights Reserved.</span>
                <span class="footer-sep">|</span>
                <a href="#">Privacy Policy</a>
                <span class="footer-sep">|</span>
                <a href="#">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>
<?php /**PATH D:\Kuliah\SMT 6\KP\Project-KP\resources\views/partials/footer.blade.php ENDPATH**/ ?>