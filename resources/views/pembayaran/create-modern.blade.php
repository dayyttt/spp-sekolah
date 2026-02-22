@extends('layouts.modern')

@section('title', 'Input Pembayaran')
@section('page-title', 'Input Pembayaran')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-4 md:mb-6">
        <a href="{{ route('pembayaran.index') }}" class="inline-flex items-center gap-2 text-sm text-slate-600 dark:text-slate-400 hover:text-primary transition-colors">
            <span class="material-symbols-outlined text-[18px]">arrow_back</span>
            <span class="hidden sm:inline">Kembali ke Daftar Pembayaran</span>
            <span class="sm:hidden">Kembali</span>
        </a>
    </div>

    <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm">
        <div class="p-4 md:p-6 border-b border-slate-200 dark:border-slate-800">
            <h3 class="text-base md:text-lg font-bold text-slate-900 dark:text-white">Form Input Pembayaran SPP</h3>
            <p class="text-xs md:text-sm text-slate-500 mt-1">Lengkapi form di bawah untuk mencatat pembayaran SPP</p>
        </div>

        <form action="{{ route('pembayaran.store') }}" method="POST" class="p-4 md:p-6 space-y-4 md:space-y-6">
            @csrf
            
            <div>
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Siswa <span class="text-red-500">*</span></label>
                <select name="siswa_id" id="siswa-select" class="w-full px-3 md:px-4 py-2 md:py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg text-sm focus:ring-2 focus:ring-primary focus:border-primary transition-all @error('siswa_id') border-red-500 @enderror" required>
                    <option value="">Pilih Siswa</option>
                    @foreach($siswa as $s)
                        <option value="{{ $s->id }}" {{ old('siswa_id') == $s->id ? 'selected' : '' }}>
                            {{ $s->nis }} - {{ $s->nama }} ({{ $s->kelas->nama_kelas }})
                        </option>
                    @endforeach
                </select>
                @error('siswa_id')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Tahun Ajaran</label>
                <input type="text" class="w-full px-3 md:px-4 py-2 md:py-2.5 bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg text-sm" value="{{ $tahunAjaran->tahun ?? '-' }}" readonly>
                <input type="hidden" name="tahun_ajaran_id" value="{{ $tahunAjaran->id ?? '' }}">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Rekening Tujuan</label>
                <select name="rekening_id" id="rekening-select" class="w-full px-3 md:px-4 py-2 md:py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg text-sm focus:ring-2 focus:ring-primary focus:border-primary transition-all">
                    <option value="">Pilih Rekening (Opsional)</option>
                    @foreach($rekening as $rek)
                        <option value="{{ $rek->id }}" 
                                data-qr="{{ $rek->qr_code ? asset('storage/' . $rek->qr_code) : '' }}"
                                data-bank="{{ $rek->nama_bank }}"
                                {{ old('rekening_id') == $rek->id ? 'selected' : '' }}>
                            {{ $rek->nama_bank }} - {{ $rek->nomor_rekening }} ({{ $rek->atas_nama }})
                        </option>
                    @endforeach
                </select>
                <p class="mt-1 text-xs text-slate-500">Pilih rekening jika pembayaran via transfer</p>
                
                <!-- QR Code Preview -->
                <div id="qr-preview" class="hidden mt-4 p-4 bg-slate-50 dark:bg-slate-800 rounded-lg border border-slate-200 dark:border-slate-700">
                    <p class="text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">QR Code Pembayaran:</p>
                    <div class="flex items-center gap-4">
                        <img id="qr-image" src="" alt="QR Code" class="w-32 h-32 object-contain border border-slate-300 dark:border-slate-600 rounded-lg bg-white">
                        <div class="flex-1">
                            <p class="text-xs text-slate-600 dark:text-slate-400">Siswa dapat scan QR Code ini untuk melakukan pembayaran via <span id="bank-name" class="font-semibold"></span></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Bulan <span class="text-red-500">*</span></label>
                    <select name="bulan" class="w-full px-3 md:px-4 py-2 md:py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg text-sm focus:ring-2 focus:ring-primary focus:border-primary transition-all @error('bulan') border-red-500 @enderror" required>
                        <option value="">Pilih Bulan</option>
                        <option value="Januari" {{ old('bulan') == 'Januari' ? 'selected' : '' }}>Januari</option>
                        <option value="Februari" {{ old('bulan') == 'Februari' ? 'selected' : '' }}>Februari</option>
                        <option value="Maret" {{ old('bulan') == 'Maret' ? 'selected' : '' }}>Maret</option>
                        <option value="April" {{ old('bulan') == 'April' ? 'selected' : '' }}>April</option>
                        <option value="Mei" {{ old('bulan') == 'Mei' ? 'selected' : '' }}>Mei</option>
                        <option value="Juni" {{ old('bulan') == 'Juni' ? 'selected' : '' }}>Juni</option>
                        <option value="Juli" {{ old('bulan') == 'Juli' ? 'selected' : '' }}>Juli</option>
                        <option value="Agustus" {{ old('bulan') == 'Agustus' ? 'selected' : '' }}>Agustus</option>
                        <option value="September" {{ old('bulan') == 'September' ? 'selected' : '' }}>September</option>
                        <option value="Oktober" {{ old('bulan') == 'Oktober' ? 'selected' : '' }}>Oktober</option>
                        <option value="November" {{ old('bulan') == 'November' ? 'selected' : '' }}>November</option>
                        <option value="Desember" {{ old('bulan') == 'Desember' ? 'selected' : '' }}>Desember</option>
                    </select>
                    @error('bulan')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Tahun <span class="text-red-500">*</span></label>
                    <input type="number" name="tahun" value="{{ old('tahun', date('Y')) }}" class="w-full px-3 md:px-4 py-2 md:py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg text-sm focus:ring-2 focus:ring-primary focus:border-primary transition-all @error('tahun') border-red-500 @enderror" required>
                    @error('tahun')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Jumlah Bayar <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <span class="absolute left-3 md:left-4 top-1/2 -translate-y-1/2 text-slate-500 font-medium text-sm">Rp</span>
                        <input 
                            type="text" 
                            id="jumlah_bayar_display" 
                            value="{{ old('jumlah_bayar') ? number_format(old('jumlah_bayar'), 0, ',', '.') : ($tahunAjaran->nominal_spp ? number_format($tahunAjaran->nominal_spp, 0, ',', '.') : '') }}" 
                            class="w-full pl-10 md:pl-12 pr-3 md:pr-4 py-2 md:py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg text-sm focus:ring-2 focus:ring-primary focus:border-primary transition-all @error('jumlah_bayar') border-red-500 @enderror" 
                            placeholder="0"
                            required
                        >
                        <input type="hidden" name="jumlah_bayar" id="jumlah_bayar" value="{{ old('jumlah_bayar', $tahunAjaran->nominal_spp ?? '') }}">
                    </div>
                    @error('jumlah_bayar')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                    @if($tahunAjaran)
                    <p class="mt-1 text-xs text-slate-500">Nominal SPP: Rp {{ number_format($tahunAjaran->nominal_spp, 0, ',', '.') }}</p>
                    @endif
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Tanggal Bayar <span class="text-red-500">*</span></label>
                    <input type="date" name="tanggal_bayar" value="{{ old('tanggal_bayar', date('Y-m-d')) }}" class="w-full px-3 md:px-4 py-2 md:py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg text-sm focus:ring-2 focus:ring-primary focus:border-primary transition-all @error('tanggal_bayar') border-red-500 @enderror" required>
                    @error('tanggal_bayar')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Keterangan</label>
                <textarea name="keterangan" rows="3" class="w-full px-3 md:px-4 py-2 md:py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg text-sm focus:ring-2 focus:ring-primary focus:border-primary transition-all">{{ old('keterangan') }}</textarea>
            </div>

            <div class="flex flex-col sm:flex-row gap-3 pt-4 border-t border-slate-200 dark:border-slate-800">
                <button type="submit" class="flex items-center justify-center gap-2 px-6 py-2.5 bg-primary text-white rounded-lg text-sm font-semibold hover:bg-primary/90 transition-all">
                    <span class="material-symbols-outlined text-[18px]">save</span>
                    Simpan Pembayaran
                </button>
                <a href="{{ route('pembayaran.index') }}" class="flex items-center justify-center gap-2 px-6 py-2.5 bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 rounded-lg text-sm font-semibold hover:bg-slate-200 dark:hover:bg-slate-700 transition-all">
                    <span class="material-symbols-outlined text-[18px]">close</span>
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<style>
    .select2-container--default .select2-selection--single {
        background-color: rgb(248 250 252);
        border: 1px solid rgb(226 232 240);
        border-radius: 0.5rem;
        height: 42px;
        padding: 0.5rem 1rem;
    }
    
    .dark .select2-container--default .select2-selection--single {
        background-color: rgb(30 41 59);
        border-color: rgb(51 65 85);
        color: white;
    }
    
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 26px;
        padding-left: 0;
        color: rgb(15 23 42);
    }
    
    .dark .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: white;
    }
    
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 40px;
        right: 8px;
    }
    
    .select2-dropdown {
        background-color: white;
        border: 1px solid rgb(226 232 240);
        border-radius: 0.5rem;
    }
    
    .dark .select2-dropdown {
        background-color: rgb(30 41 59);
        border-color: rgb(51 65 85);
    }
    
    .select2-container--default .select2-results__option {
        padding: 8px 12px;
        color: rgb(15 23 42);
    }
    
    .dark .select2-container--default .select2-results__option {
        color: white;
    }
    
    .select2-container--default .select2-results__option--highlighted[aria-selected] {
        background-color: rgb(19 91 236);
        color: white;
    }
    
    .select2-container--default .select2-search--dropdown .select2-search__field {
        border: 1px solid rgb(226 232 240);
        border-radius: 0.5rem;
        padding: 8px 12px;
    }
    
    .dark .select2-container--default .select2-search--dropdown .select2-search__field {
        background-color: rgb(51 65 85);
        border-color: rgb(71 85 105);
        color: white;
    }
</style>

<script>
$(document).ready(function() {
    $('#siswa-select').select2({
        placeholder: 'Cari siswa berdasarkan NIS, nama, atau kelas...',
        allowClear: true,
        width: '100%',
        language: {
            noResults: function() {
                return "Siswa tidak ditemukan";
            },
            searching: function() {
                return "Mencari...";
            }
        }
    });

    // Format Rupiah
    const jumlahBayarDisplay = document.getElementById('jumlah_bayar_display');
    const jumlahBayarHidden = document.getElementById('jumlah_bayar');

    function formatRupiah(angka) {
        // Konversi ke string dan hapus semua karakter non-digit
        let numberString = angka.toString().replace(/\D/g, '');
        
        if (!numberString) return '';
        
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

    jumlahBayarDisplay.addEventListener('input', function(e) {
        let value = this.value;
        
        // Format tampilan
        this.value = formatRupiah(value);
        
        // Simpan nilai asli (tanpa format) ke hidden input
        jumlahBayarHidden.value = value.replace(/\D/g, '');
    });

    // Trigger format saat load jika ada nilai
    if (jumlahBayarDisplay.value) {
        jumlahBayarHidden.value = jumlahBayarDisplay.value.replace(/\D/g, '');
    }

    // QR Code Preview
    const rekeningSelect = document.getElementById('rekening-select');
    const qrPreview = document.getElementById('qr-preview');
    const qrImage = document.getElementById('qr-image');
    const bankName = document.getElementById('bank-name');

    rekeningSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const qrUrl = selectedOption.getAttribute('data-qr');
        const bank = selectedOption.getAttribute('data-bank');

        if (qrUrl && this.value) {
            // Tampilkan QR preview
            qrImage.src = qrUrl;
            bankName.textContent = bank;
            qrPreview.classList.remove('hidden');
        } else {
            // Sembunyikan QR preview
            qrPreview.classList.add('hidden');
            qrImage.src = '';
            bankName.textContent = '';
        }
    });

    // Trigger saat load jika ada nilai old
    if (rekeningSelect.value) {
        rekeningSelect.dispatchEvent(new Event('change'));
    }
});
</script>
@endpush
@endsection
