@extends('layouts.modern')

@section('title', 'Tambah Rekening')
@section('page-title', 'Tambah Rekening')

@section('content')
<div class="max-w-2xl">
    <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm p-6 md:p-8">
        <div class="flex items-center gap-3 mb-6">
            <div class="bg-primary/10 p-3 rounded-lg">
                <span class="material-symbols-outlined text-primary text-[24px]">account_balance</span>
            </div>
            <div>
                <h3 class="text-xl font-bold text-slate-900 dark:text-white">Form Rekening</h3>
                <p class="text-sm text-slate-500">Tambah rekening pembayaran baru</p>
            </div>
        </div>

        <form action="{{ route('rekening.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div>
                <label for="nama_bank" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                    Nama Bank <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    name="nama_bank" 
                    id="nama_bank" 
                    placeholder="Contoh: Bank BRI"
                    value="{{ old('nama_bank') }}"
                    class="w-full px-4 py-2.5 bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-700 rounded-lg text-slate-900 dark:text-white placeholder-slate-400 focus:ring-2 focus:ring-primary focus:border-transparent transition-all @error('nama_bank') border-red-500 @enderror"
                    required
                >
                @error('nama_bank')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="nomor_rekening" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                    Nomor Rekening <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    name="nomor_rekening" 
                    id="nomor_rekening" 
                    placeholder="Contoh: 1234567890"
                    value="{{ old('nomor_rekening') }}"
                    class="w-full px-4 py-2.5 bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-700 rounded-lg text-slate-900 dark:text-white placeholder-slate-400 focus:ring-2 focus:ring-primary focus:border-transparent transition-all @error('nomor_rekening') border-red-500 @enderror"
                    required
                >
                @error('nomor_rekening')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="atas_nama" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                    Atas Nama <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    name="atas_nama" 
                    id="atas_nama" 
                    placeholder="Contoh: SMA N 1 KERAJAAN"
                    value="{{ old('atas_nama') }}"
                    class="w-full px-4 py-2.5 bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-700 rounded-lg text-slate-900 dark:text-white placeholder-slate-400 focus:ring-2 focus:ring-primary focus:border-transparent transition-all @error('atas_nama') border-red-500 @enderror"
                    required
                >
                @error('atas_nama')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="qr_code" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                    QR Code Pembayaran
                </label>
                <div class="flex items-center gap-4">
                    <label for="qr_code" class="flex-1 flex flex-col items-center justify-center px-4 py-6 bg-slate-50 dark:bg-slate-800 border-2 border-dashed border-slate-300 dark:border-slate-700 rounded-lg cursor-pointer hover:bg-slate-100 dark:hover:bg-slate-700 transition-all">
                        <span class="material-symbols-outlined text-4xl text-slate-400 mb-2">qr_code_2</span>
                        <span class="text-sm text-slate-600 dark:text-slate-400 font-medium">Klik untuk upload QR Code</span>
                        <span class="text-xs text-slate-500 mt-1">JPG, PNG (Max. 2MB)</span>
                        <input 
                            type="file" 
                            name="qr_code" 
                            id="qr_code" 
                            accept="image/jpeg,image/png,image/jpg"
                            class="hidden"
                            onchange="previewImage(event)"
                        >
                    </label>
                    <div id="preview" class="hidden">
                        <img id="preview-img" src="" alt="Preview" class="w-32 h-32 object-contain border border-slate-200 dark:border-slate-700 rounded-lg bg-white">
                    </div>
                </div>
                @error('qr_code')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-xs text-slate-500">Upload gambar QR code untuk pembayaran (opsional)</p>
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
                        Aktifkan Rekening Ini
                    </label>
                    <p class="text-xs text-slate-500 mt-1">Rekening aktif akan ditampilkan di halaman pembayaran</p>
                </div>
            </div>

            <div class="flex gap-3 pt-4 border-t border-slate-200 dark:border-slate-800">
                <a href="{{ route('rekening.index') }}" class="flex-1 flex items-center justify-center gap-2 px-4 py-2.5 bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 rounded-lg text-sm font-semibold hover:bg-slate-200 dark:hover:bg-slate-700 transition-all">
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
function previewImage(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview-img').src = e.target.result;
            document.getElementById('preview').classList.remove('hidden');
        }
        reader.readAsDataURL(file);
    }
}
</script>
@endpush
@endsection
