<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Import AuthController yang baru kita buat
use App\Http\Controllers\Api\AuthController;
// Import kontroler lain yang mungkin akan kita buat nanti (untuk Gadget, Category, Rating)
// use App\Http\Controllers\Api\GadgetController;
// use App\Http\Controllers\Api\CategoryController;
// use App\Http\Controllers\Api\RatingController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// --- Public Routes (Tidak memerlukan otentikasi) ---

// Rute untuk registrasi pengguna
Route::post('/register', [AuthController::class, 'register']);

// Rute untuk login pengguna
Route::post('/login', [AuthController::class, 'login']);

// Contoh rute publik untuk mengambil daftar gadget atau detail gadget
// (Anda akan membuat GadgetController dan mengisi metodenya nanti)
// Route::get('/gadgets', [GadgetController::class, 'index']);
// Route::get('/gadgets/{slug}', [GadgetController::class, 'show']);

// Contoh rute publik untuk mengambil daftar kategori
// (Anda akan membuat CategoryController dan mengisi metodenya nanti)
// Route::get('/categories', [CategoryController::class, 'index']);
// Route::get('/categories/{slug}/gadgets', [CategoryController::class, 'showGadgetsByCategory']);


// --- Authenticated Routes (Memerlukan token Sanctum) ---

// Grup rute ini akan dilindungi oleh middleware 'auth:sanctum'.
// Artinya, setiap permintaan ke rute di dalam grup ini harus menyertakan token API yang valid.
Route::middleware('auth:sanctum')->group(function () {
    // Rute untuk mendapatkan detail pengguna yang sedang login
    Route::get('/user', [AuthController::class, 'user']);

    // Rute untuk logout pengguna (menghapus token yang sedang digunakan)
    Route::post('/logout', [AuthController::class, 'logout']);

    // --- Contoh rute yang dilindungi untuk operasi lain ---
    // (Anda akan membuat kontrolernya dan mengisi metodenya nanti)

    // Contoh: Menambah rating baru (hanya user terotentikasi)
    // Route::post('/gadgets/{gadget}/ratings', [RatingController::class, 'store']);

    // Contoh: Memperbarui atau menghapus rating (hanya user yang memiliki rating atau admin)
    // Route::put('/ratings/{rating}', [RatingController::class, 'update']);
    // Route::delete('/ratings/{rating}', [RatingController::class, 'destroy']);

    // Contoh: Rute CRUD untuk Gadget jika hanya admin yang bisa (opsional)
    // Route::post('/gadgets', [GadgetController::class, 'store']);
    // Route::put('/gadgets/{gadget}', [GadgetController::class, 'update']);
    // Route::delete('/gadgets/{gadget}', [GadgetController::class, 'destroy']);
});