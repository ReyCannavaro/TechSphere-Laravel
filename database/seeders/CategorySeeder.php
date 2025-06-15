<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{

    public function run(): void
    {
        $categories = [
            'Mobile',
            'Laptop',
            'PC',
            'Tablet',
            'Smartwatch', 
            'Accessories', 
        ];

        foreach ($categories as $categoryName) {
            Category::create([
                'name' => $categoryName,
                'slug' => Str::slug($categoryName), 
                'description' => 'Produk ' . $categoryName . ' terbaru dan terbaik.',
            ]);
        }
    }
}