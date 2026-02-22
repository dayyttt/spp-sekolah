# PANDUAN INSTALASI SISTEM PEMBAYARAN SPP
## SMA NEGERI 1 KERAJAAN
## UNTUK WINDOWS

---

## DAFTAR ISI
1. [Persyaratan Sistem](#persyaratan-sistem)
2. [Instalasi Pertama Kali](#instalasi-pertama-kali)
3. [Konfigurasi Database](#konfigurasi-database)
4. [Menjalankan Aplikasi](#menjalankan-aplikasi)
5. [Troubleshooting](#troubleshooting)

---

## PERSYARATAN SISTEM

Sebelum memulai instalasi, pastikan komputer Anda sudah terinstall:

### Software yang Diperlukan:
- **PHP** >= 8.1
- **Composer** (PHP Package Manager)
- **MySQL** atau **MariaDB**
- **Git** (untuk clone repository)

### Cara Cek Versi:
Buka Command Prompt (CMD) atau PowerShell, lalu jalankan:

```cmd
php -v
composer -v
mysql --version
git --version
```

**Catatan:** Sistem ini menggunakan Tailwind CSS via CDN, jadi tidak memerlukan Node.js/NPM.

### Rekomendasi:
- Gunakan **XAMPP** atau **Laragon** untuk kemudahan (sudah include PHP, MySQL, Apache)
- Download XAMPP: https://www.apachefriends.org/
- Download Laragon: https://laragon.org/

---

## INSTALASI PERTAMA KALI

### LANGKAH 1: Clone Repository

Buka Command Prompt (CMD), lalu jalankan:

```cmd
git clone <URL_REPOSITORY>
cd spp-sekolah
```

Atau jika sudah download ZIP, extract dan masuk ke folder:
```cmd
cd spp-sekolah
```

---

### LANGKAH 2: Install Dependencies PHP

Install semua package PHP yang diperlukan menggunakan Composer:

```cmd
composer install
```

**Catatan:** Proses ini akan memakan waktu beberapa menit tergantung koneksi internet.

---

### LANGKAH 3: Copy File Environment

Copy file `.env.example` menjadi `.env`:

```cmd
copy .env.example .env
```

---

### LANGKAH 4: Generate Application Key

Generate key unik untuk aplikasi:

```cmd
php artisan key:generate
```

---

## KONFIGURASI DATABASE

### LANGKAH 5: Buat Database

1. Buka **phpMyAdmin** (http://localhost/phpmyadmin)
2. Klik tab "Databases"
3. Buat database baru dengan nama: `spp_sekolah`
4. Pilih Collation: `utf8mb4_unicode_ci`
5. Klik "Create"

**Via MySQL Command:**
```sql
CREATE DATABASE spp_sekolah CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

---

### LANGKAH 6: Konfigurasi File .env

Buka file `.env` dengan Notepad atau text editor lainnya, lalu sesuaikan konfigurasi database:

```env
APP_NAME="SPP SMA N 1 Kerajaan"
APP_ENV=local
APP_KEY=base64:xxxxxxxxxxxxxxxxxxxxx
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=spp_sekolah
DB_USERNAME=root
DB_PASSWORD=
```

**Sesuaikan:**
- `DB_DATABASE` = nama database yang dibuat (spp_sekolah)
- `DB_USERNAME` = username MySQL (default: root)
- `DB_PASSWORD` = password MySQL (kosongkan jika tidak ada password)

**Simpan file setelah diedit!**

---

### LANGKAH 7: Jalankan Migration & Seeder

Jalankan perintah berikut untuk membuat tabel dan mengisi data awal:

```cmd
php artisan migrate:fresh --seed
```

**Perintah ini akan:**
- Membuat semua tabel database
- Mengisi data sample:
  - 2 user (admin & petugas)
  - 18 kelas (X, XI, XII untuk IPA, IPS, Bahasa)
  - 180 siswa (10 siswa per kelas)
  - 1 tahun ajaran aktif
  - 3 rekening bank

**Tunggu hingga proses selesai!**

---

### LANGKAH 8: Buat Storage Link

Buat symbolic link untuk storage (untuk upload file):

```cmd
php artisan storage:link
```

---

## MENJALANKAN APLIKASI

### OPSI 1: Menggunakan PHP Built-in Server (Recommended)

Jalankan server development Laravel:

```cmd
php artisan serve
```

Aplikasi akan berjalan di: **http://localhost:8000**

**Buka browser dan akses URL tersebut.**

---

### OPSI 2: Menggunakan XAMPP/Laragon

1. Copy folder `spp-sekolah` ke folder `htdocs` (XAMPP) atau `www` (Laragon)
   - XAMPP: `C:\xampp\htdocs\`
   - Laragon: `C:\laragon\www\`

2. Pastikan Apache dan MySQL sudah running di XAMPP/Laragon

3. Buka browser dan akses: **http://localhost/spp-sekolah/public**

---

## AKSES APLIKASI

Setelah aplikasi berjalan, buka browser dan akses URL sesuai opsi yang dipilih.

### Login Credentials:

**Admin:**
- Email: `admin@smakerajaan.sch.id`
- Password: `admin123`

**Petugas:**
- Email: `petugas@smakerajaan.sch.id`
- Password: `petugas123`

---

## TROUBLESHOOTING

### 1. Error: "No application encryption key has been specified"

**Solusi:**
```cmd
php artisan key:generate
```

---

### 2. Error: "SQLSTATE[HY000] [1045] Access denied for user"

**Penyebab:** Konfigurasi database salah

**Solusi:**
- Buka file `.env` dengan Notepad
- Pastikan `DB_USERNAME` dan `DB_PASSWORD` benar
- Pastikan MySQL service running di XAMPP/Laragon

---

### 3. Error: "Class 'Maatwebsite\Excel\Facades\Excel' not found"

**Solusi:**
```cmd
composer require maatwebsite/excel
php artisan config:clear
```

---

### 4. Error: "The stream or file could not be opened"

**Penyebab:** Permission storage folder

**Solusi:**
- Klik kanan folder `storage` → Properties → Security
- Berikan Full Control untuk user Anda
- Klik Apply dan OK

---

### 5. Halaman Blank atau Error 500

**Solusi:**
```cmd
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

---

### 6. Upload File Tidak Berfungsi

**Solusi:**
```cmd
php artisan storage:link
```

Pastikan folder `public/storage` ada dan ter-link ke `storage/app/public`

---

### 7. Gambar/Logo Tidak Muncul

**Penyebab:** File logo belum ada

**Solusi:**
- Pastikan file logo ada di `public/images/logo-sekolah.png`
- Atau upload logo baru dengan nama yang sama

---

### 8. Composer Install Gagal

**Solusi:**
- Pastikan koneksi internet stabil
- Jalankan ulang: `composer install`
- Atau coba: `composer install --ignore-platform-reqs`

---

### 9. PHP Artisan Serve Port Sudah Digunakan

**Solusi:**
Gunakan port lain:
```cmd
php artisan serve --port=8001
```

Akses di: http://localhost:8001

---

## RESET DATABASE

Jika ingin reset database dan mulai dari awal:

```cmd
php artisan migrate:fresh --seed
```

**PERINGATAN:** Perintah ini akan menghapus SEMUA data dan mengisi ulang dengan data sample!

---

## UPDATE APLIKASI

Jika ada update dari repository:

```cmd
git pull origin main
composer install
php artisan migrate
php artisan cache:clear
```

---

## BACKUP DATABASE

### Via phpMyAdmin:
1. Buka phpMyAdmin (http://localhost/phpmyadmin)
2. Pilih database `spp_sekolah`
3. Klik tab "Export"
4. Pilih "Quick" atau "Custom"
5. Klik "Go"
6. File SQL akan terdownload

### Via Command Line:
```cmd
mysqldump -u root -p spp_sekolah > backup_spp.sql
```

---

## STRUKTUR FOLDER PENTING

```
spp-sekolah/
├── app/                    # Kode aplikasi (Controllers, Models, dll)
├── config/                 # File konfigurasi
├── database/
│   ├── migrations/        # File migrasi database
│   └── seeders/           # File seeder (data awal)
├── public/
│   ├── images/            # Folder untuk logo dan gambar
│   └── storage/           # Link ke storage (upload files)
├── resources/
│   └── views/             # File tampilan (Blade templates)
├── routes/
│   └── web.php            # Routing aplikasi
├── storage/
│   └── app/public/        # Upload files (QR Code, dll)
├── .env                   # Konfigurasi environment
└── composer.json          # Dependencies PHP
```

---

## CHECKLIST INSTALASI

Gunakan checklist ini untuk memastikan instalasi berhasil:

- [ ] PHP, Composer, MySQL terinstall
- [ ] Repository di-clone atau di-extract
- [ ] `composer install` berhasil
- [ ] File `.env` sudah dikonfigurasi
- [ ] `php artisan key:generate` berhasil
- [ ] Database `spp_sekolah` sudah dibuat
- [ ] `php artisan migrate:fresh --seed` berhasil
- [ ] `php artisan storage:link` berhasil
- [ ] Server berjalan (`php artisan serve`)
- [ ] Bisa login dengan akun admin/petugas
- [ ] Logo sekolah muncul
- [ ] Semua menu dapat diakses
- [ ] Upload QR Code berfungsi
- [ ] Cetak kwitansi berfungsi
- [ ] Export Excel berfungsi

---

## TIPS PENGGUNAAN XAMPP/LARAGON

### XAMPP:
- Start Apache dan MySQL dari XAMPP Control Panel
- phpMyAdmin: http://localhost/phpmyadmin
- Folder project: `C:\xampp\htdocs\`

### Laragon:
- Start All dari Laragon
- phpMyAdmin: http://localhost/phpmyadmin
- Folder project: `C:\laragon\www\`
- Laragon otomatis membuat virtual host

---

## KONTAK SUPPORT

Jika mengalami kesulitan instalasi:

1. Cek dokumentasi Laravel: https://laravel.com/docs
2. Cek file `DOKUMENTASI_SISTEM.md` untuk panduan penggunaan
3. Hubungi developer/admin sistem

---

**Selamat! Sistem Pembayaran SPP siap digunakan.**

---

**Versi**: 1.0  
**Platform**: Windows  
**Tanggal**: Februari 2026  
**Sistem**: Pembayaran SPP SMA N 1 Kerajaan

## TROUBLESHOOTING

### 1. Error: "No application encryption key has been specified"

**Solusi:**
```bash
php artisan key:generate
```

---

### 2. Error: "SQLSTATE[HY000] [1045] Access denied for user"

**Penyebab:** Konfigurasi database salah

**Solusi:**
- Cek file `.env`
- Pastikan `DB_USERNAME` dan `DB_PASSWORD` benar
- Pastikan MySQL service running

---

### 3. Error: "Class 'Maatwebsite\Excel\Facades\Excel' not found"

**Solusi:**
```bash
composer require maatwebsite/excel
php artisan config:clear
```

---

### 4. Error: "The stream or file could not be opened"

**Penyebab:** Permission storage folder

**Solusi (Linux/Mac):**
```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

**Solusi (Windows):**
- Klik kanan folder `storage` → Properties → Security
- Berikan Full Control untuk user Anda

---

### 5. Halaman Blank atau Error 500

**Solusi:**
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

---

### 6. Upload File Tidak Berfungsi

**Solusi:**
```bash
php artisan storage:link
```

Pastikan folder `public/storage` ada dan ter-link ke `storage/app/public`

---

### 7. Gambar/Logo Tidak Muncul

**Penyebab:** File logo belum ada

**Solusi:**
- Pastikan file logo ada di `public/images/logo-sekolah.png`
- Atau upload logo baru dengan nama yang sama

---

## RESET DATABASE

Jika ingin reset database dan mulai dari awal:

```bash
php artisan migrate:fresh --seed
```

**PERINGATAN:** Perintah ini akan menghapus SEMUA data dan mengisi ulang dengan data sample!

---

## UPDATE APLIKASI

Jika ada update dari repository:

```bash
git pull origin main
composer install
php artisan migrate
php artisan cache:clear
```

---

## BACKUP DATABASE

### Manual via phpMyAdmin:
1. Buka phpMyAdmin
2. Pilih database `spp_sekolah`
3. Klik tab "Export"
4. Pilih "Quick" atau "Custom"
5. Klik "Go"

### Via Command Line:
```bash
mysqldump -u root -p spp_sekolah > backup_spp_$(date +%Y%m%d).sql
```

---

## STRUKTUR FOLDER PENTING

```
spp-sekolah/
├── app/                    # Kode aplikasi (Controllers, Models, dll)
├── config/                 # File konfigurasi
├── database/
│   ├── migrations/        # File migrasi database
│   └── seeders/           # File seeder (data awal)
├── public/
│   ├── images/            # Folder untuk logo dan gambar
│   └── storage/           # Link ke storage (upload files)
├── resources/
│   └── views/             # File tampilan (Blade templates)
├── routes/
│   └── web.php            # Routing aplikasi
├── storage/
│   └── app/public/        # Upload files (QR Code, dll)
├── .env                   # Konfigurasi environment
└── composer.json          # Dependencies PHP
```

---

## KEBUTUHAN SERVER PRODUCTION

Jika ingin deploy ke server production:

### Minimum Requirements:
- PHP >= 8.1
- MySQL >= 5.7 atau MariaDB >= 10.3
- Apache/Nginx
- SSL Certificate (recommended)
- Minimum 512MB RAM
- Minimum 1GB Storage

### PHP Extensions Required:
- BCMath
- Ctype
- Fileinfo
- JSON
- Mbstring
- OpenSSL
- PDO
- Tokenizer
- XML
- GD (untuk manipulasi gambar)
- ZIP

### Cek PHP Extensions:
```bash
php -m
```

---

## KONTAK SUPPORT

Jika mengalami kesulitan instalasi:

1. Cek dokumentasi Laravel: https://laravel.com/docs
2. Cek file `DOKUMENTASI_SISTEM.md` untuk panduan penggunaan
3. Hubungi developer/admin sistem

---

## CHECKLIST INSTALASI

Gunakan checklist ini untuk memastikan instalasi berhasil:

- [ ] PHP, Composer, MySQL terinstall
- [ ] Repository di-clone atau di-extract
- [ ] `composer install` berhasil
- [ ] File `.env` sudah dikonfigurasi
- [ ] `php artisan key:generate` berhasil
- [ ] Database sudah dibuat
- [ ] `php artisan migrate:fresh --seed` berhasil
- [ ] `php artisan storage:link` berhasil
- [ ] Server berjalan (`php artisan serve`)
- [ ] Bisa login dengan akun admin/petugas
- [ ] Logo sekolah muncul
- [ ] Semua menu dapat diakses
- [ ] Upload QR Code berfungsi
- [ ] Cetak kwitansi berfungsi
- [ ] Export Excel berfungsi

---

**Selamat! Sistem Pembayaran SPP siap digunakan.**

---

**Versi**: 1.0  
**Tanggal**: Februari 2026  
**Sistem**: Pembayaran SPP SMA N 1 Kerajaan
