<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADR Catalogue - Temukan Produk Terbaik</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .hero-gradient {
            background: linear-gradient(135deg, #bfdbfe 0%, #93c5fd 25%, #60a5fa 50%, #3b82f6 75%, #2563eb 100%);
        }

        .light-blue-gradient {
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 25%, #93c5fd 50%, #60a5fa 75%, #3b82f6 100%);
        }

        .category-card {
            transition: all 0.3s ease;
            background: white;
        }

        .category-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(59, 130, 246, 0.15);
        }

        .product-card {
            transition: all 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }

        .search-input:focus {
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }

        .banner-slide {
            animation: slideIn 0.5s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(20px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .scroll-container {
            scroll-behavior: smooth;
            -webkit-overflow-scrolling: touch;
        }

        .scroll-container::-webkit-scrollbar {
            height: 6px;
        }

        .scroll-container::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .scroll-container::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 10px;
        }

        .scroll-container::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-blue-50 via-blue-100 to-blue-200">
    <!-- Modern Navbar -->
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



    <style>
        .nav-link {
            position: relative;
            overflow: hidden;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(59, 130, 246, 0.1);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .nav-link:hover::before {
            width: 100px;
            height: 100px;
        }

        .mobile-nav-link {
            position: relative;
            overflow: hidden;
        }

        .mobile-nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(59, 130, 246, 0.1), transparent);
            transition: left 0.5s;
        }

        .mobile-nav-link:hover::before {
            left: 100%;
        }
    </style>

    <!-- Hero Section -->
    <section class="hero-gradient text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-20">
            <div class="text-center">
                <h1 class="text-3xl md:text-5xl font-bold mb-4 banner-slide">
                    Temukan Produk Terbaik untuk Kebutuhan Anda
                </h1>
                <p class="text-lg md:text-xl mb-8 opacity-90 banner-slide" style="animation-delay: 0.2s">
                    Katalog lengkap dengan harga terbaik dan promo menarik
                </p>

                <!-- Search Bar -->
                <div class="max-w-2xl mx-auto banner-slide" style="animation-delay: 0.4s">
                    <div class="relative">
                        <input type="text" placeholder="Cari produk yang Anda inginkan..."
                            class="search-input w-full px-6 py-4 pr-12 rounded-full text-gray-800 focus:outline-none transition-all">
                        <button
                            class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-indigo-600 hover:bg-indigo-700 text-white p-3 rounded-full transition-colors">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Promo Slider Section -->
    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="relative rounded-xl overflow-hidden shadow-lg banner-slide" style="animation-delay: 0.6s">
                    <div class="light-blue-gradient h-48 flex items-center justify-center">
                        <div class="text-white text-center p-6">
                            <h3 class="text-2xl font-bold mb-2">Promo Spesial</h3>
                            <p class="mb-4">Diskon hingga 50% untuk produk pilihan</p>
                            <button onclick="window.location.href='{{ route('promo') }}'"
                                class="bg-white text-blue-600 px-6 py-2 rounded-full font-medium hover:bg-blue-50 transition-colors">
                                Lihat Promo
                            </button>
                        </div>
                    </div>
                </div>
                <div class="relative rounded-xl overflow-hidden shadow-lg banner-slide" style="animation-delay: 0.8s">
                    <div class="bg-gradient-to-r from-blue-400 to-blue-600 h-48 flex items-center justify-center">
                        <div class="text-white text-center p-6">
                            <h3 class="text-2xl font-bold mb-2">Produk Terbaru</h3>
                            <p class="mb-4">Koleksi terkini dengan kualitas terbaik</p>
                            <button onclick="window.location.href='{{ route('rekomendasi') }}'"
                                class="bg-white text-blue-600 px-6 py-2 rounded-full font-medium hover:bg-blue-50 transition-colors">
                                Jelajahi Sekarang
                            </button>
                        </div>
                    </div>
                    <!-- Promo cards will be loaded dynamically -->
                </div>
            </div>
        </div>
    </section>


    <!-- Categories Section -->
    <section class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Kategori Populer</h2>
                <p class="text-gray-600">Temukan produk sesuai kebutuhan Anda</p>
            </div>

            <div class="relative">
                <!-- Navigation Buttons -->
                <button onclick="scrollCategories('left')"
                    class="absolute left-0 top-1/2 transform -translate-y-1/2 z-10 bg-white rounded-full p-3 shadow-lg hover:shadow-xl transition-all -ml-2 md:-ml-4">
                    <i class="fas fa-chevron-left text-gray-600 text-lg"></i>
                </button>
                <button onclick="scrollCategories('right')"
                    class="absolute right-0 top-1/2 transform -translate-y-1/2 z-10 bg-white rounded-full p-3 shadow-lg hover:shadow-xl transition-all -mr-2 md:-mr-4">
                    <i class="fas fa-chevron-right text-gray-600 text-lg"></i>
                </button>

                <!-- Categories Container -->
                <div id="categoriesContainer" class="scroll-container overflow-x-auto flex space-x-6 pb-6 px-2 md:px-4">


                </div>
            </div>
        </div>
    </section>

    <!-- Recommended Products Section -->
    <section class="py-12 bg-white" id="recommendation-section">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">Produk Rekomendasi</h2>
                    <p class="text-gray-600">Pilihan terbaik untuk Anda</p>
                </div>
                <button onclick="window.location.href='{{ route('rekomendasi') }}'"
                    class="text-indigo-600 hover:text-indigo-800 font-medium flex items-center">
                    Lihat Semua
                    <i class="fas fa-arrow-right ml-2"></i>
                </button>
            </div>

            <!-- Add loading state container -->
            <div id="recommendation-loading" class="hidden">
                <div class="text-center py-12">
                    <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-indigo-600"></div>
                    <p class="mt-2 text-gray-600">Memuat produk rekomendasi...</p>
                </div>
            </div>

            <!-- Add error state container -->
            <div id="recommendation-error" class="hidden text-center py-12">
                <i class="fas fa-exclamation-triangle text-red-500 text-3xl"></i>
                <p class="mt-2 text-red-600">Gagal memuat produk rekomendasi</p>
                <button onclick="loadRecommendedProducts()"
                    class="mt-4 px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                    Coba Lagi
                </button>
            </div>

            <!-- Add ID to grid and data attributes to product cards -->
            <div id="recommendation-grid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <!-- Product Card 1 -->
                <div class="product-card bg-white rounded-xl shadow-md overflow-hidden cursor-pointer"
                    data-product-index="0" data-product-id="placeholder-1">
                    <div class="relative">
                        <div class="product-image bg-gray-200 h-48 flex items-center justify-center">
                            <i class="fas fa-image text-gray-400 text-4xl"></i>
                        </div>
                        <span
                            class="product-badge absolute top-2 right-2 bg-red-500 text-white px-2 py-1 rounded-full text-xs font-medium">-20%</span>
                    </div>
                    <div class="p-4">
                        <h3 class="product-name font-medium text-gray-900 mb-2">Produk Premium</h3>
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="product-price text-lg font-bold text-indigo-600">Rp 500.000</p>
                                <p class="product-original-price text-sm text-gray-500 line-through">Rp 625.000</p>
                            </div>
                            <div class="flex items-center text-yellow-400">
                                <i class="fas fa-star text-sm"></i>
                                <span class="product-rating text-sm ml-1 text-gray-600">4.5</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Product Card 2 -->
                <div class="product-card bg-white rounded-xl shadow-md overflow-hidden cursor-pointer"
                    data-product-index="1" data-product-id="placeholder-2">
                    <div class="relative">
                        <div class="product-image bg-gray-200 h-48 flex items-center justify-center">
                            <i class="fas fa-image text-gray-400 text-4xl"></i>
                        </div>
                        <span
                            class="product-badge absolute top-2 right-2 bg-green-500 text-white px-2 py-1 rounded-full text-xs font-medium">Baru</span>
                    </div>
                    <div class="p-4">
                        <h3 class="product-name font-medium text-gray-900 mb-2">Produk Trending</h3>
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="product-price text-lg font-bold text-indigo-600">Rp 350.000</p>
                                <p class="product-original-price text-sm text-gray-500 line-through">Rp 625.000</p>
                            </div>
                            <div class="flex items-center text-yellow-400">
                                <i class="fas fa-star text-sm"></i>
                                <span class="product-rating text-sm ml-1 text-gray-600">4.8</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Product Card 3 -->
                <div class="product-card bg-white rounded-xl shadow-md overflow-hidden cursor-pointer"
                    data-product-index="2" data-product-id="placeholder-3">
                    <div class="relative">
                        <div class="product-image bg-gray-200 h-48 flex items-center justify-center">
                            <i class="fas fa-image text-gray-400 text-4xl"></i>
                        </div>
                        <span
                            class="product-badge absolute top-2 right-2 bg-orange-500 text-white px-2 py-1 rounded-full text-xs font-medium">Terbatas</span>
                    </div>
                    <div class="p-4">
                        <h3 class="product-name font-medium text-gray-900 mb-2">Produk Ekonomis</h3>
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="product-price text-lg font-bold text-indigo-600">Rp 150.000</p>
                                <p class="product-original-price text-sm text-gray-500 line-through">Rp 625.000</p>
                            </div>
                            <div class="flex items-center text-yellow-400">
                                <i class="fas fa-star text-sm"></i>
                                <span class="product-rating text-sm ml-1 text-gray-600">4.2</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Product Card 4 -->
                <div class="product-card bg-white rounded-xl shadow-md overflow-hidden cursor-pointer"
                    data-product-index="3" data-product-id="placeholder-4">
                    <div class="relative">
                        <div class="product-image bg-gray-200 h-48 flex items-center justify-center">
                            <i class="fas fa-image text-gray-400 text-4xl"></i>
                        </div>
                        <span
                            class="product-badge absolute top-2 right-2 bg-orange-500 text-white px-2 py-1 rounded-full text-xs font-medium">Terbatas</span>
                    </div>
                    <div class="p-4">
                        <h3 class="product-name font-medium text-gray-900 mb-2">Produk Exclusive</h3>
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="product-price text-lg font-bold text-indigo-600">Rp 1.250.000</p>
                                <p class="product-original-price text-sm text-gray-500 line-through">Rp 625.000</p>
                            </div>
                            <div class="flex items-center text-yellow-400">
                                <i class="fas fa-star text-sm"></i>
                                <span class="product-rating text-sm ml-1 text-gray-600">4.9</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gradient-to-br from-blue-800 via-blue-900 to-indigo-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center mb-4">
                        <img class="h-8 w-auto mr-2" src="{{ asset('images/asset/logo.png') }}" alt="ADR Catalogue">
                        <span class="text-xl font-bold">ADR Catalogue</span>
                    </div>
                    <p class="text-gray-400">Temukan produk terbaik dengan harga terjangkau</p>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-4">Menu</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('home') }}"
                                class="text-blue-200 hover:text-white transition-colors">Beranda</a></li>
                        <li><a href="{{ route('promo') }}"
                                class="text-blue-200 hover:text-white transition-colors">Promo</a></li>
                        <li><a href="{{ route('kategori') }}"
                                class="text-blue-200 hover:text-white transition-colors">Kategori</a></li>
                        <li><a href="{{ route('rekomendasi') }}"
                                class="text-blue-200 hover:text-white transition-colors">Rekomendasi</a></li>
                        <li><a href="{{ route('profile') }}"
                                class="text-blue-200 hover:text-white transition-colors">Profil</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-4">Bantuan</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('faq') }}"
                                class="text-blue-200 hover:text-white transition-colors">FAQ</a></li>
                        <li><a href="{{ route('pengiriman') }}"
                                class="text-blue-200 hover:text-white transition-colors">Pengiriman</a></li>
                        <li><a href="{{ route('pengembalian') }}"
                                class="text-blue-200 hover:text-white transition-colors">Pengembalian</a></li>
                        <li><a href="{{ route('kontak') }}"
                                class="text-blue-200 hover:text-white transition-colors">Kontak</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-4">Ikuti Kami</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="text-blue-200 hover:text-white transition-colors">
                            <i class="fab fa-facebook-f text-xl"></i>
                        </a>
                        <a href="#" class="text-blue-200 hover:text-white transition-colors">
                            <i class="fab fa-instagram text-xl"></i>
                        </a>
                        <a href="#" class="text-blue-200 hover:text-white transition-colors">
                            <i class="fab fa-twitter text-xl"></i>
                        </a>
                        <a href="#" class="text-blue-200 hover:text-white transition-colors">
                            <i class="fab fa-youtube text-xl"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="border-t border-blue-700 mt-8 pt-8 text-center text-blue-200">
                <p>&copy; 2024 ADR Catalogue. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            loadRecommendedProducts();
        });

        function toggleMobileMenu() {
            const menu = document.getElementById('mobileMenu');
            menu.classList.toggle('hidden');
        }

        function scrollCategories(direction) {
            const container = document.getElementById('categoriesContainer');
            const cardWidth = container.querySelector('.category-card').offsetWidth;
            const gap = 24; // space-x-6 = 24px
            const scrollAmount = cardWidth + gap;

            if (direction === 'left') {
                container.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
            } else {
                container.scrollBy({ left: scrollAmount, behavior: 'smooth' });
            }
        }


        // Touch support for mobile swiping
        let touchStartX = 0;
        let touchEndX = 0;

        const categoriesContainer = document.getElementById('categoriesContainer');

        categoriesContainer.addEventListener('touchstart', (e) => {
            touchStartX = e.changedTouches[0].screenX;
        });

        categoriesContainer.addEventListener('touchend', (e) => {
            touchEndX = e.changedTouches[0].screenX;
            handleSwipe();
        });

        function handleSwipe() {
            const swipeThreshold = 50;
            const diff = touchStartX - touchEndX;

            if (Math.abs(diff) > swipeThreshold) {
                if (diff > 0) {
                    scrollCategories('right');
                } else {
                    scrollCategories('left');
                }
            }
        }

        // Auto-scroll categories on mobile
        let autoScrollInterval;

        function startAutoScroll() {
            autoScrollInterval = setInterval(() => {
                const container = document.getElementById('categoriesContainer');
                if (container.scrollLeft >= container.scrollWidth - container.clientWidth) {
                    container.scrollLeft = 0;
                } else {
                    container.scrollLeft += 1;
                }
            }, 30);
        }

        function stopAutoScroll() {
            clearInterval(autoScrollInterval);
        }

        // Start auto-scroll on mobile
        if (window.innerWidth < 768) {
            startAutoScroll();
        }

        // Stop auto-scroll on user interaction
        document.getElementById('categoriesContainer').addEventListener('mouseenter', stopAutoScroll);
        document.getElementById('categoriesContainer').addEventListener('touchstart', stopAutoScroll);
        document.getElementById('categoriesContainer').addEventListener('mouseleave', () => {
            if (window.innerWidth < 768) {
                startAutoScroll();
            }
        });
        document.getElementById('categoriesContainer').addEventListener('touchend', () => {
            if (window.innerWidth < 768) {
                startAutoScroll();
            }
        });

        function loadRecommendedProducts() {
            // Get DOM elements
            const grid = document.getElementById('recommendation-grid');
            const loading = document.getElementById('recommendation-loading');
            const error = document.getElementById('recommendation-error');

            // Show loading, hide grid and error
            loading.classList.remove('hidden');
            grid.classList.add('hidden');
            error.classList.add('hidden');

            // Fetch data from API
            fetch('/public/products/recommended',
                {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                }
            )
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success && data.data && data.data.length > 0) {
                        updateProductCards(data.data);
                        loading.classList.add('hidden');
                        grid.classList.remove('hidden');
                    } else {
                        throw new Error('No data received');
                    }
                })
                .catch(error => {
                    console.error('Error loading recommendations:', error);
                    loading.classList.add('hidden');
                    error.classList.remove('hidden');
                });
        }

        function updateProductCards(products) {
            // Get all product cards
            const productCards = document.querySelectorAll('.product-card');

            // Update each card with real data
            productCards.forEach((card, index) => {
                const product = products[index];

                if (product) {
                    // Update product ID
                    card.setAttribute('data-product-id', product.id);

                    // Update click event
                    card.onclick = function () {
                        window.location.href = `/product/${product.id}`;
                    };

                    // Update product name
                    const nameElement = card.querySelector('.product-name');
                    if (nameElement) {
                        nameElement.textContent = product.nama || 'Produk';
                    }

                    // Update price information
                    updateProductPrice(card, product);

                    // Update image
                    updateProductImage(card, product);

                    // Update rating (use actual rating if available, otherwise keep placeholder)
                    updateProductRating(card, product);

                    // Update badge based on promo
                    updateProductBadge(card, product, index);
                } else {
                    // If no product data for this index, hide the card
                    card.style.display = 'none';
                }
            });
        }

        function updateProductPrice(card, product) {
            const priceElement = card.querySelector('.product-price');
            const originalPriceElement = card.querySelector('.product-original-price');

            if (!priceElement) return;

            const promo = product.promo;
            const hasPromo = promo && promo.potongan_harga > 0;
            const originalPrice = product.harga_satuan || 0;

            // Calculate discounted price if promo exists
            let finalPrice = originalPrice;
            if (hasPromo) {
                const discountAmount = (promo.potongan_harga / 100) * originalPrice;
                finalPrice = originalPrice - discountAmount;
            }

            // Format currency
            const formatCurrency = (amount) => {
                return 'Rp ' + amount.toLocaleString('id-ID');
            };

            // Update prices
            priceElement.textContent = formatCurrency(finalPrice);

            // Update original price if exists
            if (originalPriceElement) {
                if (hasPromo) {
                    originalPriceElement.textContent = formatCurrency(originalPrice);
                    originalPriceElement.classList.remove('hidden');
                } else {
                    originalPriceElement.classList.add('hidden');
                    originalPriceElement.textContent = '';
                }
            }
        }

        function updateProductImage(card, product) {
            const imageContainer = card.querySelector('.product-image');
            if (!imageContainer) return;

            if (product.path_thumbnail) {
                // Replace placeholder with actual image
                imageContainer.innerHTML = `<img src="storage/${product.path_thumbnail}" alt="${product.nama}" class="w-full h-full object-cover" loading="lazy">`;
            }
            // If no thumbnail, keep the default icon
        }

        function updateProductRating(card, product) {
            const ratingElement = card.querySelector('.product-rating');
            if (!ratingElement) return;

            // Use actual rating if available, otherwise keep placeholder
            // You can implement real rating logic later
            const rating = product.rating || parseFloat(ratingElement.textContent) || 4.0;
            ratingElement.textContent = rating.toFixed(1);
        }

        function updateProductBadge(card, product, index) {
            const badgeElement = card.querySelector('.product-badge');
            if (!badgeElement) return;

            const promo = product.promo;
            const hasPromo = promo && promo.potongan_harga > 0;

            // Remove existing classes
            badgeElement.className = 'product-badge absolute top-2 right-2 text-white px-2 py-1 rounded-full text-xs font-medium';

            if (hasPromo) {
                // Show discount badge
                const discount = promo.potongan_harga;
                badgeElement.textContent = `-${discount}%`;

                // Color based on discount amount
                if (discount >= 50) {
                    badgeElement.classList.add('bg-red-500');
                } else if (discount >= 30) {
                    badgeElement.classList.add('bg-orange-500');
                } else if (discount >= 20) {
                    badgeElement.classList.add('bg-yellow-500');
                } else {
                    badgeElement.classList.add('bg-blue-500');
                }
                badgeElement.classList.remove('hidden');

            } else if (product.kuantitas !== undefined && product.kuantitas < 10 && product.kuantitas > 0) {
                // Low stock badge
                badgeElement.textContent = 'Terbatas';
                badgeElement.classList.add('bg-orange-500');
                badgeElement.classList.remove('hidden');

                // } else if (index === 1) {
                //     // Keep "Baru" badge for second product if no promo
                //     badgeElement.textContent = 'Baru';
                //     badgeElement.classList.add('bg-green-500');
                //     badgeElement.classList.remove('hidden');

                // } else if (index === 3) {
                //     // Keep "Terbatas" badge for fourth product if no promo
                //     badgeElement.textContent = 'Terbatas';
                //     badgeElement.classList.add('bg-orange-500');
                //     badgeElement.classList.remove('hidden');

            } else {
                // Hide badge if no conditions met
                badgeElement.classList.add('hidden');
            }
        }
        function toggleMobileMenu() {
            const menu = document.getElementById('mobileMenu');
            menu.classList.toggle('hidden');
        }

        const randomColors = [
            'from-blue-100 to-blue-300 text-blue-700',
            'from-blue-50 to-blue-200 text-blue-600',
            'from-sky-100 to-sky-300 text-sky-700',
            'from-indigo-100 to-indigo-300 text-indigo-700',
            'from-cyan-100 to-cyan-300 text-cyan-700',
            'from-emerald-100 to-emerald-300 text-emerald-700',
            'from-teal-100 to-teal-300 text-teal-700',
            'from-amber-100 to-amber-300 text-amber-700',
            'from-purple-100 to-purple-300 text-purple-700',
            'from-pink-100 to-pink-300 text-pink-700',
            'from-rose-100 to-rose-300 text-rose-700',
            'from-violet-100 to-violet-300 text-violet-700'
        ];

        // Function to get a random color combination
        function getRandomColor() {
            return randomColors[Math.floor(Math.random() * randomColors.length)];
        }

        // Function to load categories
        async function loadCategories() {
            try {
                const response = await fetch('/public/categories');
                const result = await response.json();

                if (result.success) {
                    const categories = result.data;
                    const container = document.getElementById('categoriesContainer');

                    // Clear existing static content and add loading indicator
                    container.innerHTML = '<div class="flex space-x-6 w-full">' +
                        Array(4).fill().map(() => `
                            <div class="flex-shrink-0 w-48 md:w-56">
                                <div class="bg-gradient-to-br from-gray-200 to-gray-300 rounded-2xl p-8 text-center h-48 flex flex-col items-center justify-center animate-pulse">
                                    <div class="w-12 h-12 md:w-16 md:h-16 bg-gray-400 rounded-full mb-4"></div>
                                    <div class="h-4 bg-gray-400 rounded w-24"></div>
                                </div>
                            </div>
                        `).join('') + '</div>';

                    // Wait a moment for smooth transition
                    await new Promise(resolve => setTimeout(resolve, 500));

                    // Clear and create dynamic categories
                    container.innerHTML = '';

                    categories.forEach(category => {
                        const randomColor = getRandomColor().split(' ');
                        const gradientClass = `${randomColor[0]} ${randomColor[1]}`;
                        const textColorClass = randomColor[2];

                        // Create category card
                        const categoryCard = document.createElement('div');
                        categoryCard.className = 'category-card flex-shrink-0 w-48 md:w-56 cursor-pointer';
                        categoryCard.setAttribute('data-category-id', category.id);

                        // Add click handler
                        categoryCard.addEventListener('click', () => {
                            window.location.href = `/categories/${category.id}`;
                        });

                        // Check if category has thumbnail
                        const hasThumbnail = category.path_thumbnail && category.path_thumbnail.trim() !== '';

                        // Create card content
                        categoryCard.innerHTML = `
                            <div class="bg-gradient-to-br ${gradientClass} rounded-2xl p-8 text-center h-48 flex flex-col items-center justify-center transition-all duration-300 hover:shadow-xl">
                                <div class="w-16 h-16 md:w-20 md:h-20 rounded-full flex items-center justify-center mb-4" style="background: rgba(255,255,255,0.3)">
                                    <span class="text-2xl md:text-3xl font-bold ${textColorClass}">${category.nama.charAt(0)}</span>
                                </div>

                                <div class="w-full px-1">
                                    <h3 class="font-semibold text-gray-800 text-lg mb-1 truncate" title="${category.nama}">
                                        ${category.nama}
                                    </h3>
                                </div>
                            </div>
                        `;


                        container.appendChild(categoryCard);
                    });

                    // If no categories found
                    if (categories.length === 0) {
                        container.innerHTML = `
                            <div class="w-full text-center py-12">
                                <i class="fas fa-inbox text-4xl text-gray-400 mb-4"></i>
                                <p class="text-gray-600">Belum ada kategori</p>
                                <p class="text-sm text-gray-500 mt-1">Kategori akan muncul di sini</p>
                            </div>
                        `;
                    }

                } else {
                    throw new Error(result.message || 'Failed to load categories');
                }
            } catch (error) {
                console.error('Error loading categories:', error);
                const container = document.getElementById('categoriesContainer');
                container.innerHTML = `
                    <div class="w-full text-center py-12">
                        <i class="fas fa-exclamation-triangle text-4xl text-red-400 mb-4"></i>
                        <p class="text-gray-600">Gagal memuat kategori</p>
                        <button onclick="loadCategories()" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition text-sm">
                            Coba Lagi
                        </button>
                    </div>
                `;
            }
        }

        // Add this function to your existing DOMContentLoaded event listener
        document.addEventListener('DOMContentLoaded', function () {
            loadRecommendedProducts();
            loadCategories(); // Add this line

            // Your existing functions remain unchanged
            // ... all your existing toggleMobileMenu, scrollCategories, etc...
        });

        // Update the scrollCategories function to work with dynamic content
        function scrollCategories(direction) {
            const container = document.getElementById('categoriesContainer');
            if (!container.children.length) return;

            // Get the first category card for width calculation
            const firstCard = container.querySelector('.category-card');
            if (!firstCard) return;

            const cardWidth = firstCard.offsetWidth;
            const gap = 24; // space-x-6 = 24px
            const scrollAmount = cardWidth + gap;

            if (direction === 'left') {
                container.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
            } else {
                container.scrollBy({ left: scrollAmount, behavior: 'smooth' });
            }
        }


        categoriesContainer.addEventListener('touchstart', (e) => {
            touchStartX = e.changedTouches[0].screenX;
        });

        categoriesContainer.addEventListener('touchend', (e) => {
            touchEndX = e.changedTouches[0].screenX;
            handleSwipe();
        });

        // Add CSS for better category card styling
        const style = document.createElement('style');
        style.textContent = `
            .category-card {
                transition: transform 0.3s ease;
            }

            .category-card:hover {
                transform: translateY(-4px);
            }

            .category-card:active {
                transform: translateY(-2px);
            }

            #categoriesContainer {
                scroll-behavior: smooth;
                -webkit-overflow-scrolling: touch;
            }

            /* Hide scrollbar but keep functionality */
            #categoriesContainer::-webkit-scrollbar {
                height: 4px;
            }

            #categoriesContainer::-webkit-scrollbar-track {
                background: #f1f1f1;
                border-radius: 2px;
            }

            #categoriesContainer::-webkit-scrollbar-thumb {
                background: #888;
                border-radius: 2px;
            }

            #categoriesContainer::-webkit-scrollbar-thumb:hover {
                background: #555;
            }
        `;
        document.head.appendChild(style);

        // Function to refresh categories (optional, can be called manually)
        function refreshCategories() {
            loadCategories();
        }

    </script>

    <!-- Chat Bot Component -->
    @include('components.chat_bot')
</body>

</html>