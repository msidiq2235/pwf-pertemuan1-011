<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{
    // 1. Menampilkan Halaman Daftar Kategori
    public function index()
    {
        Gate::authorize('manage-category');

        // Mengambil semua kategori beserta jumlah produknya (withCount)
        $categories = Category::withCount('products')->latest()->get();

        return view('categories.index', compact('categories'));
    }

    // 2. Menampilkan Form Tambah Kategori
    public function create()
    {
        Gate::authorize('manage-category');
        return view('categories.create');
    }

    // 3. Menyimpan Data Kategori Baru ke Database
    public function store(Request $request)
    {
        Gate::authorize('manage-category');

        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ], [
            'name.required' => 'Nama kategori wajib diisi.',
            'name.unique' => 'Nama kategori ini sudah ada.',
        ]);

        // Simpan ke database
        Category::create([
            'name' => $request->name,
        ]);

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    // 4. (Opsional) Menampilkan detail 1 kategori - biasanya jarang dipakai untuk kategori
    public function show(string $id)
    {
        // 
    }

    // 5. Menampilkan Form Edit Kategori
    public function edit(string $id)
    {
        Gate::authorize('manage-category');
        
        $category = Category::findOrFail($id);
        
        return view('categories.edit', compact('category'));
    }

    // 6. Menyimpan Perubahan Kategori ke Database
    public function update(Request $request, string $id)
    {
        Gate::authorize('manage-category');

        $category = Category::findOrFail($id);

        // Validasi input (pengecualian unique untuk nama kategori itu sendiri)
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
        ]);

        $category->update([
            'name' => $request->name,
        ]);

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil diupdate!');
    }

    // 7. Menghapus Kategori
    public function destroy(string $id)
    {
        Gate::authorize('manage-category');

        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus!');
    }
}