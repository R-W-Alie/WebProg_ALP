<?php include_once('navadmin.php'); ?>
<?php include_once('db.php'); ?>

<main class="max-w-screen-xl mx-auto px-4 py-12">
    <div class="flex justify-between items-center mb-8">
        <h2 class="text-3xl font-bold text-[#D2691E]">Daftar Produk Cookies</h2>
        <a href="tambah_produk.php" class="bg-[#28a745] hover:bg-[#218838] text-white font-semibold px-5 py-2 rounded-lg transition-transform hover:-translate-y-1">
            + Tambah Produk Baru
        </a>
    </div>

    <?php
    // Display success atau error messages
    if (isset($_SESSION['success_message'])) {
        echo '<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">' . $_SESSION['success_message'] . '</div>';
        unset($_SESSION['success_message']);
    }
    if (isset($_SESSION['error_message'])) {
        echo '<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">' . $_SESSION['error_message'] . '</div>';
        unset($_SESSION['error_message']);
    }
    ?>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
        <?php
        // Query buat display active produk
        $query = "SELECT * FROM products WHERE is_active = TRUE ORDER BY product_id DESC";
        $result = mysqli_query($conn, $query);
        
        //buat cek ada isinya gk trs valid nda
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
                            <p class="text-sm text-gray-600 mb-2 h-20 overflow-auto"><?= nl2br(htmlspecialchars($row['description'])) ?></p>
                            <p class="text-[#D2691E] font-bold mb-3">Rp<?= number_format($row['price'], 0, ',', '.') ?></p>
                        </div>
                        
                        <div class="flex justify-between items-center border-t pt-3 mt-auto">
                            <span class="text-sm text-gray-500">Stok: <?= $row['stock'] ?></span>
                            <div class="flex gap-2">
                                <a href="edit_produk.php?id=<?= $row['product_id'] ?>"
                                    class="bg-[#F4D03F] hover:bg-[#F1C40F] text-[#4A4A4A] font-semibold px-4 py-2 rounded-full text-sm">
                                    Edit
                                </a>
                                <a href="hapus_produk.php?id=<?= $row['product_id'] ?>" onclick="return confirm('Apakah Anda yakin ingin menonaktifkan produk ini? Ini akan menyembunyikannya dari tampilan pelanggan dan tidak dapat dipesan lagi.');"
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
            echo "<p class='text-center text-gray-500 col-span-3'>Belum ada produk aktif tersedia.</p>";
        endif;
        ?>
    </div>
</main>