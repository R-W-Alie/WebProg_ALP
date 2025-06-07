<?php include_once('navadmin.php'); ?>
<?php include_once('db.php'); ?>

<main class="max-w-screen-xl mx-auto px-4 py-12">
    <div class="flex justify-between items-center mb-8">
        <h2 class="text-3xl font-bold text-[#D2691E]">Daftar Produk Cookies</h2>
        <a href="tambah_produk.php" class="bg-[#28a745] hover:bg-[#218838] text-white font-semibold px-5 py-2 rounded-lg transition-transform hover:-translate-y-1">
            + Tambah Produk Baru
        </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
        <?php
        $query = "SELECT * FROM products ORDER BY product_id DESC";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0):
            while ($row = mysqli_fetch_assoc($result)):
        ?>
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                <img src="<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['product_name']) ?>" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-[#4A4A4A] mb-1"><?= htmlspecialchars($row['product_name']) ?></h3>
                        <p class="text-sm text-gray-600 mb-2 h-20 overflow-auto"><?= nl2br(htmlspecialchars($row['description'])) ?></p>
                        <p class="text-[#D2691E] font-bold mb-3">Rp<?= number_format($row['price'], 0, ',', '.') ?></p>
                        <div class="flex justify-between items-center border-t pt-3">
                            <span class="text-sm text-gray-500">Stok: <?= $row['stock'] ?></span>
                            <div>
                                <a href="edit_produk.php?id=<?= $row['product_id'] ?>"
                                    class="bg-[#F4D03F] hover:bg-[#F1C40F] text-[#4A4A4A] font-semibold px-4 py-2 rounded-full text-sm">
                                    Edit
                                </a>
                                <a href="hapus_produk.php?id=<?= $row['product_id'] ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?');"
                                    class="bg-red-500 hover:bg-red-600 text-white font-semibold px-4 py-2 rounded-full text-sm">
                                    Hapus
                                </a>
                            </div>
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