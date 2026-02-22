@extends('layouts.modern')

@section('title', 'Rekening Sekolah')
@section('page-title', 'Rekening Sekolah')

@section('content')
<div class="space-y-4 md:space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl md:text-2xl font-bold text-slate-900 dark:text-white">Rekening Pembayaran</h2>
            <p class="text-xs md:text-sm text-slate-500 mt-1">Kelola rekening bank dan QR code pembayaran SPP</p>
        </div>
        <a href="{{ route('rekening.create') }}" class="flex items-center justify-center gap-2 px-4 py-2.5 bg-primary text-white rounded-lg text-sm font-semibold hover:bg-primary/90 transition-all shadow-sm">
            <span class="material-symbols-outlined text-[20px]">add_circle</span>
            <span class="hidden sm:inline">Tambah Rekening</span>
            <span class="sm:hidden">Tambah</span>
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 md:gap-6">
        @forelse($rekening as $rek)
        <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm hover:shadow-md transition-shadow p-6">
            <div class="flex items-start justify-between mb-4">
                <div class="flex items-center gap-3 flex-1">
                    <div class="bg-primary/10 p-3 rounded-lg">
                        <span class="material-symbols-outlined text-primary text-[24px]">account_balance</span>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white">{{ $rek->nama_bank }}</h3>
                        @if($rek->is_active)
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 bg-emerald-100 dark:bg-emerald-500/20 text-emerald-700 dark:text-emerald-400 text-xs font-semibold rounded-full mt-1">
                            <span class="material-symbols-outlined text-[14px]">check_circle</span>
                            Aktif
                        </span>
                        @else
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-400 text-xs font-semibold rounded-full mt-1">
                            Tidak Aktif
                        </span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="space-y-3 mb-4">
                <div class="bg-slate-50 dark:bg-slate-800 rounded-lg p-3">
                    <p class="text-xs text-slate-500 mb-1">Nomor Rekening</p>
                    <p class="text-lg font-bold text-slate-900 dark:text-white font-mono">{{ $rek->nomor_rekening }}</p>
                </div>
                <div class="flex items-center gap-2 text-sm">
                    <span class="material-symbols-outlined text-slate-400 text-[18px]">person</span>
                    <span class="text-slate-600 dark:text-slate-400">a.n. <span class="font-semibold">{{ $rek->atas_nama }}</span></span>
                </div>
                @if($rek->qr_code)
                <div class="flex items-center gap-2 text-sm">
                    <span class="material-symbols-outlined text-emerald-500 text-[18px]">qr_code_2</span>
                    <span class="text-emerald-600 dark:text-emerald-400 font-medium">QR Code tersedia</span>
                </div>
                @endif
            </div>

            @if($rek->qr_code)
            <div class="mb-4 p-3 bg-slate-50 dark:bg-slate-800 rounded-lg">
                <p class="text-xs text-slate-500 mb-2 font-semibold">QR Code Pembayaran:</p>
                <img src="{{ asset('storage/' . $rek->qr_code) }}" alt="QR Code {{ $rek->nama_bank }}" class="w-32 h-32 object-contain mx-auto border border-slate-200 dark:border-slate-700 rounded-lg bg-white">
            </div>
            @endif

            <div class="flex gap-2 pt-4 border-t border-slate-200 dark:border-slate-800">
                <a href="{{ route('rekening.edit', $rek->id) }}" class="flex-1 flex items-center justify-center gap-2 px-3 py-2 bg-orange-50 text-orange-600 hover:bg-orange-100 dark:bg-orange-500/10 dark:hover:bg-orange-500/20 rounded-lg text-sm font-semibold transition-all">
                    <span class="material-symbols-outlined text-[18px]">edit</span>
                    Edit
                </a>
                <form action="{{ route('rekening.destroy', $rek->id) }}" method="POST" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Yakin ingin menghapus rekening ini?')" class="w-full flex items-center justify-center gap-2 px-3 py-2 bg-red-50 text-red-600 hover:bg-red-100 dark:bg-red-500/10 dark:hover:bg-red-500/20 rounded-lg text-sm font-semibold transition-all">
                        <span class="material-symbols-outlined text-[18px]">delete</span>
                        Hapus
                    </button>
                </form>
            </div>
        </div>
        @empty
        <div class="col-span-full bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm p-12 text-center">
            <span class="material-symbols-outlined text-6xl text-slate-300 dark:text-slate-700 mb-3 block">account_balance</span>
            <p class="text-slate-500 font-medium mb-4">Belum ada data rekening</p>
            <a href="{{ route('rekening.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-primary text-white rounded-lg text-sm font-semibold hover:bg-primary/90 transition-all">
                <span class="material-symbols-outlined text-[18px]">add</span>
                Tambah Rekening Pertama
            </a>
        </div>
        @endforelse
    </div>
</div>
@endsection
