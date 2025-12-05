<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan - ADR Catalogue</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>

<body class="bg-gradient-to-br from-blue-50 via-blue-100 to-blue-200">

<nav class="bg-white/95 backdrop-blur-md shadow-xl sticky top-0 z-50 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo and Brand -->
                <div class="flex items-center space-x-4">
                    <div class="flex-shrink-0 flex items-center group">
                        <div class="relative">
                            <img class="h-10 w-auto transition-transform duration-300 group-hover:scale-110" src="{{ asset('images/asset/logo.png') }}" alt="ADR Catalogue">
                            <div class="absolute inset-0 bg-gradient-to-r from-blue-500/20 to-purple-500/20 rounded-lg blur-md opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>
                    </div>
                    <div class="hidden md:block">
                        <div class="ml-10 flex items-baseline space-x-1">
                            <a href="{{ route('home') }}" class="nav-link group relative px-4 py-2 text-blue-600 font-medium transition-all duration-300">
                                <span class="flex items-center">
                                    <i class="fas fa-home mr-2 text-sm group-hover:animate-pulse"></i>
                                    <span class="relative">
                                        Beranda
                                        <span class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-blue-500 to-purple-500"></span>
                                    </span>
                                </span>
                            </a>
                            <a href="{{ route('promo') }}" class="nav-link group relative px-4 py-2 text-gray-700 hover:text-blue-600 font-medium transition-all duration-300">
                                <span class="flex items-center">
                                    <i class="fas fa-tags mr-2 text-sm group-hover:animate-pulse"></i>
                                    <span class="relative">
                                        Promo
                                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-blue-500 to-purple-500 group-hover:w-full transition-all duration-300"></span>
                                    </span>
                                </span>
                            </a>
                            <a href="{{ route('kategori') }}" class="nav-link group relative px-4 py-2 text-gray-700 hover:text-blue-600 font-medium transition-all duration-300">
                                <span class="flex items-center">
                                    <i class="fas fa-th-large mr-2 text-sm group-hover:animate-pulse"></i>
                                    <span class="relative">
                                        Kategori
                                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-blue-500 to-purple-500 group-hover:w-full transition-all duration-300"></span>
                                    </span>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Right side buttons -->
                <div class="flex items-center space-x-2">
                    <a href="{{ route('rekomendasi') }}" class="nav-link group relative px-3 py-2 text-gray-700 hover:text-blue-600 font-medium transition-all duration-300">
                        <span class="flex items-center">
                            <i class="fas fa-star mr-2 text-sm group-hover:animate-pulse"></i>
                            <span class="relative hidden sm:inline">
                                Rekomendasi
                                <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-blue-500 to-purple-500 group-hover:w-full transition-all duration-300"></span>
                            </span>
                        </span>
                    </a>
                    <a href="{{ route('checkout') }}" class="nav-link group relative px-3 py-2 text-gray-700 hover:text-blue-600 font-medium transition-all duration-300">
                        <span class="flex items-center">
                            <i class="fas fa-shopping-cart mr-2 text-sm group-hover:animate-pulse"></i>
                            <span class="relative hidden sm:inline">
                                Keranjang
                                <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-blue-500 to-purple-500 group-hover:w-full transition-all duration-300"></span>
                            </span>
                        </span>
                    </a>
                    @if(auth('user')->check())
                        <a href="{{ route('user.chat') }}" class="nav-link group relative px-3 py-2 text-gray-700 hover:text-blue-600 font-medium transition-all duration-300">
                            <span class="flex items-center">
                                <i class="fas fa-comments mr-2 text-sm group-hover:animate-pulse"></i>
                                <span class="relative hidden sm:inline">
                                    Chat
                                    <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-blue-500 to-purple-500 group-hover:w-full transition-all duration-300"></span>
                                </span>
                            </span>
                        </a>
                        <a href="{{ route('profile') }}" class="nav-link group relative px-3 py-2 text-gray-700 hover:text-blue-600 font-medium transition-all duration-300">
                            <span class="flex items-center">
                                <i class="fas fa-building mr-2 text-sm group-hover:animate-pulse"></i>
                                <span class="relative hidden sm:inline">
                                    Profil
                                    <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-blue-500 to-purple-500 group-hover:w-full transition-all duration-300"></span>
                                </span>
                            </span>
                        </a>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="nav-link group relative px-3 py-2 text-red-600 hover:text-red-700 font-medium transition-all duration-300">
                                <span class="flex items-center">
                                    <i class="fas fa-sign-out-alt mr-2 text-sm group-hover:animate-pulse"></i>
                                    <span class="relative hidden sm:inline">
                                        Keluar
                                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-red-500 to-red-600 group-hover:w-full transition-all duration-300"></span>
                                    </span>
                                </span>
                            </button>
                        </form>
                    @else
                        <a href="{{ route('profile') }}" class="nav-link group relative px-3 py-2 text-gray-700 hover:text-blue-600 font-medium transition-all duration-300">
                            <span class="flex items-center">
                                <i class="fas fa-building mr-2 text-sm group-hover:animate-pulse"></i>
                                <span class="relative hidden sm:inline">
                                    Profil
                                    <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-blue-500 to-purple-500 group-hover:w-full transition-all duration-300"></span>
                                </span>
                            </span>
                        </a>
                        <a href="{{ route('login') }}" class="group relative bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white px-4 py-2 rounded-xl text-sm font-medium transition-all duration-300 transform hover:scale-105 hover:shadow-lg">
                            <span class="flex items-center">
                                <i class="fas fa-user mr-2 group-hover:animate-bounce"></i>
                                <span class="hidden sm:inline">Masuk/Daftar</span>
                            </span>
                            <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-purple-600 rounded-xl blur-md opacity-50 group-hover:opacity-75 transition-opacity duration-300"></div>
                        </a>
                    @endif
                    
                    <!-- Mobile menu button -->
                    <div class="md:hidden">
                        <button onclick="toggleMobileMenu()" class="group relative p-2 text-gray-700 hover:text-blue-600 transition-all duration-300">
                            <i class="fas fa-bars text-xl group-hover:rotate-12 transition-transform duration-300"></i>
                            <div class="absolute inset-0 bg-blue-100 rounded-lg blur-md opacity-0 group-hover:opacity-50 transition-opacity duration-300"></div>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Mobile menu -->
        <div id="mobileMenu" class="hidden md:hidden bg-white/95 backdrop-blur-md border-t border-gray-100 shadow-lg">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="{{ route('home') }}" class="mobile-nav-link group block px-4 py-3 text-blue-600 hover:bg-blue-50 rounded-lg font-medium transition-all duration-300">
                    <i class="fas fa-home mr-3 group-hover:animate-pulse"></i>
                    Beranda
                </a>
                <a href="{{ route('promo') }}" class="mobile-nav-link group block px-4 py-3 text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg font-medium transition-all duration-300">
                    <i class="fas fa-tags mr-3 group-hover:animate-pulse"></i>
                    Promo
                </a>
                <a href="{{ route('kategori') }}" class="mobile-nav-link group block px-4 py-3 text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg font-medium transition-all duration-300">
                    <i class="fas fa-th-large mr-3 group-hover:animate-pulse"></i>
                    Kategori
                </a>
                <a href="{{ route('rekomendasi') }}" class="mobile-nav-link group block px-4 py-3 text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg font-medium transition-all duration-300">
                    <i class="fas fa-star mr-3 group-hover:animate-pulse"></i>
                    Rekomendasi
                </a>
                <a href="{{ route('checkout') }}" class="mobile-nav-link group block px-4 py-3 text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg font-medium transition-all duration-300">
                    <i class="fas fa-shopping-cart mr-3 group-hover:animate-pulse"></i>
                    Keranjang
                </a>
                @if(auth('user')->check())
                    <a href="{{ route('user.chat') }}" class="mobile-nav-link group block px-4 py-3 text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg font-medium transition-all duration-300">
                        <i class="fas fa-comments mr-3 group-hover:animate-pulse"></i>
                        Chat
                    </a>
                    <a href="{{ route('profile') }}" class="mobile-nav-link group block px-4 py-3 text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg font-medium transition-all duration-300">
                        <i class="fas fa-building mr-3 group-hover:animate-pulse"></i>
                        Profil
                    </a>
                    <form action="{{ route('logout') }}" method="POST" class="block">
                        @csrf
                        <button type="submit" class="mobile-nav-link group block px-4 py-3 text-red-600 hover:bg-red-50 rounded-lg font-medium transition-all duration-300 text-left w-full">
                            <i class="fas fa-sign-out-alt mr-3 group-hover:animate-pulse"></i>
                            Keluar
                        </button>
                    </form>
                @else
                    <a href="{{ route('profile') }}" class="mobile-nav-link group block px-4 py-3 text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg font-medium transition-all duration-300">
                        <i class="fas fa-building mr-3 group-hover:animate-pulse"></i>
                        Profil
                    </a>
                    <a href="{{ route('login') }}" class="mobile-nav-link group block px-4 py-3 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white rounded-lg font-medium transition-all duration-300 transform hover:scale-105">
                        <i class="fas fa-user mr-3 group-hover:animate-bounce"></i>
                        Masuk/Daftar
                    </a>
                @endif
            </div>
        </div>
    </nav>

    <div class="max-w-6xl mx-auto px-4 py-10">

        <h1 class="text-2xl font-bold text-gray-900 mb-6">Pesanan Anda</h1>

<div class="grid grid-cols-1 md:grid-cols-3 gap-10">

    <!-- ============================
         KIRI: ALAMAT & DETAIL PRODUK
    ============================== -->
    <div class="md:col-span-2 space-y-6">

        <!-- ALAMAT PENGIRIMAN -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-3">Alamat Pengiriman</h2>
            <div class="bg-blue-50 rounded-lg p-4 border border-blue-200">
                <p class="font-medium text-gray-800">Fajri Ikhsan</p>
                <p class="text-gray-600 mt-1 text-sm leading-relaxed">
                    Jl. Melati No. 21, Bandung, Jawa Barat<br>
                    Kecamatan Sukajadi, Kode Pos 40123<br>
                    Telepon: 0812 3456 7890
                </p>
            </div>
            <button class="mt-4 w-full py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700">
                Ganti Alamat
            </button>
        </div>

        <!-- DETAIL PRODUK -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-3">Detail Produk</h2>
            <div class="flex gap-4">
                <div class="w-32 h-32 bg-gray-200 rounded-lg"></div>
                <div class="flex-1">
                    <p class="font-medium text-gray-900 text-lg">Lorem Ipsum Dolor Amet</p>
                    <p class="text-blue-700 font-semibold mt-1">Rp3.000.000 / hari</p>
                    <p class="text-gray-600 text-sm mt-2">
                        Jumlah: <span class="font-medium text-gray-800">2</span>
                    </p>
                    <p class="mt-3 text-gray-800 font-semibold">
                        Subtotal: <span class="text-blue-700">Rp6.000.000</span>
                    </p>
                </div>
            </div>
        </div>

    </div>

   <!-- KANAN: METODE PEMBAYARAN + RINGKASAN -->
<div class="space-y-6">

    <!-- METODE PEMBAYARAN -->
    <div class="bg-white rounded-xl shadow-lg p-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Metode Pembayaran</h2>

        <!-- Pilihan Bayar Langsung atau Cicilan -->
        <label class="block text-sm font-medium mb-1 text-gray-700">Jenis Pembayaran</label>
        <select id="paymentType"
            class="w-full mt-1 p-3 border rounded-lg focus:ring-blue-500 focus:border-blue-500">
            <option value="langsung">Bayar Langsung</option>
            <option value="cicilan">Cicilan</option>
        </select>

        <!-- Durasi Cicilan -->
<div id="cicilanBox" class="hidden mt-6">
    <p class="font-medium text-gray-700 mb-2">Durasi Cicilan</p>
    <div class="space-y-3">
        <label class="flex items-center gap-3 p-3 border rounded-lg cursor-pointer hover:bg-gray-50">
            <input type="radio" name="cicilanDuration" value="3" class="scale-110">
            <span class="font-medium text-gray-700">3 Bulan</span>
        </label>
        <label class="flex items-center gap-3 p-3 border rounded-lg cursor-pointer hover:bg-gray-50">
            <input type="radio" name="cicilanDuration" value="6" class="scale-110">
            <span class="font-medium text-gray-700">6 Bulan</span>
        </label>
        <label class="flex items-center gap-3 p-3 border rounded-lg cursor-pointer hover:bg-gray-50">
            <input type="radio" name="cicilanDuration" value="12" class="scale-110">
            <span class="font-medium text-gray-700">12 Bulan</span>
        </label>
    </div>
    <!-- Button Bayar Cicilan -->
    <button class="mt-4 w-full py-3 bg-green-600 text-white rounded-lg font-semibold hover:bg-green-700">
        Pesan
    </button>
</div>


        <!-- Metode Transfer -->
        <div id="transferBox" class="mt-6">
            <p class="font-medium text-gray-700 mb-2">Pilih Metode Pembayaran</p>
            <div class="space-y-3">
                <label class="flex items-center gap-3 p-3 border rounded-lg cursor-pointer hover:bg-gray-50">
                    <input type="radio" name="payMethod" value="qris" class="scale-110">
                    <span class="font-medium text-gray-700">Transfer</span>
                </label>
                <label class="flex items-center gap-3 p-3 border rounded-lg cursor-pointer hover:bg-gray-50">
                    <input type="radio" name="payMethod" value="qris" class="scale-110">
                    <span class="font-medium text-gray-700">QRIS </span>
                </label>
                <label class="flex items-center gap-3 p-3 border rounded-lg cursor-pointer hover:bg-gray-50">
                    <input type="radio" name="payMethod" value="cod" class="scale-110">
                    <span class="font-medium text-gray-700">Cash On Delivery</span>
                </label>
            </div>
        </div>

        <!-- Upload Bukti Pembayaran & Button Bayar -->
        <div id="uploadBox" class="mt-6">
            <label class="block text-sm font-medium text-gray-700 mb-1">Upload Bukti Pembayaran</label>
            <input type="file" class="w-full p-3 border rounded-lg bg-gray-50">
            <button class="mt-4 w-full py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700">
                Bayar
            </button>
        </div>
    </div>

</div>

<script>
    const paymentType = document.getElementById("paymentType");
    const cicilanBox = document.getElementById("cicilanBox");
    const transferBox = document.getElementById("transferBox");
    const uploadBox = document.getElementById("uploadBox");

    paymentType.addEventListener("change", function () {
        if (this.value === "cicilan") {
            // Tampilkan durasi cicilan, sembunyikan metode transfer & upload bayar langsung
            cicilanBox.classList.remove("hidden");
            transferBox.classList.add("hidden");
            uploadBox.classList.add("hidden");
        } else {
            // Tampilkan metode transfer + upload bayar langsung, sembunyikan cicilan
            cicilanBox.classList.add("hidden");
            transferBox.classList.remove("hidden");
            uploadBox.classList.remove("hidden");
        }
    });
</script>



</body>
</html>
