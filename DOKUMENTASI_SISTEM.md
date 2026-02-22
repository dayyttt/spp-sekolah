# DOKUMENTASI SISTEM PEMBAYARAN SPP
## SMA NEGERI 1 KERAJAAN

---

## DAFTAR ISI
1. [Tentang Sistem](#tentang-sistem)
2. [Role & Hak Akses](#role--hak-akses)
3. [Fitur-Fitur Sistem](#fitur-fitur-sistem)
4. [Panduan Penggunaan](#panduan-penggunaan)
5. [Informasi Teknis](#informasi-teknis)

---

## TENTANG SISTEM

Sistem Pembayaran SPP adalah aplikasi berbasis web yang dibangun menggunakan Laravel untuk mengelola pembayaran SPP (Sumbangan Pembinaan Pendidikan) di SMA Negeri 1 Kerajaan. Sistem ini dirancang dengan antarmuka modern menggunakan Tailwind CSS dan mendukung mode gelap (dark mode).

### Teknologi yang Digunakan
- **Framework**: Laravel 10
- **Database**: MySQL
- **Frontend**: Tailwind CSS, Material Icons
- **Library**: Select2, Laravel Excel (Maatwebsite)

---

## ROLE & HAK AKSES

Sistem memiliki 2 role pengguna dengan hak akses yang berbeda:

### 1. ADMIN
**Hak Akses Penuh** - Dapat mengakses semua fitur sistem

**Menu yang Dapat Diakses:**
- ✅ Dashboard
- ✅ Data Kelas
- ✅ Data Siswa
- ✅ Tahun Ajaran
- ✅ Rekening Sekolah
- ✅ Pembayaran SPP
- ✅ Laporan

**Fungsi Utama:**
- Mengelola data master (kelas, siswa, tahun ajaran, rekening)
- Melakukan input pembayaran SPP
- Melihat dan mencetak laporan
- Mengatur konfigurasi sistem

**Akun Default:**
- Email: `admin@smakerajaan.sch.id`
- Password: `admin123`

---

### 2. PETUGAS
**Hak Akses Terbatas** - Hanya dapat mengakses fitur operasional

**Menu yang Dapat Diakses:**
- ✅ Dashboard
- ✅ Pembayaran SPP
- ✅ Laporan

**Menu yang TIDAK Dapat Diakses:**
- ❌ Data Kelas
- ❌ Data Siswa
- ❌ Tahun Ajaran
- ❌ Rekening Sekolah

**Fungsi Utama:**
- Melakukan input pembayaran SPP
- Melihat riwayat pembayaran
- Mencetak kwitansi pembayaran
- Melihat dan export laporan

**Akun Default:**
- Email: `petugas@smakerajaan.sch.id`
- Password: `petugas123`

---

## FITUR-FITUR SISTEM

### 1. DASHBOARD
**Akses:** Admin & Petugas

**Fitur:**
- Statistik pembayaran bulan ini
- Total pembayaran hari ini
- Jumlah siswa aktif
- Jumlah kelas
- Grafik atau ringkasan pembayaran

**Fungsi:**
- Memberikan overview cepat tentang kondisi pembayaran SPP
- Monitoring aktivitas pembayaran

---

### 2. DATA KELAS
**Akses:** Admin Only

**Fitur:**
- Tambah kelas baru
- Edit data kelas
- Hapus kelas
- Lihat daftar kelas

**Informasi yang Dikelola:**
- Nama Kelas (contoh: X IPA 1, XI IPS 2, XII BAHASA 1)
- Jumlah siswa per kelas

**Validasi:**
- Tidak dapat menghapus kelas yang masih memiliki siswa

---

### 3. DATA SISWA
**Akses:** Admin Only

**Fitur:**
- Tambah siswa baru
- Edit data siswa
- Hapus siswa
- Lihat daftar siswa
- Filter siswa berdasarkan kelas
- Pencarian siswa

**Informasi yang Dikelola:**
- NIS (Nomor Induk Siswa)
- Nama Lengkap
- Kelas
- Jenis Kelamin
- Alamat
- Nomor Telepon

**Validasi:**
- NIS harus unik
- Tidak dapat menghapus siswa yang memiliki riwayat pembayaran

---

### 4. TAHUN AJARAN
**Akses:** Admin Only

**Fitur:**
- Tambah tahun ajaran baru
- Edit tahun ajaran
- Hapus tahun ajaran
- Set tahun ajaran aktif
- Atur nominal SPP per tahun ajaran

**Informasi yang Dikelola:**
- Tahun Ajaran (contoh: 2025/2026)
- Nominal SPP (format Rupiah)
- Status Aktif

**Aturan:**
- Hanya 1 tahun ajaran yang dapat aktif
- Tidak dapat menghapus tahun ajaran yang sedang aktif
- Tidak dapat menghapus tahun ajaran yang memiliki transaksi pembayaran

---

### 5. REKENING SEKOLAH
**Akses:** Admin Only

**Fitur:**
- Tambah rekening bank
- Edit rekening bank
- Hapus rekening bank
- Upload QR Code pembayaran
- Set status aktif/non-aktif

**Informasi yang Dikelola:**
- Nama Bank
- Nomor Rekening
- Atas Nama
- QR Code (opsional)
- Status (Aktif/Tidak Aktif)

**Fungsi:**
- Menyediakan informasi rekening untuk pembayaran transfer
- Menampilkan QR Code untuk pembayaran digital

---

### 6. PEMBAYARAN SPP
**Akses:** Admin & Petugas

#### 6.1 Input Pembayaran
**Fitur:**
- Form input pembayaran dengan Select2 (pencarian siswa)
- Pilih siswa (search by NIS/Nama/Kelas)
- Pilih bulan dan tahun pembayaran
- Input jumlah bayar (format Rupiah otomatis)
- Pilih rekening tujuan (opsional)
- Preview QR Code jika pilih rekening
- Input tanggal bayar
- Keterangan tambahan

**Informasi yang Tercatat:**
- Data siswa
- Tahun ajaran
- Bulan pembayaran
- Tahun pembayaran
- Jumlah bayar
- Rekening tujuan (jika transfer)
- Tanggal bayar
- Petugas yang input
- Keterangan

**Catatan Penting:**
- Sistem memungkinkan pembayaran ganda dalam 1 bulan (untuk cicilan)
- Nominal SPP otomatis terisi sesuai tahun ajaran aktif
- Dapat diubah jika ada pembayaran sebagian/cicilan

#### 6.2 Riwayat Pembayaran
**Fitur:**
- Lihat semua transaksi pembayaran
- Filter berdasarkan:
  - Siswa
  - Bulan
  - Tahun
  - Kelas
- Pencarian transaksi
- Status pembayaran per bulan (12 bulan)
- Cetak kwitansi per transaksi

**Status Pembayaran:**
- ✅ Hijau = Sudah Bayar
- ❌ Merah = Belum Bayar

#### 6.3 Cetak Kwitansi
**Fitur:**
- Header dengan logo sekolah
- Nomor kwitansi otomatis
- Data siswa lengkap
- Detail pembayaran
- Terbilang (angka ke kata)
- Metode pembayaran:
  - Tunai
  - Transfer Bank (dengan detail rekening)
- QR Code (jika pembayaran via transfer dan rekening memiliki QR)
- Tanda tangan petugas dan kepala sekolah
- Print-friendly design

---

### 7. LAPORAN
**Akses:** Admin & Petugas

**Fitur:**
- Filter laporan berdasarkan:
  - Bulan
  - Tahun
- Statistik pembayaran:
  - Total transaksi
  - Total nominal
  - Rata-rata pembayaran
- Ringkasan per kelas:
  - Jumlah siswa
  - Sudah bayar
  - Belum bayar
  - Total nominal per kelas
- Tabel detail transaksi
- Export ke Excel

**Format Export Excel:**
- Nama file: `Laporan_Pembayaran_SPP_[Bulan]_[Tahun].xlsx`
- Kolom: No, Tanggal Bayar, NIS, Nama Siswa, Kelas, Bulan, Tahun, Jumlah Bayar, Petugas
- Styling: Header berwarna, border, auto-width

---

## PANDUAN PENGGUNAAN

### ALUR KERJA SISTEM

#### A. PERSIAPAN AWAL (Admin)
1. Login sebagai Admin
2. Kelola Data Kelas
   - Tambah semua kelas yang ada (X, XI, XII)
3. Kelola Tahun Ajaran
   - Tambah tahun ajaran baru
   - Set nominal SPP
   - Aktifkan tahun ajaran
4. Kelola Rekening Sekolah
   - Tambah rekening bank sekolah
   - Upload QR Code jika ada
   - Set status aktif
5. Kelola Data Siswa
   - Input data siswa per kelas
   - Pastikan NIS unik

#### B. OPERASIONAL HARIAN (Admin/Petugas)
1. Login ke sistem
2. Cek Dashboard untuk overview
3. Input Pembayaran SPP:
   - Pilih menu Pembayaran
   - Klik "Tambah Pembayaran"
   - Cari dan pilih siswa
   - Pilih bulan dan tahun
   - Input jumlah bayar
   - Pilih rekening jika transfer
   - Simpan
4. Cetak Kwitansi:
   - Dari riwayat pembayaran
   - Klik tombol cetak
   - Print atau save PDF

#### C. PELAPORAN (Admin/Petugas)
1. Pilih menu Laporan
2. Pilih bulan dan tahun
3. Klik "Tampilkan Laporan"
4. Review data
5. Export ke Excel jika diperlukan

---

### TIPS PENGGUNAAN

#### Untuk Admin:
- Selalu backup data secara berkala
- Update data siswa setiap awal tahun ajaran
- Pastikan hanya 1 tahun ajaran yang aktif
- Verifikasi nominal SPP sebelum input pembayaran
- Kelola rekening bank dengan baik

#### Untuk Petugas:
- Cek data siswa sebelum input pembayaran
- Pastikan bulan dan tahun pembayaran benar
- Cetak kwitansi langsung setelah input
- Gunakan fitur pencarian untuk efisiensi
- Cek riwayat pembayaran siswa sebelum input

#### Umum:
- Gunakan mode gelap untuk kenyamanan mata
- Sistem responsive, bisa diakses via mobile
- Logout setelah selesai menggunakan sistem
- Jangan share password ke orang lain

---

## INFORMASI TEKNIS

### Instalasi & Setup
Lihat file: `PANDUAN_PENGGUNAAN.md`

### Database
- **Tabel Utama:**
  - users (pengguna sistem)
  - kelas (data kelas)
  - siswa (data siswa)
  - tahun_ajaran (tahun ajaran & nominal SPP)
  - rekening_sekolahs (rekening bank)
  - pembayaran (transaksi pembayaran)

### Keamanan
- Password di-hash menggunakan bcrypt
- Middleware untuk role-based access control
- CSRF protection pada semua form
- Validasi input di server-side

### Fitur Teknis
- **Select2**: Pencarian siswa yang cepat
- **Format Rupiah**: Otomatis format ribuan
- **Dark Mode**: Support tema gelap
- **Responsive**: Mobile, tablet, desktop friendly
- **Export Excel**: Laporan dalam format Excel
- **Print Layout**: Kwitansi print-friendly

---

## KONTAK & DUKUNGAN

Untuk pertanyaan atau bantuan teknis, hubungi:
- **Admin Sistem**: admin@smakerajaan.sch.id
- **Sekolah**: SMA Negeri 1 Kerajaan

---

**Versi Dokumentasi**: 1.0  
**Tanggal**: Februari 2026  
**Sistem**: Pembayaran SPP SMA N 1 Kerajaan
