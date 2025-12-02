<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistik - ADR Catalogue</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .sidebar-gradient {
            background: linear-gradient(135deg, #1e3a8a 0%, #2d3748 100%);
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
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        .chart-container {
            position: relative;
            height: 300px;
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
                    <img src="{{ asset('images/asset/logo.png') }}" alt="ADR Logo" class="w-10 h-10 object-contain mr-3">
                    <div>
                        <h1 class="text-xl font-bold">ADR Catalogue</h1>
                        <p class="text-xs text-gray-400">Admin Panel</p>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 p-4 space-y-2">
                <a href="{{ route('admin') }}" class="nav-item group flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->is('admin') ? 'bg-white/20 text-white' : 'text-gray-300 hover:text-white hover:bg-white/10' }} transition-all duration-300">
                    <i class="fas fa-home w-5 h-5 mr-3"></i>
                    <span>Dashboard</span>
                    <div class="absolute inset-y-0 left-0 w-1 bg-white rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </a>
                
                <a href="{{ route('admin.orders') }}" class="nav-item group flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->is('admin/orders') ? 'bg-white/20 text-white' : 'text-gray-300 hover:text-white hover:bg-white/10' }} transition-all duration-300">
                    <i class="fas fa-shopping-bag w-5 h-5 mr-3"></i>
                    <span>Pesanan</span>
                    <div class="absolute inset-y-0 left-0 w-1 bg-white rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </a>
                
                <a href="{{ route('admin.statistics') }}" class="nav-item group flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->is('admin/statistics') ? 'bg-white/20 text-white' : 'text-gray-300 hover:text-white hover:bg-white/10' }} transition-all duration-300">
                    <i class="fas fa-chart-line w-5 h-5 mr-3"></i>
                    <span>Statistik</span>
                    <div class="absolute inset-y-0 left-0 w-1 bg-white rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </a>
                
                <a href="{{ route('admin.billing') }}" class="nav-item group flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->is('admin/billing') ? 'bg-white/20 text-white' : 'text-gray-300 hover:text-white hover:bg-white/10' }} transition-all duration-300">
                    <i class="fas fa-file-invoice-dollar w-5 h-5 mr-3"></i>
                    <span>Tagihan</span>
                    <div class="absolute inset-y-0 left-0 w-1 bg-white rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </a>
                
                <a href="{{ route('admin.products') }}" class="nav-item group flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->is('admin/products') ? 'bg-white/20 text-white' : 'text-gray-300 hover:text-white hover:bg-white/10' }} transition-all duration-300">
                    <i class="fas fa-box w-5 h-5 mr-3"></i>
                    <span>Produk</span>
                    <div class="absolute inset-y-0 left-0 w-1 bg-white rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </a>

                 <a href="{{ route('admin.chat') }}" class="nav-item group flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->is('admin/chat') ? 'bg-white/20 text-white' : 'text-gray-300 hover:text-white hover:bg-white/10' }} transition-all duration-300">
                    <i class="fas fa-comments w-5 h-5 mr-3"></i>
                    <span>Chat</span>
                    @if($unreadCount > 0)
                        <span class="ml-auto bg-red-500 text-white text-xs rounded-full px-2 py-1">{{ $unreadCount }}</span>
                    @endif
                    <div class="absolute inset-y-0 left-0 w-1 bg-white rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </a>
                
            </nav>

            <!-- User Section -->
            <div class="p-4 border-t border-gray-700">
                <a href="#" class="nav-item group relative flex items-center px-4 py-3 text-sm font-medium rounded-lg text-gray-300 hover:text-white hover:bg-white/10 transition-all duration-300">
                    <i class="fas fa-user w-5 h-5 mr-3"></i>
                    <span class="flex-1 truncate">{{ $admin->nama ?? 'Admin User' }}</span>
                    <div class="absolute left-0 top-0 bottom-0 w-1 bg-white rounded-full opacity-0 group-hover:opacity-100 transition-all duration-300 transform scale-y-0 group-hover:scale-y-100"></div>
                </a>
            </div>

            <!-- Logout Button -->
            <div class="p-4 border-t border-gray-700">
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="nav-item group relative w-full flex items-center px-4 py-3 text-sm font-medium rounded-lg text-gray-300 hover:text-white hover:bg-white/10 transition-all duration-300">
                        <i class="fas fa-sign-out-alt w-5 h-5 mr-3"></i>
                        <span>Logout</span>
                        <div class="absolute left-0 top-0 bottom-0 w-1 bg-white rounded-full opacity-0 group-hover:opacity-100 transition-all duration-300 transform scale-y-0 group-hover:scale-y-100"></div>
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
                        <h1 class="text-2xl font-semibold text-gray-800">Statistik Penjualan</h1>
                        <p class="text-sm text-gray-600">Analisis lengkap performa bisnis Anda</p>
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
                <!-- Period Selector -->
                <div class="card-hover bg-white rounded-xl shadow-lg p-6 mb-8 slide-in" style="animation-delay: 0.1s">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">Pilih Periode</h3>
                            <p class="text-sm text-gray-600">Analisis data untuk periode tertentu</p>
                        </div>
                        <div class="mt-4 md:mt-0 flex flex-col sm:flex-row gap-4">
                            <select class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="7">7 Hari Terakhir</option>
                                <option value="30" selected>30 Hari Terakhir</option>
                                <option value="90">3 Bulan Terakhir</option>
                                <option value="365">1 Tahun Terakhir</option>
                                <option value="custom">Custom Range</option>
                            </select>
                            <div class="flex gap-2">
                                <input type="date" class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <input type="date" class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md transition-colors">
                                <i class="fas fa-filter mr-2"></i> Filter
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <!-- Total Sales Card -->
                    <div class="card-hover bg-white rounded-xl shadow-lg p-6 slide-in" style="animation-delay: 0.2s">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Total Penjualan</p>
                                <p class="text-3xl font-bold text-gray-900">Rp 45.6M</p>
                                <p class="text-xs text-green-600 flex items-center mt-1">
                                    <i class="fas fa-arrow-up mr-1"></i>
                                    <span>+23% dari bulan lalu</span>
                                </p>
                            </div>
                            <div class="p-3 bg-green-500 rounded-full">
                                <i class="fas fa-chart-line text-white text-xl"></i>
                            </div>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-100">
                            <div class="flex items-center text-sm">
                                <i class="fas fa-arrow-up text-green-500 mr-2"></i>
                                <span class="text-green-600 font-medium">+15% dari bulan lalu</span>
                            </div>
                        </div>
                    </div>

                    <!-- Total Orders Card -->
                    <div class="card-hover bg-white rounded-xl shadow-lg p-6 slide-in" style="animation-delay: 0.3s">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Total Pesanan</p>
                                <p class="text-3xl font-bold text-gray-900">1,234</p>
                                <p class="text-xs text-green-600 flex items-center mt-1">
                                    <i class="fas fa-arrow-up mr-1"></i>
                                    <span>+15% dari bulan lalu</span>
                                </p>
                            </div>
                            <div class="p-3 bg-blue-500 rounded-full">
                                <i class="fas fa-shopping-bag text-white text-xl"></i>
                            </div>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-100">
                            <div class="flex items-center text-sm">
                                <i class="fas fa-arrow-up text-green-500 mr-2"></i>
                                <span class="text-green-600 font-medium">+8% dari bulan lalu</span>
                            </div>
                        </div>
                    </div>

                    <!-- Average Order Value Card -->
                    <div class="card-hover bg-white rounded-xl shadow-lg p-6 slide-in" style="animation-delay: 0.4s">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Rata-rata Nilai Pesanan</p>
                                <p class="text-3xl font-bold text-gray-900">Rp 850K</p>
                                <p class="text-xs text-red-600 flex items-center mt-1">
                                    <i class="fas fa-arrow-down mr-1"></i>
                                    <span>-5% dari bulan lalu</span>
                                </p>
                            </div>
                            <div class="p-3 bg-purple-500 rounded-full">
                                <i class="fas fa-calculator text-white text-xl"></i>
                            </div>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-100">
                            <div class="flex items-center text-sm">
                                <i class="fas fa-arrow-up text-green-500 mr-2"></i>
                                <span class="text-green-600 font-medium">+0.8% dari bulan lalu</span>
                            </div>
                        </div>
                    </div>

                    <!-- Conversion Rate Card -->
                    <div class="card-hover bg-white rounded-xl shadow-lg p-6 slide-in" style="animation-delay: 0.5s">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Tingkat Konversi</p>
                                <p class="text-3xl font-bold text-gray-900">3.2%</p>
                                <p class="text-xs text-green-600 flex items-center mt-1">
                                    <i class="fas fa-arrow-up mr-1"></i>
                                    <span>+0.8% dari bulan lalu</span>
                                </p>
                            </div>
                            <div class="p-3 bg-orange-500 rounded-full">
                                <i class="fas fa-percentage text-white text-xl"></i>
                            </div>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-100">
                            <div class="flex items-center text-sm">
                                <i class="fas fa-arrow-up text-green-500 mr-2"></i>
                                <span class="text-green-600 font-medium">+0.8% dari bulan lalu</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Charts Row -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                    <!-- Sales Chart -->
                    <div class="card-hover bg-white rounded-xl shadow-lg p-6 slide-in" style="animation-delay: 0.6s">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-800">Tren Penjualan</h3>
                            <div class="flex items-center space-x-2">
                                <button class="text-sm text-gray-600 hover:text-gray-800">Harian</button>
                                <button class="text-sm text-blue-600 font-medium">Mingguan</button>
                                <button class="text-sm text-gray-600 hover:text-gray-800">Bulanan</button>
                            </div>
                        </div>
                        <div class="chart-container">
                            <canvas id="salesChart"></canvas>
                        </div>
                    </div>

                    <!-- Revenue Chart -->
                    <div class="card-hover bg-white rounded-xl shadow-lg p-6 slide-in" style="animation-delay: 0.7s">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-800">Grafik Pendapatan</h3>
                            <div class="flex items-center space-x-2">
                                <button class="text-sm text-blue-600 font-medium">Mingguan</button>
                                <button class="text-sm text-gray-600 hover:text-gray-800">Bulanan</button>
                                <button class="text-sm text-gray-600 hover:text-gray-800">Tahunan</button>
                            </div>
                        </div>
                        <div class="chart-container">
                            <canvas id="revenueChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Top Products Table -->
                <div class="card-hover bg-white rounded-xl shadow-lg overflow-hidden slide-in" style="animation-delay: 0.8s">
                    <div class="px-6 py-4 border-b border-gray-100">
                        <h3 class="text-lg font-semibold text-gray-800">Grafik Produk Terlaris</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produk</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Terjual</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pendapatan</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr class="hover:bg-blue-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="h-10 w-10 rounded-md bg-gray-200 flex items-center justify-center">
                                                <i class="fas fa-laptop text-gray-600"></i>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">Laptop ASUS ROG</div>
                                                <div class="text-xs text-gray-500">SKU: LAP-001</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Electronics</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">234</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp 23.4M</td>
                                </tr>
                                <tr class="hover:bg-blue-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="h-10 w-10 rounded-md bg-gray-200 flex items-center justify-center">
                                                <i class="fas fa-mouse text-gray-600"></i>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">Mouse Gaming Logitech</div>
                                                <div class="text-xs text-gray-500">SKU: MOU-002</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Accessories</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">456</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp 9.1M</td>
                                </tr>
                                <tr class="hover:bg-blue-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="h-10 w-10 rounded-md bg-gray-200 flex items-center justify-center">
                                                <i class="fas fa-keyboard text-gray-600"></i>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">Keyboard Mechanical</div>
                                                <div class="text-xs text-gray-500">SKU: KEY-003</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Accessories</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">189</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp 5.7M</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Sales Chart
        const salesCtx = document.getElementById('salesChart').getContext('2d');
        if (salesCtx) {
            new Chart(salesCtx, {
                type: 'line',
                data: {
                    labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
                    datasets: [{
                        label: 'Penjualan',
                        data: [12, 19, 15, 25, 22, 30, 28],
                        borderColor: 'rgb(59, 130, 246)',
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        // Products Chart
        const productsCtx = document.getElementById('productsChart');
        if (productsCtx) {
            new Chart(productsCtx, {
                type: 'bar',
                data: {
                    labels: ['Laptop ASUS ROG', 'Mouse Gaming', 'Keyboard Mechanical'],
                    datasets: [{
                        label: 'Terjual',
                        data: [234, 456, 189],
                        backgroundColor: 'rgba(59, 130, 246, 0.8)'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
    </script>
</body>
</html>