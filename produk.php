<?php
session_start();
include_once('db.php');
?>
<?php include_once('navigation.php'); ?>
<?php include_once('hero_section.php'); ?>

<main class="max-w-screen-xl mx-auto px-4 py-12">
    <h2 class="text-3xl font-bold text-[#D2691E] mb-8 text-center">Semua Produk Cookies</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
        <?php
        $query = "SELECT * FROM products";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0):
            while ($row = mysqli_fetch_assoc($result)):
        ?>
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300 flex flex-col">
    
    <div class="w-full h-56 flex items-center justify-center p-4 bg-gray-50"> 
        <img src="<?= htmlspecialchars($row['image']) ?>" 
                alt="<?= htmlspecialchars($row['product_name']) ?>" 
                class="max-w-full max-h-full object-contain">
                </div>

    <div class="p-4 flex-grow flex flex-col">
        <div>
            <h3 class="text-lg font-semibold text-[#4A4A4A] mb-1"><?= htmlspecialchars($row['product_name']) ?></h3>
            <p class="text-sm text-gray-600 mb-2 h-16 overflow-hidden">
                <?= nl2br(htmlspecialchars($row['description'])) ?>
            </p>
            <p class="text-[#D2691E] font-bold mb-3">Rp<?= number_format($row['price'], 0, ',', '.') ?></p>
        </div>
        
        <div class="flex justify-between items-center mt-auto">
            <span class="text-sm text-gray-500">Stok: <?= $row['stock'] ?></span>
            <?php if ($row['stock'] > 0): ?>
                <a href="tambahKeranjang.php?id=<?= $row['product_id'] ?>"
                    class="bg-[#F4D03F] hover:bg-[#F1C40F] text-[#4A4A4A] font-semibold px-4 py-2 rounded-full transition-transform hover:-translate-y-1 text-sm">
                    Tambah ke Keranjang
                </a>
            <?php else: ?>
                <span class="text-sm text-red-500 font-semibold">Stok Habis</span>
            <?php endif; ?>
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