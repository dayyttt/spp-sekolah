@extends('layouts.modern')

@section('title', 'Tambah Tahun Ajaran')
@section('page-title', 'Tambah Tahun Ajaran')

@section('content')
<div class="max-w-2xl">
    <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm p-6 md:p-8">
        <div class="flex items-center gap-3 mb-6">
            <div class="bg-primary/10 p-3 rounded-lg">
                <span class="material-symbols-outlined text-primary text-[24px]">calendar_today</span>
            </div>
            <div>
                <h3 class="text-xl font-bold text-slate-900 dark:text-white">Form Tahun Ajaran</h3>
                <p class="text-sm text-slate-500">Tambah tahun ajaran baru</p>
            </div>
        </div>

        <form action="{{ route('tahun-ajaran.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label for="tahun" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                    Tahun Ajaran <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    name="tahun" 
                    id="tahun" 
                    placeholder="Contoh: 2025/2026"
                    value="{{ old('tahun') }}"
                    class="w-full px-4 py-2.5 bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-700 rounded-lg text-slate-900 dark:text-white placeholder-slate-400 focus:ring-2 focus:ring-primary focus:border-transparent transition-all @error('tahun') border-red-500 @enderror"
                    required
                >
                @error('tahun')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-xs text-slate-500">Format: YYYY/YYYY (contoh: 2025/2026)</p>
            </div>

            <div>
                <label for="nominal_spp" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                    Nominal SPP <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-500 font-medium">Rp</span>
                    <input 
                        type="text" 
                        id="nominal_spp_display" 
                        placeholder="0"
                        class="w-full pl-12 pr-4 py-2.5 bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-700 rounded-lg text-slate-900 dark:text-white placeholder-slate-400 focus:ring-2 focus:ring-primary focus:border-transparent transition-all @error('nominal_spp') border-red-500 @enderror"
                        required
                    >
                    <input type="hidden" name="nominal_spp" id="nominal_spp" value="{{ old('nominal_spp') }}">
                </div>
                @error('nominal_spp')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-xs text-slate-500">Nominal SPP per bulan untuk tahun ajaran ini</p>
            </div>

            <div class="flex items-start gap-3 p-4 bg-slate-50 dark:bg-slate-800 rounded-lg">
                <input 
                    type="checkbox" 
                    name="is_active" 
                    id="is_active" 
                    value="1"
                    {{ old('is_active') ? 'checked' : '' }}
                    class="mt-0.5 w-4 h-4 text-primary bg-white dark:bg-slate-700 border-slate-300 dark:border-slate-600 rounded focus:ring-2 focus:ring-primary"
                >
                <div class="flex-1">
                    <label for="is_active" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 cursor-pointer">
                        Aktifkan Tahun Ajaran Ini
                    </label>
                    <p class="text-xs text-slate-500 mt-1">Jika dicentang, tahun ajaran lain akan dinonaktifkan secara otomatis</p>
                </div>
            </div>

            <div class="flex gap-3 pt-4 border-t border-slate-200 dark:border-slate-800">
                <a href="{{ route('tahun-ajaran.index') }}" class="flex-1 flex items-center justify-center gap-2 px-4 py-2.5 bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 rounded-lg text-sm font-semibold hover:bg-slate-200 dark:hover:bg-slate-700 transition-all">
                    <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                    Batal
                </a>
                <button type="submit" class="flex-1 flex items-center justify-center gap-2 px-4 py-2.5 bg-primary text-white rounded-lg text-sm font-semibold hover:bg-primary/90 transition-all shadow-sm">
                    <span class="material-symbols-outlined text-[18px]">save</span>
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const nominalDisplay = document.getElementById('nominal_spp_display');
    const nominalHidden = document.getElementById('nominal_spp');

    function formatRupiah(angka) {
        // Konversi ke number dulu untuk handle desimal, lalu ke integer
        let number = parseFloat(angka);
        if (isNaN(number)) {
            // Jika bukan number, coba ambil digit saja
            number = parseInt(angka.toString().replace(/\D/g, ''));
        }
        
        if (isNaN(number) || number === 0) return '';
        
        // Bulatkan ke integer
        let numberString = Math.round(number).toString();
        
        // Tambahkan pemisah ribuan
        let formatted = '';
        let count = 0;
        
        // Loop dari belakang
        for (let i = numberString.length - 1; i >= 0; i--) {
            if (count === 3) {
                formatted = '.' + formatted;
                count = 0;
            }
            formatted = numberString[i] + formatted;
            count++;
        }
        
        return formatted;
    }

    // Set nilai awal dari hidden input (jika ada)
    if (nominalHidden.value) {
        const formatted = formatRupiah(nominalHidden.value);
        nominalDisplay.value = formatted;
        // Update hidden value dengan nilai yang sudah dibulatkan
        nominalHidden.value = Math.round(parseFloat(nominalHidden.value) || 0);
    }

    nominalDisplay.addEventListener('input', function(e) {
        let value = this.value;
        this.value = formatRupiah(value);
        nominalHidden.value = value.replace(/\D/g, '');
    });
});
</script>
@endpush
@endsection
