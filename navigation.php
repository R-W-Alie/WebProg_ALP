<?php
session_start();
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="font-[Poppins] bg-[#F5F1E8] text-[#4A4A4A] leading-relaxed">
    <header class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-screen-xl mx-auto flex justify-between items-center p-4">
            <div class="w-16 h-16 rounded-full overflow-hidden">
                <img src="https://raw.githubusercontent.com/R-W-Alie/WebProg_ALP/refs/heads/main/1.png" alt="Sri' Cookies logo" class="w-full h-full object-cover">
            </div>
            <nav class="flex items-center gap-8 flex-wrap justify-center">
                <ul class="flex gap-6 list-none">
                    <li>
                        <a href="home.php"
                            class="font-medium text-base hover:text-[#D2691E] <?php echo $currentPage == 'home.php' ? 'text-[#D2691E]' : 'text-[#4A4A4A]'; ?>">
                            Beranda
                        </a>
                    </li>
                    <li>
                        <a href="produk.php"
                            class="font-medium text-base hover:text-[#D2691E] <?php echo $currentPage == 'produk.php' ? 'text-[#D2691E]' : 'text-[#4A4A4A]'; ?>">
                            Produk
                        </a>
                    </li>
                    <li>
                        <a href="cart.php"
                            class="font-medium text-base hover:text-[#D2691E] <?php echo $currentPage == 'cart.php' ? 'text-[#D2691E]' : 'text-[#4A4A4A]'; ?>">
                            Keranjang
                        </a>
                    </li>
                    <li>
                        <a href="riwayat.php"
                            class="font-medium text-base hover:text-[#D2691E] <?php echo $currentPage == 'riwayat.php' ? 'text-[#D2691E]' : 'text-[#4A4A4A]'; ?>">
                            Riwayat Pesanan
                        </a>
                    </li>
                </ul>
                <?php if (!isset($_SESSION['username'])): ?>
                    <!-- Show Login button if not logged in -->
                    <a href="login.php"
                        class="bg-[#F4D03F] hover:bg-[#F1C40F] text-[#4A4A4A] font-semibold px-6 py-2 rounded-full transition-transform hover:-translate-y-1 inline-block">
                        Login
                    </a>
                <?php else: ?>
                    <!-- Show greeting if logged in -->
                    <div class="text-sm font-medium text-[#4A4A4A]">
                        👋 Hi, <?php echo htmlspecialchars($_SESSION['username']); ?>!
                    </div>
                <?php endif; ?>
            </nav>
        </div>
    </header>


    <!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="font-[Poppins] bg-[#F5F1E8] text-[#4A4A4A] leading-relaxed">
    <header class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-screen-xl mx-auto flex justify-between items-center p-4">
            <div class="w-16 h-16 rounded-full overflow-hidden">
                <img src="https://raw.githubusercontent.com/R-W-Alie/WebProg_ALP/refs/heads/main/1.png" alt="Sri' Cookies logo" class="w-full h-full object-cover">
            </div>
            <nav class="flex items-center gap-8 flex-wrap justify-center">
                <ul class="flex gap-6 list-none">
                    <li><a href="home.php" class="font-medium text-base hover:text-[#D2691E] text-[#D2691E]">Beranda</a></li>
                    <li><a href="produk.php" class="font-medium text-base hover:text-[#D2691E]">Produk</a></li>
                    <li><a href="cart.php" class="font-medium text-base hover:text-[#D2691E]">Keranjang</a></li>
                    <li><a href="#" class="font-medium text-base hover:text-[#D2691E]">Riwayat Pesanan</a></li>
                </ul>
                <?php
                session_start();
                if (!isset($_SESSION['username'])): ?>
                    <a href="login.php" class="bg-[#F4D03F] hover:bg-[#F1C40F] text-[#4A4A4A] font-semibold px-6 py-2 rounded-full transition-transform hover:-translate-y-1 inline-block">Login</a>
                <?php endif; ?>
            </nav>
        </div>
    </header> -->