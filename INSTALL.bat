@echo off
echo ========================================
echo INSTALASI SISTEM PEMBAYARAN SPP
echo SMA N 1 KERAJAAN
echo ========================================
echo.

echo [1/6] Menyalin file .env...
copy .env.example .env

echo.
echo [2/6] Install dependencies...
call composer install

echo.
echo [3/6] Generate application key...
call php artisan key:generate

echo.
echo [4/6] Silakan buat database 'spp_sekolah' di MySQL terlebih dahulu
echo      Tekan Enter jika sudah selesai...
pause

echo.
echo [5/6] Menjalankan migrasi database...
call php artisan migrate

echo.
echo [6/6] Menjalankan seeder data awal...
call php artisan db:seed

echo.
echo ========================================
echo INSTALASI SELESAI!
echo ========================================
echo.
echo Login Admin:
echo Email: admin@smakerajaan.sch.id
echo Password: admin123
echo.
echo Login Petugas:
echo Email: petugas@smakerajaan.sch.id
echo Password: petugas123
echo.
echo Jalankan: START.bat untuk menjalankan aplikasi
echo ========================================
pause
