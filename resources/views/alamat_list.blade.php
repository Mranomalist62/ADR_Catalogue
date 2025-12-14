<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Alamat - ADR Catalogue</title>
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


    <div class="max-w-4xl mx-auto px-4 py-10">

        {{-- TITLE --}}
        <div class="mb-10">
            <p class="text-gray-600 text-sm mb-2">
                Beranda / Checkout / <span class="font-semibold text-gray-800">Daftar Alamat</span>
            </p>
            <h1 class="text-3xl font-bold text-gray-800">Daftar Alamat Anda</h1>
        </div>

        {{-- CARD LIST ALAMAT --}}
        <div class="bg-white rounded-2xl shadow-xl p-8">
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-800 mb-6">Alamat Tersimpan</h2>

                <div>
                    <a href="{{ route('pembayaran') }}"
                        class="inline-flex items-center mr-2 px-4 py-2 bg-gray-200 text-gray-700 rounded-xl hover:bg-gray-300 transition">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali
                    </a>

                    <a href="{{ route('addalamat') }}"
                        class="px-4 py-2 bg-blue-600 text-white rounded-xl shadow hover:bg-blue-700 transition">
                        <i class="fas fa-plus mr-2"></i>Tambah Alamat
                    </a>

                </div>
            </div>

            <!-- Address Container - Will be populated by JavaScript -->
            <div id="addresses-container">
                <!-- Loading state -->
                <div class="text-center py-8">
                    <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-500 mx-auto"></div>
                    <p class="mt-2 text-gray-600">Memuat alamat...</p>
                </div>
            </div>
        </div>

    </div>

    <script>
        function toggleMobileMenu() {
            const menu = document.getElementById('mobileMenu');
            menu.classList.toggle('hidden');
        }

        document.addEventListener('DOMContentLoaded', function () {
            // Load addresses on page load
            loadAddresses();

            async function loadAddresses() {
                const container = document.getElementById('addresses-container');

                try {
                    const response = await fetch('/user/api/addresses/', {
                        method: 'GET',
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') || ''
                        }
                    });

                    const result = await response.json();

                    if (result.success) {
                        displayAddresses(result.data, container);
                    } else {
                        throw new Error(result.message || 'Gagal memuat alamat');
                    }

                } catch (error) {
                    console.error('Error loading addresses:', error);
                    container.innerHTML = `
                        <div class="text-center py-8">
                            <i class="fas fa-exclamation-triangle text-4xl text-red-400 mb-4"></i>
                            <p class="text-gray-600">Gagal memuat alamat</p>
                            <p class="text-sm text-gray-500 mt-1">${error.message}</p>
                            <button onclick="loadAddresses()"
                                    class="mt-4 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                                Coba Lagi
                            </button>
                        </div>
                    `;
                }
            }

            function displayAddresses(addresses, container) {
                if (!addresses || addresses.length === 0) {
                    container.innerHTML = `
                        <div class="text-center py-8">
                            <i class="fas fa-map-marker-alt text-4xl text-gray-400 mb-4"></i>
                            <p class="text-gray-600">Belum ada alamat tersimpan</p>
                            <p class="text-sm text-gray-500 mt-1">Tambahkan alamat pertama Anda</p>
                            <a href="{{ route('addalamat') }}"
                            class="mt-4 inline-block px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                                Tambah Alamat
                            </a>
                        </div>
                    `;
                    return;
                }

                container.innerHTML = `
                    <div class="space-y-5 mt-4" id="addresses-list">
                        ${addresses.map((address, index) => createAddressCard(address, index)).join('')}
                    </div>
                `;

                // FIXED: Use attachEventListeners() instead of attachDeleteListeners()
                attachEventListeners(); // ← THIS IS THE FIX
            }

            function createAddressCard(address, index) {
                // Split address lines for better display
                const addressLines = address.desk_alamat.split('\n');

                return `
                    <div class="border rounded-xl p-5 shadow-sm bg-gray-50 hover:bg-gray-100 transition relative"
                        data-address-id="${address.id}">

                        <!-- Badge Section - Top Right -->
                        ${address.selected ? `
                            <div class="absolute top-3 right-3">
                                <span class="bg-green-100 text-green-800 text-xs font-medium px-2 py-1 rounded">
                                    <i class="fas fa-check-circle mr-1"></i>Utama
                                </span>
                            </div>
                        ` : `
                            <div class="absolute top-3 right-3">
                                <span class="bg-gray-100 text-gray-600 text-xs font-medium px-2 py-1 rounded">
                                    <i class="fas fa-map-marker-alt mr-1"></i>Non-Utama
                                </span>
                            </div>
                        `}

                        <!-- Address Name -->
                        <p class="text-lg font-semibold text-gray-800" data-address-name>${escapeHtml(address.nama)}</p>

                        <!-- Address Details -->
                        <div class="mt-2 space-y-1">
                            ${addressLines.map(line => `
                                <p class="text-gray-700">${escapeHtml(line)}</p>
                            `).join('')}
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex justify-between items-center mt-4">
                            <!-- LEFT: Set as Default Button (only if not already default) -->
                            ${!address.selected ? `
                                <div>
                                    <button class="select-address-btn px-4 py-2 text-sm bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition"
                                            data-address-id="${address.id}">
                                        <i class="fas fa-check-circle mr-1"></i>Jadikan Utama
                                    </button>
                                </div>
                            ` : '<div></div>' /* Empty div to maintain layout when no default button */}

                            <!-- RIGHT: Edit and Delete buttons -->
                            <div class="flex space-x-2">
                                <!-- Edit Button -->
                                <button class="edit-address-btn px-4 py-2 text-sm bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition"
                                        data-address-id="${address.id}">
                                    <i class="fas fa-edit mr-1"></i>Edit
                                </button>

                                <!-- Delete Button -->
                                <button class="delete-address-btn px-4 py-2 text-sm bg-red-500 text-white rounded-lg hover:bg-red-600 transition"
                                        data-address-id="${address.id}">
                                    <i class="fas fa-trash mr-1"></i>Hapus
                                </button>
                            </div>
                        </div>
                    </div>
                `;
            }

            async function editAddress(addressId) {
                try {
                    const response = await fetch(`/user/api/addresses/${addressId}`, {
                        method: 'GET',
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') || ''
                        }
                    });

                    const result = await response.json();

                    if (result.success) {
                        // Store in localStorage and redirect to EDIT ROUTE
                        localStorage.setItem('editAddressData', JSON.stringify(result.data));
                        window.location.href = `/editalamat/${addressId}`;
                    } else {
                        throw new Error(result.message || 'Gagal memuat data alamat');
                    }
                } catch (error) {
                    console.error('Error loading address:', error);
                    alert('Gagal memuat data alamat: ' + error.message);
                }
            }

            function attachEventListeners() {
                // Edit buttons
                document.querySelectorAll('.edit-address-btn').forEach(button => {
                    button.addEventListener('click', function () {
                        const addressId = this.getAttribute('data-address-id');
                        editAddress(addressId);
                    });
                });

                // Delete buttons
                document.querySelectorAll('.delete-address-btn').forEach(button => {
                    button.addEventListener('click', function () {
                        const addressId = this.getAttribute('data-address-id');

                        if (confirm(`Apakah Anda yakin ingin menghapus alamat ini?`)) {
                            deleteAddress(addressId);
                        }
                    });
                });

                // Select buttons (make default)
                document.querySelectorAll('.select-address-btn').forEach(button => {
                    button.addEventListener('click', function () {
                        const addressId = this.getAttribute('data-address-id');
                        selectAddressAsDefault(addressId);
                    });
                });
            }

            async function deleteAddress(addressId) {
                const button = document.querySelector(`.delete-address-btn[data-address-id="${addressId}"]`);
                const card = document.querySelector(`[data-address-id="${addressId}"]`);

                if (!button || !card) return;

                // Show loading on button
                const originalText = button.innerHTML;
                button.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i>Menghapus...';
                button.disabled = true;

                try {
                    const response = await fetch(`/user/api/addresses/${addressId}`, {
                        method: 'DELETE',
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') || ''
                        }
                    });

                    const result = await response.json();

                    if (result.success) {
                        // Remove card with fade out animation
                        card.style.opacity = '0';
                        card.style.transform = 'translateX(-20px)';
                        card.style.transition = 'all 0.3s ease';

                        setTimeout(() => {
                            card.remove();

                            // Check if no addresses left
                            const remainingCards = document.querySelectorAll('[data-address-id]');
                            if (remainingCards.length === 0) {
                                loadAddresses(); // Reload to show empty state
                            }

                            // Show success message
                            showMessage('Alamat berhasil dihapus', 'success');
                        }, 300);

                    } else {
                        throw new Error(result.message || 'Gagal menghapus alamat');
                    }

                } catch (error) {
                    console.error('Error deleting address:', error);

                    // Restore button
                    button.innerHTML = originalText;
                    button.disabled = false;

                    // Show error
                    showMessage('Gagal menghapus alamat: ' + error.message, 'error');
                }
            }

            async function selectAddressAsDefault(addressId) {
                const button = document.querySelector(`.select-address-btn[data-address-id="${addressId}"]`);

                if (!button) return;

                // Show loading on button
                const originalText = button.innerHTML;
                button.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i>Memproses...';
                button.disabled = true;

                try {
                    const response = await fetch(`/user/api/addresses/${addressId}/select`, {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') || ''
                        }
                    });

                    const result = await response.json();

                    if (result.success) {
                        // Reload addresses to show updated "Utama" badge
                        loadAddresses();
                        showMessage('Alamat utama berhasil diubah', 'success');
                    } else {
                        throw new Error(result.message || 'Gagal mengubah alamat utama');
                    }

                } catch (error) {
                    console.error('Error selecting address:', error);

                    // Restore button
                    button.innerHTML = originalText;
                    button.disabled = false;

                    // Show error
                    showMessage('Gagal mengubah alamat utama: ' + error.message, 'error');
                }
            }

            // Helper functions
            function escapeHtml(text) {
                const div = document.createElement('div');
                div.textContent = text;
                return div.innerHTML;
            }

            function showMessage(message, type = 'info') {
                // Remove existing messages
                const existingMsg = document.getElementById('flash-message');
                if (existingMsg) existingMsg.remove();

                const colors = {
                    'success': 'bg-green-100 border-green-400 text-green-700',
                    'error': 'bg-red-100 border-red-400 text-red-700',
                    'info': 'bg-blue-100 border-blue-400 text-blue-700'
                };

                const messageDiv = document.createElement('div');
                messageDiv.id = 'flash-message';
                messageDiv.className = `fixed top-4 right-4 ${colors[type]} px-6 py-3 rounded-lg shadow-lg z-50 max-w-md`;
                messageDiv.innerHTML = `
                    <div class="flex items-center">
                        <i class="fas ${type === 'success' ? 'fa-check-circle' : type === 'error' ? 'fa-exclamation-circle' : 'fa-info-circle'} mr-3"></i>
                        <span>${escapeHtml(message)}</span>
                    </div>
                `;

                document.body.appendChild(messageDiv);

                // Auto-remove after 5 seconds
                setTimeout(() => {
                    messageDiv.remove();
                }, 5000);
            }

            // Expose loadAddresses globally for retry button
            window.loadAddresses = loadAddresses;
        });
    </script>

</body>

</html>