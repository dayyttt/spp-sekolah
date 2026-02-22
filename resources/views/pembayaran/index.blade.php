@extends('layouts.app')

@section('title', 'Pembayaran SPP')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Data Pembayaran SPP</h2>
    <a href="{{ route('pembayaran.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Input Pembayaran
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>NIS</th>
                        <th>Nama Siswa</th>
                        <th>Bulan</th>
                        <th>Tahun</th>
                        <th>Jumlah</th>
                        <th>Petugas</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pembayaran as $p)
                    <tr>
                        <td>{{ date('d/m/Y', strtotime($p->tanggal_bayar)) }}</td>
                        <td>{{ $p->siswa->nis }}</td>
                        <td>{{ $p->siswa->nama }}</td>
                        <td>{{ $p->bulan }}</td>
                        <td>{{ $p->tahun }}</td>
                        <td>Rp {{ number_format($p->jumlah_bayar, 0, ',', '.') }}</td>
                        <td>{{ $p->petugas->name }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">Tidak ada data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $pembayaran->links() }}
    </div>
</div>
@endsection
