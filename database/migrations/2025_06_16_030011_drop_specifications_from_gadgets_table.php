<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('gadgets', function (Blueprint $table) {
            $table->dropColumn('specifications');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gadgets', function (Blueprint $table) {
            // Saat rollback, tambahkan kembali kolom specifications sebagai TEXT
            // (sesuai definisi awal Anda)
            $table->text('specifications')->nullable();
        });
    }
};