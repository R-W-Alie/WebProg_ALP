<?php
session_start();
require_once("db.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Ambil semua item dari keranjang
$sql = "SELECT c.product_id, c.quantity, p.price 
        FROM cart c 
        JOIN products p ON c.product_id = p.product_id 
        WHERE c.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$cart_items = [];
while ($row = $result->fetch_assoc()) {
    $total_price = $row['quantity'] * $row['price'];
    $cart_items[] = [
        'product_id' => $row['product_id'],
        'quantity' => $row['quantity'],
        'total_price' => $total_price
    ];
}
$stmt->close();

if (empty($cart_items)) {
    header("Location: cart.php");
    exit;
}

// Gunakan satu waktu untuk semua item
$order_date = date("Y-m-d H:i:s");

foreach ($cart_items as $item) {
    $stmt = $conn->prepare("INSERT INTO orders 
        (user_id, product_id, quantity, total_price, order_date, status_order_id, status_check_id) 
        VALUES (?, ?, ?, ?, ?, 0, 1)");
    $stmt->bind_param("iiids", $user_id, $item['product_id'], $item['quantity'], $item['total_price'], $order_date);
    $stmt->execute();
    $stmt->close();
}

// Kosongkan keranjang
$delete = $conn->prepare("DELETE FROM cart WHERE user_id = ?");
$delete->bind_param("i", $user_id);
$delete->execute();
$delete->close();
?>

<?php include_once('navigation.php'); ?>
<div class="max-w-xl mx-auto py-12 text-center">
    <h1 class="text-3xl font-bold text-green-600 mb-4">Checkout Berhasil!</h1>
    <p class="text-gray-700 mb-6">Terima kasih sudah berbelanja di <strong>Sri'Cookies</strong>. Pesananmu sedang diproses.</p>
    <a href="produk.php" class="inline-block bg-[#D2691E] text-white px-5 py-2 rounded-full hover:bg-[#B65C1A] transition">Belanja Lagi</a>
</div>
</body>

</html>