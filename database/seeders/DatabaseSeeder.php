<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Kelas;
use App\Models\TahunAjaran;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // User Admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@smakerajaan.sch.id',
            'password' => bcrypt('admin123'),
            'role' => 'admin',
        ]);

        // User Petugas
        User::create([
            'name' => 'Petugas SPP',
            'email' => 'petugas@smakerajaan.sch.id',
            'password' => bcrypt('petugas123'),
            'role' => 'petugas',
        ]);

        // Kelas
        $tingkat = ['X', 'XI', 'XII'];
        $jurusan = ['IPA', 'IPS'];
        
        $kelasData = [];
        foreach ($tingkat as $t) {
            foreach ($jurusan as $j) {
                for ($i = 1; $i <= 3; $i++) {
                    $kelasData[] = Kelas::create([
                        'nama_kelas' => $t . ' ' . $j . ' ' . $i,
                        'tingkat' => $t,
                        'jurusan' => $j,
                    ]);
                }
            }
        }

        // Tahun Ajaran
        TahunAjaran::create([
            'tahun' => '2025/2026',
            'nominal_spp' => 500000,
            'is_active' => true,
        ]);

        // Rekening Sekolah
        \App\Models\RekeningSekolah::create([
            'nama_bank' => 'Bank BRI',
            'nomor_rekening' => '0123456789012345',
            'atas_nama' => 'SMA N 1 KERAJAAN',
            'is_active' => true,
        ]);

        \App\Models\RekeningSekolah::create([
            'nama_bank' => 'Bank Mandiri',
            'nomor_rekening' => '1234567890123',
            'atas_nama' => 'SMA NEGERI 1 KERAJAAN',
            'is_active' => true,
        ]);

        \App\Models\RekeningSekolah::create([
            'nama_bank' => 'Bank BCA',
            'nomor_rekening' => '9876543210',
            'atas_nama' => 'SMAN 1 KERAJAAN',
            'is_active' => false,
        ]);

        // Data Siswa Sample
        $namaSiswaLaki = [
            'Ahmad Fauzi', 'Budi Santoso', 'Dedi Kurniawan', 'Eko Prasetyo', 'Fajar Ramadhan',
            'Gilang Pratama', 'Hendra Wijaya', 'Irfan Hakim', 'Joko Susilo', 'Kurniawan Adi',
            'Lukman Hakim', 'Muhammad Rizki', 'Nur Hidayat', 'Oki Setiawan', 'Putra Mahendra',
            'Reza Pahlevi', 'Sandi Permana', 'Taufik Rahman', 'Umar Bakri', 'Wahyu Nugroho'
        ];

        $namaSiswaPerempuan = [
            'Ayu Lestari', 'Bella Safitri', 'Citra Dewi', 'Dina Marlina', 'Eka Putri',
            'Fitri Handayani', 'Gita Permata', 'Hani Rahmawati', 'Indah Sari', 'Jihan Aulia',
            'Kartika Sari', 'Lina Marlina', 'Maya Anggraini', 'Nisa Amalia', 'Olivia Putri',
            'Putri Ayu', 'Rina Wati', 'Siti Nurhaliza', 'Tari Wulandari', 'Vina Melinda'
        ];

        $nisCounter = 2025001;
        $nisnCounter = 1234567890;

        // Generate siswa untuk setiap kelas
        foreach ($kelasData as $kelas) {
            // 5 siswa laki-laki per kelas
            for ($i = 0; $i < 5; $i++) {
                if (!empty($namaSiswaLaki)) {
                    $nama = array_shift($namaSiswaLaki);
                    \App\Models\Siswa::create([
                        'nis' => (string)$nisCounter++,
                        'nisn' => (string)$nisnCounter++,
                        'nama' => $nama,
                        'kelas_id' => $kelas->id,
                        'jenis_kelamin' => 'L',
                        'alamat' => 'Jl. Pendidikan No. ' . rand(1, 100) . ', Kerajaan',
                        'no_telp' => '08' . rand(1000000000, 9999999999),
                        'nama_wali' => 'Bapak ' . explode(' ', $nama)[0],
                    ]);
                }
            }

            // 5 siswa perempuan per kelas
            for ($i = 0; $i < 5; $i++) {
                if (!empty($namaSiswaPerempuan)) {
                    $nama = array_shift($namaSiswaPerempuan);
                    \App\Models\Siswa::create([
                        'nis' => (string)$nisCounter++,
                        'nisn' => (string)$nisnCounter++,
                        'nama' => $nama,
                        'kelas_id' => $kelas->id,
                        'jenis_kelamin' => 'P',
                        'alamat' => 'Jl. Pendidikan No. ' . rand(1, 100) . ', Kerajaan',
                        'no_telp' => '08' . rand(1000000000, 9999999999),
                        'nama_wali' => 'Ibu ' . explode(' ', $nama)[0],
                    ]);
                }
            }
        }
    }
}
