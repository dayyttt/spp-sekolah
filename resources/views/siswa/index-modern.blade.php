@extends('layouts.modern')

@section('title', 'Data Siswa')
@section('page-title', 'Data Siswa')

@section('content')
<div class="space-y-4 md:space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl md:text-2xl font-bold text-slate-900 dark:text-white">Daftar Siswa</h2>
            <p class="text-xs md:text-sm text-slate-500 mt-1">Kelola data siswa SMA N 1 KERAJAAN</p>
        </div>
        <a href="{{ route('siswa.create') }}" class="flex items-center justify-center gap-2 px-4 py-2.5 bg-primary text-white rounded-lg text-sm font-semibold hover:bg-primary/90 transition-all shadow-sm">
            <span class="material-symbols-outlined text-[20px]">add_circle</span>
            <span class="hidden sm:inline">Tambah Siswa</span>
            <span class="sm:hidden">Tambah</span>
        </a>
    </div>

    <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse min-w-[800px]">
                <thead>
                    <tr class="bg-slate-50 dark:bg-slate-800/50">
                        <th class="px-4 md:px-6 py-3 md:py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">NIS</th>
                        <th class="px-4 md:px-6 py-3 md:py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">NISN</th>
                        <th class="px-4 md:px-6 py-3 md:py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Nama Siswa</th>
                        <th class="px-4 md:px-6 py-3 md:py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Kelas</th>
                        <th class="px-4 md:px-6 py-3 md:py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Jenis Kelamin</th>
                        <th class="px-4 md:px-6 py-3 md:py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                    @forelse($siswa as $s)
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                        <td class="px-4 md:px-6 py-3 md:py-4 text-sm font-medium text-slate-900 dark:text-white">{{ $s->nis }}</td>
                        <td class="px-4 md:px-6 py-3 md:py-4 text-sm text-slate-600 dark:text-slate-400">{{ $s->nisn }}</td>
                        <td class="px-4 md:px-6 py-3 md:py-4">
                            <div class="flex items-center gap-2 md:gap-3">
                                <div class="h-7 w-7 md:h-8 md:w-8 rounded-full bg-primary/10 flex items-center justify-center shrink-0">
                                    <span class="text-xs font-bold text-primary">{{ substr($s->nama, 0, 1) }}</span>
                                </div>
                                <span class="text-sm font-semibold text-slate-900 dark:text-white">{{ $s->nama }}</span>
                            </div>
                        </td>
                        <td class="px-4 md:px-6 py-3 md:py-4">
                            <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-300 whitespace-nowrap">
                                {{ $s->kelas->nama_kelas }}
                            </span>
                        </td>
                        <td class="px-4 md:px-6 py-3 md:py-4 text-sm text-slate-600 dark:text-slate-400">
                            {{ $s->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                        </td>
                        <td class="px-4 md:px-6 py-3 md:py-4 text-right">
                            <div class="flex items-center justify-end gap-1 md:gap-2">
                                <a href="{{ route('pembayaran.history', $s->id) }}" class="p-1.5 md:p-2 text-blue-600 hover:bg-blue-50 dark:hover:bg-blue-500/10 rounded-lg transition-all" title="Riwayat Pembayaran">
                                    <span class="material-symbols-outlined text-[18px] md:text-[20px]">history</span>
                                </a>
                                <a href="{{ route('siswa.edit', $s->id) }}" class="p-1.5 md:p-2 text-orange-600 hover:bg-orange-50 dark:hover:bg-orange-500/10 rounded-lg transition-all" title="Edit">
                                    <span class="material-symbols-outlined text-[18px] md:text-[20px]">edit</span>
                                </a>
                                <form action="{{ route('siswa.destroy', $s->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Yakin ingin menghapus data siswa ini?')" class="p-1.5 md:p-2 text-red-600 hover:bg-red-50 dark:hover:bg-red-500/10 rounded-lg transition-all" title="Hapus">
                                        <span class="material-symbols-outlined text-[18px] md:text-[20px]">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-4 md:px-6 py-12 text-center">
                            <span class="material-symbols-outlined text-5xl md:text-6xl text-slate-300 dark:text-slate-700 mb-3 block">groups</span>
                            <p class="text-slate-500 font-medium text-sm md:text-base">Belum ada data siswa</p>
                            <a href="{{ route('siswa.create') }}" class="inline-flex items-center gap-2 mt-4 px-4 py-2 bg-primary text-white rounded-lg text-sm font-semibold hover:bg-primary/90 transition-all">
                                <span class="material-symbols-outlined text-[18px]">add</span>
                                Tambah Siswa Pertama
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($siswa->hasPages())
        <div class="px-4 md:px-6 py-3 md:py-4 bg-slate-50 dark:bg-slate-800/30 flex flex-col sm:flex-row items-center justify-between gap-3 border-t border-slate-100 dark:border-slate-800">
            <p class="text-xs text-slate-500 font-medium">
                Menampilkan {{ $siswa->firstItem() }} - {{ $siswa->lastItem() }} dari {{ $siswa->total() }} siswa
            </p>
            <div class="flex gap-2">
                @if($siswa->onFirstPage())
                    <button class="px-3 py-1 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded text-xs font-semibold opacity-50 cursor-not-allowed" disabled>Sebelumnya</button>
                @else
                    <a href="{{ $siswa->previousPageUrl() }}" class="px-3 py-1 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded text-xs font-semibold hover:bg-slate-50 transition-all">Sebelumnya</a>
                @endif

                @if($siswa->hasMorePages())
                    <a href="{{ $siswa->nextPageUrl() }}" class="px-3 py-1 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded text-xs font-semibold hover:bg-slate-50 transition-all">Selanjutnya</a>
                @else
                    <button class="px-3 py-1 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded text-xs font-semibold opacity-50 cursor-not-allowed" disabled>Selanjutnya</button>
                @endif
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
