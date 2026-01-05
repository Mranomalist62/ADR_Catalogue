<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Tagihan - ADR Catalogue</title>
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
        <div class="flex-1 overflow-auto bg-gray-50">
            <!-- Top Header -->
            <div class="bg-white shadow-sm border-b border-gray-200">
                <div class="px-6 py-4 flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">Manajemen Tagihan</h1>
                        <p class="text-sm text-gray-600">Kelola semua tagihan dan invoice pelanggan</p>
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
                    <!-- Total Invoices Card -->
                    <div class="card-hover bg-white rounded-xl shadow-lg p-6 slide-in" style="animation-delay: 0.1s">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Total Tagihan</p>
                                <p class="text-3xl font-bold text-gray-900">89</p>
                                <p class="text-xs text-gray-500">Bulan ini</p>
                            </div>
                            <div class="p-3 bg-blue-500 rounded-full">
                                <i class="fas fa-file-invoice text-white text-xl"></i>
                            </div>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-100">
                            <div class="flex items-center text-sm">
                                <i class="fas fa-arrow-up text-green-500 mr-2"></i>
                                <span class="text-green-600 font-medium">+15% dari bulan lalu</span>
                            </div>
                        </div>
                    </div>

                    <!-- Paid Invoices Card -->
                    <div class="card-hover bg-white rounded-xl shadow-lg p-6 slide-in" style="animation-delay: 0.2s">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Sudah Dibayar</p>
                                <p class="text-3xl font-bold text-gray-900">67</p>
                                <p class="text-xs text-green-600">75.3%</p>
                            </div>
                            <div class="p-3 bg-green-500 rounded-full">
                                <i class="fas fa-check-circle text-white text-xl"></i>
                            </div>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-100">
                            <div class="flex items-center text-sm">
                                <i class="fas fa-arrow-up text-green-500 mr-2"></i>
                                <span class="text-green-600 font-medium">+8% dari bulan lalu</span>
                            </div>
                        </div>
                    </div>

                    <!-- Pending Invoices Card -->
                    <div class="card-hover bg-white rounded-xl shadow-lg p-6 slide-in" style="animation-delay: 0.3s">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Menunggu Pembayaran</p>
                                <p class="text-3xl font-bold text-gray-900">15</p>
                                <p class="text-xs text-yellow-600">16.9%</p>
                            </div>
                            <div class="p-3 bg-yellow-500 rounded-full">
                                <i class="fas fa-clock text-white text-xl"></i>
                            </div>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-100">
                            <div class="flex items-center text-sm">
                                <i class="fas fa-arrow-down text-red-500 mr-2"></i>
                                <span class="text-red-600 font-medium">-2% dari bulan lalu</span>
                            </div>
                        </div>
                    </div>

                    <!-- Overdue Invoices Card -->
                    <div class="card-hover bg-white rounded-xl shadow-lg p-6 slide-in" style="animation-delay: 0.4s">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Terlambat</p>
                                <p class="text-3xl font-bold text-gray-900">7</p>
                                <p class="text-xs text-red-600">7.9%</p>
                            </div>
                            <div class="p-3 bg-red-500 rounded-full status-badge">
                                <i class="fas fa-exclamation-triangle text-white text-xl"></i>
                            </div>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-100">
                            <div class="flex items-center text-sm">
                                <i class="fas fa-arrow-up text-green-500 mr-2"></i>
                                <span class="text-green-600 font-medium">+3% dari bulan lalu</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Revenue Chart Section -->
                <div class="grid grid-cols-1 lg:grid-cols-1 gap-6 mb-8">

                </div>

                <!-- Filters Section -->
                <div class="card-hover bg-white rounded-xl shadow-lg p-6 mb-8 slide-in" style="animation-delay: 0.7s">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Filter Tagihan</h3>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                            <div class="relative">
                                <input type="text" 
                                       placeholder="Cari invoice..." 
                                       class="w-full px-3 py-2 pl-10 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-search text-gray-400"></i>
                                </div>
                            </div>
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
                            <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md transition-colors">
                                <i class="fas fa-search mr-2"></i> Cari
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Invoices Table -->
                <div class="card-hover bg-white rounded-xl shadow-lg overflow-hidden slide-in" style="animation-delay: 0.8s">
                    <div class="px-6 py-4 border-b border-gray-100">
                        <h3 class="text-lg font-semibold text-gray-800">Daftar Tagihan</h3>
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
                                        <button class="text-blue-600 hover:text-blue-900 mr-2">View</button>
                                        <button class="text-gray-600 hover:text-gray-900 mr-2">Download</button>
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
                                        <button class="text-blue-600 hover:text-blue-900 mr-2">View</button>
                                        <button class="text-gray-600 hover:text-gray-900 mr-2">Download</button>
                                        <button class="text-indigo-600 hover:text-indigo-900 mr-2">Send Reminder</button>
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
                                        <button class="text-blue-600 hover:text-blue-900 mr-2">View</button>
                                        <button class="text-gray-600 hover:text-gray-900 mr-2">Download</button>
                                        <button class="text-red-600 hover:text-red-900">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="bg-white px-6 py-3 flex items-center justify-between border-t border-gray-100">
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
                                    <button class="relative inline-flex items-center px-4 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                                        Next
                                    </button>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Chart.js configuration
        Chart.defaults.font.family = 'Poppins';
        Chart.defaults.color = '#6b7280';
        
        document.addEventListener('DOMContentLoaded', function() {
            // Revenue Chart
            const revenueCtx = document.getElementById('revenueChart');
            if (revenueCtx) {
                new Chart(revenueCtx, {
                    type: 'line',
                    data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                        datasets: [{
                            label: 'Pendapatan (Rp)',
                            data: [35000000, 42000000, 38000000, 45000000, 52000000, 48000000],
                            borderColor: 'rgb(59, 130, 246)',
                            backgroundColor: 'rgba(59, 130, 246, 0.1)',
                            borderWidth: 2,
                            tension: 0.4,
                            fill: true
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
                                beginAtZero: true,
                                grid: {
                                    display: true,
                                    color: 'rgba(0, 0, 0, 0.05)'
                                },
                                ticks: {
                                    callback: function(value) {
                                        return 'Rp ' + (value/1000000).toFixed(1) + 'M';
                                    }
                                }
                            },
                            x: {
                                grid: {
                                    display: false
                                }
                            }
                        }
                    }
                });
            }

        });
    </script>
</body>
</html>