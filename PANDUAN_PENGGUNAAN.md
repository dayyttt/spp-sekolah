# Panduan Penggunaan Sistem Pembayaran SPP

## Cara Instalasi

1. Pastikan sudah terinstall:
   - PHP 8.1 atau lebih tinggi
   - Composer
   - MySQL/MariaDB
   - Web Browser

2. Buat database baru di MySQL dengan nama `spp_sekolah`

3. Jalankan file `INSTALL.bat` (double click)

4. Tunggu proses instalasi selesai

5. Jalankan file `START.bat` untuk menjalankan aplikasi

6. Buka browser dan akses: `http://localhost:8000`

## Login

### Admin
- Email: `admin@smakerajaan.sch.id`
- Password: `admin123`

### Petugas
- Email: `petugas@smakerajaan.sch.id`
- Password: `petugas123`

## Menu Utama

### 1. Dashboard
Menampilkan statistik:
- Total siswa
- Total pembayaran bulan ini
- Tahun ajaran aktif

### 2. Data Siswa
- Tambah siswa baru
- Edit data siswa
- Hapus data siswa
- Lihat riwayat pembayaran siswa

### 3. Pembayaran
- Input pembayaran SPP
- Lihat daftar pembayaran
- Cetak bukti pembayaran

## Alur Penggunaan

### Menambah Siswa Baru
1. Klik menu "Data Siswa"
2. Klik tombol "Tambah Siswa"
3. Isi form data siswa
4. Klik "Simpan"

### Input Pembayaran SPP
1. Klik menu "Pembayaran"
2. Klik tombol "Input Pembayaran"
3. Pilih siswa dari dropdown
4. Pilih bulan dan tahun pembayaran
5. Masukkan jumlah bayar (otomatis terisi sesuai nominal SPP)
6. Pilih tanggal bayar
7. Klik "Simpan"

### Melihat Riwayat Pembayaran Siswa
1. Klik menu "Data Siswa"
2. Klik icon jam (history) pada siswa yang ingin dilihat
3. Akan tampil riwayat pembayaran siswa tersebut

## Konfigurasi

### Mengubah Nominal SPP
Edit di database tabel `tahun_ajaran` atau tambahkan fitur CRUD tahun ajaran.

### Menambah User Baru
Tambahkan manual di database tabel `users` atau buat fitur manajemen user.

## Troubleshooting

### Error saat instalasi
- Pastikan Composer sudah terinstall
- Pastikan PHP versi 8.1+
- Pastikan database sudah dibuat

### Tidak bisa login
- Pastikan sudah menjalankan `php artisan migrate --seed`
- Cek kredensial login

### Halaman error 500
- Cek file `.env` sudah dikonfigurasi dengan benar
- Cek koneksi database
- Jalankan `php artisan config:clear`

## Kontak

Untuk bantuan lebih lanjut, hubungi administrator sistem.
