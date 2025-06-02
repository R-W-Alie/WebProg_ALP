<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sri'Cookies</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-cover bg-center font-[Poppins] text-[#4A4A4A] leading-relaxed" style="background-image: url('https://raw.githubusercontent.com/R-W-Alie/WebProg_ALP/refs/heads/main/bg.jpeg');">
    <div class=" min-h-screen flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl shadow-2xl p-12 w-full max-w-md relative z-10">
            <div class="text-center mb-12">
            <div class="mb-4">
    <img src="https://raw.githubusercontent.com/R-W-Alie/WebProg_ALP/refs/heads/main/sri.png" alt="Sri' Cookies logo" class="mx-auto w-20 h-20 object-cover rounded-full">
</div>
                <h1 class="text-3xl font-bold text-black">LOGIN</h1>
            </div>
            
            <!-- Login Form -->
            <form class="space-y-8" action="login.php" method="POST">
                <!-- Username Field -->
                <div>
                    <label for="username" class="block text-lg font-bold text-black mb-3">Username</label>
                    <input 
                        type="text" 
                        id="username" 
                        name="username"
                        class="w-full px-4 py-4 border-2 border-gray-300 rounded-2xl focus:outline-none focus:border-[#D2691E] transition-colors text-base"
                        required
                    >
                </div>
                
                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-lg font-bold text-black mb-3">Password</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password"
                        class="w-full px-4 py-4 border-2 border-gray-300 rounded-2xl focus:outline-none focus:border-[#D2691E] transition-colors text-base"
                        required
                    >
                </div>
                
                <!-- Login Button -->
                <div class="flex justify-end pt-6">
                    <a href="beranda.php"
                        type="submit"
                        class="bg-[#F4D03F] hover:bg-[#F1C40F] text-black font-bold px-8 py-3 rounded-2xl transition-all hover:-translate-y-1 hover:shadow-lg">
                        Login
</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>