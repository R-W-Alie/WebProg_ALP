<?php
session_start();
require_once("db.php"); // Pastikan file ini sudah mengatur timezone

// Cek autentikasi pengguna
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

$sql_get_items = "SELECT o.order_id, o.product_id, o.quantity, p.product_name, p.price, o.total_price 
                    FROM orders o
                    JOIN products p ON o.product_id = p.product_id
                    WHERE o.user_id = ? AND o.status_check_id = 0";
$stmt_get_items = $conn->prepare($sql_get_items);
$stmt_get_items->bind_param("i", $user_id);
$stmt_get_items->execute();
$result_items = $stmt_get_items->get_result();
$items_to_checkout = $result_items->fetch_all(MYSQLI_ASSOC);
$stmt_get_items->close();

// Jika tidak ada item di keranjang, hentikan proses
if (empty($items_to_checkout)) {
    header("Location: keranjang.php"); // Arahkan ke halaman keranjang
    exit;
}

foreach ($items_to_checkout as $item) {
    $product_id = $item['product_id'];
    $quantity_ordered = $item['quantity'];

    $sql_update_stock = "UPDATE products SET stock = stock - ? WHERE product_id = ?";
    $stmt_update_stock = $conn->prepare($sql_update_stock);
    $stmt_update_stock->bind_param("ii", $quantity_ordered, $product_id);
    $stmt_update_stock->execute();
    $stmt_update_stock->close();
}

// Biarkan database yang mengisi waktu dengan fungsi NOW() untuk akurasi terbaik
$update_order = $conn->prepare("UPDATE orders SET status_check_id = 1, order_date = NOW() WHERE user_id = ? AND status_check_id = 0");
$update_order->bind_param("i", $user_id);
$update_order->execute();
$update_order->close();

// Menyiapkan data untuk ditampilkan di halaman sukses
$total = 0;
foreach ($items_to_checkout as $item) {
    $total += $item['total_price'];
}
$display_date = date('l, j F Y H:i') . ' WIB';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Success - Sri'Cookies</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

    <?php include_once('navigation.php'); ?>

    <div class=" max-w-2xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
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
                <a href="produk.php" class="px-6 py-3 bg-[#F1C40F] text-white rounded-md hover:bg-[#F4D03F] transition text-center">
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