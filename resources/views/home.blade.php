@extends('layouts.app')

@section('title', 'Homepage - TechSphere')

@section('content')
    <section class="rekomendasi">
        <h2>Rekomendasi</h2>
        <div class="produk-container">
            @foreach($recommendedGadgets as $gadget)
                <div class="produk">
                    <div class="produk-box">
                        <img src="{{ asset('pict/' . $gadget->image) }}">
                    </div>
                    <p class="product-name-rec">{{ $gadget->name }}</p>
                    @auth
                        <a href="{{ route('gadgets.show', $gadget->slug) }}" class="lihat-detail">Lihat Detail</a>
                    @else
                        <a href="{{ route('login') }}" class="lihat-detail">Lihat Detail</a>
                    @endauth
                </div>
            @endforeach
        </div>
    </section>

    <div class="komen">
        <h2>Komentar</h2>

        @auth

        @else

            <p>Silakan <a href="{{ route('login') }}">login</a> untuk memberikan komentar atau rating.</p>
        @endauth
    </div>
@endsection