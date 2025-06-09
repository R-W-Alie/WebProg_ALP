<?php
session_start();
include_once('db.php'); // Pastikan koneksi database Anda benar

// Cek apakah admin sudah login (sesuaikan dengan logika Anda)
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header("Location: login.php");
    exit;
}

// Cek apakah ada ID yang dikirimkan melalui URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    
    $product_id = $_GET['id'];

    
    $stmt_update = $conn->prepare("UPDATE products SET is_active = FALSE WHERE product_id = ?");
    $stmt_update->bind_param("i", $product_id);

    // update status produk
    if ($stmt_update->execute()) {
        
        $_SESSION['success_message'] = "Produk berhasil dinonaktifkan (disembunyikan dari pelanggan)!";
    } else {
        $_SESSION['error_message'] = "Gagal menonaktifkan produk: " . $stmt_update->error;
    }
    
    $stmt_update->close();

} else {
    $_SESSION['error_message'] = "ID Produk tidak valid.";
}

// Arahkan kembali ke halaman daftar produk admin
header("Location: adminproduk.php");
exit;
?>