<?php
// app/Http/Controllers/ProductController.php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Promo;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // GET /api/products - List all products for logged-in user
    public function index()
    {
        $products = Product::with('category')
            ->whereHas('category', function($query) {

            })
            ->get();

        return response()->json([
            'success' => true,
            'data' => $products
        ]);
    }

    // GET /api/products/{id} - Show specific product
    public function show($id)
    {
        $product = Product::with(['category', 'promos'])->find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $product
        ]);
    }

    // POST /api/products - Create new product
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kuantitas' => 'required|integer|min:0',
            'id_kategori' => 'required|exists:categories,id',
            'desc' => 'nullable|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

            // Add promo validation
            'promo_nama' => 'required|string|max:255',
            'promo_potongan' => 'required|integer|min:0|max:100'
        ]);

        // Handle thumbnail upload
        $pathThumbnail = null;
        if ($request->hasFile('thumbnail')) {
            $pathThumbnail = $request->file('thumbnail')->store('images/product', 'public');
        }

        // Create product
        $product = Product::create([
            'nama' => $request->nama,
            'kuantitas' => $request->kuantitas,
            'id_kategori' => $request->id_kategori,
            'desc' => $request->desc,
            'path_thumbnail' => $pathThumbnail
        ]);

        // AUTO-create promo
        $promo = Promo::create([
            'product_id' => $product->id,
            'nama' => $request->promo_nama,
            'potongan_harga' => $request->promo_potongan
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Product + promo created successfully',
            'data' => [
                'product' => $product->load('category'),
                'promo' => $promo
            ]
        ], 201);
    }
    // PUT /api/products/{id} - Update product
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ], 404);
        }

        $request->validate([
            'nama' => 'sometimes|string|max:255',
            'kuantitas' => 'sometimes|integer|min:0',
            'id_kategori' => 'sometimes|exists:categories,id',
            'desc' => 'nullable|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail if exists
            if ($product->path_thumbnail) {
                Storage::disk('public')->delete($product->path_thumbnail);
            }
            $pathThumbnail = $request->file('thumbnail')->store('images/product', 'public');
            $product->path_thumbnail = $pathThumbnail;
        }

        $product->update($request->only(['nama', 'kuantitas', 'id_kategori', 'desc']));

        return response()->json([
            'success' => true,
            'message' => 'Product updated successfully',
            'data' => $product->load('category')
        ]);
    }

    // DELETE /api/products/{id} - Delete product
    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ], 404);
        }

        // Delete thumbnail if exists
        if ($product->path_thumbnail) {
            Storage::disk('public')->delete($product->path_thumbnail);
        }

        $product->delete();

        return response()->json([
            'success' => true,
            'message' => 'Product deleted successfully'
        ]);
    }

    // GET /api/products/category/{categoryId} - Get products by category
    public function byCategory($categoryId)
    {
        $products = Product::with('category')
            ->where('id_kategori', $categoryId)
            ->get();

        return response()->json([
            'success' => true,
            'data' => $products
        ]);
    }

    // GET /api/products/search/{keyword} - Search products
    public function search($keyword)
    {
        $products = Product::with('category')
            ->where('nama', 'like', "%{$keyword}%")
            ->orWhere('desc', 'like', "%{$keyword}%")
            ->get();

        return response()->json([
            'success' => true,
            'data' => $products
        ]);
    }

    // POST /api/products/{id}/thumbnail - Update only thumbnail
    public function updateThumbnail(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ], 404);
        }

        $request->validate([
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Delete old thumbnail if exists
        if ($product->path_thumbnail) {
            Storage::disk('public')->delete($product->path_thumbnail);
        }

        $pathThumbnail = $request->file('thumbnail')->store('images/product', 'public');
        $product->update(['path_thumbnail' => $pathThumbnail]);

        return response()->json([
            'success' => true,
            'message' => 'Thumbnail updated successfully',
            'data' => [
                'thumbnail_url' => Storage::url($pathThumbnail)
            ]
        ]);
    }
}
