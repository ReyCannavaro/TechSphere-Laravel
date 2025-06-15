<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->longText('description')->nullable(); // Menggunakan longText untuk deskripsi panjang
            $table->decimal('price', 10, 2); // Contoh: 99999999.99
            $table->integer('stock')->default(0);
            $table->string('image')->nullable(); // Path ke gambar utama
            $table->foreignId('category_id')->constrained()->onDelete('cascade'); // Foreign key ke categories
            $table->string('brand')->nullable();
            $table->json('specifications')->nullable(); // Untuk menyimpan data JSON spesifikasi
            $table->boolean('is_published')->default(true); // Status publikasi produk
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
