<?php
session_start();
require_once("db.php");

if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit;
}

$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'] ?? '';

$sql = "SELECT o.quantity, o.total_price, p.product_name, p.image 
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
  <h1 class="text-2xl font-bold mb-4">Your Cart</h1>
  <?php if ($result->num_rows > 0): ?>
    <div class="space-y-4">
      <?php while ($row = $result->fetch_assoc()): ?>
        <div class="bg-white p-4 shadow rounded flex items-center justify-between">
          <div class="flex items-center gap-4">
            <img src="<?= $row['image'] ?>" alt="<?= $row['product_name'] ?>" class="w-16 h-16 rounded object-cover">
            <div>
              <h2 class="text-lg font-semibold"><?= $row['product_name'] ?></h2>
              <p>Qty: <?= $row['quantity'] ?> | Total: Rp<?= number_format($row['total_price']) ?></p>
            </div>
          </div>
          <button class="text-red-600 font-bold hover:underline">Remove</button>
        </div>
      <?php endwhile; ?>
    </div>
  <?php else: ?>
    <p class="text-gray-500">Your cart is empty.</p>
  <?php endif; ?>
</div>
</body>

</html>