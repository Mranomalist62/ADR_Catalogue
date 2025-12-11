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

    /**
     * GET /public/products/latest
     * Get latest products for home page slider
     */
    public function latest()
    {
        // Get latest products with their promo information
        $products = Product::with(['category:id,nama', 'promo'])
            ->orderBy('created_at', 'desc')
            ->take(10) // Limit to 10 latest products
            ->get();

        return response()->json([
            'success' => true,
            'data' => $products
        ]);
    }

    // GET /api/products/{id} - Show specific product
    public function show($id)
    {
        $product = Product::with(['category', 'promo'])->find($id);

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
        try{
            $request->validate([
                'nama' => 'required|string|max:255',
                'kuantitas' => 'required|integer|min:0',
                'id_kategori' => 'required|exists:category,id',
                'harga_satuan' => 'required|integer|min:0',
                'desc' => 'nullable|string',
                'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'diskon' => 'nullable|integer|min:0|max:100',
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
                'harga_satuan' => $request->harga_satuan,
                'path_thumbnail' => $pathThumbnail
            ]);

            // ALWAYS create promo record (even at 0%)
            $promo = Promo::create([
                'product_id' => $product->id,
                'nama' => $request->diskon > 0 ?
                    'Diskon ' . $request->diskon . '% untuk ' . $request->nama :
                    'Tidak ada diskon untuk ' . $request->nama,
                'potongan_harga' => $request->diskon ?? 0,
                'path_thumbnail' => null, // Add this field
            ]);

            // Since Promo has product_id, we don't need to set promo_id on Product
            // The relationship is one-way: Promo → Product (promo belongs to product)
            // If you want two-way relationship, you need a promo_id column in products table

            return response()->json([
                'success' => true,
                'message' => 'Product and promo created successfully',
                'data' => [
                    'product' => $product->load('category', 'promo'),
                    'promo' => $promo
                ]
            ], 201);
        } catch (\Exception $e) {
            // Return detailed error for debugging
            return response()->json([
                'success' => false,
                'message' => 'Internal Server Error',
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => env('APP_DEBUG') ? $e->getTrace() : []
            ], 500);
        }
    }

    // PUT /api/products/{id} - Update product
    public function update(Request $request, $id)
    {
        try {
            $product = Product::with('promo')->find($id);

            if (!$product) {
                return response()->json([
                    'success' => false,
                    'message' => 'Product not found'
                ], 404);
            }

            $request->validate([
                'nama' => 'sometimes|string|max:255',
                'kuantitas' => 'sometimes|integer|min:0',
                'id_kategori' => 'sometimes|exists:category,id',
                'desc' => 'nullable|string',
                'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'harga_satuan' => 'sometimes|integer|min:0',
                'diskon' => 'nullable|integer|min:0|max:100'
            ]);

            $updateData = $request->only(['nama', 'kuantitas', 'id_kategori', 'desc', 'harga_satuan']);

            if ($request->hasFile('thumbnail')) {
                if ($product->path_thumbnail) {
                    Storage::disk('public')->delete($product->path_thumbnail);
                }
                $pathThumbnail = $request->file('thumbnail')->store('images/product', 'public');
                $updateData['path_thumbnail'] = $pathThumbnail;
            }

            // Update product
            $product->update($updateData);

            // Handle promo
            $diskonValue = $request->has('diskon') ? $request->diskon : ($product->promo ? $product->promo->potongan_harga : 0);

            if ($product->promo) {
                // Update existing promo
                $product->promo->update([
                    'potongan_harga' => $diskonValue,
                    'nama' => $diskonValue > 0 ?
                        'Diskon ' . $diskonValue . '% untuk ' . $product->nama :
                        'Tidak ada diskon untuk ' . $product->nama,
                ]);
            } else {
                // Create new promo if doesn't exist
                Promo::create([
                    'product_id' => $product->id,
                    'nama' => $diskonValue > 0 ?
                        'Diskon ' . $diskonValue . '% untuk ' . $product->nama :
                        'Tidak ada diskon untuk ' . $product->nama,
                    'potongan_harga' => $diskonValue,
                    'path_thumbnail' => null,
                ]);
            }

            // Reload relationships
            $product->load('category', 'promo');

            return response()->json([
                'success' => true,
                'message' => 'Product updated successfully',
                'data' => $product
            ]);

        } catch (\Exception $e) {
            // Return detailed error for debugging
            return response()->json([
                'success' => false,
                'message' => 'Internal Server Error',
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => env('APP_DEBUG') ? $e->getTrace() : []
            ], 500);
        }
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
