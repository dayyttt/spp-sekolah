<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function index()
    {
        $pembayaran = Pembayaran::with(['siswa.kelas', 'petugas'])->latest()->paginate(20);
        return view('pembayaran.index-modern', compact('pembayaran'));
    }

    public function create()
    {
        $siswa = Siswa::with('kelas')->get();
        $tahunAjaran = TahunAjaran::where('is_active', true)->first();
        $rekening = \App\Models\RekeningSekolah::where('is_active', true)->get();
        return view('pembayaran.create-modern', compact('siswa', 'tahunAjaran', 'rekening'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswa,id',
            'tahun_ajaran_id' => 'required|exists:tahun_ajaran,id',
            'bulan' => 'required',
            'tahun' => 'required',
            'jumlah_bayar' => 'required|numeric',
            'tanggal_bayar' => 'required|date',
            'rekening_id' => 'nullable|exists:rekening_sekolahs,id',
        ]);

        Pembayaran::create([
            'siswa_id' => $request->siswa_id,
            'tahun_ajaran_id' => $request->tahun_ajaran_id,
            'bulan' => $request->bulan,
            'tahun' => $request->tahun,
            'jumlah_bayar' => $request->jumlah_bayar,
            'tanggal_bayar' => $request->tanggal_bayar,
            'petugas_id' => auth()->id(),
            'keterangan' => $request->keterangan,
            'rekening_id' => $request->rekening_id,
        ]);

        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran berhasil dicatat');
    }

    public function print($id)
    {
        $pembayaran = Pembayaran::with(['siswa.kelas', 'petugas', 'rekening'])->findOrFail($id);
        return view('pembayaran.print', compact('pembayaran'));
    }

    public function show(Siswa $siswa)
    {
        $pembayaran = Pembayaran::where('siswa_id', $siswa->id)
            ->with('tahunAjaran', 'petugas')
            ->orderBy('tahun', 'desc')
            ->orderByRaw("FIELD(bulan, 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember')")
            ->get();
        
        // Status pembayaran tahun ini
        $tahunIni = date('Y');
        $bulanList = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        
        $statusPembayaran = [];
        foreach ($bulanList as $bulan) {
            $sudahBayar = $pembayaran->where('tahun', $tahunIni)->where('bulan', $bulan)->first();
            $statusPembayaran[] = [
                'bulan' => $bulan,
                'status' => $sudahBayar ? 'lunas' : 'belum',
                'data' => $sudahBayar
            ];
        }
        
        return view('pembayaran.history-modern', compact('siswa', 'pembayaran', 'statusPembayaran', 'tahunIni'));
    }
}
