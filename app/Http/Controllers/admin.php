<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Chat;

class admin extends Controller
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

    public function storeProduct(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'id_kategori' => 'required|exists:category,id',
            'harga' => 'required|numeric|min:0',
            'diskon' => 'nullable|numeric|min:0|max:100',
            'quantity' => 'required|integer|min:0',
            'desc' => 'nullable|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();
        $data['kuantitas'] = $request->quantity;
        $data['diskon'] = $request->diskon ?? 0;

        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/products'), $filename);
            $data['path_thumbnail'] = 'images/products/' . $filename;
        }

        Product::create($data);

        return redirect()->route('admin.products')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function editProduct($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin_edit_product', compact('product', 'categories'));
    }

    public function updateProduct(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'id_kategori' => 'required|exists:category,id',
            'harga' => 'required|numeric|min:0',
            'diskon' => 'nullable|numeric|min:0|max:100',
            'quantity' => 'required|integer|min:0',
            'desc' => 'nullable|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $product = Product::findOrFail($id);
        $data = $request->all();
        $data['kuantitas'] = $request->quantity;
        $data['diskon'] = $request->diskon ?? 0;

        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail if exists
            if ($product->path_thumbnail && file_exists(public_path($product->path_thumbnail))) {
                unlink(public_path($product->path_thumbnail));
            }

            $file = $request->file('thumbnail');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/products'), $filename);
            $data['path_thumbnail'] = 'images/products/' . $filename;
        }

        $product->update($data);

        return redirect()->route('admin.products')->with('success', 'Produk berhasil diperbarui!');
    }

    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);
        
        // Delete thumbnail if exists
        if ($product->path_thumbnail && file_exists(public_path($product->path_thumbnail))) {
            unlink(public_path($product->path_thumbnail));
        }
        
        $product->delete();

        return redirect()->route('admin.products')->with('success', 'Produk berhasil dihapus!');
    }
}
