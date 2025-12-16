<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Saya - ADR Catalogue</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .product-item {
            transition: all 0.3s ease;
        }

        .product-item:hover {
            transform: translateX(5px);
        }

        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .print-btn:hover {
            transform: scale(1.05);
        }

        .status-badge i {
            font-size: 0.75rem;
        }

        /* Slide animations for toast */
        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slideOutRight {
            from {
                transform: translateX(0);
                opacity: 1;
            }

            to {
                transform: translateX(100%);
                opacity: 0;
            }
        }

        /* Button hover effects */
        .pay-button {
            background-size: 200% auto;
            transition: all 0.3s ease;
        }

        .pay-button:hover {
            background-position: right center;
            transform: translateY(-2px);
        }

        .order-item {
            transition: all 0.3s ease;
        }

        .order-item:hover {
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }
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

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-8 fade-in">
            <h1 class="text-2xl font-semibold text-gray-700 mb-4 flex items-center">
                <i class="fas fa-box-open mr-3 text-yellow-400"></i>
                Pesanan Saya
            </h1>
            <p class="text-gray-700">Daftar pesanan yang sudah dibeli dengan detail lengkap per produk.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-1 gap-6">
            <div class="glass-effect rounded-xl shadow-xl p-6 fade-in">
                <h2 class="text-xl font-semibold text-gray-800 mb-6">
                    <i class="fas fa-history mr-2 text-blue-500"></i>
                    Riwayat Pesanan
                </h2>

                <div id="orders-container">
                    <!-- Loading state -->
                    <div class="text-center py-12">
                        <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-500 mx-auto"></div>
                        <p class="mt-4 text-gray-600">Memuat daftar pesanan...</p>
                    </div>
                </div>

                <!-- No orders template -->
                <template id="no-orders-template">
                    <div
                        class="bg-gradient-to-r from-blue-50 to-purple-50 rounded-xl p-8 text-center border border-blue-100">
                        <i class="fas fa-shopping-cart text-4xl text-blue-300 mb-4"></i>
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Belum ada pesanan</h3>
                        <p class="text-gray-600 mb-6">Anda belum memiliki pesanan aktif</p>
                        <a href="{{ route('home') }}"
                            class="inline-block px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg font-medium hover:from-blue-700 hover:to-purple-700 shadow-lg hover:shadow-xl transition-all duration-300">
                            <i class="fas fa-shopping-bag mr-2"></i>Mulai Belanja
                        </a>
                    </div>
                </template>

                <!-- Order item template -->
                <template id="order-item-template">
                    <div
                        class="order-item bg-white rounded-xl border border-gray-200 p-6 mb-6 hover:shadow-md transition-shadow duration-300">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 order-id">Pesanan #</h3>
                                <p class="text-sm text-gray-500 order-date"></p>
                            </div>
                            <span class="status-badge px-3 py-1 rounded-full text-sm font-medium"></span>
                        </div>

                        <!-- Product Info -->
                        <div class="product-item flex items-center space-x-4 pb-4 border-b border-gray-100 mb-4">
                            <div
                                class="w-16 h-16 bg-gradient-to-br from-purple-100 to-pink-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-box text-purple-600 text-xl"></i>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-sm font-medium text-gray-900 product-name"></h3>
                                <p class="text-sm text-gray-500 quantity"></p>
                                <div class="flex items-center gap-2 mt-1">
                                    <span class="text-gray-500 line-through text-sm original-price hidden"></span>
                                    <span class="text-blue-700 font-semibold discount-price"></span>
                                    <span
                                        class="discount-badge bg-red-100 text-red-800 text-xs font-medium px-2 py-1 rounded hidden"></span>
                                </div>
                            </div>
                            <div class="text-sm font-medium text-gray-900 total-price"></div>
                        </div>

                        <!-- Address Section -->
                        <div class="mb-4 p-4 bg-gray-50 rounded-lg address-section hidden">
                            <div class="flex items-start">
                                <i class="fas fa-map-marker-alt text-blue-500 mt-1 mr-3"></i>
                                <div class="flex-1">
                                    <p class="font-medium text-gray-700 mb-1">Alamat Pengiriman</p>
                                    <p class="text-gray-600 text-sm address-text"></p>
                                    <p class="text-gray-600 text-sm recipient"></p>
                                </div>
                            </div>
                        </div>

                        <!-- Order Summary -->
                        <div class="border-t border-gray-200 pt-4 space-y-2">
                            <div class="flex justify-between text-gray-600">
                                <span>Subtotal</span>
                                <span class="subtotal"></span>
                            </div>
                            <div class="flex justify-between text-red-600">
                                <span>Potongan</span>
                                <span class="discount-amount"></span>
                            </div>
                            <div
                                class="flex justify-between text-lg font-semibold text-gray-900 pt-3 border-t border-gray-200">
                                <span>Total</span>
                                <span class="text-purple-600 final-total"></span>
                            </div>
                        </div>

                        <!-- Payment Action (for pending orders) -->
                        <div class="payment-action mt-6 pt-6 border-t border-gray-200 hidden">
                            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                                <div>
                                    <p class="text-gray-700 mb-2">Pesanan ini menunggu pembayaran</p>
                                    <p class="text-red-600 font-medium expiry-time">
                                        <i class="far fa-clock mr-2"></i>
                                        Batas waktu: <span class="expiry-text"></span>
                                    </p>
                                </div>

                                <button
                                    class="pay-button px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg font-semibold hover:from-blue-700 hover:to-purple-700 transition-all duration-300 flex items-center justify-center shadow-lg hover:shadow-xl">
                                    <i class="fas fa-credit-card mr-2"></i> Pembayaran
                                </button>
                            </div>

                            <p class="text-xs text-gray-500 mt-3">
                                <i class="fas fa-info-circle mr-1"></i>
                                Pembayaran akan diproses melalui Midtrans (Bank Transfer, E-Wallet, Credit Card)
                            </p>
                        </div>

                        <!-- Payment Status (for paid orders) -->
                        <div class="payment-status mt-6 pt-6 border-t border-gray-200 hidden">
                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="text-gray-700">
                                        Status Pembayaran:
                                        <span class="font-medium payment-status-text ml-2"></span>
                                    </p>
                                    <p class="text-gray-600 text-sm payment-date"></p>
                                </div>
                                <button onclick="window.print()"
                                    class="print-btn bg-blue-100 text-blue-600 px-4 py-2 rounded-lg flex items-center space-x-2 hover:shadow-lg transition-transform duration-300">
                                    <i class="fas fa-print"></i>
                                    <span>Cetak Invoice</span>
                                </button>
                            </div>
                        </div>

                        <!-- Cancelled/Expired Status -->
                        <div class="cancelled-status mt-6 pt-6 border-t border-gray-200 hidden">
                            <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                                <div class="flex items-center">
                                    <i class="fas fa-times-circle text-red-500 mr-3 text-lg"></i>
                                    <div>
                                        <p class="font-medium text-red-800">
                                            Pesanan <span class="status-label"></span>
                                        </p>
                                        <p class="text-red-600 text-sm mt-1">
                                            <span class="reason-text"></span>
                                            <span class="restock-notice hidden">Stok telah dikembalikan ke
                                                inventaris.</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('services.midtrans.client_key') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            loadOrders();

            // Mobile menu toggle
            function toggleMobileMenu() {
                const menu = document.getElementById('mobileMenu');
                menu.classList.toggle('hidden');
            }
            window.toggleMobileMenu = toggleMobileMenu;

            async function loadOrders() {
                const container = document.getElementById('orders-container');

                try {
                    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '';
                    const response = await fetch('/user/api/orders', {
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        }
                    });

                    if (!response.ok) {
                        throw new Error(`HTTP ${response.status}: Gagal memuat pesanan`);
                    }

                    const result = await response.json();

                    console.log('Orders API response:', result); // Check the structure

                    if (result.success && result.data && result.data.length > 0) {
                        // Check if orders have payment data included
                        result.data.forEach(order => {
                            console.log(`Order ${order.id}:`, {
                                orderStatus: order.status,
                                paymentStatus: order.payment ? order.payment.status : 'no payment data',
                                hasPayment: !!order.payment
                            });
                        });

                        renderOrders(result.data);
                    } else {
                        showNoOrders();
                    }

                } catch (error) {
                    console.error('Error loading orders:', error);
                    container.innerHTML = `
                    <div class="bg-red-50 border border-red-200 rounded-xl p-6 text-center">
                        <i class="fas fa-exclamation-triangle text-red-500 text-3xl mb-4"></i>
                        <p class="text-red-700 font-medium">Gagal memuat data pesanan</p>
                        <p class="text-red-600 text-sm mt-2">${error.message}</p>
                        <button onclick="location.reload()"
                                class="mt-4 px-4 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition-colors">
                            <i class="fas fa-redo mr-2"></i>Coba Lagi
                        </button>
                    </div>
                `;
                }
            }

            // NEW FUNCTION: Check payment status for individual order
            async function checkAndUpdatePaymentStatus(orderId, orderElement) {
                try {
                    console.log(`Checking payment status for order ${orderId}`);
                    const response = await fetch(`/user/api/payments/status/${orderId}`);

                    if (!response.ok) {
                        throw new Error(`HTTP ${response.status}: Failed to fetch payment status`);
                    }

                    const result = await response.json();
                    console.log(`Payment status for order ${orderId}:`, result);

                    if (result.success && result.data.payment) {
                        const paymentStatus = result.data.payment.status.toLowerCase();
                        console.log(`Payment status is: ${paymentStatus}`);

                        // Check if payment is pending (including "payment pending")
                        const isPending = paymentStatus.includes('pending') ||
                            ['unpaid', 'awaiting_payment'].includes(paymentStatus);

                        if (isPending) {
                            console.log(`SHOWING PAYMENT BUTTON for order ${orderId}`);
                            const paymentAction = orderElement.querySelector('.payment-action');
                            if (paymentAction) {
                                paymentAction.classList.remove('hidden');

                                // Update expiry time from Midtrans if available
                                if (result.data.midtrans_status && result.data.midtrans_status.expiry_time) {
                                    const expiry = new Date(result.data.midtrans_status.expiry_time);
                                    const now = new Date();
                                    const timeLeft = expiry - now;

                                    if (timeLeft > 0) {
                                        const hours = Math.floor(timeLeft / (1000 * 60 * 60));
                                        const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
                                        const expiryText = orderElement.querySelector('.expiry-text');
                                        if (expiryText) {
                                            expiryText.textContent = `${hours} jam ${minutes} menit`;
                                        }
                                    }
                                }

                                // Update status badge with payment status
                                const statusBadge = orderElement.querySelector('.status-badge');
                                if (statusBadge) {
                                    statusBadge.className = 'px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800 flex items-center gap-1';
                                    statusBadge.innerHTML = `<i class="far fa-clock text-xs"></i> Menunggu Pembayaran (Midtrans)`;
                                }
                            }
                        }
                    }
                } catch (error) {
                    console.error(`Failed to check payment status for order ${orderId}:`, error);
                }
            }

            function renderOrders(orders) {
                const container = document.getElementById('orders-container');
                const template = document.getElementById('order-item-template').content;

                container.innerHTML = '';

                orders.forEach(order => {
                    console.log('Order data:', order); // Check the full order object structure

                    const clone = document.importNode(template, true);
                    const item = clone.querySelector('.order-item');

                    // Fill order data
                    item.querySelector('.order-id').textContent = `Pesanan #${order.id}`;
                    item.querySelector('.order-date').textContent = formatDate(order.created_at);

                    // Initial status badge based on order status
                    const orderStatus = order.status || 'pending';
                    setStatusBadge(item, orderStatus);

                    // Product info
                    const hasDiscount = order.potongan_harga > 0;
                    const originalPrice = order.harga_produk * order.kuantitas;
                    const discountAmount = (order.potongan_harga / 100) * originalPrice;
                    const finalPrice = originalPrice - discountAmount;

                    item.querySelector('.product-name').textContent = order.nama_produk || 'Produk';
                    item.querySelector('.quantity').textContent = `Jumlah: ${order.kuantitas} × Rp ${formatCurrency(order.harga_produk || 0)}`;
                    item.querySelector('.total-price').textContent = `Rp ${formatCurrency(finalPrice)}`;

                    if (hasDiscount) {
                        item.querySelector('.original-price').classList.remove('hidden');
                        item.querySelector('.original-price').textContent = `Rp ${formatCurrency(originalPrice)}`;
                        item.querySelector('.discount-price').textContent = `Rp ${formatCurrency(order.harga_produk - (order.harga_produk * order.potongan_harga / 100))} / item`;
                        item.querySelector('.discount-badge').classList.remove('hidden');
                        item.querySelector('.discount-badge').textContent = `-${order.potongan_harga}%`;
                    } else {
                        item.querySelector('.discount-price').textContent = `Rp ${formatCurrency(order.harga_produk)} / item`;
                    }

                    // Order summary
                    item.querySelector('.subtotal').textContent = `Rp ${formatCurrency(originalPrice)}`;
                    item.querySelector('.discount-amount').textContent = hasDiscount ? `-Rp ${formatCurrency(discountAmount)}` : 'Rp 0';
                    item.querySelector('.final-total').textContent = `Rp ${formatCurrency(order.total_harga || 0)}`;

                    // Address
                    if (order.alamat_pengiriman) {
                        const addressSection = item.querySelector('.address-section');
                        addressSection.classList.remove('hidden');
                        item.querySelector('.address-text').textContent = order.alamat_pengiriman;
                        item.querySelector('.recipient').textContent = `${order.nama_penerima || ''} • ${order.telepon_penerima || ''}`;
                    }

                    // Set expiry time from order.waktu_berlaku (if exists)
                    if (order.waktu_berlaku) {
                        const expiry = new Date(order.waktu_berlaku);
                        const now = new Date();
                        const timeLeft = expiry - now;

                        if (timeLeft > 0) {
                            const hours = Math.floor(timeLeft / (1000 * 60 * 60));
                            const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
                            item.querySelector('.expiry-text').textContent = `${hours} jam ${minutes} menit`;
                        }
                    }

                    // Add pay button event (will be shown/hidden by checkAndUpdatePaymentStatus)
                    const payButton = item.querySelector('.pay-button');
                    payButton.addEventListener('click', () => initiatePayment(order.id));

                    // Initially hide the payment action section
                    const paymentAction = item.querySelector('.payment-action');
                    paymentAction.classList.add('hidden');

                    // Show paid section if order is already marked as paid
                    if (['paid', 'settlement', 'capture', 'success'].includes(orderStatus.toLowerCase())) {
                        const paymentStatusSection = item.querySelector('.payment-status');
                        paymentStatusSection.classList.remove('hidden');
                        item.querySelector('.payment-status-text').textContent = getStatusLabel(orderStatus);
                    }

                    // Show cancelled section if applicable
                    if (['cancelled', 'expired', 'deny', 'failed', 'cancel'].includes(orderStatus.toLowerCase())) {
                        const cancelledStatus = item.querySelector('.cancelled-status');
                        cancelledStatus.classList.remove('hidden');
                        item.querySelector('.status-label').textContent = getStatusLabel(orderStatus);
                        item.querySelector('.restock-notice').classList.remove('hidden');
                    }

                    // Add to container
                    container.appendChild(clone);

                    // Check payment status after rendering
                    setTimeout(() => {
                        checkAndUpdatePaymentStatus(order.id, item);
                    }, 100);
                });
            }

            function setStatusBadge(item, status) {
                const statusBadge = item.querySelector('.status-badge');
                const statusStr = status || 'pending';

                const statusConfig = {
                    'pending': {
                        color: 'bg-yellow-100 text-yellow-800',
                        label: 'Menunggu Pembayaran',
                        icon: 'far fa-clock'
                    },
                    'payment pending': {
                        color: 'bg-yellow-100 text-yellow-800',
                        label: 'Menunggu Pembayaran',
                        icon: 'far fa-clock'
                    },
                    'paid': {
                        color: 'bg-blue-100 text-blue-800',
                        label: 'Sudah Dibayar',
                        icon: 'fas fa-check-circle'
                    },
                    'settlement': {
                        color: 'bg-green-100 text-green-800',
                        label: 'Lunas',
                        icon: 'fas fa-check-circle'
                    },
                    'capture': {
                        color: 'bg-green-100 text-green-800',
                        label: 'Terkonfirmasi',
                        icon: 'fas fa-check-circle'
                    },
                    'processing': {
                        color: 'bg-purple-100 text-purple-800',
                        label: 'Diproses',
                        icon: 'fas fa-cog'
                    },
                    'shipped': {
                        color: 'bg-indigo-100 text-indigo-800',
                        label: 'Dikirim',
                        icon: 'fas fa-truck'
                    },
                    'delivered': {
                        color: 'bg-green-100 text-green-800',
                        label: 'Selesai',
                        icon: 'fas fa-box-open'
                    },
                    'cancelled': {
                        color: 'bg-red-100 text-red-800',
                        label: 'Dibatalkan',
                        icon: 'fas fa-times-circle'
                    },
                    'expired': {
                        color: 'bg-gray-100 text-gray-800',
                        label: 'Kadaluarsa',
                        icon: 'fas fa-hourglass-end'
                    },
                    'deny': {
                        color: 'bg-red-100 text-red-800',
                        label: 'Ditolak',
                        icon: 'fas fa-ban'
                    }
                };

                // Find the best matching config
                let config = statusConfig[statusStr.toLowerCase()];
                if (!config) {
                    // Try to find by partial match
                    for (const key in statusConfig) {
                        if (statusStr.toLowerCase().includes(key) || key.includes(statusStr.toLowerCase())) {
                            config = statusConfig[key];
                            break;
                        }
                    }
                }

                // Default config if no match found
                if (!config) {
                    config = { color: 'bg-gray-100 text-gray-800', label: statusStr, icon: 'fas fa-info-circle' };
                }

                statusBadge.className = `px-3 py-1 rounded-full text-sm font-medium ${config.color} flex items-center gap-1`;
                statusBadge.innerHTML = `<i class="${config.icon} text-xs"></i> ${config.label}`;
            }

            function showNoOrders() {
                const container = document.getElementById('orders-container');
                const template = document.getElementById('no-orders-template').content;
                container.innerHTML = '';
                container.appendChild(document.importNode(template, true));
            }

            // Payment initiation function
            async function initiatePayment(orderId) {
                // Get the clicked button
                const button = event.target.closest('.pay-button');
                const originalText = button.innerHTML;

                try {
                    button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Menyiapkan...';
                    button.disabled = true;

                    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '';

                    const response = await fetch('/user/api/payments/create', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({ order_id: orderId })
                    });

                    const result = await response.json();

                    if (!response.ok) {
                        throw new Error(result.message || 'Gagal menyiapkan pembayaran');
                    }

                    if (result.success) {
                        // Launch Midtrans Snap
                        window.snap.pay(result.data.snap_token, {
                            onSuccess: function (paymentResult) {
                                console.log('Payment success:', paymentResult);
                                showPaymentSuccess(orderId);
                                setTimeout(() => window.location.reload(), 2000);
                            },
                            onPending: function (paymentResult) {
                                console.log('Payment pending:', paymentResult);
                                showPaymentPending();
                                setTimeout(() => window.location.reload(), 2000);
                            },
                            onError: function (paymentResult) {
                                console.log('Payment error:', paymentResult);
                                showPaymentError();
                                button.innerHTML = originalText;
                                button.disabled = false;
                            },
                            onClose: function () {
                                // User closed the modal
                                showToast('Pembayaran dibatalkan', 'warning');
                                button.innerHTML = originalText;
                                button.disabled = false;
                            }
                        });
                    } else {
                        throw new Error(result.message || 'Gagal memulai pembayaran');
                    }

                } catch (error) {
                    console.error('Payment error:', error);
                    showToast('Terjadi kesalahan: ' + error.message, 'error');
                    button.innerHTML = originalText;
                    button.disabled = false;
                }
            }

            // Helper functions
            function formatCurrency(amount) {
                return new Intl.NumberFormat('id-ID').format(amount);
            }

            function formatDate(dateString) {
                const date = new Date(dateString);
                return date.toLocaleDateString('id-ID', {
                    day: 'numeric',
                    month: 'long',
                    year: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit'
                });
            }

            function getStatusLabel(status) {
                const labels = {
                    'pending': 'Menunggu Pembayaran',
                    'payment pending': 'Menunggu Pembayaran',
                    'paid': 'Sudah Dibayar',
                    'settlement': 'Lunas',
                    'capture': 'Terkonfirmasi',
                    'processing': 'Diproses',
                    'shipped': 'Dikirim',
                    'delivered': 'Selesai',
                    'cancelled': 'Dibatalkan',
                    'expired': 'Kadaluarsa',
                    'deny': 'Ditolak'
                };
                return labels[status.toLowerCase()] || status;
            }

            function showToast(message, type = 'info') {
                const colors = {
                    'success': 'bg-green-500',
                    'error': 'bg-red-500',
                    'warning': 'bg-yellow-500',
                    'info': 'bg-blue-500'
                };

                const toast = document.createElement('div');
                toast.className = `fixed top-4 right-4 ${colors[type] || 'bg-blue-500'} text-white px-6 py-3 rounded-lg shadow-lg z-50 transform transition-transform duration-300 translate-x-full`;
                toast.innerHTML = `
                <div class="flex items-center">
                    <i class="fas fa-${type === 'success' ? 'check' : type === 'error' ? 'exclamation' : 'info'}-circle mr-3"></i>
                    <span>${message}</span>
                </div>
            `;

                document.body.appendChild(toast);

                // Animate in
                setTimeout(() => {
                    toast.classList.remove('translate-x-full');
                    toast.classList.add('translate-x-0');
                }, 10);

                // Remove after 3 seconds
                setTimeout(() => {
                    toast.classList.remove('translate-x-0');
                    toast.classList.add('translate-x-full');
                    setTimeout(() => toast.remove(), 300);
                }, 3000);
            }

            function showPaymentSuccess(orderId) {
                showToast('Pembayaran berhasil! Pesanan sedang diproses.', 'success');
            }

            function showPaymentPending() {
                showToast('Pembayaran sedang diproses. Silakan selesaikan pembayaran Anda.', 'info');
            }

            function showPaymentError() {
                showToast('Gagal memproses pembayaran. Silakan coba lagi.', 'error');
            }

            // Make functions available globally
            window.initiatePayment = initiatePayment;
            window.checkAndUpdatePaymentStatus = checkAndUpdatePaymentStatus;
        });

        function toggleMobileMenu() {
            const menu = document.getElementById('mobileMenu');
            menu.classList.toggle('hidden');
        }
    </script>

</body>

</html>