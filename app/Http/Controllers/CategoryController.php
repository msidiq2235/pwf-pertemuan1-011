<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return "Berhasil! Ini adalah halaman Kategori. Jika kamu bisa melihat tulisan ini, berarti kamu login sebagai Admin dan berhasil melewati Gate 'manage-product'.";
    }

    // Biarkan fungsi create, store, dll kosong untuk sementara
}