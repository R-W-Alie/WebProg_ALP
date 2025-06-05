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


<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Keranjang</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white font-sans">
  <header class="flex items-center justify-between px-6 py-4 border-b">
    <div class="flex items-center space-x-2">
      <img src="logo.png" alt="Logo" class="h-8 w-8" />
    </div>
    <nav class="space-x-6 font-semibold text-sm">
      <a href="#" class="hover:underline">Beranda</a>
      <a href="#" class="hover:underline">Produk</a>
      <a href="#" class="underline">Keranjang</a>
      <a href="#" class="hover:underline">Riwayat Pesanan</a>
    </nav>
  </header>

  <main class="px-6 py-10 max-w-3xl mx-auto">
    <h1 class="text-2xl font-bold text-center text-[#3A2D18] mb-8">Keranjang</h1>
    
    <div class="space-y-6">
      <div class="flex items-center justify-between">
        <div class="flex items-center space-x-4">
          <img src="dark-choco.png" alt="Dark Choco" class="h-20 w-20 rounded-xl border" />
          <div>
            <p class="font-medium">Dark Choco</p>
            <p>Rp 55.000,-</p>
          </div>
        </div>
        <div class="flex items-center border rounded-full px-2 py-1 space-x-2">
          <button>-</button>
          <span>1</span>
          <button>+</button>
        </div>
      </div>

      <div class="flex items-center justify-between">
        <div class="flex items-center space-x-4">
          <img src="mix-cookies.png" alt="Mix Cookies" class="h-20 w-20 rounded-xl border" />
          <div>
            <p class="font-medium">Mix Cookies</p>
            <p>Rp 60.000,-</p>
          </div>
        </div>
        <div class="flex items-center border rounded-full px-2 py-1 space-x-2">
          <button>-</button>
          <span>1</span>
          <button>+</button>
        </div>
      </div>

      <div class="flex items-center justify-between">
        <div class="flex items-center space-x-4">
          <img src="palm-sugar.png" alt="Palm Sugar Choco" class="h-20 w-20 rounded-xl border" />
          <div>
            <p class="font-medium">Palm Sugar Choco</p>
            <p>Rp 55.000,-</p>
          </div>
        </div>
        <div class="flex items-center border rounded-full px-2 py-1 space-x-2">
          <button>-</button>
          <span>1</span>
          <button>+</button>
        </div>
      </div>
    </div>
    <div class="mt-12 bg-[#F9F4EF] p-4 rounded-lg flex items-center justify-between">
      <p class="text-lg font-semibold">Total <span class="font-bold">Rp 170.000,-</span></p>
      <a href="checkout.html" class="bg-yellow-300 text-black px-6 py-2 rounded-xl font-semibold">Checkout</a>
    </div>
  </main>
</body>
</html>
