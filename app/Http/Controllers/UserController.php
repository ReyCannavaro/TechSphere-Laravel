<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Hash; // Hapus import ini
// use Illuminate\Validation\Rules\Password; // Hapus import ini

// use App\Http\Requests\ProfileUpdateRequest; // Hapus import ini

class UserController extends Controller
{
    /**
     * Menampilkan halaman profil pengguna.
     * Ini adalah satu-satunya method yang akan kita pertahankan di sini.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function profile()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }

    // Hapus atau komentari method edit(), update(), dan updatePassword()
    /*
    public function edit(Request $request)
    {
        return view('user.profile-edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(ProfileUpdateRequest $request)
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return redirect()->route('user.profile.edit')->with('status', 'profile-updated');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'string', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $request->user()->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('user.profile.edit')->with('status', 'password-updated');
    }
    */
}