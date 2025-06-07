<?php
// BAGIAN 2: LOGIKA PHP YANG SUDAH DIPERBAIKI
session_start();
include_once('db.php');

$message = ''; // Variabel untuk menyimpan pesan notifikasi

// Cek apakah form telah disubmit dengan metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // 1. Ambil data dari form
    $product_name = $_POST['product_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    
    $uploadOk = 1; // Kita anggap proses akan berhasil
    $image_path_for_db = ''; // Path default jika tidak ada gambar

    // 2. Lakukan validasi upload gambar
    // Pastikan file dipilih dan tidak ada error
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $target_dir = "image/"; // Pastikan folder ini ada dan bisa ditulisi (writable)
        
        // Buat nama file unik untuk menghindari menimpa file lama
        $image_name = date("YmdHis") . "_" . basename($_FILES["image"]["name"]);
        $target_file = $target_dir . $image_name;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Cek apakah file adalah gambar asli
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check === false) {
            $message = "File yang diupload bukan gambar.";
            $uploadOk = 0;
        }

        // Izinkan hanya format tertentu
        $allowed_types = ["jpg", "png", "jpeg", "gif"];
        if (!in_array($imageFileType, $allowed_types)) {
            $message = "Maaf, hanya format JPG, JPEG, PNG & GIF yang diizinkan.";
            $uploadOk = 0;
        }

        // Jika validasi lolos, coba pindahkan file
        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                // Jika upload berhasil, simpan path-nya untuk database
                $image_path_for_db = $target_file;
            } else {
                $message = "Gagal memindahkan file yang diupload. Pastikan folder 'image/' ada dan writable.";
                $uploadOk = 0;
            }
        }

    } else {
        // Jika tidak ada file yang diupload atau terjadi error
        $message = "Gambar produk wajib diisi.";
        $uploadOk = 0;
    }

    // 3. Simpan ke database HANYA JIKA SEMUA PROSES DI ATAS BERHASIL
    if ($uploadOk == 1) {
        $stmt = $conn->prepare("INSERT INTO products (product_name, description, price, stock, image) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssiis", $product_name, $description, $price, $stock, $image_path_for_db);

        if ($stmt->execute()) {
            $_SESSION['success_message'] = "Produk baru berhasil ditambahkan!";
            // Mengarahkan ke halaman adminproduk.php sesuai permintaan Anda
            header("Location: adminproduk.php"); 
            exit;
        } else {
            $message = "Gagal menyimpan produk ke database: " . $stmt->error;
        }
        $stmt->close();
    }
    // Jika $uploadOk bernilai 0, maka halaman akan ditampilkan kembali bersama pesan error di variabel $message
}
?>

<?php include_once('navadmin.php'); ?>

<main class="max-w-2xl mx-auto px-4 py-10">
    <h2 class="text-3xl font-bold text-[#D2691E] mb-6 text-center">Tambah Produk Baru</h2>

    <?php if (!empty($message)): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline"><?= htmlspecialchars($message); ?></span>
        </div>
    <?php endif; ?>

    <form action="tambah_produk.php" method="post" enctype="multipart/form-data" class="bg-white p-8 rounded-xl shadow-md space-y-5">
        
        <div>
            <label for="product_name" class="block text-sm font-semibold text-gray-700 mb-1">Nama Produk</label>
            <input type="text" name="product_name" id="product_name" required
                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#D2691E] focus:border-[#D2691E]">
        </div>

        <div>
            <label for="description" class="block text-sm font-semibold text-gray-700 mb-1">Deskripsi</label>
            <textarea name="description" id="description" rows="4" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#D2691E] focus:border-[#D2691E]"></textarea>
        </div>

        <div>
            <label for="price" class="block text-sm font-semibold text-gray-700 mb-1">Harga (Rp)</label>
            <input type="number" name="price" id="price" required min="0" placeholder="Contoh: 50000"
                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#D2691E] focus:border-[#D2691E]">
        </div>

        <div>
            <label for="stock" class="block text-sm font-semibold text-gray-700 mb-1">Stok</label>
            <input type="number" name="stock" id="stock" required min="0" placeholder="Contoh: 100"
                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#D2691E] focus:border-[#D2691E]">
        </div>

        <div>
            <label for="image" class="block text-sm font-semibold text-gray-700 mb-1">Gambar Produk</label>
            <input type="file" name="image" id="image" required accept="image/png, image/jpeg, image/jpg, image/gif"
                class="w-full text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-[#F4D03F] file:text-[#4A4A4A] hover:file:bg-[#F1C40F]">
        </div>

        <div>

            <button type="submit" class="w-full bg-[#D2691E] hover:bg-[#A0522D] text-white font-bold py-3 px-4 rounded-md focus:outline-none focus:shadow-outline transition duration-300 text-lg">
                Simpan Produk
            </button>
        </div>

    </form>
</main>

<?php include_once('footer.php'); ?>