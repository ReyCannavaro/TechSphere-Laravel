<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Untuk mendapatkan user yang sedang login

class RatingController extends Controller
{

    public function store(Request $request)
    {

        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda harus login untuk memberikan rating.');
        }

        $validated = $request->validate([
            'gadget_id' => 'required|exists:gadgets,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:255',
        ]);

        Rating::create([
            'user_id' => Auth::id(),
            'gadget_id' => $validated['gadget_id'],
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
        ]);

        return redirect()->route('gadgets.show', \App\Models\Gadget::find($validated['gadget_id'])->slug)
                         ->with('success', 'Rating Anda berhasil ditambahkan!');
    }

    // Anda bisa tambahkan method edit, update, destroy untuk rating jika diperlukan untuk admin/user
}