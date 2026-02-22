@extends('layouts.app')

@section('title', 'Riwayat Pembayaran')

@section('content')
<div class="card mb-3">
    <div class="card-body">
        <h5>Data Siswa</h5>
        <table class="table table-borderless">
            <tr>
                <td width="150">NIS</td>
                <td>: {{ $siswa->nis }}</td>
            </tr>
            <tr>
                <td>Nama</td>
                <td>: {{ $siswa->nama }}</td>
            </tr>
            <tr>
                <td>Kelas</td>
                <td>: {{ $siswa->kelas->nama_kelas }}</td>
            </tr>
        </table>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5>Riwayat Pembayaran SPP</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Tanggal Bayar</th>
                        <th>Bulan</th>
                        <th>Tahun</th>
                        <th>Jumlah</th>
                        <th>Petugas</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pembayaran as $p)
                    <tr>
                        <td>{{ date('d/m/Y', strtotime($p->tanggal_bayar)) }}</td>
                        <td>{{ $p->bulan }}</td>
                        <td>{{ $p->tahun }}</td>
                        <td>Rp {{ number_format($p->jumlah_bayar, 0, ',', '.') }}</td>
                        <td>{{ $p->petugas->name }}</td>
                        <td>{{ $p->keterangan }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">Belum ada pembayaran</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <a href="{{ route('siswa.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
@endsection
