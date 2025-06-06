<?php
session_start();
require_once("db.php");

if (!isset($_SESSION['user_id']) || !isset($_GET['id'])) {
    header("Location: cart.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$order_id = intval($_GET['id']);

// Only delete if the order belongs to the user and is not yet checked out
$stmt = $conn->prepare("DELETE FROM orders WHERE order_id = ? AND user_id = ? AND status_check_id = 0");
$stmt->bind_param("ii", $order_id, $user_id);
$stmt->execute();

header("Location: cart.php");
exit;
?>
