<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany; // Untuk relasi ke Gadget

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description'
    ];

    /**
     * Get the gadgets for the category.
     */
    public function gadgets(): HasMany
    {
        return $this->hasMany(Gadget::class);
    }
}