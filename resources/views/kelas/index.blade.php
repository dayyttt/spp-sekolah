@extends('layouts.modern')

@section('title', 'Data Kelas')
@section('page-title', 'Data Kelas')

@section('content')
<div class="space-y-4 md:space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl md:text-2xl font-bold text-slate-900 dark:text-white">Daftar Kelas</h2>
            <p class="text-xs md:text-sm text-slate-500 mt-1">Kelola data kelas SMA N 1 KERAJAAN</p>
        </div>
        <a href="{{ route('kelas.create') }}" class="flex items-center justify-center gap-2 px-4 py-2.5 bg-primary text-white rounded-lg text-sm font-semibold hover:bg-primary/90 transition-all shadow-sm">
            <span class="material-symbols-outlined text-[20px]">add_circle</span>
            <span class="hidden sm:inline">Tambah Kelas</span>
            <span class="sm:hidden">Tambah</span>
        </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6">
        @forelse($kelas as $k)
        <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm hover:shadow-md transition-shadow p-4 md:p-6">
            <div class="flex items-start justify-between mb-4">
                <div class="flex items-center gap-3">
                    <div class="bg-primary/10 p-3 rounded-lg">
                        <span class="material-symbols-outlined text-primary text-[24px]">school</span>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white">{{ $k->nama_kelas }}</h3>
                        <p class="text-xs text-slate-500">Tingkat {{ $k->tingkat }}</p>
                    </div>
                </div>
            </div>

            <div class="space-y-2 mb-4">
                @if($k->jurusan)
                <div class="flex items-center gap-2 text-sm">
                    <span class="material-symbols-outlined text-slate-400 text-[18px]">category</span>
                    <span class="text-slate-600 dark:text-slate-400">Jurusan: {{ $k->jurusan }}</span>
                </div>
                @endif
                <div class="flex items-center gap-2 text-sm">
                    <span class="material-symbols-outlined text-slate-400 text-[18px]">groups</span>
                    <span class="text-slate-600 dark:text-slate-400">{{ $k->siswa_count }} Siswa</span>
                </div>
            </div>

            <div class="flex gap-2 pt-4 border-t border-slate-200 dark:border-slate-800">
                <a href="{{ route('kelas.edit', $k->id) }}" class="flex-1 flex items-center justify-center gap-2 px-3 py-2 bg-orange-50 text-orange-600 hover:bg-orange-100 dark:bg-orange-500/10 dark:hover:bg-orange-500/20 rounded-lg text-sm font-semibold transition-all">
                    <span class="material-symbols-outlined text-[18px]">edit</span>
                    Edit
                </a>
                <form action="{{ route('kelas.destroy', $k->id) }}" method="POST" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Yakin ingin menghapus kelas ini?')" class="w-full flex items-center justify-center gap-2 px-3 py-2 bg-red-50 text-red-600 hover:bg-red-100 dark:bg-red-500/10 dark:hover:bg-red-500/20 rounded-lg text-sm font-semibold transition-all">
                        <span class="material-symbols-outlined text-[18px]">delete</span>
                        Hapus
                    </button>
                </form>
            </div>
        </div>
        @empty
        <div class="col-span-full bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm p-12 text-center">
            <span class="material-symbols-outlined text-6xl text-slate-300 dark:text-slate-700 mb-3 block">school</span>
            <p class="text-slate-500 font-medium mb-4">Belum ada data kelas</p>
            <a href="{{ route('kelas.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-primary text-white rounded-lg text-sm font-semibold hover:bg-primary/90 transition-all">
                <span class="material-symbols-outlined text-[18px]">add</span>
                Tambah Kelas Pertama
            </a>
        </div>
        @endforelse
    </div>
</div>
@endsection
