<?php
session_start();
require_once("db.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Ambil semua item dari "keranjang" di tabel orders dengan status_check_id = 0 (belum checkout)
$sql = "SELECT order_id, product_id, quantity, total_price FROM orders WHERE user_id = ? AND status_check_id = 0";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$cart_items = [];
while ($row = $result->fetch_assoc()) {
    $cart_items[] = $row;
}
$stmt->close();

if (empty($cart_items)) {
    header("Location: cart.php");
    exit;
}

// Tandai semua item ini sudah checkout (status_check_id = 1) dan update tanggal order
$order_date = date("Y-m-d H:i:s");
$update = $conn->prepare("UPDATE orders SET status_check_id = 1, order_date = ? WHERE user_id = ? AND status_check_id = 0");
$update->bind_param("si", $order_date, $user_id);
$update->execute();
$update->close();
?>

<?php include_once('navigation.php'); ?>
<div class="max-w-xl mx-auto py-12 text-center">
    <h1 class="text-3xl font-bold text-green-600 mb-4">Checkout Berhasil!</h1>
    <p class="text-gray-700 mb-6">Terima kasih sudah berbelanja di <strong>Sri'Cookies</strong>. Pesananmu sedang diproses.</p>
    <a href="produk.php" class="inline-block bg-[#D2691E] text-white px-5 py-2 rounded-full hover:bg-[#B65C1A] transition">Belanja Lagi</a>
</div>
</body>
</html>
