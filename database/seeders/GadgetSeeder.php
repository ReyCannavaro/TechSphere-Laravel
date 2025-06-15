<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category; // Import model Category
use App\Models\Gadget;   // Import model Gadget
use Illuminate\Support\Str; // Import Str untuk slug

class GadgetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan kategori sudah ada
        $mobileCategory = Category::where('slug', 'mobile')->first();
        $laptopCategory = Category::where('slug', 'laptop')->first();
        $pcCategory = Category::where('slug', 'pc')->first();
        $tabletCategory = Category::where('slug', 'tablet')->first();

        // Data Gadget
        $gadgets = [
            [
                'category' => $mobileCategory,
                'name' => 'iPhone 15 Pro Max',
                'tahun_keluaran' => 2023,
                'harga' => 21999000.00,
                'description' => 'Smartphone flagship terbaru dari Apple dengan chip A17 Bionic dan sistem kamera Pro yang revolusioner.',
                'image' => 'iphone-15-pro-max.png',
                'specifications' => 'Display: 6.7" Super Retina XDR, Chip: A17 Bionic, Camera: 48MP Main, Battery: All-day',
                'is_featured' => true, 
            ],
            [
                'category' => $laptopCategory,
                'name' => 'MacBook Pro M3',
                'tahun_keluaran' => 2023,
                'harga' => 29999000.00,
                'description' => 'Laptop bertenaga dengan chip M3 Pro, ideal untuk profesional kreatif.',
                'image' => 'macbook-pro-m3.png',
                'specifications' => 'Display: 14" Liquid Retina XDR, Chip: Apple M3 Pro, RAM: 18GB, Storage: 512GB SSD',
                'is_featured' => true, 
            ],
            [
                'category' => $mobileCategory,
                'name' => 'Samsung Galaxy S24 Ultra',
                'tahun_keluaran' => 2024,
                'harga' => 19999000.00,
                'description' => 'Smartphone Android premium dengan S Pen terintegrasi dan kamera luar biasa.',
                'image' => 'galaxy-s24-ultra.webp',
                'specifications' => 'Display: 6.8" Dynamic AMOLED 2X, Chip: Snapdragon 8 Gen 3, Camera: 200MP Main',
                'is_featured' => false,
            ],
            [
                'category' => $pcCategory,
                'name' => 'Custom Gaming PC (RTX 4080)',
                'tahun_keluaran' => 2023,
                'harga' => 35000000.00,
                'description' => 'PC gaming rakitan dengan performa tinggi untuk pengalaman gaming terbaik.',
                'image' => 'gaming-pc.png',
                'specifications' => 'CPU: Intel i9-13900K, GPU: NVIDIA RTX 4080, RAM: 32GB DDR5, Storage: 1TB NVMe SSD',
                'is_featured' => false,
            ],
            [
                'category' => $tabletCategory,
                'name' => 'iPad Air (M2)',
                'tahun_keluaran' => 2024,
                'harga' => 12500000.00,
                'description' => 'Tablet serbaguna dengan chip M2 yang powerful, cocok untuk belajar dan produktivitas.',
                'image' => 'ipad-air-m2.webp',
                'specifications' => 'Display: 10.9" Liquid Retina, Chip: Apple M2, Storage: 256GB',
                'is_featured' => false,
            ],
             [
                'category' => $laptopCategory,
                'name' => 'Asus ROG Zephyrus G14',
                'tahun_keluaran' => 2024,
                'harga' => 25000000.00,
                'description' => 'Laptop gaming portabel dan bertenaga dari Asus.',
                'image' => 'asus-rog-g14.png',
                'specifications' => 'CPU: AMD Ryzen 9, GPU: NVIDIA RTX 4070, RAM: 16GB, Storage: 1TB SSD',
                'is_featured' => false,
            ],
             [
                'category' => $mobileCategory,
                'name' => 'Google Pixel 8 Pro',
                'tahun_keluaran' => 2023,
                'harga' => 14000000.00,
                'description' => 'Smartphone Google dengan kemampuan AI canggih dan kamera terbaik.',
                'image' => 'pixel-8-pro.png',
                'specifications' => 'Display: 6.7" OLED, Chip: Google Tensor G3, Camera: 50MP Main',
                'is_featured' => false,
            ],
        ];

        foreach ($gadgets as $gadgetData) {
            if ($gadgetData['category']) { 
                Gadget::create([
                    'category_id' => $gadgetData['category']->id,
                    'name' => $gadgetData['name'],
                    'slug' => Str::slug($gadgetData['name']),
                    'tahun_keluaran' => $gadgetData['tahun_keluaran'],
                    'harga' => $gadgetData['harga'],
                    'description' => $gadgetData['description'],
                    'image' => $gadgetData['image'],
                    'specifications' => $gadgetData['specifications'],
                    'is_featured' => $gadgetData['is_featured'],
                ]);
            }
        }
    }
}