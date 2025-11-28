<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Produk - ADR Catalogue</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-blue-500 text-white">
            <div class="p-4">
                <div class="flex items-center justify-center mb-4">
                    <img src="{{ asset('images/asset/logo.png') }}" alt="ADR Logo" class="h-12 w-auto">
                </div>
                <h1 class="text-xl font-bold text-center">Admin Panel</h1>
            </div>
            <nav class="mt-8">
                <a href="{{ route('admin') }}" class="group block py-3 px-4 hover:bg-blue-600 transition-all duration-300 rounded-lg transform hover:scale-105 hover:shadow-lg {{ request()->is('admin') ? 'bg-blue-600 shadow-lg transform scale-105' : '' }}">
                    <svg class="w-5 h-5 inline mr-2 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>Dashboard
                </a>
                <a href="{{ route('admin.orders') }}" class="group block py-3 px-4 hover:bg-blue-600 transition-all duration-300 rounded-lg transform hover:scale-105 hover:shadow-lg {{ request()->is('admin/orders') ? 'bg-blue-600 shadow-lg transform scale-105' : '' }}">
                    <svg class="w-5 h-5 inline mr-2 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>Pesanan
                </a>
                <a href="{{ route('admin.statistics') }}" class="group block py-3 px-4 hover:bg-blue-600 transition-all duration-300 rounded-lg transform hover:scale-105 hover:shadow-lg {{ request()->is('admin/statistics') ? 'bg-blue-600 shadow-lg transform scale-105' : '' }}">
                    <svg class="w-5 h-5 inline mr-2 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>Statistik
                </a>
                 <a href="{{ route('admin.billing') }}" class="block py-3 px-4 hover:bg-blue-600 transition-all duration-300 rounded-lg transform hover:scale-105 hover:shadow-lg {{ request()->is('admin/billing') ? 'bg-blue-600 shadow-lg transform scale-105' : '' }}">
                    <svg class="w-5 h-5 inline mr-2 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>Tagihan
                </a>
                <a href="{{ route('admin.products') }}" class="block py-3 px-4 hover:bg-blue-600 transition-all duration-300 rounded-lg transform hover:scale-105 hover:shadow-lg {{ request()->is('admin/products') ? 'bg-blue-600 shadow-lg transform scale-105' : '' }}">
                    <svg class="w-5 h-5 inline mr-2 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>Produk
                </a>
                <form action="{{ route('admin.logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="group block w-full text-left py-3 px-4 hover:bg-red-600 transition-all duration-300 rounded-lg text-red-200 transform hover:scale-105 hover:shadow-lg">
                        <svg class="w-5 h-5 inline mr-2 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>Logout
                    </button>
                </form>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-4 lg:p-8 overflow-auto bg-gradient-to-br from-gray-50 to-gray-100">
            <div class="mb-8">
                <h2 class="text-3xl font-bold text-gray-800">Manajemen Produk</h2>
                <p class="text-gray-600">Kelola semua produk katalog</p>
            </div>

            <!-- Add Product Form -->
            <div class="bg-white p-4 lg:p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 mb-4 lg:mb-6">
                <div class="p-4 lg:p-6 border-b border-gray-100">
                    <h3 class="text-lg font-semibold">Tambah Produk Baru</h3>
                </div>
                <div class="p-4 lg:p-6">
                    <form action="#" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">Nama Produk</label>
                                <input type="text" id="nama" name="nama" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    placeholder="Masukkan nama produk">
                            </div>
                            <div>
                                <label for="kategori" class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                                <select id="kategori" name="id_kategori" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Pilih Kategori</option>
                                    <option value="1">Elektronik</option>
                                    <option value="2">Aksesoris</option>
                                    <option value="3">Fashion</option>
                                    <option value="4">Makanan</option>
                                </select>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="harga" class="block text-sm font-medium text-gray-700 mb-2">Harga</label>
                                <input type="number" id="harga" name="harga" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    placeholder="Masukkan harga" step="1000">
                            </div>
                            <div>
                                <label for="quantity" class="block text-sm font-medium text-gray-700 mb-2">Stok</label>
                                <input type="number" id="quantity" name="quantity" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    placeholder="Masukkan jumlah stok">
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                                <textarea id="deskripsi" name="desc" rows="3" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    placeholder="Masukkan deskripsi produk"></textarea>
                            </div>
                            <div>
                                <label for="thumbnail" class="block text-sm font-medium text-gray-700 mb-2">Thumbnail</label>
                                <input type="file" id="thumbnail" name="thumbnail"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                        </div>
                        <div class="flex justify-end mt-6">
                            <button type="submit"
                                class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <i class="fas fa-save mr-2"></i> Simpan Produk
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Products Table -->
            <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300">
                <div class="p-4 lg:p-6 border-b border-gray-100">
                    <div class="flex justify-between items-center">
                        <h3 class="text-lg font-semibold">Daftar Produk</h3>
                        <div class="flex space-x-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                                <input type="text" placeholder="Cari produk..." 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                                <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    id="category-filter">
                                    <option value="">Semua Kategori</option>
                                    <option value="1">Elektronik</option>
                                    <option value="2">Aksesoris</option>
                                    <option value="3">Fashion</option>
                                    <option value="4">Makanan</option>
                                </select>
                            </div>
                            <div>
                                <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">
                                    <i class="fas fa-search mr-2"></i> Cari
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Produk</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stok</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr class="hover:bg-blue-50 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#001</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <div class="flex items-center">
                                        <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center">
                                            <span class="text-xs font-medium">LP</span>
                                        </div>
                                        <div class="ml-3">
                                            <div class="text-sm font-medium text-gray-900">Laptop ASUS ROG</div>
                                            <div class="text-xs text-gray-500">Elektronik</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp 15.000.000</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">25</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Tersedia
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button class="text-blue-600 hover:text-blue-900 mr-3">Edit</button>
                                    <button class="text-red-600 hover:text-red-900">Hapus</button>
                                </td>
                            </tr>
                            <tr class="hover:bg-blue-50 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#002</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <div class="flex items-center">
                                        <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center">
                                            <span class="text-xs font-medium">MS</span>
                                        </div>
                                        <div class="ml-3">
                                            <div class="text-sm font-medium text-gray-900">Mouse Gaming Logitech</div>
                                            <div class="text-xs text-gray-500">Aksesoris</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp 500.000</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">50</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Tersedia
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button class="text-blue-600 hover:text-blue-900 mr-3">Edit</button>
                                    <button class="text-red-600 hover:text-red-900">Hapus</button>
                                </td>
                            </tr>
                            <tr class="hover:bg-blue-50 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#003</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <div class="flex items-center">
                                        <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center">
                                            <span class="text-xs font-medium">KB</span>
                                        </div>
                                        <div class="ml-3">
                                            <div class="text-sm font-medium text-gray-900">Keyboard Mechanical</div>
                                            <div class="text-xs text-gray-500">Aksesoris</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp 1.200.000</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">32</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        Habis
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button class="text-blue-600 hover:text-blue-900 mr-3">Edit</button>
                                    <button class="text-green-600 hover:text-green-900 mr-3">Restock</button>
                                    <button class="text-red-600 hover:text-red-900">Hapus</button>
                                </td>
                            </tr>
                            <tr class="hover:bg-blue-50 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#004</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <div class="flex items-center">
                                        <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center">
                                            <span class="text-xs font-medium">MN</span>
                                        </div>
                                        <div class="ml-3">
                                            <div class="text-sm font-medium text-gray-900">Monitor LG 27"</div>
                                            <div class="text-xs text-gray-500">Elektronik</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp 4.500.000</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">12</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Tersedia
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button class="text-blue-600 hover:text-blue-900 mr-3">Edit</button>
                                    <button class="text-red-600 hover:text-red-900">Hapus</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="bg-white px-4 lg:px-6 py-3 flex items-center justify-between border-t border-gray-100">
                    <div class="flex-1 flex justify-between sm:hidden">
                        <button class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                            Previous
                        </button>
                        <button class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                            Next
                        </button>
                    </div>
                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm text-gray-700">
                                Menampilkan <span class="font-medium">1</span> hingga <span class="font-medium">10</span> dari{' '}
                                <span class="font-medium">4</span> hasil
                            </p>
                        </div>
                        <div>
                            <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                                <button class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                    Previous
                                </button>
                                <button aria-current="page" class="relative inline-flex items-center px-4 py-2 border border-blue-500 bg-blue-50 text-sm font-medium text-blue-600">
                                    1
                                </button>
                                <button class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                                    2
                                </button>
                                <button class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                                    3
                                </button>
                                <button class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                                    4
                                </button>
                                <button class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                                    Next
                                </button>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Search functionality
        document.getElementById('search-input').addEventListener('input', function(e) {
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
        document.getElementById('category-filter').addEventListener('change', function(e) {
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
    </script>
</body>
</html>