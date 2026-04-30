<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;

class ProductController extends Controller
{
    public function index()
    {
        // Tambahkan 'category' di dalam with()
        $products = Product::with(['user', 'category'])->latest()->get(); 
        return view('products.index', compact('products'));
    }

    public function create()
    {
        Gate::authorize('manage-product');
        $categories = Category::all(); 
        return view('products.create', compact('categories'));
    }

    public function store(StoreProductRequest $request)
    {
        Gate::authorize('manage-product');

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'qty' => $request->qty,
            'category_id' => $request->category_id, // <-- INI YANG KURANG TADI
            'user_id' => Auth::id(), 
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        Gate::authorize('update', $product);
        $categories = Category::all(); 

        return view('products.edit', compact('product', 'categories'));
    }

    public function update(UpdateProductRequest $request, string $id)
    {
        $product = Product::findOrFail($id);
        Gate::authorize('update', $product);

        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'qty' => $request->qty,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil diupdate!');
    }

    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        Gate::authorize('delete', $product);

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus!');
    }
}