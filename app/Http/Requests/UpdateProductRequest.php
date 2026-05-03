<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'qty' => 'required|integer|min:0',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id', // <-- TAMBAHAN UNTUK KATEGORI
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama produk wajib diisi.',
            'name.max' => 'Nama produk tidak boleh lebih dari 255 karakter.',
            'qty.required' => 'Jumlah stok produk wajib diisi.',
            'qty.integer' => 'Jumlah produk harus berupa angka bulat (tidak boleh desimal).',
            'qty.min' => 'Jumlah stok tidak boleh kurang dari 0.',
            'price.required' => 'Harga produk wajib diisi.',
            'price.numeric' => 'Harga produk harus berupa angka yang valid.',
            'category_id.required' => 'Kategori produk wajib dipilih.', // <-- PESAN ERROR BARU
            'category_id.exists' => 'Kategori yang dipilih tidak valid atau tidak ditemukan.', // <-- PESAN ERROR BARU
        ];
    }
}