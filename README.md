# SISTEM PEMBAYARAN SPP
## SMA NEGERI 1 KERAJAAN

![Laravel](https://img.shields.io/badge/Laravel-10-red)
![PHP](https://img.shields.io/badge/PHP-8.1+-blue)
![Tailwind](https://img.shields.io/badge/Tailwind-CSS-38B2AC)
![License](https://img.shields.io/badge/License-MIT-green)

---

## 📋 TENTANG SISTEM

Sistem Pembayaran SPP adalah aplikasi berbasis web yang dibangun menggunakan Laravel untuk mengelola pembayaran SPP (Sumbangan Pembinaan Pendidikan) di SMA Negeri 1 Kerajaan. 

Sistem ini dirancang dengan antarmuka modern menggunakan Tailwind CSS, mendukung mode gelap (dark mode), dan responsive untuk berbagai perangkat (desktop, tablet, mobile).

---

## ✨ FITUR UTAMA

### 🔐 Role-Based Access Control
- **Admin**: Akses penuh ke semua fitur
- **Petugas**: Akses terbatas untuk operasional pembayaran

### 📊 Modul Sistem
1. **Dashboard** - Overview statistik pembayaran
2. **Data Kelas** - Manajemen kelas sekolah
3. **Data Siswa** - Manajemen data siswa
4. **Tahun Ajaran** - Pengaturan tahun ajaran & nominal SPP
5. **Rekening Sekolah** - Manajemen rekening bank & QR Code
6. **Pembayaran SPP** - Input & riwayat pembayaran
7. **Laporan** - Laporan pembayaran & export Excel

### 🎯 Fitur Unggulan
- ✅ Pencarian siswa dengan Select2
- ✅ Format Rupiah otomatis
- ✅ Status pembayaran 12 bulan
- ✅ Cetak kwitansi dengan QR Code
- ✅ Export laporan ke Excel
- ✅ Dark mode support
- ✅ Responsive design
- ✅ Multiple payment per month (cicilan)

---

## 🚀 QUICK START

### Persyaratan
- PHP >= 8.1
- Composer
- MySQL/MariaDB

### Instalasi Cepat

```bash
# Clone repository
git clone <URL_REPOSITORY>
cd spp-sekolah

# Install dependencies
composer install

# Setup environment
copy .env.example .env  # Windows
# atau
cp .env.example .env    # Linux/Mac

# Generate key
php artisan key:generate

# Buat database 'spp_sekolah' di MySQL

# Edit file .env, sesuaikan konfigurasi database

# Jalankan migration & seeder
php artisan migrate:fresh --seed

# Buat storage link
php artisan storage:link

# Jalankan server
php artisan serve
```

Akses aplikasi di: **http://localhost:8000**

---

## 🔑 LOGIN CREDENTIALS

### Admin
- Email: `admin@smakerajaan.sch.id`
- Password: `admin123`

### Petugas
- Email: `petugas@smakerajaan.sch.id`
- Password: `petugas123`

---

## 📚 DOKUMENTASI

Untuk panduan lengkap, silakan baca dokumentasi berikut:

1. **[PANDUAN_INSTALASI.md](PANDUAN_INSTALASI.md)**
   - Instalasi pertama kali
   - Konfigurasi database
   - Troubleshooting
   - Checklist instalasi

2. **[DOKUMENTASI_SISTEM.md](DOKUMENTASI_SISTEM.md)**
   - Penjelasan fitur lengkap
   - Role & hak akses
   - Panduan penggunaan
   - Tips & trik

3. **[PANDUAN_PENGGUNAAN.md](PANDUAN_PENGGUNAAN.md)** (jika ada)
   - Tutorial step-by-step
   - Best practices
   - FAQ

---

## 🛠️ TEKNOLOGI

### Backend
- **Framework**: Laravel 10
- **Database**: MySQL
- **Authentication**: Laravel Sanctum
- **Export**: Laravel Excel (Maatwebsite)

### Frontend
- **CSS Framework**: Tailwind CSS (via CDN)
- **Icons**: Material Icons
- **JavaScript**: Vanilla JS + jQuery
- **Components**: Select2

---

## 📁 STRUKTUR PROJECT

```
spp-sekolah/
├── app/
│   ├── Http/Controllers/      # Controllers
│   ├── Models/                # Models
│   ├── Exports/               # Excel Exports
│   └── Helpers/               # Helper Functions
├── database/
│   ├── migrations/            # Database Migrations
│   └── seeders/               # Database Seeders
├── public/
│   ├── images/                # Logo & Images
│   └── storage/               # Uploaded Files
├── resources/
│   └── views/                 # Blade Templates
├── routes/
│   └── web.php                # Web Routes
└── storage/
    └── app/public/            # File Storage
```

---

## 🎨 SCREENSHOT

### Dashboard
Modern dashboard dengan statistik pembayaran real-time

### Input Pembayaran
Form input dengan pencarian siswa menggunakan Select2 dan preview QR Code

### Kwitansi
Kwitansi profesional dengan logo sekolah, terbilang, dan QR Code

### Laporan
Laporan lengkap dengan filter dan export ke Excel

---

## 🔄 UPDATE SISTEM

Jika ada update dari repository:

```bash
git pull origin main
composer install
php artisan migrate
php artisan cache:clear
```

---

## 🐛 TROUBLESHOOTING

### Error Umum

**1. Key not specified**
```bash
php artisan key:generate
```

**2. Database connection error**
- Cek konfigurasi `.env`
- Pastikan MySQL running

**3. Storage link error**
```bash
php artisan storage:link
```

**4. Cache issues**
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

Untuk troubleshooting lengkap, lihat [PANDUAN_INSTALASI.md](PANDUAN_INSTALASI.md)

---

## 📦 DATA SAMPLE

Setelah menjalankan seeder, sistem akan terisi dengan:
- 2 User (Admin & Petugas)
- 18 Kelas (X, XI, XII untuk IPA, IPS, Bahasa)
- 180 Siswa (10 siswa per kelas)
- 1 Tahun Ajaran Aktif (2025/2026)
- 3 Rekening Bank

---

## 🔒 KEAMANAN

- Password di-hash dengan bcrypt
- CSRF protection pada semua form
- Role-based middleware
- Input validation
- SQL injection protection (Eloquent ORM)

---

## 📝 TODO / ROADMAP

- [ ] Notifikasi pembayaran via WhatsApp
- [ ] Dashboard analytics lebih detail
- [ ] Export PDF untuk laporan
- [ ] Multi tahun ajaran dalam satu view
- [ ] Reminder pembayaran otomatis
- [ ] Payment gateway integration

---

## 🤝 KONTRIBUSI

Jika ingin berkontribusi:
1. Fork repository
2. Buat branch baru (`git checkout -b feature/AmazingFeature`)
3. Commit changes (`git commit -m 'Add some AmazingFeature'`)
4. Push ke branch (`git push origin feature/AmazingFeature`)
5. Buat Pull Request

---

## 📄 LICENSE

Distributed under the MIT License. See `LICENSE` for more information.

---

## 👥 KONTAK

**SMA Negeri 1 Kerajaan**
- Email: admin@smakerajaan.sch.id
- Website: [www.smakerajaan.sch.id](#)

---

## 🙏 ACKNOWLEDGMENTS

- [Laravel](https://laravel.com)
- [Tailwind CSS](https://tailwindcss.com)
- [Material Icons](https://fonts.google.com/icons)
- [Select2](https://select2.org)
- [Laravel Excel](https://laravel-excel.com)

---

**Dibuat dengan ❤️ untuk SMA Negeri 1 Kerajaan**

**Versi**: 1.0  
**Tanggal**: Februari 2026
