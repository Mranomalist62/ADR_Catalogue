<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Perusahaan - ADR Catalogue</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .profile-gradient {
            background: linear-gradient(135deg, #bfdbfe 0%, #93c5fd 25%, #60a5fa 50%, #3b82f6 75%, #2563eb 100%);
        }
        .light-blue-gradient {
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 25%, #93c5fd 50%, #60a5fa 75%, #3b82f6 100%);
        }
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
        .slide-in {
            animation: slideIn 0.5s ease-out;
        }
        @keyframes slideIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .timeline-item {
            transition: all 0.3s ease;
        }
        .timeline-item:hover {
            transform: scale(1.02);
        }
        .stat-card {
            transition: all 0.3s ease;
        }
        .stat-card:hover {
            transform: translateY(-2px) scale(1.02);
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
                        <a href="{{ route('profile') }}" class="nav-link group relative px-3 py-2 text-blue-600 font-medium transition-all duration-300">
                            <span class="flex items-center">
                                <i class="fas fa-building mr-2 text-sm group-hover:animate-pulse"></i>
                                <span class="relative hidden sm:inline">
                                    Profil
                                    <span class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-blue-500 to-purple-500"></span>
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
                        <a href="{{ route('profile') }}" class="nav-link group relative px-3 py-2 text-blue-600 font-medium transition-all duration-300">
                            <span class="flex items-center">
                                <i class="fas fa-building mr-2 text-sm group-hover:animate-pulse"></i>
                                <span class="relative hidden sm:inline">
                                    Profil
                                    <span class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-blue-500 to-purple-500"></span>
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
                    <a href="{{ route('profile') }}" class="mobile-nav-link group block px-4 py-3 text-blue-600 hover:bg-blue-50 rounded-lg font-medium transition-all duration-300">
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
                    <a href="{{ route('profile') }}" class="mobile-nav-link group block px-4 py-3 text-blue-600 hover:bg-blue-50 rounded-lg font-medium transition-all duration-300">
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
    <section class="profile-gradient text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center slide-in">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Profil Perusahaan</h1>
                <p class="text-xl opacity-90 max-w-2xl mx-auto">
                    Mengenal lebih dekat dengan ADR Catalogue
                </p>
            </div>
        </div>
    </section>

    <!-- Company Overview Section -->
    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Company Info -->
                <div class="slide-in" style="animation-delay: 0.1s">
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">Tentang Kami</h2>
                    <div class="space-y-4">
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0 w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-building text-blue-600 text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-1">ADR Catalogue</h3>
                                <p class="text-gray-600">Platform e-commerce terpercaya yang menyediakan berbagai produk berkualitas dengan harga terjangkau.</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0 w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-bullseye text-green-600 text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-1">Misi Kami</h3>
                                <p class="text-gray-600">Menjadi platform pilihan utama untuk kebutuhan belanja sehari-hari dengan memberikan pengalaman terbaik.</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0 w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-eye text-purple-600 text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-1">Visi Kami</h3>
                                <p class="text-gray-600">Menghubungkan pelanggan dengan produk terbaik melalui teknologi yang inovatif.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Company Image -->
                <div class="slide-in" style="animation-delay: 0.2s">
                    <div class="relative">
                        <div class="light-blue-gradient rounded-2xl p-8 text-center">
                            <div class="w-32 h-32 mx-auto bg-white rounded-full flex items-center justify-center shadow-lg mb-6">
                                <img src="{{ asset('images/asset/logo.png') }}" alt="ADR Catalogue" class="w-24 h-24 object-contain">
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-2">ADR Catalogue</h3>
                            <p class="text-gray-600 mb-4">Your Trusted Shopping Partner</p>
                            <div class="flex justify-center space-x-4">
                                <div class="text-center">
                                    <p class="text-3xl font-bold text-blue-600">1000+</p>
                                    <p class="text-sm text-gray-600">Produk</p>
                                </div>
                                <div class="text-center">
                                    <p class="text-3xl font-bold text-green-600">50K+</p>
                                    <p class="text-sm text-gray-600">Pelanggan</p>
                                </div>
                                <div class="text-center">
                                    <p class="text-3xl font-bold text-purple-600">4.8</p>
                                    <p class="text-sm text-gray-600">Rating</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Pencapaian Kami</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Angka-angka yang menunjukkan kepercayaan pelanggan kepada kami
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="stat-card bg-white rounded-xl shadow-lg p-6 text-center slide-in" style="animation-delay: 0.3s">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-200 rounded-full mb-4">
                        <i class="fas fa-box text-2xl text-blue-700"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">1,000+</h3>
                    <p class="text-gray-600">Produk Tersedia</p>
                </div>
                
                <div class="stat-card bg-white rounded-xl shadow-lg p-6 text-center slide-in" style="animation-delay: 0.4s">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-sky-200 rounded-full mb-4">
                        <i class="fas fa-users text-2xl text-sky-700"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">50,000+</h3>
                    <p class="text-gray-600">Pelanggan Puas</p>
                </div>
                
                <div class="stat-card bg-white rounded-xl shadow-lg p-6 text-center slide-in" style="animation-delay: 0.5s">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-indigo-200 rounded-full mb-4">
                        <i class="fas fa-tags text-2xl text-indigo-700"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">100+</h3>
                    <p class="text-gray-600">Promo Aktif</p>
                </div>
                
                <div class="stat-card bg-white rounded-xl shadow-lg p-6 text-center slide-in" style="animation-delay: 0.6s">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-cyan-200 rounded-full mb-4">
                        <i class="fas fa-star text-2xl text-cyan-700"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">4.8/5</h3>
                    <p class="text-gray-600">Rating Pelanggan</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Timeline Section -->
    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Perjalanan Kami</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Milestone penting dalam sejarah ADR Catalogue
                </p>
            </div>
            
            <div class="relative">
                <!-- Timeline Line -->
                <div class="absolute left-1/2 transform -translate-x-1/2 h-full w-1 bg-blue-200"></div>
                
                <!-- Timeline Items -->
                <div class="space-y-12">
                    <div class="timeline-item relative flex items-center slide-in" style="animation-delay: 0.7s">
                        <div class="flex-shrink-0 w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center z-10">
                            <i class="fas fa-flag text-white"></i>
                        </div>
                        <div class="ml-8">
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">2020 - Awal Perjalanan</h3>
                            <p class="text-gray-600">ADR Catalogue didirikan dengan visi menjadi platform e-commerce terpercaya.</p>
                        </div>
                    </div>
                    
                    <div class="timeline-item relative flex items-center slide-in" style="animation-delay: 0.8s">
                        <div class="flex-shrink-0 w-12 h-12 bg-sky-600 rounded-full flex items-center justify-center z-10">
                            <i class="fas fa-rocket text-white"></i>
                        </div>
                        <div class="ml-8">
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">2021 - Ekspansi Cepat</h3>
                            <p class="text-gray-600">Mencapai 10,000 pelanggan dan menambah 500+ produk baru.</p>
                        </div>
                    </div>
                    
                    <div class="timeline-item relative flex items-center slide-in" style="animation-delay: 0.9s">
                        <div class="flex-shrink-0 w-12 h-12 bg-indigo-600 rounded-full flex items-center justify-center z-10">
                            <i class="fas fa-award text-white"></i>
                        </div>
                        <div class="ml-8">
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">2023 - Penghargaan</h3>
                            <p class="text-gray-600">Menerima penghargaan sebagai platform e-commerce terbaik di kategori.</p>
                        </div>
                    </div>
                    
                    <div class="timeline-item relative flex items-center slide-in" style="animation-delay: 1.0s">
                        <div class="flex-shrink-0 w-12 h-12 bg-cyan-600 rounded-full flex items-center justify-center z-10">
                            <i class="fas fa-star text-white"></i>
                        </div>
                        <div class="ml-8">
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">2024 - Inovasi Berkelanjutan</h3>
                            <p class="text-gray-600">Meluncurkan fitur baru dan meningkatkan pengalaman pengguna.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Tim Kami</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Orang-orang hebat di balik kesuksesan ADR Catalogue
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="card-hover bg-white rounded-xl shadow-lg overflow-hidden text-center slide-in" style="animation-delay: 1.1s">
                    <div class="p-6">
                        <div class="w-24 h-24 mx-auto bg-gray-200 rounded-full mb-4 flex items-center justify-center">
                            <i class="fas fa-user text-gray-400 text-3xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">John Doe</h3>
                        <p class="text-gray-600 mb-4">CEO & Founder</p>
                        <div class="flex justify-center space-x-3">
                            <a href="#" class="text-gray-400 hover:text-blue-600 transition-colors">
                                <i class="fab fa-linkedin text-xl"></i>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-blue-400 transition-colors">
                                <i class="fab fa-twitter text-xl"></i>
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="card-hover bg-white rounded-xl shadow-lg overflow-hidden text-center slide-in" style="animation-delay: 1.2s">
                    <div class="p-6">
                        <div class="w-24 h-24 mx-auto bg-gray-200 rounded-full mb-4 flex items-center justify-center">
                            <i class="fas fa-user text-gray-400 text-3xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Jane Smith</h3>
                        <p class="text-gray-600 mb-4">CTO & Co-Founder</p>
                        <div class="flex justify-center space-x-3">
                            <a href="#" class="text-gray-400 hover:text-blue-600 transition-colors">
                                <i class="fab fa-linkedin text-xl"></i>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-blue-400 transition-colors">
                                <i class="fab fa-twitter text-xl"></i>
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="card-hover bg-white rounded-xl shadow-lg overflow-hidden text-center slide-in" style="animation-delay: 1.3s">
                    <div class="p-6">
                        <div class="w-24 h-24 mx-auto bg-gray-200 rounded-full mb-4 flex items-center justify-center">
                            <i class="fas fa-user text-gray-400 text-3xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Bob Johnson</h3>
                        <p class="text-gray-600 mb-4">Head of Marketing</p>
                        <div class="flex justify-center space-x-3">
                            <a href="#" class="text-gray-400 hover:text-blue-600 transition-colors">
                                <i class="fab fa-linkedin text-xl"></i>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-blue-400 transition-colors">
                                <i class="fab fa-twitter text-xl"></i>
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="card-hover bg-white rounded-xl shadow-lg overflow-hidden text-center slide-in" style="animation-delay: 1.4s">
                    <div class="p-6">
                        <div class="w-24 h-24 mx-auto bg-gray-200 rounded-full mb-4 flex items-center justify-center">
                            <i class="fas fa-user text-gray-400 text-3xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Alice Brown</h3>
                        <p class="text-gray-600 mb-4">Head of Operations</p>
                        <div class="flex justify-center space-x-3">
                            <a href="#" class="text-gray-400 hover:text-blue-600 transition-colors">
                                <i class="fab fa-linkedin text-xl"></i>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-blue-400 transition-colors">
                                <i class="fab fa-twitter text-xl"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Hubungi Kami</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Kami siap membantu Anda dengan pertanyaan dan kebutuhan
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center slide-in" style="animation-delay: 1.5s">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-200 rounded-full mb-4">
                        <i class="fas fa-map-marker-alt text-2xl text-blue-700"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Alamat</h3>
                    <p class="text-gray-600">Jl. Contoh No. 123<br>Jakarta, Indonesia 12345</p>
                </div>
                
                <div class="text-center slide-in" style="animation-delay: 1.6s">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-sky-200 rounded-full mb-4">
                        <i class="fas fa-phone text-2xl text-sky-700"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Telepon</h3>
                    <p class="text-gray-600">+62 21 1234 5678<br>+62 812 3456 7890</p>
                </div>
                
                <div class="text-center slide-in" style="animation-delay: 1.7s">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-indigo-200 rounded-full mb-4">
                        <i class="fas fa-envelope text-2xl text-indigo-700"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Email</h3>
                    <p class="text-gray-600">info@adrcatalogue.com<br>support@adrcatalogue.com</p>
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
    </script>

    <!-- Chat Bot Component (Available for all users) -->
    @include('components.chat_bot')
</body>
</html>