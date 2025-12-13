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
                                <input type="radio" name="payMethod" value="qris" class="scale-110">
                                <span class="font-medium text-gray-700">Transfer</span>
                            </label>
                            <label
                                class="flex items-center gap-3 p-3 border rounded-lg cursor-pointer hover:bg-gray-50">
                                <input type="radio" name="payMethod" value="qris" class="scale-110">
                                <span class="font-medium text-gray-700">QRIS </span>
                            </label>
                            <label
                                class="flex items-center gap-3 p-3 border rounded-lg cursor-pointer hover:bg-gray-50">
                                <input type="radio" name="payMethod" value="cod" class="scale-110">
                                <span class="font-medium text-gray-700">Cash On Delivery</span>
                            </label>
                        </div>
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

                function toggleMobileMenu() {
                    const menu = document.getElementById('mobileMenu');
                    menu.classList.toggle('hidden');
                }

                document.addEventListener('DOMContentLoaded', function () {
                    // Function to display product from localStorage
                    function loadProductFromLocalStorage() {
                        const container = document.getElementById('product-detail-container');
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

                        // Calculate subtotal (price × quantity)
                        const quantity = productData.quantity || 1;
                        const subtotal = productData.final_price * quantity;

                        // Format currency (IDR)
                        const formatCurrency = (amount) => {
                            return 'Rp ' + amount.toLocaleString('id-ID');
                        };

                        // Render the product details
                        container.innerHTML = `
                            <div class="flex gap-4">
                                <div class="w-32 h-32 rounded-lg overflow-hidden bg-gray-100 flex items-center justify-center">
                                    ${productData.image ?
                                `<img src="${productData.image}" alt="${productData.name}" class="w-full h-full object-cover">` :
                                `<i class="fas fa-box text-3xl text-gray-400"></i>`
                            }
                                </div>
                                <div class="flex-1">
                                    <p class="font-medium text-gray-900 text-lg">${productData.name}</p>
                                    <div class="flex items-center gap-2 mt-1">
                                        ${productData.discount_percentage > 0 ? `
                                            <span class="text-gray-500 line-through text-sm">
                                                ${formatCurrency(productData.original_price)}
                                            </span>
                                        ` : ''}
                                        <span class="text-blue-700 font-semibold">
                                            ${formatCurrency(productData.final_price)}
                                        </span>
                                        ${productData.discount_percentage > 0 ? `
                                            <span class="bg-red-100 text-red-800 text-xs font-medium px-2 py-1 rounded">
                                                -${productData.discount_percentage}%
                                            </span>
                                        ` : ''}
                                    </div>

                                    <!-- Quantity Selector -->
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

                                    <!-- Subtotal -->
                                    <div class="mt-6 pt-4 border-t">
                                        <p class="text-gray-800 font-semibold">
                                            Subtotal: <span id="product-subtotal" class="text-blue-700">${formatCurrency(subtotal)}</span>
                                        </p>
                                    </div>

                                    <!-- Hidden inputs for form submission -->
                                    <input type="hidden" id="product-id" value="${productData.id}">
                                    <input type="hidden" id="product-price" value="${productData.final_price}">
                                </div>
                            </div>
                        `;

                        // Attach quantity change handlers
                        setupQuantityControls(productData.final_price);

                        return productData;
                    }

                    // Handle quantity changes
                    function setupQuantityControls(unitPrice) {
                        const quantityInput = document.getElementById('product-quantity');
                        const decreaseBtn = document.getElementById('decrease-qty');
                        const increaseBtn = document.getElementById('increase-qty');
                        const subtotalElement = document.getElementById('product-subtotal');

                        function updateSubtotal() {
                            const quantity = parseInt(quantityInput.value);
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
                            let value = parseInt(quantityInput.value);
                            if (value > 1) {
                                quantityInput.value = value - 1;
                                updateSubtotal();
                            }
                        });

                        increaseBtn.addEventListener('click', () => {
                            let value = parseInt(quantityInput.value);
                            if (value < 99) {
                                quantityInput.value = value + 1;
                                updateSubtotal();
                            }
                        });

                        // Initial calculation
                        updateSubtotal();
                    }

                    // Load the product data
                    const productData = loadProductFromLocalStorage();

                    // If you want to clear localStorage after page load (optional):
                    // localStorage.removeItem('checkout_product');
                });


                document.addEventListener('DOMContentLoaded', function () {
                    // DOM Elements
                    const addressContainer = document.getElementById('address-container');
                    const addressActionButton = document.getElementById('address-action-button');
                    const selectedAddressId = document.getElementById('selected-address-id');
                    const payButton = document.getElementById('pay-button');

                    // Check if required elements exist
                    if (!addressContainer) {
                        console.error('Address container (#address-container) not found!');
                        return;
                    }

                    if (!addressActionButton) {
                        console.error('Address action button (#address-action-button) not found!');
                        return;
                    }

                    // Initialize
                    initAddressSection();

                    // Main initialization function
                    async function initAddressSection() {
                        showLoadingState();
                        await loadAddressData();
                    }

                    // Show loading state
                    function showLoadingState() {
                        addressContainer.innerHTML = `
                            <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                                <div class="flex items-center">
                                    <div class="animate-spin rounded-full h-5 w-5 border-b-2 border-blue-500 mr-3"></div>
                                    <span class="text-gray-600 text-sm">Memuat alamat...</span>
                                </div>
                            </div>
                        `;

                        // Set button to default state while loading
                        updateAddressButton('Ganti Alamat', '{{ route("listalamat") }}', 'blue');
                    }

                    // Load address data from API
                    async function loadAddressData() {
                        try {
                            const response = await fetch('/user/api/addresses/default', {
                                headers: {
                                    'Accept': 'application/json',
                                    'X-CSRF-TOKEN': getCsrfToken()
                                }
                            });

                            if (!response.ok) {
                                throw new Error(`HTTP ${response.status}: ${response.statusText}`);
                            }

                            const result = await response.json();

                            if (result.success) {
                                if (result.data) {
                                    // Address found
                                    displayAddress(result.data);
                                    enablePayment(true);
                                } else {
                                    // No address found
                                    displayNoAddress();
                                    enablePayment(false);
                                }
                            } else {
                                throw new Error(result.message || 'Gagal memuat alamat');
                            }

                        } catch (error) {
                            console.error('Error loading address:', error);
                            displayError(error.message);
                            enablePayment(false);
                        }
                    }

                    // Display address when found
                    function displayAddress(address) {
                        addressContainer.innerHTML = `
                            <div class="bg-blue-50 rounded-lg p-4 border border-blue-200">
                                <div class="flex justify-between items-start mb-2">
                                    <p class="font-medium text-gray-800">${escapeHtml(address.nama)}</p>
                                    <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded">
                                        <i class="fas fa-check-circle mr-1"></i>Utama
                                    </span>
                                </div>
                                <p class="text-gray-600 text-sm leading-relaxed">
                                    ${formatAddressText(address.desk_alamat)}
                                </p>
                            </div>
                        `;

                        // Update button to "Ganti Alamat"
                        updateAddressButton('Ganti Alamat', '{{ route("listalamat") }}', 'blue');

                        // Store address ID
                        if (selectedAddressId) {
                            selectedAddressId.value = address.id;
                        }
                    }

                    // Display when no address exists
                    function displayNoAddress() {
                        addressContainer.innerHTML = `
                            <div class="bg-yellow-50 rounded-lg p-4 border border-yellow-200">
                                <div class="flex items-start">
                                    <i class="fas fa-map-marker-alt text-yellow-500 text-xl mt-0.5 mr-3"></i>
                                    <div>
                                        <p class="font-medium text-gray-800">Belum ada alamat tersimpan</p>
                                        <p class="text-gray-600 text-sm mt-1">
                                            Anda perlu menambahkan alamat untuk melanjutkan pembayaran.
                                        </p>
                                        <p class="text-gray-500 text-xs mt-2">
                                            <i class="fas fa-info-circle mr-1"></i>
                                            Klik tombol "Tambahkan Alamat" di bawah
                                        </p>
                                    </div>
                                </div>
                            </div>
                        `;

                        // Update button to "Tambahkan Alamat"
                        updateAddressButton(
                            '<i class="fas fa-plus mr-2"></i>Tambahkan Alamat',
                            '{{ route("addalamat") }}',
                            'yellow'
                        );

                        // Clear address ID
                        if (selectedAddressId) {
                            selectedAddressId.value = '';
                        }

                        // Show warning message
                        showAddressWarning();
                    }

                    // Display error state
                    function displayError(errorMessage) {
                        addressContainer.innerHTML = `
                            <div class="bg-red-50 rounded-lg p-4 border border-red-200">
                                <div class="flex items-start">
                                    <i class="fas fa-exclamation-triangle text-red-500 text-xl mt-0.5 mr-3"></i>
                                    <div>
                                        <p class="font-medium text-gray-800">Gagal memuat alamat</p>
                                        <p class="text-gray-600 text-sm mt-1">${escapeHtml(errorMessage)}</p>
                                        <button onclick="window.location.reload()"
                                                class="mt-3 px-4 py-2 bg-red-500 text-white text-sm rounded-lg hover:bg-red-600">
                                            <i class="fas fa-redo mr-1"></i>Muat Ulang Halaman
                                        </button>
                                    </div>
                                </div>
                            </div>
                        `;

                        // Keep button as "Ganti Alamat" on error
                        updateAddressButton('Ganti Alamat', '{{ route("listalamat") }}', 'blue');
                    }

                    // Update address button text, link, and color
                    function updateAddressButton(text, link, color = 'blue') {
                        addressActionButton.innerHTML = text;

                        // Set onclick handler
                        addressActionButton.onclick = function () {
                            window.location.href = link;
                        };

                        // Update button color
                        addressActionButton.className = 'mt-4 w-full py-3 text-white rounded-lg font-semibold hover:opacity-90';

                        if (color === 'yellow') {
                            addressActionButton.classList.add('bg-yellow-500', 'hover:bg-yellow-600');
                            addressActionButton.classList.remove('bg-blue-600', 'hover:bg-blue-700');
                        } else {
                            addressActionButton.classList.add('bg-blue-600', 'hover:bg-blue-700');
                            addressActionButton.classList.remove('bg-yellow-500', 'hover:bg-yellow-600');
                        }
                    }

                    // Show/hide address warning
                    function showAddressWarning(show = true) {
                        let warningElement = document.getElementById('address-warning');

                        if (show && !warningElement) {
                            warningElement = document.createElement('div');
                            warningElement.id = 'address-warning';
                            warningElement.className = 'mt-3 p-3 bg-red-50 border border-red-200 rounded-lg';
                            warningElement.innerHTML = `
                                <div class="flex items-center text-red-700">
                                    <i class="fas fa-exclamation-circle mr-2"></i>
                                    <span class="text-sm font-medium">Tambahkan alamat untuk melanjutkan pembayaran</span>
                                </div>
                            `;

                            // Insert after address container
                            addressContainer.parentNode.insertBefore(warningElement, addressContainer.nextSibling);

                        } else if (!show && warningElement) {
                            warningElement.remove();
                        }
                    }

                    // Enable/disable payment button
                    function enablePayment(enable = true) {
                        if (!payButton) return;

                        if (enable) {
                            // Enable payment button
                            payButton.disabled = false;
                            payButton.classList.remove('opacity-50', 'cursor-not-allowed');
                            payButton.innerHTML = '<i class="fas fa-credit-card mr-2"></i>Bayar Sekarang';
                            payButton.onclick = handlePayment;

                            // Remove warning if exists
                            showAddressWarning(false);

                        } else {
                            // Disable payment button
                            payButton.disabled = true;
                            payButton.classList.add('opacity-50', 'cursor-not-allowed');
                            payButton.innerHTML = '<i class="fas fa-exclamation-triangle mr-2"></i>Bayar';
                            payButton.onclick = function () {
                                window.location.href = '{{ route("addalamat") }}';
                            };
                        }
                    }

                    // Payment handler
                    async function handlePayment() {
                        const addressId = selectedAddressId?.value;

                        if (!addressId) {
                            alert('Silakan tambahkan alamat pengiriman terlebih dahulu');
                            return;
                        }

                        // Show loading on payment button
                        const originalText = payButton.innerHTML;
                        payButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Memproses...';
                        payButton.disabled = true;

                        try {
                            // TODO: Your payment processing logic here
                            console.log('Processing payment with address ID:', addressId);

                            // For now, simulate payment processing
                            await new Promise(resolve => setTimeout(resolve, 1000));
                            alert('Payment processing would start here');

                        } catch (error) {
                            console.error('Payment error:', error);
                            alert('Gagal memproses pembayaran: ' + error.message);
                        } finally {
                            // Restore button state
                            payButton.innerHTML = originalText;
                            payButton.disabled = false;
                        }
                    }

                    // Helper: Get CSRF token safely
                    function getCsrfToken() {
                        const metaTag = document.querySelector('meta[name="csrf-token"]');
                        return metaTag ? metaTag.getAttribute('content') : '';
                    }

                    // Helper: Format address text with line breaks
                    function formatAddressText(text) {
                        if (!text) return '';
                        return escapeHtml(text).replace(/\n/g, '<br>');
                    }

                    // Helper: Escape HTML to prevent XSS
                    function escapeHtml(text) {
                        const div = document.createElement('div');
                        div.textContent = text;
                        return div.innerHTML;
                    }

                    // Expose reload function for error retry
                    window.reloadAddressData = loadAddressData;
                });

            </script>



</body>

</html>