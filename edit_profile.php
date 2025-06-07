<?php
// Panggil navigasi di PALING ATAS.
include_once('navigation.php');
require_once("db.php");

// Cek autentikasi
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$message = '';

// Proses UPDATE jika form disubmit (metode POST)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Ambil semua data dari form, termasuk password baru
    $name_user = $_POST['name_user'];
    $email = $_POST['email'];
    $no_hp = $_POST['no_hp'];
    $address = $_POST['address'];
    $new_password = $_POST['new_password'];

    // 2. Cek apakah pengguna memasukkan password baru
    if (!empty($new_password)) {
        // --- JIKA ADA PASSWORD BARU ---
        
        // 3. Hash password baru untuk keamanan
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // 4. Siapkan kueri UPDATE untuk semua data TERMASUK password
        $stmt = $conn->prepare("UPDATE users SET name_user = ?, email = ?, no_hp = ?, address = ?, password = ? WHERE user_id = ?");
        $stmt->bind_param("sssssi", $name_user, $email, $no_hp, $address, $hashed_password, $user_id);

    } else {
        // --- JIKA TIDAK ADA PASSWORD BARU ---
        
        // 4. Siapkan kueri UPDATE hanya untuk data personal, TANPA password
        $stmt = $conn->prepare("UPDATE users SET name_user = ?, email = ?, no_hp = ?, address = ? WHERE user_id = ?");
        $stmt->bind_param("ssssi", $name_user, $email, $no_hp, $address, $user_id);
    }

    // 5. Eksekusi kueri dan arahkan kembali ke halaman profil
    if ($stmt->execute()) {
        $_SESSION['user_name'] = $name_user; // Update nama di session juga
        $_SESSION['success_message'] = "Profil berhasil diperbarui!";
        header("Location: profile.php");
        exit;
    } else {
        $message = "Gagal memperbarui profil: " . $stmt->error;
    }
    $stmt->close();
}

// Ambil data pengguna saat ini untuk ditampilkan di form
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
    <form action="edit_profile.php" method="POST" class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100">
        <h1 class="text-3xl font-serif font-bold text-amber-900 mb-8 text-center">Edit Profil</h1>

        <?php if (!empty($message)): ?>
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-md" role="alert">
                <p><?= $message; ?></p>
            </div>
        <?php endif; ?>

        <div class="space-y-6">
            <div><label for="name_user" class="block text-sm font-semibold text-gray-700 mb-1">Nama Lengkap</label><input type="text" name="name_user" id="name_user" value="<?= htmlspecialchars($user['name_user']) ?>" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500"></div>
            <div><label for="email" class="block text-sm font-semibold text-gray-700 mb-1">Email</label><input type="email" name="email" id="email" value="<?= htmlspecialchars($user['email']) ?>" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500"></div>
            <div><label for="no_hp" class="block text-sm font-semibold text-gray-700 mb-1">Nomor Telepon</label><input type="tel" name="no_hp" id="no_hp" value="<?= htmlspecialchars($user['no_hp']) ?>" placeholder="Contoh: 08123456789" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500"></div>
            <div><label for="address" class="block text-sm font-semibold text-gray-700 mb-1">Alamat</label><textarea name="address" id="address" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500"><?= htmlspecialchars($user['address']) ?></textarea></div>
        </div>

        <h2 class="text-xl font-semibold text-amber-800">Ubah Password (Opsional)</h2>


        <div>
    <label for="new_password" class="block text-sm font-semibold text-gray-700 mb-1">Password Baru</label>
    <input type="password" name="new_password" id="new_password"
        placeholder="Masukkan password baru"
        class="w-full px-4 py-2 border border-gray-300 rounded-lg">
</div>



        <div class="mt-8 pt-6 border-t flex items-center justify-end gap-4">
            <a href="profile.php" class="text-center px-6 py-3 border border-gray-300 rounded-lg hover:bg-gray-100 transition">Batal</a>
            <button type="submit" class="text-center bg-[#D2691E] hover:bg-[#A0522D] text-white font-bold px-6 py-3 rounded-lg focus:outline-none focus:shadow-outline transition">Simpan Perubahan</button>
        </div>
    </form>
</main>