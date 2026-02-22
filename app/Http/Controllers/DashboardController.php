<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Pembayaran;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSiswa = Siswa::count();
        $totalPembayaranBulanIni = Pembayaran::whereMonth('tanggal_bayar', date('m'))
            ->whereYear('tanggal_bayar', date('Y'))
            ->sum('jumlah_bayar');
        $tahunAjaranAktif = TahunAjaran::where('is_active', true)->first();
        $pembayaranTerbaru = Pembayaran::with(['siswa.kelas'])
            ->latest()
            ->limit(5)
            ->get();
        
        return view('dashboard-modern', compact('totalSiswa', 'totalPembayaranBulanIni', 'tahunAjaranAktif', 'pembayaranTerbaru'));
    }
}
