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

@section('content')
    <div class="p-6 space-y-6">

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

                    {{-- <a href="{{ route('admin.orders') }}"
                        class="nav-item group flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->is('admin/orders') ? 'bg-white/20 text-white' : 'text-gray-300 hover:text-white hover:bg-white/10' }} transition-all duration-300">
                        <i class="fas fa-shopping-bag w-5 h-5 mr-3"></i>
                        <span>Pesanan</span>
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
                            <div class="flex items-center space-x-4">
                                <a href="#"
                                    class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md text-sm transition-colors">
                                    <i class="fas fa-list mr-2"></i> Lihat Semua
                                </a>
                            </div>
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

                                                        $status = strtolower($order->status);
                                                        $color = $statusColors[$status] ?? 'bg-gray-100 text-gray-800';
                                                        $label = $statusLabels[$status] ?? ucfirst($status);
                                                    @endphp
                                                    <span
                                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $color }}">
                                                        {{ $label }}
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {{ \Carbon\Carbon::parse($order->created_at)->format('d M Y') }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                    <div class="flex space-x-2">

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


        {{-- Header --}}
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Detail Produk</h1>
                <p class="text-sm text-gray-500">Informasi lengkap produk</p>
            </div>

            <div class="flex space-x-2">

                <a href="{{ route('admin.products') }}"
                    class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg text-sm hover:bg-gray-300 transition">
                    Kembali
                </a>
            </div>
        </div>

        {{-- Main Card --}}
        <div class="bg-white rounded-xl shadow-lg overflow-hidden grid grid-cols-1 lg:grid-cols-3">

            {{-- Image --}}
            <div class="lg:col-span-1 bg-gray-50 flex items-center justify-center p-6">
                @if ($product->thumbnail)
                    <img src="{{ asset('storage/' . $product->thumbnail) }}" class="rounded-lg max-h-72 object-contain"
                        alt="{{ $product->nama }}">
                @else
                    <div class="w-48 h-48 flex items-center justify-center
                                                                            rounded-full bg-gradient-to-br from-indigo-500 to-purple-600
                                                                            text-white text-4xl font-bold">
                        {{ strtoupper(substr($product->nama, 0, 2)) }}
                    </div>
                @endif
            </div>

            {{-- Details --}}
            <div class="lg:col-span-2 p-6 space-y-6">

                {{-- Name & Status --}}
                <div>
                    <h2 class="text-xl font-bold text-gray-800">{{ $product->nama }}</h2>
                    <p class="text-sm text-gray-500 mt-1">
                        SKU: {{ $product->sku ?? '-' }}
                    </p>
                </div>

                {{-- Info Grid --}}
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">

                    <div>
                        <p class="text-xs text-gray-500">Harga</p>
                        <p class="text-sm font-semibold text-gray-800">
                            Rp {{ number_format($product->harga_satuan, 0, ',', '.') }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs text-gray-500">Stok</p>
                        <p class="text-sm font-semibold text-gray-800">
                            {{ $product->stok }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs text-gray-500">Kategori</p>
                        <p class="text-sm font-semibold text-gray-800">
                            {{ optional($product->category)->nama ?? '-' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs text-gray-500">Status</p>
                        <span
                            class="inline-flex px-2 py-1 text-xs rounded-full
                                                {{ $product->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $product->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </div>

                    <div>
                        <p class="text-xs text-gray-500">Dibuat</p>
                        <p class="text-sm text-gray-800">
                            {{ $product->created_at->format('d M Y') }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs text-gray-500">Terakhir Update</p>
                        <p class="text-sm text-gray-800">
                            {{ $product->updated_at->format('d M Y') }}
                        </p>
                    </div>
                </div>

                {{-- Description --}}
                <div>
                    <p class="text-xs text-gray-500 mb-1">Deskripsi</p>
                    <p class="text-sm text-gray-700 leading-relaxed">
                        {{ $product->deskripsi ?? 'Tidak ada deskripsi.' }}
                    </p>
                </div>
            </div>
        </div>

        {{-- Order Stats --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <div class="bg-white rounded-xl shadow p-5">
                <p class="text-xs text-gray-500">Total Terjual</p>
                <p class="text-2xl font-bold text-gray-800">
                    {{ $product->orders()->count() }}
                </p>
            </div>

            <div class="bg-white rounded-xl shadow p-5">
                <p class="text-xs text-gray-500">Pendapatan</p>
                <p class="text-2xl font-bold text-gray-800">
                    Rp {{ number_format(
        $product->orders()
            ->whereIn('status', ['paid', 'processing', 'shipped', 'delivered'])
            ->sum('total_harga'),
        0,
        ',',
        '.'
    ) }}
                </p>
            </div>

            <div class="bg-white rounded-xl shadow p-5">
                <p class="text-xs text-gray-500">Pesanan Aktif</p>
                <p class="text-2xl font-bold text-gray-800">
                    {{ $product->orders()->whereIn('status', ['pending', 'paid', 'processing'])->count() }}
                </p>
            </div>

        </div>

    </div>
@endsection
