<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once('navadmin.php');
include_once('db.php');

// Proses update statusnya
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['order_date']) && isset($_POST['user_id']) && isset($_POST['status_order_id'])) {
    $order_date = $_POST['order_date'];
    $user_id = $_POST['user_id'];
    $new_status = $_POST['status_order_id'];

    $stmt = $conn->prepare("UPDATE orders SET status_order_id = ? WHERE user_id = ? AND order_date = ?");
    $stmt->bind_param("iis", $new_status, $user_id, $order_date);
    $stmt->execute();
    $stmt->close();
}
?>

<main class="max-w-screen-xl mx-auto px-4 py-12">
    <h2 class="text-3xl font-bold text-[#D2691E] mb-8 text-center">Riwayat Transaksi</h2>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow-md rounded-lg">
            <thead>
                <tr class="bg-[#F4D03F] text-[#4A4A4A]">
                    <th class="px-6 py-3 text-left">No</th>
                    <th class="px-6 py-3 text-left">Nama Pembeli</th>
                    <th class="px-6 py-3 text-left">Produk</th>
                    <th class="px-6 py-3 text-left">Total Harga</th>
                    <th class="px-6 py-3 text-left">Tanggal Transaksi</th>
                    <th class="px-6 py-3 text-left">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT 
            o.user_id,
            u.name_user,
            o.order_date,
            GROUP_CONCAT(CONCAT(p.product_name, ' (', o.quantity, ')') SEPARATOR ', ') AS products,
            SUM(o.total_price) AS total_price,
            o.status_order_id
            FROM orders o
            JOIN users u ON o.user_id = u.user_id
            JOIN products p ON o.product_id = p.product_id
            GROUP BY o.user_id, o.order_date, o.status_order_id
            ORDER BY o.order_date DESC";
                $result = mysqli_query($conn, $query);
                $no = 1;

                if ($result && mysqli_num_rows($result) > 0):
                    while ($row = mysqli_fetch_assoc($result)):
                        $user_id = $row['user_id'];
                        $order_date = $row['order_date'];
                        
                        // Ambil semua produk dari transaksi
                        $productQuery = $conn->prepare("SELECT p.product_name, o.quantity 
                                                        FROM orders o
                                                        JOIN products p ON o.product_id = p.product_id
                                                        WHERE o.user_id = ? AND o.order_date = ?");
                        $productQuery->bind_param("is", $user_id, $order_date);
                        $productQuery->execute();
                        $productResult = $productQuery->get_result();

                        $productList = [];
                        while ($productRow = $productResult->fetch_assoc()) {
                            $productList[] = $productRow['product_name'] . " (x" . $productRow['quantity'] . ")";
                        }
                        $productQuery->close();
                ?>
                        <tr class="<?= $no % 2 == 0 ? 'bg-gray-100' : 'bg-white' ?>">
                            <td class="px-6 py-4"><?= $no++ ?></td>
                            <td class="px-6 py-4"><?= htmlspecialchars($row['name_user']) ?></td>
                            <td class="px-6 py-4"><?= implode('<br>', $productList) ?></td>
                            <td class="px-6 py-4">Rp<?= number_format($row['total_price'], 0, ',', '.') ?></td>
                            <td class="px-6 py-4"><?= date('d-m-Y H:i:s', strtotime($order_date)) ?></td>
                            <td class="px-6 py-4">
    <form action="update_status.php" method="POST">
        <input type="hidden" name="user_id" value="<?= $row['user_id'] ?>">
        <input type="hidden" name="order_date" value="<?= $row['order_date'] ?>">
        <!-- jenis statusnya -->
        <select name="status_order_id" class="border rounded px-2 py-1 text-sm">
            <option value="0" <?= $row['status_order_id'] == 0 ? 'selected' : '' ?>>Pending</option>
            <option value="1" <?= $row['status_order_id'] == 1 ? 'selected' : '' ?>>Diproses</option>
            <option value="2" <?= $row['status_order_id'] == 2 ? 'selected' : '' ?>>Dikirim</option>
            <option value="3" <?= $row['status_order_id'] == 3 ? 'selected' : '' ?>>Selesai</option>
            <option value="4" <?= $row['status_order_id'] == 4 ? 'selected' : '' ?>>Dibatalkan</option>
        </select>
        
        <button type="submit" class="ml-2 bg-[#D2691E] text-white px-3 py-1 rounded text-sm hover:bg-[#b45c17] transition">Ubah</button>
    </form>
</td>
                        </tr>
                <?php
                    endwhile;
                else:
                    echo "<tr><td colspan='6' class='text-center px-6 py-4'>Tidak ada riwayat transaksi.</td></tr>";
                endif;
                ?>
            </tbody>
        </table>
    </div>
</main>
