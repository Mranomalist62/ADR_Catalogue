<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekomendasi - ADR Catalogue</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body { font-family: 'Poppins', sans-serif; }
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
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
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
                    <a href="{{ route('rekomendasi') }}" class="nav-link group relative px-3 py-2 text-blue-600 font-medium transition-all duration-300">
                        <span class="flex items-center">
                            <i class="fas fa-star mr-2 text-sm group-hover:animate-pulse"></i>
                            <span class="relative hidden sm:inline">
                                Rekomendasi
                                <span class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-blue-500 to-purple-500"></span>
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
                <a href="{{ route('kategori') }}" class="mobile-nav-link group block px-4 py-3 text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg font-medium transition-all duration-300">
                    <i class="fas fa-th-large mr-3 group-hover:animate-pulse"></i>
                    Kategori
                </a>
                <a href="{{ route('rekomendasi') }}" class="mobile-nav-link group block px-4 py-3 text-blue-600 hover:bg-blue-50 rounded-lg font-medium transition-all duration-300">
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
                    <button onclick="switchTab('rekomendasi')" id="tab-rekomendasi" class="tab-btn px-4 py-2 rounded-md text-sm font-medium transition-colors tab-active">
                        <i class="fas fa-star mr-2"></i>Rekomendasi
                    </button>
                    <button onclick="switchTab('terbaru')" id="tab-terbaru" class="tab-btn px-4 py-2 rounded-md text-sm font-medium text-gray-600 hover:text-gray-800 transition-colors">
                        <i class="fas fa-clock mr-2"></i>Terbaru
                    </button>
                    <button onclick="switchTab('terlaris')" id="tab-terlaris" class="tab-btn px-4 py-2 rounded-md text-sm font-medium text-gray-600 hover:text-gray-800 transition-colors">
                        <i class="fas fa-fire mr-2"></i>Terlaris
                    </button>
                    <button onclick="switchTab('diskon')" id="tab-diskon" class="tab-btn px-4 py-2 rounded-md text-sm font-medium text-gray-600 hover:text-gray-800 transition-colors">
                        <i class="fas fa-percentage mr-2"></i>Diskon
                    </button>
                </div>
                
                <!-- Search and Filters -->
                <div class="flex flex-col sm:flex-row gap-3 items-center">
                    <div class="relative">
                        <input type="text" 
                               placeholder="Cari produk..." 
                               class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent w-full sm:w-64">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                    </div>
                    
                    <select class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        <option>Semua Kategori</option>
                        <option>Elektronik</option>
                        <option>Fashion</option>
                        <option>Makanan</option>
                        <option>Perabotan</option>
                    </select>
                    
                    <select class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        <option>Urutkan: Rekomendasi</option>
                        <option>Urutkan: Harga Terendah</option>
                        <option>Urutkan: Harga Tertinggi</option>
                        <option>Urutkan: Rating Tertinggi</option>
                        <option>Urutkan: Terbaru</option>
                    </select>
                </div>
            </div>
            
            <!-- Filter Badges -->
            <div class="flex flex-wrap gap-2 mt-4">
                <span class="filter-badge px-3 py-1 bg-indigo-100 text-indigo-700 rounded-full text-sm cursor-pointer">
                    <i class="fas fa-check mr-1"></i>Elektronik
                </span>
                <span class="filter-badge px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm cursor-pointer hover:bg-gray-200">
                    <i class="fas fa-times mr-1"></i>Harga < 500k
                </span>
                <span class="filter-badge px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm cursor-pointer hover:bg-gray-200">
                    <i class="fas fa-times mr-1"></i>Rating 4+
                </span>
                <button class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">
                    Hapus Semua Filter
                </button>
            </div>
        </div>
    </section>

    <!-- Products Grid -->
    <section class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <!-- Product Card 1 -->
                <div class="product-card bg-white rounded-xl shadow-lg overflow-hidden slide-in" style="animation-delay: 0.1s">
                    <div class="relative">
                        <div class="bg-gray-200 h-48 flex items-center justify-center">
                            <i class="fas fa-laptop text-gray-400 text-4xl"></i>
                        </div>
                        <button onclick="toggleWishlist(this)" class="wishlist-btn absolute top-3 right-3 w-8 h-8 bg-white rounded-full flex items-center justify-center shadow-md">
                            <i class="far fa-heart text-gray-600"></i>
                        </button>
                        <span class="absolute top-3 left-3 bg-red-500 text-white px-2 py-1 rounded-full text-xs font-medium">-20%</span>
                        <div class="absolute bottom-3 left-3 flex items-center bg-white/90 backdrop-blur-sm px-2 py-1 rounded-full">
                            <i class="fas fa-star text-yellow-400 text-xs mr-1"></i>
                            <span class="text-xs font-medium">4.5</span>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-medium text-gray-900 mb-2 line-clamp-2">Laptop Gaming High Performance</h3>
                        <p class="text-sm text-gray-600 mb-3 line-clamp-2">Laptop gaming dengan spesifikasi tinggi untuk performa maksimal</p>
                        <div class="flex items-center justify-between mb-3">
                            <div>
                                <p class="text-lg font-bold text-indigo-600">Rp 12.000.000</p>
                                <p class="text-sm text-gray-500 line-through">Rp 15.000.000</p>
                            </div>
                            <span class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded-full">Stok</span>
                        </div>
                        <button class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-2 rounded-lg transition-colors">
                            <i class="fas fa-shopping-cart mr-2"></i>Tambah ke Keranjang
                        </button>
                    </div>
                </div>

                <!-- Product Card 2 -->
                <div class="product-card bg-white rounded-xl shadow-lg overflow-hidden slide-in" style="animation-delay: 0.2s">
                    <div class="relative">
                        <div class="bg-gray-200 h-48 flex items-center justify-center">
                            <i class="fas fa-tshirt text-gray-400 text-4xl"></i>
                        </div>
                        <button onclick="toggleWishlist(this)" class="wishlist-btn absolute top-3 right-3 w-8 h-8 bg-white rounded-full flex items-center justify-center shadow-md">
                            <i class="far fa-heart text-gray-600"></i>
                        </button>
                        <span class="absolute top-3 left-3 bg-green-500 text-white px-2 py-1 rounded-full text-xs font-medium">Baru</span>
                        <div class="absolute bottom-3 left-3 flex items-center bg-white/90 backdrop-blur-sm px-2 py-1 rounded-full">
                            <i class="fas fa-star text-yellow-400 text-xs mr-1"></i>
                            <span class="text-xs font-medium">4.8</span>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-medium text-gray-900 mb-2 line-clamp-2">Kemeja Casual Premium</h3>
                        <p class="text-sm text-gray-600 mb-3 line-clamp-2">Kemeja casual dengan bahan berkualitas tinggi</p>
                        <div class="flex items-center justify-between mb-3">
                            <div>
                                <p class="text-lg font-bold text-indigo-600">Rp 250.000</p>
                            </div>
                            <span class="text-xs bg-orange-100 text-orange-700 px-2 py-1 rounded-full">Terbatas</span>
                        </div>
                        <button class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-2 rounded-lg transition-colors">
                            <i class="fas fa-shopping-cart mr-2"></i>Tambah ke Keranjang
                        </button>
                    </div>
                </div>

                <!-- Product Card 3 -->
                <div class="product-card bg-white rounded-xl shadow-lg overflow-hidden slide-in" style="animation-delay: 0.3s">
                    <div class="relative">
                        <div class="bg-gray-200 h-48 flex items-center justify-center">
                            <i class="fas fa-utensils text-gray-400 text-4xl"></i>
                        </div>
                        <button onclick="toggleWishlist(this)" class="wishlist-btn absolute top-3 right-3 w-8 h-8 bg-white rounded-full flex items-center justify-center shadow-md">
                            <i class="far fa-heart text-gray-600"></i>
                        </button>
                        <span class="absolute top-3 left-3 bg-orange-500 text-white px-2 py-1 rounded-full text-xs font-medium">-15%</span>
                        <div class="absolute bottom-3 left-3 flex items-center bg-white/90 backdrop-blur-sm px-2 py-1 rounded-full">
                            <i class="fas fa-star text-yellow-400 text-xs mr-1"></i>
                            <span class="text-xs font-medium">4.2</span>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-medium text-gray-900 mb-2 line-clamp-2">Snack Healthy Pack</h3>
                        <p class="text-sm text-gray-600 mb-3 line-clamp-2">Paket snack sehat dengan nutrisi lengkap</p>
                        <div class="flex items-center justify-between mb-3">
                            <div>
                                <p class="text-lg font-bold text-indigo-600">Rp 85.000</p>
                                <p class="text-sm text-gray-500 line-through">Rp 100.000</p>
                            </div>
                            <span class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded-full">Stok</span>
                        </div>
                        <button class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-2 rounded-lg transition-colors">
                            <i class="fas fa-shopping-cart mr-2"></i>Tambah ke Keranjang
                        </button>
                    </div>
                </div>

                <!-- Product Card 4 -->
                <div class="product-card bg-white rounded-xl shadow-lg overflow-hidden slide-in" style="animation-delay: 0.4s">
                    <div class="relative">
                        <div class="bg-gray-200 h-48 flex items-center justify-center">
                            <i class="fas fa-couch text-gray-400 text-4xl"></i>
                        </div>
                        <button onclick="toggleWishlist(this)" class="wishlist-btn absolute top-3 right-3 w-8 h-8 bg-white rounded-full flex items-center justify-center shadow-md">
                            <i class="far fa-heart text-gray-600"></i>
                        </button>
                        <div class="absolute bottom-3 left-3 flex items-center bg-white/90 backdrop-blur-sm px-2 py-1 rounded-full">
                            <i class="fas fa-star text-yellow-400 text-xs mr-1"></i>
                            <span class="text-xs font-medium">4.7</span>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-medium text-gray-900 mb-2 line-clamp-2">Sofa Minimalis Modern</h3>
                        <p class="text-sm text-gray-600 mb-3 line-clamp-2">Sofa minimalis dengan desain modern dan nyaman</p>
                        <div class="flex items-center justify-between mb-3">
                            <div>
                                <p class="text-lg font-bold text-indigo-600">Rp 3.500.000</p>
                            </div>
                            <span class="text-xs bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full">Pre-order</span>
                        </div>
                        <button class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-2 rounded-lg transition-colors">
                            <i class="fas fa-shopping-cart mr-2"></i>Tambah ke Keranjang
                        </button>
                    </div>
                </div>

                <!-- Product Card 5 -->
                <div class="product-card bg-white rounded-xl shadow-lg overflow-hidden slide-in" style="animation-delay: 0.5s">
                    <div class="relative">
                        <div class="bg-gray-200 h-48 flex items-center justify-center">
                            <i class="fas fa-spa text-gray-400 text-4xl"></i>
                        </div>
                        <button onclick="toggleWishlist(this)" class="wishlist-btn absolute top-3 right-3 w-8 h-8 bg-white rounded-full flex items-center justify-center shadow-md">
                            <i class="far fa-heart text-gray-600"></i>
                        </button>
                        <span class="absolute top-3 left-3 bg-purple-500 text-white px-2 py-1 rounded-full text-xs font-medium">-25%</span>
                        <div class="absolute bottom-3 left-3 flex items-center bg-white/90 backdrop-blur-sm px-2 py-1 rounded-full">
                            <i class="fas fa-star text-yellow-400 text-xs mr-1"></i>
                            <span class="text-xs font-medium">4.6</span>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-medium text-gray-900 mb-2 line-clamp-2">Skincare Set Premium</h3>
                        <p class="text-sm text-gray-600 mb-3 line-clamp-2">Set perawatan kulit dengan bahan alami</p>
                        <div class="flex items-center justify-between mb-3">
                            <div>
                                <p class="text-lg font-bold text-indigo-600">Rp 300.000</p>
                                <p class="text-sm text-gray-500 line-through">Rp 400.000</p>
                            </div>
                            <span class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded-full">Stok</span>
                        </div>
                        <button class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-2 rounded-lg transition-colors">
                            <i class="fas fa-shopping-cart mr-2"></i>Tambah ke Keranjang
                        </button>
                    </div>
                </div>

                <!-- Product Card 6 -->
                <div class="product-card bg-white rounded-xl shadow-lg overflow-hidden slide-in" style="animation-delay: 0.6s">
                    <div class="relative">
                        <div class="bg-gray-200 h-48 flex items-center justify-center">
                            <i class="fas fa-gamepad text-gray-400 text-4xl"></i>
                        </div>
                        <button onclick="toggleWishlist(this)" class="wishlist-btn absolute top-3 right-3 w-8 h-8 bg-white rounded-full flex items-center justify-center shadow-md">
                            <i class="far fa-heart text-gray-600"></i>
                        </button>
                        <span class="absolute top-3 left-3 bg-red-500 text-white px-2 py-1 rounded-full text-xs font-medium">-30%</span>
                        <div class="absolute bottom-3 left-3 flex items-center bg-white/90 backdrop-blur-sm px-2 py-1 rounded-full">
                            <i class="fas fa-star text-yellow-400 text-xs mr-1"></i>
                            <span class="text-xs font-medium">4.9</span>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-medium text-gray-900 mb-2 line-clamp-2">Gaming Controller Pro</h3>
                        <p class="text-sm text-gray-600 mb-3 line-clamp-2">Controller gaming dengan fitur lengkap</p>
                        <div class="flex items-center justify-between mb-3">
                            <div>
                                <p class="text-lg font-bold text-indigo-600">Rp 350.000</p>
                                <p class="text-sm text-gray-500 line-through">Rp 500.000</p>
                            </div>
                            <span class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded-full">Stok</span>
                        </div>
                        <button class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-2 rounded-lg transition-colors">
                            <i class="fas fa-shopping-cart mr-2"></i>Tambah ke Keranjang
                        </button>
                    </div>
                </div>

                <!-- Product Card 7 -->
                <div class="product-card bg-white rounded-xl shadow-lg overflow-hidden slide-in" style="animation-delay: 0.7s">
                    <div class="relative">
                        <div class="bg-gray-200 h-48 flex items-center justify-center">
                            <i class="fas fa-dumbbell text-gray-400 text-4xl"></i>
                        </div>
                        <button onclick="toggleWishlist(this)" class="wishlist-btn absolute top-3 right-3 w-8 h-8 bg-white rounded-full flex items-center justify-center shadow-md">
                            <i class="far fa-heart text-gray-600"></i>
                        </button>
                        <div class="absolute bottom-3 left-3 flex items-center bg-white/90 backdrop-blur-sm px-2 py-1 rounded-full">
                            <i class="fas fa-star text-yellow-400 text-xs mr-1"></i>
                            <span class="text-xs font-medium">4.4</span>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-medium text-gray-900 mb-2 line-clamp-2">Dumbbell Set Professional</h3>
                        <p class="text-sm text-gray-600 mb-3 line-clamp-2">Set dumbbell profesional untuk workout di rumah</p>
                        <div class="flex items-center justify-between mb-3">
                            <div>
                                <p class="text-lg font-bold text-indigo-600">Rp 750.000</p>
                            </div>
                            <span class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded-full">Stok</span>
                        </div>
                        <button class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-2 rounded-lg transition-colors">
                            <i class="fas fa-shopping-cart mr-2"></i>Tambah ke Keranjang
                        </button>
                    </div>
                </div>

                <!-- Product Card 8 -->
                <div class="product-card bg-white rounded-xl shadow-lg overflow-hidden slide-in" style="animation-delay: 0.8s">
                    <div class="relative">
                        <div class="bg-gray-200 h-48 flex items-center justify-center">
                            <i class="fas fa-car text-gray-400 text-4xl"></i>
                        </div>
                        <button onclick="toggleWishlist(this)" class="wishlist-btn absolute top-3 right-3 w-8 h-8 bg-white rounded-full flex items-center justify-center shadow-md">
                            <i class="far fa-heart text-gray-600"></i>
                        </button>
                        <span class="absolute top-3 left-3 bg-blue-500 text-white px-2 py-1 rounded-full text-xs font-medium">-10%</span>
                        <div class="absolute bottom-3 left-3 flex items-center bg-white/90 backdrop-blur-sm px-2 py-1 rounded-full">
                            <i class="fas fa-star text-yellow-400 text-xs mr-1"></i>
                            <span class="text-xs font-medium">4.3</span>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-medium text-gray-900 mb-2 line-clamp-2">Car Care Premium Kit</h3>
                        <p class="text-sm text-gray-600 mb-3 line-clamp-2">Paket perawatan mobil premium</p>
                        <div class="flex items-center justify-between mb-3">
                            <div>
                                <p class="text-lg font-bold text-indigo-600">Rp 180.000</p>
                                <p class="text-sm text-gray-500 line-through">Rp 200.000</p>
                            </div>
                            <span class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded-full">Stok</span>
                        </div>
                        <button class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-2 rounded-lg transition-colors">
                            <i class="fas fa-shopping-cart mr-2"></i>Tambah ke Keranjang
                        </button>
                    </div>
                </div>
            </div>

            <!-- Load More Button -->
            <div class="text-center mt-12">
                <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-3 rounded-lg font-medium transition-colors">
                    <i class="fas fa-plus mr-2"></i>Muat Lebih Banyak
                </button>
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
        
        function switchTab(tabName) {
            // Remove active class from all tabs
            document.querySelectorAll('.tab-btn').forEach(tab => {
                tab.classList.remove('tab-active');
                tab.classList.add('text-gray-600');
            });
            
            // Add active class to selected tab
            const selectedTab = document.getElementById(`tab-${tabName}`);
            selectedTab.classList.add('tab-active');
            selectedTab.classList.remove('text-gray-600');
            
            // Here you would typically load products based on the selected tab
            console.log('Switching to tab:', tabName);
        }
        
        function toggleWishlist(button) {
            const icon = button.querySelector('i');
            if (icon.classList.contains('far')) {
                icon.classList.remove('far');
                icon.classList.add('fas');
                button.classList.add('active');
            } else {
                icon.classList.remove('fas');
                icon.classList.add('far');
                button.classList.remove('active');
            }
        }
        
        // Search functionality
        document.querySelector('input[placeholder="Cari produk..."]').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const productCards = document.querySelectorAll('.product-card');
            
            productCards.forEach(card => {
                const productName = card.querySelector('h3').textContent.toLowerCase();
                const productDesc = card.querySelector('p').textContent.toLowerCase();
                
                if (productName.includes(searchTerm) || productDesc.includes(searchTerm)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
        
        // Filter badge functionality
        document.querySelectorAll('.filter-badge').forEach(badge => {
            badge.addEventListener('click', function() {
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
                
                // Here you would typically apply the filter
                console.log('Toggling filter:', this.textContent.trim());
            });
        });
    </script>

    <!-- Chat Bot Component (Available for all users) -->
    @include('components.chat_bot')
</body>
</html>