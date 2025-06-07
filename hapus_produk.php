<?php
session_start();
include_once('db.php');

// Pastikan hanya admin yang bisa mengakses (sesuaikan dengan session login Anda)
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header("Location: login.php");
    exit;
}

// 1. Cek apakah ada ID yang dikirimkan melalui URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    
    $product_id = $_GET['id'];

    // 2. (Opsional tapi sangat direkomendasikan) Ambil path gambar sebelum menghapus data
    //    Ini agar kita bisa menghapus file gambarnya juga dari server
    $stmt_select = $conn->prepare("SELECT image FROM products WHERE product_id = ?");
    $stmt_select->bind_param("i", $product_id);
    $stmt_select->execute();
    $result_select = $stmt_select->get_result();
    
    if ($row = $result_select->fetch_assoc()) {
        $image_path = $row['image'];
    }
    $stmt_select->close();


    // 3. Siapkan dan jalankan kueri DELETE
    $stmt_delete = $conn->prepare("DELETE FROM products WHERE product_id = ?");
    $stmt_delete->bind_param("i", $product_id);

    // Jalankan kueri delete
    if ($stmt_delete->execute()) {
        // Jika penghapusan dari database berhasil, hapus juga file gambarnya
        if (!empty($image_path) && file_exists($image_path)) {
            unlink($image_path); // Perintah untuk menghapus file
        }

        // Set pesan sukses dan arahkan kembali ke halaman daftar produk
        $_SESSION['success_message'] = "Produk berhasil dihapus!";
    } else {
        // Jika gagal, set pesan error
        $_SESSION['error_message'] = "Gagal menghapus produk: " . $stmt_delete->error;
    }
    
    $stmt_delete->close();

} else {
    // Jika tidak ada ID yang dikirim, set pesan error
    $_SESSION['error_message'] = "ID Produk tidak valid.";
}

// 4. Arahkan kembali ke halaman daftar produk admin
header("Location: adminproduk.php");
exit;
?>