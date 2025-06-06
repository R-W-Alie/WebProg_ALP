<?php
session_start();
require_once("db.php");
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit;
}
$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'] ?? '';
$sql = "SELECT o.order_id, o.quantity, o.total_price, p.product_name, p.image 
        FROM orders o 
        JOIN products p ON o.product_id = p.product_id 
        WHERE o.user_id = ? AND o.status_check_id = 0";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<?php include_once('navigation.php'); ?>

<div class="max-w-3xl mx-auto py-10">
  <h1 class="text-2xl font-bold mb-6">Keranjang Kamu</h1>
  <?php if ($result->num_rows > 0): ?>
    <div class="space-y-4 mb-6">
      <?php
      $totalBayar = 0;
      while ($row = $result->fetch_assoc()):
        $totalBayar += $row['total_price'];
      ?>
        <div class="bg-white p-4 shadow rounded flex items-center justify-between">
          <div class="flex items-center gap-4">
            <img src="<?= $row['image'] ?>" alt="<?= $row['product_name'] ?>" class="w-16 h-16 rounded object-cover">
            <div>
              <h2 class="text-lg font-semibold"><?= $row['product_name'] ?></h2>
              <div class="flex items-center gap-2 mt-1">
                <a href="ubahJumlah.php?id=<?= $row['order_id'] ?>&action=minus" class="px-2 py-1 bg-gray-200 rounded hover:bg-gray-300">−</a>
                <span class="px-2"><?= $row['quantity'] ?></span>
                <a href="ubahJumlah.php?id=<?= $row['order_id'] ?>&action=plus" class="px-2 py-1 bg-gray-200 rounded hover:bg-gray-300">+</a>
              </div>
              <p class="text-sm mt-1">Total: <span class="font-semibold">Rp<?= number_format($row['total_price'], 0, ',', '.') ?></span></p>
              <a href="hapusKeranjang.php?id=<?= $row['order_id'] ?>"
                onclick="return confirm('Yakin ingin menghapus produk dari keranjang?')"
                class="text-red-600 text-sm font-semibold hover:underline mt-2 inline-block">
                Hapus
              </a>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
    <div class="flex justify-between items-center mt-6 border-t pt-4">
      <p class="text-xl font-semibold">Total Bayar: Rp<?= number_format($totalBayar, 0, ',', '.') ?></p>
      <a href="checkout.php"
        class="bg-[#F4D03F] hover:bg-[#F1C40F] text-[#4A4A4A] font-semibold px-6 py-2 rounded-full transition-transform hover:-translate-y-1">
        Checkout Sekarang
      </a>
    </div>
  <?php else: ?>
    <p class="text-gray-500">Keranjangmu masih kosong.</p>
  <?php endif; ?>
</div>
</body>
</html>