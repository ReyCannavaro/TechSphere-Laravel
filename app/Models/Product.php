<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'stock',
        'image',
        'category_id',
        'brand',
        'specifications',
        'is_published',
    ];

    protected $casts = [
        'specifications' => 'array', // Casting kolom specifications ke array (JSON)
        'is_published' => 'boolean',
    ];

    // Relasi ke Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}