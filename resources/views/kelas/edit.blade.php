@extends('layouts.modern')

@section('title', 'Edit Kelas')
@section('page-title', 'Edit Kelas')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-4 md:mb-6">
        <a href="{{ route('kelas.index') }}" class="inline-flex items-center gap-2 text-sm text-slate-600 dark:text-slate-400 hover:text-primary transition-colors">
            <span class="material-symbols-outlined text-[18px]">arrow_back</span>
            <span class="hidden sm:inline">Kembali ke Daftar Kelas</span>
            <span class="sm:hidden">Kembali</span>
        </a>
    </div>

    <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm">
        <div class="p-4 md:p-6 border-b border-slate-200 dark:border-slate-800">
            <h3 class="text-base md:text-lg font-bold text-slate-900 dark:text-white">Edit Data Kelas</h3>
            <p class="text-xs md:text-sm text-slate-500 mt-1">Update informasi kelas</p>
        </div>

        <form action="{{ route('kelas.update', $kela->id) }}" method="POST" class="p-4 md:p-6 space-y-4 md:space-y-6">
            @csrf
            @method('PUT')
            
            <div>
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Nama Kelas <span class="text-red-500">*</span></label>
                <input type="text" name="nama_kelas" value="{{ old('nama_kelas', $kela->nama_kelas) }}" class="w-full px-3 md:px-4 py-2 md:py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg text-sm focus:ring-2 focus:ring-primary focus:border-primary transition-all @error('nama_kelas') border-red-500 @enderror" required>
                @error('nama_kelas')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Tingkat <span class="text-red-500">*</span></label>
                <select name="tingkat" class="w-full px-3 md:px-4 py-2 md:py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg text-sm focus:ring-2 focus:ring-primary focus:border-primary transition-all @error('tingkat') border-red-500 @enderror" required>
                    <option value="">Pilih Tingkat</option>
                    <option value="X" {{ $kela->tingkat == 'X' ? 'selected' : '' }}>X (Sepuluh)</option>
                    <option value="XI" {{ $kela->tingkat == 'XI' ? 'selected' : '' }}>XI (Sebelas)</option>
                    <option value="XII" {{ $kela->tingkat == 'XII' ? 'selected' : '' }}>XII (Dua Belas)</option>
                </select>
                @error('tingkat')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Jurusan</label>
                <input type="text" name="jurusan" value="{{ old('jurusan', $kela->jurusan) }}" class="w-full px-3 md:px-4 py-2 md:py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg text-sm focus:ring-2 focus:ring-primary focus:border-primary transition-all">
            </div>

            <div class="flex flex-col sm:flex-row gap-3 pt-4 border-t border-slate-200 dark:border-slate-800">
                <button type="submit" class="flex items-center justify-center gap-2 px-6 py-2.5 bg-primary text-white rounded-lg text-sm font-semibold hover:bg-primary/90 transition-all">
                    <span class="material-symbols-outlined text-[18px]">save</span>
                    Update Data
                </button>
                <a href="{{ route('kelas.index') }}" class="flex items-center justify-center gap-2 px-6 py-2.5 bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 rounded-lg text-sm font-semibold hover:bg-slate-200 dark:hover:bg-slate-700 transition-all">
                    <span class="material-symbols-outlined text-[18px]">close</span>
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
