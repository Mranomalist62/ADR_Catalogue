<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Produk - ADR Catalogue</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .sidebar-gradient {
            background: linear-gradient(135deg, #1e3a8a 0%, #2d3748 100%);
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
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

        .nav-item {
            transition: all 0.3s ease;
        }

        .nav-item:hover {
            transform: translateX(4px);
        }

        .status-badge {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }

        .form-input {
            transition: all 0.3s ease;
        }

        .form-input:focus {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.15);
        }
    </style>
</head>

<body class="bg-gradient-to-br from-blue-50 via-blue-100 to-blue-200">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="w-64 sidebar-gradient text-white flex flex-col">
            <!-- Logo Section -->
            <div class="p-6 border-b border-gray-700">
                <div class="flex items-center">
                    <img src="{{ asset('images/asset/logo.png') }}" alt="ADR Logo"
                        class="w-10 h-10 object-contain mr-3">
                    <div>
                        <h1 class="text-xl font-bold">ADR Catalogue</h1>
                        <p class="text-xs text-gray-400">Admin Panel</p>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 p-4 space-y-2">
                <a href="{{ route('admin') }}"
                    class="nav-item group flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->is('admin') ? 'bg-white/20 text-white' : 'text-gray-300 hover:text-white hover:bg-white/10' }} transition-all duration-300">
                    <i class="fas fa-home w-5 h-5 mr-3"></i>
                    <span>Dashboard</span>
                    <div
                        class="absolute inset-y-0 left-0 w-1 bg-white rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    </div>
                </a>

                <a href="{{ route('admin.orders') }}"
                    class="nav-item group flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->is('admin/orders') ? 'bg-white/20 text-white' : 'text-gray-300 hover:text-white hover:bg-white/10' }} transition-all duration-300">
                    <i class="fas fa-shopping-bag w-5 h-5 mr-3"></i>
                    <span>Pesanan</span>
                    <div
                        class="absolute inset-y-0 left-0 w-1 bg-white rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    </div>
                </a>

                <a href="{{ route('admin.statistics') }}"
                    class="nav-item group flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->is('admin/statistics') ? 'bg-white/20 text-white' : 'text-gray-300 hover:text-white hover:bg-white/10' }} transition-all duration-300">
                    <i class="fas fa-chart-line w-5 h-5 mr-3"></i>
                    <span>Statistik</span>
                    <div
                        class="absolute inset-y-0 left-0 w-1 bg-white rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    </div>
                </a>

                <a href="{{ route('admin.billing') }}"
                    class="nav-item group flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->is('admin/billing') ? 'bg-white/20 text-white' : 'text-gray-300 hover:text-white hover:bg-white/10' }} transition-all duration-300">
                    <i class="fas fa-file-invoice-dollar w-5 h-5 mr-3"></i>
                    <span>Tagihan</span>
                    <div
                        class="absolute inset-y-0 left-0 w-1 bg-white rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    </div>
                </a>

                <a href="{{ route('admin.products') }}"
                    class="nav-item group flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->is('admin/products') ? 'bg-white/20 text-white' : 'text-gray-300 hover:text-white hover:bg-white/10' }} transition-all duration-300">
                    <i class="fas fa-box w-5 h-5 mr-3"></i>
                    <span>Produk</span>
                    <div
                        class="absolute inset-y-0 left-0 w-1 bg-white rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    </div>
                </a>
                
                <a href="{{ route('admin.promo') }}" class="nav-item group flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->is('admin/promo') ? 'bg-white/20 text-white' : 'text-gray-300 hover:text-white hover:bg-white/10' }} transition-all duration-300">
                    <i class="fas fa-tags w-5 h-5 mr-3"></i>
                    <span>Kelola Promo</span>
                    <div class="absolute inset-y-0 left-0 w-1 bg-white rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </a>

                <a href="{{ route('admin.chat') }}"
                    class="nav-item group flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->is('admin/chat') ? 'bg-white/20 text-white' : 'text-gray-300 hover:text-white hover:bg-white/10' }} transition-all duration-300">
                    <i class="fas fa-comments w-5 h-5 mr-3"></i>
                    <span>Chat</span>
                    @if($unreadCount > 0)
                        <span class="ml-auto bg-red-500 text-white text-xs rounded-full px-2 py-1">{{ $unreadCount }}</span>
                    @endif
                    <div
                        class="absolute inset-y-0 left-0 w-1 bg-white rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    </div>
                </a>

            </nav>

            <!-- User Section -->
            <div class="p-4 border-t border-gray-700">
                <a href="#"
                    class="nav-item group relative flex items-center px-4 py-3 text-sm font-medium rounded-lg text-gray-300 hover:text-white hover:bg-white/10 transition-all duration-300">
                    <i class="fas fa-user w-5 h-5 mr-3"></i>
                    <span class="flex-1 truncate">{{ $admin->nama ?? 'Admin User' }}</span>
                    <div
                        class="absolute left-0 top-0 bottom-0 w-1 bg-white rounded-full opacity-0 group-hover:opacity-100 transition-all duration-300 transform scale-y-0 group-hover:scale-y-100">
                    </div>
                </a>
            </div>

            <!-- Logout Button -->
            <div class="p-4 border-t border-gray-700">
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="nav-item group relative w-full flex items-center px-4 py-3 text-sm font-medium rounded-lg text-gray-300 hover:text-white hover:bg-white/10 transition-all duration-300">
                        <i class="fas fa-sign-out-alt w-5 h-5 mr-3"></i>
                        <span>Logout</span>
                        <div
                            class="absolute left-0 top-0 bottom-0 w-1 bg-white rounded-full opacity-0 group-hover:opacity-100 transition-all duration-300 transform scale-y-0 group-hover:scale-y-100">
                        </div>
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-auto">
            <!-- Top Header -->
            <div class="bg-white shadow-sm border-b border-gray-200">
                <div class="px-6 py-4 flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-semibold text-gray-800">Manajemen Produk</h1>
                        <p class="text-sm text-gray-600">Kelola semua produk katalog Anda</p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <button class="relative p-2 text-gray-600 hover:text-gray-800 transition-colors">
                            <i class="fas fa-bell"></i>
                            <span class="absolute top-0 right-0 h-2 w-2 bg-red-500 rounded-full"></span>
                        </button>
                        <button class="p-2 text-gray-600 hover:text-gray-800 transition-colors">
                            <i class="fas fa-cog"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Main Dashboard Content -->
            <div class="p-6">
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <!-- Total Products Card -->
                    <div class="card-hover bg-white rounded-xl shadow-lg p-6 slide-in" style="animation-delay: 0.1s">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Total Produk</p>
                                <p class="text-3xl font-bold text-gray-900">{{ $products->count() }}</p>
                                <p class="text-xs text-green-600 flex items-center mt-1">
                                    <i class="fas fa-arrow-up mr-1"></i>
                                    <span>+12% dari bulan lalu</span>
                                </p>
                            </div>
                            <div class="p-3 bg-blue-500 rounded-full">
                                <i class="fas fa-box text-white text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <!-- In Stock Card -->
                    <div class="card-hover bg-white rounded-xl shadow-lg p-6 slide-in" style="animation-delay: 0.2s">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Tersedia</p>
                                <p class="text-3xl font-bold text-gray-900">89</p>
                                <p class="text-xs text-green-600 flex items-center mt-1">
                                    <i class="fas fa-check-circle mr-1"></i>
                                    <span>78% dari total</span>
                                </p>
                            </div>
                            <div class="p-3 bg-green-500 rounded-full">
                                <i class="fas fa-check-circle text-white text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Low Stock Card -->
                    <div class="card-hover bg-white rounded-xl shadow-lg p-6 slide-in" style="animation-delay: 0.3s">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Stok Rendah</p>
                                <p class="text-3xl font-bold text-gray-900">15</p>
                                <p class="text-xs text-yellow-600 flex items-center mt-1">
                                    <i class="fas fa-exclamation-triangle mr-1"></i>
                                    <span>Perlu restock</span>
                                </p>
                            </div>
                            <div class="p-3 bg-yellow-500 rounded-full">
                                <i class="fas fa-exclamation-triangle text-white text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Out of Stock Card -->
                    <div class="card-hover bg-white rounded-xl shadow-lg p-6 slide-in" style="animation-delay: 0.4s">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Habis</p>
                                <p class="text-3xl font-bold text-gray-900">10</p>
                                <p class="text-xs text-red-600 flex items-center mt-1">
                                    <i class="fas fa-times-circle mr-1"></i>
                                    <span>Perlu restock segera</span>
                                </p>
                            </div>
                            <div class="p-3 bg-red-500 rounded-full">
                                <i class="fas fa-times-circle text-white text-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Add Product Form -->
                <div class="card-hover bg-white rounded-xl shadow-lg overflow-hidden slide-in"
                    style="animation-delay: 0.5s">
                    <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-800">Tambah Produk Baru</h3>
                        <button onclick="toggleForm()" class="text-gray-600 hover:text-gray-800 transition-colors">
                            <i class="fas fa-chevron-down" id="formToggleIcon"></i>
                        </button>
                    </div>
                    <div id="productForm" class="p-6">
                        <form id="productCreateForm">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">Nama
                                        Produk</label>
                                    <input type="text" id="nama" name="nama" required
                                        class="form-input w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        placeholder="Masukkan nama produk">
                                </div>
                                <div>
                                    <label for="kategori"
                                        class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                                    <select id="kategori" name="id_kategori" required
                                        class="form-input w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <option value="">Pilih Kategori</option>
                                        <!-- Options loaded by JavaScript -->
                                    </select>
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                                <div>
                                    <label for="harga_satuan"
                                        class="block text-sm font-medium text-gray-700 mb-2">Harga</label>
                                    <input type="number" id="harga_satuan" name="harga_satuan" required
                                        class="form-input w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        placeholder="Masukkan harga" step="1000">
                                </div>
                                <div>
                                    <label for="diskon" class="block text-sm font-medium text-gray-700 mb-2">Diskon
                                        (%)</label>
                                    <input type="number" id="diskon" name="diskon" min="0" max="100" step="0.01"
                                        class="form-input w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        placeholder="Masukkan diskon dalam persen">
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                                <div>
                                    <label for="kuantitas"
                                        class="block text-sm font-medium text-gray-700 mb-2">Stok</label>
                                    <input type="number" id="kuantitas" name="kuantitas" required
                                        class="form-input w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        placeholder="Masukkan jumlah stok">
                                </div>
                                <div>
                                    <label for="harga_setelah_diskon"
                                        class="block text-sm font-medium text-gray-700 mb-2">
                                        Harga Setelah Diskon
                                    </label>
                                    <input type="text" id="harga_setelah_diskon" readonly
                                        class="w-full px-4 py-2 border border-gray-200 rounded-md bg-gray-50 text-gray-700"
                                        placeholder="Rp 0">
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                                <div>
                                    <label for="desc"
                                        class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                                    <textarea id="desc" name="desc" rows="3" required
                                        class="form-input w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        placeholder="Masukkan deskripsi produk"></textarea>
                                </div>
                                <div>
                                    <label for="thumbnail"
                                        class="block text-sm font-medium text-gray-700 mb-2">Thumbnail</label>
                                    <input type="file" id="thumbnail" name="thumbnail"
                                        class="form-input w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                            </div>
                            <div class="flex justify-end mt-6">
                                <button type="submit" id="submitBtn"
                                    class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-6 rounded-md transition-colors transform hover:scale-105">
                                    <i class="fas fa-save mr-2"></i> Simpan Produk
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Products Table -->
                <div class="card-hover bg-white rounded-xl shadow-lg overflow-hidden slide-in mt-8"
                    style="animation-delay: 0.6s">
                    <div class="px-6 py-4 border-b border-gray-100">
                        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4 lg:mb-0">Daftar Produk</h3>
                            <div class="flex flex-col sm:flex-row gap-4">
                                <div class="relative">
                                    <input type="text" placeholder="Cari produk..." id="searchInput"
                                        class="pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-search text-gray-400"></i>
                                    </div>
                                </div>
                                <select
                                    class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    id="category-filter">
                                    <option value="">Semua Kategori</option>
                                    <!-- dynamic categories will be inserted here -->
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        ID</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nama Produk</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Kategori</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Harga</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Diskon</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Harga Final</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Stok</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($products as $product)
                                    <tr class="hover:bg-blue-50 transition-colors duration-200">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            #{{ $product->id }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                @if($product->path_thumbnail)
                                                    <img src="{{ asset('storage/' . $product->path_thumbnail) }}" alt="{{ $product->nama }}"
                                                        class="h-10 w-10 rounded-lg object-cover">
                                                @else
                                                    <div class="h-10 w-10 rounded-lg bg-gray-200 flex items-center justify-center">
                                                        <span class="text-xs font-medium">{{ substr($product->nama, 0, 2) }}</span>
                                                    </div>
                                                @endif
                                                <div class="ml-3">
                                                    <div class="text-sm font-medium text-gray-900">{{ $product->nama }}</div>
                                                    <div class="text-xs text-gray-500 truncate max-w-xs">{{ $product->desc ?: 'Tidak ada deskripsi' }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $product->category ? $product->category->nama : 'Tidak ada kategori' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            Rp {{ number_format($product->harga_satuan, 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @php
                                                $discount = $product->promo ? $product->promo->potongan_harga : 0;
                                            @endphp
                                            @if($discount > 0)
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    {{ $discount }}%
                                                </span>
                                            @else
                                                <span class="text-gray-400">-</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium {{ $discount > 0 ? 'text-green-600' : 'text-gray-900' }}">
                                            Rp {{ number_format($product->harga_satuan * (1 - $discount / 100), 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $product->kuantitas }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($product->kuantitas > 10)
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    Tersedia
                                                </span>
                                            @elseif($product->kuantitas > 0)
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                    Stok Rendah
                                                </span>
                                            @else
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                    Habis
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex space-x-3">
                                                <a href="{{ route('admin.products.edit', $product->id) }}"
                                                    class="text-blue-600 hover:text-blue-900 transition-colors flex items-center">
                                                    <i class="fas fa-edit mr-1"></i> Edit
                                                </a>
                                                <button type="button" class="delete-btn text-red-600 hover:text-red-900 transition-colors flex items-center"
                                                    data-product-id="{{ $product->id }}">
                                                    <i class="fas fa-trash mr-1"></i> Hapus
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="px-6 py-8 text-center text-gray-500">
                                            <i class="fas fa-box-open text-4xl mb-2"></i>
                                            <p>Belum ada produk yang ditambahkan</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative m-4"
                            role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <!-- Pagination -->
                    <div class="bg-white px-6 py-3 flex items-center justify-between border-t border-gray-100">
                        <div>
                            <p class="text-sm text-gray-700">
                                Menampilkan <span class="font-medium">{{ $products->count() }}</span> produk
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Toggle form visibility
        function toggleForm() {
            const form = document.getElementById('productForm');
            const icon = document.getElementById('formToggleIcon');

            if (form.style.display === 'none') {
                form.style.display = 'block';
                icon.classList.remove('fa-chevron-down');
                icon.classList.add('fa-chevron-up');
            } else {
                form.style.display = 'none';
                icon.classList.remove('fa-chevron-up');
                icon.classList.add('fa-chevron-down');
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            // 1. Load categories from API
            fetch('/public/categories')
                .then(res => res.json())
                .then(data => {
                    const select = document.getElementById('kategori');
                    data.data.forEach(category => {
                        const option = document.createElement('option');
                        option.value = category.id;
                        option.textContent = category.nama;
                        select.appendChild(option);
                    });
                });

            // 2. Handle form submission
            document.getElementById('productCreateForm').addEventListener('submit', async function (e) {
                e.preventDefault();

                const submitBtn = document.getElementById('submitBtn');
                const originalText = submitBtn.innerHTML;

                // Show loading
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Menyimpan...';

                try {
                    // Create FormData for file upload
                    const formData = new FormData(this);

                    // Send to API endpoint
                    const response = await fetch('/admin/api/products', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: formData
                    });

                    const result = await response.json();

                    if (response.ok && result.success) {
                        alert('Produk berhasil disimpan!');
                        this.reset();
                        document.getElementById('harga_setelah_diskon').value = 'Rp 0';

                        // Show success message
                        showNotification('Produk berhasil dibuat!', 'success');

                        // Redirect to product list
                        window.location.href = '{{ route("admin.products") }}';
                    } else {
                        alert(result.message || 'Gagal menyimpan produk');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat menyimpan produk');
                } finally {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalText;
                }
            });

            // 3. Calculate discounted price
            const hargaInput = document.getElementById('harga_satuan');
            const diskonInput = document.getElementById('diskon');
            const hargaDiskonInput = document.getElementById('harga_setelah_diskon');

            function calculateDiscount() {
                const harga = parseFloat(hargaInput.value) || 0;
                const diskon = parseFloat(diskonInput.value) || 0;
                const hargaDiskon = harga - (harga * diskon / 100);
                hargaDiskonInput.value = 'Rp ' + hargaDiskon.toLocaleString('id-ID');
            }

            hargaInput.addEventListener('input', calculateDiscount);
            diskonInput.addEventListener('input', calculateDiscount);

            // 4. Success notification function
            function showNotification(message, type = 'success') {
                const notification = document.createElement('div');
                notification.className = `fixed top-4 right-4 px-6 py-3 rounded-md shadow-lg ${type === 'success' ? 'bg-green-500' : 'bg-red-500'
                    } text-white`;
                notification.textContent = message;
                document.body.appendChild(notification);

                setTimeout(() => notification.remove(), 3000);
            }
        });

        // Search functionality
        document.getElementById('searchInput').addEventListener('input', function (e) {
            const searchValue = e.target.value.toLowerCase();
            const rows = document.querySelectorAll('tbody tr');

            rows.forEach(row => {
                const productName = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                const categoryName = row.querySelector('td:nth-child(3)').textContent.toLowerCase();

                if (productName.includes(searchValue) || categoryName.includes(searchValue)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        // Category filter
        document.getElementById('category-filter').addEventListener('change', function (e) {
            const categoryValue = e.target.value;
            const rows = document.querySelectorAll('tbody tr');

            rows.forEach(row => {
                const rowCategory = row.querySelector('td:nth-child(3)').textContent;

                if (categoryValue === '' || rowCategory === categoryValue) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        document.addEventListener("DOMContentLoaded", function () {
            const selects = [
                document.getElementById('kategori'),
                document.getElementById('category-filter')
            ].filter(Boolean); // ignore null elements if one doesn't exist

            fetch('/public/categories')
                .then(res => res.json())
                .then(data => {
                    data.data.forEach(category => {
                        selects.forEach(select => {
                            const option = document.createElement('option');
                            option.value = category.id;
                            option.textContent = category.nama;
                            select.appendChild(option);
                        });
                    });
                })
                .catch(err => console.error("Failed to load categories", err));
        });

        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('delete-btn')) {
                const productId = e.target.dataset.productId;
                deleteProduct(productId);
            }
        });

        async function deleteProduct(productId) {
            if (!confirm('Apakah Anda yakin ingin menghapus produk ini?')) return;

            try {
                const response = await fetch(`/admin/api/products/${productId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                if (response.ok) {
                    // Remove row from table or reload
                    location.reload();
                }
            } catch (error) {
                console.error('Delete failed:', error);
            }
        }
    </script>
</body>

</html>
