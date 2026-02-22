<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Pembayaran SPP</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; padding: 20px; }
        .container { max-width: 800px; margin: 0 auto; border: 2px solid #000; padding: 20px; }
        .header { text-align: center; border-bottom: 3px solid #000; padding-bottom: 15px; margin-bottom: 20px; display: flex; align-items: center; justify-content: center; gap: 20px; }
        .header-logo { width: 80px; height: 80px; }
        .header-logo img { width: 100%; height: 100%; object-fit: contain; }
        .header-text { flex: 1; text-align: center; }
        .header h1 { font-size: 24px; margin-bottom: 5px; }
        .header p { font-size: 14px; color: #666; }
        .title { text-align: center; margin: 20px 0; }
        .title h2 { font-size: 20px; text-decoration: underline; }
        .content { margin: 20px 0; }
        .row { display: flex; margin-bottom: 10px; }
        .label { width: 200px; font-weight: bold; }
        .value { flex: 1; }
        .amount-box { border: 2px solid #000; padding: 15px; margin: 20px 0; text-align: center; background: #f8f9fa; }
        .amount-box .label { font-size: 14px; margin-bottom: 10px; }
        .amount-box .amount { font-size: 28px; font-weight: bold; color: #135bec; }
        .footer { margin-top: 40px; display: flex; justify-content: space-between; }
        .signature { text-align: center; width: 200px; }
        .signature .line { border-top: 1px solid #000; margin-top: 60px; padding-top: 5px; }
        @media print {
            body { padding: 0; }
            .no-print { display: none; }
            .amount-box { background: #f8f9fa !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="header-logo">
                <img src="{{ asset('images/logo-sekolah.png') }}" alt="Logo SMA N 1 KERAJAAN">
            </div>
            <div class="header-text">
                <h1>SMA NEGERI 1 KERAJAAN</h1>
                <p>Jl. Pendidikan No. 123, Kerajaan</p>
                <p>Telp: (0123) 456789 | Email: info@sman1kerajaan.sch.id</p>
            </div>
            <div class="header-logo">
                <img src="{{ asset('images/logo-sekolah.png') }}" alt="Logo SMA N 1 KERAJAAN">
            </div>
        </div>

        <div class="title">
            <h2>BUKTI PEMBAYARAN SPP</h2>
            <p>No: {{ str_pad($pembayaran->id, 6, '0', STR_PAD_LEFT) }}/SPP/{{ date('Y') }}</p>
        </div>

        <div class="content">
            <div class="row">
                <div class="label">Nama Siswa</div>
                <div class="value">: {{ $pembayaran->siswa->nama }}</div>
            </div>
            <div class="row">
                <div class="label">NIS</div>
                <div class="value">: {{ $pembayaran->siswa->nis }}</div>
            </div>
            <div class="row">
                <div class="label">Kelas</div>
                <div class="value">: {{ $pembayaran->siswa->kelas->nama_kelas }}</div>
            </div>
            <div class="row">
                <div class="label">Bulan Pembayaran</div>
                <div class="value">: {{ $pembayaran->bulan }} {{ $pembayaran->tahun }}</div>
            </div>
            <div class="row">
                <div class="label">Tanggal Bayar</div>
                <div class="value">: {{ date('d F Y', strtotime($pembayaran->tanggal_bayar)) }}</div>
            </div>
            @if($pembayaran->rekening_id)
            <div class="row">
                <div class="label">Metode Pembayaran</div>
                <div class="value">: Transfer Bank</div>
            </div>
            <div class="row">
                <div class="label">Rekening Tujuan</div>
                <div class="value">: {{ $pembayaran->rekening->nama_bank }} - {{ $pembayaran->rekening->nomor_rekening }}</div>
            </div>
            <div class="row">
                <div class="label">Atas Nama</div>
                <div class="value">: {{ $pembayaran->rekening->atas_nama }}</div>
            </div>
            @else
            <div class="row">
                <div class="label">Metode Pembayaran</div>
                <div class="value">: Tunai</div>
            </div>
            @endif
        </div>

        <div class="amount-box">
            <div class="label">JUMLAH PEMBAYARAN</div>
            <div class="amount">Rp {{ number_format($pembayaran->jumlah_bayar, 0, ',', '.') }}</div>
            <div style="margin-top: 10px; font-style: italic; font-size: 12px;">
                ({{ ucwords(terbilang($pembayaran->jumlah_bayar)) }} Rupiah)
            </div>
        </div>

        @if($pembayaran->rekening_id && $pembayaran->rekening->qr_code)
        <div style="border: 2px solid #000; padding: 15px; margin: 20px 0; text-align: center;">
            <div style="font-size: 14px; font-weight: bold; margin-bottom: 10px;">SCAN UNTUK PEMBAYARAN</div>
            <img src="{{ asset('storage/' . $pembayaran->rekening->qr_code) }}" alt="QR Code" style="width: 200px; height: 200px; object-fit: contain; margin: 0 auto; display: block; border: 1px solid #ddd; padding: 10px; background: white;">
            <div style="margin-top: 10px; font-size: 12px; color: #666;">
                Scan QR Code di atas untuk pembayaran via {{ $pembayaran->rekening->nama_bank }}
            </div>
        </div>
        @endif

        @if($pembayaran->keterangan)
        <div class="row">
            <div class="label">Keterangan</div>
            <div class="value">: {{ $pembayaran->keterangan }}</div>
        </div>
        @endif

        <div class="footer">
            <div class="signature">
                <div>Siswa/Wali</div>
                <div class="line">{{ $pembayaran->siswa->nama }}</div>
            </div>
            <div class="signature">
                <div>{{ date('d F Y', strtotime($pembayaran->tanggal_bayar)) }}</div>
                <div>Petugas</div>
                <div class="line">{{ $pembayaran->petugas->name }}</div>
            </div>
        </div>
    </div>

    <div class="no-print" style="text-align: center; margin-top: 20px;">
        <button onclick="window.print()" style="padding: 10px 20px; background: #135bec; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 16px;">
            Cetak Bukti
        </button>
        <button onclick="window.close()" style="padding: 10px 20px; background: #6c757d; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; margin-left: 10px;">
            Tutup
        </button>
    </div>
</body>
</html>
