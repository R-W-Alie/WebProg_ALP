<?php include_once('navigation.php'); ?>
<?php include_once('hero_section.php'); ?>

<section class="py-20 bg-[#F5F5F5]">
    <div class="max-w-screen-xl mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-10">Produk Unggulan</h2>
        <div id="slider" class="mx-auto relative w-full max-w-xl md:max-w-2xl overflow-hidden rounded-lg">
            
            <div class="slides flex transition-transform duration-500 ease-in-out">
                <div class="slide flex-shrink-0 w-full h-auto ">
                    <img src="https://raw.githubusercontent.com/R-W-Alie/WebProg_ALP/refs/heads/main/image/dark_choco.jpg" alt="Kukis Dark Choco" class="w-full h-auto block object-cover"> <p class="text-center font-semibold py-2 bg-white bg-opacity-75">Dark Choco</p> </div>
                <div class="slide flex-shrink-0 w-full h-auto">
                    <img src="https://raw.githubusercontent.com/R-W-Alie/WebProg_ALP/refs/heads/main/image/mix_cookies.jpg" alt="Kukis Classic Duo" class="w-full h-auto block object-cover">
                    <p class="text-center font-semibold py-2 bg-white bg-opacity-75">Mix Cookies</p>
                </div>
                <div class="slide flex-shrink-0 w-full h-auto">
                    <img src="https://raw.githubusercontent.com/R-W-Alie/WebProg_ALP/refs/heads/main/image/palm_sugar_choco.jpg" alt="Kukis Palm Sugar Choco" class="w-full h-auto block object-cover">
                    <p class="text-center font-semibold py-2 bg-white bg-opacity-75">Palm Sugar Choco</p>
                </div>
                </div>

            <div class="controls absolute top-1/2 left-0 right-0 flex justify-between transform -translate-y-1/2 px-2 z-10">
                <button id="prev" class="bg-black bg-opacity-50 hover:bg-opacity-70 text-white border-none p-2 rounded-full flex items-center justify-center cursor-pointer">
                    <img src="https://raw.githubusercontent.com/R-W-Alie/WebProg_ALP/refs/heads/main/11541959.png" width="30" height="30" class="filter invert">
                </button>
                <button id="next" class="bg-black bg-opacity-50 hover:bg-opacity-70 text-white border-none p-2 rounded-full flex items-center justify-center cursor-pointer">
                    <img src="https://raw.githubusercontent.com/R-W-Alie/WebProg_ALP/refs/heads/main/11541954.png" width="30" height="30" class="filter invert">
                </button>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function () {
                let currentIndex = 0;
                const slidesContainer = $('.slides'); // Kontainer flex untuk slide
                const slides = $('.slide');       // Setiap item slide individual
                const totalSlides = slides.length;
                const slideInterval = 5000; // 5 detik
                let autoSlideTimer;

                function showSlide(index) {
                    // Setiap slide menggeser kontainer sebesar 100% dari lebarnya
                    const offset = -index * 100 + '%'; 
                    slidesContainer.css('transform', 'translateX(' + offset + ')');
                }

                function nextSlide() {
                    currentIndex = (currentIndex + 1) % totalSlides;
                    showSlide(currentIndex);
                }
                
                function prevSlide() {
                    currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
                    showSlide(currentIndex);
                }

                function startAutoSlide() {
                    stopAutoSlide(); // Hentikan dulu jika sudah ada
                    autoSlideTimer = setInterval(nextSlide, slideInterval);
                }

                function stopAutoSlide() {
                    clearInterval(autoSlideTimer);
                }

                $('#prev').click(function () {
                    stopAutoSlide();
                    prevSlide(); // Panggil fungsi prevSlide yang sudah diperbaiki
                    startAutoSlide(); // Restart setelah perubahan manual
                });

                $('#next').click(function () {
                    stopAutoSlide();
                    nextSlide();
                    startAutoSlide(); // Restart setelah perubahan manual
                });

                // Inisialisasi
                if (totalSlides > 0) { // Hanya jalankan jika ada slide
                    showSlide(currentIndex);
                    startAutoSlide();
                } else {
                    // Sembunyikan tombol navigasi jika tidak ada slide
                    $('.controls').hide();
                }
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