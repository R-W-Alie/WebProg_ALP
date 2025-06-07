<?php
session_start();
require_once("db.php");
if (!isset($_SESSION['user_id']) || !isset($_GET['id'])) {
    header("Location: produk.php");
    exit;
}
$user_id = $_SESSION['user_id'];
$product_id = intval($_GET['id']);
$stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
$stmt->bind_param("i", $product_id);
$stmt->execute();
$product = $stmt->get_result()->fetch_assoc();
if (!$product) {
    header("Location: produk.php");
    exit;
}
$quantity = 1;
$total_price = $product['price'] * $quantity;
$check_stmt = $conn->prepare("SELECT order_id, quantity FROM orders WHERE user_id = ? AND product_id = ? AND status_check_id = 0");
$check_stmt->bind_param("ii", $user_id, $product_id);
$check_stmt->execute();
$existing = $check_stmt->get_result()->fetch_assoc();

if ($existing) {
    $new_qty = $existing['quantity'] + 1;
    $new_total = $product['price'] * $new_qty;
    $update_stmt = $conn->prepare("UPDATE orders SET quantity = ?, total_price = ? WHERE order_id = ?");
    $update_stmt->bind_param("idi", $new_qty, $new_total, $existing['order_id']);
    $update_stmt->execute();
} else {
    $status_order_id = 1;
    $insert_stmt = $conn->prepare("INSERT INTO orders (user_id, product_id, quantity, total_price, status_check_id, status_order_id, order_date) VALUES (?, ?, ?, ?, 0, ?, NOW())");
    $insert_stmt->bind_param("iiidi", $user_id, $product_id, $quantity, $total_price, $status_order_id);
    $insert_stmt->execute();
}
header("Location: cart.php");
exit;
