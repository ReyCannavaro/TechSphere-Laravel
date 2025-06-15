# TechSphere Laravel Project

Proyek web ini adalah platform untuk menjelajahi berbagai gadget, melihat detailnya, dan memberikan rating. Dibangun menggunakan Laravel.

## Fitur Utama

- Autentikasi Pengguna (Login, Register)
- Melihat Daftar Kategori Gadget
- Melihat Detail Gadget
- Memberikan Rating dan Komentar pada Gadget
- Admin Panel (menggunakan Filament) untuk manajemen data

## Prasyarat

Sebelum memulai, pastikan Anda telah menginstal yang berikut:

- PHP >= 8.2
- Composer
- MySQL Database
- Node.js & NPM (untuk aset frontend)

## Instalasi

Ikuti langkah-langkah di bawah ini untuk menjalankan proyek secara lokal:

1.  **Clone Repository:**
    ```bash
    git clone [https://github.com/ReyCannavaro/TechSphere-Laravel.git](https://github.com/ReyCannavaro/TechSphere-Laravel.git)
    cd TechSphere-Laravel
    ```

2.  **Install Dependensi Composer:**
    ```bash
    composer install
    ```

3.  **Install Dependensi NPM:**
    ```bash
    npm install
    ```

4.  **Buat File `.env`:**
    ```bash
    cp .env.example .env
    ```

5.  **Generate Application Key:**
    ```bash
    php artisan key:generate
    ```

6.  **Konfigurasi Database:**
    Buka file `.env` dan sesuaikan pengaturan database Anda:
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=techsphere_db # Ganti dengan nama database Anda
    DB_USERNAME=root         # Ganti dengan username database Anda
    DB_PASSWORD=             # Ganti dengan password database Anda
    ```

7.  **Jalankan Migrasi Database:**
    ```bash
    php artisan migrate
    ```

8.  **Jalankan Database Seeder (Opsional, jika ingin data dummy):**
    ```bash
    php artisan db:seed
    ```
    *(Jika Anda memiliki user admin default dari seeder, sertakan detailnya di sini)*
    Contoh Akun Admin (dari `db:seed`):
    - Email: `admin@techsphere.com`
    - Password: `password`

9.  **Jalankan Vite Development Server:**
    ```bash
    npm run dev
    ```
    Biarkan terminal ini berjalan di latar belakang.

10. **Jalankan Laravel Development Server:**
    Buka terminal baru dan jalankan:
    ```bash
    php artisan serve
    ```

11. **Akses Aplikasi:**
    Buka browser Anda dan kunjungi: `http://127.0.0.1:8000`

## Penggunaan

Setelah instalasi, Anda bisa:
- Registrasi akun baru.
- Login dengan akun yang sudah ada (atau akun admin default jika Anda menjalankan seeder).
- Jelajahi gadget dan kategori.
- Berikan rating dan komentar (setelah login).
- Akses panel admin di `/admin` (jika Anda memiliki hak akses admin).

---

Dengan `README.md` yang lengkap seperti ini, guru Anda (atau siapa pun) akan bisa menjalankan proyek Anda dengan mudah tanpa perlu menebak-nebak langkahnya. Ini menunjukkan profesionalisme dan perhatian terhadap detail.
