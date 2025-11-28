<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Tagihan - ADR Catalogue</title>
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
                <a href="{{ route('admin.billing') }}" class="group block py-3 px-4 hover:bg-blue-600 transition-all duration-300 rounded-lg transform hover:scale-105 hover:shadow-lg {{ request()->is('admin/billing') ? 'bg-blue-600 shadow-lg transform scale-105' : '' }}">
                    <svg class="w-5 h-5 inline mr-2 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>Tagihan
                </a>
                <a href="{{ route('admin.products') }}" class="group block py-3 px-4 hover:bg-blue-600 transition-all duration-300 rounded-lg transform hover:scale-105 hover:shadow-lg {{ request()->is('admin/products') ? 'bg-blue-600 shadow-lg transform scale-105' : '' }}">
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
                <h2 class="text-3xl font-bold text-gray-800">Manajemen Tagihan</h2>
                <p class="text-gray-600">Kelola semua tagihan dan invoice pelanggan</p>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6 mb-6 lg:mb-8">
                <div class="bg-white p-4 lg:p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="flex items-center">
                        <div class="p-3 bg-blue-500 rounded-full">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2v0a2 2 0 012 2m3 4h13a2 2 0 002-2v-1a2 2 0 00-2-2H5a2 2 0 00-2 2v1a2 2 0 002 2h13a2 2 0 002-2v-1a2 2 0 00-2-2z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-600">Total Tagihan</p>
                            <p class="text-2xl font-bold">89</p>
                            <p class="text-xs text-gray-500">Bulan ini</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-4 lg:p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="flex items-center">
                        <div class="p-3 bg-green-500 rounded-full">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-600">Sudah Dibayar</p>
                            <p class="text-2xl font-bold">67</p>
                            <p class="text-xs text-green-600">75.3%</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-4 lg:p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="flex items-center">
                        <div class="p-3 bg-yellow-500 rounded-full">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-600">Menunggu Pembayaran</p>
                            <p class="text-2xl font-bold">15</p>
                            <p class="text-xs text-yellow-600">16.9%</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-4 lg:p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="flex items-center">
                        <div class="p-3 bg-red-500 rounded-full">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 2.502-3.018V8.482c0-1.351-1.012-3.018-2.502-3.018H4.982c-1.49 0-2.502 1.667-2.502 3.018v5.484c0 1.351 1.012 3.018 2.502 3.018h13.856c1.54 0 2.502-1.667 2.502-3.018V8.482c0-1.351-1.012-3.018-2.502-3.018z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-600">Terlambat</p>
                            <p class="text-2xl font-bold">7</p>
                            <p class="text-xs text-red-600">7.9%</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filters -->
            <div class="bg-white p-4 lg:p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 mb-4 lg:mb-6">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                        <input type="text" placeholder="Cari invoice..." class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Semua Status</option>
                            <option value="paid">Sudah Dibayar</option>
                            <option value="pending">Menunggu Pembayaran</option>
                            <option value="overdue">Terlambat</option>
                            <option value="cancelled">Dibatalkan</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Periode</label>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Semua Periode</option>
                            <option value="today">Hari Ini</option>
                            <option value="week">Minggu Ini</option>
                            <option value="month">Bulan Ini</option>
                            <option value="year">Tahun Ini</option>
                        </select>
                    </div>
                    <div class="flex items-end">
                        <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">
                            <i class="fas fa-search mr-2"></i> Cari
                        </button>
                    </div>
                </div>
            </div>

            <!-- Invoices Table -->
            <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300">
                <div class="p-4 lg:p-6 border-b border-gray-100">
                    <h3 class="text-lg font-semibold">Daftar Tagihan</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Invoice ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pelanggan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jatuh Tempo</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr class="hover:bg-blue-50 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#INV-2025-001</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <div class="flex items-center">
                                        <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center">
                                            <span class="text-xs font-medium">JD</span>
                                        </div>
                                        <div class="ml-3">
                                            <div class="text-sm font-medium text-gray-900">John Doe</div>
                                            <div class="text-xs text-gray-500">john@example.com</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp 15.000.000</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">30 Nov 2025</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Sudah Dibayar
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button class="text-blue-600 hover:text-blue-900 mr-3">View</button>
                                    <button class="text-gray-600 hover:text-gray-900 mr-3">Download</button>
                                    <button class="text-red-600 hover:text-red-900">Delete</button>
                                </td>
                            </tr>
                            <tr class="hover:bg-blue-50 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#INV-2025-002</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <div class="flex items-center">
                                        <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center">
                                            <span class="text-xs font-medium">JS</span>
                                        </div>
                                        <div class="ml-3">
                                            <div class="text-sm font-medium text-gray-900">Jane Smith</div>
                                            <div class="text-xs text-gray-500">jane@example.com</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp 500.000</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">28 Nov 2025</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        Menunggu Pembayaran
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button class="text-blue-600 hover:text-blue-900 mr-3">View</button>
                                    <button class="text-gray-600 hover:text-gray-900 mr-3">Download</button>
                                    <button class="text-indigo-600 hover:text-indigo-900">Send Reminder</button>
                                </td>
                            </tr>
                            <tr class="hover:bg-blue-50 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#INV-2025-003</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <div class="flex items-center">
                                        <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center">
                                            <span class="text-xs font-medium">BJ</span>
                                        </div>
                                        <div class="ml-3">
                                            <div class="text-sm font-medium text-gray-900">Bob Johnson</div>
                                            <div class="text-xs text-gray-500">bob@example.com</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp 1.200.000</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">25 Nov 2025</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        Terlambat
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button class="text-blue-600 hover:text-blue-900 mr-3">View</button>
                                    <button class="text-gray-600 hover:text-gray-900 mr-3">Download</button>
                                    <button class="text-red-600 hover:text-red-900">Delete</button>
                                </td>
                            </tr>
                            <tr class="hover:bg-blue-50 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#INV-2025-004</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <div class="flex items-center">
                                        <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center">
                                            <span class="text-xs font-medium">AM</span>
                                        </div>
                                        <div class="ml-3">
                                            <div class="text-sm font-medium text-gray-900">Alice Martin</div>
                                            <div class="text-xs text-gray-500">alice@example.com</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp 2.500.000</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2 Dec 2025</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        Menunggu Pembayaran
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button class="text-blue-600 hover:text-blue-900 mr-3">View</button>
                                    <button class="text-gray-600 hover:text-gray-900 mr-3">Download</button>
                                    <button class="text-indigo-600 hover:text-indigo-900">Send Reminder</button>
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
                                <span class="font-medium">89</span> hasil
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
</body>
</html>