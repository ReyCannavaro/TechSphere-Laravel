<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category; // Import model Category kamu
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use function Laravel\Prompts\text;

class CategoryController extends Controller
{
    /**
     * Display a listing of the categories.
     * Mengambil semua kategori.
     */
    public function index()
    {
        $categories = Category::with('gadgets')->get();

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

    /**
     * Store a newly created category in storage.
     * Menyimpan kategori baru ke database.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $category = Category::create([
                'name' => $request->name,
                'slug' => $request->slug,
                'description' => $request->description
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Kategori berhasil ditambahkan',
                'data' => $category
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menambahkan kategori',
                'details' => $e->getMessage()
            ], 500);
        }
    }


    /**
     * Update the specified category in storage.
     * Memperbarui kategori yang ada.
     */
    public function update(Request $request, string $slug)
    {
        // Mencari kategori berdasarkan slug
        $category = Category::where('slug', $slug)->first();

        // Jika kategori tidak ditemukan, kembalikan respons 404
        if (!$category) {
            return response()->json([
                'status' => 'error',
                'message' => 'Kategori tidak ditemukan'
            ], 404);
        }

        // Mendefinisikan aturan validasi untuk input
        // 'unique:categories,name,' . $category->id => Pastikan nama unik kecuali untuk kategori ini sendiri
        // 'unique:categories,slug,' . $category->id => Pastikan slug unik kecuali untuk kategori ini sendiri
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'slug' => 'required|string|max:255|unique:categories,slug,' . $category->id,
            // Tambahkan aturan validasi lain jika ada kolom lain di tabel kategori
        ]);

        // Cek apakah validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Memperbarui atribut kategori
            $category->update([
                'name' => $request->name,
                'slug' => $request->slug,
                // Pastikan untuk menambahkan kolom lain jika ada
            ]);

            // Mengembalikan respons sukses dengan data kategori yang diperbarui
            return response()->json([
                'status' => 'success',
                'message' => 'Kategori berhasil diperbarui',
                'data' => $category
            ]);
        } catch (\Exception $e) {
            // Menangani kesalahan jika terjadi saat memperbarui data
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal memperbarui kategori',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified category from storage.
     * Menghapus kategori dari database.
     */
    public function destroy(string $slug)
    {
        // Mencari kategori berdasarkan slug
        $category = Category::where('slug', $slug)->first();

        // Jika kategori tidak ditemukan, kembalikan respons 404
        if (!$category) {
            return response()->json([
                'status' => 'error',
                'message' => 'Kategori tidak ditemukan'
            ], 404);
        }

        try {
            // Menghapus kategori
            $category->delete();

            // Mengembalikan respons sukses tanpa konten (204 No Content)
            return response()->json([
                'status' => 'success',
                'message' => 'Kategori berhasil dihapus'
            ], 204); // Kode status 204 untuk penghapusan berhasil tanpa konten
        } catch (\Exception $e) {
            // Menangani kesalahan jika terjadi saat menghapus data
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus kategori',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    // ... //
}