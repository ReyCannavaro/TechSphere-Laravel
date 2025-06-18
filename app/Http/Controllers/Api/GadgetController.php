<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Gadget;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GadgetController extends Controller
{
    public function index()
    {
        $gadgets = Gadget::with('category')->get();
        return response()->json([
            'status' => 200,
            'message' => 'Gadgets fetched successfully',
            'data' => $gadgets
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:gadgets,slug|max:255',
            'tahun_keluaran' => 'nullable|integer',
            'harga' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png',
            'is_featured' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'message' => 'Validation Error',
                'errors' => $validator->errors()
            ], 422);
        }

        $gambarPath = null;
        if ($request->hasFile('image')) {
            $gambarPath = $request->file('image')->store('gadget-images', 'public');
        }

        $gadget = Gadget::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => $request->slug,
            'tahun_keluaran' => $request->tahun_keluaran,
            'harga' => $request->harga,
            'description' => $request->description,
            'image' => $gambarPath,
            'is_featured' => $request->is_featured ?? false,
        ]);

        return response()->json([
            'status' => 201,
            'message' => 'Gadget created successfully',
            'data' => $gadget
        ], 201);
    }

    public function show(Request $request)
    {
        $id = $request->query('id');

        if (!$id) {
            return response()->json([
                'status' => 400,
                'message' => 'Parameter id is required'
            ], 400);
        }

        $gadget = Gadget::with('category')->find($id);

        if (!$gadget) {
            return response()->json([
                'status' => 404,
                'message' => 'Gadget not found'
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Gadget fetched successfully',
            'data' => $gadget
        ]);
    }

    public function update(Request $request)
    {
        $id = $request->query('id');

        if (!$id) {
            return response()->json([
                'status' => 400,
                'message' => 'Parameter id is required'
            ], 400);
        }
        $gadget = Gadget::find($id);

        if (!$gadget) {
            return response()->json([
                'status' => 404,
                'message' => 'Gadget not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'category_id' => 'sometimes|required|exists:categories,id',
            'name' => 'sometimes|required|string|max:255',
            'slug' => 'sometimes|required|string|unique:gadgets,slug,' . $id . '|max:255',
            'tahun_keluaran' => 'nullable|integer',
            'harga' => 'sometimes|required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png',
            'is_featured' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'message' => 'Validation Error',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $request->only([
            'category_id', 'name', 'slug', 'tahun_keluaran', 'harga', 'description', 'is_featured'
        ]);

        if ($request->hasFile('image')) {
            $gambarPath = $request->file('image')->store('gadget-images', 'public');
            $data['image'] = $gambarPath;
        }

        $gadget->update($data);

        return response()->json([
            'status' => 200,
            'message' => 'Gadget updated successfully',
            'data' => $gadget
        ]);
    }

    public function destroy(Request $request)
    {
        $id = $request->query('id');
        if(!$id) {
            return response()->json([
                'status' => 400,
                'massage' => 'parameter id is required'
            ], 400); 
        }
        $gadget = Gadget::find($id);

        if (!$gadget) {
            return response()->json([
                'status' => 404,
                'message' => 'Gadget not found'
            ], 404);
        }

        $gadget->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Gadget deleted successfully'
        ]);
    }
}
