<?php

namespace App\Http\Controllers;

use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class TahunAjaranController extends Controller
{
    public function index()
    {
        $tahunAjaran = TahunAjaran::orderBy('is_active', 'desc')->orderBy('tahun', 'desc')->get();
        return view('tahun-ajaran.index', compact('tahunAjaran'));
    }

    public function create()
    {
        return view('tahun-ajaran.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tahun' => 'required|unique:tahun_ajaran',
            'nominal_spp' => 'required|numeric|min:0',
        ]);

        // Jika set sebagai aktif, nonaktifkan yang lain
        if ($request->has('is_active')) {
            TahunAjaran::where('is_active', true)->update(['is_active' => false]);
        }

        TahunAjaran::create([
            'tahun' => $request->tahun,
            'nominal_spp' => $request->nominal_spp,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('tahun-ajaran.index')->with('success', 'Tahun ajaran berhasil ditambahkan');
    }

    public function edit(TahunAjaran $tahunAjaran)
    {
        return view('tahun-ajaran.edit', compact('tahunAjaran'));
    }

    public function update(Request $request, TahunAjaran $tahunAjaran)
    {
        $request->validate([
            'tahun' => 'required|unique:tahun_ajaran,tahun,' . $tahunAjaran->id,
            'nominal_spp' => 'required|numeric|min:0',
        ]);

        // Jika set sebagai aktif, nonaktifkan yang lain
        if ($request->has('is_active')) {
            TahunAjaran::where('is_active', true)->where('id', '!=', $tahunAjaran->id)->update(['is_active' => false]);
        }

        $tahunAjaran->update([
            'tahun' => $request->tahun,
            'nominal_spp' => $request->nominal_spp,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('tahun-ajaran.index')->with('success', 'Tahun ajaran berhasil diupdate');
    }

    public function destroy(TahunAjaran $tahunAjaran)
    {
        if ($tahunAjaran->is_active) {
            return redirect()->route('tahun-ajaran.index')->with('error', 'Tidak bisa menghapus tahun ajaran yang sedang aktif');
        }

        if ($tahunAjaran->pembayaran()->count() > 0) {
            return redirect()->route('tahun-ajaran.index')->with('error', 'Tidak bisa menghapus tahun ajaran yang sudah ada transaksi pembayaran');
        }

        $tahunAjaran->delete();
        return redirect()->route('tahun-ajaran.index')->with('success', 'Tahun ajaran berhasil dihapus');
    }

    public function setActive($id)
    {
        // Nonaktifkan semua
        TahunAjaran::where('is_active', true)->update(['is_active' => false]);
        
        // Aktifkan yang dipilih
        $tahunAjaran = TahunAjaran::findOrFail($id);
        $tahunAjaran->update(['is_active' => true]);

        return redirect()->route('tahun-ajaran.index')->with('success', 'Tahun ajaran ' . $tahunAjaran->tahun . ' berhasil diaktifkan');
    }
}
