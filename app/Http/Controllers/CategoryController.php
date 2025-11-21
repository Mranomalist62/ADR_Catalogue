<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    // GET /api/categories
    public function index()
    {
        $categories = Category::all();

        return response()->json([
            'success' => true,
            'data' => $categories
        ]);
    }

    // GET /api/categories/{id}
    public function show($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $category
        ]);
    }

    // POST /api/categories
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048'
        ]);

        $thumbnailPath = null;

        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('categories', 'public');
        }

        $category = Category::create([
            'nama' => $request->nama,
            'path_thumbnail' => $thumbnailPath
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Category created successfully',
            'data' => $category
        ], 201);
    }

    // PUT /api/categories/{id}
    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found'
            ], 404);
        }

        $request->validate([
            'nama' => 'sometimes|string|max:255',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048'
        ]);

        // Handle thumbnail update
        if ($request->hasFile('thumbnail')) {
            // delete old thumbnail
            if ($category->path_thumbnail) {
                Storage::disk('public')->delete($category->path_thumbnail);
            }

            $thumbnailPath = $request->file('thumbnail')->store('categories', 'public');
            $category->path_thumbnail = $thumbnailPath;
        }

        $category->update($request->only(['nama']));

        return response()->json([
            'success' => true,
            'message' => 'Category updated successfully',
            'data' => $category
        ]);
    }

    // DELETE /api/categories/{id}
    public function destroy($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found'
            ], 404);
        }

        if ($category->path_thumbnail) {
            Storage::disk('public')->delete($category->path_thumbnail);
        }

        $category->delete();

        return response()->json([
            'success' => true,
            'message' => 'Category deleted successfully'
        ]);
    }
}
