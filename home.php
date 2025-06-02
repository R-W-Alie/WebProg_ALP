<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="font-[Poppins] bg-[#F5F1E8] text-[#4A4A4A] leading-relaxed">
    <!-- Header Section -->
    <header class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-screen-xl mx-auto flex justify-between items-center p-4">
            <div class="w-16 h-16 rounded-full overflow-hidden">
                <img src="https://raw.githubusercontent.com/R-W-Alie/WebProg_ALP/refs/heads/main/sri.png" alt="Sri' Cookies logo" class="w-full h-full object-cover">
            </div>
            <nav class="flex items-center gap-8 flex-wrap justify-center">
                <ul class="flex gap-6 list-none">
                    <li><a href="home.php" class="font-medium text-base hover:text-[#D2691E] text-[#D2691E]">Beranda</a></li>
                    <li><a href="produk.php" class="font-medium text-base hover:text-[#D2691E]">Produk</a></li>
                    <li><a href="cart.php" class="font-medium text-base hover:text-[#D2691E]">Keranjang</a></li>
                    <li><a href="#" class="font-medium text-base hover:text-[#D2691E]">Riwayat Pesanan</a></li>
                </ul>
                <a href="login.php" class="bg-[#F4D03F] hover:bg-[#F1C40F] text-[#4A4A4A] font-semibold px-6 py-2 rounded-full transition-transform hover:-translate-y-1 inline-block">Login</a>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="relative min-h-[500px] flex items-center justify-start py-20 bg-cover bg-center" style="background-image: url('https://raw.githubusercontent.com/R-W-Alie/WebProg_ALP/refs/heads/main/bg.jpeg');">
        <div class="max-w-screen-xl mx-auto px-4 z-10">
            <h1 class="text-6xl md:text-5xl sm:text-4xl font-extrabold text-white leading-none drop-shadow-[3px_3px_0_#8B4513] mb-4">SRI'<br>COOKIES</h1>
            <p class="text-lg md:text-base font-semibold text-[#8B4513] ml-2">"COOKIES DARI HATI DENGAN RASA ALAMI"</p>
        </div>
    </section>

    <!-- Content Section -->
    <section class="py-20 bg-white">
        <div class="max-w-screen-xl mx-auto px-4 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-10">
            <div class="relative p-6 bg-[#FEFEFE] rounded-xl shadow-lg hover:-translate-y-1 transition-transform">
                <h3 class="text-xl font-bold mb-4">Pesanan</h3>
                <p class="text-justify text-[#666]">Sri'Cookies berpengalaman menangani pesanan roti dalam jumlah besar (hingga 35.000 item sehari) sejak 2010. Berapapun jumlah pesanan Anda, Kami layani.</p>
            </div>
            <div class="relative p-6 bg-[#FEFEFE] rounded-xl shadow-lg hover:-translate-y-1 transition-transform">
                <h3 class="text-xl font-bold mb-4">Fresh From Oven</h3>
                <p class="text-justify text-[#666]">Seluruh produk pesanan selalu dibuat paling lama 24 jam sebelum waktu pengambilan pesanan. Roti kami tahan 2-3 hari dari pembelian</p>
            </div>
            <div class="relative p-6 bg-[#FEFEFE] rounded-xl shadow-lg hover:-translate-y-1 transition-transform">
                <h3 class="text-xl font-bold mb-4">Jaminan Kualitas</h3>
                <p class="text-justify text-[#666]">Sri'Cookies senantiasa menjaga kualitas produk dan layanan untuk pelanggan setia kami. Kami memberi garansi uang kembali hingga 100% jika Anda tidak puas dengan produk atau layanan kami.</p>
            </div>
            <div class="relative p-6 bg-[#FEFEFE] rounded-xl shadow-lg hover:-translate-y-1 transition-transform">
                <h3 class="text-xl font-bold mb-4">Layanan Antar</h3>
                <p class="text-justify text-[#666]">Sri'Cookies menyediakan layanan antar pesanan dalam kota (Surabaya & Sidoarjo), hingga ke luar kota kota (Malang, Batu, Gresik, Pasuruan, Mojokerto, Bangkalan, Sampang, Pamekasan, dan kota lain di Jawa Timur).</p>
            </div>
        </div>
    </section>

    <!-- Footer Section -->
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