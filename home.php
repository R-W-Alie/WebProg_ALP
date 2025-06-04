<?php include_once('navigation.php'); ?>

    <?php include_once('hero_section.php'); ?>
    
    <section class="py-20 bg-[#F5F5F5]">
    <div class="max-w-screen-xl mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-10">Produk Unggulan</h2>
        <div id="slider" class="relative w-full max-w-2xl mx-auto overflow-hidden">
            <div class="slides flex transition-transform duration-500 ease-in-out" style="width: calc(100% * 3);">
                <div class="slide flex-shrink-0 w-1/3">
                    <img src="https://raw.githubusercontent.com/R-W-Alie/WebProg_ALP/refs/heads/main/image/dark_choco.jpg" alt="Kukis Dark Choco" class="w-full h-auto block object-cover rounded-lg shadow-md">
                </div>
                <div class="slide flex-shrink-0 w-1/3">
                    <img src="https://raw.githubusercontent.com/R-W-Alie/WebProg_ALP/refs/heads/main/image/classic_duo.jpg" alt="Kukis Classic Duo" class="w-full h-auto block object-cover rounded-lg shadow-md">
                </div>
                <div class="slide flex-shrink-0 w-1/3">
                    <img src="https://raw.githubusercontent.com/R-W-Alie/WebProg_ALP/refs/heads/main/image/palm_sugar_choco.jpg" alt="Kukis Palm Sugar Choco" class="w-full h-auto block object-cover rounded-lg shadow-md">
                </div>
            </div>

            <div class="controls absolute top-1/2 left-0 right-0 flex justify-between transform -translate-y-1/2 px-2 z-10">
                <button id="prev" class="bg-black bg-opacity-50 hover:bg-opacity-70 border-none p-2 rounded-full flex items-center justify-center cursor-pointer">
                    <img src="https://raw.githubusercontent.com/R-W-Alie/WebProg_ALP/refs/heads/main/11541959.png" width="30" height="30" class="filter invert">
                </button>
                <button id="next" class="bg-black bg-opacity-50 hover:bg-opacity-70 border-none p-2 rounded-full flex items-center justify-center cursor-pointer">
                    <img src="https://raw.githubusercontent.com/R-W-Alie/WebProg_ALP/refs/heads/main/11541954.png" width="30" height="30" class="filter invert">
                </button>
            </div>
        </div>
        <script>
        // jQuery(document).ready() code
        $(document).ready(function () {
            let currentIndex = 0;
            const slides = $('.slide');
            const totalSlides = slides.length;
            const slideInterval = 3000; // 3 seconds
            let autoSlide;

            function showSlide(index) {
                const offset = -index * 100 + '%';
                $('.slides').css('transform', 'translateX(' + offset + ')');
            }

            function nextSlide() {
                currentIndex = (currentIndex + 1) % totalSlides;
                showSlide(currentIndex);
            }

            function startAutoSlide() {
                autoSlide = setInterval(nextSlide, slideInterval);
            }

            function stopAutoSlide() {
                clearInterval(autoSlide);
            }

            $('#prev').click(function () {
                stopAutoSlide();
                currentIndex = (currentIndex > 0) ? currentIndex - 1 : totalSlides - 1;
                showSlide(currentIndex);
                startAutoSlide(); // Restart after manual change
            });

            $('#next').click(function () {
                stopAutoSlide();
                currentIndex = (currentIndex + 1) % totalSlides;
                showSlide(currentIndex);
                startAutoSlide(); // Restart after manual change
            });

            // Initialize
            showSlide(currentIndex);
            startAutoSlide();
        });
        </script>
    </div>
</section>

    <section class="py-20 bg-white">
        <div class="max-w-screen-xl mx-auto px-4 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-10">
            <div class="relative p-6 bg-[#FEFEFE] rounded-xl shadow-lg hover:-translate-y-1 transition-transform">
                <h3 class="text-xl font-bold mb-4">Pesanan</h3>
                <p class="text-justify text-[#666]">Sri'Cookies berpengalaman menangani pesanan roti dalam jumlah besar (hingga 35.000 item sehari) sejak 2010. Berapapun jumlah pesanan Anda, Kami layani.</p>
            </div>
            <div class="relative p-6 bg-[#FEFEFE] rounded-xl shadow-lg hover:-translate-y-1 transition-transform">
                <h3 class="text-xl font-bold mb-4">Fresh From Oven</h3>
                <p class="text-justify text-[#666]">Seluruh produk pesanan selalu dibuat paling lama 24 jam sebelum waktu pengambilan pesanan. Roti kami tahan 2-3 hari dari pembelian</p>
            </div>
            <div class="relative p-6 bg-[#FEFEFE] rounded-xl shadow-lg hover:-translate-y-1 transition-transform">
                <h3 class="text-xl font-bold mb-4">Jaminan Kualitas</h3>
                <p class="text-justify text-[#666]">Sri'Cookies senantiasa menjaga kualitas produk dan layanan untuk pelanggan setia kami. Kami memberi garansi uang kembali hingga 100% jika Anda tidak puas dengan produk atau layanan kami.</p>
            </div>
            <div class="relative p-6 bg-[#FEFEFE] rounded-xl shadow-lg hover:-translate-y-1 transition-transform">
                <h3 class="text-xl font-bold mb-4">Layanan Antar</h3>
                <p class="text-justify text-[#666]">Sri'Cookies menyediakan layanan antar pesanan dalam kota (Surabaya & Sidoarjo), hingga ke luar kota kota (Malang, Batu, Gresik, Pasuruan, Mojokerto, Bangkalan, Sampang, Pamekasan, dan kota lain di Jawa Timur).</p>
            </div>
        </div>
    </section>
<?php include_once('footer.php'); ?>