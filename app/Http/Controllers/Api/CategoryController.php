<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    // Method GET (Read All)
    public function index()
    {
        try {
            $categories = Category::latest()->get();
            return response()->json([
                'message' => 'Daftar kategori berhasil diambil',
                'data' => $categories
            ], 200);
        } catch (\Throwable $e) {
            Log::error('Gagal mengambil daftar kategori', ['message' => $e->getMessage()]);
            return response()->json(['message' => 'Server Error'], 500);
        }
    }

    // Method POST (Create)
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:categories,name',
            ]);

            $category = Category::create($validated);

            Log::info('Menambah data kategori', ['category' => $category]);

            return response()->json([
                'message' => 'Kategori berhasil ditambahkan',
                'data' => $category
            ], 201); // 201 = Created
        } catch (\Throwable $e) {
            Log::error('Error saat menambah kategori', ['message' => $e->getMessage()]);
            return response()->json(['message' => 'Gagal menyimpan kategori'], 500);
        }
    }

    // Method GET by ID (Read Detail)
    public function show(string $id)
    {
        try {
            $category = Category::find($id);
            if (!$category) {
                return response()->json(['message' => 'Kategori tidak ditemukan'], 404);
            }
            return response()->json([
                'message' => 'Data ditemukan',
                'data' => $category
            ], 200);
        } catch (\Throwable $e) {
            Log::error('Gagal mengambil detail kategori', ['message' => $e->getMessage()]);
            return response()->json(['message' => 'Server Error'], 500);
        }
    }

    // Method PUT (Update)
    public function update(Request $request, string $id)
    {
        try {
            $category = Category::find($id);
            if (!$category) {
                return response()->json(['message' => 'Kategori tidak ditemukan'], 404);
            }

            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:categories,name,' . $id,
            ]);

            $category->update($validated);

            return response()->json([
                'message' => 'Kategori berhasil diperbarui',
                'data' => $category
            ], 200);
        } catch (\Throwable $e) {
            Log::error('Gagal update kategori', ['message' => $e->getMessage()]);
            return response()->json(['message' => 'Server Error'], 500);
        }
    }

    // Method DELETE (Destroy)
    public function destroy(string $id)
    {
        try {
            $category = Category::find($id);
            if (!$category) {
                return response()->json(['message' => 'Kategori tidak ditemukan'], 404);
            }

            $category->delete();
            return response()->json(['message' => 'Kategori berhasil dihapus'], 204); // 204 = No Content
        } catch (\Throwable $e) {
            Log::error('Gagal menghapus kategori', ['message' => $e->getMessage()]);
            return response()->json(['message' => 'Server Error'], 500);
        }
    }
}