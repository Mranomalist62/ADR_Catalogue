<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan - ADR Catalogue</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="bg-gradient-to-br from-blue-50 a-blue-100 to-blue-200">

    <nav class="bg-white/95 backdrop-blur-md shadow-xl sticky top-0 z-50 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo and Brand -->
                <div class="flex items-center space-x-4">
                    <div class="flex-shrink-0 flex items-center group">
                        <div class="relative">
                            <img class="h-10 w-auto transition-transform duration-300 group-hover:scale-110"
                                src="{{ asset('images/asset/logo.png') }}" alt="ADR Catalogue">
                            <div
                                class="absolute inset-0 bg-gradient-to-r from-blue-500/20 to-purple-500/20 rounded-lg blur-md opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            </div>
                        </div>
                    </div>
                    <div class="hidden md:block">
                        <div class="ml-10 flex items-baseline space-x-1">
                            <a href="{{ route('home') }}"
                                class="nav-link group relative px-4 py-2 {{ request()->routeIs('home') ? 'text-blue-600' : 'text-gray-700 hover:text-blue-600' }} font-medium transition-all duration-300">
                                <span class="flex items-center">
                                    <i class="fas fa-home mr-2 text-sm group-hover:animate-pulse"></i>
                                    <span class="relative">
                                        Beranda
                                        @if(request()->routeIs('home'))
                                            <span
                                                class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-blue-500 to-purple-500"></span>
                                        @else
                                            <span
                                                class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-blue-500 to-purple-500 group-hover:w-full transition-all duration-300"></span>
                                        @endif
                                    </span>
                                </span>
                            </a>
                            <a href="{{ route('promo') }}"
                                class="nav-link group relative px-4 py-2 {{ request()->routeIs('promo') ? 'text-blue-600' : 'text-gray-700 hover:text-blue-600' }} font-medium transition-all duration-300">
                                <span class="flex items-center">
                                    <i class="fas fa-tags mr-2 text-sm group-hover:animate-pulse"></i>
                                    <span class="relative">
                                        Promo
                                        @if(request()->routeIs('promo'))
                                            <span
                                                class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-blue-500 to-purple-500"></span>
                                        @else
                                            <span
                                                class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-blue-500 to-purple-500 group-hover:w-full transition-all duration-300"></span>
                                        @endif
                                    </span>
                                </span>
                            </a>
                            <a href="{{ route('kategori') }}"
                                class="nav-link group relative px-4 py-2 {{ request()->routeIs('kategori') ? 'text-blue-600' : 'text-gray-700 hover:text-blue-600' }} font-medium transition-all duration-300">
                                <span class="flex items-center">
                                    <i class="fas fa-th-large mr-2 text-sm group-hover:animate-pulse"></i>
                                    <span class="relative">
                                        Kategori
                                        @if(request()->routeIs('kategori'))
                                            <span
                                                class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-blue-500 to-purple-500"></span>
                                        @else
                                            <span
                                                class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-blue-500 to-purple-500 group-hover:w-full transition-all duration-300"></span>
                                        @endif
                                    </span>
                                </span>
                            </a>

                        </div>
                    </div>
                </div>

                <!-- Right side buttons -->
                <div class="flex items-center space-x-2">
                    <a href="{{ route('rekomendasi') }}"
                        class="nav-link group relative px-4 py-2 {{ request()->routeIs('rekomendasi') ? 'text-blue-600' : 'text-gray-700 hover:text-blue-600' }} font-medium transition-all duration-300">
                        <span class="flex items-center">
                            <i class="fas fa-star mr-2 text-sm group-hover:animate-pulse"></i>
                            <span class="relative">
                                Rekomendasi
                                @if(request()->routeIs('rekomendasi'))
                                    <span
                                        class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-blue-500 to-purple-500"></span>
                                @else
                                    <span
                                        class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-blue-500 to-purple-500 group-hover:w-full transition-all duration-300"></span>
                                @endif
                            </span>
                        </span>
                    </a>
                    @auth('user')
                        <!-- LOGGED IN USER MENU -->
                        <a href="{{ route('pesanan') }}"
                            class="nav-link group relative px-3 py-2 {{ request()->routeIs('pesanan') ? 'text-blue-600' : 'text-gray-700 hover:text-blue-600' }} font-medium transition-all duration-300">
                            <span class="flex items-center">
                                <i class="fas fa-shopping-cart mr-2 text-sm group-hover:animate-pulse"></i>
                                <span class="relative hidden sm:inline">
                                    Pesanan
                                    @if(request()->routeIs('pesanan'))
                                        <span
                                            class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-blue-500 to-purple-500"></span>
                                    @else
                                        <span
                                            class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-blue-500 to-purple-500 group-hover:w-full transition-all duration-300"></span>
                                    @endif
                                </span>
                            </span>
                        </a>
                        {{-- <a href="{{ route('user.chat') }}"
                            class="nav-link group relative px-3 py-2 {{ request()->routeIs('user.chat') ? 'text-blue-600' : 'text-gray-700 hover:text-blue-600' }} font-medium transition-all duration-300">
                            <span class="flex items-center">
                                <i class="fas fa-comments mr-2 text-sm group-hover:animate-pulse"></i>
                                <span class="relative hidden sm:inline">
                                    Chat
                                    @if(request()->routeIs('user.chat'))
                                    <span
                                        class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-blue-500 to-purple-500"></span>
                                    @else
                                    <span
                                        class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-blue-500 to-purple-500 group-hover:w-full transition-all duration-300"></span>
                                    @endif
                                </span>
                            </span>
                        </a> --}}
                        <a href="{{ route('profile') }}"
                            class="nav-link group relative px-3 py-2 {{ request()->routeIs('profile') ? 'text-blue-600' : 'text-gray-700 hover:text-blue-600' }} font-medium transition-all duration-300">
                            <span class="flex items-center">
                                <i class="fas fa-building mr-2 text-sm group-hover:animate-pulse"></i>
                                <span class="relative hidden sm:inline">
                                    Profil
                                    @if(request()->routeIs('profile'))
                                        <span
                                            class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-blue-500 to-purple-500"></span>
                                    @else
                                        <span
                                            class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-blue-500 to-purple-500 group-hover:w-full transition-all duration-300"></span>
                                    @endif
                                </span>
                            </span>
                        </a>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit"
                                class="nav-link group relative px-3 py-2 text-red-600 hover:text-red-700 font-medium transition-all duration-300">
                                <span class="flex items-center">
                                    <i class="fas fa-sign-out-alt mr-2 text-sm group-hover:animate-pulse"></i>
                                    <span class="relative hidden sm:inline">
                                        Keluar
                                        <span
                                            class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-red-500 to-red-600 group-hover:w-full transition-all duration-300"></span>
                                    </span>
                                </span>
                            </button>
                        </form>
                    @else
                        <!-- GUEST MENU (Not Logged In) -->
                        <a href="{{ route('profile') }}"
                            class="nav-link group relative px-3 py-2 {{ request()->routeIs('profile') ? 'text-blue-600' : 'text-gray-700 hover:text-blue-600' }} font-medium transition-all duration-300">
                            <span class="flex items-center">
                                <i class="fas fa-building mr-2 text-sm group-hover:animate-pulse"></i>
                                <span class="relative hidden sm:inline">
                                    Profil
                                    @if(request()->routeIs('profile'))
                                        <span
                                            class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-blue-500 to-purple-500"></span>
                                    @else
                                        <span
                                            class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-blue-500 to-purple-500 group-hover:w-full transition-all duration-300"></span>
                                    @endif
                                </span>
                            </span>
                        </a>
                        <a href="{{ route('login') }}"
                            class="group relative bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white px-4 py-2 rounded-xl text-sm font-medium transition-all duration-300 transform hover:scale-105 hover:shadow-lg">
                            <span class="flex items-center">
                                <i class="fas fa-user mr-2 group-hover:animate-bounce"></i>
                                <span class="hidden sm:inline">Masuk/Daftar</span>
                            </span>
                            <div
                                class="absolute inset-0 bg-gradient-to-r from-blue-600 to-purple-600 rounded-xl blur-md opacity-50 group-hover:opacity-75 transition-opacity duration-300">
                            </div>
                        </a>
                    @endauth

                    <!-- Mobile menu button -->
                    <div class="md:hidden">
                        <button onclick="toggleMobileMenu()"
                            class="group relative p-2 text-gray-700 hover:text-blue-600 transition-all duration-300">
                            <i class="fas fa-bars text-xl group-hover:rotate-12 transition-transform duration-300"></i>
                            <div
                                class="absolute inset-0 bg-blue-100 rounded-lg blur-md opacity-0 group-hover:opacity-50 transition-opacity duration-300">
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile menu -->
        <div id="mobileMenu" class="hidden md:hidden bg-white/95 backdrop-blur-md border-t border-gray-100 shadow-lg">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="{{ route('home') }}"
                    class="mobile-nav-link group block px-4 py-3 {{ request()->routeIs('home') ? 'text-blue-600' : 'text-gray-700 hover:text-blue-600' }} hover:bg-blue-50 rounded-lg font-medium transition-all duration-300">
                    <i class="fas fa-home mr-3 group-hover:animate-pulse"></i>
                    Beranda
                </a>
                <a href="{{ route('promo') }}"
                    class="mobile-nav-link group block px-4 py-3 {{ request()->routeIs('promo') ? 'text-blue-600' : 'text-gray-700 hover:text-blue-600' }} hover:bg-blue-50 rounded-lg font-medium transition-all duration-300">
                    <i class="fas fa-tags mr-3 group-hover:animate-pulse"></i>
                    Promo
                </a>
                <a href="{{ route('kategori') }}"
                    class="mobile-nav-link group block px-4 py-3 {{ request()->routeIs('kategori') ? 'text-blue-600' : 'text-gray-700 hover:text-blue-600' }} hover:bg-blue-50 rounded-lg font-medium transition-all duration-300">
                    <i class="fas fa-th-large mr-3 group-hover:animate-pulse"></i>
                    Kategori
                </a>
                <a href="{{ route('rekomendasi') }}"
                    class="mobile-nav-link group block px-4 py-3 {{ request()->routeIs('rekomendasi') ? 'text-blue-600' : 'text-gray-700 hover:text-blue-600' }} hover:bg-blue-50 rounded-lg font-medium transition-all duration-300">
                    <i class="fas fa-star mr-3 group-hover:animate-pulse"></i>
                    Rekomendasi
                </a>

                @auth('user')
                    <!-- LOGGED IN USER MOBILE MENU -->
                    <a href="{{ route('pesanan') }}"
                        class="mobile-nav-link group block px-4 py-3 {{ request()->routeIs('pesanan') ? 'text-blue-600' : 'text-gray-700 hover:text-blue-600' }} hover:bg-blue-50 rounded-lg font-medium transition-all duration-300">
                        <i class="fas fa-shopping-cart mr-3 group-hover:animate-pulse"></i>
                        Pesanan
                    </a>
                    <a href="{{ route('user.chat') }}"
                        class="mobile-nav-link group block px-4 py-3 {{ request()->routeIs('user.chat') ? 'text-blue-600' : 'text-gray-700 hover:text-blue-600' }} hover:bg-blue-50 rounded-lg font-medium transition-all duration-300">
                        <i class="fas fa-comments mr-3 group-hover:animate-pulse"></i>
                        Chat
                    </a>
                    <a href="{{ route('profile') }}"
                        class="mobile-nav-link group block px-4 py-3 {{ request()->routeIs('profile') ? 'text-blue-600' : 'text-gray-700 hover:text-blue-600' }} hover:bg-blue-50 rounded-lg font-medium transition-all duration-300">
                        <i class="fas fa-building mr-3 group-hover:animate-pulse"></i>
                        Profil
                    </a>
                    <form action="{{ route('logout') }}" method="POST" class="block">
                        @csrf
                        <button type="submit"
                            class="mobile-nav-link group block px-4 py-3 text-red-600 hover:bg-red-50 rounded-lg font-medium transition-all duration-300 text-left w-full">
                            <i class="fas fa-sign-out-alt mr-3 group-hover:animate-pulse"></i>
                            Keluar
                        </button>
                    </form>
                @else
                    <!-- GUEST MOBILE MENU (Not Logged In) -->
                    <a href="{{ route('profile') }}"
                        class="mobile-nav-link group block px-4 py-3 {{ request()->routeIs('profile') ? 'text-blue-600' : 'text-gray-700 hover:text-blue-600' }} hover:bg-blue-50 rounded-lg font-medium transition-all duration-300">
                        <i class="fas fa-building mr-3 group-hover:animate-pulse"></i>
                        Profil
                    </a>
                    <a href="{{ route('login') }}"
                        class="mobile-nav-link group block px-4 py-3 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white rounded-lg font-medium transition-all duration-300 transform hover:scale-105">
                        <i class="fas fa-user mr-3 group-hover:animate-bounce"></i>
                        Masuk/Daftar
                    </a>
                @endauth
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

                    <!-- Address Container -->
                    <div id="address-container">
                        <!-- Will be populated by JavaScript -->
                    </div>

                    <!-- Address Action Button -->
                    <button id="address-action-button"
                        class="mt-4 w-full py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700">
                        <!-- Text will be set by JavaScript -->
                    </button>

                    <!-- Hidden field for address ID -->
                    <input type="hidden" id="selected-address-id" name="address_id" value="">
                </div>

                <!-- DETAIL PRODUK -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-3">Detail Produk</h2>
                    <div id="product-detail-container">
                        <!-- This will be populated by JavaScript -->
                        <div class="text-center py-8">
                            <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-500 mx-auto"></div>
                            <p class="mt-2 text-gray-600">Memuat data produk...</p>
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
                            <label
                                class="flex items-center gap-3 p-3 border rounded-lg cursor-pointer hover:bg-gray-50">
                                <input type="radio" name="cicilanDuration" value="3" class="scale-110">
                                <span class="font-medium text-gray-700">3 Bulan</span>
                            </label>
                            <label
                                class="flex items-center gap-3 p-3 border rounded-lg cursor-pointer hover:bg-gray-50">
                                <input type="radio" name="cicilanDuration" value="6" class="scale-110">
                                <span class="font-medium text-gray-700">6 Bulan</span>
                            </label>
                            <label
                                class="flex items-center gap-3 p-3 border rounded-lg cursor-pointer hover:bg-gray-50">
                                <input type="radio" name="cicilanDuration" value="12" class="scale-110">
                                <span class="font-medium text-gray-700">12 Bulan</span>
                            </label>
                        </div>
                        <!-- Button Bayar Cicilan -->
                        <button
                            class="mt-4 w-full py-3 bg-green-600 text-white rounded-lg font-semibold hover:bg-green-700">
                            Pesan
                        </button>
                    </div>


                    <!-- Metode Transfer -->
                    <div id="transferBox" class="mt-6">
                        <p class="font-medium text-gray-700 mb-2">Pilih Metode Pembayaran</p>
                        <div class="space-y-3">
                            <label
                                class="flex items-center gap-3 p-3 border rounded-lg cursor-pointer hover:bg-gray-50">
                                <input type="radio" name="payMethod" value="transfer" class="scale-110">
                                <span class="font-medium text-gray-700">Transfer</span>
                            </label>
                            <label
                                class="flex items-center gap-3 p-3 border rounded-lg cursor-pointer hover:bg-gray-50">
                                <input type="radio" name="payMethod" value="qris" class="scale-110">
                                <span class="font-medium text-gray-700">QRIS </span>
                            </label>
                            <label
                                class="flex items-center gap-3 p-3 border rounded-lg cursor-pointer hover:bg-gray-50">
                                <input type="radio" name="payMethod" value="cash" class="scale-110">
                                <span class="font-medium text-gray-700">Cash On Delivery</span>
                            </label>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl mt-6">
                        <button id="pay-button"
                            class="w-full py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700">
                            <i class="fas fa-credit-card mr-2"></i>Bayar Sekarang
                        </button>

                        <p class="text-xs text-gray-500 text-center mt-2">
                            Dengan menekan tombol ini, Anda menyetujui
                            <a href="#" class="text-blue-500 hover:underline">syarat dan ketentuan</a>
                        </p>
                    </div>

                </div>

            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    // ===== 1. PAYMENT TYPE TOGGLE =====
                    const paymentType = document.getElementById("paymentType");
                    const cicilanBox = document.getElementById("cicilanBox");
                    const transferBox = document.getElementById("transferBox");
                    const uploadBox = document.getElementById("uploadBox");

                    if (paymentType && cicilanBox && transferBox && uploadBox) {
                        paymentType.addEventListener("change", function () {
                            if (this.value === "cicilan") {
                                cicilanBox.classList.remove("hidden");
                                transferBox.classList.add("hidden");
                                uploadBox.classList.add("hidden");
                            } else {
                                cicilanBox.classList.add("hidden");
                                transferBox.classList.remove("hidden");
                                uploadBox.classList.remove("hidden");
                            }
                        });

                        // Trigger initial state
                        paymentType.dispatchEvent(new Event('change'));
                    }

                    // ===== 2. MOBILE MENU =====
                    function toggleMobileMenu() {
                        const menu = document.getElementById('mobileMenu');
                        if (menu) menu.classList.toggle('hidden');
                    }

                    // ===== 3. PRODUCT LOADING =====
                    function loadProduct() {
                        const container = document.getElementById('product-detail-container');
                        if (!container) return null;

                        try {
                            const productData = JSON.parse(localStorage.getItem('checkout_product'));

                            if (!productData) {
                                container.innerHTML = `
                                    <div class="text-center py-8">
                                        <i class="fas fa-exclamation-triangle text-4xl text-red-400 mb-4"></i>
                                        <p class="text-gray-600">Data produk tidak ditemukan</p>
                                        <p class="text-sm text-gray-500 mt-1">Silakan kembali ke halaman produk</p>
                                        <a href="/products" class="mt-4 inline-block px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                                            Kembali Belanja
                                        </a>
                                    </div>
                                `;
                                return null;
                            }

                            const quantity = productData.quantity || 1;
                            const subtotal = productData.final_price * quantity;

                            container.innerHTML = `
                                <div class="flex gap-4">
                                    <div class="w-32 h-32 rounded-lg overflow-hidden bg-gray-100 flex items-center justify-center">
                                        ${productData.image ?
                                    `<img src="${productData.image}" alt="${productData.name}" class="w-full h-full object-cover">` :
                                    `<i class="fas fa-box text-3xl text-gray-400"></i>`
                                }
                                    </div>
                                    <div class="flex-1">
                                        <p class="font-medium text-gray-900 text-lg">${escapeHtml(productData.name)}</p>
                                        <div class="flex items-center gap-2 mt-1">
                                            ${productData.discount_percentage > 0 ? `
                                                <span class="text-gray-500 line-through text-sm">
                                                    Rp ${productData.original_price.toLocaleString('id-ID')}
                                                </span>
                                            ` : ''}
                                            <span class="text-blue-700 font-semibold">
                                                Rp ${productData.final_price.toLocaleString('id-ID')}
                                            </span>
                                            ${productData.discount_percentage > 0 ? `
                                                <span class="bg-red-100 text-red-800 text-xs font-medium px-2 py-1 rounded">
                                                    -${productData.discount_percentage}%
                                                </span>
                                            ` : ''}
                                        </div>

                                        <div class="mt-4 flex items-center gap-3">
                                            <p class="text-gray-600">Jumlah:</p>
                                            <div class="flex items-center border rounded-lg">
                                                <button id="decrease-qty" class="px-3 py-1 text-gray-600 hover:bg-gray-100">
                                                    <i class="fas fa-minus text-xs"></i>
                                                </button>
                                                <input type="number" id="product-quantity"
                                                    value="${quantity}" min="1" max="99"
                                                    class="w-16 text-center border-x py-1" readonly>
                                                <button id="increase-qty" class="px-3 py-1 text-gray-600 hover:bg-gray-100">
                                                    <i class="fas fa-plus text-xs"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="mt-6 pt-4 border-t">
                                            <p class="text-gray-800 font-semibold">
                                                Subtotal: <span id="product-subtotal" class="text-blue-700">Rp ${subtotal.toLocaleString('id-ID')}</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            `;

                            setupQuantityControls(productData.final_price);
                            return productData;

                        } catch (error) {
                            console.error('Error loading product:', error);
                            container.innerHTML = `<p class="text-red-500">Error loading product data</p>`;
                            return null;
                        }
                    }

                    function setupQuantityControls(unitPrice) {
                        const quantityInput = document.getElementById('product-quantity');
                        const decreaseBtn = document.getElementById('decrease-qty');
                        const increaseBtn = document.getElementById('increase-qty');
                        const subtotalElement = document.getElementById('product-subtotal');

                        if (!quantityInput || !decreaseBtn || !increaseBtn || !subtotalElement) return;

                        function updateSubtotal() {
                            const quantity = parseInt(quantityInput.value) || 1;
                            const subtotal = quantity * unitPrice;
                            subtotalElement.textContent = 'Rp ' + subtotal.toLocaleString('id-ID');

                            // Update localStorage
                            const productData = JSON.parse(localStorage.getItem('checkout_product'));
                            if (productData) {
                                productData.quantity = quantity;
                                localStorage.setItem('checkout_product', JSON.stringify(productData));
                            }
                        }

                        decreaseBtn.addEventListener('click', () => {
                            let value = parseInt(quantityInput.value) || 1;
                            if (value > 1) {
                                quantityInput.value = value - 1;
                                updateSubtotal();
                            }
                        });

                        increaseBtn.addEventListener('click', () => {
                            let value = parseInt(quantityInput.value) || 1;
                            if (value < 99) {
                                quantityInput.value = value + 1;
                                updateSubtotal();
                            }
                        });
                    }

                    // ===== 4. ADDRESS LOADING =====
                    const addressContainer = document.getElementById('address-container');
                    const addressActionButton = document.getElementById('address-action-button');
                    const selectedAddressId = document.getElementById('selected-address-id');
                    const payButton = document.getElementById('pay-button');

                    async function loadAddress() {
                        if (!addressContainer) {
                            console.warn('Address container not found');
                            return;
                        }

                        // Show loading
                        addressContainer.innerHTML = `
                            <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                                <div class="flex items-center">
                                    <div class="animate-spin rounded-full h-5 w-5 border-b-2 border-blue-500 mr-3"></div>
                                    <span class="text-gray-600 text-sm">Memuat alamat...</span>
                                </div>
                            </div>
                        `;

                        try {
                            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '';
                            const response = await fetch('/user/api/addresses/default', {
                                headers: {
                                    'Accept': 'application/json',
                                    'X-CSRF-TOKEN': csrfToken
                                }
                            });

                            if (!response.ok) throw new Error(`HTTP ${response.status}`);

                            const result = await response.json();

                            if (result.success) {
                                if (result.data) {
                                    // Address found
                                    displayAddress(result.data);
                                    setPaymentEnabled(true);
                                } else {
                                    // No address
                                    displayNoAddress();
                                    setPaymentEnabled(false);
                                }
                            } else {
                                throw new Error(result.message || 'Gagal memuat alamat');
                            }
                        } catch (error) {
                            console.error('Error loading address:', error);
                            displayAddressError(error.message);
                            setPaymentEnabled(false);
                        }
                    }

                    function displayAddress(address) {
                        if (!addressContainer) return;

                        addressContainer.innerHTML = `
                            <div class="bg-blue-50 rounded-lg p-4 border border-blue-200">
                                <div class="flex justify-between items-start mb-2">
                                    <p class="font-medium text-gray-800">${escapeHtml(address.nama)}</p>
                                    <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded">
                                        <i class="fas fa-check-circle mr-1"></i>Utama
                                    </span>
                                </div>
                                <p class="text-gray-600 text-sm leading-relaxed">
                                    ${escapeHtml(address.desk_alamat).replace(/\n/g, '<br>')}
                                </p>
                            </div>
                        `;

                        if (selectedAddressId) {
                            selectedAddressId.value = address.id;
                        }

                        if (addressActionButton) {
                            addressActionButton.innerHTML = 'Ganti Alamat';
                            addressActionButton.onclick = () => window.location.href = '{{ route("listalamat") }}';
                            addressActionButton.className = 'mt-4 w-full py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700';
                        }
                    }

                    function displayNoAddress() {
                        if (!addressContainer) return;

                        addressContainer.innerHTML = `
                            <div class="bg-yellow-50 rounded-lg p-4 border border-yellow-200">
                                <div class="flex items-start">
                                    <i class="fas fa-map-marker-alt text-yellow-500 text-xl mt-0.5 mr-3"></i>
                                    <div>
                                        <p class="font-medium text-gray-800">Belum ada alamat tersimpan</p>
                                        <p class="text-gray-600 text-sm mt-1">
                                            Anda perlu menambahkan alamat untuk melanjutkan pembayaran.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        `;

                        if (selectedAddressId) {
                            selectedAddressId.value = '';
                        }

                        if (addressActionButton) {
                            addressActionButton.innerHTML = '<i class="fas fa-plus mr-2"></i>Tambahkan Alamat';
                            addressActionButton.onclick = () => window.location.href = '{{ route("addalamat") }}';
                            addressActionButton.className = 'mt-4 w-full py-3 bg-yellow-500 text-white rounded-lg font-semibold hover:bg-yellow-600';
                        }
                    }

                    function displayAddressError(errorMessage) {
                        if (!addressContainer) return;

                        addressContainer.innerHTML = `
                            <div class="bg-red-50 rounded-lg p-4 border border-red-200">
                                <div class="flex items-start">
                                    <i class="fas fa-exclamation-triangle text-red-500 text-xl mt-0.5 mr-3"></i>
                                    <div>
                                        <p class="font-medium text-gray-800">Gagal memuat alamat</p>
                                        <p class="text-gray-600 text-sm mt-1">${escapeHtml(errorMessage)}</p>
                                    </div>
                                </div>
                            </div>
                        `;
                    }

                    // ===== 5. PAYMENT BUTTON CONTROL =====
                    function setPaymentEnabled(enabled) {
                        if (!payButton) {
                            console.warn('Pay button not found');
                            return;
                        }

                        if (enabled) {
                            payButton.disabled = false;
                            payButton.classList.remove('opacity-50', 'cursor-not-allowed');
                            payButton.innerHTML = '<i class="fas fa-credit-card mr-2"></i>Bayar Sekarang';
                            payButton.onclick = processPayment;
                        } else {
                            payButton.disabled = true;
                            payButton.classList.add('opacity-50', 'cursor-not-allowed');
                            payButton.innerHTML = '<i class="fas fa-exclamation-triangle mr-2"></i>Tambahkan Alamat Terlebih Dahulu';
                            payButton.onclick = () => window.location.href = '{{ route("addalamat") }}';
                        }
                    }

                    async function processPayment() {
                        if (!payButton) return;

                        const addressId = selectedAddressId?.value;
                        const productData = JSON.parse(localStorage.getItem('checkout_product'));

                        // Get selected payment method
                        const paymentMethod = document.querySelector('input[name="payMethod"]:checked')?.value || 'transfer';

                        if (!addressId) {
                            alert('Silakan tambahkan alamat terlebih dahulu');
                            return;
                        }

                        if (!productData) {
                            alert('Data produk tidak ditemukan');
                            return;
                        }

                        // Show loading
                        const originalText = payButton.innerHTML;
                        payButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Memproses...';
                        payButton.disabled = true;

                        try {
                            // STEP 1: Create order via API
                            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '';

                            const orderResponse = await fetch('user/api/orders', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'Accept': 'application/json',
                                    'X-CSRF-TOKEN': csrfToken
                                },
                                body: JSON.stringify({
                                    id_produk: productData.id,
                                    kuantitas: productData.quantity || 1,
                                    payment_method: paymentMethod,
                                    address_id: addressId
                                })
                            });

                            const orderResult = await orderResponse.json();

                            if (!orderResponse.ok) {
                                throw new Error(orderResult.message || `HTTP ${orderResponse.status}: Gagal membuat pesanan`);
                            }

                            if (orderResult.success) {
                                console.log('Order created:', orderResult.data);

                                // STEP 2: Clear localStorage
                                localStorage.removeItem('checkout_product');

                                // STEP 3: Redirect to pesanan page with the new order ID
                                const orderId = orderResult.data.id;

                                // Show success message before redirect
                                showSuccessAlert('Pesanan berhasil dibuat!', () => {
                                    window.location.href = `/pesanan`;
                                });

                            } else {
                                throw new Error(orderResult.message || 'Gagal membuat pesanan');
                            }

                        } catch (error) {
                            console.error('Order creation error:', error);

                            // Show user-friendly error message
                            let errorMessage = 'Gagal membuat pesanan: ';

                            if (error.message.includes('stock') || error.message.includes('Stock')) {
                                errorMessage += 'Stok produk tidak mencukupi.';
                            } else if (error.message.includes('address') || error.message.includes('alamat')) {
                                errorMessage += 'Alamat tidak valid.';
                            } else if (error.message.includes('HTTP')) {
                                errorMessage += 'Terjadi kesalahan server. Silakan coba lagi.';
                            } else {
                                errorMessage += error.message;
                            }

                            showErrorAlert(errorMessage);

                        } finally {
                            // Restore button
                            payButton.innerHTML = originalText;
                            payButton.disabled = false;
                        }
                    }

                    // Success alert with callback
                    function showSuccessAlert(message) {
                        const modal = document.createElement('div');
                        modal.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4';
                        modal.innerHTML = `
                            <div class="bg-white rounded-xl shadow-2xl max-w-md w-full p-6 transform transition-all">
                                <div class="flex items-start mb-4">
                                    <div class="flex-shrink-0 h-12 w-12 bg-green-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-check-circle text-green-600 text-xl"></i>
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="text-lg font-semibold text-gray-900">Berhasil!</h3>
                                        <div class="mt-2">
                                            <p class="text-gray-600">${message}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-6 flex justify-end">
                                    <a href="/pesanan"
                                    class="px-4 py-2 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition-colors">
                                        Lihat Pesanan
                                    </a>
                                </div>
                            </div>
                        `;

                        document.body.appendChild(modal);

                        // Remove modal when clicking outside
                        modal.addEventListener('click', (e) => {
                            if (e.target === modal) {
                                modal.remove();
                            }
                        });
                    }

                    // Error alert
                    function showErrorAlert(message) {
                        const modal = document.createElement('div');
                        modal.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4';
                        modal.innerHTML = `
                            <div class="bg-white rounded-xl shadow-2xl max-w-md w-full p-6 transform transition-all">
                                <div class="flex items-start mb-4">
                                    <div class="flex-shrink-0 h-12 w-12 bg-red-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="text-lg font-semibold text-gray-900">Gagal</h3>
                                        <div class="mt-2">
                                            <p class="text-gray-600">${message}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-6 flex justify-end">
                                    <button onclick="this.closest('.fixed').remove()"
                                            class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg font-medium hover:bg-gray-300 transition-colors">
                                        Tutup
                                    </button>
                                </div>
                            </div>
                        `;

                        document.body.appendChild(modal);
                    }

                    // ===== 6. HELPER FUNCTIONS =====
                    function escapeHtml(text) {
                        if (!text) return '';
                        const div = document.createElement('div');
                        div.textContent = text;
                        return div.innerHTML;
                    }

                    // ===== 7. INITIALIZE EVERYTHING =====
                    // Load product data
                    loadProduct();

                    // Load address data
                    loadAddress();

                    // Set initial payment button state (disabled until address loads)
                    setPaymentEnabled(false);

                    // Expose toggleMobileMenu globally
                    window.toggleMobileMenu = toggleMobileMenu;
                });
            </script>



</body>

</html>