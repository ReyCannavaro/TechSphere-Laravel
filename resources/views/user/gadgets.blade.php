{{-- resources/views/user/gadgets.blade.php --}}

@extends('layouts.app')

@section('title', 'Semua Gadget - TechSphere')

@section('content')
    <div class="all-gadgets-container">
        <h1 class="page-title">Jelajahi Gadget Terbaru Kami</h1>
        <div class="gadget-filter-section-modern">
            <nav class="filter-categories">
                <a href="{{ route('user.gadgets') }}"
                   class="filter-category-button {{ (!isset($selectedCategorySlug) || $selectedCategorySlug == '') ? 'active' : '' }}">
                    Semua Gadget
                </a>
                @foreach($categories as $cat)
                    <a href="{{ route('user.gadgets', ['category' => $cat->slug]) }}"
                       class="filter-category-button {{ (isset($selectedCategorySlug) && $selectedCategorySlug == $cat->slug) ? 'active' : '' }}">
                        {{ $cat->name }}
                    </a>
                @endforeach
            </nav>
        </div>
        {{-- ========================================================= --}}

        @if ($gadgets->isEmpty())
            <p class="no-gadget-message">Belum ada gadget yang tersedia untuk kategori ini.</p>
        @else
            <div class="gadget-grid">
                @foreach($gadgets as $gadget)
                    <div class="gadget-item">
                        <a href="{{ route('gadgets.show', $gadget->slug) }}" class="gadget-link">
                            <div class="gadget-image-box">
                                <img src="{{ asset('pict/gadget-images/' . $gadget->image) }}" alt="{{ $gadget->name }}">
                            </div>
                            <div class="gadget-info-card">
                                <h3 class="gadget-name">{{ $gadget->name }}</h3>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection

{{-- Styling khusus untuk halaman ini --}}
@section('styles')
<style>
    /* Kontainer Utama */
    .all-gadgets-container {
        max-width: 1200px;
        margin: 30px auto;
        margin-top: 10px;
        padding: 40px; /* Padding lebih besar */
        background-color: #fcfcfc; /* Warna background lebih lembut */
        border-radius: 20px; /* Lebih membulat */
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08); /* Shadow lebih menonjol */
    }

    .page-title {
        font-size: 3em; /* Ukuran judul lebih besar */
        font-weight: 700;
        color: #2c3e50; /* Warna judul lebih gelap */
        margin-bottom: 50px; /* Jarak bawah lebih besar */
        text-align: center;
        letter-spacing: -0.5px;
    }

    /* Styling untuk bagian filter modern */
    .gadget-filter-section-modern {
        margin-bottom: 50px; /* Jarak bawah lebih besar */
        text-align: center; /* Pusatkan tombol kategori */
    }

    .filter-categories {
        display: inline-flex; /* Agar tombol berjajar horizontal */
        flex-wrap: wrap; /* Izinkan wrap ke baris baru jika terlalu banyak */
        gap: 15px; /* Jarak antar tombol */
        background-color: #e9ecef; /* Background untuk area tombol filter */
        padding: 12px 25px;
        border-radius: 30px; /* Bentuk kapsul */
        box-shadow: inset 0 2px 5px rgba(0, 0, 0, 0.05); /* Sedikit efek 3D */
    }

    .filter-category-button {
        display: block;
        padding: 10px 22px;
        border-radius: 25px; /* Bentuk kapsul untuk tombol */
        background-color: transparent;
        color: #495057; /* Warna teks default */
        text-decoration: none;
        font-weight: 600;
        font-size: 1.05em;
        transition: all 0.3s ease;
        white-space: nowrap; /* Mencegah teks patah baris */
    }

    .filter-category-button:hover {
        background-color: #ced4da;
        color: #212529;
    }

    .filter-category-button.active {
        background-color: #212A3E; /* Warna biru untuk yang aktif */
        color: white;
        box-shadow: 0 4px 10px rgba(0, 123, 255, 0.2); /* Shadow untuk yang aktif */
    }

    .filter-category-button.active:hover {
        background-color: #394867; /* Darker blue on hover for active */
    }


    .no-gadget-message {
        text-align: center;
        color: #777;
        font-size: 1.3em;
        padding: 50px 0;
        background-color: #fff;
        border-radius: 15px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
        margin-top: 30px;
    }

    /* Grid Gadget */
    .gadget-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); /* Ukuran kartu lebih fleksibel */
        gap: 35px; /* Jarak antar kartu lebih besar */
        justify-content: center;
        padding-top: 20px; /* Sedikit padding atas dari filter */
    }

    .gadget-item {
        background-color: #ffffff; /* Latar belakang putih */
        border-radius: 15px; /* Sudut lebih membulat */
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.09); /* Shadow yang lebih lembut dan menonjol */
        text-align: center;
        transition: transform 0.4s cubic-bezier(0.2, 0.8, 0.2, 1), box-shadow 0.4s cubic-bezier(0.2, 0.8, 0.2, 1);
        display: flex;
        flex-direction: column;
        overflow: hidden; /* Pastikan tidak ada konten yang keluar */
    }

    .gadget-item:hover {
        transform: translateY(-8px); /* Efek melayang lebih jauh */
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15); /* Shadow lebih gelap saat hover */
    }

    .gadget-link {
        text-decoration: none;
        color: inherit;
        display: flex;
        flex-direction: column;
        height: 100%; /* Agar link membungkus seluruh item */
    }

    .gadget-image-box {
        width: 100%;
        height: 220px; /* Tinggi gambar sedikit lebih besar */
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #f5f5f5; /* Background abu-abu terang */
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
        overflow: hidden;
        padding: 15px; /* Padding di dalam image box */
    }

    .gadget-image-box img {
        max-width: 95%; /* Gambar sedikit lebih kecil agar ada ruang */
        max-height: 95%;
        object-fit: contain;
        transition: transform 0.3s ease; /* Transisi untuk zoom */
    }

    .gadget-item:hover .gadget-image-box img {
        transform: scale(1.05); /* Efek zoom in saat hover */
    }

    .gadget-info-card {
        padding: 20px 25px;
        text-align: left; /* Teks di dalam kartu rata kiri */
        flex-grow: 1; /* Agar info card mengisi sisa ruang */
        display: flex;
        flex-direction: column;
        justify-content: space-between; /* Menata konten secara vertikal */
    }

    .gadget-name {
        font-size: 1.4em; /* Nama gadget lebih besar */
        font-weight: 700;
        color: #34495e; /* Warna nama lebih gelap */
        margin-bottom: 8px;
        min-height: 2.8em; /* Cukup untuk 2 baris nama */
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        line-height: 1.3;
    }

    .gadget-category {
        font-size: 0.95em;
        color: #888; /* Warna kategori lebih lembut */
        margin-bottom: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .gadget-price {
        font-size: 1.5em; /* Harga lebih besar dan menonjol */
        font-weight: 800; /* Lebih tebal */
        color: #28a745; /* Warna hijau menarik */
        margin-top: auto; /* Dorong harga ke bawah */
    }

    /* Tombol Detail (dihapus dari dalam kartu, karena seluruh kartu bisa diklik) */
    /* .gadget-detail-button { ... } */

    /* Media Queries untuk Responsif */
    @media (max-width: 992px) {
        .all-gadgets-container {
            padding: 30px;
        }
        .page-title {
            font-size: 2.5em;
        }
        .filter-categories {
            gap: 10px;
            padding: 10px 15px;
        }
        .filter-category-button {
            padding: 8px 18px;
            font-size: 1em;
        }
        .gadget-grid {
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 25px;
        }
        .gadget-image-box {
            height: 180px;
        }
        .gadget-name {
            font-size: 1.2em;
        }
        .gadget-price {
            font-size: 1.3em;
        }
    }

    @media (max-width: 768px) {
        .all-gadgets-container {
            padding: 20px;
            margin: 20px auto;
        }
        .page-title {
            font-size: 2em;
            margin-bottom: 30px;
        }
        .filter-categories {
            flex-direction: column; /* Tombol filter menumpuk di mobile */
            width: 100%;
            padding: 15px;
            border-radius: 15px;
        }
        .filter-category-button {
            width: 100%; /* Tombol filter ambil lebar penuh */
            text-align: center;
        }
        .gadget-grid {
            grid-template-columns: 1fr; /* Satu kolom di mobile */
            gap: 20px;
        }
        .gadget-item {
            flex-direction: row; /* Kartu jadi horizontal di mobile */
            align-items: center;
            padding: 15px;
        }
        .gadget-image-box {
            width: 120px; /* Lebar gambar tetap */
            height: 120px; /* Tinggi gambar tetap */
            flex-shrink: 0; /* Jangan menyusut */
            border-radius: 10px; /* Kotak gambar lebih kecil */
            margin-bottom: 0;
            margin-right: 15px;
        }
        .gadget-info-card {
            padding: 0;
            text-align: left;
        }
        .gadget-name {
            font-size: 1.1em;
            min-height: unset; /* Reset min-height */
            -webkit-line-clamp: 2; /* Batasi 2 baris */
        }
        .gadget-category {
            font-size: 0.85em;
            margin-bottom: 5px;
        }
        .gadget-price {
            font-size: 1.2em;
        }
    }
</style>
@endsection