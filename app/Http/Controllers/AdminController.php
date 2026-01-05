<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Chat;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;

use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function dashboard()
    {

        //Sales range
        $salesRange = request('SalesRange', 'this_week');

        switch ($salesRange) {
            case 'last_week':
                $salesStart = Carbon::now()->subWeek()->startOfWeek();
                $salesEnd   = Carbon::now()->subWeek()->endOfWeek();
                break;

            case 'this_month':
                $salesStart = Carbon::now()->startOfMonth();
                $salesEnd   = Carbon::now()->endOfMonth();
                break;

            case 'last_month':
                $salesStart = Carbon::now()->subMonth()->startOfMonth();
                $salesEnd   = Carbon::now()->subMonth()->endOfMonth();
                break;

            default: // this_week
                $salesStart = Carbon::now()->startOfWeek();
                $salesEnd   = Carbon::now()->endOfWeek();
        }
        //Revenue range
        $revenueRange = request('RevenueRange', 'this_week');

        switch ($revenueRange) {
            case 'last_week':
                $revenueStart = Carbon::now()->subWeek()->startOfWeek();
                $revenueEnd   = Carbon::now()->subWeek()->endOfWeek();
                break;

            case 'this_month':
                $revenueStart = Carbon::now()->startOfMonth();
                $revenueEnd   = Carbon::now()->endOfMonth();
                break;

            case 'last_month':
                $revenueStart = Carbon::now()->subMonth()->startOfMonth();
                $revenueEnd   = Carbon::now()->subMonth()->endOfMonth();
                break;

            default: // this_week
                $revenueStart = Carbon::now()->startOfWeek();
                $revenueEnd   = Carbon::now()->endOfWeek();
        }


        $weekDays = [2, 3, 4, 5, 6, 7, 1];
        $revenueStatuses = [
            'paid',
            'processing',
            'shipped',
            'delivered',
        ];

        // Unread messages
        $unreadCount = Chat::where('is_read', false)
                        ->where('sender', 'user')
                        ->count();

        // Revenue-valid statuses


        $salesRaw = Order::whereIn('status', $revenueStatuses)
        ->whereBetween('created_at', [$salesStart, $salesEnd])
        ->selectRaw('DAYOFWEEK(created_at) as day, COUNT(*) as total')
        ->groupBy('day')
        ->pluck('total', 'day')
        ->toArray();

        $revenueRaw = Order::whereIn('status', $revenueStatuses)
        ->whereBetween('created_at', [$revenueStart, $revenueEnd])
        ->selectRaw('DAYOFWEEK(created_at) as day, SUM(total_harga) as total')
        ->groupBy('day')
        ->pluck('total', 'day')
        ->toArray();

        $salesChart = [];
        $revenueChart = [];

        foreach ($weekDays as $day) {
            $salesChart[] = $salesRaw[$day] ?? 0;
            $revenueChart[] = $revenueRaw[$day] ?? 0;
        }

        // Total revenue
        $totalRevenue = Order::whereIn('status', $revenueStatuses)
            ->sum('total_harga');

        // Total users
        $totalUsers = User::count();

        // Total products
        $totalProducts = Product::count();

        // Total orders
        $totalOrders = Order::count();

        $recentOrders = Order::with(['user', 'product'])
        ->whereBetween('created_at', [
            Carbon::now()->subWeek(),
            Carbon::now(),
        ])
        ->latest()
        ->limit(5)
        ->get();

        return view('admin', [
            'unreadCount'   => $unreadCount,
            'totalRevenue'  => $totalRevenue ?? 0,
            'totalUsers'    => $totalUsers,
            'totalProducts' => $totalProducts,
            'totalOrders'   => $totalOrders,
            'revenueChart'  => $revenueChart,
            'salesChart'    => $salesChart,
            'salesRange'    => $salesRange,
            'revenueRange'  => $revenueRange,
            'recentOrders'  => $recentOrders,

        ]);
    }

    public function orders()
    {
        // Get unread messages count
        $unreadCount = Chat::where('is_read', false)
                        ->where('sender', 'user')
                        ->count();

        // Calculate statistics
        $totalOrders = Order::count();

        // Pending orders - status 'pending', 'capture', 'payment_pending', 'unpaid', 'awaiting_payment'
        $pendingOrders = Order::whereIn('status', [
            'pending',
            'capture',
            'payment_pending',
            'unpaid',
            'awaiting_payment'
        ])->count();

        // Completed orders - status 'paid', 'delivered', 'settlement'
        $completedOrders = Order::whereIn('status', [
            'paid',
            'delivered',
            'settlement'
        ])->count();

        // Total revenue - only for certain statuses
        $revenueStatuses = ['paid', 'processing', 'shipped', 'delivered', 'settlement'];
        $totalRevenue = Order::whereIn('status', $revenueStatuses)->sum('total_harga');

        // Get latest orders for the table
        $orders = Order::with(['user', 'product'])
                    ->orderBy('created_at', 'desc')
                    ->take(10) // Limit to 10 latest orders
                    ->get();

        return view('admin_orders', compact(
            'unreadCount',
            'totalOrders',
            'pendingOrders',
            'completedOrders',
            'totalRevenue',
            'orders'
        ));
    }

    public function ordersDetail()
    {
        $unreadCount = Chat::where('is_read', false)
                           ->where('sender', 'user')
                           ->count();


        return view('admin_orders_detail', compact('unreadCount'));
    }

    public function statistics()
    {
        // Get unread messages count
        $unreadCount = Chat::where('is_read', false)
                           ->where('sender', 'user')
                           ->count();

        return view('admin_statistics', compact('unreadCount'));
    }

    public function billing()
    {
        // Get unread messages count
        $unreadCount = Chat::where('is_read', false)
                           ->where('sender', 'user')
                           ->count();

        return view('admin_billing', compact('unreadCount'));
    }

    public function products()
    {
        // Get unread messages count
        $unreadCount = Chat::where('is_read', false)
                           ->where('sender', 'user')
                           ->count();

        $products = Product::with('category')->get();
        $categories = Category::all();
        return view('admin_products', compact('products', 'categories', 'unreadCount'));
    }

    public function editProduct($id)
    {
        // Get unread messages count
        $unreadCount = Chat::where('is_read', false)
                           ->where('sender', 'user')
                           ->count();

        $product = Product::findOrFail($id);
        $categories = Category::all();
        $products = Product::with('category')->get();
        return view('admin_products_edit', compact('product', 'categories', 'unreadCount','products'));
    }


    public function revenue()
    {
        $totalRevenue = Order::whereIn('status', ['paid', 'shipped', 'delivered'])
            ->sum('total_harga');

        return response()->json([
            'success' => true,
            'total_revenue' => (float) $totalRevenue
        ]);
    }
}
