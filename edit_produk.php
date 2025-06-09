<?php
session_start();
include_once('db.php'); 

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header("Location: login.php");
    exit;
}

$product_id = null;
$product = null;
$error_message = '';
$success_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil semua data dari form
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $current_image = $_POST['current_image']; // Ambil  gambar lama

    $image_path = $current_image; // Defaultnya pakai gambar lama
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $upload_dir = 'image/'; 
        $image_name = time() . '_' . basename($_FILES['image']['name']);
        $target_file = $upload_dir . $image_name;

        // Pindahkan file baru ke folder image
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            $image_path = $target_file;
            if ($current_image && file_exists($current_image)) {
                unlink($current_image);
            }
        } else {
            $error_message = "Gagal mengupload gambar baru.";
        }
    }

    // Update data ke database 
    if (empty($error_message)) {
        $stmt = $conn->prepare("UPDATE products SET product_name = ?, description = ?, price = ?, stock = ?, image = ? WHERE product_id = ?");
        $stmt->bind_param("ssiisi", $product_name, $description, $price, $stock, $image_path, $product_id);
        
        if ($stmt->execute()) {
            $success_message = "Produk berhasil diperbarui!";
        } else {
            $error_message = "Gagal memperbarui produk: " . $stmt->error;
        }
        $stmt->close();
    }
}

$product_id = $_GET['id'] ?? $product_id;

if ($product_id) {
    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        die("Produk tidak ditemukan.");
    }
    $stmt->close();
} else {
    die("ID Produk tidak valid.");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk - <?= htmlspecialchars($product['product_name']) ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <div class="container mx-auto p-8">
        <div class="bg-white p-8 rounded-lg shadow-lg max-w-2xl mx-auto">
            <h1 class="text-2xl font-bold mb-6">Edit Produk</h1>

            <?php if ($success_message): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <?= $success_message ?> <a href="adminproduk.php" class="font-bold underline">Kembali ke Daftar Produk</a>
                </div>
            <?php endif; ?>
            <?php if ($error_message): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <?= $error_message ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="edit_produk.php?id=<?= $product['product_id'] ?>" enctype="multipart/form-data">
                <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">
                <input type="hidden" name="current_image" value="<?= htmlspecialchars($product['image']) ?>">

                <div class="mb-4">
                    <label for="product_name" class="block text-gray-700 font-bold mb-2">Nama Produk</label>
                    <input type="text" name="product_name" id="product_name" value="<?= htmlspecialchars($product['product_name']) ?>" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
                
                <div class="mb-4">
                    <label for="description" class="block text-gray-700 font-bold mb-2">Deskripsi</label>
                    <textarea name="description" id="description" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required><?= htmlspecialchars($product['description']) ?></textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="price" class="block text-gray-700 font-bold mb-2">Harga (Rp)</label>
                        <input type="number" name="price" id="price" value="<?= $product['price'] ?>" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>
                    <div>
                        <label for="stock" class="block text-gray-700 font-bold mb-2">Stok</label>
                        <input type="number" name="stock" id="stock" value="<?= $product['stock'] ?>" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>
                </div>

                <div class="mb-6">
                    <label for="image" class="block text-gray-700 font-bold mb-2">Ganti Gambar Produk (Opsional)</label>
                    <p class="text-sm text-gray-600 mb-2">Gambar saat ini: <img src="<?= htmlspecialchars($product['image']) ?>" alt="Current Image" class="w-20 h-20 object-cover inline-block ml-2 rounded"></p>
                    <input type="file" name="image" id="image" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengganti gambar.</p>
                </div>

                <div class="flex items-center justify-end">
                    <a href="adminproduk.php" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mr-2">
                        Batal
                    </a>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>