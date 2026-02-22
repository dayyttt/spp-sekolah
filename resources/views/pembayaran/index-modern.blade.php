@extends('layouts.modern')

@section('title', 'Pembayaran SPP')
@section('page-title', 'Pembayaran SPP')

@section('content')
<div class="space-y-4 md:space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl md:text-2xl font-bold text-slate-900 dark:text-white">Data Pembayaran SPP</h2>
            <p class="text-xs md:text-sm text-slate-500 mt-1">Kelola transaksi pembayaran SPP siswa</p>
        </div>
        <a href="{{ route('pembayaran.create') }}" class="flex items-center justify-center gap-2 px-4 py-2.5 bg-primary text-white rounded-lg text-sm font-semibold hover:bg-primary/90 transition-all shadow-sm">
            <span class="material-symbols-outlined text-[20px]">add_circle</span>
            <span class="hidden sm:inline">Input Pembayaran</span>
            <span class="sm:hidden">Input</span>
        </a>
    </div>

    <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse min-w-[900px]">
                <thead>
                    <tr class="bg-slate-50 dark:bg-slate-800/50">
                        <th class="px-4 md:px-6 py-3 md:py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Tanggal</th>
                        <th class="px-4 md:px-6 py-3 md:py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">NIS</th>
                        <th class="px-4 md:px-6 py-3 md:py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Nama Siswa</th>
                        <th class="px-4 md:px-6 py-3 md:py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Kelas</th>
                        <th class="px-4 md:px-6 py-3 md:py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Bulan</th>
                        <th class="px-4 md:px-6 py-3 md:py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Jumlah</th>
                        <th class="px-4 md:px-6 py-3 md:py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Petugas</th>
                        <th class="px-4 md:px-6 py-3 md:py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                    @forelse($pembayaran as $p)
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                        <td class="px-4 md:px-6 py-3 md:py-4 text-sm text-slate-600 dark:text-slate-400 whitespace-nowrap">
                            {{ date('d/m/Y', strtotime($p->tanggal_bayar)) }}
                        </td>
                        <td class="px-4 md:px-6 py-3 md:py-4 text-sm font-medium text-slate-900 dark:text-white">
                            {{ $p->siswa->nis }}
                        </td>
                        <td class="px-4 md:px-6 py-3 md:py-4">
                            <div class="flex items-center gap-2 md:gap-3">
                                <div class="h-7 w-7 md:h-8 md:w-8 rounded-full bg-primary/10 flex items-center justify-center shrink-0">
                                    <span class="text-xs font-bold text-primary">{{ substr($p->siswa->nama, 0, 1) }}</span>
                                </div>
                                <span class="text-sm font-semibold text-slate-900 dark:text-white">{{ $p->siswa->nama }}</span>
                            </div>
                        </td>
                        <td class="px-4 md:px-6 py-3 md:py-4">
                            <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-300 whitespace-nowrap">
                                {{ $p->siswa->kelas->nama_kelas }}
                            </span>
                        </td>
                        <td class="px-4 md:px-6 py-3 md:py-4 text-sm text-slate-600 dark:text-slate-400">
                            {{ $p->bulan }} {{ $p->tahun }}
                        </td>
                        <td class="px-4 md:px-6 py-3 md:py-4 text-sm font-bold text-emerald-600 dark:text-emerald-400 whitespace-nowrap">
                            Rp {{ number_format($p->jumlah_bayar, 0, ',', '.') }}
                        </td>
                        <td class="px-4 md:px-6 py-3 md:py-4 text-sm text-slate-600 dark:text-slate-400">
                            {{ $p->petugas->name }}
                        </td>
                        <td class="px-4 md:px-6 py-3 md:py-4 text-right">
                            <a href="{{ route('pembayaran.print', $p->id) }}" target="_blank" class="inline-flex items-center gap-1 px-3 py-1.5 bg-primary text-white rounded-lg text-xs font-semibold hover:bg-primary/90 transition-all">
                                <span class="material-symbols-outlined text-[16px]">print</span>
                                <span class="hidden sm:inline">Cetak</span>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-4 md:px-6 py-12 text-center">
                            <span class="material-symbols-outlined text-5xl md:text-6xl text-slate-300 dark:text-slate-700 mb-3 block">receipt_long</span>
                            <p class="text-slate-500 font-medium text-sm md:text-base mb-2">Belum ada data pembayaran</p>
                            <a href="{{ route('pembayaran.create') }}" class="inline-flex items-center gap-2 mt-4 px-4 py-2 bg-primary text-white rounded-lg text-sm font-semibold hover:bg-primary/90 transition-all">
                                <span class="material-symbols-outlined text-[18px]">add</span>
                                Input Pembayaran Pertama
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($pembayaran->hasPages())
        <div class="px-4 md:px-6 py-3 md:py-4 bg-slate-50 dark:bg-slate-800/30 flex flex-col sm:flex-row items-center justify-between gap-3 border-t border-slate-100 dark:border-slate-800">
            <p class="text-xs text-slate-500 font-medium">
                Menampilkan {{ $pembayaran->firstItem() }} - {{ $pembayaran->lastItem() }} dari {{ $pembayaran->total() }} pembayaran
            </p>
            <div class="flex gap-2">
                @if($pembayaran->onFirstPage())
                    <button class="px-3 py-1 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded text-xs font-semibold opacity-50 cursor-not-allowed" disabled>Sebelumnya</button>
                @else
                    <a href="{{ $pembayaran->previousPageUrl() }}" class="px-3 py-1 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded text-xs font-semibold hover:bg-slate-50 transition-all">Sebelumnya</a>
                @endif

                @if($pembayaran->hasMorePages())
                    <a href="{{ $pembayaran->nextPageUrl() }}" class="px-3 py-1 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded text-xs font-semibold hover:bg-slate-50 transition-all">Selanjutnya</a>
                @else
                    <button class="px-3 py-1 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded text-xs font-semibold opacity-50 cursor-not-allowed" disabled>Selanjutnya</button>
                @endif
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
