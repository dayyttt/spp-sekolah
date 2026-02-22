<?php

namespace App\Http\Controllers;

use App\Models\RekeningSekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RekeningSekolahController extends Controller
{
    public function index()
    {
        $rekening = RekeningSekolah::orderBy('is_active', 'desc')->orderBy('nama_bank')->get();
        return view('rekening.index', compact('rekening'));
    }

    public function create()
    {
        return view('rekening.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_bank' => 'required|string|max:255',
            'nomor_rekening' => 'required|string|max:255',
            'atas_nama' => 'required|string|max:255',
            'qr_code' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->only(['nama_bank', 'nomor_rekening', 'atas_nama']);
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('qr_code')) {
            $data['qr_code'] = $request->file('qr_code')->store('qr-codes', 'public');
        }

        RekeningSekolah::create($data);

        return redirect()->route('rekening.index')->with('success', 'Rekening berhasil ditambahkan');
    }

    public function edit(RekeningSekolah $rekening)
    {
        return view('rekening.edit', compact('rekening'));
    }

    public function update(Request $request, RekeningSekolah $rekening)
    {
        $request->validate([
            'nama_bank' => 'required|string|max:255',
            'nomor_rekening' => 'required|string|max:255',
            'atas_nama' => 'required|string|max:255',
            'qr_code' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->only(['nama_bank', 'nomor_rekening', 'atas_nama']);
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('qr_code')) {
            // Delete old QR code if exists
            if ($rekening->qr_code) {
                Storage::disk('public')->delete($rekening->qr_code);
            }
            $data['qr_code'] = $request->file('qr_code')->store('qr-codes', 'public');
        }

        $rekening->update($data);

        return redirect()->route('rekening.index')->with('success', 'Rekening berhasil diupdate');
    }

    public function destroy(RekeningSekolah $rekening)
    {
        // Delete QR code if exists
        if ($rekening->qr_code) {
            Storage::disk('public')->delete($rekening->qr_code);
        }

        $rekening->delete();
        return redirect()->route('rekening.index')->with('success', 'Rekening berhasil dihapus');
    }
}
