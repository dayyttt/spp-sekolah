@extends('layouts.modern')

@section('title', 'Riwayat Pembayaran')
@section('page-title', 'Riwayat Pembayaran')

@section('content')
<div class="space-y-4 md:space-y-6">
    <div class="mb-4 md:mb-6">
        <a href="{{ route('siswa.index') }}" class="inline-flex items-center gap-2 text-sm text-slate-600 dark:text-slate-400 hover:text-primary transition-colors">
            <span class="material-symbols-outlined text-[18px]">arrow_back</span>
            <span class="hidden sm:inline">Kembali ke Daftar Siswa</span>
            <span class="sm:hidden">Kembali</span>
        </a>
    </div>

    <!-- Student Info Card -->
    <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm p-4 md:p-6">
        <div class="flex items-start gap-4">
            <div class="h-16 w-16 md:h-20 md:w-20 rounded-full bg-primary/10 flex items-center justify-center shrink-0">
                <span class="text-2xl md:text-3xl font-bold text-primary">{{ substr($siswa->nama, 0, 1) }}</span>
            </div>
            <div class="flex-1 min-w-0">
                <h3 class="text-lg md:text-xl font-bold text-slate-900 dark:text-white mb-2">{{ $siswa->nama }}</h3>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-slate-400 text-[18px]">badge</span>
                        <div>
                            <p class="text-xs text-slate-500">NIS</p>
                            <p class="text-sm font-semibold text-slate-900 dark:text-white">{{ $siswa->nis }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-slate-400 text-[18px]">school</span>
                        <div>
                            <p class="text-xs text-slate-500">Kelas</p>
                            <p class="text-sm font-semibold text-slate-900 dark:text-white">{{ $siswa->kelas->nama_kelas }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-slate-400 text-[18px]">person</span>
                        <div>
                            <p class="text-xs text-slate-500">Jenis Kelamin</p>
                            <p class="text-sm font-semibold text-slate-900 dark:text-white">{{ $siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Payment History -->
    <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden">
        <div class="p-4 md:p-6 border-b border-slate-200 dark:border-slate-800">
            <h3 class="text-base md:text-lg font-bold text-slate-900 dark:text-white flex items-center gap-2">
                <span class="material-symbols-outlined text-[20px]">calendar_month</span>
                Status Pembayaran Tahun {{ $tahunIni }}
            </h3>
        </div>

        <div class="p-4 md:p-6">
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-3">
                @foreach($statusPembayaran as $status)
                <div class="p-3 rounded-lg border {{ $status['status'] == 'lunas' ? 'bg-emerald-50 border-emerald-200 dark:bg-emerald-500/10 dark:border-emerald-500/20' : 'bg-slate-50 border-slate-200 dark:bg-slate-800 dark:border-slate-700' }}">
                    <div class="flex items-center justify-between mb-1">
                        <span class="text-xs font-semibold {{ $status['status'] == 'lunas' ? 'text-emerald-700 dark:text-emerald-400' : 'text-slate-500' }}">
                            {{ $status['bulan'] }}
                        </span>
                        @if($status['status'] == 'lunas')
                            <span class="material-symbols-outlined text-emerald-600 dark:text-emerald-400 text-[16px]">check_circle</span>
                        @else
                            <span class="material-symbols-outlined text-slate-400 text-[16px]">cancel</span>
                        @endif
                    </div>
                    <p class="text-[10px] font-bold {{ $status['status'] == 'lunas' ? 'text-emerald-600 dark:text-emerald-400' : 'text-slate-400' }}">
                        {{ $status['status'] == 'lunas' ? 'LUNAS' : 'BELUM' }}
                    </p>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Payment History Table -->
    <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden">
        <div class="p-4 md:p-6 border-b border-slate-200 dark:border-slate-800">
            <h3 class="text-base md:text-lg font-bold text-slate-900 dark:text-white flex items-center gap-2">
                <span class="material-symbols-outlined text-[20px]">history</span>
                Riwayat Pembayaran SPP
            </h3>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse min-w-[600px]">
                <thead>
                    <tr class="bg-slate-50 dark:bg-slate-800/50">
                        <th class="px-4 md:px-6 py-3 md:py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Tanggal Bayar</th>
                        <th class="px-4 md:px-6 py-3 md:py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Bulan</th>
                        <th class="px-4 md:px-6 py-3 md:py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Tahun</th>
                        <th class="px-4 md:px-6 py-3 md:py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Jumlah</th>
                        <th class="px-4 md:px-6 py-3 md:py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Petugas</th>
                        <th class="px-4 md:px-6 py-3 md:py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Keterangan</th>
                        <th class="px-4 md:px-6 py-3 md:py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                    @forelse($pembayaran as $p)
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                        <td class="px-4 md:px-6 py-3 md:py-4 text-sm text-slate-600 dark:text-slate-400 whitespace-nowrap">
                            {{ date('d/m/Y', strtotime($p->tanggal_bayar)) }}
                        </td>
                        <td class="px-4 md:px-6 py-3 md:py-4">
                            <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-700 dark:bg-blue-500/10 dark:text-blue-400">
                                {{ $p->bulan }}
                            </span>
                        </td>
                        <td class="px-4 md:px-6 py-3 md:py-4 text-sm text-slate-600 dark:text-slate-400">
                            {{ $p->tahun }}
                        </td>
                        <td class="px-4 md:px-6 py-3 md:py-4 text-sm font-bold text-emerald-600 dark:text-emerald-400 whitespace-nowrap">
                            Rp {{ number_format($p->jumlah_bayar, 0, ',', '.') }}
                        </td>
                        <td class="px-4 md:px-6 py-3 md:py-4 text-sm text-slate-600 dark:text-slate-400">
                            {{ $p->petugas->name }}
                        </td>
                        <td class="px-4 md:px-6 py-3 md:py-4 text-sm text-slate-600 dark:text-slate-400">
                            {{ $p->keterangan ?? '-' }}
                        </td>
                        <td class="px-4 md:px-6 py-3 md:py-4 text-right">
                            <a href="{{ route('pembayaran.print', $p->id) }}" target="_blank" class="inline-flex items-center gap-1 px-2 py-1 bg-primary text-white rounded-lg text-xs font-semibold hover:bg-primary/90 transition-all">
                                <span class="material-symbols-outlined text-[14px]">print</span>
                                <span class="hidden md:inline">Cetak</span>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-4 md:px-6 py-12 text-center">
                            <span class="material-symbols-outlined text-5xl md:text-6xl text-slate-300 dark:text-slate-700 mb-3 block">receipt_long</span>
                            <p class="text-slate-500 font-medium text-sm md:text-base mb-2">Belum ada riwayat pembayaran</p>
                            <p class="text-xs text-slate-400">Siswa ini belum melakukan pembayaran SPP</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($pembayaran->count() > 0)
        <div class="p-4 md:p-6 bg-slate-50 dark:bg-slate-800/30 border-t border-slate-100 dark:border-slate-800">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-3">
                <div class="text-sm text-slate-600 dark:text-slate-400">
                    <span class="font-semibold">Total Pembayaran:</span>
                    <span class="ml-2 text-lg font-bold text-emerald-600 dark:text-emerald-400">
                        Rp {{ number_format($pembayaran->sum('jumlah_bayar'), 0, ',', '.') }}
                    </span>
                </div>
                <a href="{{ route('siswa.index') }}" class="flex items-center gap-2 px-4 py-2 bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 rounded-lg text-sm font-semibold hover:bg-slate-200 dark:hover:bg-slate-700 transition-all">
                    <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                    Kembali
                </a>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
