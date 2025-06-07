<?php
session_start();
require_once("db.php");
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
$user_id = $_SESSION['user_id'];
$sql_addr = "SELECT address FROM users WHERE user_id = ?";
$stmt_addr = $conn->prepare($sql_addr);
$stmt_addr->bind_param("i", $user_id);
$stmt_addr->execute();
$stmt_addr->bind_result($address);
$stmt_addr->fetch();
$stmt_addr->close();
$status_map = [
    0 => 'Pending',
    1 => 'Processing',
    2 => 'Shipped',
    3 => 'Delivered',
    4 => 'Cancelled'
];
$sql_orders = "SELECT DISTINCT order_id, order_date, status_order_id 
            FROM orders 
            WHERE user_id = ? 
            ORDER BY order_date DESC";
$stmt_orders = $conn->prepare($sql_orders);
$stmt_orders->bind_param("i", $user_id);
$stmt_orders->execute();
$orders_result = $stmt_orders->get_result();
?>
<?php include_once('navigation.php'); ?>
<div class="max-w-4xl mx-auto py-10">
    <h1 class="text-3xl font-bold mb-6">Riwayat Pesanan</h1>
    <?php if ($orders_result->num_rows > 0): ?>
        <?php $display_order_number = 1; ?>
        <?php while ($order = $orders_result->fetch_assoc()): ?>
            <div class="bg-white shadow rounded p-6 mb-6">
                <h2 class="text-xl font-semibold mb-2">Order #<?= $display_order_number++ ?></h2>
                <p><strong>Tanggal Pesan:</strong> <?= date('d M Y, H:i', strtotime($order['order_date'])) ?></p>
                <p><strong>Status Pesanan:</strong> <?= $status_map[$order['status_order_id']] ?? 'Unknown' ?></p>
                <p><strong>Alamat Pengiriman:</strong> <?= htmlspecialchars($address) ?></p>
                <h3 class="mt-4 font-semibold">Produk:</h3>
                <ul class="list-disc list-inside">
                    <?php
                    $sql_items = "SELECT p.product_name, o.quantity, o.total_price 
                                FROM orders o 
                                JOIN products p ON o.product_id = p.product_id 
                                WHERE o.order_id = ?";
                    $stmt_items = $conn->prepare($sql_items);
                    $stmt_items->bind_param("i", $order['order_id']);
                    $stmt_items->execute();
                    $items_result = $stmt_items->get_result();
                    while ($item = $items_result->fetch_assoc()):
                    ?>
                        <li><?= htmlspecialchars($item['product_name']) ?> — Qty: <?= $item['quantity'] ?> — Total: Rp<?= number_format($item['total_price'], 0, ',', '.') ?></li>
                    <?php endwhile; ?>
                    <?php $stmt_items->close(); ?>
                </ul>
            </div>
        <?php endwhile; ?>
        <?php $stmt_orders->close(); ?>
    <?php else: ?>
        <p class="text-gray-600">Anda belum melakukan pembelian apapun.</p>
    <?php endif; ?>
</div>
