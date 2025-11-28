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
        return response()->json([
            'success' => true,
            'data' => Promo::with('product:id,nama')->get()
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
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ]);

        // handle thumbnail upload
        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('images/promo', 'public');
        }

        $promo = Promo::create([
            'nama'           => $request->nama ?: $request->potongan_harga,
            'potongan_harga' => $request->potongan_harga,
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

        $promo->update([
            'nama' => $request->nama ?? $promo->nama,
            'potongan_harga' => $request->potongan_harga ?? $promo->potongan_harga,
            'path_thumbnail' => $promo->path_thumbnail,
        ]);

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
