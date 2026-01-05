<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pesanan - ADR Catalogue</title>
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
                        <h1 class="text-2xl font-semibold text-gray-800">Manajemen Pesanan</h1>
                        <p class="text-sm text-gray-600">Kelola semua pesanan pelanggan</p>
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
                    <!-- Total Orders Card -->
                    <div class="card-hover bg-white rounded-xl shadow-lg p-6 slide-in" style="animation-delay: 0.1s">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Total Pesanan</p>
                                <p class="text-3xl font-bold text-gray-900">{{ $totalOrders }}</p>
                                <p class="text-xs text-green-600 flex items-center mt-1">
                                    <i class="fas fa-chart-line mr-1"></i>
                                    <span>Semua pesanan</span>
                                </p>
                            </div>
                            <div class="p-3 bg-blue-500 rounded-full">
                                <i class="fas fa-shopping-bag text-white text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Pending Orders Card -->
                    <div class="card-hover bg-white rounded-xl shadow-lg p-6 slide-in" style="animation-delay: 0.2s">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Pesanan Tertunda</p>
                                <p class="text-3xl font-bold text-gray-900">{{ $pendingOrders }}</p>
                                <p class="text-xs text-yellow-600 flex items-center mt-1">
                                    <i class="fas fa-clock mr-1"></i>
                                    <span>Perlu diproses</span>
                                </p>
                            </div>
                            <div class="p-3 bg-yellow-500 rounded-full">
                                <i class="fas fa-hourglass-half text-white text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Completed Orders Card -->
                    <div class="card-hover bg-white rounded-xl shadow-lg p-6 slide-in" style="animation-delay: 0.3s">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Pesanan Selesai</p>
                                <p class="text-3xl font-bold text-gray-900">{{ $completedOrders }}</p>
                                <p class="text-xs text-green-600 flex items-center mt-1">
                                    @php
                                        $completionRate = $totalOrders > 0 ? round(($completedOrders / $totalOrders) * 100, 1) : 0;
                                    @endphp
                                    <i class="fas fa-check-circle mr-1"></i>
                                    <span>{{ $completionRate }}% completion rate</span>
                                </p>
                            </div>
                            <div class="p-3 bg-green-500 rounded-full">
                                <i class="fas fa-check-circle text-white text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Revenue Card -->
                    <div class="card-hover bg-white rounded-xl shadow-lg p-6 slide-in" style="animation-delay: 0.4s">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Total Revenue</p>
                                <p class="text-3xl font-bold text-gray-900">Rp
                                    {{ number_format($totalRevenue, 0, ',', '.') }}
                                </p>
                                <p class="text-xs text-green-600 flex items-center mt-1">
                                    <i class="fas fa-money-bill-wave mr-1"></i>
                                    <span>Pendapatan bersih</span>
                                </p>
                            </div>
                            <div class="p-3 bg-purple-500 rounded-full">
                                <i class="fas fa-dollar-sign text-white text-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Filters Section -->
                <div class="card-hover bg-white rounded-xl shadow-lg p-6 mb-8 slide-in" style="animation-delay: 0.5s">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Filter Pesanan</h3>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                            <div class="relative">
                                <input type="text" placeholder="Cari pesanan..."
                                    class="w-full px-3 py-2 pl-10 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-search text-gray-400"></i>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                            <select
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Semua Status</option>
                                <option value="pending">Pending</option>
                                <option value="processing">Processing</option>
                                <option value="completed">Completed</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal</label>
                            <input type="date"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div class="flex items-end">
                            <button
                                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md transition-colors">
                                <i class="fas fa-search mr-2"></i> Cari
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Orders Table -->
                <div class="card-hover bg-white rounded-xl shadow-lg overflow-hidden slide-in"
                    style="animation-delay: 0.6s">
                    <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-800">Daftar Pesanan Terbaru</h3>
                    </div>
                    <div class="overflow-x-auto">
                        @if($orders->count() > 0)
                            <table class="min-w-full">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            <input type="checkbox" class="rounded border-gray-300" id="select-all">
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            ID Pesanan</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Pelanggan</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Produk</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Total</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Status</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Tanggal</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($orders as $order)
                                        <tr class="hover:bg-blue-50 transition-colors">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                <input type="checkbox" class="row-checkbox rounded border-gray-300"
                                                    value="{{ $order->id }}">
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                #{{ $order->id }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div
                                                        class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center">
                                                        <span class="text-xs font-medium">
                                                            {{ substr($order->user->nama ?? 'N', 0, 1) }}
                                                        </span>
                                                    </div>
                                                    <div class="ml-3">
                                                        <div class="text-sm font-medium text-gray-900">
                                                            {{ $order->user->nama ?? 'Pelanggan' }}
                                                        </div>
                                                        <div class="text-xs text-gray-500">{{ $order->user->email ?? '-' }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $order->nama_produk ?? $order->product->nama ?? 'Produk' }}
                                                <div class="text-xs text-gray-400">Qty: {{ $order->kuantitas }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                                Rp {{ number_format($order->total_harga, 0, ',', '.') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">


                                                @php
                                                    $statusColors = [
                                                        'pending' => 'bg-yellow-100 text-yellow-800',
                                                        'payment_pending' => 'bg-yellow-100 text-yellow-800',
                                                        'unpaid' => 'bg-yellow-100 text-yellow-800',
                                                        'awaiting_payment' => 'bg-yellow-100 text-yellow-800',
                                                        'capture' => 'bg-blue-100 text-blue-800',
                                                        'paid' => 'bg-green-100 text-green-800',
                                                        'settlement' => 'bg-green-100 text-green-800',
                                                        'processing' => 'bg-purple-100 text-purple-800',
                                                        'shipped' => 'bg-indigo-100 text-indigo-800',
                                                        'delivered' => 'bg-green-100 text-green-800',
                                                        'cancelled' => 'bg-red-100 text-red-800',
                                                        'expired' => 'bg-gray-100 text-gray-800',
                                                        'deny' => 'bg-red-100 text-red-800'
                                                    ];

                                                    $statusLabels = [
                                                        'pending' => 'Pending',
                                                        'payment_pending' => 'Payment Pending',
                                                        'unpaid' => 'Unpaid',
                                                        'awaiting_payment' => 'Awaiting Payment',
                                                        'capture' => 'Capture',
                                                        'paid' => 'Paid',
                                                        'settlement' => 'Settlement',
                                                        'processing' => 'Processing',
                                                        'shipped' => 'Shipped',
                                                        'delivered' => 'Delivered',
                                                        'cancelled' => 'Cancelled',
                                                        'expired' => 'Expired',
                                                        'deny' => 'Denied'
                                                    ];

                                                    $status = strtolower(trim($order->status));
                                                    $color = $statusColors[$status] ?? 'bg-gray-100 text-gray-800';
                                                    $label = $statusLabels[$status] ?? ucfirst($status);

                                                @endphp

                                            <select
                                                class="order-status-dropdown text-xs font-semibold rounded-full px-2 py-1 border {{ $color }}"
                                                data-id="{{ $order->id }}"
                                            >
                                                {{-- Current status (read-only, always accurate) --}}
                                                @if (!in_array($status, ['processing', 'shipped', 'delivered', 'cancelled', 'expired']))
                                                    <option value="{{ $status }}" selected disabled>
                                                        {{ ucfirst(str_replace('_', ' ', $status)) }} (current)
                                                    </option>
                                                @endif

                                                {{-- Allowed admin transitions --}}
                                                @foreach ([
                                                    'processing',
                                                    'shipped',
                                                    'delivered',
                                                    'cancelled',
                                                    'expired'
                                                ] as $st)
                                                    <option value="{{ $st }}" {{ $status === $st ? 'selected' : '' }}>
                                                        {{ ucfirst(str_replace('_', ' ', $st)) }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ \Carbon\Carbon::parse($order->created_at)->format('d M Y') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <div class="flex space-x-2">
                                                    <!-- View Detail Button -->
                                                    <a href="{{ url('/invoice') }}?order_id={{ $order->id }}"
                                                        class="text-blue-600 hover:text-blue-900"
                                                        title="Lihat Detail">
                                                        <i class="fas fa-eye mr-1"></i> Detail
                                                    </a>

                                                    <!-- Process Button - Only show for pending/payment statuses -->
                                                    @if(in_array(strtolower($order->status), ['pending', 'payment_pending', 'unpaid', 'awaiting_payment', 'capture']))
                                                        <button class="text-green-600 hover:text-green-900 process-order"
                                                            data-id="{{ $order->id }}" title="Proses Pesanan">
                                                            <i class="fas fa-check mr-1"></i> Process
                                                        </button>
                                                    @endif

                                                    <!-- Cancel Button - Only show for pending/payment statuses -->
                                                    @if(in_array(strtolower($order->status), ['pending', 'payment_pending', 'unpaid', 'awaiting_payment', 'capture', 'processing']))
                                                        <button class="text-red-600 hover:text-red-900 cancel-order"
                                                            data-id="{{ $order->id }}" title="Batalkan Pesanan">
                                                            <i class="fas fa-times mr-1"></i> Cancel
                                                        </button>
                                                    @endif

                                                    <!-- Mark as Delivered Button - Only show for shipped/processing status -->
                                                    @if(in_array(strtolower($order->status), ['processing', 'shipped', 'paid', 'settlement']))
                                                        <button class="text-purple-600 hover:text-purple-900 deliver-order"
                                                            data-id="{{ $order->id }}" title="Tandai sebagai Dikirim/Selesai">
                                                            <i class="fas fa-truck mr-1"></i> Deliver
                                                        </button>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="text-center py-12">
                                <i class="fas fa-shopping-cart text-gray-300 text-4xl mb-4"></i>
                                <p class="text-gray-600">Belum ada pesanan</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Add interactive functionality
        document.addEventListener('DOMContentLoaded', function () {
            // Checkbox select all functionality
            const selectAllCheckbox = document.querySelector('thead input[type="checkbox"]');
            const rowCheckboxes = document.querySelectorAll('tbody input[type="checkbox"]');

            if (selectAllCheckbox) {
                selectAllCheckbox.addEventListener('change', function () {
                    rowCheckboxes.forEach(checkbox => {
                        checkbox.checked = this.checked;
                    });
                });
            }

            document.querySelectorAll('.order-status-dropdown').forEach(select => {
                select.addEventListener('change', function () {
                    const orderId = this.dataset.id;
                    const newStatus = this.value;

                    if (!confirm(`Change order status to "${newStatus}"?`)) {
                        location.reload(); // revert dropdown
                        return;
                    }

                    fetch(`/admin/api/orders/${orderId}`, {
                        method: 'PUT',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            status: newStatus
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            alert('Status updated successfully');
                            location.reload();
                        } else {
                            alert(data.message || 'Failed to update status');
                            // location.reload();
                        }
                    })
                    .catch(err => {
                        alert('Error updating status');
                        // location.reload();
                    });
                });
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
            // Checkbox select all functionality
            const selectAllCheckbox = document.getElementById('select-all');
            const rowCheckboxes = document.querySelectorAll('.row-checkbox');

            if (selectAllCheckbox) {
                selectAllCheckbox.addEventListener('change', function () {
                    rowCheckboxes.forEach(checkbox => {
                        checkbox.checked = this.checked;
                    });
                });
            }

            // Process Order Button
            document.querySelectorAll('.process-order').forEach(button => {
                button.addEventListener('click', function() {
                    const orderId = this.getAttribute('data-id');
                    if (confirm('Proses pesanan ini? Status akan diubah menjadi "processing".')) {
                        updateOrderStatus(orderId, 'processing'); // Changed from 'process' to 'processing'
                    }
                });
            });

            // Cancel Order Button
            document.querySelectorAll('.cancel-order').forEach(button => {
                button.addEventListener('click', function() {
                    const orderId = this.getAttribute('data-id');
                    if (confirm('Batalkan pesanan ini? Status akan diubah menjadi "cancelled".')) {
                        updateOrderStatus(orderId, 'cancelled'); // Changed from 'cancel' to 'cancelled'
                    }
                });
            });

            // Deliver Order Button
            document.querySelectorAll('.deliver-order').forEach(button => {
                button.addEventListener('click', function() {
                    const orderId = this.getAttribute('data-id');
                    if (confirm('Tandai pesanan sebagai dikirim/selesai? Status akan diubah menjadi "delivered".')) {
                        updateOrderStatus(orderId, 'delivered'); // Changed from 'deliver' to 'delivered'
                    }
                });
            });

            // Bulk Actions
            const bulkActionSelect = document.getElementById('bulk-action');
            const applyBulkActionBtn = document.getElementById('apply-bulk-action');

            if (applyBulkActionBtn) {
                applyBulkActionBtn.addEventListener('click', function () {
                    const selectedOrders = Array.from(document.querySelectorAll('.row-checkbox:checked'))
                        .map(cb => cb.value);

                    if (selectedOrders.length === 0) {
                        alert('Pilih pesanan terlebih dahulu!');
                        return;
                    }

                    const action = bulkActionSelect.value;
                    if (!action) {
                        alert('Pilih aksi terlebih dahulu!');
                        return;
                    }

                    if (confirm(`Proses ${selectedOrders.length} pesanan dengan aksi: ${action}?`)) {
                        bulkUpdateOrders(selectedOrders, action);
                    }
                });
            }

            // Helper function to update order status
            function updateOrderStatus(orderId, status) {
                fetch(`/admin/api/orders/${orderId}`, {  // FIXED: Added orderId to URL
                    method: 'PUT',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        status: status,
                        _method: 'PUT'  // Add this if needed for some Laravel setups
                    })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            showToast(`Status pesanan berhasil diubah ke "${status}"`, 'success');
                            setTimeout(() => location.reload(), 1500);
                        } else {
                            showToast('Gagal mengubah status: ' + (data.message || 'Unknown error'), 'error');
                        }
                    })
                    .catch(error => {
                        showToast('Terjadi kesalahan: ' + error.message, 'error');
                    });
            }

            // Helper function for bulk updates
            function bulkUpdateOrders(orderIds, action) {
                fetch('/admin/api/orders/bulk-update', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        order_ids: orderIds,
                        action: action
                    })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            showToast(`${orderIds.length} pesanan berhasil diproses`, 'success');
                            setTimeout(() => location.reload(), 1500);
                        } else {
                            showToast('Gagal memproses pesanan: ' + (data.message || 'Unknown error'), 'error');
                        }
                    })
                    .catch(error => {
                        showToast('Terjadi kesalahan: ' + error.message, 'error');
                    });
            }

            // Toast notification function
            function showToast(message, type = 'info') {
                const colors = {
                    'success': 'bg-green-500',
                    'error': 'bg-red-500',
                    'warning': 'bg-yellow-500',
                    'info': 'bg-blue-500'
                };

                const toast = document.createElement('div');
                toast.className = `fixed top-4 right-4 ${colors[type] || 'bg-blue-500'} text-white px-6 py-3 rounded-lg shadow-lg z-50 transform transition-transform duration-300 translate-x-full`;
                toast.innerHTML = `
                    <div class="flex items-center">
                        <i class="fas fa-${type === 'success' ? 'check' : type === 'error' ? 'exclamation' : 'info'}-circle mr-3"></i>
                        <span>${message}</span>
                    </div>
                `;

                document.body.appendChild(toast);

                setTimeout(() => {
                    toast.classList.remove('translate-x-full');
                    toast.classList.add('translate-x-0');
                }, 10);

                setTimeout(() => {
                    toast.classList.remove('translate-x-0');
                    toast.classList.add('translate-x-full');
                    setTimeout(() => toast.remove(), 300);
                }, 3000);
            }

            // Search functionality
            const searchInput = document.querySelector('input[placeholder="Cari pesanan..."]');
            if (searchInput) {
                searchInput.addEventListener('keyup', function (e) {
                    if (e.key === 'Enter') {
                        const searchTerm = this.value;
                        window.location.href = `/admin/orders?search=${encodeURIComponent(searchTerm)}`;
                    }
                });
            }

            // Filter functionality
            const statusFilter = document.querySelector('select[name="status"]');
            if (statusFilter) {
                statusFilter.addEventListener('change', function () {
                    if (this.value) {
                        window.location.href = `/admin/orders?status=${this.value}`;
                    } else {
                        window.location.href = '/admin/orders';
                    }
                });
            }
        });
    </script>
</body>

</html>
