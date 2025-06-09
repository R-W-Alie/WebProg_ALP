<?php
// Pastikan sesi dimulai jika belum ada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Ambil nama file halaman saat ini untuk menandai link aktif
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" /> <title>Sri'Cookies</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="font-[Poppins] bg-[#F5F1E8] text-[#4A4A4A] leading-relaxed">
    <header class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-screen-xl mx-auto flex justify-between items-center p-4">
            <a href="home.php" class="w-16 h-16 rounded-full overflow-hidden flex-shrink-0">
                <img src="https://raw.githubusercontent.com/R-W-Alie/WebProg_ALP/refs/heads/main/1.png" alt="Sri' Cookies logo" class="w-full h-full object-cover">
            </a>

            <button id="hamburger-button" class="md:hidden p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-gray-500">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>

            <nav id="mobile-menu" class="hidden md:flex md:items-center md:gap-8 w-full md:w-auto absolute md:static top-full left-0 bg-white md:bg-transparent shadow-lg md:shadow-none p-4 md:p-0">
                <ul class="flex flex-col md:flex-row gap-4 md:gap-6 list-none items-start md:items-center w-full">
                    
                    <?php if (isset($_SESSION['user_id'])): ?>
                    <li class="w-full md:w-auto">
                        <a href="profile.php"
                        class="block md:inline font-medium text-base hover:text-[#D2691E] <?= $currentPage == 'profile.php' ? 'text-[#D2691E]' : 'text-[#4A4A4A]' ?>">
                        👋 Hi, <?= htmlspecialchars($_SESSION['user_name']); ?>! </a>
                    </li>
                    <?php endif; ?>

                    <li class="w-full md:w-auto">
                        <a href="home.php"
                            class="block md:inline font-medium text-base hover:text-[#D2691E] <?= $currentPage == 'home.php' ? 'text-[#D2691E]' : 'text-[#4A4A4A]' ?>">
                            Beranda
                        </a>
                    </li>
                    <li class="w-full md:w-auto">
                        <a href="produk.php"
                            class="block md:inline font-medium text-base hover:text-[#D2691E] <?= $currentPage == 'produk.php' ? 'text-[#D2691E]' : 'text-[#4A4A4A]' ?>">
                            Produk
                        </a>
                    </li>
                    <li class="w-full md:w-auto">
                        <a href="cart.php"
                            class="block md:inline font-medium text-base hover:text-[#D2691E] <?= $currentPage == 'cart.php' ? 'text-[#D2691E]' : 'text-[#4A4A4A]' ?>">
                            Keranjang
                        </a>
                    </li>
                    <li class="w-full md:w-auto">
                        <a href="riwayat.php"
                            class="block md:inline font-medium text-base hover:text-[#D2691E] <?= $currentPage == 'riwayat.php' ? 'text-[#D2691E]' : 'text-[#4A4A4A]' ?>">
                            Riwayat Pesanan
                        </a>
                    </li>

                    <?php if (!isset($_SESSION['user_id'])): ?>
                        <li class="w-full md:w-auto mt-4 md:mt-0">
                            <a href="login.php"
                                class="bg-[#F4D03F] hover:bg-[#F1C40F] text-[#4A4A4A] font-semibold px-6 py-2 rounded-full transition-transform hover:-translate-y-1 block text-center">
                                Login
                            </a>
                        </li>
                    <?php else: ?>
                        <li class="w-full md:w-auto mt-4 md:mt-0">
                            <a href="logout.php"
                                class="bg-red-500 hover:bg-red-600 text-white font-semibold px-6 py-2 rounded-full transition-transform hover:-translate-y-1 block text-center">
                                Logout
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const hamburgerButton = document.getElementById('hamburger-button');
            const mobileMenu = document.getElementById('mobile-menu');

            hamburgerButton.addEventListener('click', function () {
                mobileMenu.classList.toggle('hidden');
            });
        });
    </script>
</body>
</html>