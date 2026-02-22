<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanPembayaranExport;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->input('bulan', date('m'));
        $tahun = $request->input('tahun', date('Y'));
        
        // Laporan pembayaran per bulan
        $pembayaranBulan = Pembayaran::with(['siswa.kelas'])
            ->whereMonth('tanggal_bayar', $bulan)
            ->whereYear('tanggal_bayar', $tahun)
            ->orderBy('tanggal_bayar', 'desc')
            ->get();
        
        $totalPembayaran = $pembayaranBulan->sum('jumlah_bayar');
        $jumlahTransaksi = $pembayaranBulan->count();
        
        // Statistik per kelas
        $perKelas = Pembayaran::select('kelas.nama_kelas', DB::raw('COUNT(*) as jumlah'), DB::raw('SUM(pembayaran.jumlah_bayar) as total'))
            ->join('siswa', 'pembayaran.siswa_id', '=', 'siswa.id')
            ->join('kelas', 'siswa.kelas_id', '=', 'kelas.id')
            ->whereMonth('pembayaran.tanggal_bayar', $bulan)
            ->whereYear('pembayaran.tanggal_bayar', $tahun)
            ->groupBy('kelas.id', 'kelas.nama_kelas')
            ->get();
        
        return view('laporan.index', compact('pembayaranBulan', 'totalPembayaran', 'jumlahTransaksi', 'perKelas', 'bulan', 'tahun'));
    }

    public function export(Request $request)
    {
        $bulan = $request->input('bulan', date('m'));
        $tahun = $request->input('tahun', date('Y'));
        
        $namaBulan = [
            '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April',
            '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus',
            '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
        ];
        
        $filename = 'Laporan_Pembayaran_SPP_' . $namaBulan[$bulan] . '_' . $tahun . '.xlsx';
        
        return Excel::download(new LaporanPembayaranExport($bulan, $tahun), $filename);
    }
}
