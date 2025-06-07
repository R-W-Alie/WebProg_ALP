<?php
// Panggil navigasi di PALING ATAS. File ini sudah menjalankan session_start().
include_once('navigation.php'); 
require_once("db.php");

// Cek autentikasi
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Ambil data lengkap pengguna dari database
$stmt = $conn->prepare("SELECT name_user, email, no_hp, address FROM users WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

if (!$user) {
    die("Pengguna tidak ditemukan.");
}
?>

<main class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100">
        <h1 class="text-3xl font-serif font-bold text-amber-900 mb-2 text-center">Profil Saya</h1>
        <p class="text-center text-stone-600 mb-8">Lihat dan kelola informasi personal Anda di sini.</p>

        <?php if (isset($_SESSION['success_message'])): ?>
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md" role="alert">
                <p><?= $_SESSION['success_message']; ?></p>
            </div>
            <?php unset($_SESSION['success_message']); ?>
        <?php endif; ?>

        <div class="space-y-6">
            <div class="flex items-center"><label class="w-1/3 text-gray-500 font-semibold">Nama Lengkap</label><p class="w-2/3 text-gray-800"><?= htmlspecialchars($user['name_user']) ?></p></div>
            <div class="flex items-center"><label class="w-1/3 text-gray-500 font-semibold">Email</label><p class="w-2/3 text-gray-800"><?= htmlspecialchars($user['email']) ?></p></div>
            <div class="flex items-center"><label class="w-1/3 text-gray-500 font-semibold">Nomor Telepon</label><p class="w-2/3 text-gray-800"><?= htmlspecialchars($user['no_hp'] ?? 'Belum diatur') ?></p></div>
            <div class="flex items-start"><label class="w-1/3 text-gray-500 font-semibold">Alamat</label><p class="w-2/3 text-gray-800"><?= nl2br(htmlspecialchars($user['address'] ?? 'Belum diatur')) ?></p></div>
        </div>

        <div class="mt-8 border-t pt-6">
            <a href="edit_profile.php" class="w-full text-center block bg-[#F4D03F] hover:bg-[#F1C40F] text-[#4A4A4A] font-semibold px-5 py-3 rounded-lg transition-transform hover:scale-[1.02]">
                Ubah Profil
            </a>
        </div>
    </div>
</main>

