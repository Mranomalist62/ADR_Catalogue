<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistik Penjualan - ADR Catalogue</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                <h2 class="text-3xl font-bold text-gray-800">Statistik Penjualan</h2>
                <p class="text-gray-600">Analisis data penjualan dan pendapatan</p>
            </div>

            <!-- Period Filter -->
            <div class="bg-white p-4 lg:p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 mb-4 lg:mb-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Periode</label>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="today">Hari Ini</option>
                            <option value="week" selected>Minggu Ini</option>
                            <option value="month">Bulan Ini</option>
                            <option value="year">Tahun Ini</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Dari Tanggal</label>
                        <input type="date" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Sampai Tanggal</label>
                        <input type="date" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
                <div class="mt-4">
                    <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md transition-colors duration-200">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                        </svg> Filter
                    </button>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6 mb-6 lg:mb-8">
                <div class="bg-white p-4 lg:p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="flex items-center">
                        <div class="p-3 bg-blue-500 rounded-full">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-600">Total Pesanan</p>
                            <p class="text-2xl font-bold">156</p>
                            <p class="text-xs text-green-600">+12% dari bulan lalu</p>
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
                            <p class="text-sm text-gray-600">Selesai</p>
                            <p class="text-2xl font-bold">142</p>
                            <p class="text-xs text-green-600">+8% dari bulan lalu</p>
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
                            <p class="text-sm text-gray-600">Pending</p>
                            <p class="text-2xl font-bold">14</p>
                            <p class="text-xs text-red-600">+2 dari bulan lalu</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-4 lg:p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="flex items-center">
                        <div class="p-3 bg-purple-500 rounded-full">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-600">Total Pendapatan</p>
                            <p class="text-2xl font-bold">Rp 45.6M</p>
                            <p class="text-xs text-green-600">+23% dari bulan lalu</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts -->
            <div class="grid grid-cols-1 xl:grid-cols-2 gap-4 lg:gap-6 mb-6 lg:mb-8">
                <!-- Sales Chart -->
                <div class="bg-white p-4 lg:p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300">
                    <h3 class="text-lg font-semibold mb-4">Grafik Penjualan</h3>
                    <div class="relative h-64"> <!-- tinggi fix di sini -->
                        <canvas id="salesChart"></canvas>
                    </div>   
                </div>

                <!-- Revenue Chart -->
                <div class="bg-white p-4 lg:p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300">
                    <h3 class="text-lg font-semibold mb-4">Grafik Pendapatan</h3>
                    <div class="relative h-64">
                        <canvas id="revenueChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Top Products -->
            <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300">
                <div class="p-4 lg:p-6 border-b border-gray-100">
                    <h3 class="text-lg font-semibold">Produk Terlaris</h3>
                </div>
                <div class="p-4 lg:p-6">
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Produk</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Terjual</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pendapatan</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr class="hover:bg-blue-50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Laptop ASUS ROG</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Elektronik</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">45</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp 67.500.000</td>
                                </tr>
                                <tr class="hover:bg-blue-50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Mouse Gaming Logitech</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Aksesoris</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">38</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp 19.000.000</td>
                                </tr>
                                <tr class="hover:bg-blue-50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Keyboard Mechanical</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Aksesoris</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">32</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp 38.400.000</td>
                                </tr>
                                <tr class="hover:bg-blue-50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Monitor LG 27"</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Elektronik</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">28</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp 42.000.000</td>
                                </tr>
                                <tr class="hover:bg-blue-50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Headset Gaming</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Aksesoris</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">25</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp 12.500.000</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Disable Chart.js animations globally
        Chart.defaults.animation.duration = 0;
        Chart.defaults.animation.easing = 'linear';
        Chart.defaults.animation.loop = false;
        
        // Wait for DOM to be fully loaded
        document.addEventListener('DOMContentLoaded', function() {
            // Sales Chart - Completely Static
            const salesCtx = document.getElementById('salesChart');
            if (salesCtx) {
                new Chart(salesCtx.getContext('2d'), {
                    type: 'line',
                    data: {
                        labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
                        datasets: [{
                            label: 'Jumlah Pesanan',
                            data: [12, 19, 15, 25, 22, 30, 18],
                            borderColor: 'rgb(59, 130, 246)',
                            backgroundColor: 'rgba(59, 130, 246, 0.1)',
                            borderWidth: 2,
                            tension: 0.1,
                            fill: true,
                            pointBackgroundColor: 'rgb(59, 130, 246)',
                            pointBorderColor: '#fff',
                            pointBorderWidth: 1,
                            pointRadius: 4,
                            pointHoverRadius: 6
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        animation: false,
                        hover: {
                            animationDuration: 0
                        },
                        plugins: {
                            legend: {
                                display: true,
                                position: 'top',
                                labels: {
                                    usePointStyle: true,
                                    padding: 20,
                                    font: {
                                        size: 12,
                                        family: 'system-ui'
                                    }
                                }
                            },
                            tooltip: {
                                backgroundColor: 'rgba(0, 0, 0, 0.8)',
                                titleColor: '#fff',
                                bodyColor: '#fff',
                                padding: 12,
                                displayColors: false,
                                callbacks: {
                                    label: function(context) {
                                        return 'Pesanan: ' + context.parsed.y + ' unit';
                                    }
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: {
                                    display: true,
                                    color: 'rgba(0, 0, 0, 0.05)',
                                    drawBorder: false
                                },
                                ticks: {
                                    padding: 10,
                                    font: {
                                        size: 11
                                    }
                                }
                            },
                            x: {
                                grid: {
                                    display: false,
                                    drawBorder: false
                                },
                                ticks: {
                                    padding: 10,
                                    font: {
                                        size: 11
                                    }
                                }
                            }
                        }
                    }
                });
            }

            // Revenue Chart - Completely Static
            const revenueCtx = document.getElementById('revenueChart');
            if (revenueCtx) {
                new Chart(revenueCtx.getContext('2d'), {
                    type: 'bar',
                    data: {
                        labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
                        datasets: [{
                            label: 'Pendapatan (Rp)',
                            data: [5200000, 8300000, 6500000, 10500000, 9200000, 12500000, 7500000],
                            backgroundColor: 'rgba(34, 197, 94, 0.8)',
                            borderColor: 'rgb(34, 197, 94)',
                            borderWidth: 1,
                            borderRadius: 4,
                            borderSkipped: false,
                            hoverBackgroundColor: 'rgb(34, 197, 94)'
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        animation: false,
                        hover: {
                            animationDuration: 0
                        },
                        plugins: {
                            legend: {
                                display: true,
                                position: 'top',
                                labels: {
                                    usePointStyle: true,
                                    padding: 20,
                                    font: {
                                        size: 12,
                                        family: 'system-ui'
                                    }
                                }
                            },
                            tooltip: {
                                backgroundColor: 'rgba(0, 0, 0, 0.8)',
                                titleColor: '#fff',
                                bodyColor: '#fff',
                                padding: 12,
                                displayColors: false,
                                callbacks: {
                                    label: function(context) {
                                        return 'Pendapatan: Rp ' + (context.parsed.y/1000000).toFixed(2) + 'M';
                                    }
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: {
                                    display: true,
                                    color: 'rgba(0, 0, 0, 0.05)',
                                    drawBorder: false
                                },
                                ticks: {
                                    padding: 10,
                                    font: {
                                        size: 11
                                    },
                                    callback: function(value) {
                                        return 'Rp ' + (value/1000000).toFixed(1) + 'M';
                                    }
                                }
                            },
                            x: {
                                grid: {
                                    display: false,
                                    drawBorder: false
                                },
                                ticks: {
                                    padding: 10,
                                    font: {
                                        size: 11
                                    }
                                }
                            }
                        }
                    }
                });
            }

            // Simple filter functionality without chart updates
            const filterButton = document.querySelector('button');
            if (filterButton) {
                filterButton.addEventListener('click', function() {
                    // Just show alert for now - no chart updates to prevent animation issues
                    const periodSelect = document.querySelector('select');
                    const period = periodSelect ? periodSelect.value : 'week';
                    console.log('Filter clicked for period:', period);
                });
            }
        });
    </script>
</body>
</html>