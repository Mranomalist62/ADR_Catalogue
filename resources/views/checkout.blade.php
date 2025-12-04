<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - ADR Catalogue</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
        .step-indicator {
            transition: all 0.3s ease;
            position: relative;
        }
        .step-indicator.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            transform: scale(1.1);
        }
        .step-indicator.completed {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
        }
        .form-input {
            transition: all 0.3s ease;
            border: 2px solid #e5e7eb;
        }
        .form-input:focus {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            border-color: #667eea;
        }
        .payment-method {
            transition: all 0.3s ease;
            border: 2px solid #e5e7eb;
        }
        .payment-method:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            border-color: #667eea;
        }
        .payment-method.selected {
            border-color: #667eea;
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
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
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .pulse {
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(102, 126, 234, 0.7); }
            70% { box-shadow: 0 0 0 10px rgba(102, 126, 234, 0); }
            100% { box-shadow: 0 0 0 0 rgba(102, 126, 234, 0); }
        }
    </style>
</head>

<body class="min-h-screen">
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
                     <a href="{{ route('checkout') }}" class="nav-link group relative px-3 py-2 text-blue-600 font-medium transition-all duration-300">
                         <span class="flex items-center">
                             <i class="fas fa-shopping-cart mr-2 text-sm group-hover:animate-pulse"></i>
                             <span class="relative hidden sm:inline">
                                 Keranjang
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

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Progress Steps -->
        <div class="mb-8 fade-in">
            <div class="flex items-center justify-center">
                <div class="flex items-center">
                    <div class="step-indicator active flex items-center justify-center w-12 h-12 rounded-full border-2 border-purple-500 font-semibold shadow-lg">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="w-24 h-1 bg-gradient-to-r from-purple-500 to-purple-300"></div>
                    <div class="step-indicator active flex items-center justify-center w-12 h-12 rounded-full border-2 border-purple-500 font-semibold shadow-lg">
                        <i class="fas fa-credit-card"></i>
                    </div>
                    <div class="w-24 h-1 bg-gray-300"></div>
                    <div class="step-indicator flex items-center justify-center w-12 h-12 rounded-full border-2 border-gray-300 font-semibold shadow-lg">
                        <i class="fas fa-check"></i>
                    </div>
                </div>
            </div>
            <div class="flex justify-center mt-3">
                <div class="flex justify-between w-80 text-sm text-gray-600">
                    <span class="text-purple-600 font-medium">Keranjang</span>
                    <span class="text-purple-600 font-medium">Checkout</span>
                    <span>Konfirmasi</span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Checkout Form -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Customer Information -->
                <div class="glass-effect rounded-xl shadow-xl p-6 fade-in">
                    <h2 class="text-xl font-semibold text-gray-800 mb-6 flex items-center">
                        <i class="fas fa-user-circle mr-3 text-purple-600"></i>
                        Informasi Pelanggan
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                            <input type="text" name="name" required
                                   class="form-input w-full px-4 py-3 rounded-lg focus:ring-2 focus:ring-purple-500"
                                   placeholder="John Doe">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <input type="email" name="email" required
                                   class="form-input w-full px-4 py-3 rounded-lg focus:ring-2 focus:ring-purple-500"
                                   placeholder="john@example.com">
                        </div>
                    </div>
                    
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon</label>
                        <input type="tel" name="phone" required
                               class="form-input w-full px-4 py-3 rounded-lg focus:ring-2 focus:ring-purple-500"
                               placeholder="+62 812-3456-7890">
                    </div>
                </div>

                <!-- Shipping Information -->
                <div class="glass-effect rounded-xl shadow-xl p-6 fade-in">
                    <h2 class="text-xl font-semibold text-gray-800 mb-6 flex items-center">
                        <i class="fas fa-shipping-fast mr-3 text-purple-600"></i>
                        Informasi Pengiriman
                    </h2>
                    
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Pengiriman</label>
                        <textarea name="address" rows="3" required
                                  class="form-input w-full px-4 py-3 rounded-lg focus:ring-2 focus:ring-purple-500"
                                  placeholder="Jl. Contoh No. 123, Kelurahan, Kecamatan, Kota, Provinsi, Kode Pos"></textarea>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Provinsi</label>
                            <select name="province" required class="form-input w-full px-4 py-3 rounded-lg focus:ring-2 focus:ring-purple-500">
                                <option value="">Pilih Provinsi</option>
                                <option value="dki-jakarta">DKI Jakarta</option>
                                <option value="jawa-barat">Jawa Barat</option>
                                <option value="jawa-tengah">Jawa Tengah</option>
                                <option value="jawa-timur">Jawa Timur</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kota</label>
                            <select name="city" required class="form-input w-full px-4 py-3 rounded-lg focus:ring-2 focus:ring-purple-500">
                                <option value="">Pilih Kota</option>
                                <option value="jakarta">Jakarta</option>
                                <option value="bandung">Bandung</option>
                                <option value="surabaya">Surabaya</option>
                                <option value="yogyakarta">Yogyakarta</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kode Pos</label>
                            <input type="text" name="postal_code" required
                                   class="form-input w-full px-4 py-3 rounded-lg focus:ring-2 focus:ring-purple-500"
                                   placeholder="12345">
                        </div>
                    </div>
                </div>

                <!-- Payment Method -->
                <div class="glass-effect rounded-xl shadow-xl p-6 fade-in">
                    <h2 class="text-xl font-semibold text-gray-800 mb-6 flex items-center">
                        <i class="fas fa-wallet mr-3 text-purple-600"></i>
                        Metode Pembayaran
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div class="payment-method rounded-lg p-4 cursor-pointer"
                             onclick="selectPayment('transfer')">
                            <div class="flex items-center">
                                <input type="radio" name="payment_method" value="transfer" id="transfer" required
                                       class="mr-3" checked>
                                <div class="flex-1">
                                    <label for="transfer" class="font-medium text-gray-900 cursor-pointer flex items-center">
                                        <i class="fas fa-university mr-2 text-blue-600"></i>
                                        Transfer Bank
                                    </label>
                                    <p class="text-sm text-gray-500">Transfer ke rekening bank kami</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="payment-method rounded-lg p-4 cursor-pointer"
                             onclick="selectPayment('credit_card')">
                            <div class="flex items-center">
                                <input type="radio" name="payment_method" value="credit_card" id="credit_card" required
                                       class="mr-3">
                                <div class="flex-1">
                                    <label for="credit_card" class="font-medium text-gray-900 cursor-pointer flex items-center">
                                        <i class="fas fa-credit-card mr-2 text-green-600"></i>
                                        Kartu Kredit
                                    </label>
                                    <p class="text-sm text-gray-500">Pembayaran aman dengan kartu kredit</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="payment-method rounded-lg p-4 cursor-pointer"
                             onclick="selectPayment('ewallet')">
                            <div class="flex items-center">
                                <input type="radio" name="payment_method" value="ewallet" id="ewallet" required
                                       class="mr-3">
                                <div class="flex-1">
                                    <label for="ewallet" class="font-medium text-gray-900 cursor-pointer flex items-center">
                                        <i class="fas fa-mobile-alt mr-2 text-purple-600"></i>
                                        E-Wallet
                                    </label>
                                    <p class="text-sm text-gray-500">GoPay, OVO, Dana, dll</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="payment-method rounded-lg p-4 cursor-pointer"
                             onclick="selectPayment('cod')">
                            <div class="flex items-center">
                                <input type="radio" name="payment_method" value="cod" id="cod" required
                                       class="mr-3">
                                <div class="flex-1">
                                    <label for="cod" class="font-medium text-gray-900 cursor-pointer flex items-center">
                                        <i class="fas fa-hand-holding-usd mr-2 text-orange-600"></i>
                                        COD
                                    </label>
                                    <p class="text-sm text-gray-500">Bayar di tempat (Cash on Delivery)</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="lg:col-span-1">
                <div class="glass-effect rounded-xl shadow-xl p-6 sticky top-24 fade-in">
                    <h2 class="text-xl font-semibold text-gray-800 mb-6 flex items-center">
                        <i class="fas fa-receipt mr-3 text-purple-600"></i>
                        Ringkasan Pesanan
                    </h2>
                    
                    <div class="space-y-4 mb-6 max-h-96 overflow-y-auto">
                        @forelse ($products as $product)
                            <div class="product-item flex items-center space-x-4 pb-4 border-b border-gray-100">
                                <div class="w-16 h-16 bg-gradient-to-br from-purple-100 to-pink-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-box text-purple-600 text-xl"></i>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-sm font-medium text-gray-900">{{ $product['name'] }}</h3>
                                    <p class="text-sm text-gray-500">Rp {{ number_format($product['price'], 0, ',', '.') }} x {{ $product['quantity'] }}</p>
                                </div>
                                <div class="text-sm font-medium text-gray-900">
                                    Rp {{ number_format($product['subtotal'], 0, ',', '.') }}
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500 text-center py-4">Tidak ada produk di keranjang</p>
                        @endforelse
                    </div>
                    
                    <div class="border-t border-gray-200 pt-4 space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Subtotal</span>
                            <span class="font-medium">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Ongkos Kirim</span>
                            <span class="font-medium">Rp {{ number_format(15000, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Pajak</span>
                            <span class="font-medium">Rp {{ number_format($total * 0.1, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-lg font-semibold text-gray-900 pt-3 border-t border-gray-200">
                            <span>Total</span>
                            <span class="text-purple-600">Rp {{ number_format($total + 15000 + ($total * 0.1), 0, ',', '.') }}</span>
                        </div>
                    </div>
                    
                    <form action="{{ route('checkout.process') }}" method="POST" class="mt-6">
                        @csrf
                        <button type="submit" 
                                class="btn-primary w-full py-3 text-white rounded-lg font-medium pulse">
                            <i class="fas fa-lock mr-2"></i>
                            Proses Pesanan Aman
                        </button>
                    </form>
                    
                    <div class="mt-4 text-center">
                        <a href="{{ route('rekomendasi') }}" 
                           class="text-purple-600 hover:text-purple-800 text-sm font-medium transition-colors">
                            <i class="fas fa-arrow-left mr-2"></i>Kembali ke Keranjang
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function selectPayment(method) {
            // Remove selected class from all payment methods
            document.querySelectorAll('.payment-method').forEach(el => {
                el.classList.remove('selected');
            });
            
            // Add selected class to the clicked payment method
            event.currentTarget.classList.add('selected');
            
            // Check the corresponding radio button
            document.getElementById(method).checked = true;
        }
        
        // Set initial selected payment method
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('.payment-method').classList.add('selected');
            
            // Add fade-in animation to elements
            const fadeElements = document.querySelectorAll('.fade-in');
            fadeElements.forEach((el, index) => {
                setTimeout(() => {
                    el.style.opacity = '0';
                    el.style.transform = 'translateY(20px)';
                    el.style.transition = 'all 0.5s ease';
                    
                    setTimeout(() => {
                        el.style.opacity = '1';
                        el.style.transform = 'translateY(0)';
                    }, 100);
                }, index * 100);
            });
        });
    </script>

    <!-- Chat Bot Component (Available for all users) -->
    @include('components.chat_bot')
</body>
</html>