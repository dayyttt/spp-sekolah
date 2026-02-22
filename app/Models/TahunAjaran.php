<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunAjaran extends Model
{
    use HasFactory;

    protected $table = 'tahun_ajaran';
    protected $fillable = ['tahun', 'nominal_spp', 'is_active'];

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class);
    }
}
