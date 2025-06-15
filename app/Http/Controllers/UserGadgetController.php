<?php

namespace App\Http\Controllers;

use App\Models\Gadget;
use App\Models\Category;
use Illuminate\Http\Request;

class UserGadgetController extends Controller
{
    /**
     * Menampilkan daftar semua gadget dengan fitur filter kategori.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        // Ambil semua kategori untuk ditampilkan di filter dropdown
        $categories = Category::all();

        // Inisialisasi $selectedCategorySlug dengan nilai default (misalnya string kosong)
        // Ini memastikan variabel selalu ada, bahkan jika tidak ada filter kategori
        $selectedCategorySlug = ''; 

        // Mulai query untuk gadget
        $query = Gadget::with('category');

        // Jika ada filter kategori dari request
        if ($request->has('category') && $request->category != '') {
            $selectedCategorySlug = $request->category; // Variabel ini sekarang didefinisikan di luar scope if
            // Temukan kategori berdasarkan slug
            $selectedCategory = Category::where('slug', $selectedCategorySlug)->first();

            if ($selectedCategory) {
                // Filter gadget berdasarkan category_id
                $query->where('category_id', $selectedCategory->id);
            }
        }

        // Ambil gadget yang sudah difilter atau semua gadget jika tidak ada filter
        $gadgets = $query->latest()->get();

        // Teruskan data ke view
        return view('user.gadgets', compact('gadgets', 'categories', 'selectedCategorySlug'));
    }

    /**
     * Menampilkan daftar gadget berdasarkan kategori (ini adalah method yang sudah ada).
     * Mungkin bisa di-refactor agar 'index' saja yang menangani semua filtering,
     * tapi untuk saat ini biarkan terpisah jika ada kebutuhan rute /categories/{slug} yang spesifik.
     *
     * @param  string  $category_slug
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function byCategory(string $category_slug)
    {
        $category = Category::where('slug', $category_slug)->firstOrFail();

        // Mengambil gadget yang terkait dengan kategori tersebut
        $gadgets = $category->gadgets()->latest()->get();

        // Ambil juga semua kategori untuk filter dropdown di halaman ini
        $categories = Category::all();
        $selectedCategorySlug = $category_slug; // Ini sudah terdefinisi dari parameter fungsi

        return view('user.gadgets', compact('gadgets', 'category', 'categories', 'selectedCategorySlug'));
    }
}