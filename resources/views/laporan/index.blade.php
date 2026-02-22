@extends('layouts.modern')

@section('title', 'Laporan Pembayaran')
@section('page-title', 'Laporan Pembayaran')

@section('content')
<div class="space-y-4 md:space-y-6">
    <!-- Filter -->
    <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm p-4 md:p-6">
        <form method="GET" action="{{ route('laporan.index') }}" class="flex flex-col sm:flex-row gap-3">
            <div class="flex-1">
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Bulan</label>
                <select name="bulan" class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg text-sm focus:ring-2 focus:ring-primary">
                    @foreach(['01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April', '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus', '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'] as $key => $value)
                        <option value="{{ $key }}" {{ $bulan == $key ? 'selected' : '' }}>{{ $value }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex-1">
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Tahun</label>
                <select name="tahun" class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg text-sm focus:ring-2 focus:ring-primary">
                    @for($y = date('Y'); $y >= date('Y') - 5; $y--)
                        <option value="{{ $y }}" {{ $tahun == $y ? 'selected' : '' }}>{{ $y }}</option>
                    @endfor
                </select>
            </div>
            <div class="flex items-end">
                <button type="submit" class="w-full sm:w-auto px-6 py-2 bg-primary text-white rounded-lg text-sm font-semibold hover:bg-primary/90 transition-all flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">search</span>
                    Tampilkan
                </button>
            </div>
        </form>
    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6">
        <div class="bg-white dark:bg-slate-900 p-4 md:p-6 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm">
            <div class="flex items-center gap-3 mb-3">
                <div class="bg-emerald-100 dark:bg-emerald-500/10 p-2 rounded-lg">
                    <span class="material-symbols-outlined text-emerald-600 dark:text-emerald-400 text-[24px]">payments</span>
                </div>
                <div>
                    <p class="text-xs text-slate-500">Total Pembayaran</p>
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white">Rp {{ number_format($totalPembayaran, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-slate-900 p-4 md:p-6 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm">
            <div class="flex items-center gap-3 mb-3">
                <div class="bg-blue-100 dark:bg-blue-500/10 p-2 rounded-lg">
                    <span class="material-symbols-outlined text-blue-600 dark:text-blue-400 text-[24px]">receipt</span>
                </div>
                <div>
                    <p class="text-xs text-slate-500">Jumlah Transaksi</p>
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white">{{ $jumlahTransaksi }}</h3>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-slate-900 p-4 md:p-6 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm sm:col-span-2 lg:col-span-1">
            <div class="flex items-center gap-3 mb-3">
                <div class="bg-orange-100 dark:bg-orange-500/10 p-2 rounded-lg">
                    <span class="material-symbols-outlined text-orange-600 dark:text-orange-400 text-[24px]">calculate</span>
                </div>
                <div>
                    <p class="text-xs text-slate-500">Rata-rata per Transaksi</p>
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white">Rp {{ $jumlahTransaksi > 0 ? number_format($totalPembayaran / $jumlahTransaksi, 0, ',', '.') : 0 }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Per Kelas -->
    <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden">
        <div class="p-4 md:p-6 border-b border-slate-200 dark:border-slate-800">
            <h3 class="text-base md:text-lg font-bold text-slate-900 dark:text-white flex items-center gap-2">
                <span class="material-symbols-outlined text-[20px]">school</span>
                Pembayaran Per Kelas
            </h3>
        </div>
        <div class="p-4 md:p-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @forelse($perKelas as $kelas)
                <div class="p-4 bg-slate-50 dark:bg-slate-800/50 rounded-lg border border-slate-200 dark:border-slate-700">
                    <h4 class="font-bold text-slate-900 dark:text-white mb-2">{{ $kelas->nama_kelas }}</h4>
                    <div class="space-y-1">
                        <p class="text-sm text-slate-600 dark:text-slate-400">Transaksi: <span class="font-semibold">{{ $kelas->jumlah }}</span></p>
                        <p class="text-sm text-emerald-600 dark:text-emerald-400 font-bold">Rp {{ number_format($kelas->total, 0, ',', '.') }}</p>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center py-8 text-slate-500">
                    Tidak ada data pembayaran
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Detail Transaksi -->
    <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden">
        <div class="p-4 md:p-6 border-b border-slate-200 dark:border-slate-800 flex items-center justify-between">
            <h3 class="text-base md:text-lg font-bold text-slate-900 dark:text-white flex items-center gap-2">
                <span class="material-symbols-outlined text-[20px]">list</span>
                Detail Transaksi
            </h3>
            <a href="{{ route('laporan.export', ['bulan' => $bulan, 'tahun' => $tahun]) }}" class="flex items-center gap-2 px-3 py-1.5 bg-emerald-600 text-white rounded-lg text-sm font-semibold hover:bg-emerald-700 transition-all">
                <span class="material-symbols-outlined text-[18px]">download</span>
                <span class="hidden sm:inline">Export Excel</span>
                <span class="sm:hidden">Excel</span>
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse min-w-[800px]">
                <thead>
                    <tr class="bg-slate-50 dark:bg-slate-800/50">
                        <th class="px-4 md:px-6 py-3 md:py-4 text-xs font-semibold text-slate-500 uppercase">No</th>
                        <th class="px-4 md:px-6 py-3 md:py-4 text-xs font-semibold text-slate-500 uppercase">Tanggal</th>
                        <th class="px-4 md:px-6 py-3 md:py-4 text-xs font-semibold text-slate-500 uppercase">NIS</th>
                        <th class="px-4 md:px-6 py-3 md:py-4 text-xs font-semibold text-slate-500 uppercase">Nama Siswa</th>
                        <th class="px-4 md:px-6 py-3 md:py-4 text-xs font-semibold text-slate-500 uppercase">Kelas</th>
                        <th class="px-4 md:px-6 py-3 md:py-4 text-xs font-semibold text-slate-500 uppercase">Bulan</th>
                        <th class="px-4 md:px-6 py-3 md:py-4 text-xs font-semibold text-slate-500 uppercase text-right">Jumlah</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                    @forelse($pembayaranBulan as $index => $p)
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                        <td class="px-4 md:px-6 py-3 md:py-4 text-sm text-slate-600 dark:text-slate-400">{{ $index + 1 }}</td>
                        <td class="px-4 md:px-6 py-3 md:py-4 text-sm text-slate-600 dark:text-slate-400 whitespace-nowrap">{{ date('d/m/Y', strtotime($p->tanggal_bayar)) }}</td>
                        <td class="px-4 md:px-6 py-3 md:py-4 text-sm font-medium text-slate-900 dark:text-white">{{ $p->siswa->nis }}</td>
                        <td class="px-4 md:px-6 py-3 md:py-4 text-sm text-slate-900 dark:text-white">{{ $p->siswa->nama }}</td>
                        <td class="px-4 md:px-6 py-3 md:py-4">
                            <span class="px-2 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-300">
                                {{ $p->siswa->kelas->nama_kelas }}
                            </span>
                        </td>
                        <td class="px-4 md:px-6 py-3 md:py-4 text-sm text-slate-600 dark:text-slate-400">{{ $p->bulan }}</td>
                        <td class="px-4 md:px-6 py-3 md:py-4 text-sm font-bold text-emerald-600 dark:text-emerald-400 text-right whitespace-nowrap">Rp {{ number_format($p->jumlah_bayar, 0, ',', '.') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-4 md:px-6 py-12 text-center">
                            <span class="material-symbols-outlined text-5xl md:text-6xl text-slate-300 dark:text-slate-700 mb-3 block">receipt_long</span>
                            <p class="text-slate-500 font-medium">Tidak ada transaksi pada periode ini</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
                @if($pembayaranBulan->count() > 0)
                <tfoot>
                    <tr class="bg-slate-50 dark:bg-slate-800/50 font-bold">
                        <td colspan="6" class="px-4 md:px-6 py-3 md:py-4 text-sm text-slate-900 dark:text-white text-right">TOTAL</td>
                        <td class="px-4 md:px-6 py-3 md:py-4 text-sm text-emerald-600 dark:text-emerald-400 text-right whitespace-nowrap">Rp {{ number_format($totalPembayaran, 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
                @endif
            </table>
        </div>
    </div>
</div>

<style>
    @media print {
        .no-print, nav, aside, header button, .sidebar-mobile { display: none !important; }
        body { background: white !important; }
        .container { max-width: 100% !important; }
    }
</style>
@endsection
