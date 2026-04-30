<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'qty', 'user_id', 'category_id'];

    // Relasi ke User (Pembuat produk)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Category (Kategori produk)
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}