<?php
session_start();
require_once("db.php");

// Cek apakah user adalah admin
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $order_date = $_POST['order_date'];
    $user_id = $_POST['user_id'];
    $status_check_id = $_POST['status_check_id'];

    if (!empty($order_date) && !empty($user_id) && isset($status_check_id)) {
        // Update semua item dalam satu transaksi (berdasarkan user dan waktu order)
        $sql = "UPDATE orders SET status_check_id = ? WHERE user_id = ? AND order_date = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iis", $status_check_id, $user_id, $order_date);

        if ($stmt->execute()) {
            $_SESSION['message'] = "Status pesanan berhasil diperbarui!";
        } else {
            $_SESSION['message'] = "Gagal memperbarui status: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $_SESSION['message'] = "Data tidak lengkap untuk melakukan update.";
    }

    header("Location: riwayat_transaksi_admin.php");
    exit;

} else {
    header("Location: riwayat_transaksi_admin.php");
    exit;
}
?>
