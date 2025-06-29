<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
            $table->foreignId('gadget_id')->constrained()->onDelete('cascade'); 
            $table->tinyInteger('rating')->unsigned(); 
            $table->string('comment')->nullable(); 
            $table->timestamps();
            $table->unique(['user_id', 'gadget_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};