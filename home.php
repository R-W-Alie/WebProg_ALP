<?php include_once('navigation.php'); ?>
<?php include_once('hero_section.php'); ?>

<?php
include_once('db.php');

// Query to get top 3 best-selling products with all details
$query_laris = "
    SELECT
        p.product_id,
        p.product_name,
        p.image,
        p.price,
        p.description,
        p.stock
    FROM
        orders oi
    JOIN
        products p ON oi.product_id = p.product_id
    GROUP BY
        p.product_id, p.product_name, p.image, p.price, p.description, p.stock
    ORDER BY
        SUM(oi.quantity) DESC
    LIMIT 3
";

$result_laris = mysqli_query($conn, $query_laris);
?>

<section class="py-20 bg-[[#F5F1E8]">
    <div class="max-w-screen-xl mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-10">Produk Unggulan</h2>
        
        <?php if ($result_laris && mysqli_num_rows($result_laris) > 0): ?>
        <div id="slider" class="mx-auto relative w-full max-w-xl md:max-w-2xl overflow-hidden rounded-lg">
            <div class="slides flex transition-transform duration-500 ease-in-out">
                <?php while ($produk = mysqli_fetch_assoc($result_laris)): ?>
                <div class="slide flex-shrink-0 w-full h-auto bg-white rounded-xl shadow-md overflow-hidden flex flex-col">
                    <div class="w-full h-56 flex items-center justify-center p-4 bg-gray-50">
                        <img src="<?= htmlspecialchars($produk['image']) ?>" 
                             alt="<?= htmlspecialchars($produk['product_name']) ?>" 
                             class="max-w-full max-h-full object-contain">
                    </div>

                    <div class="p-4 flex-grow flex flex-col">
                        <div>
                            <h3 class="text-lg font-semibold text-[#4A4A4A] mb-1">
                                <?= htmlspecialchars($produk['product_name']) ?>
                            </h3>
                            <p class="text-sm text-gray-600 mb-2 h-16 overflow-hidden">
                                <?= nl2br(htmlspecialchars($produk['description'])) ?>
                            </p>
                            <p class="text-[#D2691E] font-bold mb-3">
                                Rp<?= number_format($produk['price'], 0, ',', '.') ?>
                            </p>
                        </div>
                        
                        <div class="flex justify-between items-center mt-auto">
                            <span class="text-sm text-gray-500">Stok: <?= $produk['stock'] ?></span>
                            <?php if ($produk['stock'] > 0): ?>
                                <a href="tambahKeranjang.php?id=<?= $produk['product_id'] ?>"
                                    class="bg-[#F4D03F] hover:bg-[#F1C40F] text-[#4A4A4A] font-semibold px-4 py-2 rounded-full transition-transform hover:-translate-y-1 text-sm">
                                    Tambah ke Keranjang
                                </a>
                            <?php else: ?>
                                <span class="text-sm text-red-500 font-semibold">Stok Habis</span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
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

        <?php else: ?>
        <div class="text-center py-10">
            <p class="text-gray-500">Belum ada produk unggulan yang tersedia.</p>
            <a href="produk.php" class="mt-4 inline-block bg-[#D2691E] text-white px-5 py-2 rounded-full hover:bg-[#B65C1A] transition">
                Lihat Semua Produk
            </a>
        </div>
        <?php endif; ?>
    </div>
</section>

<section class="py-20 bg-[#F5F1E8]">
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