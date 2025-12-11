<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Promo - ADR Catalogue</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/promo.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .promo-gradient {
            background: linear-gradient(135deg, #bfdbfe 0%, #93c5fd 25%, #60a5fa 50%, #3b82f6 75%, #2563eb 100%);
        }
        .light-blue-gradient {
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 25%, #93c5fd 50%, #60a5fa 75%, #3b82f6 100%);
        }
        .promo-card {
            transition: all 0.3s ease;
        }
        .promo-card:hover {
            transform: translateY(-10px) scale(1.02);
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
        .modal-image-preview {
            max-height: 400px;
            object-fit: contain;
        }
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
        
        /* Slider styles */
        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
        
        .slider-card {
            transition: all 0.3s ease;
        }
        
        .slider-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
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
                            <div class="absolute inset-0 bg-gradient-to-r from-blue-500/20 to-purple-500/20 rounded-lg blur-md opacity-0 group-hover:opacity-75 transition-opacity duration-300"></div>
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
                            <a href="{{ route('promo') }}" class="nav-link group relative px-4 py-2 text-blue-600 font-medium transition-all duration-300">
                                <span class="flex items-center">
                                    <i class="fas fa-tags mr-2 text-sm group-hover:animate-pulse"></i>
                                    <span class="relative">
                                        Promo
                                        <span class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-blue-500 to-purple-500"></span>
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
                    <a href="{{ route('pesanan') }}" class="nav-link group relative px-3 py-2 text-gray-700 hover:text-blue-600 font-medium transition-all duration-300">
                        <span class="flex items-center">
                            <i class="fas fa-shopping-cart mr-2 text-sm group-hover:animate-pulse"></i>
                            <span class="relative hidden sm:inline">
                                Pesanan
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
        </nav>
           
    </nav>

    <!-- Promo Slider Section -->
    <section class="py-8 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">Promo Spesial</h2>
                    <p class="text-gray-600">Diskon terbaik untuk produk pilihan</p>
                </div>
            </div>
            
            <div class="relative">
                <!-- Navigation Buttons -->
                <button onclick="scrollSlider('homePromoSlider', 'left')" class="absolute left-0 top-1/2 transform -translate-y-1/2 z-10 bg-white rounded-full p-3 shadow-lg hover:shadow-xl transition-all -ml-2 md:-ml-4">
                    <i class="fas fa-chevron-left text-gray-600 text-lg"></i>
                </button>
                <button onclick="scrollSlider('homePromoSlider', 'right')" class="absolute right-0 top-1/2 transform -translate-y-1/2 z-10 bg-white rounded-full p-3 shadow-lg hover:shadow-xl transition-all -mr-2 md:-mr-4">
                    <i class="fas fa-chevron-right text-gray-600 text-lg"></i>
                </button>
                
                <!-- Loading State -->
                <div id="homePromoLoading" class="flex justify-center items-center py-12">
                    <div class="text-center">
                        <div class="inline-block animate-spin rounded-full h-12 w-12 border-4 border-blue-500 border-t-transparent"></div>
                        <p class="mt-4 text-gray-600">Memuat data promo...</p>
                    </div>
                </div>
                
                <!-- Promo Slider -->
                <div id="homePromoSlider" class="flex gap-6 overflow-x-auto scrollbar-hide pb-4" style="scroll-behavior: smooth; -webkit-overflow-scrolling: touch;">
                    <!-- Promo cards will be loaded dynamically from API -->
                </div>
            </div>
        </div>
    </section>

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
            <a href="{{ route('pesanan') }}" class="mobile-nav-link group block px-4 py-3 text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg font-medium transition-all duration-300">
                <i class="fas fa-shopping-cart mr-3 group-hover:animate-pulse"></i>
                Pesanan
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
    
    <!-- All Promos Grid -->
    <section class="py-12 bg-white">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Promo cards will be loaded dynamically from API -->
                <div id="promoCards" class="space-y-6">
                    <!-- Loading state -->
                    <div id="loadingState" class="col-span-full text-center py-16">
                        <div class="inline-block animate-spin rounded-full h-12 w-12 border-4 border-blue-500 border-t-transparent"></div>
                        <p class="mt-4 text-gray-600">Memuat data promo...</p>
                    </div>
                    
                    <!-- Empty state (hidden by default) -->
                    <div id="emptyState" class="col-span-full text-center py-16 hidden">
                        <div class="max-w-md mx-auto">
                            <div class="bg-blue-50 rounded-full w-24 h-24 flex items-center justify-center mx-auto mb-6">
                                <i class="fas fa-tags text-blue-500 text-4xl"></i>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-3">Belum ada promo</h3>
                            <p class="text-gray-600 mb-6">Promo akan segera tersedia. Silakan kembali lagi nanti.</p>
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
                        <li><a href="{{ route('home') }}" class="text-blue-200 hover:text-white transition-colors">Beranda</a></li>
                        <li><a href="{{ route('promo') }}" class="text-blue-200 hover:text-white transition-colors">Promo</a></li>
                        <li><a href="{{ route('kategori') }}" class="text-blue-200 hover:text-white transition-colors">Kategori</a></li>
                        <li><a href="{{ route('rekomendasi') }}" class="text-blue-200 hover:text-white transition-colors">Rekomendasi</a></li>
                        <li><a href="{{ route('pesanan') }}" class="text-blue-200 hover:text-white transition-colors">Pesanan</a></li>
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
    
    <!-- Chat Bot Component (Available for all users) -->
    @include('components.chat_bot')
    
    <!-- Promo Detail Modal -->
    <div id="promoModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-xl max-w-4xl w-full max-h-[90vh] overflow-y-auto shadow-2xl">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-900" id="modalTitle">Detail Promo</h3>
                    <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                
                <div id="modalContent" class="space-y-4">
                    <!-- Content will be loaded dynamically -->
                </div>
            </div>
        </div>
    </div>
    
    <script>
        function toggleMobileMenu() {
            const menu = document.getElementById('mobileMenu');
            menu.classList.toggle('hidden');
        }
        
        function scrollSlider(sliderId, direction) {
            const slider = document.getElementById(sliderId);
            const scrollAmount = 300; // Adjust scroll amount as needed
            
            if (direction === 'left') {
                slider.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
            } else {
                slider.scrollBy({ left: scrollAmount, behavior: 'smooth' });
            }
        }
        
        function filterPromos(filter) {
            // Update button styles
            document.querySelectorAll('.filter-btn').forEach(btn => {
                btn.classList.remove('bg-indigo-600', 'text-white');
                btn.classList.add('bg-gray-200', 'text-gray-700');
            });
            
            event.target.classList.remove('bg-gray-200', 'text-gray-700');
            event.target.classList.add('bg-indigo-600', 'text-white');
            
            // Load promos based on filter
            loadPromos(filter);
        }
        
        // Load featured promos for home page slider
        function loadHomePromos() {
            const homePromoLoading = document.getElementById('homePromoLoading');
            const homePromoSlider = document.getElementById('homePromoSlider');
            
            // Show loading state
            homePromoLoading.style.display = 'flex';
            homePromoSlider.style.display = 'none';
            
            // Fetch promos from API
            fetch('/public/promo')
                .then(response => response.json())
                .then(data => {
                    if (data.success && data.data && data.data.length > 0) {
                        // Hide loading state
                        homePromoLoading.style.display = 'none';
                        homePromoSlider.style.display = 'flex';
                        
                        // Render promo cards
                        const promoCards = data.data.map(promo => {
                            const imageUrl = promo.path_thumbnail ?
                                `/storage/${promo.path_thumbnail}` :
                                (promo.product && promo.product.path_thumbnail ?
                                    `/storage/${promo.product.path_thumbnail}` :
                                    null);
                            
                            const productName = promo.product ? promo.product.nama : 'Produk';
                            const productPrice = promo.product ? promo.product.harga_satuan : 0;
                            const discountedPrice = productPrice - (productPrice * promo.potongan_harga / 100);
                            
                            return `
                                <div class="slider-card flex-shrink-0 w-72 bg-white rounded-xl shadow-lg overflow-hidden cursor-pointer hover:shadow-xl transition-shadow duration-300" onclick="window.location.href='/promo'">
                                    <div class="relative">
                                        ${imageUrl ?
                                            `<img src="${imageUrl}" alt="${promo.nama}" class="w-full h-48 object-cover">` :
                                            `<div class="w-full h-48 bg-gradient-to-br from-blue-100 to-blue-300 flex items-center justify-center">
                                                <i class="fas fa-tags text-blue-600 text-4xl"></i>
                                            </div>`
                                        }
                                        <div class="absolute top-2 left-2">
                                            <span class="px-3 py-1 text-sm rounded-full bg-red-500 text-white font-bold shadow-lg">
                                                ${promo.potongan_harga}% OFF
                                            </span>
                                        </div>
                                    </div>
                                    <div class="p-4">
                                        <h3 class="font-semibold text-gray-900 mb-2 truncate">${promo.nama}</h3>
                                        <p class="text-sm text-gray-600 mb-3 truncate">${productName}</p>
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <p class="text-lg font-bold text-indigo-600">Rp ${discountedPrice.toLocaleString('id-ID')}</p>
                                                ${productPrice > 0 ? `<p class="text-sm text-gray-500 line-through">Rp ${productPrice.toLocaleString('id-ID')}</p>` : ''}
                                            </div>
                                            <button class="bg-indigo-50 hover:bg-indigo-100 text-indigo-600 p-2 rounded-lg transition-colors">
                                                <i class="fas fa-shopping-cart"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            `;
                        }).join('');
                        
                        homePromoSlider.innerHTML = promoCards;
                    } else {
                        // Show empty state
                        homePromoLoading.innerHTML = `
                            <div class="text-center py-8">
                                <div class="max-w-md mx-auto">
                                    <div class="bg-blue-50 rounded-full w-24 h-24 flex items-center justify-center mx-auto mb-6">
                                        <i class="fas fa-tags text-blue-500 text-4xl"></i>
                                    </div>
                                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Belum ada promo</h3>
                                    <p class="text-gray-600 mb-6">Promo akan segera tersedia. Silakan kembali lagi nanti.</p>
                                </div>
                            </div>
                        `;
                        homePromoSlider.style.display = 'none';
                    }
                })
                .catch(error => {
                    console.error('Error loading promos:', error);
                    homePromoLoading.innerHTML = `
                        <div class="text-center py-8">
                            <i class="fas fa-exclamation-triangle text-red-500 text-4xl mb-4"></i>
                            <h3 class="text-xl font-semibold text-gray-900 mb-3">Gagal Memuat Data</h3>
                            <p class="text-gray-600">Terjadi kesalahan saat memuat data promo. Silakan coba lagi.</p>
                        </div>
                    `;
                    homePromoSlider.style.display = 'none';
                });
        }
        
        function loadPromos(filter = 'all') {
            const loadingState = document.getElementById('loadingState');
            const emptyState = document.getElementById('emptyState');
            const promoCards = document.getElementById('promoCards');
            
            // Show loading state
            loadingState.classList.remove('hidden');
            emptyState.classList.add('hidden');
            promoCards.classList.add('hidden');
            
            // Fetch promos from API
            fetch('/public/promo')
                .then(response => response.json())
                .then(data => {
                    if (data.success && data.data && data.data.length > 0) {
                        // Hide loading and empty states
                        loadingState.classList.add('hidden');
                        emptyState.classList.add('hidden');
                        promoCards.classList.remove('hidden');
                        
                        // Render promo cards
                        promoCards.innerHTML = data.data.map(promo => `
                            <div class="promo-card bg-white rounded-xl shadow-lg overflow-hidden slide-in" style="animation-delay: 0.1s">
                                <div class="relative group">
                                    ${promo.path_thumbnail ?
                                        `<img src="/storage/${promo.path_thumbnail}" alt="${promo.nama}" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">` :
                                        `<div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                            <i class="fas fa-image text-gray-400 text-4xl"></i>
                                        </div>`
                                    }
                                    
                                    <!-- Discount Badge -->
                                    ${promo.potongan_harga > 0 ?
                                        `<div class="absolute top-2 left-2">
                                            <span class="px-3 py-1 text-sm rounded-full bg-red-500 text-white font-bold shadow-lg">
                                                ${promo.potongan_harga}%
                                            </span>
                                        </div>` : ''
                                    }
                                </div>
                                
                                <div class="p-4">
                                    <h3 class="font-semibold text-gray-900 mb-2">${promo.nama}</h3>
                                    
                                    <!-- Product Info -->
                                    ${promo.product ?
                                        `<p class="text-sm text-gray-600 mb-3">
                                            <i class="fas fa-box mr-1"></i> ${promo.product.nama}
                                        </p>` : ''
                                    }
                                    
                                    <!-- Action Buttons -->
                                    <div class="flex space-x-2">
                                        <button onclick="showPromoDetail(${promo.id})" class="flex-1 bg-blue-50 hover:bg-blue-100 text-blue-600 py-2 rounded-lg transition-colors text-sm font-medium">
                                            <i class="fas fa-eye mr-1"></i> Lihat
                                        </button>
                                    </div>
                                </div>
                            </div>
                        `).join('');
                    } else {
                        // Show empty state
                        loadingState.classList.add('hidden');
                        emptyState.classList.remove('hidden');
                        promoCards.classList.add('hidden');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    // Show error state
                    loadingState.classList.add('hidden');
                    emptyState.classList.remove('hidden');
                    promoCards.classList.add('hidden');
                });
        }
        
        function showPromoDetail(promoId) {
            // Fetch promo detail from API
            fetch(`/public/promo/${promoId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success && data.data) {
                        const promo = data.data;
                        const modalContent = document.getElementById('modalContent');
                        
                        modalContent.innerHTML = `
                            <div class="flex items-center mb-4">
                                ${promo.path_thumbnail ?
                                    `<img src="/storage/${promo.path_thumbnail}" alt="${promo.nama}" class="modal-image-preview">` :
                                    `<div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                        <i class="fas fa-image text-gray-400 text-4xl"></i>
                                    </div>`
                                }
                            </div>
                            <div class="flex-1">
                                <div class="space-y-4">
                                    <div>
                                        <h4 class="font-semibold text-gray-900">Nama Promo</h4>
                                        <p class="text-gray-700">${promo.nama}</p>
                                    </div>
                                    
                                    <div>
                                        <h4 class="font-semibold text-gray-900">Diskon</h4>
                                        <p class="text-gray-700">${promo.potongan_harga}%</p>
                                    </div>
                                    
                                    ${promo.product ?
                                        `<div>
                                            <h4 class="font-semibold text-gray-900">Produk</h4>
                                            <p class="text-gray-700">${promo.product.nama}</p>
                                        </div>` : ''
                                    }
                                    
                                    <div>
                                        <h4 class="font-semibold text-gray-900">Deskripsi</h4>
                                        <p class="text-gray-700">${promo.description || 'Tidak ada deskripsi'}</p>
                                    </div>
                                </div>
                            </div>
                        `;
                        
                        document.getElementById('promoModal').classList.remove('hidden');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Gagal memuat data promo. Silakan coba lagi.');
                });
        }
        
        function closeModal() {
            document.getElementById('promoModal').classList.add('hidden');
        }
        
        // Load promos on page load
        document.addEventListener('DOMContentLoaded', function() {
            loadPromos();
            loadHomePromos();
        });
    </script>
</body>
</html>