<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - ADR Catalogue</title>
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
                <h2 class="text-3xl font-bold text-gray-800">Dashboard Admin</h2>
                <p class="text-gray-600">Selamat datang di dashboard admin ADR Catalogue</p>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6 mb-6 lg:mb-8">
                <div class="bg-white p-4 lg:p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="flex items-center">
                        <div class="p-3 bg-blue-500 rounded-full">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-600">Total Users</p>
                            <p class="text-2xl font-bold">1,234</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-4 lg:p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="flex items-center">
                        <div class="p-3 bg-green-500 rounded-full">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-600">Total Orders</p>
                            <p class="text-2xl font-bold">456</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-4 lg:p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="flex items-center">
                        <div class="p-3 bg-yellow-500 rounded-full">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-600">Products</p>
                            <p class="text-2xl font-bold">89</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-4 lg:p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="flex items-center">
                        <div class="p-3 bg-purple-500 rounded-full">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-600">Revenue</p>
                            <p class="text-2xl font-bold">Rp 45.6M</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Orders Table -->
            <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300">
                <div class="p-4 lg:p-6 border-b border-gray-100">
                    <h3 class="text-lg font-semibold">Recent Orders</h3>
                </div>
                <div class="p-4 lg:p-6">
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead>
                                <tr class="border-b">
                                    <th class="text-left py-2">Order ID</th>
                                    <th class="text-left py-2">Customer</th>
                                    <th class="text-left py-2">Product</th>
                                    <th class="text-left py-2">Amount</th>
                                    <th class="text-left py-2">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-b border-gray-100 hover:bg-blue-50 transition-colors duration-200">
                                    <td class="py-2">#12345</td>
                                    <td class="py-2">John Doe</td>
                                    <td class="py-2">Laptop ASUS</td>
                                    <td class="py-2">Rp 15.000.000</td>
                                    <td class="py-2"><span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-sm">Completed</span></td>
                                </tr>
                                <tr class="border-b border-gray-100 hover:bg-blue-50 transition-colors duration-200">
                                    <td class="py-2">#12346</td>
                                    <td class="py-2">Jane Smith</td>
                                    <td class="py-2">Mouse Gaming</td>
                                    <td class="py-2">Rp 500.000</td>
                                    <td class="py-2"><span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm">Processing</span></td>
                                </tr>
                                <tr class="border-b border-gray-100 hover:bg-blue-50 transition-colors duration-200">
                                    <td class="py-2">#12347</td>
                                    <td class="py-2">Bob Johnson</td>
                                    <td class="py-2">Keyboard Mechanical</td>
                                    <td class="py-2">Rp 1.200.000</td>
                                    <td class="py-2"><span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">Pending</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>