<?php
session_start();
require_once("db.php");

// mengecek yang login, apakah admin
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header("Location: login.php");
    exit;
}

// Pastikan metode request adalah POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Ambil data dari form 
    $order_date = $_POST['order_date'];
    $user_id = $_POST['user_id'];
    $new_status = $_POST['status_order_id']; // Mengambil data dari input 

    // Validasi data 
    if (!empty($order_date) && !empty($user_id) && isset($new_status)) {
        
        // update status order di db
        $sql = "UPDATE orders SET status_order_id = ? WHERE user_id = ? AND order_date = ?";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iis", $new_status, $user_id, $order_date);

        if ($stmt->execute()) {
            $_SESSION['message'] = "Status pesanan berhasil diperbarui!";
        } else {
            $_SESSION['message'] = "Gagal memperbarui status: " . $stmt->error;
        }
        $stmt->close();
        
    } else {
        $_SESSION['message'] = "Data tidak lengkap untuk melakukan update.";
    }

    // kembali ke riwayat admin
    header("Location: adminriwayat.php");
    exit;

} else {
    // Jika halaman diakses langsung, redirect saja
    header("Location: adminriwayat.php");
    exit;
}
?>