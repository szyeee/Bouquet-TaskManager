<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
  <a href="https://github.com/username/bouquet-management/actions" target="_blank"><img src="https://github.com/username/bouquet-management/workflows/tests/badge.svg" alt="Build Status"></a>
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
  <a href="https://github.com/username/bouquet-management/releases"><img src="https://img.shields.io/github/v/release/username/bouquet-management" alt="Latest Release"></a>
  <a href="https://opensource.org/licenses/MIT"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Bouquet Management Application

![VS Code](https://img.shields.io/badge/IDE-VS%20Code-blue?logo=visualstudiocode)
![Laravel](https://img.shields.io/badge/Framework-Laravel-red)
![PHP](https://img.shields.io/badge/Language-PHP-777BB4)
![PostgreSQL](https://img.shields.io/badge/DB-PostgreSQL-blue)
![Tests](https://img.shields.io/badge/Tests-PHPUnit-lightgrey)

---

## Deskripsi

Aplikasi **Bouquet Management** membantu mengelola bisnis bunga secara efisien.
Fitur utama:

* **Autentikasi**: Register, Login, Verifikasi Email, Reset Password
* **CRUD**: Kategori, Produk, Pesanan, Pengiriman
* **Search & Filter**: Cari dan saring data di halaman index
* **Paginasi**: Tampilan data terstruktur
* **Landing Page**: Halaman depan statis dengan HTML/CSS

---

## Teknologi dan Persyaratan

* **PHP** `>=8.1`
* **Laravel** `10.x`
* **PostgreSQL** `14+`
* **Node.js & npm**
* **VS Code** dengan ekstensi:

  * PHP Intelephense
  * Laravel Snippets & Blade Snippets
  * Tailwind CSS IntelliSense
  * ESLint & Prettier

---

## Persiapan dan Instalasi

1. **Clone repo**

   ```bash
   git clone https://github.com/username/bouquet-management.git
   cd bouquet-management
   code .       # buka di VS Code
   ```
2. **Install dependencies**

   ```bash
   composer install
   npm install
   ```
3. **Setup environment**

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
4. **Konfigurasi `.env`**

   ```ini
   APP_NAME="Bouquet Management"
   APP_ENV=local
   APP_DEBUG=true
   APP_URL=http://localhost

   DB_CONNECTION=pgsql
   DB_HOST=127.0.0.1
   DB_PORT=5432
   DB_DATABASE=bouquet_db
   DB_USERNAME=db_user
   DB_PASSWORD=db_pass
   ```
5. **Migrasi & Seeder**

   ```bash
   php artisan migrate --seed
   ```
6. **Compile assets**

   ```bash
   npm run dev        # develop mode
   npm run build      # production build
   ```
7. **Jalankan server**

   ```bash
   php artisan serve
   ```

   Akses: `http://127.0.0.1:8000`

---

## Struktur Proyek

```
project-root/
├── app/
│   ├── Http/Controllers/
│   └── Models/
├── config/
├── database/
│   ├── factories/
│   └── migrations/
├── public/
│   ├── index.html       # Landing page
│   ├── styles.css
│   └── images/
│       └── bouquet.jpeg
├── resources/views/
│   ├── layout/app.blade.php
│   ├── auth/
│   ├── kategori/
│   ├── produk/
│   ├── pesanan/
│   └── pengiriman/
├── routes/
│   ├── web.php
│   └── api.php
├── tests/
│   ├── Feature/
│   └── Unit/
├── .github/
│   └── workflows/
│       └── ci.yml
├── .vscode/
│   ├── settings.json
│   └── launch.json
├── .env.example
├── composer.json
└── README.md
```

---

## Konfigurasi Visual Studio Code

<details>
<summary><code>.vscode/settings.json</code></summary>

```json
{
  "php.validate.executablePath": "C:/path/to/php.exe",
  "editor.formatOnSave": true,
  "files.exclude": { "**/node_modules": true, "**/vendor": true },
  "editor.codeActionsOnSave": { "source.fixAll.eslint": true },
  "phpstan.enabled": true,
  "laravel-artisan": { "autoComplete": true }
}
```

</details>

<details>
<summary><code>.vscode/launch.json</code></summary>

```json
{
  "version": "0.2.0",
  "configurations": [
    {
      "name": "Listen for XDebug",
      "type": "php",
      "request": "launch",
      "port": 9003
    }
  ]
}
```

</details>

---

## Fitur Utama

* **GUI CRUD** lengkap untuk entitas utama.
* **Search & Filter** dengan query parameters.
* **Paginasi** bawaan Laravel.
* **REST API** dasar (jika diperlukan = `api.php`).
* **Blade Templating**: Layout, partials, komponen.
* **Middleware**: `auth`, `verified`.
* **CI/CD**: Workflow GitHub Actions untuk test dan linting.

---

## Pengujian

Run unit & feature tests:

```bash
php artisan test
```

Coverage reports disimpan di `storage/coverage`.

---

## Penanganan Error dan Validasi

* Validasi request di Controller (`store`, `update`).
* Feedback user-friendly via session flash messages.
* Custom error pages: `resources/views/errors/404.blade.php`, `500.blade.php`.
* Logging via Monolog (config di `config/logging.php`).

---

## Deployment

1. Setup server (Ubuntu, Nginx/Apache, PHP-FPM).
2. Clone repo, setup `.env`, migrasi, npm build.
3. Konfigurasi virtual host mengarah ke `project-root/public`.
4. Setup supervisord untuk job queue.
5. Configure SSL (Let's Encrypt/Certbot).

---

## Pemecahan Masalah

* **Database connection**: Cek kredensial di `.env`.
* **Assets tidak muncul**: `npm run build`, `php artisan config:cache`, `route:cache`, `view:clear`.
* **XDebug**: Port & extension di `php.ini`.

---

## Kontribusi

Silakan buka **issue** atau **pull request**. Ikuti [CONTRIBUTING.md](CONTRIBUTING.md) untuk panduan.

---

## Kontributor

* Adelia Sassy Mulya (535240083)
* Davina Posh (535240145)

---

## Panduan Penggunaan

Berikut langkah-langkah menjalankan aplikasi ini secara lokal menggunakan Visual Studio Code:

### 1. Clone Proyek

Buka terminal di VS Code dan jalankan:

```bash
git clone https://github.com/username/bouquet-management.git
cd bouquet-management
```

### 2. Instalasi Dependensi

Install semua dependensi backend dan frontend:

```bash
composer install
npm install
```

### 3. Atur File Environment

Salin file `.env.example` menjadi `.env`, lalu jalankan:

```bash
php artisan key:generate
```

Kemudian sesuaikan konfigurasi database di `.env`:

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=bouquet_db
DB_USERNAME=postgres
DB_PASSWORD=your_password
```

### 4. Migrasi dan Seeder Database

Pastikan database sudah dibuat di PostgreSQL, lalu jalankan:

```bash
php artisan migrate --seed
```

### 5. Jalankan Build Frontend

Untuk menjalankan Tailwind CSS dan JS:

```bash
npm run dev
```

### 6. Jalankan Server Laravel

```bash
php artisan serve
```

Buka aplikasi melalui browser di: `http://127.0.0.1:8000`

### 7. Navigasi Aplikasi

* Halaman utama: landing page statis
* Klik Login atau Register
* Setelah login, tersedia fitur:

  * Kategori
  * Produk (dengan pencarian dan filter)
  * Pesanan
  * Pengiriman


