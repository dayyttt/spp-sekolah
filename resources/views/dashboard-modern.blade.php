@extends('layouts.modern')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="space-y-6 md:space-y-8">
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6">
        <div class="bg-white dark:bg-slate-900 p-4 md:p-6 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-3 md:mb-4">
                <div class="bg-emerald-100 dark:bg-emerald-500/10 p-2 md:p-3 rounded-lg">
                    <span class="material-symbols-outlined text-emerald-600 dark:text-emerald-400 text-[20px] md:text-[24px]">payments</span>
                </div>
                <span class="text-[10px] md:text-xs font-semibold text-emerald-600 bg-emerald-50 dark:bg-emerald-500/10 px-2 py-1 rounded-full">Bulan Ini</span>
            </div>
            <p class="text-slate-500 dark:text-slate-400 text-xs md:text-sm font-medium">Total Pembayaran</p>
            <h3 class="text-xl md:text-2xl font-bold mt-1 text-slate-900 dark:text-white">Rp {{ number_format($totalPembayaranBulanIni, 0, ',', '.') }}</h3>
        </div>

        <div class="bg-white dark:bg-slate-900 p-4 md:p-6 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-3 md:mb-4">
                <div class="bg-primary/10 p-2 md:p-3 rounded-lg">
                    <span class="material-symbols-outlined text-primary text-[20px] md:text-[24px]">person_search</span>
                </div>
                <span class="text-[10px] md:text-xs font-semibold text-primary bg-primary/10 px-2 py-1 rounded-full">Aktif</span>
            </div>
            <p class="text-slate-500 dark:text-slate-400 text-xs md:text-sm font-medium">Total Siswa</p>
            <h3 class="text-xl md:text-2xl font-bold mt-1 text-slate-900 dark:text-white">{{ $totalSiswa }}</h3>
        </div>

        <div class="bg-white dark:bg-slate-900 p-4 md:p-6 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm hover:shadow-md transition-shadow sm:col-span-2 lg:col-span-1">
            <div class="flex items-center justify-between mb-3 md:mb-4">
                <div class="bg-orange-100 dark:bg-orange-500/10 p-2 md:p-3 rounded-lg">
                    <span class="material-symbols-outlined text-orange-600 dark:text-orange-400 text-[20px] md:text-[24px]">event</span>
                </div>
                <span class="text-[10px] md:text-xs font-semibold text-orange-600 bg-orange-50 dark:bg-orange-500/10 px-2 py-1 rounded-full">Aktif</span>
            </div>
            <p class="text-slate-500 dark:text-slate-400 text-xs md:text-sm font-medium">Tahun Ajaran</p>
            <h3 class="text-xl md:text-2xl font-bold mt-1 text-slate-900 dark:text-white">{{ $tahunAjaranAktif->tahun ?? '-' }}</h3>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 md:gap-8">
        <!-- Recent Transactions -->
        <div class="lg:col-span-2 space-y-4">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                <h2 class="text-lg font-bold text-slate-900 dark:text-white">Transaksi Terbaru</h2>
                <a href="{{ route('pembayaran.index') }}" class="flex items-center justify-center gap-2 px-3 py-1.5 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-lg text-sm font-medium hover:bg-slate-50 dark:hover:bg-slate-800 transition-all">
                    <span class="material-symbols-outlined text-[18px]">visibility</span>
                    <span class="hidden sm:inline">Lihat Semua</span>
                    <span class="sm:hidden">Semua</span>
                </a>
            </div>

            <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse min-w-[600px]">
                        <thead>
                            <tr class="bg-slate-50 dark:bg-slate-800/50">
                                <th class="px-4 md:px-6 py-3 md:py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Nama Siswa</th>
                                <th class="px-4 md:px-6 py-3 md:py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Kelas</th>
                                <th class="px-4 md:px-6 py-3 md:py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Bulan</th>
                                <th class="px-4 md:px-6 py-3 md:py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Jumlah</th>
                                <th class="px-4 md:px-6 py-3 md:py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                            @forelse($pembayaranTerbaru as $p)
                            <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                                <td class="px-4 md:px-6 py-3 md:py-4">
                                    <div class="flex items-center gap-2 md:gap-3">
                                        <div class="h-7 w-7 md:h-8 md:w-8 rounded-full bg-primary/10 flex items-center justify-center shrink-0">
                                            <span class="text-xs font-bold text-primary">{{ substr($p->siswa->nama, 0, 1) }}</span>
                                        </div>
                                        <span class="text-sm font-semibold text-slate-900 dark:text-white truncate">{{ $p->siswa->nama }}</span>
                                    </div>
                                </td>
                                <td class="px-4 md:px-6 py-3 md:py-4">
                                    <span class="px-2 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-300 whitespace-nowrap">
                                        {{ $p->siswa->kelas->nama_kelas }}
                                    </span>
                                </td>
                                <td class="px-4 md:px-6 py-3 md:py-4 text-sm text-slate-600 dark:text-slate-400">{{ $p->bulan }}</td>
                                <td class="px-4 md:px-6 py-3 md:py-4 text-sm font-bold text-emerald-600 dark:text-emerald-400 whitespace-nowrap">Rp {{ number_format($p->jumlah_bayar, 0, ',', '.') }}</td>
                                <td class="px-4 md:px-6 py-3 md:py-4 text-sm text-slate-600 dark:text-slate-400 whitespace-nowrap">{{ date('d M Y', strtotime($p->tanggal_bayar)) }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-4 md:px-6 py-12 text-center text-slate-500">
                                    <span class="material-symbols-outlined text-5xl md:text-6xl text-slate-300 dark:text-slate-700 mb-3 block">receipt_long</span>
                                    <p class="font-medium mb-2">Belum ada transaksi</p>
                                    <a href="{{ route('pembayaran.create') }}" class="inline-flex items-center gap-2 mt-2 px-4 py-2 bg-primary text-white rounded-lg text-sm font-semibold hover:bg-primary/90 transition-all">
                                        <span class="material-symbols-outlined text-[18px]">add</span>
                                        Input Pembayaran Pertama
                                    </a>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Sidebar Info -->
        <div class="space-y-4 md:space-y-6">
            <!-- Info Card -->
            @if($tahunAjaranAktif)
            <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm p-4 md:p-6">
                <h3 class="text-base font-bold text-slate-900 dark:text-white mb-4 flex items-center gap-2">
                    <span class="material-symbols-outlined text-[20px]">info</span>
                    Informasi SPP
                </h3>
                <div class="space-y-3">
                    <div class="flex justify-between items-center p-3 bg-slate-50 dark:bg-slate-800/50 rounded-lg">
                        <span class="text-sm text-slate-500 font-medium">Tahun Ajaran</span>
                        <span class="text-sm font-bold text-slate-900 dark:text-white">{{ $tahunAjaranAktif->tahun }}</span>
                    </div>
                    <div class="flex justify-between items-center p-3 bg-emerald-50 dark:bg-emerald-500/10 rounded-lg">
                        <span class="text-sm text-slate-500 font-medium">Nominal SPP</span>
                        <span class="text-sm font-bold text-emerald-600 dark:text-emerald-400">Rp {{ number_format($tahunAjaranAktif->nominal_spp, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between items-center p-3 bg-slate-50 dark:bg-slate-800/50 rounded-lg">
                        <span class="text-sm text-slate-500 font-medium">Status</span>
                        <span class="px-2.5 py-1 rounded-full text-[11px] font-bold bg-emerald-100 text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-400">AKTIF</span>
                    </div>
                </div>
            </div>
            @endif

            <!-- Welcome Card -->
            <div class="bg-gradient-to-br from-primary to-blue-600 rounded-xl p-4 md:p-6 text-white relative overflow-hidden shadow-lg shadow-primary/20">
                <div class="relative z-10">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="material-symbols-outlined text-[24px]">waving_hand</span>
                        <h4 class="text-base md:text-lg font-bold leading-tight">Selamat Datang!</h4>
                    </div>
                    <p class="text-xs text-white/90 mb-4 font-medium leading-relaxed">Sistem Pembayaran SPP SMA N 1 KERAJAAN siap membantu Anda mengelola pembayaran dengan mudah dan efisien.</p>
                    <div class="flex items-center gap-2 text-xs text-white/80">
                        <span class="material-symbols-outlined text-[16px]">schedule</span>
                        <span>{{ date('l, d F Y') }}</span>
                    </div>
                </div>
                <div class="absolute -right-4 -bottom-4 opacity-10">
                    <span class="material-symbols-outlined text-[100px] md:text-[120px]">school</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
