<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\GadgetController;
use App\Http\Controllers\Api\CategoryController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/category', [CategoryController::class, 'index']);
Route::get('/category/{slug}', [CategoryController::class, 'show']);
Route::post('/category', [CategoryController::class, 'store']);
Route::put('/category/{slug}', [CategoryController::class, 'update']);
Route::delete('/category/{slug}', [CategoryController::class, 'destroy']);

Route::get('gadgets', [GadgetController::class, 'index']);
Route::post('gadgets', [GadgetController::class, 'store']);
Route::get('gadgets', [GadgetController::class, 'show']);
Route::put('gadgets', [GadgetController::class, 'update']);
Route::delete('gadgets', [GadgetController::class, 'destroy']);