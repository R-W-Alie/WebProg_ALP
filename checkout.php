<?php
session_start();
require_once("db.php"); // Already handles timezone configuration

// Authentication check
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Get cart items
$sql = "SELECT o.order_id, o.product_id, o.quantity, o.total_price, p.product_name, p.price 
        FROM orders o
        JOIN products p ON o.product_id = p.product_id
        WHERE o.user_id = ? AND o.status_check_id = 0";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$cart_items = [];
$total = 0;
while ($row = $result->fetch_assoc()) {
    $cart_items[] = $row;
    $total += $row['total_price'];
}
$stmt->close();

if (empty($cart_items)) {
    header("Location: cart.php");
    exit;
}

// Process checkout (timezone already set in db.php)
$order_date = date("Y-m-d H:i:s");
$display_date = date('l, j F Y H:i', strtotime($order_date)) . ' WIB'; // Human-readable format

$update = $conn->prepare("UPDATE orders SET status_check_id = 1, order_date = ? WHERE user_id = ? AND status_check_id = 0");
$update->bind_param("si", $order_date, $user_id);
$update->execute();
$update->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Success - Sri'Cookies</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <?php include_once('navigation.php'); ?>

    <div class="max-w-2xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <!-- Success Card -->
        <div class="bg-white shadow-md rounded-lg p-8 mb-8 border-l-4 border-green-500">
            <div class="text-center">
                <svg class="mx-auto h-12 w-12 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <h1 class="text-3xl font-bold text-gray-900 mt-4">Checkout Successful!</h1>
                <p class="mt-2 text-gray-600">Thank you for your order #<?= substr(md5($order_date), 0, 8) ?></p>
                <p class="text-gray-500 text-sm mt-1"><?= $display_date ?></p>
            </div>

            <!-- Order Summary -->
            <div class="mt-8 border-t pt-6">
                <h2 class="text-lg font-medium text-gray-900">Order Summary</h2>
                <div class="mt-4 space-y-4">
                    <?php foreach ($cart_items as $item): ?>
                    <div class="flex justify-between">
                        <div>
                            <p class="text-gray-600"><?= htmlspecialchars($item['product_name']) ?> × <?= $item['quantity'] ?></p>
                            <p class="text-sm text-gray-500">@ Rp <?= number_format($item['price'], 0, ',', '.') ?></p>
                        </div>
                        <p class="text-gray-900">Rp <?= number_format($item['total_price'], 0, ',', '.') ?></p>
                    </div>
                    <?php endforeach; ?>
                </div>

                <div class="mt-6 border-t pt-4 flex justify-between">
                    <p class="text-lg font-medium">Total</p>
                    <p class="text-lg font-bold">Rp <?= number_format($total, 0, ',', '.') ?></p>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="mt-8 flex flex-col sm:flex-row justify-center gap-4">
                <a href="produk.php" class="px-6 py-3 bg-[#D2691E] text-white rounded-md hover:bg-[#B65C1A] transition text-center">
                    Continue Shopping
                </a>
                <a href="riwayat.php" class="px-6 py-3 border border-gray-300 rounded-md hover:bg-gray-50 transition text-center">
                    View Orders
                </a>
            </div>
        </div>
    </div>
</body>
</html>