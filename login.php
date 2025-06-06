<?php
session_start();
include_once('db.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    if ($email === 'sriadmin@gmail.com' && $password === 'adminnya') {
        $_SESSION['user_id'] = 'admin';
        $_SESSION['user_name'] = 'Sri Admin';
        $_SESSION['is_admin'] = true;
        header("Location: admin.php");
        exit();
    }
    $stmt = $conn->prepare("SELECT user_id, name_user, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result && $row = $result->fetch_assoc()) {
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['user_name'] = $row['name_user'];
            $_SESSION['is_admin'] = false;
            header("Location: home.php");
            exit();
        } else {
            $error = "Password salah.";
        }
    } else {
        $error = "Email tidak ditemukan.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - Sri'Cookies</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-cover bg-center" style="background-image: url('bg.jpeg')">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl shadow-2xl p-12 w-full max-w-md">
            <div class="text-center mb-10">
                <img src="sri.png" alt="Sri Logo" class="mx-auto w-20 h-20" />
                <h1 class="text-3xl font-bold text-black">LOGIN</h1>
            </div>
            <?php if (!empty($error)): ?>
                <p class="text-red-500 text-center mb-4"><?= $error ?></p>
            <?php endif; ?>
            <form method="POST" class="space-y-6">
                <div>
                    <label class="block font-bold text-black mb-2">Email</label>
                    <input type="email" name="email" required class="w-full px-4 py-3 border rounded-2xl focus:outline-none" />
                </div>
                <div>
                    <label class="block font-bold text-black mb-2">Password</label>
                    <input type="password" name="password" required class="w-full px-4 py-3 border rounded-2xl focus:outline-none" />
                </div>
                <div class="text-right">
                    <button type="submit" class="bg-yellow-400 hover:bg-yellow-300 px-6 py-2 rounded-2xl font-bold">Login</button>
                </div>
                <div class="text-center text-sm mt-4">
                    Belum punya akun? <a href="register.php" class="text-yellow-700 font-semibold">Daftar di sini</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>