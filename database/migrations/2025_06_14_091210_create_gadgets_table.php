<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('gadgets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('slug')->unique(); 
            $table->year('tahun_keluaran'); 
            $table->decimal('harga', 15, 2); 
            $table->text('description'); 
            $table->string('image')->nullable(); 
            $table->json('specifications')->nullable();
            $table->boolean('is_featured')->default(false); 
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gadgets');
    }
};