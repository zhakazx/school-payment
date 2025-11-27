# SPP Payment Application

Sistem Aplikasi Pembayaran SPP (Sumbangan Pembinaan Pendidikan) berbasis web yang memungkinkan siswa untuk melakukan pembayaran SPP secara mandiri (self-service).

## 🚀 Features

### Implemented Modules (Phase 1)
- ✅ **Authentication System** - Login/logout dengan session management
- ✅ **Academic Year Management** - Kelola tahun ajaran dengan status aktif/non-aktif
- ✅ **Class Management** - Kelola data kelas dan kompetensi keahlian
- ✅ **Student Management** - Kelola data siswa dengan profil lengkap

### Technical Features
- ✅ Native PHP MVC Architecture (tanpa framework)
- ✅ PDO Database dengan prepared statements
- ✅ Password hashing dengan bcrypt
- ✅ Session management dengan security
- ✅ Clean CSS design (no gradients, no purple)
- ✅ Responsive layout
- ✅ Flash message system
- ✅ Input sanitization

## 📋 Requirements

- PHP 8.x
- MySQL/MariaDB
- Apache/Nginx dengan mod_rewrite
- Laragon/XAMPP (untuk development lokal)

## 🛠️ Installation

### 1. Clone atau Download Project
```bash
# Jika menggunakan git
git clone <repository-url> spp_app

# Atau extract file zip ke folder laragon/www/spp_app
```

### 2. Setup Database

**Opsi A: Via phpMyAdmin**
1. Buka phpMyAdmin di browser: `http://localhost/phpmyadmin`
2. Klik tab "SQL"
3. Copy seluruh isi file `database/schema.sql`
4. Paste dan klik "Go"

**Opsi B: Via Command Line**
```bash
# Masuk ke MySQL
mysql -u root -p

# Jalankan script
source d:/laragon/www/spp_app/database/schema.sql
```

### 3. Konfigurasi Database

Edit file `app/config/database.php` jika perlu mengubah kredensial:

```php
private $host = 'localhost';
private $dbname = 'spp_app';
private $username = 'root';
private $password = '';  // Sesuaikan dengan password MySQL Anda
```

### 4. Konfigurasi Base URL

Edit file `app/config/config.php`:

```php
// Sesuaikan dengan lokasi project Anda
define('BASE_URL', 'http://localhost/spp_app/public');
```

### 5. Pastikan Apache mod_rewrite Aktif

**Untuk Laragon:**
- Sudah aktif secara default

**Untuk XAMPP:**
1. Edit `httpd.conf`
2. Uncomment: `LoadModule rewrite_module modules/mod_rewrite.so`
3. Restart Apache

### 6. Akses Aplikasi

Buka browser dan akses:
```
http://localhost/spp_app/public
```

## 🔐 Demo Login

Gunakan kredensial berikut untuk testing:

```
NIS: 2024001
Password: password123
```

**Daftar Akun Demo:**
- NIS: `2024001` - Ahmad Fauzi (X RPL 1)
- NIS: `2024002` - Siti Nurhaliza (X RPL 1)
- NIS: `2024003` - Budi Santoso (X RPL 2)
- NIS: `2023001` - Dewi Lestari (XI RPL 1)
- NIS: `2022001` - Rudi Hartono (XII RPL 1)

Semua menggunakan password: `password123`

## 📁 Project Structure

```
spp_app/
├── app/
│   ├── config/
│   │   ├── config.php          # Konfigurasi aplikasi
│   │   └── database.php        # Koneksi database
│   ├── core/
│   │   ├── Controller.php      # Base controller
│   │   ├── Model.php           # Base model
│   │   ├── Router.php          # URL routing
│   │   └── Helpers.php         # Helper functions
│   ├── controllers/
│   │   ├── AuthController.php
│   │   ├── TahunAjaranController.php
│   │   ├── KelasController.php
│   │   └── SiswaController.php
│   ├── models/
│   │   ├── User.php
│   │   ├── TahunAjaran.php
│   │   ├── Kelas.php
│   │   └── Siswa.php
│   └── views/
│       ├── layouts/
│       ├── auth/
│       ├── tahun_ajaran/
│       ├── kelas/
│       └── siswa/
├── database/
│   └── schema.sql              # Database schema
├── public/
│   ├── assets/
│   │   └── css/
│   │       └── main.css        # Main stylesheet
│   ├── .htaccess               # URL rewriting
│   └── index.php               # Front controller
├── CHANGELOG.md
└── README.md
```

## 🎨 Design Guidelines

Aplikasi ini menggunakan desain yang **clean dan professional** dengan prinsip:

- ❌ **NO Gradients** - Hanya solid colors
- ❌ **NO Purple Colors** - Menggunakan blues, greens, dan grays
- ✅ **Clean Layout** - Minimalis dan mudah dibaca
- ✅ **Responsive Design** - Mobile-friendly
- ✅ **Professional Look** - Cocok untuk institusi pendidikan

## 📚 Usage Guide

### Login
1. Akses halaman login
2. Masukkan NIS dan password
3. Klik "Masuk"

### Melihat Profil
- Setelah login, Anda akan diarahkan ke halaman profil
- Profil menampilkan: NIS, Nama, Kelas, dan Kompetensi Keahlian

### Mengelola Tahun Ajaran
1. Klik menu "Tahun Ajaran"
2. Klik "Tambah Tahun Ajaran" untuk menambah
3. Klik "Edit" untuk mengubah data
4. Klik "Aktifkan" untuk mengaktifkan tahun ajaran
5. Klik "Hapus" untuk menghapus (dengan konfirmasi)

### Mengelola Kelas
1. Klik menu "Kelas"
2. Klik "Tambah Kelas" untuk menambah
3. Isi Nama Kelas (contoh: XII RPL 1)
4. Isi Kompetensi Keahlian (contoh: RPL, TKJ, TKR)
5. Klik "Simpan"

### Mengelola Siswa
1. Klik menu "Siswa"
2. Klik "Tambah Siswa" untuk menambah
3. Isi form: NIS, Nama Lengkap, Password, Pilih Kelas
4. Klik "Simpan"
5. Untuk edit: Password opsional (kosongkan jika tidak ingin mengubah)

## 🔒 Security Features

- **Password Hashing**: Menggunakan bcrypt (PASSWORD_BCRYPT)
- **SQL Injection Prevention**: Prepared statements dengan PDO
- **Session Security**: Session regeneration setelah login
- **Input Sanitization**: Semua input di-sanitize
- **Authentication Guards**: Halaman protected memerlukan login

## 🐛 Troubleshooting

### Error: "Database connection failed"
- Pastikan MySQL/MariaDB sudah running
- Cek kredensial database di `app/config/database.php`
- Pastikan database `spp_app` sudah dibuat

### Error: "404 Not Found" atau CSS tidak load
- Pastikan Apache mod_rewrite aktif
- Cek file `.htaccess` ada di folder `public/`
- Cek BASE_URL di `app/config/config.php`

### Error: "View not found" atau "Controller not found"
- Pastikan semua file sudah ter-upload dengan benar
- Cek case-sensitive pada nama file (Linux server)

### Halaman blank/putih
- Aktifkan error reporting di `app/config/config.php`
- Cek PHP error log di Laragon/XAMPP

## 📝 Development Notes

### Menambah Controller Baru
1. Buat file di `app/controllers/NamaController.php`
2. Extend dari `Controller` class
3. Akses via URL: `http://localhost/spp_app/public/nama/method`

### Menambah Model Baru
1. Buat file di `app/models/Nama.php`
2. Extend dari `Model` class
3. Set property `$table` dengan nama tabel

### Menambah View Baru
1. Buat file di `app/views/folder/nama.php`
2. Gunakan layout dengan `ob_start()` dan `ob_get_clean()`
3. Include `layouts/main.php`

## 🚧 Future Enhancements

Fitur yang akan ditambahkan di fase berikutnya:
- [ ] Tagihan SPP Management
- [ ] Pembayaran dengan Midtrans Integration
- [ ] Dashboard dengan statistik
- [ ] Laporan pembayaran
- [ ] Export data ke Excel/PDF
- [ ] Email notifications
- [ ] Admin panel terpisah

## 📄 License

This project is created for educational purposes.

## 👨‍💻 Developer

Developed with ❤️ using Native PHP MVC Architecture

---

**Version:** 1.0.0  
**Last Updated:** 2025-11-26
