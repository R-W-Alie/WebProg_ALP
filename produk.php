<!DOCTYPE html>
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
                <img src="https://raw.githubusercontent.com/R-W-Alie/WebProg_ALP/refs/heads/main/sri.png"
                    alt="Sri' Cookies logo" class="w-full h-full object-cover">
            </div>
            <nav class="flex items-center gap-8 flex-wrap justify-center">
                <ul class="flex gap-6 list-none">
                    <li><a href="home.php" class="font-medium text-base hover:text-[#D2691E]">Beranda</a></li>
                    <li><a href="produk.php" class="font-medium text-base hover:text-[#D2691E] text-[#D2691E]">Produk</a></li>
                    <li><a href="cart.php" class="font-medium text-base hover:text-[#D2691E]">Keranjang</a></li>
                    <li><a href="history.php" class="font-medium text-base hover:text-[#D2691E]">Riwayat Pesanan</a></li>
                </ul>
                <a href="login.php"
                    class="bg-[#F4D03F] hover:bg-[#F1C40F] text-[#4A4A4A] font-semibold px-6 py-2 rounded-full transition-transform hover:-translate-y-1 inline-block">Login</a>
            </nav>
        </div>
    </header>
    <!-- Hero Section -->
    <section class="relative min-h-[500px] flex items-center justify-start py-20 bg-cover bg-center"
        style="background-image: url('https://raw.githubusercontent.com/R-W-Alie/WebProg_ALP/refs/heads/main/bg.jpeg');">
        <div class="max-w-screen-xl mx-auto px-4 z-10">
            <h1
                class="text-6xl md:text-5xl sm:text-4xl font-extrabold text-white leading-none drop-shadow-[3px_3px_0_#8B4513] mb-4">
                SRI'<br>COOKIES</h1>
            <p class="text-lg md:text-base font-semibold text-[#8B4513] ml-2">"COOKIES DARI HATI DENGAN RASA ALAMI"</p>
        </div>
    </section>

    <!-- <section class="py-12 px-6 text-center">
        <h2 class="text-2xl font-bold mb-8">Produk</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-8 max-w-5xl mx-auto">
            <div class="bg-white border rounded-lg p-4 shadow hover:shadow-lg transition">
                <img src="dark-choco.png" alt="Dark Choco" class="mx-auto h-32 mb-4">
                <h3 class="font-bold text-lg">Dark Choco</h3>
                <p>Rp 55.000,-</p>
                <a href="#" class="text-sm underline mt-2 inline-block">Lihat Selengkapnya</a>
            </div>
            <div class="bg-white border rounded-lg p-4 shadow hover:shadow-lg transition">
                <img src="strawberry-cheese.png" alt="Strawberry Cheese" class="mx-auto h-32 mb-4">
                <h3 class="font-bold text-lg">Strawberry Cheese</h3>
                <p>Rp 50.000,-</p>
                <a href="#" class="text-sm underline mt-2 inline-block">Lihat Selengkapnya</a>
            </div>
            <div class="bg-white border rounded-lg p-4 shadow hover:shadow-lg transition">
                <img src="mix-cookies.png" alt="Mix Cookies" class="mx-auto h-32 mb-4">
                <h3 class="font-bold text-lg">Mix Cookies</h3>
                <p>Rp 60.000,-</p>
                <a href="#" class="text-sm underline mt-2 inline-block">Lihat Selengkapnya</a>
            </div>
            <div class="bg-white border rounded-lg p-4 shadow hover:shadow-lg transition">
                <img src="palm-sugar.png" alt="Palm Sugar Choco" class="mx-auto h-32 mb-4">
                <h3 class="font-bold text-lg">Palm Sugar Choco</h3>
                <p>Rp 55.000,-</p>
                <a href="#" class="text-sm underline mt-2 inline-block">Lihat Selengkapnya</a>
            </div>
            <div class="bg-white border rounded-lg p-4 shadow hover:shadow-lg transition">
                <img src="milk-choco.png" alt="Milk Choco" class="mx-auto h-32 mb-4">
                <h3 class="font-bold text-lg">Milk Choco</h3>
                <p>Rp 50.000,-</p>
                <a href="#" class="text-sm underline mt-2 inline-block">Lihat Selengkapnya</a>
            </div>
            <div class="bg-white border rounded-lg p-4 shadow hover:shadow-lg transition">
                <img src="classic-duo.png" alt="Classic Duo Cookies" class="mx-auto h-32 mb-4">
                <h3 class="font-bold text-lg">Classic Duo Cookies</h3>
                <p>Rp 55.000,-</p>
                <a href="#" class="text-sm underline mt-2 inline-block">Lihat Selengkapnya</a>
            </div>
        </div>
    </section> -->
    <footer class="bg-[#F5F1E8] border-t border-[#E0E0E0] pt-16 pb-5">
        <div class="max-w-screen-xl mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-16 mb-10">
                <div>
                    <h3 class="text-2xl font-bold mb-8">HUBUNGI KAMI</h3>
                    <div class="flex gap-8 items-start flex-col md:flex-row">
                        <div class="w-20 h-20 rounded-xl overflow-hidden">
                            <img src="https://raw.githubusercontent.com/R-W-Alie/WebProg_ALP/refs/heads/main/sri.png" alt="Sri' Cookies footer logo" class="w-full h-full object-cover">
                        </div>
                        <div class="space-y-4">
                            <div class="flex gap-4 items-start">
                                <span class="text-xl">📍</span>
                                <div>
                                    <p>Universitas Ciputra Surabaya</p>
                                    <p>UC Town, CitraLand, Surabaya 60219, Jawa Timur, Indonesia.</p>
                                </div>
                            </div>
                            <div class="flex gap-4 items-start">
                                <span class="text-xl">✉</span>
                                <p>universitasciputra@go.id</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <nav class="flex flex-col md:items-end gap-4">
                        <a href="#" class="hover:text-[#D2691E] font-medium">Beranda</a>
                        <a href="#" class="hover:text-[#D2691E] font-medium">Produk</a>
                        <a href="#" class="hover:text-[#D2691E] font-medium">Keranjang</a>
                        <a href="#" class="hover:text-[#D2691E] font-medium">Riwayat Pesanan</a>
                    </nav>
                </div>
            </div>
            <div class="border-t border-[#E0E0E0] pt-6 text-center">
                <p class="text-[#666] font-medium">© 2025 Sri'Cookies All rights reserved</p>
            </div>
        </div>
    </footer>
</body>
</html>