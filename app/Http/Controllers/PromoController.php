<?php

namespace App\Http\Controllers;

use App\Models\Promo;
use Illuminate\Http\Request;

class PromoController extends Controller
{
    /**
     * GET /api/promo
     */
    public function index()
    {
        // Only show promos with actual discounts (> 0%)
        $promos = Promo::where('potongan_harga', '>', 0)
            ->with('product:id,nama')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $promos
        ]);
    }

    /**
     * GET /public/promo/featured
     * Get featured promos for home page slider
     */
    public function featured()
    {
        // Get promos with actual discounts (> 0%) and order by discount amount
        $promos = Promo::where('potongan_harga', '>', 0)
            ->with('product:id,nama,harga_satuan,path_thumbnail')
            ->orderBy('potongan_harga', 'desc')
            ->take(10) // Limit to 10 featured promos
            ->get();

        return response()->json([
            'success' => true,
            'data' => $promos
        ]);
    }

    /**
     * GET /api/promo/{id}
     */
    public function show($id)
    {
        $promo = Promo::with('product:id,nama')->find($id);

        if (!$promo) {
            return response()->json([
                'success' => false,
                'message' => 'Promo not found'
            ], 404);
        }

        // Optional: Hide 0% promos from public view
        // if ($promo->potongan_harga == 0) {
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Promo not available'
        //     ], 404);
        // }

        return response()->json([
            'success' => true,
            'data' => $promo
        ]);
    }

    /**
     * POST /api/promo
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'potongan_harga' => 'required|integer|min:0|max:100',
            'product_id' => 'nullable|exists:products,id',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ]);

        // handle thumbnail upload
        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('images/promo', 'public');
        }

        $promo = Promo::create([
            'nama'           => $request->nama,
            'potongan_harga' => $request->potongan_harga,
            'product_id'     => $request->product_id,
            'path_thumbnail' => $thumbnailPath,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Promo created successfully',
            'data' => $promo
        ], 201);
    }

    /**
     * PUT /api/promo/{id}
     */
    public function update(Request $request, $id)
    {
        $promo = Promo::find($id);

        if (!$promo) {
            return response()->json([
                'success' => false,
                'message' => 'Promo not found'
            ], 404);
        }

        $request->validate([
            'nama' => 'sometimes|string|max:255',
            'potongan_harga' => 'sometimes|integer|min:0|max:100',
            'product_id' => 'nullable|exists:products,id',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ]);

        // handle new thumbnail
        if ($request->hasFile('thumbnail')) {

            // delete existing thumbnail
            if ($promo->path_thumbnail) {
                \Storage::disk('public')->delete($promo->path_thumbnail);
            }

            $newPath = $request->file('thumbnail')->store('images/promo', 'public');
            $promo->path_thumbnail = $newPath;
        }

        $updateData = [
            'nama' => $request->nama ?? $promo->nama,
            'potongan_harga' => $request->potongan_harga ?? $promo->potongan_harga,
            'product_id' => $request->product_id ?? $promo->product_id,
        ];

        if ($request->hasFile('thumbnail')) {
            $updateData['path_thumbnail'] = $promo->path_thumbnail;
        }

        $promo->update($updateData);

        return response()->json([
            'success' => true,
            'message' => 'Promo updated successfully',
            'data' => $promo
        ]);
    }

    /**
     * DELETE /api/promo/{id}
     */

    public function destroy($id)
    {
        $promo = Promo::find($id);

        if (!$promo) {
            return response()->json([
                'success' => false,
                'message' => 'Promo not found'
            ], 404);
        }

        $promo->delete();

        return response()->json([
            'success' => true,
            'message' => 'Promo deleted successfully'
        ]);
    }
}
