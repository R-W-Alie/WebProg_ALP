<?php include_once('navigation.php'); ?>
<?php include_once('hero_section.php'); ?>
<?php include_once('db.php'); ?>


</body>
<main class="max-w-screen-xl mx-auto px-4 py-12">
    <h2 class="text-3xl font-bold text-[#D2691E] mb-8 text-center">Semua Produk Cookies</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
        <?php
        $query = "SELECT * FROM products";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0):
            while ($row = mysqli_fetch_assoc($result)):
        ?>
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                    <img src="<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['product_name']) ?>" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-[#4A4A4A] mb-1"><?= htmlspecialchars($row['product_name']) ?></h3>
                        <p class="text-sm text-gray-600 mb-2"><?= nl2br(htmlspecialchars($row['description'])) ?></p>
                        <p class="text-[#D2691E] font-bold mb-3">Rp<?= number_format($row['price'], 0, ',', '.') ?></p>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-500">Stok: <?= $row['stock'] ?></span>
                            <a href="add_to_cart.php?id=<?= $row['product_id'] ?>"
                                class="bg-[#F4D03F] hover:bg-[#F1C40F] text-[#4A4A4A] font-semibold px-4 py-2 rounded-full transition-transform hover:-translate-y-1 text-sm">
                                Tambah ke Keranjang
                            </a>
                        </div>
                    </div>
                </div>
        <?php
            endwhile;
        else:
            echo "<p class='text-center text-gray-500 col-span-3'>Belum ada produk tersedia.</p>";
        endif;
        ?>
    </div>
</main>
<?php include_once('footer.php'); ?>

</html>

<!-- <section class=" bg-white py-12 px-6 text-center">
        <h2 class="text-2xl font-bold mb-8">Produk</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-8 max-w-5xl mx-auto">
            <div class="bg-white border rounded-lg p-4 shadow hover:shadow-lg transition">
                <img src="https://raw.githubusercontent.com/R-W-Alie/WebProg_ALP/refs/heads/main/image/dark_choco.jpg" alt="Dark Choco" class="mx-auto h-32 mb-4">
                <h3 class="font-bold text-lg">Dark Choco</h3>
                <p>Rp 55.000,-</p>
                <a href="darkchoco.php" class="text-sm underline mt-2 inline-block">Lihat Selengkapnya</a>
            </div>
            <div class="bg-white border rounded-lg p-4 shadow hover:shadow-lg transition">
                <img src="https://raw.githubusercontent.com/R-W-Alie/WebProg_ALP/refs/heads/main/image/strawberry_cheese.jpg" alt="Strawberry Cheese" class="mx-auto h-32 mb-4">
                <h3 class="font-bold text-lg">Strawberry Cheese</h3>
                <p>Rp 50.000,-</p>
                <a href="strawberry.php" class="text-sm underline mt-2 inline-block">Lihat Selengkapnya</a>
            </div>
            <div class="bg-white border rounded-lg p-4 shadow hover:shadow-lg transition">
                <img src="https://raw.githubusercontent.com/R-W-Alie/WebProg_ALP/refs/heads/main/image/mix_cookies.jpg" alt="Mix Cookies" class="mx-auto h-32 mb-4">
                <h3 class="font-bold text-lg">Mix Cookies</h3>
                <p>Rp 60.000,-</p>
                <a href="mixcookies.php" class="text-sm underline mt-2 inline-block">Lihat Selengkapnya</a>
            </div>
            <div class="bg-white border rounded-lg p-4 shadow hover:shadow-lg transition">
                <img src="https://raw.githubusercontent.com/R-W-Alie/WebProg_ALP/refs/heads/main/image/palm_sugar_choco.jpg" alt="Palm Sugar Choco" class="mx-auto h-32 mb-4">
                <h3 class="font-bold text-lg">Palm Sugar Choco</h3>
                <p>Rp 55.000,-</p>
                <a href="palmsugar.php" class="text-sm underline mt-2 inline-block">Lihat Selengkapnya</a>
            </div>
            <div class="bg-white border rounded-lg p-4 shadow hover:shadow-lg transition">
                <img src="https://raw.githubusercontent.com/R-W-Alie/WebProg_ALP/refs/heads/main/image/milk_choco.jpg" alt="Milk Choco" class="mx-auto h-32 mb-4">
                <h3 class="font-bold text-lg">Milk Choco</h3>
                <p>Rp 50.000,-</p>
                <a href="milkchoco.php" class="text-sm underline mt-2 inline-block">Lihat Selengkapnya</a>
            </div>
            <div class="bg-white border rounded-lg p-4 shadow hover:shadow-lg transition">
                <img src="https://raw.githubusercontent.com/R-W-Alie/WebProg_ALP/refs/heads/main/image/classic_duo.jpg" alt="Classic Duo Cookies" class="mx-auto h-32 mb-4">
                <h3 class="font-bold text-lg">Classic Duo Cookies</h3>
                <p>Rp 55.000,-</p>
                <a href="classicduo.php" class="text-sm underline mt-2 inline-block">Lihat Selengkapnya</a>
            </div>
        </div>
    </section> -->