@extends('layouts.app')

@section('title', 'Tentang TechSphere')

@section('content')
    <div class="techsphere-about-wrapper">

        {{-- Section: Hero / About Our Company --}}
        <section class="about-hero-section">
            <div class="hero-content-area">
                <h1 class="hero-title">About Our Company</h1>
                <div class="techsphere-logo-text">
                    TechSphere.
                    <span class="logo-dot"></span>
                </div>
                <p class="hero-description">
                    Menghadirkan inovasi teknologi terkini dan informasi gadget terpercaya langsung ke genggaman Anda.
                </p>
            </div>
            <div class="hero-image-circle">
                {{-- Background image will be set via CSS or dynamic Blade asset --}}
                <img src="{{ asset('pict/hero-about.pn') }}" alt="Innovation in Technology" class="hero-circle-img">
                <div class="circle-overlay"></div>
            </div>
        </section>

        {{-- Section: What is TechSphere? --}}
        <section class="what-is-techsphere-section">
            <div class="geometric-pattern">
                {{-- Three triangular shapes --}}
                <div class="triangle triangle-1"></div>
                <div class="triangle triangle-2"></div>
                <div class="triangle triangle-3"></div>
            </div>
            <div class="what-is-content">
                <h2 class="section-heading-dark">Apa itu TechSphere?</h2>
                <p>
                    TechSphere adalah platform tepercaya yang menyajikan informasi akurat, ulasan mendalam, dan spesifikasi lengkap untuk berbagai kategori gadget, mulai dari smartphone, laptop, PC, hingga tablet. Kami hadir untuk memudahkan pengguna menemukan dan membandingkan perangkat impian mereka melalui ulasan mendalam, perbandingan fitur, dan tips penggunaan yang relevan.
                </p>
                <p>
                    Dengan fokus pada transparansi dan objektivitas, TechSphere menjadi jembatan utama antara inovasi gadget terbaru dan kemajuan teknologi komunitas. Kami adalah panduan terpercaya Anda di dunia gadget yang dinamis.
                </p>
            </div>
        </section>

        {{-- Section: Our Partners --}}
        <section class="partners-section">
            <h2 class="section-heading-light">Our Partner</h2>
            <div class="partners-logo-grid">
                <div class="partner-logo-item"><img src="{{ asset('pict/partners/xiaomi-logo.png') }}" alt="Xiaomi"></div>
                <div class="partner-logo-item"><img src="{{ asset('pict/partners/apple-logo.svg') }}" alt="Apple"></div>
                <div class="partner-logo-item"><img src="{{ asset('pict/partners/samsung-logo.png') }}" alt="Samsung"></div>
                <div class="partner-logo-item"><img src="{{ asset('pict/partners/huawei-logo.png') }}" alt="Huawei"></div>
                <div class="partner-logo-item"><img src="{{ asset('pict/partners/asus-logo.png') }}" alt="Asus"></div>
                <div class="partner-logo-item"><img src="{{ asset('pict/partners/lenovo-logo.png') }}" alt="Lenovo"></div>
                <div class="partner-logo-item"><img src="{{ asset('pict/partners/vivo-logo.png') }}" alt="Vivo"></div>
                <div class="partner-logo-item"><img src="{{ asset('pict/partners/msi-logo.png') }}" alt="MSI"></div>
                <div class="partner-logo-item"><img src="{{ asset('pict/partners/intel-logo.png') }}" alt="Intel"></div>
                <div class="partner-logo-item"><img src="{{ asset('pict/partners/ryzen-logo.svg') }}" alt="Ryzen"></div>
                <div class="partner-logo-item"><img src="{{ asset('pict/partners/predator-logo.png') }}" alt="Predator"></div>
                <div class="partner-logo-item"><img src="{{ asset('pict/partners/baseus-logo.webp') }}" alt="Baseus"></div>
                <div class="partner-logo-item"><img src="{{ asset('pict/partners/nvidia-logo.png') }}" alt="Nvidia"></div>
                <div class="partner-logo-item"><img src="{{ asset('pict/partners/microsoft-logo.png') }}" alt="Microsoft"></div>
                <div class="partner-logo-item"><img src="{{ asset('pict/partners/logitech-logo.png') }}" alt="Logitech"></div>
            </div>
        </section>

        {{-- Section: Meet Our Team --}}
        <section class="team-section">
            <h2 class="section-heading-dark">Meet With Our Team</h2>
            <div class="team-cards-grid">
                <div class="team-member-card animate-fade-in-up delay-0">
                    <div class="member-photo-wrapper">
                        <img src="{{ asset('pict/team/larissa.jpeg') }}" alt="Larissa Paulina Christmas H." class="member-photo">
                    </div>
                    <h3 class="member-name">Larissa Paulina Christmas H.</h3>
                    <p class="member-role">Front End Developer</p>
                    <div class="social-icons">
                        <a href="#" class="social-icon-link"><i class="fab fa-linkedin"></i></a>
                        <a href="#" class="social-icon-link"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-icon-link"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                <div class="team-member-card animate-fade-in-up delay-1">
                    <div class="member-photo-wrapper">
                        <img src="{{ asset('pict/team/rey.jpeg') }}" alt="Reyjuno Al Cannavaro" class="member-photo">
                    </div>
                    <h3 class="member-name">Reyjuno Al Cannavaro</h3>
                    <p class="member-role">Back End Developer</p>
                    <div class="social-icons">
                        <a href="#" class="social-icon-link"><i class="fab fa-linkedin"></i></a>
                        <a href="#" class="social-icon-link"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-icon-link"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                {{-- Add more team members as needed --}}
            </div>
        </section>

        {{-- Section: Call to Action / Footer Section --}}
        <section class="cta-bottom-section">
            <h2 class="cta-bottom-heading">www.techsphere.com</h2>
            <p class="cta-bottom-tagline">Jelajahi dunia gadget tanpa batas bersama TechSphere.</p>
            <a href="{{ route('home') }}" class="cta-bottom-button">Lihat Gadget Terbaru</a>
        </section>

    </div>
@endsection

@section('styles')
<style>
    /* Global Styles & Variables */
    :root {
        --color-bg-primary: #F1F6F9; /* Sangat terang, mirip putih keabu-abuan */
        --color-dark-blue: #394867;  /* Biru gelap keabu-abuan */
        --color-deep-blue: #212A3E; /* Biru sangat gelap / hampir hitam kebiruan */
        --color-light-blue: #9BA4B5; /* Abu-abu kebiruan sedang */
        --color-white: #FFFFFF;
        --color-text-light: #6C757D; /* Teks paragraf umum */

        --shadow-light: rgba(0, 0, 0, 0.05);
        --shadow-medium: rgba(0, 0, 0, 0.12);
        --shadow-strong: rgba(0, 0, 0, 0.2);

        --border-radius-large: 20px;
        --border-radius-medium: 12px;
        --border-radius-small: 8px;
    }

    body {
        font-family: 'Poppins', sans-serif; /* Pastikan Poppins diimport di layout utama */
        background-color: var(--color-bg-primary);
        color: var(--color-deep-blue);
        line-height: 1.7;
        overflow-x: hidden; /* Mencegah scroll horizontal dari animasi */
    }

    .techsphere-about-wrapper {
        width: 100%;
        max-width: 1400px; /* Lebar maksimum agar tidak terlalu lebar di layar besar */
        margin: 0 auto;
        background-color: var(--color-bg-primary);
    }

    /* Shared Section Styling */
    section {
        padding: 80px 40px;
        box-sizing: border-box;
    }

    .section-heading-dark, .section-heading-light {
        font-weight: 700;
        margin-bottom: 60px;
        text-align: center;
        position: relative;
        padding-bottom: 15px;
    }
    .section-heading-dark {
        color: var(--color-deep-blue);
        font-size: 3.2em;
    }
    .section-heading-light {
        color: var(--color-dark-blue);
        font-size: 2.8em;
    }

    .section-heading-dark::after, .section-heading-light::after {
        content: '';
        position: absolute;
        left: 50%;
        bottom: 0;
        transform: translateX(-50%);
        width: 80px;
        height: 5px;
        background-color: var(--color-light-blue);
        border-radius: 3px;
    }

    /* --- Hero Section --- */
    .about-hero-section {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 100px 80px;
        background: linear-gradient(135deg, var(--color-white) 0%, var(--color-bg-primary) 100%);
        border-bottom: 1px solid var(--color-light-blue);
        gap: 60px;
        position: relative;
        overflow: hidden; /* For any overflowing elements like subtle animations */
    }

    .hero-content-area {
        flex: 1;
        max-width: 600px;
        z-index: 2; /* Ensure content is above image */
    }

    .hero-title {
        font-size: 1.8em;
        font-weight: 600;
        color: var(--color-light-blue);
        margin-bottom: 15px;
    }

    .techsphere-logo-text {
        font-family: 'Poppins', sans-serif;
        font-size: 5.5em; /* Sangat besar */
        font-weight: 800;
        color: var(--color-dark-blue);
        margin-bottom: 25px;
        position: relative;
        line-height: 1;
    }

    .logo-dot {
        position: absolute;
        bottom: 15px;
        right: -10px; /* Sesuaikan posisi dot */
        width: 20px;
        height: 20px;
        background-color: var(--color-light-blue);
        border-radius: 50%;
    }

    .hero-description {
        font-size: 1.25em;
        line-height: 1.8;
        color: var(--color-text-light);
        max-width: 500px;
    }

    .hero-image-circle {
        flex: 1;
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
        width: 450px; /* Ukuran lingkaran */
        height: 450px;
        border-radius: 50%;
        background-color: var(--color-deep-blue); /* Background jika gambar tidak load */
        overflow: hidden;
        box-shadow: 0 20px 50px var(--shadow-strong);
        transition: transform 0.5s ease-out;
        z-index: 1;
    }
    .hero-image-circle:hover {
        transform: scale(1.02);
    }

    .hero-circle-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        opacity: 0.8; /* Sedikit transparan agar overlay lebih terlihat */
        transition: opacity 0.3s ease;
    }

    .circle-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(45deg, rgba(33, 42, 62, 0.6), rgba(57, 72, 103, 0.4)); /* Gradien overlay */
        border-radius: 50%;
        z-index: 1;
    }

    /* --- What is TechSphere Section --- */
    .what-is-techsphere-section {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 60px;
        padding: 80px 40px;
        background-color: var(--color-white);
        border-bottom: 1px solid var(--color-bg-primary);
        position: relative;
        overflow: hidden;
    }

    .geometric-pattern {
        position: relative;
        flex: 0 0 400px; /* Ukuran tetap untuk pola */
        height: 400px;
        display: flex;
        justify-content: center;
        align-items: center;
        transform: rotate(-10deg); /* Sedikit rotasi */
        opacity: 0.7;
    }

    .triangle {
        position: absolute;
        width: 0;
        height: 0;
        border-left: 100px solid transparent;
        border-right: 100px solid transparent;
        border-bottom: 180px solid var(--color-light-blue); /* Warna triangle */
        transition: transform 0.8s ease-out;
    }
    .triangle-1 {
        transform: translate(-100px, -50px) rotate(30deg);
        border-bottom-color: var(--color-dark-blue);
        opacity: 0.8;
    }
    .triangle-2 {
        transform: translate(50px, 0px) rotate(-20deg);
        border-bottom-color: var(--color-light-blue);
        opacity: 0.6;
    }
    .triangle-3 {
        transform: translate(-20px, 100px) rotate(60deg);
        border-bottom-color: var(--color-dark-blue);
        opacity: 0.9;
    }

    /* Animate triangles on scroll */
    .what-is-techsphere-section.in-view .triangle-1 { transform: translate(-100px, -50px) rotate(30deg) scale(1.05); }
    .what-is-techsphere-section.in-view .triangle-2 { transform: translate(50px, 0px) rotate(-20deg) scale(1.05); }
    .what-is-techsphere-section.in-view .triangle-3 { transform: translate(-20px, 100px) rotate(60deg) scale(1.05); }


    .what-is-content {
        flex: 2;
        max-width: 700px;
    }

    .what-is-content p {
        font-size: 1.1em;
        line-height: 1.8;
        color: var(--color-text-light);
        margin-bottom: 20px;
        text-align: justify;
    }

    /* --- Partners Section --- */
    .partners-section {
        background-color: var(--color-bg-primary);
        text-align: center;
    }

    .partners-logo-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
        gap: 40px;
        justify-items: center;
        align-items: center;
        max-width: 900px;
        margin: 0 auto;
    }

    .partner-logo-item {
        padding: 15px;
        background-color: var(--color-white);
        border-radius: var(--border-radius-medium);
        box-shadow: 0 8px 25px var(--shadow-light);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        display: flex; /* For vertical centering of image */
        justify-content: center;
        align-items: center;
        height: 80px; /* Fixed height for consistent look */
        width: 100%; /* Fill grid cell */
    }
    .partner-logo-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 35px var(--shadow-medium);
    }
    .partner-logo-item img {
        max-width: 80%;
        max-height: 50px;
        object-fit: contain;
        filter: grayscale(80%) brightness(1.1); /* Slightly desaturate */
        transition: filter 0.3s ease;
    }
    .partner-logo-item:hover img {
        filter: grayscale(0%) brightness(1); /* Full color on hover */
    }

    /* --- Team Section --- */
    .team-section {
        background-color: var(--color-white);
        text-align: center;
        padding-top: 80px;
        padding-bottom: 100px;
    }

    .team-cards-grid {
        display: flex; /* Using flex for central alignment */
        justify-content: center;
        flex-wrap: wrap; /* Allow wrapping */
        gap: 50px; /* Space between cards */
        max-width: 1000px;
        margin: 0 auto;
    }

    .team-member-card {
        background-color: var(--color-bg-primary);
        padding: 30px;
        border-radius: var(--border-radius-large);
        box-shadow: 0 15px 40px var(--shadow-light);
        width: 320px; /* Fixed width for consistency */
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        transition: transform 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94), box-shadow 0.4s ease; /* Easing function for smoother animation */
    }
    .team-member-card:hover {
        transform: translateY(-15px);
        box-shadow: 0 25px 60px var(--shadow-medium);
    }

    .member-photo-wrapper {
        width: 180px;
        height: 180px;
        border-radius: 50%;
        overflow: hidden;
        border: 6px solid var(--color-light-blue); /* Stronger border */
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
        margin-bottom: 25px;
        background-color: var(--color-white);
        display: flex;
        justify-content: center;
        align-items: center;
        flex-shrink: 0; /* Prevent shrinking */
    }
    .member-photo {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transform: scale(1.05); /* Slightly zoomed in */
    }

    .member-name {
        font-size: 1.8em;
        font-weight: 700;
        color: var(--color-dark-blue);
        margin-bottom: 8px;
    }

    .member-role {
        font-size: 1.1em;
        color: var(--color-text-light);
        margin-bottom: 20px;
        font-weight: 500;
    }

    .social-icons {
        display: flex;
        gap: 15px;
    }
    .social-icon-link {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        width: 45px;
        height: 45px;
        background-color: var(--color-white);
        color: var(--color-light-blue);
        border-radius: 50%;
        font-size: 1.3em;
        transition: background-color 0.3s ease, color 0.3s ease, transform 0.2s ease;
        box-shadow: 0 4px 15px var(--shadow-light);
    }
    .social-icon-link:hover {
        background-color: var(--color-dark-blue);
        color: var(--color-white);
        transform: translateY(-3px);
    }

    /* --- CTA Bottom Section --- */
    .cta-bottom-section {
        background-color: var(--color-deep-blue); /* Warna paling gelap */
        color: var(--color-white);
        text-align: center;
        padding: 100px 40px;
        border-top-left-radius: var(--border-radius-large);
        border-top-right-radius: var(--border-radius-large);
        margin-top: 60px;
        box-shadow: 0 -10px 40px var(--shadow-strong);
    }

    .cta-bottom-heading {
        font-size: 3.5em;
        font-weight: 800;
        margin-bottom: 20px;
        letter-spacing: 1px;
        text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
    }

    .cta-bottom-tagline {
        font-size: 1.5em;
        margin-bottom: 40px;
        opacity: 0.9;
        font-weight: 300;
    }

    .cta-bottom-button {
        display: inline-block;
        background-color: var(--color-light-blue); /* Warna accent */
        color: var(--color-white);
        padding: 18px 45px;
        border-radius: var(--border-radius-medium);
        text-decoration: none;
        font-size: 1.3em;
        font-weight: 600;
        transition: background-color 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
    }

    .cta-bottom-button:hover {
        background-color: var(--color-dark-blue); /* Hover ke warna primary */
        transform: translateY(-5px);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.35);
    }

    /* --- JavaScript Animation Classes --- */
    .animate-fade-in-up {
        opacity: 0;
        transform: translateY(30px);
        transition: opacity 1s ease-out, transform 1s ease-out;
    }

    .animate-fade-in-up.in-view {
        opacity: 1;
        transform: translateY(0);
    }

    /* Delays for cascading animation */
    .delay-0 { transition-delay: 0s; }
    .delay-1 { transition-delay: 0.15s; }
    .delay-2 { transition-delay: 0.3s; }
    .delay-3 { transition-delay: 0.45s; }

    /* Responsive Design */
    @media (max-width: 992px) {
        .about-hero-section {
            flex-direction: column;
            padding: 80px 40px;
            text-align: center;
            gap: 40px;
        }
        .hero-content-area {
            max-width: 100%;
        }
        .hero-image-circle {
            width: 350px;
            height: 350px;
        }
        .techsphere-logo-text {
            font-size: 4.5em;
            margin-bottom: 15px;
        }
        .logo-dot {
            bottom: 10px;
            right: -5px;
            width: 15px;
            height: 15px;
        }
        .hero-description {
            font-size: 1.1em;
        }

        .what-is-techsphere-section {
            flex-direction: column;
            gap: 40px;
            padding: 60px 30px;
        }
        .geometric-pattern {
            flex: none;
            width: 300px;
            height: 300px;
        }
        .triangle {
            border-left: 80px solid transparent;
            border-right: 80px solid transparent;
            border-bottom: 150px solid var(--color-light-blue);
        }
        .what-is-content {
            max-width: 100%;
        }

        .section-heading-dark, .section-heading-light {
            font-size: 2.8em;
            margin-bottom: 40px;
        }

        .partners-logo-grid {
            grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
            gap: 30px;
        }
        .partner-logo-item {
            height: 70px;
        }
        .partner-logo-item img {
            max-height: 40px;
        }

        .team-cards-grid {
            flex-direction: column;
            align-items: center;
            gap: 40px;
        }
        .team-member-card {
            width: 80%; /* Lebar relatif di mobile */
            max-width: 350px; /* Batas maksimum */
        }
        .member-photo-wrapper {
            width: 150px;
            height: 150px;
        }
        .member-name {
            font-size: 1.6em;
        }
        .member-role {
            font-size: 1em;
        }
        .social-icon-link {
            width: 40px;
            height: 40px;
            font-size: 1.2em;
        }

        .cta-bottom-section {
            padding: 80px 30px;
        }
        .cta-bottom-heading {
            font-size: 2.8em;
        }
        .cta-bottom-tagline {
            font-size: 1.3em;
        }
        .cta-bottom-button {
            padding: 15px 35px;
            font-size: 1.2em;
        }
    }

    @media (max-width: 768px) {
        section {
            padding: 60px 20px;
        }
        .about-hero-section {
            padding: 60px 20px;
            gap: 30px;
        }
        .hero-image-circle {
            width: 300px;
            height: 300px;
        }
        .techsphere-logo-text {
            font-size: 3.5em;
        }
        .logo-dot {
            bottom: 8px;
            right: -5px;
            width: 12px;
            height: 12px;
        }
        .hero-description {
            font-size: 1em;
        }
        .section-heading-dark, .section-heading-light {
            font-size: 2.2em;
            margin-bottom: 30px;
        }
        .section-heading-dark::after, .section-heading-light::after {
            width: 60px;
            height: 4px;
        }
        .what-is-techsphere-section {
            padding: 50px 20px;
            gap: 30px;
        }
        .geometric-pattern {
            width: 250px;
            height: 250px;
        }
        .triangle {
            border-left: 60px solid transparent;
            border-right: 60px solid transparent;
            border-bottom: 120px solid var(--color-light-blue);
        }
        .what-is-content p {
            font-size: 1em;
        }
        .partners-logo-grid {
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }
        .partner-logo-item {
            height: 60px;
        }
        .partner-logo-item img {
            max-height: 35px;
        }
        .team-member-card {
            width: 100%; /* Lebar penuh di mobile kecil */
            max-width: 300px;
        }
        .member-photo-wrapper {
            width: 120px;
            height: 120px;
            border-width: 5px;
        }
        .member-name {
            font-size: 1.4em;
        }
        .member-role {
            font-size: 0.9em;
        }
        .social-icon-link {
            width: 35px;
            height: 35px;
            font-size: 1.1em;
        }
        .cta-bottom-section {
            padding: 60px 20px;
        }
        .cta-bottom-heading {
            font-size: 2.2em;
        }
        .cta-bottom-tagline {
            font-size: 1.1em;
        }
        .cta-bottom-button {
            padding: 12px 25px;
            font-size: 1.1em;
        }
    }

    @media (max-width: 480px) {
        .about-hero-section {
            padding: 40px 15px;
        }
        .hero-image-circle {
            width: 250px;
            height: 250px;
        }
        .techsphere-logo-text {
            font-size: 2.8em;
        }
        .hero-description {
            font-size: 0.9em;
        }
        .section-heading-dark, .section-heading-light {
            font-size: 1.8em;
        }
        .section-heading-dark::after, .section-heading-light::after {
            width: 40px;
            height: 3px;
        }
        .what-is-techsphere-section {
            padding: 40px 15px;
        }
        .what-is-content p {
            font-size: 0.9em;
        }
        .partners-logo-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }
        .partner-logo-item {
            height: 50px;
        }
        .partner-logo-item img {
            max-height: 30px;
        }
        .team-member-card {
            padding: 20px;
        }
        .member-photo-wrapper {
            width: 100px;
            height: 100px;
        }
        .member-name {
            font-size: 1.2em;
        }
        .member-role {
            font-size: 0.8em;
        }
        .social-icon-link {
            width: 30px;
            height: 30px;
            font-size: 1em;
        }
        .cta-bottom-section {
            padding: 40px 15px;
        }
        .cta-bottom-heading {
            font-size: 1.8em;
        }
        .cta-bottom-tagline {
            font-size: 1em;
        }
        .cta-bottom-button {
            padding: 10px 20px;
            font-size: 1em;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // --- Intersection Observer for Scroll Animations ---
        const animateOnScrollElements = document.querySelectorAll('.animate-fade-in-up');

        const observerOptions = {
            root: null, // viewport as the root
            rootMargin: '0px',
            threshold: 0.1 // 10% of the element must be visible
        };

        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('in-view');
                    observer.unobserve(entry.target); // Stop observing once animated
                }
            });
        }, observerOptions);

        animateOnScrollElements.forEach(el => {
            observer.observe(el);
        });

        // Optional: Animate geometric pattern on section in view
        const whatIsTechsphereSection = document.querySelector('.what-is-techsphere-section');
        const geometricPatternObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('in-view');
                } else {
                    // Optional: remove in-view class when out of view
                    // entry.target.classList.remove('in-view');
                }
            });
        }, { threshold: 0.3 }); // Trigger when 30% of section is visible
        if (whatIsTechsphereSection) {
            geometricPatternObserver.observe(whatIsTechsphereSection);
        }
    });
</script>
@endsection