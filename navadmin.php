<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Sri'Cookies</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="font-[Poppins] bg-[#F5F1E8] text-[#4A4A4A] leading-relaxed">
    <header class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-screen-xl mx-auto flex justify-between items-center p-4">
            <div class="w-16 h-16 rounded-full overflow-hidden">
                <img src="https://raw.githubusercontent.com/R-W-Alie/WebProg_ALP/refs/heads/main/1.png" alt="Sri' Cookies logo" class="w-full h-full object-cover">
            </div>
            <nav class="flex items-center gap-8 flex-wrap justify-between w-full max-w-4xl">
                <!-- Left side: greeting if logged in -->
                <?php if (isset($_SESSION['user_id'])): ?>
                    <div class="text-[#D2691E] font-semibold text-lg select-none">
                        👋 Hi, <?= htmlspecialchars($_SESSION['user_name']); ?>!
                    </div>
                <?php else: ?>
                    <div></div>
                <?php endif; ?>

                <!-- Right side: nav links and login/logout button -->
                <ul class="flex gap-6 list-none items-center">
                        <a href="produk.php"
                            class="font-medium text-base hover:text-[#D2691E] <?= $currentPage == 'produk.php' ? 'text-[#D2691E]' : 'text-[#4A4A4A]' ?>">
                            Produk
                        </a>
                    </li>
                    <li>
                        <a href="riwayat.php"
                            class="font-medium text-base hover:text-[#D2691E] <?= $currentPage == 'riwayat.php' ? 'text-[#D2691E]' : 'text-[#4A4A4A]' ?>">
                            Riwayat Pesanan
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>