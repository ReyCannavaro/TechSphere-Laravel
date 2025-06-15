{{-- resources/views/user/show.blade.php --}}

@extends('layouts.app')

@section('title', $gadget->name . ' - Detail Produk')

@section('content')
    <div class="gadget-detail-container-modern">
        <div class="gadget-header-modern">
            <div class="gadget-image-wrapper">
                <img src="{{ asset('pict/' . $gadget->image) }}" alt="{{ $gadget->name }}" class="gadget-detail-image-modern">
            </div>
            <div class="gadget-info-modern">
                <h1 class="gadget-title">{{ $gadget->name }}</h1>
                <p class="category-name-modern">Kategori: <span class="category-tag">{{ $gadget->category->name }}</span></p>
                <p class="release-year-modern">Tahun Keluaran: {{ $gadget->tahun_keluaran }}</p>
                <p class="price-modern">Harga: <span class="price-value">Rp{{ number_format($gadget->harga, 0, ',', '.') }}</span></p>
            </div>
        </div>

        <div class="gadget-section-divider"></div>

        <div class="gadget-description-modern">
            <h3 class="section-heading">Deskripsi Produk</h3>
            <p>{{ $gadget->description }}</p>
        </div>

        @if($gadget->specifications)
            <div class="gadget-section-divider"></div>
            <div class="gadget-specifications-modern">
                <h3 class="section-heading">Spesifikasi Teknis</h3>
                <div class="spec-content">
                    <p>{{ $gadget->specifications }}</p>
                    {{-- Jika spesifikasi adalah data terstruktur (misal: JSON atau baris-baris), bisa di-parse di sini untuk tampilan yang lebih baik --}}
                </div>
            </div>
        @endif

        <div class="gadget-section-divider"></div>

        <div class="gadget-ratings-section-modern">
            <h3 class="section-heading">Ulasan Pengguna</h3>

            @auth
                <div class="rating-form-wrapper">
                    <h4 class="form-heading">Berikan Penilaian Anda:</h4>
                    <form action="{{ route('ratings.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="gadget_id" value="{{ $gadget->id }}">
                        <div class="form-group-modern">
                            <label for="rating-input-stars">Rating:</label>
                            <div class="star-rating-input" data-current-rating="{{ old('rating', 0) }}" id="rating-input-stars">
                                <span data-value="1">&#9733;</span>
                                <span data-value="2">&#9733;</span>
                                <span data-value="3">&#9733;</span>
                                <span data-value="4">&#9733;</span>
                                <span data-value="5">&#9733;</span>
                            </div>
                            <input type="hidden" name="rating" id="rating-value-input" value="{{ old('rating') }}" required>
                            @error('rating') <div class="error-message">{{ $message }}</div> @enderror
                        </div>
                        <div class="form-group-modern">
                            <label for="comment-textarea">Komentar:</label>
                            <textarea name="comment" id="comment-textarea" rows="4" placeholder="Tulis komentar Anda (opsional)">{{ old('comment') }}</textarea>
                            @error('comment') <div class="error-message">{{ $message }}</div> @enderror
                        </div>
                        <button type="submit" class="submit-rating-btn-modern">Kirim Ulasan</button>
                    </form>
                </div>
            @else
                <p class="login-prompt-modern">Silakan <a href="{{ route('login') }}">login</a> untuk memberikan ulasan atau komentar.</p>
            @endauth

            <div class="existing-ratings-list-modern">
                <h4 class="reviews-heading">Semua Ulasan ({{ $ratings->count() }})</h4>
                @forelse($ratings as $rating)
                    <div class="review-item-card">
                        <div class="review-header">
                            <span class="reviewer-name">{{ $rating->user->name }}</span>
                            <div class="review-stars-display">
                                @for ($i = 0; $i < $rating->rating; $i++)
                                    <span class="star-filled">&#9733;</span>
                                @endfor
                                @for ($i = 0; $i < (5 - $rating->rating); $i++)
                                    <span class="star-empty">&#9734;</span>
                                @endfor
                            </div>
                        </div>
                        @if($rating->comment)
                            <p class="review-comment-text">{{ $rating->comment }}</p>
                        @endif
                        <span class="review-date-text">{{ $rating->created_at->isoFormat('DD MMMM YYYY, HH:mm') }} WIB</span>
                    </div>
                @empty
                    <p class="no-reviews-message-modern">Belum ada ulasan untuk gadget ini. Jadilah yang pertama!</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection

@section('styles')
<style>
    /* Variabel Warna (Sesuai permintaan: Abu-abu, Hitam, Putih) */
    :root {
        --primary-gray: #4A4A4A; /* Abu-abu utama, untuk teks heading */
        --secondary-gray: #6C757D; /* Abu-abu sekunder, untuk teks info */
        --light-gray: #E0E0E0; /* Abu-abu sangat terang, untuk border/background elemen */
        --dark-bg: #2C2C2C; /* Mungkin untuk header atau footer jika ada, saat ini tidak banyak digunakan */
        --white-bg: #FFFFFF;
        --black-text: #212121;
        --accent-gold: gold; /* Untuk bintang rating */
        --error-red: #dc3545;
    }

    body {
        font-family: 'Segoe UI', 'Roboto', 'Helvetica Neue', Arial, sans-serif; /* Font sistem modern */
        background-color: #f5f5f5; /* Background abu-abu muda */
        color: var(--black-text);
        line-height: 1.6;
    }

    .gadget-detail-container-modern {
        max-width: 1000px;
        margin: 15px auto; /* Menaikkan margin top */
        padding: 30px;
        background-color: var(--white-bg);
        border-radius: 12px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08); /* Shadow lebih lembut */
    }

    .gadget-header-modern {
        display: flex;
        flex-wrap: wrap; /* Memungkinkan wrap di layar kecil */
        gap: 30px;
        align-items: flex-start; /* Mengatur alignment vertikal */
        padding-bottom: 30px;
    }

    .gadget-image-wrapper {
        flex: 1; /* Akan mengisi ruang yang tersedia */
        min-width: 300px; /* Lebar minimum sebelum wrap */
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #fdfdfd; /* Background gambar lebih putih */
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    }

    .gadget-detail-image-modern {
        max-width: 100%;
        height: auto;
        max-height: 380px; /* Batasi tinggi gambar */
        object-fit: contain;
        border-radius: 8px;
        transition: transform 0.3s ease;
    }

    .gadget-detail-image-modern:hover {
        transform: scale(1.02);
    }

    .gadget-info-modern {
        flex: 2; /* Akan mengisi dua kali ruang dari gambar */
        display: flex;
        flex-direction: column;
        justify-content: center; /* Pusatkan info secara vertikal */
    }

    .gadget-title {
        font-size: 2.5em;
        font-weight: 700;
        color: var(--black-text);
        margin-bottom: 10px;
        line-height: 1.2;
    }

    .category-name-modern,
    .release-year-modern {
        font-size: 1.05em;
        color: var(--secondary-gray);
        margin-bottom: 8px;
    }

    .category-tag {
        background-color: var(--light-gray);
        color: var(--primary-gray);
        padding: 5px 12px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.9em;
        margin-left: 5px;
    }

    .price-modern {
        font-size: 1.2em;
        color: var(--secondary-gray);
        margin-top: 15px;
        font-weight: 600;
    }

    .price-value {
        font-size: 1.8em;
        color: var(--black-text);
        font-weight: 800;
        margin-left: 8px;
        letter-spacing: -0.5px;
    }

    /* Pembatas Antar Bagian */
    .gadget-section-divider {
        border-top: 1px solid var(--light-gray);
        margin: 30px 0;
    }

    .gadget-description-modern,
    .gadget-specifications-modern,
    .gadget-ratings-section-modern {
        padding: 20px 0;
    }

    .section-heading {
        font-size: 2em;
        font-weight: 700;
        color: var(--primary-gray);
        margin-bottom: 25px;
        text-align: left; /* Defaultnya rata kiri */
    }

    .gadget-description-modern p,
    .gadget-specifications-modern p {
        font-size: 1.05em;
        color: var(--secondary-gray);
        line-height: 1.7;
    }

    /* Ulasan Pengguna */
    .rating-form-wrapper {
        background-color: #fcfcfc;
        border: 1px solid var(--light-gray);
        border-radius: 10px;
        padding: 25px;
        margin-bottom: 30px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
    }

    .form-heading, .reviews-heading {
        font-size: 1.5em;
        font-weight: 600;
        color: var(--primary-gray);
        margin-bottom: 20px;
        text-align: center;
    }

    .login-prompt-modern {
        text-align: center;
        padding: 20px;
        background-color: #f0f0f0;
        border-radius: 8px;
        color: var(--secondary-gray);
        font-size: 1.1em;
    }

    .login-prompt-modern a {
        color: var(--primary-gray);
        text-decoration: none;
        font-weight: 600;
    }
    .login-prompt-modern a:hover {
        text-decoration: underline;
    }

    .form-group-modern {
        margin-bottom: 18px;
    }

    .form-group-modern label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: var(--primary-gray);
        font-size: 0.95em;
    }

    /* Bintang Interaktif */
    .star-rating-input {
        display: inline-block;
        font-size: 2em; /* Ukuran bintang */
        color: var(--light-gray); /* Warna bintang kosong */
        cursor: pointer;
        user-select: none; /* Mencegah seleksi teks */
    }

    .star-rating-input span {
        transition: color 0.2s ease, transform 0.1s ease;
    }

    .star-rating-input span:hover {
        transform: scale(1.1);
    }

    .star-rating-input span.hovered,
    .star-rating-input span.selected {
        color: var(--accent-gold); /* Warna bintang terisi saat hover/selected */
    }

    .form-group-modern select,
    .form-group-modern textarea {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid var(--light-gray);
        border-radius: 8px;
        font-size: 1em;
        color: var(--black-text);
        background-color: var(--white-bg);
        box-sizing: border-box;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .form-group-modern textarea {
        resize: vertical;
        min-height: 80px;
    }

    .form-group-modern select:focus,
    .form-group-modern textarea:focus {
        border-color: var(--primary-gray); /* Border focus abu-abu gelap */
        box-shadow: 0 0 0 3px rgba(74, 74, 74, 0.1); /* Shadow focus abu-abu transparan */
        outline: none;
    }

    .submit-rating-btn-modern {
        display: block;
        width: 100%;
        background-color: var(--primary-gray); /* Tombol abu-abu gelap */
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 8px;
        font-size: 1.05em;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.2s ease;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .submit-rating-btn-modern:hover {
        background-color: #333333; /* Sedikit lebih gelap saat hover */
        transform: translateY(-1px);
    }

    .error-message {
        color: var(--error-red);
        font-size: 0.9em;
        margin-top: 5px;
    }

    /* Daftar Ulasan yang Ada */
    .existing-ratings-list-modern {
        margin-top: 30px;
    }

    .review-item-card {
        background-color: #fdfdfd;
        border: 1px solid var(--light-gray);
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 15px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
    }

    .review-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 8px;
        flex-wrap: wrap;
    }

    .reviewer-name {
        font-weight: 700;
        color: var(--black-text);
        font-size: 1.05em;
    }

    .review-stars-display {
        font-size: 1.5em;
    }

    .star-filled {
        color: var(--accent-gold);
    }
    .star-empty {
        color: var(--light-gray);
    }

    .review-comment-text {
        color: var(--secondary-gray);
        font-style: italic;
        margin-top: 10px;
        margin-bottom: 12px;
        line-height: 1.6;
    }

    .review-date-text {
        font-size: 0.85em;
        color: var(--secondary-gray);
        display: block;
        text-align: right;
    }

    .no-reviews-message-modern {
        text-align: center;
        padding: 20px;
        background-color: #f0f0f0;
        border-radius: 8px;
        color: var(--secondary-gray);
        font-size: 1.05em;
        border: 1px dashed var(--light-gray);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .gadget-detail-container-modern {
            margin: 20px auto;
            padding: 20px;
            border-radius: 10px;
        }

        .gadget-header-modern {
            flex-direction: column; /* Tumpuk gambar dan info */
            gap: 20px;
            padding-bottom: 20px;
        }

        .gadget-image-wrapper {
            min-width: unset; /* Reset minimum width */
            width: 100%; /* Ambil lebar penuh */
            padding: 15px;
        }

        .gadget-detail-image-modern {
            max-height: 280px;
        }

        .gadget-info-modern {
            align-items: center; /* Pusatkan info di mobile */
            text-align: center;
        }

        .gadget-title {
            font-size: 2em;
            margin-bottom: 8px;
        }

        .category-name-modern,
        .release-year-modern,
        .price-modern {
            font-size: 1em;
            margin-bottom: 5px;
        }

        .price-value {
            font-size: 1.5em;
        }

        .gadget-section-divider {
            margin: 25px 0;
        }

        .gadget-description-modern,
        .gadget-specifications-modern,
        .gadget-ratings-section-modern {
            padding: 15px 0;
        }

        .section-heading {
            font-size: 1.7em;
            margin-bottom: 20px;
            text-align: center;
        }

        .rating-form-wrapper {
            padding: 20px;
            margin-bottom: 25px;
        }
        .form-heading, .reviews-heading {
            font-size: 1.3em;
            margin-bottom: 15px;
        }

        .submit-rating-btn-modern {
            padding: 10px 15px;
            font-size: 1em;
        }

        .review-item-card {
            padding: 15px;
            margin-bottom: 10px;
        }

        .review-header {
            flex-direction: column;
            align-items: flex-start;
            margin-bottom: 5px;
        }
        .reviewer-name {
            font-size: 1em;
            margin-bottom: 5px;
        }
        .review-stars-display {
            font-size: 1.2em;
        }
        .review-date-text {
            text-align: left;
            margin-top: 8px;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const starRatingInputs = document.querySelectorAll('.star-rating-input');

        starRatingInputs.forEach(starRatingInput => {
            const stars = starRatingInput.querySelectorAll('span');
            const hiddenInputId = starRatingInput.id.replace('-input-stars', '-value-input');
            const hiddenInput = document.getElementById(hiddenInputId);
            let currentRating = parseInt(starRatingInput.dataset.currentRating) || 0;

            // Function to fill stars based on a given rating value
            function fillStars(ratingValue) {
                stars.forEach(star => {
                    if (parseInt(star.dataset.value) <= ratingValue) {
                        star.classList.add('selected');
                    } else {
                        star.classList.remove('selected');
                    }
                    star.classList.remove('hovered'); // Remove hover effect when applying selection
                });
            }

            // Initialize stars based on old input value (if any)
            if (hiddenInput && hiddenInput.value) {
                currentRating = parseInt(hiddenInput.value);
            }
            fillStars(currentRating);

            stars.forEach(star => {
                star.addEventListener('mouseover', function() {
                    const value = parseInt(this.dataset.value);
                    stars.forEach(s => {
                        if (parseInt(s.dataset.value) <= value) {
                            s.classList.add('hovered');
                        } else {
                            s.classList.remove('hovered');
                        }
                    });
                });

                star.addEventListener('mouseout', function() {
                    stars.forEach(s => s.classList.remove('hovered'));
                    // Reapply selected state if any
                    fillStars(currentRating);
                });

                star.addEventListener('click', function() {
                    currentRating = parseInt(this.dataset.value);
                    if (hiddenInput) {
                        hiddenInput.value = currentRating;
                    }
                    fillStars(currentRating); // Apply the clicked selection
                });
            });
        });
    });
</script>
@endsection