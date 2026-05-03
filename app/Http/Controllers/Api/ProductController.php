<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    // Method GET (Read All)
    public function index()
    {
        try {
            $products = Product::with(['user', 'category'])->latest()->get();
            return response()->json([
                'message' => 'Daftar produk berhasil diambil',
                'data' => $products
            ], 200);
        } catch (\Throwable $e) {
            Log::error('Gagal mengambil daftar produk', ['message' => $e->getMessage()]);
            return response()->json(['message' => 'Server Error'], 500);
        }
    }

    // Method POST (Create)
    public function store(StoreProductRequest $request)
    {
        try {
            $validated = $request->validated();
            
            // Ambil ID user dari token yang sedang login
            $validated['user_id'] = Auth::id();

            $product = Product::create($validated);

            Log::info('Menambah data produk', ['list' => $product]);

            return response()->json([
                'message' => 'Produk berhasil ditambahkan!!',
                'data' => $product,
            ], 201);
        } catch (\Throwable $e) {
            Log::error('Error saat menambah product', ['message' => $e->getMessage()]);
            return response()->json(['message' => 'Gagal menyimpan data'], 500);
        }
    }

    // Method GET by ID (Read Detail)
    public function show(int $id)
    {
        try {
            $product = Product::with(['user', 'category'])->find($id);
            
            if (!$product) {
                return response()->json(['message' => 'Product tidak ditemukan'], 404);
            }
            
            return response()->json([
                'message' => 'Product retrieved successfully',
                'data' => $product
            ], 200);
        } catch (\Throwable $e) {
            Log::error('Gagal mengambil data produk', ['message' => $e->getMessage()]);
            return response()->json(['message' => 'Server Error'], 500);
        }
    }

    // Method PUT (Update)
    public function update(UpdateProductRequest $request, int $id)
    {
        try {
            $product = Product::find($id);
            
            if (!$product) {
                return response()->json(['message' => 'Product tidak ditemukan'], 404);
            }

            $validated = $request->validated();
            
            // Tetap simpan user_id yang lama (atau update jika logikanya mengharuskan)
            $validated['user_id'] = Auth::id(); 
            
            $product->update($validated);

            return response()->json([
                'message' => 'Produk berhasil diperbarui',
                'data' => $product
            ], 200);
        } catch (\Throwable $e) {
            Log::error('Gagal update produk', ['message' => $e->getMessage()]);
            return response()->json(['message' => 'Server Error'], 500);
        }
    }

    // Method DELETE (Destroy)
    public function destroy(int $id)
    {
        try {
            $product = Product::find($id);
            
            if (!$product) {
                return response()->json(['message' => 'Product tidak ditemukan'], 404);
            }

            $product->delete();
            
            return response()->json(['message' => 'Produk berhasil dihapus'], 204);
        } catch (\Throwable $e) {
            Log::error('Gagal menghapus produk', ['message' => $e->getMessage()]);
            return response()->json(['message' => 'Server Error'], 500);
        }
    }
}