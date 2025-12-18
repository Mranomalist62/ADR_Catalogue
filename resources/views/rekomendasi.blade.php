<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekomendasi - ADR Catalogue</title>
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

        .rekomendasi-gradient {
            background: linear-gradient(135deg, #bfdbfe 0%, #93c5fd 25%, #60a5fa 50%, #3b82f6 75%, #2563eb 100%);
        }

        .light-blue-gradient {
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 25%, #93c5fd 50%, #60a5fa 75%, #3b82f6 100%);
        }

        .product-card {
            transition: all 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .slide-in {
            animation: slideIn 0.5s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            animation: fadeIn 0.8s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .tab-active {
            border-bottom: 3px solid #4f46e5;
            color: #4f46e5;
        }

        .filter-badge {
            transition: all 0.2s ease;
        }

        .filter-badge:hover {
            transform: scale(1.05);
        }

        .wishlist-btn {
            transition: all 0.3s ease;
        }

        .wishlist-btn:hover {
            transform: scale(1.1);
        }

        .wishlist-btn.active {
            color: #ef4444;
        }


        /* Line clamp with consistent height */
        .line-clamp-1 {
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            min-height: 3em;
            line-height: 1.2em;
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            min-height: 1.2 em;
            /* 2 lines */
            line-height: 1.2em;
        }

        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            min-height: 1.2em;
            /* 3 lines */
            line-height: 1.2em;
        }


        .text-sm {
            font-size: 0.875rem;
            /* 14px */
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

    <!-- Header Section -->
    <section class="rekomendasi-gradient text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center slide-in">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Produk Rekomendasi</h1>
                <p class="text-xl opacity-90 max-w-2xl mx-auto">
                    Temukan produk pilihan terbaik dengan kualitas terjamin
                </p>
            </div>
        </div>
    </section>

    <!-- Filter and Sort Section -->
    <section class="py-8 bg-white sticky top-16 z-40 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-4 items-center justify-between">
                <!-- Tabs -->
                <div class="flex space-x-1 bg-gray-100 p-1 rounded-lg">
                    <button onclick="switchTab('rekomendasi')" id="tab-rekomendasi"
                        class="tab-btn px-4 py-2 rounded-md text-sm font-medium transition-colors tab-active">
                        <i class="fas fa-star mr-2"></i>Rekomendasi
                    </button>
                    <button onclick="switchTab('terbaru')" id="tab-terbaru"
                        class="tab-btn px-4 py-2 rounded-md text-sm font-medium text-gray-600 hover:text-gray-800 transition-colors">
                        <i class="fas fa-clock mr-2"></i>Terbaru
                    </button>
                    <button onclick="switchTab('diskon')" id="tab-diskon"
                        class="tab-btn px-4 py-2 rounded-md text-sm font-medium text-gray-600 hover:text-gray-800 transition-colors">
                        <i class="fas fa-percentage mr-2"></i>Diskon
                    </button>
                </div>

                <!-- Search and Filters -->
                <!-- Search and Filters -->
                <div class="flex flex-col flex-grow sm:flex-row gap-3 items-center">
                    <div class="relative flex-grow">
                        <input type="text" id="search-input" placeholder="Cari produk..."
                            class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent w-full">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                    </div>

                    <select id="category-filter"
                        class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        <option value="all">Semua Kategori</option>
                        <!-- Dynamic categories will be loaded here -->
                    </select>

                    <select id="sort-filter"
                        class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        <option value="rekomendasi">Urutkan: Rekomendasi</option>
                        <option value="harga_terendah">Urutkan: Harga Terendah</option>
                        <option value="harga_tertinggi">Urutkan: Harga Tertinggi</option>
                        <option value="terbaru">Urutkan: Terbaru</option>
                    </select>

                    <button id="reset-filters" onclick="resetFilters()"
                        class="px-3 py-2 text-gray-600 hover:text-gray-800 font-medium hidden">
                        <i class="fas fa-times mr-1"></i>Reset Filter
                    </button>
                </div>
            </div>

            {{-- <!-- Filter Badges -->
            <div class="flex flex-wrap gap-2 mt-4">
                <span class="filter-badge px-3 py-1 bg-indigo-100 text-indigo-700 rounded-full text-sm cursor-pointer">
                    <i class="fas fa-check mr-1"></i>Elektronik
                </span>
                <span
                    class="filter-badge px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm cursor-pointer hover:bg-gray-200">
                    <i class="fas fa-times mr-1"></i>Harga < 500k </span>
                        <span
                            class="filter-badge px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm cursor-pointer hover:bg-gray-200">
                            <i class="fas fa-times mr-1"></i>Rating 4+
                        </span>
                        <button class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">
                            Hapus Semua Filter
                        </button>
            </div> --}}
        </div>
    </section>

    <!-- Products Grid -->
    <section class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Tab Content Containers -->
            <div id="content-rekomendasi" class="tab-content">
                <div id="products-grid-rekomendasi"
                    class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    <!-- Dynamic products will be inserted here -->
                </div>
                <!-- Pagination for rekomendasi -->
                <div id="pagination-rekomendasi" class="mt-8 flex justify-center items-center space-x-2"></div>
            </div>

            <div id="content-terbaru" class="tab-content hidden">
                <div id="products-grid-terbaru"
                    class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    <!-- Dynamic products will be inserted here -->
                </div>
                <!-- Pagination for terbaru -->
                <div id="pagination-terbaru" class="mt-8 flex justify-center items-center space-x-2"></div>
            </div>

            <div id="content-diskon" class="tab-content hidden">
                <div id="products-grid-diskon"
                    class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    <!-- Dynamic products will be inserted here -->
                </div>
                <!-- Pagination for diskon -->
                <div id="pagination-diskon" class="mt-8 flex justify-center items-center space-x-2"></div>
            </div>

            <!-- Loading Template -->
            <template id="loading-template">
                <div class="col-span-full text-center py-12 fade-in">
                    <div
                        class="inline-block animate-spin rounded-full h-12 w-12 border-4 border-indigo-600 border-t-transparent">
                    </div>
                    <p class="mt-4 text-gray-600 text-lg">Memuat produk...</p>
                </div>
            </template>

            <!-- No Products Template -->
            <template id="no-products-template">
                <div class="col-span-full text-center py-16 slide-in">
                    <i class="fas fa-box-open text-gray-400 text-6xl mb-4"></i>
                    <h3 class="text-2xl font-medium text-gray-900 mb-2">Tidak ada produk ditemukan</h3>
                    <p class="text-gray-600 mb-6">Coba pilih kategori lain atau hapus beberapa filter.</p>
                    <button onclick="loadCurrentTab()"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg font-medium transition-colors">
                        <i class="fas fa-redo mr-2"></i>Muat Ulang
                    </button>
                </div>
            </template>

            <!-- Error Template -->
            <template id="error-template">
                <div class="col-span-full text-center py-16 slide-in">
                    <i class="fas fa-exclamation-triangle text-red-500 text-6xl mb-4"></i>
                    <h3 class="text-2xl font-medium text-gray-900 mb-2">Terjadi kesalahan</h3>
                    <p class="text-gray-600 mb-6">Gagal memuat produk. Silakan coba lagi.</p>
                    <button onclick="loadCurrentTab()"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg font-medium transition-colors">
                        <i class="fas fa-redo mr-2"></i>Coba Lagi
                    </button>
                </div>
            </template>
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
        // State management
        let currentTab = 'rekomendasi';
        let currentPage = {
            'rekomendasi': 1,
            'terbaru': 1,
            'diskon': 1
        };
        let currentFilters = {
            'rekomendasi': {
                search: '',
                category: 'all',
                sort: 'rekomendasi'
            },
            'terbaru': {
                search: '',
                category: 'all',
                sort: 'terbaru'
            },
            'diskon': {
                search: '',
                category: 'all',
                sort: 'rekomendasi'
            }
        };
        const perPage = 8;
        let isLoading = false;
        let categories = [];
        let searchTimeout = null;

        // Tab switching
        function switchTab(tabName) {
            if (isLoading) return;

            currentTab = tabName;

            // Update tab UI
            document.querySelectorAll('.tab-btn').forEach(tab => {
                tab.classList.remove('tab-active');
                tab.classList.add('text-gray-600');
            });

            const selectedTab = document.getElementById(`tab-${tabName}`);
            selectedTab.classList.add('tab-active');
            selectedTab.classList.remove('text-gray-600');

            // Show/hide content
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.add('hidden');
            });
            document.getElementById(`content-${tabName}`).classList.remove('hidden');

            // Update filter UI for this tab
            updateFilterUI();

            // Check if we have URL category parameter
            const urlParams = new URLSearchParams(window.location.search);
            const categoryParam = urlParams.get('category');

            if (categoryParam && tabName === 'rekomendasi') {
                // Keep the category filter from URL
                currentFilters['rekomendasi'].category = categoryParam;
                updateFilterUI();
                loadCurrentTabWithFilters(1);
            } else {
                // Load data for this tab with its filters
                loadCurrentTabWithFilters(1);
            }
        }

        // Update filter UI based on current tab
        function updateFilterUI() {
            const filters = currentFilters[currentTab];
            const searchInput = document.getElementById('search-input');
            const categoryFilter = document.getElementById('category-filter');
            const sortFilter = document.getElementById('sort-filter');
            const resetBtn = document.getElementById('reset-filters');

            // Update UI with current tab's filters
            if (searchInput) searchInput.value = filters.search;
            if (categoryFilter) categoryFilter.value = filters.category;
            if (sortFilter) sortFilter.value = filters.sort;

            // Show/hide reset button
            if (resetBtn) {
                const hasActiveFilters = filters.search ||
                    filters.category !== 'all' ||
                    (filters.sort !== getDefaultSortForTab(currentTab));

                if (hasActiveFilters) {
                    resetBtn.classList.remove('hidden');
                } else {
                    resetBtn.classList.add('hidden');
                }
            }
        }

        // Get default sort value for each tab
        function getDefaultSortForTab(tabName) {
            const defaults = {
                'rekomendasi': 'rekomendasi',
                'terbaru': 'terbaru',
                'diskon': 'rekomendasi'
            };
            return defaults[tabName] || 'rekomendasi';
        }

        // Load categories on page load
        async function loadCategories() {
            try {
                const response = await fetch('/public/categories');
                const data = await response.json();

                if (data.success && data.data) {
                    categories = data.data;
                    populateCategoryFilter();
                }
            } catch (error) {
                console.error('Failed to load categories:', error);
            }
        }

        // Populate category dropdown
        function populateCategoryFilter() {
            const categoryFilter = document.getElementById('category-filter');
            if (!categoryFilter) return;

            // Clear existing options except the first one
            while (categoryFilter.options.length > 1) {
                categoryFilter.remove(1);
            }

            // Add categories
            categories.forEach(category => {
                const option = document.createElement('option');
                option.value = category.id;
                option.textContent = category.nama;
                categoryFilter.appendChild(option);
            });

            // Set initial value based on current tab
            updateFilterUI();
        }

        // Debounced search function
        function handleSearchInput() {
            const searchInput = document.getElementById('search-input');
            if (!searchInput) return;

            const searchValue = searchInput.value.trim();

            // Update current tab's search filter
            currentFilters[currentTab].search = searchValue;

            // Clear previous timeout
            if (searchTimeout) {
                clearTimeout(searchTimeout);
            }

            // Set new timeout for debouncing (500ms delay)
            searchTimeout = setTimeout(() => {
                loadCurrentTabWithFilters();
            }, 500);
        }

        // Handle category/sort filter changes
        function handleFilterChange() {
            const categoryFilter = document.getElementById('category-filter');
            const sortFilter = document.getElementById('sort-filter');

            if (!categoryFilter || !sortFilter) return;

            // Update current tab's filters
            currentFilters[currentTab].category = categoryFilter.value;
            currentFilters[currentTab].sort = sortFilter.value;

            // Show reset button if filters are active
            const filters = currentFilters[currentTab];
            const resetBtn = document.getElementById('reset-filters');
            if (resetBtn) {
                const hasActiveFilters = filters.search ||
                    filters.category !== 'all' ||
                    (filters.sort !== getDefaultSortForTab(currentTab));

                if (hasActiveFilters) {
                    resetBtn.classList.remove('hidden');
                }
            }

            // Load products with updated filters
            loadCurrentTabWithFilters();
        }

        // Load current tab with its filters
        async function loadCurrentTabWithFilters(page = 1) {
            currentPage[currentTab] = page;
            await loadTabData(currentTab, page, true);
        }

        // Load data for a specific tab and page with optional filters
        async function loadTabData(tabName, page = 1, useFilters = false) {
            if (isLoading) return;

            isLoading = true;
            currentPage[tabName] = page;

            const endpoints = {
                'rekomendasi': '/public/products/recommended',
                'terbaru': '/public/products/terbaru',
                'diskon': '/public/products/diskon'
            };

            const gridContainer = document.getElementById(`products-grid-${tabName}`);
            const paginationContainer = document.getElementById(`pagination-${tabName}`);

            // Show loading
            const loadingTemplate = document.getElementById('loading-template');
            const loadingClone = loadingTemplate.content.cloneNode(true);
            gridContainer.innerHTML = '';
            gridContainer.appendChild(loadingClone);
            paginationContainer.innerHTML = '';

            // Build URL
            let url = '';
            const filters = currentFilters[tabName];
            const hasActiveFilters = useFilters && (filters.search || filters.category !== 'all' || filters.sort !== getDefaultSortForTab(tabName));

            if (hasActiveFilters) {
                // Use search endpoint with filters
                const params = new URLSearchParams();
                params.append('q', filters.search || '');
                params.append('category_id', filters.category);
                params.append('sort_by', filters.sort);
                params.append('page', page);
                params.append('per_page', perPage);

                // Add tab-specific parameter
                if (tabName === 'rekomendasi') {
                    params.append('tab', 'recommended');
                } else if (tabName === 'diskon') {
                    params.append('only_discount', 'true');
                }

                url = `/public/products/search?${params.toString()}`;
            } else {
                // Use tab-specific endpoint
                url = `${endpoints[tabName]}?page=${page}&per_page=${perPage}`;
            }

            console.log(`Loading ${tabName} page ${page} from: ${url}`);
            console.log('Filters:', hasActiveFilters ? filters : 'No active filters');

            try {
                const response = await fetch(url);
                if (!response.ok) throw new Error(`HTTP ${response.status}`);

                const data = await response.json();
                console.log(`${tabName} data received:`, data);
                isLoading = false;

                if (data.success && data.data && data.data.length > 0) {
                    renderProducts(gridContainer, data.data, tabName);
                    renderPagination(paginationContainer, data.pagination, tabName);

                    // Update result count
                    updateResultCount(tabName, data.pagination?.total || data.data.length);
                } else {
                    showNoProducts(gridContainer, tabName);
                }
            } catch (error) {
                console.error(`Error loading ${tabName}:`, error);
                isLoading = false;
                showError(gridContainer, tabName);
            }
        }

        // Reset filters for current tab
        function resetFilters() {
            // Reset current tab's filters to defaults
            currentFilters[currentTab] = {
                search: '',
                category: 'all',
                sort: getDefaultSortForTab(currentTab)
            };

            // Clear URL parameters
            if (window.history.replaceState) {
                const url = new URL(window.location);
                url.searchParams.delete('category');
                window.history.replaceState({}, '', url);
            }

            // Update UI
            updateFilterUI();

            // Reload current tab without filters
            loadTabData(currentTab, 1, false);
        }

        // Update result count in tab button
        function updateResultCount(tabName, count) {
            const tabButton = document.getElementById(`tab-${tabName}`);
            if (!tabButton) return;

            // Remove any existing count spans first
            const existingSpans = tabButton.querySelectorAll('.tab-count, .ml-1');
            existingSpans.forEach(span => span.remove());

            // Add new count span
            const countSpan = document.createElement('span');
            countSpan.className = 'ml-1 bg-blue-100 text-blue-700 text-xs px-2 py-0.5 rounded-full';
            countSpan.textContent = count;
            tabButton.appendChild(countSpan);
        }

        // === KEEP ALL YOUR EXISTING FUNCTIONS BELOW ===

        // Render products in grid
        function renderProducts(container, products, tabName) {
            container.innerHTML = '';

            if (products.length === 0) {
                showNoProducts(container, tabName);
                return;
            }

            products.forEach((product, index) => {
                const card = createProductCard(product, tabName, index);
                container.appendChild(card);
            });
        }

        // Create product card matching your design
        function createProductCard(product, tabName, index) {
            const card = document.createElement('div');
            card.className = `product-card bg-white rounded-xl shadow-lg overflow-hidden slide-in cursor-pointer`;
            card.style.animationDelay = `${index * 0.05}s`;
            card.dataset.productId = product.id;

            // Calculate price with discount
            const originalPrice = product.harga_satuan || 0;
            let finalPrice = originalPrice;
            let discountBadge = '';
            let discountAmount = 0;

            if (product.promo && product.promo.potongan_harga > 0) {
                discountAmount = product.promo.potongan_harga;
                finalPrice = originalPrice - (originalPrice * discountAmount / 100);
                discountBadge = `<span class="absolute top-3 left-3 bg-red-500 text-white px-2 py-1 rounded-full text-xs font-medium">-${discountAmount}%</span>`;
            }

            // Tab-specific badges
            let extraBadge = '';
            if (tabName === 'rekomendasi' && product.total_orders > 10) {
                extraBadge = `<span class="absolute top-12 left-3 bg-blue-500 text-white px-2 py-1 rounded-full text-xs font-medium">🔥 Populer</span>`;
            } else if (tabName === 'terbaru') {
                const isNew = isProductNew(product.created_at);
                if (isNew) {
                    extraBadge = `<span class="absolute top-3 left-3 bg-green-500 text-white px-2 py-1 rounded-full text-xs font-medium">Baru</span>`;
                }
            }


            // Stock status
            let stockBadge = '';
            if (product.kuantitas > 10) {
                stockBadge = `<span class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded-full">Stok</span>`;
            } else if (product.kuantitas > 0 && product.kuantitas <= 10) {
                stockBadge = `<span class="text-xs bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full">Stok ${product.kuantitas}</span>`;
            } else {
                stockBadge = `<span class="text-xs bg-red-100 text-red-700 px-2 py-1 rounded-full">Habis</span>`;
            }

            // Format prices for display
            const formatPrice = (price) => {
                return 'Rp ' + price.toLocaleString('id-ID');
            };

            card.innerHTML = `
                <div class="relative">
                    <div class="bg-gray-200 h-48 flex items-center justify-center overflow-hidden">
                        ${product.path_thumbnail ?
                    `<img src="/storage/${product.path_thumbnail}" alt="${product.nama}" class="w-full h-full object-cover hover:scale-110 transition-transform duration-500">` :
                    `<i class="fas fa-box text-gray-400 text-4xl"></i>`
                }
                    </div>
                    <button onclick="toggleWishlist(this)" class="wishlist-btn absolute top-3 right-3 w-8 h-8 bg-white rounded-full flex items-center justify-center shadow-md hover:bg-red-50 transition-colors">
                        <i class="far fa-heart text-gray-600"></i>
                    </button>
                    ${discountBadge}
                </div>
                <div class="p-4">
                    <h3 class="font-medium text-gray-900 mb-2 line-clamp-1" title="${product.nama}">${product.nama}</h3>
                    <div class="text-sm text-gray-600 mb-3 line-clamp-2 desc-container" style="min-height: 2.4em; line-height: 1.2em;">
                        ${product.desc || 'Deskripsi produk tidak tersedia'}
                    </div>
                    <div class="flex items-center justify-between mb-3">
                        <div>
                            <p class="text-lg font-bold text-indigo-600">${formatPrice(finalPrice)}</p>
                            ${discountAmount > 0 ?
                    `<p class="text-sm text-gray-500 line-through">${formatPrice(originalPrice)}</p>` :
                    ''
                }
                        </div>
                        ${stockBadge}
                    </div>
                    <button onclick="addToCart(${product.id})" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-2 rounded-lg transition-colors">
                        <i class="fas fa-shopping-cart mr-2"></i>Tambah ke Keranjang
                    </button>
                </div>
            `;

            // Add click event for product detail
            card.addEventListener('click', function (e) {
                // Don't navigate if clicking buttons
                if (!e.target.closest('button') && !e.target.closest('.wishlist-btn')) {
                    window.location.href = `/product/${product.id}`;
                }
            });

            return card;
        }

        // Check if product is new (less than 7 days)
        function isProductNew(createdAt) {
            if (!createdAt) return false;
            const createdDate = new Date(createdAt);
            const weekAgo = new Date(Date.now() - 7 * 24 * 60 * 60 * 1000);
            return createdDate > weekAgo;
        }

        // Render pagination buttons
        function renderPagination(container, pagination, tabName) {
            if (!pagination || pagination.last_page <= 1) {
                container.innerHTML = '';
                return;
            }

            let paginationHtml = '';

            // Previous button
            if (pagination.current_page > 1) {
                paginationHtml += `
                    <button onclick="changePage('${tabName}', ${pagination.current_page - 1})"
                            class="px-4 py-2 bg-white border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition-colors">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                `;
            }

            // Page numbers
            for (let i = 1; i <= pagination.last_page; i++) {
                if (i === pagination.current_page) {
                    paginationHtml += `
                        <button onclick="changePage('${tabName}', ${i})"
                                class="px-4 py-2 bg-indigo-600 text-white rounded-md font-medium">
                            ${i}
                        </button>
                    `;
                } else if (i === 1 || i === pagination.last_page ||
                    (i >= pagination.current_page - 1 && i <= pagination.current_page + 1)) {
                    paginationHtml += `
                        <button onclick="changePage('${tabName}', ${i})"
                                class="px-4 py-2 bg-white border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition-colors">
                            ${i}
                        </button>
                    `;
                } else if (i === pagination.current_page - 2 || i === pagination.current_page + 2) {
                    paginationHtml += `<span class="px-2 text-gray-500">...</span>`;
                }
            }

            // Next button
            if (pagination.current_page < pagination.last_page) {
                paginationHtml += `
                    <button onclick="changePage('${tabName}', ${pagination.current_page + 1})"
                            class="px-4 py-2 bg-white border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition-colors">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                `;
            }

            // Page info
            paginationHtml += `
                <span class="text-sm text-gray-600 ml-4">
                    Halaman ${pagination.current_page} dari ${pagination.last_page}
                </span>
            `;

            container.innerHTML = paginationHtml;
        }

        // Change page function
        function changePage(tabName, page) {
            if (page === currentPage[tabName]) return;

            // Check if we should use filters
            const filters = currentFilters[tabName];
            const useFilters = filters.search || filters.category !== 'all' || filters.sort !== getDefaultSortForTab(tabName);

            loadTabData(tabName, page, useFilters);

            // Scroll to top of products grid
            document.getElementById(`products-grid-${tabName}`).scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }

        // Show no products message
        function showNoProducts(container, tabName) {
            const noProductsTemplate = document.getElementById('no-products-template');
            const noProductsClone = noProductsTemplate.content.cloneNode(true);
            container.innerHTML = '';
            container.appendChild(noProductsClone);
        }

        // Show error message
        function showError(container, tabName) {
            const errorTemplate = document.getElementById('error-template');
            const errorClone = errorTemplate.content.cloneNode(true);
            container.innerHTML = '';
            container.appendChild(errorClone);
        }

        // Toggle wishlist (placeholder function)
        function toggleWishlist(button) {
            const icon = button.querySelector('i');
            if (icon.classList.contains('far')) {
                icon.classList.remove('far');
                icon.classList.add('fas');
                button.classList.add('active');
                // Here you would call API to add to wishlist
            } else {
                icon.classList.remove('fas');
                icon.classList.add('far');
                button.classList.remove('active');
                // Here you would call API to remove from wishlist
            }
        }

        // Add to cart (placeholder function)
        function addToCart(productId) {
            event.stopPropagation(); // Prevent card click
            console.log('Adding product to cart:', productId);
            // Here you would call API to add to cart
            alert('Produk ditambahkan ke keranjang!');
        }

        // Initialize on page load
        async function initializePage() {
            // Load categories first
            await loadCategories();

            // Setup event listeners for filters
            const searchInput = document.getElementById('search-input');
            if (searchInput) {
                searchInput.addEventListener('input', handleSearchInput);
            }

            const categoryFilter = document.getElementById('category-filter');
            if (categoryFilter) {
                categoryFilter.addEventListener('change', handleFilterChange);
            }

            const sortFilter = document.getElementById('sort-filter');
            if (sortFilter) {
                sortFilter.addEventListener('change', handleFilterChange);
            }

            // Check for URL parameters
            const urlParams = new URLSearchParams(window.location.search);
            const categoryParam = urlParams.get('category');

            if (categoryParam) {
                // Auto-select the category in filter
                currentFilters['rekomendasi'].category = categoryParam;

                // Make sure rekomendasi tab is active
                switchTab('rekomendasi');

                // Update UI and load with filter
                setTimeout(() => {
                    updateFilterUI();
                    loadCurrentTabWithFilters(1);
                }, 100);
            } else {
                // Load initial data normally
                loadTabData('rekomendasi', 1, false);
            }
        }

        // Preserve your original functions
        function toggleMobileMenu() {
            const menu = document.getElementById('mobileMenu');
            menu.classList.toggle('hidden');
        }

        // Update document ready
        document.addEventListener('DOMContentLoaded', function () {
            initializePage();
        });

        // Filter badge functionality (preserving your original)
        document.querySelectorAll('.filter-badge').forEach(badge => {
            badge.addEventListener('click', function () {
                if (this.classList.contains('bg-indigo-100')) {
                    // Remove filter
                    this.classList.remove('bg-indigo-100', 'text-indigo-700');
                    this.classList.add('bg-gray-100', 'text-gray-700');
                    const icon = this.querySelector('i');
                    icon.classList.remove('fa-check');
                    icon.classList.add('fa-times');
                } else {
                    // Add filter
                    this.classList.remove('bg-gray-100', 'text-gray-700');
                    this.classList.add('bg-indigo-100', 'text-indigo-700');
                    const icon = this.querySelector('i');
                    icon.classList.remove('fa-times');
                    icon.classList.add('fa-check');
                }
            });
        });

        function toggleMobileMenu() {
            const menu = document.getElementById('mobileMenu');
            menu.classList.toggle('hidden');
        }
    </script>

    <!-- Chat Bot Component (Available for all users) -->
    @include('components.chat_bot')
</body>

</html>