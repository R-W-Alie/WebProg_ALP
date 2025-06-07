<?php
session_start();
require_once("db.php");

// Pastikan hanya admin yang bisa mengakses
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $order_date = $_POST['order_date'];
    $user_id = $_POST['user_id'];
    $status_order_id = $_POST['status_order_id'];

    // Validasi data
    if (!empty($order_date) && !empty($user_id) && isset($status_order_id)) {
        
        // Siapkan kueri UPDATE
        // Kita mengupdate semua item yang memiliki order_date dan user_id yang sama
        $sql = "UPDATE order_items SET status_order_id = ? WHERE user_id = ? AND order_date = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iis", $status_order_id, $user_id, $order_date);

        if ($stmt->execute()) {
            $_SESSION['message'] = "Status pesanan berhasil diperbarui!";
        } else {
            $_SESSION['message'] = "Gagal memperbarui status: " . $stmt->error;
        }
        $stmt->close();

    } else {
        $_SESSION['message'] = "Data tidak lengkap untuk melakukan update.";
    }

    // Arahkan kembali ke halaman manajemen transaksi
    header("Location: riwayat_transaksi_admin.php"); // Ganti dengan nama file riwayat admin Anda
    exit;

} else {
    // Jika diakses tanpa metode POST, redirect saja
    header("Location: riwayat_transaksi_admin.php"); // Ganti dengan nama file riwayat admin Anda
    exit;
}
?>