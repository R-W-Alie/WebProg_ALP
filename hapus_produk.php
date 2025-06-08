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

    // Kita tidak lagi menghapus baris produk, melainkan mengubah statusnya menjadi tidak aktif.
    // Ini menjaga data riwayat pesanan tetap utuh.
    
    // Siapkan dan jalankan kueri UPDATE untuk soft delete
    $stmt_update = $conn->prepare("UPDATE products SET is_active = FALSE WHERE product_id = ?");
    $stmt_update->bind_param("i", $product_id);

    // Jalankan kueri update
    if ($stmt_update->execute()) {
        // Jika pembaruan database berhasil (produk dinonaktifkan)
        // Set pesan sukses dan arahkan kembali ke halaman daftar produk
        $_SESSION['success_message'] = "Produk berhasil dinonaktifkan (disembunyikan dari pelanggan)!";
    } else {
        // Jika gagal, set pesan error
        $_SESSION['error_message'] = "Gagal menonaktifkan produk: " . $stmt_update->error;
    }
    
    $stmt_update->close();

} else {
    // Jika tidak ada ID yang dikirim, set pesan error
    $_SESSION['error_message'] = "ID Produk tidak valid.";
}

// Arahkan kembali ke halaman daftar produk admin
header("Location: adminproduk.php");
exit;
?>