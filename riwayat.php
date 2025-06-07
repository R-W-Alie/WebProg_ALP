<?php
session_start();
require_once("db.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Ambil alamat pengguna
$sql_addr = "SELECT address FROM users WHERE user_id = ?";
$stmt_addr = $conn->prepare($sql_addr);
$stmt_addr->bind_param("i", $user_id);
$stmt_addr->execute();
$stmt_addr->bind_result($address);
$stmt_addr->fetch();
$stmt_addr->close();

// Status map
$status_map = [
    0 => '🕓 Pending',
    1 => '🔄 Processing',
    2 => '📦 Shipped',
    3 => '✅ Delivered',
    4 => '❌ Cancelled'
];

// Ambil semua order yang sudah di-checkout
$sql = "
    SELECT 
        o.order_date, o.status_order_id, 
        p.product_name, o.quantity, o.total_price
    FROM orders o
    JOIN products p ON o.product_id = p.product_id
    WHERE o.user_id = ? AND o.status_check_id = 1
    ORDER BY o.order_date ASC
";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Group by order_date
$orders = [];
while ($row = $result->fetch_assoc()) {
    $odate = $row['order_date'];
    if (!isset($orders[$odate])) {
        $orders[$odate] = [
            'order_date' => $odate,
            'status_order_id' => $row['status_order_id'],
            'items' => [],
            'total' => 0
        ];
    }
    $orders[$odate]['items'][] = [
        'product_name' => $row['product_name'],
        'quantity' => $row['quantity'],
        'total_price' => $row['total_price']
    ];
    $orders[$odate]['total'] += $row['total_price'];
}
$stmt->close();

$orders = array_reverse($orders); // tampilkan terbaru dulu
$order_display_number = count($orders);
?>

<?php include_once('navigation.php'); ?>

<div class="max-w-5xl mx-auto px-4 py-10">
    <h1 class="text-4xl font-bold mb-8 text-center text-[#4A4A4A]">🧾 Riwayat Pesanan Anda</h1>

    <?php if (!empty($orders)): ?>
        <?php foreach ($orders as $order): ?>
            <section class="bg-white shadow-lg rounded-lg p-6 mb-8 border border-gray-100">
                <div class="flex justify-between items-center mb-3">
                    <h2 class="text-xl font-semibold text-[#D2691E]">Order #<?= $order_display_number-- ?></h2>
                    <span class="text-sm font-medium text-gray-600"><?= $status_map[$order['status_order_id']] ?? '❓ Unknown' ?></span>
                </div>
                <p class="text-sm text-gray-500 mb-2"><strong>Tanggal:</strong> <?= date('d M Y, H:i', strtotime($order['order_date'])) ?></p>
                <p class="text-sm text-gray-500 mb-4"><strong>Alamat Pengiriman:</strong> <?= htmlspecialchars($address) ?></p>
                <div class="border-t pt-4">
                    <h3 class="font-semibold text-gray-700 mb-2">Detail Produk:</h3>
                    <ul class="space-y-2">
                        <?php foreach ($order['items'] as $item): ?>
                            <li class="flex justify-between items-center text-sm text-gray-700">
                                <span><?= htmlspecialchars($item['product_name']) ?> — Qty: <?= $item['quantity'] ?></span>
                                <span class="font-medium text-[#D2691E]">Rp<?= number_format($item['total_price'], 0, ',', '.') ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="border-t mt-4 pt-3 flex justify-end">
                        <span class="text-lg font-bold text-[#D2691E]">Total: Rp<?= number_format($order['total'], 0, ',', '.') ?></span>
                    </div>
                </div>
            </section>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="text-center text-gray-500">
            <p class="text-lg">Belum ada pesanan yang tercatat.</p>
        </div>
    <?php endif; ?>
</div>

<?php include_once('footer.php'); ?>