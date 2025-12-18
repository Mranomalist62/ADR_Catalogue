<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Chat;
use App\Models\Product;
use App\Models\Promo;

use Illuminate\Http\Request;

class AdminController extends Controller
{
     public function dashboard()
    {
        // Get unread messages count
        $unreadCount = Chat::where('is_read', false)
                           ->where('sender', 'user')
                           ->count();

        return view('admin', compact('unreadCount'));
    }

    public function orders()
    {
        // Get unread messages count
        $unreadCount = Chat::where('is_read', false)
                           ->where('sender', 'user')
                           ->count();

        return view('admin_orders', compact('unreadCount'));
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

    public function promo()
    {
        // Get unread messages count
        $unreadCount = Chat::where('is_read', false)
                           ->where('sender', 'user')
                           ->count();

        return view('admin_promo_banner', compact('unreadCount'));
    }

}
