<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Saya - ADR Catalogue</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
                     <a href="{{ route('pesanan') }}" class="nav-link group relative px-3 py-2 text-blue-600 font-medium transition-all duration-300">
                         <span class="flex items-center">
                             <i class="fas fa-shopping-cart mr-2 text-sm group-hover:animate-pulse"></i>
                             <span class="relative hidden sm:inline">
                                 Pesanan
                                 <span class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-blue-500 to-purple-500"></span>
                             </span>
                         </span>
                         <span id="cartCount" class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">0</span>
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
                <a href="{{ route('rekomendasi') }}" class="mobile-nav-link group block px-4 py-3 text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg font-medium transition-all duration-300">
                    <i class="fas fa-star mr-3 group-hover:animate-pulse"></i>
                    Rekomendasi
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

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-8 fade-in">
            <h1 class="text-2xl font-semibold text-gray-700 mb-4 flex items-center">
                <i class="fas fa-box-open mr-3 text-yellow-400"></i>
                Pesanan Saya
            </h1>
            <p class="text-gray-700">Daftar pesanan yang sudah dibeli dengan detail lengkap per produk.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-1 gap-6">
            <!-- Dummy Product 1 -->
            <div class="glass-effect rounded-xl shadow-xl p-6 fade-in">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-gray-800">
                        Invoice: <span class="text-purple-600">INV-001</span>
                    </h2>
                    <span class="text-gray-600 text-sm">05 Des 2025, 14:23</span>
                </div>

                <!-- Product Info -->
                <div class="product-item flex items-center space-x-4 pb-4 border-b border-gray-100 mb-4">
                    <div class="w-16 h-16 bg-gradient-to-br from-purple-100 to-pink-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-laptop text-purple-600 text-xl"></i>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-sm font-medium text-gray-900">Laptop ABC</h3>
                        <p class="text-sm text-gray-500">Rp 12.000.000 x 1</p>
                    </div>
                    <div class="text-sm font-medium text-gray-900">
                        Rp 12.000.000
                    </div>
                </div>

                <!-- Totals -->
                <div class="border-t border-gray-200 pt-4 space-y-2">
                    <div class="flex justify-between text-gray-600">
                        <span>Subtotal</span>
                        <span>Rp 12.000.000</span>
                    </div>
                    <div class="flex justify-between text-lg font-semibold text-gray-900 pt-3 border-t border-gray-200">
                        <span>Total</span>
                        <span class="text-purple-600">Rp 13.300.000</span>
                    </div>
                </div>

                <!-- Print Invoice Button -->
                <div class="flex justify-end mt-4">
                    <button onclick="window.print()" class="print-btn bg-blue-600 text-white px-4 py-2 rounded-lg flex items-center space-x-2 hover:shadow-lg transition-transform duration-300">
                        <i class="fas fa-print"></i>
                        <span>Cetak Invoice</span>
                    </button>
                </div>
            </div>

            <!-- Dummy Product 2 -->
            <div class="glass-effect rounded-xl shadow-xl p-6 fade-in">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-gray-800">
                        Invoice: <span class="text-purple-600">INV-002</span>
                    </h2>
                    <span class="text-gray-600 text-sm">10 Nov 2025, 09:15</span>
                </div>

                <!-- Product Info -->
                <div class="product-item flex items-center space-x-4 pb-4 border-b border-gray-100 mb-4">
                    <div class="w-16 h-16 bg-gradient-to-br from-purple-100 to-pink-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-mobile-screen text-purple-600 text-xl"></i>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-sm font-medium text-gray-900">Smartphone XYZ</h3>
                        <p class="text-sm text-gray-500">Rp 5.500.000 x 1</p>
                    </div>
                    <div class="text-sm font-medium text-gray-900">
                        Rp 5.500.000
                    </div>
                </div>

                <!-- Totals -->
                <div class="border-t border-gray-200 pt-4 space-y-2">
                    <div class="flex justify-between text-gray-600">
                        <span>Subtotal</span>
                        <span>Rp 5.500.000</span>
                    </div>
                    <div class="flex justify-between text-lg font-semibold text-gray-900 pt-3 border-t border-gray-200">
                        <span>Total</span>
                        <span class="text-purple-600">Rp 6.070.000</span>
                    </div>
                </div>

                <!-- Print Invoice Button -->
                <div class="flex justify-end mt-4">
                    <button onclick="window.print()" class="print-btn bg-blue-600 text-white px-4 py-2 rounded-lg flex items-center space-x-2 hover:shadow-lg transition-transform duration-300">
                        <i class="fas fa-print"></i>
                        <span>Cetak Invoice</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
