{{-- resources/views/user/profile.blade.php --}}

@extends('layouts.app') {{-- Pastikan ini mengarah ke layout utama Anda --}}

@section('title', 'Profil Pengguna')

@section('content')
    <div style="max-width: 800px; margin: 50px auto; padding: 30px; background-color: #fff; border-radius: 15px; box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);">
        <h1 style="font-size: 2.5em; color: #333; margin-bottom: 30px; text-align: center;">Profil Saya</h1>

        <div style="text-align: center; margin-bottom: 40px;">
            @if(Auth::user()->avatar)
                <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Avatar Pengguna" style="width: 120px; height: 120px; border-radius: 50%; object-fit: cover; border: 3px solid #eee;">
            @else
                <img src="{{ asset('pict/avatar-default.png') }}" alt="Avatar Default" style="width: 120px; height: 120px; border-radius: 50%; object-fit: cover; border: 3px solid #eee;">
            @endif
            <h2 style="font-size: 1.8em; color: #555; margin-top: 15px;">{{ Auth::user()->name }}</h2>
            <p style="font-size: 1.1em; color: #777;">{{ Auth::user()->email }}</p>
            <p style="font-size: 0.9em; color: #999;">Bergabung sejak: {{ Auth::user()->created_at->format('d M Y') }}</p>
        </div>

        <div style="text-align: center; margin-top: 50px;">
            <h3 style="font-size: 1.5em; color: #333; margin-bottom: 20px;">Sesi Aktif</h3>
            <form method="POST" action="{{ route('logout') }}" style="display: inline-block;">
                @csrf
                <button type="submit" style="padding: 12px 30px; background-color: #dc3545; color: white; border: none; border-radius: 8px; cursor: pointer; font-size: 1.1em; transition: background-color 0.3s ease;">Logout</button>
            </form>
        </div>
    </div>
@endsection