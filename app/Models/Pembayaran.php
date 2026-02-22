<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';
    protected $fillable = ['siswa_id', 'tahun_ajaran_id', 'bulan', 'tahun', 'jumlah_bayar', 'tanggal_bayar', 'petugas_id', 'keterangan', 'rekening_id'];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class);
    }

    public function petugas()
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }

    public function rekening()
    {
        return $this->belongsTo(RekeningSekolah::class, 'rekening_id');
    }
}
