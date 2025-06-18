<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User; // Import model User Anda
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * GET /api/v1/users
     */
    public function index()
    {
        // Untuk alasan keamanan, hindari mengembalikan semua data user tanpa paginasi atau otorisasi yang kuat.
        // Ini contoh sederhana. Dalam produksi, Anda mungkin perlu membatasi siapa yang bisa melihat daftar user.
        $users = User::all();
        return response()->json([
            'status' => 200,
            'message' => 'Users fetched successfully',
            'data' => $users->makeHidden(['password', 'remember_token']) // Sembunyikan field sensitif
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * POST /api/v1/users
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8', // 'confirmed' membutuhkan field password_confirmation
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'message' => 'Validation Error',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'status' => 201,
            'message' => 'User created successfully',
            'data' => $user->makeHidden(['password', 'remember_token'])
        ], 201);
    }

    /**
     * Display the specified resource.
     * GET /api/v1/users/{id}
     */
    public function show(Request $request)
    {
        $id = $request->query('id'); // ambil dari query string

        if (!$id) {
            return response()->json([
                'status' => 400,
                'message' => 'User ID is required in query parameters'
            ], 400);
        }
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'status' => 404,
                'message' => 'User not found'
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'message' => 'User fetched successfully',
            'data' => $user->makeHidden(['password', 'remember_token'])
        ]);
    }

    /**
     * Update the specified resource in storage.
     * PUT/PATCH /api/v1/users/{id}
     */
    public function update(Request $request)
    {
        $id = $request->query('id');

        if (!$id) {
            return response()->json([
                'status' => 400,
                'message' => 'User ID is required in query parameters'
            ], 400);
        }

        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'status' => 404,
                'message' => 'User not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            'email' => [
                'sometimes',
                'required',
                'string',
                'email',
                'max:255',
            ],
            'password' => 'nullable|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'message' => 'Validation Error',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $request->only(['name', 'email']);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return response()->json([
            'status' => 200,
            'message' => 'User updated successfully',
            'data' => $user->makeHidden(['password', 'remember_token'])
        ]);
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /api/v1/users/{id}
     */
    public function destroy(Request $request)
    {
        $id = $request->query('id');

        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'status' => 404,
                'message' => 'User not found'
            ], 404);
        }

        $user->delete();

        return response()->json([
            'status' => 200,
            'message' => 'User deleted successfully'
        ]);
    }
}