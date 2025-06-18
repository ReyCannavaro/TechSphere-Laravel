<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'TechSphere')</title>
    {{-- Mengimpor font Poppins dan Kalnia dari Google Fonts --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Kalnia:wght@700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    {{-- Link ke file CSS utama kita --}}
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    @yield('styles')
</head>
<body>
    {{-- ======= NAVBAR ======= --}}
<header class="navbar">
    <a href="{{ route('home') }}" class="logo">TechSphere</a> {{-- Link logo ke homepage --}}
    <nav>
        <ul class="nav-links">
            <li><a href="{{ route('home') }}">Home</a></li> {{-- Link Home ke homepage (menggunakan nama rute 'home') --}}
            <li><a href="{{ route('user.gadgets') }}">Gadgets</a></li> {{-- <-- UBAH INI: Arahkan ke rute 'user.gadgets' --}}
            <li><a href="{{ route('user.about') }}">About Us</a></li> {{-- Link About Us --}}
        </ul>
    </nav>
    <div class="nav-icons">
        <input type="text" placeholder="Search something..." class="search-bar">
        {{-- Ikon Profil dan Autentikasi --}}
        @auth
            {{-- Jika pengguna sudah login, tampilkan ikon profil yang mengarah ke halaman profil --}}
            <a href="{{ route('user.profile') }}" class="icon-link">
                <img src="{{ asset('pict/profile-icon.png') }}" alt="Profile Icon" style="width: 24px; height: 24px;">
            </a>
            {{-- Tombol Logout DIHAPUS dari navbar utama --}}
        @else
            {{-- Jika pengguna belum login, tampilkan tombol Login dan Register --}}
            <a href="{{ route('login') }}" class="btn-primary">Login</a>
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="btn-secondary">Register</a>
            @endif
        @endauth
    </div>
</header>

    {{-- ======= KONTEN UTAMA ======= --}}
    <main class="main-content">
        @yield('content')
    </main>

    {{-- ======= FOOTER ======= --}}
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section about">
                <h2 class="logo-footer">TechSphere.</h2>
                <p>Platform terpercaya yang menyajikan informasi lengkap, akurat, dan terbaru tentang alat komunikasi seperti smartphone, laptop, PC, dan tablet.</p>
                <div class="social-icons">
                    <a href="#"><img src="{{ asset('pict/twitter-icon.png') }}" alt="Twitter"></a>
                    <a href="#"><img src="{{ asset('pict/facebook-icon.png') }}" alt="Facebook"></a>
                    <a href="#"><img src="{{ asset('pict/instagram-icon.avif') }}" alt="Instagram"></a>
                    <a href="#"><img src="{{ asset('pict/linkedin-icon.webp') }}" alt="LinkedIn"></a>
                </div>
            </div>
            <div class="footer-section links">
                <h3>Shop</h3>
                <ul>
                    {{-- Link kategori footer (sesuai rute user.category) --}}
                    <li><a href="{{ route('user.category', 'mobile') }}">Mobile</a></li>
                    <li><a href="{{ route('user.category', 'laptop') }}">Laptop</a></li>
                    <li><a href="{{ route('user.category', 'pc') }}">PC</a></li>
                    <li><a href="{{ route('user.category', 'tablet') }}">Tablet</a></li>
                </ul>
            </div>
            <div class="footer-section contact">
                <h3>Contact</h3>
                <p>+62 821 3953 1132</p>
                <p>+62 857 8561 4715</p>
            </div>
            <div class="footer-section address">
                <h3>Address</h3>
                <p>Sidoarjo, kab. Sidoarjo,</p>
                <p>Jawa Timur, Indonesia</p>
            </div>
        </div>
    </footer>

    @yield('scripts')
</body>
</html>