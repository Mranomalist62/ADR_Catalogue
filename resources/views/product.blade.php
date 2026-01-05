<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk - ADR Catalogue</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-blue-50 via-blue-100 to-blue-200 min-h-screen">

    {{-- NAVBAR --}}
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

    <div class="max-w-6xl mx-auto px-4 py-10" id="product-container">
        <!-- Loading State -->
        <div id="loading" class="text-center py-20">
            <div class="inline-block animate-spin rounded-full h-12 w-12 border-4 border-blue-600 border-t-transparent">
            </div>
            <p class="mt-4 text-gray-600 text-lg">Memuat produk...</p>
        </div>

        <!-- Error State -->
        <div id="error" class="hidden text-center py-20">
            <i class="fas fa-exclamation-triangle text-red-500 text-5xl mb-4"></i>
            <h3 class="text-2xl font-medium text-gray-900 mb-2">Produk tidak ditemukan</h3>
            <p class="text-gray-600 mb-6">Produk yang Anda cari tidak tersedia atau telah dihapus.</p>
            <a href="{{ route('home') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium">
                <i class="fas fa-home mr-2"></i>Kembali ke Beranda
            </a>
        </div>

        <!-- Product Content (initially hidden) -->
        <div id="product-content" class="hidden">
            {{-- Breadcrumb --}}
            <p id="breadcrumb" class="text-sm text-gray-600 mb-6">
                <a href="{{ route('home') }}" class="hover:underline">Beranda</a> /
                <a href="{{ route('rekomendasi') }}" class="hover:underline">Rekomendasi</a> /
                <span id="breadcrumb-product" class="text-gray-900 font-medium">Memuat...</span>
            </p>

            {{-- Main Content --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10 items-start">
                {{-- FOTO PRODUK --}}
                <div class="md:col-span-1">
                    <div class="bg-white rounded-xl shadow-lg p-4">
                        <div id="product-image"
                            class="aspect-square bg-gray-200 rounded-lg flex items-center justify-center overflow-hidden">
                            <!-- Image will be loaded here -->
                            <i class="fas fa-box text-gray-400 text-4xl"></i>
                        </div>
                    </div>
                </div>

                {{-- DETAIL + CARD KANAN --}}
                <div class="md:col-span-2 flex flex-col md:flex-row justify-between gap-8">
                    {{-- DETAIL PRODUK --}}
                    <div class="flex-1">
                        <h1 id="product-name" class="text-3xl font-bold text-gray-900">Memuat...</h1>

                        {{-- Price with discount calculation --}}
                        <div id="price-container" class="mt-2">
                            <p id="product-price" class="text-blue-700 text-2xl font-semibold">Rp0</p>
                            <div class="flex flex-col md:flex-row md:items-center md:space-x-4">
                                <p id="original-price" class="text-sm text-gray-500 line-through hidden"></p>
                                <p id="discount-badge" class="hidden text-sm text-red-500 font-medium mt-1"></p>
                            </div>

                        </div>

                        {{-- Category --}}
                        <div id="category" class="mt-4">
                            <span class="text-sm bg-gray-100 text-gray-700 px-3 py-1 rounded-full">
                                <i class="fas fa-tag mr-1"></i><span id="category-name">Memuat...</span>
                            </span>
                        </div>

                        {{-- Description --}}
                        <div class="mt-6">
                            <h3 class="text-lg font-semibold text-gray-800">Deskripsi</h3>
                            <p id="product-description" class="text-gray-600 mt-2 leading-relaxed">
                                Memuat deskripsi produk...
                            </p>
                        </div>
                    </div>

                    {{-- CARD BAYAR (KANAN) --}}
                    <div class="w-full md:w-72 bg-white rounded-xl shadow-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Pembelian</h3>

                        {{-- Price Summary --}}
                        <div class="space-y-3 mb-6">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Harga Satuan</span>
                                <span id="unit-price" class="font-medium">Rp0</span>
                            </div>

                            <div id="discount-row" class="flex justify-between text-sm hidden">
                                <span class="text-green-600">Diskon</span>
                                <span id="discount-value" class="font-medium text-green-600">-Rp0</span>
                            </div>

                            <div class="border-t pt-3">
                                <div class="flex justify-between text-lg">
                                    <span class="font-semibold text-gray-800">Total</span>
                                    <span id="total-price" class="font-bold text-blue-700">Rp0</span>
                                </div>
                            </div>
                        </div>

                        {{-- Bayar Button --}}
                        <button id="pay-button"
                            class="mt-4 w-full py-3 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition-colors">
                            <i class="fas fa-credit-card mr-2"></i>Beli Sekarang
                        </button>

                        {{-- Note: Single item only --}}
                        <p class="text-xs text-gray-500 text-center mt-3">
                            <i class="fas fa-info-circle mr-1"></i>Hanya 1 item per transaksi
                        </p>
                    </div>
                </div>
            </div>

            {{-- Chat Admin --}}
            <div class="mt-10 flex justify-center">
                <div class="bg-white rounded-full shadow-lg flex items-center px-6 py-3 w-full md:w-2/3">
                    <span class="flex-1 text-gray-600 font-medium">Punya pertanyaan tentang produk ini?</span>
                    <button
                        class="px-6 py-2 bg-blue-600 text-white rounded-full shadow hover:bg-blue-700 transition-colors">
                        <i class="fas fa-comment-dots mr-2"></i>Chat Admin
                    </button>
                </div>
            </div>

            {{-- PRODUK TERKAIT --}}
            <h2 class="mt-12 text-xl font-bold text-gray-900 mb-4">Produk Terkait</h2>
            <div id="related-products" class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <!-- Related products will be loaded here -->
                <div class="text-center py-8">
                    <div
                        class="inline-block animate-spin rounded-full h-8 w-8 border-4 border-blue-600 border-t-transparent">
                    </div>
                    <p class="mt-2 text-gray-600 text-sm">Memuat produk terkait...</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Get product ID from URL
        const pathSegments = window.location.pathname.split('/');
        const productId = pathSegments[pathSegments.length - 1];

        let productData = null;
        let unitPrice = 0;
        let discountAmount = 0;
        let finalPrice = 0;

        // Load product data on page load
        document.addEventListener('DOMContentLoaded', function () {
            loadProductData();
        });

        async function loadProductData() {
            try {
                const response = await fetch(`/public/products/${productId}`);
                if (!response.ok) throw new Error('Product not found');

                const data = await response.json();

                if (data.success) {
                    productData = data.data;
                    displayProductData();
                    loadRelatedProducts();
                } else {
                    throw new Error(data.message || 'Failed to load product');
                }
            } catch (error) {
                console.error('Error loading product:', error);
                document.getElementById('loading').style.display = 'none';
                document.getElementById('error').classList.remove('hidden');
            }
        }

        function displayProductData() {
            const product = productData;

            // Calculate prices
            unitPrice = product.harga_satuan || 0;
            discountAmount = product.promo ? product.promo.potongan_harga : 0;
            finalPrice = discountAmount > 0 ?
                unitPrice - (unitPrice * discountAmount / 100) :
                unitPrice;

            // Update breadcrumb
            document.getElementById('breadcrumb-product').textContent = product.nama;

            // Update product name
            document.getElementById('product-name').textContent = product.nama;

            // Update image
            const imageContainer = document.getElementById('product-image');
            if (product.path_thumbnail) {
                imageContainer.innerHTML = `
                    <img src="/storage/${product.path_thumbnail}" alt="${product.nama}"
                        class="w-full h-full object-cover">
                `;
            }

            // Update price display
            const priceElement = document.getElementById('product-price');
            const originalPriceElement = document.getElementById('original-price');
            const discountBadge = document.getElementById('discount-badge');
            const discountRow = document.getElementById('discount-row');
            const discountValue = document.getElementById('discount-value');

            if (discountAmount > 0) {
                // Show discounted price
                priceElement.textContent = `Rp ${finalPrice.toLocaleString('id-ID')}`;
                originalPriceElement.textContent = `Rp ${unitPrice.toLocaleString('id-ID')}`;
                originalPriceElement.classList.remove('hidden');

                // Show discount badge
                discountBadge.textContent = `-${discountAmount}%`;
                discountBadge.classList.remove('hidden');

                // Show discount in summary
                const discountAmountValue = unitPrice - finalPrice;
                discountValue.textContent = `-Rp ${discountAmountValue.toLocaleString('id-ID')}`;
                discountRow.classList.remove('hidden');
            } else {
                // Regular price
                priceElement.textContent = `Rp ${unitPrice.toLocaleString('id-ID')}`;
                originalPriceElement.classList.add('hidden');
                discountBadge.classList.add('hidden');
                discountRow.classList.add('hidden');
            }

            // Update summary prices
            document.getElementById('unit-price').textContent = `Rp ${unitPrice.toLocaleString('id-ID')}`;
            document.getElementById('total-price').textContent = `Rp ${finalPrice.toLocaleString('id-ID')}`;

            // Update category
            if (product.category) {
                document.getElementById('category-name').textContent = product.category.nama;
            }

            // Update description
            document.getElementById('product-description').textContent =
                product.desc || 'Tidak ada deskripsi tersedia.';

            // Show content
            document.getElementById('loading').style.display = 'none';
            document.getElementById('product-content').classList.remove('hidden');
        }

        // Pay button click handler
        document.getElementById('pay-button').onclick = function () {
            if (!productData) return;

            // Store product data for checkout
            const checkoutData = {
                id: productData.id,
                name: productData.nama,
                original_price: unitPrice,
                discount_percentage: discountAmount,
                final_price: finalPrice,
                image: productData.path_thumbnail,
                category: productData.category?.nama || 'Uncategorized'
            };

            // Save to localStorage for checkout page
            localStorage.setItem('checkout_product', JSON.stringify(checkoutData));

            // Redirect to checkout page
            window.location.href = '/pembayaran'; // Update with your actual checkout route
        };

        // Load related products (products from same category)
        async function loadRelatedProducts() {
            if (!productData || !productData.id_kategori) return;

            try {
                const response = await fetch(`/public/products/category/${productData.id_kategori}?limit=4`);
                const data = await response.json();

                if (data.success && data.data) {
                    displayRelatedProducts(data.data);
                }
            } catch (error) {
                console.error('Error loading related products:', error);
            }
        }

        function displayRelatedProducts(products) {
            const container = document.getElementById('related-products');
            container.innerHTML = '';

            // Filter out current product
            const filteredProducts = products.filter(p => p.id !== productData.id).slice(0, 4);

            if (filteredProducts.length === 0) {
                container.innerHTML = `
                    <div class="col-span-full text-center py-8">
                        <i class="fas fa-box-open text-gray-400 text-4xl mb-4"></i>
                        <p class="text-gray-600">Tidak ada produk terkait</p>
                    </div>
                `;
                return;
            }

            filteredProducts.forEach(product => {
                const productCard = createRelatedProductCard(product);
                container.appendChild(productCard);
            });
        }

        function createRelatedProductCard(product) {
            const card = document.createElement('div');
            card.className = 'bg-white rounded-xl shadow-lg p-4 hover:shadow-xl transition-shadow cursor-pointer';
            card.onclick = function () {
                window.location.href = `/product/${product.id}`;
            };

            const price = product.promo && product.promo.potongan_harga > 0 ?
                product.harga_satuan - (product.harga_satuan * product.promo.potongan_harga / 100) :
                product.harga_satuan;

            card.innerHTML = `
                <div class="aspect-square bg-gray-200 rounded-lg mb-3 flex items-center justify-center overflow-hidden">
                    ${product.path_thumbnail ?
                    `<img src="${product.path_thumbnail}" alt="${product.nama}" class="w-full h-full object-cover">` :
                    `<i class="fas fa-box text-gray-400 text-2xl"></i>`
                }
                </div>
                <h3 class="text-gray-800 font-medium text-sm line-clamp-2 mb-1">${product.nama}</h3>
                <div class="flex items-center justify-between">
                    <p class="text-blue-700 font-semibold">Rp ${price.toLocaleString('id-ID')}</p>
                    ${product.promo && product.promo.potongan_harga > 0 ?
                    `<span class="text-xs bg-red-100 text-red-700 px-2 py-0.5 rounded-full">-${product.promo.potongan_harga}%</span>` : ''
                }
                </div>
            `;

            return card;
        }

        function toggleMobileMenu() {
            const menu = document.getElementById('mobileMenu');
            menu.classList.toggle('hidden');
        }

    </script>

</body>

</html>