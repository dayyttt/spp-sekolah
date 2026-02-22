@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card text-white bg-primary mb-3">
            <div class="card-body">
                <h5 class="card-title">Total Siswa</h5>
                <h2>{{ $totalSiswa }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-success mb-3">
            <div class="card-body">
                <h5 class="card-title">Pembayaran Bulan Ini</h5>
                <h2>Rp {{ number_format($totalPembayaranBulanIni, 0, ',', '.') }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-info mb-3">
            <div class="card-body">
                <h5 class="card-title">Tahun Ajaran Aktif</h5>
                <h2>{{ $tahunAjaranAktif->tahun ?? '-' }}</h2>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5>Selamat Datang di Sistem Pembayaran SPP</h5>
    </div>
    <div class="card-body">
        <p>Sistem ini digunakan untuk mengelola pembayaran SPP siswa SMA N 1 KERAJAAN.</p>
        <p>Gunakan menu di atas untuk mengakses fitur-fitur yang tersedia.</p>
    </div>
</div>
@endsection
