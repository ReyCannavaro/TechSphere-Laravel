<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PraloginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GadgetController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\UserGadgetController;
use App\Http\Controllers\AdminController;
// use App\Http\Controllers\CategoriesController; // Ini sudah dikomentari sebelumnya
// use App\Http\Controllers\RatingsController as AdminRatingsController; // <-- BARIS INI DIHAPUS/DIKOMENTARI

use App\Http\Controllers\ProfileController as BreezeProfileController;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// ==================== PUBLIC / UNAUTHENTICATED ROUTES ==================== //

// Homepage (aksesibel untuk semua user, login/belum)
Route::get('/', [HomeController::class, 'index'])->name('home');

// Halaman Pralogin
Route::get('/pralogin', [PraloginController::class, 'pralogin'])->name('pralogin');

// Halaman detail gadget spesifik (aksesibel untuk semua user, login/belum)
// Form rating hanya akan tampil jika user sudah login (diatur di view gadgets.show)
Route::get('/gadgets/{slug}', [GadgetController::class, 'show'])->name('gadgets.show');

// ==================== AUTHENTICATION ROUTES (Breeze) ==================== //
// Ini akan mengimpor rute login, register, logout, forgot password, reset password, verify email dari Breeze.
require __DIR__.'/auth.php';

// ==================== GLOBAL AUTHENTICATED ROUTES ==================== //
// Rute yang memerlukan autentikasi
Route::middleware(['auth'])->group(function () {

    // Rute untuk menyimpan rating (HANYA UNTUK USER YANG SUDAH LOGIN)
    Route::post('/ratings', [RatingController::class, 'store'])->name('ratings.store');

    // --- Rute profil bawaan Breeze yang tidak diberi prefix 'user.' ---
    // Pertahankan rute delete akun Breeze jika Anda tidak ingin mengimplementasikannya sendiri.
    Route::delete('/profile', [BreezeProfileController::class, 'destroy'])->name('profile.destroy');

});


// ==================== AUTHENTICATED USER-SPECIFIC ROUTES ==================== //
// Rute untuk user biasa setelah login, dengan prefix 'user'
Route::middleware(['auth'])->prefix('user')->name('user.')->group(function () {

    // Halaman profil pengguna (menampilkan data)
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');

    // Halaman daftar semua gadget untuk user (jika ada halaman terpisah dari homepage)
    Route::get('/gadgets', [UserGadgetController::class, 'index'])->name('gadgets');

    // Halaman daftar gadget berdasarkan kategori
    Route::get('/categories/{category_slug}', [UserGadgetController::class, 'byCategory'])->name('category');

    // Halaman "About Us"
    Route::get('/about', function () {
        $categories = \App\Models\Category::all();
        return view('user.about', compact('categories'));
    })->name('about');

});


// ==================== ADMIN ROUTES ==================== //
// Rute untuk administrator, dilindungi oleh middleware 'admin'
// Seluruh CRUD untuk Gadget, Kategori, dan Rating kini ditangani oleh Filament
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard admin (nama rute tetap 'dashboard' dengan prefix 'admin.')
    // Jika Anda ingin menggunakan Dashboard bawaan Filament, Anda bisa menghapus baris ini
    // dan biarkan Filament secara otomatis menangani dashboard utamanya.
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    // CATATAN PENTING:
    // Semua rute CRUD untuk Gadget, Kategori, dan Rating sekarang ditangani oleh Filament Resources.
    // Jadi, tidak perlu ada definisi Route::resource() atau Route::get/post/put/delete() manual di sini.
    // Contoh yang sebelumnya ada dan sudah dihapus/dikomentari:
    // Route::resource('categories', CategoriesController::class);
    // Route::get('/ratings', [AdminRatingsController::class, 'index'])->name('ratings.index');
});