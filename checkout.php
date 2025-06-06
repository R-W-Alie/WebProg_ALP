<?php
session_start();
require_once("db.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Update all user's current cart items to mark as "checked out"
$checkout = $conn->prepare("UPDATE orders SET status_check_id = 1 WHERE user_id = ? AND status_check_id = 0");
$checkout->bind_param("i", $user_id);
$checkout->execute();
$checkout->close();
?>

<?php include_once('navigation.php'); ?>

<div class="max-w-xl mx-auto py-12 text-center">
    <h1 class="text-3xl font-bold text-green-600 mb-4">Checkout Berhasil!</h1>
    <p class="text-gray-700 mb-6">Terima kasih sudah berbelanja di <strong>Sri'Cookies</strong>. Pesananmu sedang diproses.</p>
    <a href="produk.php" class="inline-block bg-[#D2691E] text-white px-5 py-2 rounded-full hover:bg-[#B65C1A] transition">Belanja Lagi</a>
</div>
</body>

</html>