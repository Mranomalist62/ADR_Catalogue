<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - ADR Catalogue</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

        .stat-card {
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-2px) scale(1.02);
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

                {{-- <a href="{{ route('admin.statistics') }}"
                    class="nav-item group flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->is('admin/statistics') ? 'bg-white/20 text-white' : 'text-gray-300 hover:text-white hover:bg-white/10' }} transition-all duration-300">
                    <i class="fas fa-chart-line w-5 h-5 mr-3"></i>
                    <span>Statistik</span>
                    <div
                        class="absolute inset-y-0 left-0 w-1 bg-white rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    </div>
                </a> --}}

                {{-- <a href="{{ route('admin.billing') }}"
                    class="nav-item group flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->is('admin/billing') ? 'bg-white/20 text-white' : 'text-gray-300 hover:text-white hover:bg-white/10' }} transition-all duration-300">
                    <i class="fas fa-file-invoice-dollar w-5 h-5 mr-3"></i>
                    <span>Tagihan</span>
                    <div
                        class="absolute inset-y-0 left-0 w-1 bg-white rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    </div>
                </a> --}}

                <a href="{{ route('admin.products') }}"
                    class="nav-item group flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->is('admin/products') ? 'bg-white/20 text-white' : 'text-gray-300 hover:text-white hover:bg-white/10' }} transition-all duration-300">
                    <i class="fas fa-box w-5 h-5 mr-3"></i>
                    <span>Produk</span>
                    <div
                        class="absolute inset-y-0 left-0 w-1 bg-white rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    </div>
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
                        <h2 class="text-2xl font-semibold text-gray-800">Dashboard Overview</h2>
                        <p class="text-sm text-gray-600">Selamat datang kembali, Admin!</p>
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
                    <!-- Total Users Card -->
                    <div class="stat-card bg-white rounded-xl shadow-lg p-6 slide-in" style="animation-delay: 0.1s">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Total Users</p>
                                <p class="text-3xl font-bold text-gray-900">{{ number_format($totalUsers) }}</p>
                            </div>
                            <div class="p-3 bg-blue-500 rounded-full">
                                <i class="fas fa-users text-white text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Total Orders Card -->
                    <div class="stat-card bg-white rounded-xl shadow-lg p-6 slide-in" style="animation-delay: 0.2s">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Total Orders</p>
                                <p class="text-3xl font-bold text-gray-900">{{ number_format($totalOrders) }}</p>
                            </div>
                            <div class="p-3 bg-green-500 rounded-full">
                                <i class="fas fa-shopping-bag text-white text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Products Card -->
                    <div class="stat-card bg-white rounded-xl shadow-lg p-6 slide-in" style="animation-delay: 0.3s">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Total Products</p>
                                <p class="text-3xl font-bold text-gray-900">{{ number_format($totalProducts) }}</p>
                            </div>
                            <div class="p-3 bg-yellow-500 rounded-full">
                                <i class="fas fa-box text-white text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Revenue Card -->
                    <div class="stat-card bg-white rounded-xl shadow-lg p-6 slide-in" style="animation-delay: 0.4s">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Total Revenue</p>
                                <p class="text-3xl font-bold text-gray-900">
                                    Rp {{ number_format($totalRevenue, 0, ',', '.') }}
                                </p>
                            </div>
                            <div class="p-3 bg-purple-500 rounded-full">
                                <i class="fas fa-dollar-sign text-white text-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Charts Section -->
                <div class="grid grid-cols-1 xl:grid-cols-2 gap-6 mb-8">
                    <!-- Sales Chart -->
                    <div class="bg-white rounded-xl shadow-lg p-6 slide-in" style="animation-delay: 0.5s">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-800">Sales Overview</h3>
                            <select id="salesRange"
                                class="px-3 py-1 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="this_week" {{ $salesRange === 'this_week' ? 'selected' : '' }}>
                                    This Week
                                </option>

                                <option value="last_week" {{ $salesRange === 'last_week' ? 'selected' : '' }}>
                                    Last Week
                                </option>

                                <option value="this_month" {{ $salesRange === 'this_month' ? 'selected' : '' }}>
                                    This Month
                                </option>

                                <option value="last_month" {{ $salesRange === 'last_month' ? 'selected' : '' }}>
                                    Last Month
                                </option>
                            </select>
                        </div>
                        <div class="chart-container" style="height:300px">
                            <canvas id="salesChart" class="w-full h-full"></canvas>
                        </div>
                    </div>

                    <!-- Revenue Chart -->
                    <div class="bg-white rounded-xl shadow-lg p-6 slide-in" style="animation-delay: 0.6s">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-800">Revenue Trends</h3>
                            <div class="flex space-x-2">
                                <select id="revenueRange" class="px-3 py-1 border border-gray-300 rounded-md text-sm
                                        focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="this_week" {{ $revenueRange === 'this_week' ? 'selected' : '' }}>
                                        This Week
                                    </option>

                                    <option value="last_week" {{ $revenueRange === 'last_week' ? 'selected' : '' }}>
                                        Last Week
                                    </option>

                                    <option value="this_month" {{ $revenueRange === 'this_month' ? 'selected' : '' }}>
                                        This Month
                                    </option>

                                    <option value="last_month" {{ $revenueRange === 'last_month' ? 'selected' : '' }}>
                                        Last Month
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="chart-container">
                            <canvas id="revenueChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Recent Orders Table -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden slide-in" style="animation-delay: 0.7s">
                    <div class="px-6 py-4 border-b border-gray-100">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-800">Recent Orders</h3>
                            <a href="{{ route('admin.orders') }}"
                                class="text-sm text-blue-600 hover:text-blue-800 font-medium transition-colors">
                                View All
                                <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Order ID</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Customer</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Product</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Amount</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($recentOrders as $order)
                                    <tr class="hover:bg-gray-50 transition-colors">

                                        {{-- Order ID --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            #{{ $order->id }}
                                        </td>

                                        {{-- Customer --}}
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div
                                                    class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center">
                                                    <span class="text-xs font-medium">
                                                        {{ strtoupper(substr($order->user->name, 0, 2)) }}
                                                    </span>
                                                </div>
                                                <div class="ml-3">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ $order->user->name }}
                                                    </div>
                                                    <div class="text-xs text-gray-500">
                                                        {{ $order->user->email }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        {{-- Product --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $order->nama_produk ?? optional($order->product)->nama ?? '-' }}
                                        </td>

                                        {{-- Amount --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            Rp {{ number_format($order->total_harga, 0, ',', '.') }}
                                        </td>

                                        {{-- Status (USE ACCESSOR) --}}
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                    {{ $order->status_badge['color'] }}">
                                                {{ $order->status_badge['label'] }}
                                            </span>
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-8 text-center text-sm text-gray-500">
                                            No orders in the last week
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Chart.js configuration
        Chart.defaults.font.family = 'Poppins';
        Chart.defaults.color = '#6b7280';
        const salesData = @json($salesChart);
        const revenueData = @json($revenueChart);

        const hasSalesData = salesData.some(v => v > 0);
        const hasRevenueData = revenueData.some(v => v > 0);



        document.addEventListener('DOMContentLoaded', function () {


            document.getElementById('salesRange')
                ?.addEventListener('change', function () {
                    const url = new URL(window.location.href);
                    url.searchParams.set('SalesRange', this.value);
                    window.location.href = url.toString();
                });

            document.getElementById('revenueRange')
                ?.addEventListener('change', function () {
                    const url = new URL(window.location.href);
                    url.searchParams.set('RevenueRange', this.value);
                    window.location.href = url.toString();
                });

            // Sales Chart
            const salesCtx = document.getElementById('salesChart');

            if (salesCtx) {
                new Chart(salesCtx, {
                    type: 'line',
                    data: {
                        labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                        datasets: [{
                            label: 'Orders',
                            data: hasSalesData ? salesData : [],
                            borderWidth: 2,
                            tension: 0.4,
                            fill: true
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false },
                            tooltip: { enabled: hasSalesData }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: { precision: 0 }
                            },
                            x: { grid: { display: false } }
                        }
                    }
                });
            }

            // Revenue Chart
            const revenueCtx = document.getElementById('revenueChart');
            if (revenueCtx) {
                new Chart(revenueCtx, {
                    type: 'bar',
                    data: {
                        labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                        datasets: [{
                            label: 'Revenue',
                            data: hasRevenueData ? revenueData : [],
                            borderWidth: 1,
                            borderRadius: 4
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false },
                            tooltip: { enabled: hasRevenueData }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: v => 'Rp ' + (v / 1_000_000).toFixed(0) + 'M'
                                }
                            },
                            x: { grid: { display: false } }
                        }
                    }
                });
            }
        });
    </script>
</body>

</html>
