@extends('layouts.modern')

@section('title', 'Tahun Ajaran')
@section('page-title', 'Tahun Ajaran')

@section('content')
<div class="space-y-4 md:space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl md:text-2xl font-bold text-slate-900 dark:text-white">Daftar Tahun Ajaran</h2>
            <p class="text-xs md:text-sm text-slate-500 mt-1">Kelola tahun ajaran dan nominal SPP</p>
        </div>
        <a href="{{ route('tahun-ajaran.create') }}" class="flex items-center justify-center gap-2 px-4 py-2.5 bg-primary text-white rounded-lg text-sm font-semibold hover:bg-primary/90 transition-all shadow-sm">
            <span class="material-symbols-outlined text-[20px]">add_circle</span>
            <span class="hidden sm:inline">Tambah Tahun Ajaran</span>
            <span class="sm:hidden">Tambah</span>
        </a>
    </div>

    @if(session('error'))
        <div class="bg-red-50 dark:bg-red-500/10 border border-red-200 dark:border-red-500/20 text-red-700 dark:text-red-400 px-4 py-3 rounded-lg flex items-center gap-3">
            <span class="material-symbols-outlined text-[20px]">error</span>
            <span class="text-sm font-medium">{{ session('error') }}</span>
        </div>
    @endif

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6">
        @forelse($tahunAjaran as $ta)
        <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm hover:shadow-md transition-shadow p-4 md:p-6">
            <div class="flex items-start justify-between mb-4">
                <div class="flex items-center gap-3">
                    <div class="bg-primary/10 p-3 rounded-lg">
                        <span class="material-symbols-outlined text-primary text-[24px]">calendar_today</span>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white">{{ $ta->tahun }}</h3>
                        @if($ta->is_active)
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

            <div class="space-y-2 mb-4">
                <div class="flex items-center gap-2 text-sm">
                    <span class="material-symbols-outlined text-slate-400 text-[18px]">payments</span>
                    <span class="text-slate-600 dark:text-slate-400">Nominal SPP:</span>
                </div>
                <div class="text-2xl font-bold text-primary">
                    Rp {{ number_format($ta->nominal_spp, 0, ',', '.') }}
                </div>
            </div>

            <div class="space-y-2 pt-4 border-t border-slate-200 dark:border-slate-800">
                @if(!$ta->is_active)
                <form action="{{ route('tahun-ajaran.set-active', $ta->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center gap-2 px-3 py-2 bg-emerald-50 text-emerald-600 hover:bg-emerald-100 dark:bg-emerald-500/10 dark:hover:bg-emerald-500/20 rounded-lg text-sm font-semibold transition-all">
                        <span class="material-symbols-outlined text-[18px]">check_circle</span>
                        Aktifkan
                    </button>
                </form>
                @endif
                
                <div class="flex gap-2">
                    <a href="{{ route('tahun-ajaran.edit', $ta->id) }}" class="flex-1 flex items-center justify-center gap-2 px-3 py-2 bg-orange-50 text-orange-600 hover:bg-orange-100 dark:bg-orange-500/10 dark:hover:bg-orange-500/20 rounded-lg text-sm font-semibold transition-all">
                        <span class="material-symbols-outlined text-[18px]">edit</span>
                        Edit
                    </a>
                    @if(!$ta->is_active)
                    <form action="{{ route('tahun-ajaran.destroy', $ta->id) }}" method="POST" class="flex-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Yakin ingin menghapus tahun ajaran ini?')" class="w-full flex items-center justify-center gap-2 px-3 py-2 bg-red-50 text-red-600 hover:bg-red-100 dark:bg-red-500/10 dark:hover:bg-red-500/20 rounded-lg text-sm font-semibold transition-all">
                            <span class="material-symbols-outlined text-[18px]">delete</span>
                            Hapus
                        </button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm p-12 text-center">
            <span class="material-symbols-outlined text-6xl text-slate-300 dark:text-slate-700 mb-3 block">calendar_today</span>
            <p class="text-slate-500 font-medium mb-4">Belum ada data tahun ajaran</p>
            <a href="{{ route('tahun-ajaran.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-primary text-white rounded-lg text-sm font-semibold hover:bg-primary/90 transition-all">
                <span class="material-symbols-outlined text-[18px]">add</span>
                Tambah Tahun Ajaran Pertama
            </a>
        </div>
        @endforelse
    </div>
</div>
@endsection
