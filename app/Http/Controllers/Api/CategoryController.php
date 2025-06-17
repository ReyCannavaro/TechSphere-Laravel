<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category; // Import model Category kamu
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the categories.
     * Mengambil semua kategori.
     */
    public function index()
    {
        // Mengambil semua kategori, dan eager-load relasi 'gadgets'
        // Relasi 'gadgets' akan disertakan secara otomatis saat dikonversi ke JSON
        $categories = Category::with('gadgets')->get();

        // Mengembalikan koleksi kategori langsung sebagai JSON
        // Laravel akan otomatis mengkonversi koleksi model ke format JSON
        return response()->json([
            'status' => 'success',
            'message' => 'Data kategori berhasil diambil',
            'data' => $categories
        ]);
    }

    /**
     * Display the specified category.
     * Mengambil satu kategori berdasarkan slug atau ID.
     */
    public function show(string $slug)
    {
        // Mencari kategori berdasarkan 'slug'
        // Jika tidak ditemukan, akan otomatis mengembalikan respons 404
        $category = Category::where('slug', $slug)
                            ->with('gadgets') // Eager-load gadgets untuk kategori tunggal
                            ->firstOrFail();

        // Mengembalikan kategori tunggal langsung sebagai JSON
        return response()->json([
            'status' => 'success',
            'message' => 'Detail kategori berhasil diambil',
            'data' => $category
        ]);
    }

    // Kamu bisa menambahkan metode store, update, delete di sini jika diperlukan
}