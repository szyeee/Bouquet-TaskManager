## Bouquet Management Application

![VS Code](https://img.shields.io/badge/IDE-VS%20Code-blue?logo=visualstudiocode)
![Laravel](https://img.shields.io/badge/Framework-Laravel-red)
![PHP](https://img.shields.io/badge/Language-PHP-777BB4)
![PostgreSQL](https://img.shields.io/badge/DB-PostgreSQL-blue)
![Tests](https://img.shields.io/badge/Tests-PHPUnit-lightgrey)
[![GitHub](https://img.shields.io/badge/Repo-Bouquet--TaskManager-blue?logo=github)](https://github.com/szyeee/Bouquet-TaskManager)

---

## README – Bouquet Management Web App

### Deskripsi Proyek

Bouquet Management Web App adalah aplikasi berbasis Laravel yang digunakan untuk membantu pengelolaan toko buket bunga secara digital. Sistem ini memungkinkan pengguna untuk mencatat data kategori produk, daftar produk, pesanan pelanggan, dan status pengiriman. Aplikasi ini mendukung fitur login, pengelolaan CRUD lengkap, serta pencarian dan filter untuk mempercepat proses manajemen data.

Struktur pengembangan mengikuti prinsip arsitektur Model-View-Controller (MVC), dengan desain tampilan yang responsif dan modular, sehingga memudahkan penggunaan maupun pengembangan lebih lanjut.

---

### Teknologi yang Digunakan

* **Laravel 10** – Framework backend PHP
* **PHP 8.x** – Bahasa pemrograman utama
* **PostgreSQL** – Sistem basis data relasional
* **Blade** – Templating engine Laravel
* **Tailwind CSS** – Framework CSS untuk UI responsif
* **Laravel Breeze** – Starter kit autentikasi
* **Visual Studio Code** – Editor pengembangan
* **Git & GitHub** – Version control dan kolaborasi kode

---

### Struktur Folder Proyek

```
project-root/
├── app/                       # Controller, Models, Middleware
├── bootstrap/                # Bootstrap Laravel
├── config/                   # File konfigurasi
├── database/                 # Migrasi dan Seeder
├── public/                   # Aset publik (gambar, index.html, styles.css)
├── resources/views/          # Halaman Blade (produk, pesanan, pengiriman)
├── routes/                   # Routing Laravel
├── .env.example              # Contoh environment config
├── README.md                 # Dokumentasi proyek
└── tailwind.config.js        # Konfigurasi Tailwind
```

---

### Instalasi dan Setup

1. **Clone Repository**

```bash
git clone https://github.com/szyeee/Bouquet-TaskManager.git
cd Bouquet-TaskManager
```

2. **Install Dependensi**

```bash
composer install
npm install && npm run build
```

3. **Buat File .env dan Generate Key**

```bash
cp .env.example .env
php artisan key:generate
```

4. **Atur Koneksi Database di `.env`**

```dotenv
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=bouquet_db
DB_USERNAME=postgres
DB_PASSWORD=your_password
```

5. **Jalankan Migrasi Database**

```bash
php artisan migrate
```

6. **Jalankan Aplikasi**

```bash
php artisan serve
```

7. **Buka di Browser**

[http://127.0.0.1:8000](http://127.0.0.1:8000)

---

### Panduan Penggunaan

* Halaman utama (landing page) akan mengarahkan ke halaman login.
* Fitur register tersedia untuk pembuatan akun.
* Setelah login, pengguna dapat:

  * Mengelola kategori produk
  * Menambahkan dan mengubah data produk (termasuk gambar dan stok)
  * Mencatat pesanan pelanggan
  * Mengatur status pengiriman
* Tersedia fitur pencarian dan filter untuk mempermudah navigasi data.

---

### Dokumentasi & Kontribusi

Proyek ini dikerjakan oleh:

* **Adelia Sassy Mulya** – Backend Developer & Project Lead
  Fokus pada pengaturan Laravel, autentikasi, migrasi database, CRUD, serta penulisan dokumentasi teknis.

* **Davina Posh** – Frontend Developer & Dokumentasi
  Menangani desain tampilan menggunakan Blade dan Tailwind, membuat landing page, serta menyusun laporan dan README.

Dokumentasi proyek tersedia melalui file README ini dan laporan tertulis proyek.

---

### Link Repository GitHub

[https://github.com/szyeee/Bouquet-TaskManager](https://github.com/szyeee/Bouquet-TaskManager)

---