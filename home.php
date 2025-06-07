<?php include_once('navigation.php'); ?>
<?php include_once('hero_section.php'); ?>

<?php

include_once('db.php');

// Kueri untuk mengambil 3 produk terlaris
$query_laris = "
    SELECT
        p.product_id,
        p.product_name,
        p.image
    FROM
        orders oi
    JOIN
        products p ON oi.product_id = p.product_id
    GROUP BY
        p.product_id, p.product_name, p.image
    ORDER BY
        SUM(oi.quantity) DESC
    LIMIT 3
";

$result_laris = mysqli_query($conn, $query_laris);
?>

<section class="py-20 bg-[#F5F5F5]">
    <div class="max-w-screen-xl mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-10">Produk Unggulan</h2>
        <div id="slider" class="mx-auto relative w-full max-w-xl md:max-w-2xl overflow-hidden rounded-lg">
            
            <div class="slides flex transition-transform duration-500 ease-in-out">
                <?php
                if ($result_laris && mysqli_num_rows($result_laris) > 0):
                    while ($produk = mysqli_fetch_assoc($result_laris)):
                ?>
                        <div class="slide flex-shrink-0 w-full h-auto ">
                            <img src="<?= htmlspecialchars($produk['image']) ?>" alt="Kukis <?= htmlspecialchars($produk['product_name']) ?>" class="w-full max-h-60 object-contain mx-auto">
                            <p class="text-center font-semibold text-sm py-1 rounded max-w-[230px] mx-auto">
                                <?= htmlspecialchars($produk['product_name']) ?>
                            </p>
                        </div>
                <?php
                    endwhile;
                else:
                ?>
                    <div class="slide flex-shrink-0 w-full h-auto text-center">
                        <p>Belum ada produk unggulan yang tersedia.</p>
                    </div>
                <?php endif; ?>
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
                const slidesContainer = $('.slides');
                const slides = $('.slide');
                const totalSlides = slides.length;
                const slideInterval = 5000;
                let autoSlideTimer;

                function showSlide(index) {
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
                    stopAutoSlide();
                    autoSlideTimer = setInterval(nextSlide, slideInterval);
                }

                function stopAutoSlide() {
                    clearInterval(autoSlideTimer);
                }

                $('#prev').click(function () {
                    stopAutoSlide();
                    prevSlide();
                    startAutoSlide();
                });

                $('#next').click(function () {
                    stopAutoSlide();
                    nextSlide();
                    startAutoSlide();
                });

                if (totalSlides > 0) {
                    showSlide(currentIndex);
                    startAutoSlide();
                } else {
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