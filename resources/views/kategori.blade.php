<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori - ADR Catalogue</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .category-gradient {
            background: linear-gradient(135deg, #bfdbfe 0%, #93c5fd 25%, #60a5fa 50%, #3b82f6 75%, #2563eb 100%);
        }
        .light-blue-gradient {
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 25%, #93c5fd 50%, #60a5fa 75%, #3b82f6 100%);
        }
        .category-card {
            transition: all 0.3s ease;
        }
        .category-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }
        .category-icon {
            transition: all 0.3s ease;
        }
        .category-card:hover .category-icon {
            transform: scale(1.1) rotate(5deg);
        }
        .slide-in {
            animation: slideIn 0.5s ease-out;
        }
        @keyframes slideIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .fade-in {
            animation: fadeIn 0.8s ease-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
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
                            <img class="h-10 w-auto transition-transform duration-300 group-hover:scale-110" src="{{ asset('images/asset/logo.png') }}" alt="ADR Catalogue">
                            <div class="absolute inset-0 bg-gradient-to-r from-blue-500/20 to-purple-500/20 rounded-lg blur-md opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>
                    </div>
                    <div class="hidden md:block">
                        <div class="ml-10 flex items-baseline space-x-1">
                            <a href="{{ route('home') }}" class="nav-link group relative px-4 py-2 text-gray-700 hover:text-blue-600 font-medium transition-all duration-300">
                                <span class="flex items-center">
                                    <i class="fas fa-home mr-2 text-sm group-hover:animate-pulse"></i>
                                    <span class="relative">
                                        Beranda
                                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-blue-500 to-purple-500 group-hover:w-full transition-all duration-300"></span>
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
                            <a href="{{ route('kategori') }}" class="nav-link group relative px-4 py-2 text-blue-600 font-medium transition-all duration-300">
                                <span class="flex items-center">
                                    <i class="fas fa-th-large mr-2 text-sm group-hover:animate-pulse"></i>
                                    <span class="relative">
                                        Kategori
                                        <span class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-blue-500 to-purple-500"></span>
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
                <a href="{{ route('home') }}" class="mobile-nav-link group block px-4 py-3 text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg font-medium transition-all duration-300">
                    <i class="fas fa-home mr-3 group-hover:animate-pulse"></i>
                    Beranda
                </a>
                <a href="{{ route('promo') }}" class="mobile-nav-link group block px-4 py-3 text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg font-medium transition-all duration-300">
                    <i class="fas fa-tags mr-3 group-hover:animate-pulse"></i>
                    Promo
                </a>
                <a href="{{ route('kategori') }}" class="mobile-nav-link group block px-4 py-3 text-blue-600 hover:bg-blue-50 rounded-lg font-medium transition-all duration-300">
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
                <a href="{{ route('profile') }}" class="mobile-nav-link group block px-4 py-3 text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg font-medium transition-all duration-300">
                    <i class="fas fa-building mr-3 group-hover:animate-pulse"></i>
                    Profil
                </a>
                <a href="{{ route('login') }}" class="mobile-nav-link group block px-4 py-3 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white rounded-lg font-medium transition-all duration-300 transform hover:scale-105">
                    <i class="fas fa-user mr-3 group-hover:animate-bounce"></i>
                    Masuk/Daftar
                </a>
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
    <section class="category-gradient text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
           
            <div class="text-center slide-in">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Jelajahi Kategori</h1>
                <p class="text-xl opacity-90 max-w-2xl mx-auto">
                    Temukan berbagai kategori produk yang sesuai dengan kebutuhan Anda
                </p>
            </div>
        </div>
    </section>

    <!-- Search and Filter Section -->
    <section class="py-8 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row gap-4 items-center justify-between">
                <div class="relative flex-1 max-w-md">
                    <input type="text" 
                           placeholder="Cari kategori..." 
                           class="w-full px-4 py-3 pl-12 pr-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                </div>
                
                <div class="flex gap-2">
                    <button onclick="filterCategories('all')" class="filter-btn px-4 py-2 bg-indigo-600 text-white rounded-lg transition-colors">
                        Semua
                    </button>
                    <button onclick="filterCategories('popular')" class="filter-btn px-4 py-2 bg-gray-200 text-gray-700 hover:bg-gray-300 rounded-lg transition-colors">
                        Populer
                    </button>
                    <button onclick="filterCategories('new')" class="filter-btn px-4 py-2 bg-gray-200 text-gray-700 hover:bg-gray-300 rounded-lg transition-colors">
                        Terbaru
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories Grid -->
    <section class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <!-- Elektronik -->
                <div class="category-card bg-white rounded-xl shadow-lg overflow-hidden cursor-pointer slide-in" style="animation-delay: 0.1s" onclick="window.location.href='#'">
                    <div class="bg-gradient-to-br from-blue-400 to-blue-600 p-8 text-center">
                        <div class="category-icon inline-flex items-center justify-center w-20 h-20 bg-white rounded-full mb-4">
                            <i class="fas fa-laptop text-3xl text-blue-600"></i>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-2">Elektronik</h3>
                        <p class="text-blue-100 text-sm">245 Produk</p>
                    </div>
                    <div class="p-4">
                        <div class="flex items-center justify-between text-sm text-gray-600">
                            <span><i class="fas fa-fire text-orange-500 mr-1"></i> Populer</span>
                            <span><i class="fas fa-arrow-right text-blue-500"></i></span>
                        </div>
                    </div>
                </div>

                <!-- Fashion -->
                <div class="category-card bg-white rounded-xl shadow-lg overflow-hidden cursor-pointer slide-in" style="animation-delay: 0.2s" onclick="window.location.href='#'">
                    <div class="bg-gradient-to-br from-pink-400 to-pink-600 p-8 text-center">
                        <div class="category-icon inline-flex items-center justify-center w-20 h-20 bg-white rounded-full mb-4">
                            <i class="fas fa-tshirt text-3xl text-pink-600"></i>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-2">Fashion</h3>
                        <p class="text-pink-100 text-sm">189 Produk</p>
                    </div>
                    <div class="p-4">
                        <div class="flex items-center justify-between text-sm text-gray-600">
                            <span><i class="fas fa-fire text-orange-500 mr-1"></i> Populer</span>
                            <span><i class="fas fa-arrow-right text-blue-500"></i></span>
                        </div>
                    </div>
                </div>

                <!-- Makanan -->
                <div class="category-card bg-white rounded-xl shadow-lg overflow-hidden cursor-pointer slide-in" style="animation-delay: 0.3s" onclick="window.location.href='#'">
                    <div class="bg-gradient-to-br from-green-400 to-green-600 p-8 text-center">
                        <div class="category-icon inline-flex items-center justify-center w-20 h-20 bg-white rounded-full mb-4">
                            <i class="fas fa-utensils text-3xl text-green-600"></i>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-2">Makanan</h3>
                        <p class="text-green-100 text-sm">156 Produk</p>
                    </div>
                    <div class="p-4">
                        <div class="flex items-center justify-between text-sm text-gray-600">
                            <span><i class="fas fa-star text-yellow-500 mr-1"></i> Rating Tinggi</span>
                            <span><i class="fas fa-arrow-right text-blue-500"></i></span>
                        </div>
                    </div>
                </div>

                <!-- Perabotan -->
                <div class="category-card bg-white rounded-xl shadow-lg overflow-hidden cursor-pointer slide-in" style="animation-delay: 0.4s" onclick="window.location.href='#'">
                    <div class="bg-gradient-to-br from-purple-400 to-purple-600 p-8 text-center">
                        <div class="category-icon inline-flex items-center justify-center w-20 h-20 bg-white rounded-full mb-4">
                            <i class="fas fa-couch text-3xl text-purple-600"></i>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-2">Perabotan</h3>
                        <p class="text-purple-100 text-sm">98 Produk</p>
                    </div>
                    <div class="p-4">
                        <div class="flex items-center justify-between text-sm text-gray-600">
                            <span><i class="fas fa-sparkles text-blue-500 mr-1"></i> Berkualitas</span>
                            <span><i class="fas fa-arrow-right text-blue-500"></i></span>
                        </div>
                    </div>
                </div>

                <!-- Kosmetik -->
                <div class="category-card bg-white rounded-xl shadow-lg overflow-hidden cursor-pointer slide-in" style="animation-delay: 0.5s" onclick="window.location.href='#'">
                    <div class="bg-gradient-to-br from-yellow-400 to-orange-500 p-8 text-center">
                        <div class="category-icon inline-flex items-center justify-center w-20 h-20 bg-white rounded-full mb-4">
                            <i class="fas fa-spa text-3xl text-orange-500"></i>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-2">Kosmetik</h3>
                        <p class="text-yellow-100 text-sm">134 Produk</p>
                    </div>
                    <div class="p-4">
                        <div class="flex items-center justify-between text-sm text-gray-600">
                            <span><i class="fas fa-heart text-red-500 mr-1"></i> Favorit</span>
                            <span><i class="fas fa-arrow-right text-blue-500"></i></span>
                        </div>
                    </div>
                </div>

                <!-- Olahraga -->
                <div class="category-card bg-white rounded-xl shadow-lg overflow-hidden cursor-pointer slide-in" style="animation-delay: 0.6s" onclick="window.location.href='#'">
                    <div class="bg-gradient-to-br from-red-400 to-red-600 p-8 text-center">
                        <div class="category-icon inline-flex items-center justify-center w-20 h-20 bg-white rounded-full mb-4">
                            <i class="fas fa-dumbbell text-3xl text-red-600"></i>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-2">Olahraga</h3>
                        <p class="text-red-100 text-sm">87 Produk</p>
                    </div>
                    <div class="p-4">
                        <div class="flex items-center justify-between text-sm text-gray-600">
                            <span><i class="fas fa-bolt text-yellow-500 mr-1"></i> Energi</span>
                            <span><i class="fas fa-arrow-right text-blue-500"></i></span>
                        </div>
                    </div>
                </div>

                <!-- Gaming -->
                <div class="category-card bg-white rounded-xl shadow-lg overflow-hidden cursor-pointer slide-in" style="animation-delay: 0.7s" onclick="window.location.href='#'">
                    <div class="bg-gradient-to-br from-indigo-400 to-indigo-600 p-8 text-center">
                        <div class="category-icon inline-flex items-center justify-center w-20 h-20 bg-white rounded-full mb-4">
                            <i class="fas fa-gamepad text-3xl text-indigo-600"></i>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-2">Gaming</h3>
                        <p class="text-indigo-100 text-sm">76 Produk</p>
                    </div>
                    <div class="p-4">
                        <div class="flex items-center justify-between text-sm text-gray-600">
                            <span><i class="fas fa-trophy text-yellow-500 mr-1"></i> Terbaik</span>
                            <span><i class="fas fa-arrow-right text-blue-500"></i></span>
                        </div>
                    </div>
                </div>

                <!-- Otomotif -->
                <div class="category-card bg-white rounded-xl shadow-lg overflow-hidden cursor-pointer slide-in" style="animation-delay: 0.8s" onclick="window.location.href='#'">
                    <div class="bg-gradient-to-br from-teal-400 to-teal-600 p-8 text-center">
                        <div class="category-icon inline-flex items-center justify-center w-20 h-20 bg-white rounded-full mb-4">
                            <i class="fas fa-car text-3xl text-teal-600"></i>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-2">Otomotif</h3>
                        <p class="text-teal-100 text-sm">65 Produk</p>
                    </div>
                    <div class="p-4">
                        <div class="flex items-center justify-between text-sm text-gray-600">
                            <span><i class="fas fa-cog text-gray-500 mr-1"></i> Teknologi</span>
                            <span><i class="fas fa-arrow-right text-blue-500"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Kategori Pilihan</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Temukan produk berkualitas dari berbagai kategori terpercaya
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-indigo-100 rounded-full mb-4">
                        <i class="fas fa-box text-2xl text-indigo-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">1,000+</h3>
                    <p class="text-gray-600">Produk Tersedia</p>
                </div>
                
                <div class="text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-green-100 rounded-full mb-4">
                        <i class="fas fa-tags text-2xl text-green-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">50+</h3>
                    <p class="text-gray-600">Promo Aktif</p>
                </div>
                
                <div class="text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-purple-100 rounded-full mb-4">
                        <i class="fas fa-users text-2xl text-purple-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">10,000+</h3>
                    <p class="text-gray-600">Pelanggan Puas</p>
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
                        <li><a href="{{ route('home') }}" class="text-blue-200 hover:text-white transition-colors">Beranda</a></li>
                        <li><a href="{{ route('promo') }}" class="text-blue-200 hover:text-white transition-colors">Promo</a></li>
                        <li><a href="{{ route('kategori') }}" class="text-blue-200 hover:text-white transition-colors">Kategori</a></li>
                        <li><a href="{{ route('rekomendasi') }}" class="text-blue-200 hover:text-white transition-colors">Rekomendasi</a></li>
                        <li><a href="{{ route('checkout') }}" class="text-blue-200 hover:text-white transition-colors">Keranjang</a></li>
                        <li><a href="{{ route('profile') }}" class="text-blue-200 hover:text-white transition-colors">Profil</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-4">Bantuan</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('faq') }}" class="text-blue-200 hover:text-white transition-colors">FAQ</a></li>
                        <li><a href="{{ route('pengiriman') }}" class="text-blue-200 hover:text-white transition-colors">Pengiriman</a></li>
                        <li><a href="{{ route('pengembalian') }}" class="text-blue-200 hover:text-white transition-colors">Pengembalian</a></li>
                        <li><a href="{{ route('kontak') }}" class="text-blue-200 hover:text-white transition-colors">Kontak</a></li>
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
        function toggleMobileMenu() {
            const menu = document.getElementById('mobileMenu');
            menu.classList.toggle('hidden');
        }
        
        function filterCategories(type) {
            const buttons = document.querySelectorAll('.filter-btn');
            buttons.forEach(btn => {
                btn.classList.remove('bg-indigo-600', 'text-white');
                btn.classList.add('bg-gray-200', 'text-gray-700');
            });
            
            event.target.classList.remove('bg-gray-200', 'text-gray-700');
            event.target.classList.add('bg-indigo-600', 'text-white');
            
            // Here you would typically filter the categories based on the type
            console.log('Filtering categories by:', type);
        }
        
        // Search functionality
        document.querySelector('input[placeholder="Cari kategori..."]').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const categoryCards = document.querySelectorAll('.category-card');
            
            categoryCards.forEach(card => {
                const categoryName = card.querySelector('h3').textContent.toLowerCase();
                if (categoryName.includes(searchTerm)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    </script>

    <!-- Chat Bot Component (Available for all users) -->
    @include('components.chat_bot')
</body>
</html>