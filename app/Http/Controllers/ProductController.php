<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('user')->latest()->get(); 
        return view('products.index', compact('products'));
    }

    public function create()
    {
        Gate::authorize('manage-product');
        return view('products.create');
    }

    public function store(StoreProductRequest $request)
    {
        Gate::authorize('manage-product');

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'qty' => $request->qty,
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

        return view('products.edit', compact('product'));
    }

    public function update(UpdateProductRequest $request, string $id)
    {
        $product = Product::findOrFail($id);
        Gate::authorize('update', $product);

        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'qty' => $request->qty,
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