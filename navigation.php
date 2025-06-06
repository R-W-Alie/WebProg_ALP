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
                <?php if (isset($_SESSION['user_id'])): ?>
                    <div class="text-[#D2691E] font-semibold text-lg select-none">
                        👋 Hi, <?= htmlspecialchars($_SESSION['user_name']); ?>!
                    </div>
                <?php else: ?>
                    <div></div>
                <?php endif; ?>
                <ul class="flex gap-6 list-none items-center">
                    <li>
                        <a href="home.php"
                            class="font-medium text-base hover:text-[#D2691E] <?= $currentPage == 'home.php' ? 'text-[#D2691E]' : 'text-[#4A4A4A]' ?>">
                            Beranda
                        </a>
                    </li>
                    <li>
                        <a href="produk.php"
                            class="font-medium text-base hover:text-[#D2691E] <?= $currentPage == 'produk.php' ? 'text-[#D2691E]' : 'text-[#4A4A4A]' ?>">
                            Produk
                        </a>
                    </li>
                    <li>
                        <a href="cart.php"
                            class="font-medium text-base hover:text-[#D2691E] <?= $currentPage == 'cart.php' ? 'text-[#D2691E]' : 'text-[#4A4A4A]' ?>">
                            Keranjang
                        </a>
                    </li>
                    <li>
                        <a href="riwayat.php"
                            class="font-medium text-base hover:text-[#D2691E] <?= $currentPage == 'riwayat.php' ? 'text-[#D2691E]' : 'text-[#4A4A4A]' ?>">
                            Riwayat Pesanan
                        </a>
                    </li>
                    <?php if (!isset($_SESSION['user_id'])): ?>
                        <li>
                            <a href="login.php"
                                class="bg-[#F4D03F] hover:bg-[#F1C40F] text-[#4A4A4A] font-semibold px-6 py-2 rounded-full transition-transform hover:-translate-y-1 inline-block">
                                Login
                            </a>
                        </li>
                    <?php else: ?>
                        <li>
                            <a href="logout.php"
                                class="bg-red-500 hover:bg-red-600 text-white font-semibold px-6 py-2 rounded-full transition-transform hover:-translate-y-1 inline-block">
                                Logout
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>