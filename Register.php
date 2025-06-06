<?php
require_once("db.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name_user'];
    $email = $_POST['email'];
    $phone = $_POST['no_hp'];
    $address = $_POST['address'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (name_user, email, no_hp, address, password) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $email, $phone, $address, $password);

    if ($stmt->execute()) {
        header("Location: login.php");
        exit;
    } else {
        $error = "Registration failed.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register - Sri'Cookies</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-cover bg-center" style="background-image: url('bg.jpeg')">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl shadow-2xl p-12 w-full max-w-md">
            <div class="text-center mb-10">
                <img src="sri.png" alt="Sri Logo" class="mx-auto w-20 h-20" />
                <h1 class="text-3xl font-bold text-black">REGISTER</h1>
            </div>
            <?php if (!empty($error)): ?>
                <p class="text-red-500 text-center mb-4"><?= $error ?></p>
            <?php endif; ?>
            <form method="POST" class="space-y-6">
                <form action="Register.php" method="POST" class="space-y-6">
                    <div>
                        <label for="name_user" class="block font-semibold mb-1">Name</label>
                        <input type="text" id="name_user" name="name_user" required class="w-full p-3 border rounded">
                    </div>

                    <div>
                        <label for="email" class="block font-semibold mb-1">Email</label>
                        <input type="email" id="email" name="email" required class="w-full p-3 border rounded">
                    </div>

                    <div>
                        <label for="no_hp" class="block font-semibold mb-1">Phone Number</label>
                        <input type="text" id="no_hp" name="no_hp" required class="w-full p-3 border rounded">
                    </div>

                    <div>
                        <label for="address" class="block font-semibold mb-1">Address</label>
                        <textarea id="address" name="address" required class="w-full p-3 border rounded"></textarea>
                    </div>

                    <div>
                        <label for="password" class="block font-semibold mb-1">Password</label>
                        <input type="password" id="password" name="password" required class="w-full p-3 border rounded">
                    </div>

                    <button type="submit" class="w-full bg-yellow-400 hover:bg-yellow-500 p-3 font-bold rounded">Register</button>
                    <div class="text-center text-sm mt-4">
                        Sudah punya akun? <a href="login.php" class="text-yellow-700 font-semibold">Login di sini</a>
                    </div>
                </form>
        </div>
    </div>
</body>

</html>