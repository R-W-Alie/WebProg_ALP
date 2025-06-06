<?php
session_start();
require_once("db.php");
if (!isset($_SESSION['user_id']) || !isset($_GET['id']) || !isset($_GET['action'])) {
    header("Location: cart.php");
    exit;
}
$user_id = $_SESSION['user_id'];
$order_id = intval($_GET['id']);
$action = $_GET['action'];
$stmt = $conn->prepare("SELECT quantity FROM orders WHERE order_id = ? AND user_id = ? AND status_check_id = 0");
$stmt->bind_param("ii", $order_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();
$order = $result->fetch_assoc();
if ($order) {
    $quantity = $order['quantity'];
    if ($action === 'plus') {
        $quantity++;
    } elseif ($action === 'minus' && $quantity > 1) {
        $quantity--;
    }
    $stmt = $conn->prepare("UPDATE orders o JOIN products p ON o.product_id = p.product_id 
                            SET o.quantity = ?, o.total_price = ? * ? 
                            WHERE o.order_id = ? AND o.user_id = ?");
    $stmt->bind_param("iiiii", $quantity, $price, $quantity, $order_id, $user_id);
    $getPrice = $conn->prepare("SELECT p.price FROM orders o JOIN products p ON o.product_id = p.product_id 
                                WHERE o.order_id = ? AND o.user_id = ?");
    $getPrice->bind_param("ii", $order_id, $user_id);
    $getPrice->execute();
    $price = $getPrice->get_result()->fetch_assoc()['price'];
    $stmt->bind_param("iiiii", $quantity, $price, $quantity, $order_id, $user_id);
    $stmt->execute();
}
header("Location: cart.php");
exit;
?>