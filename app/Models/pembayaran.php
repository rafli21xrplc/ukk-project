<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class pembayaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'id_petugas',
        'nisn',
        'tgl_bayar',
        'bln_bayar',
        'thn_bayar',
        'id_spp',
        'jumlah_bayar'
    ];

    public function spp(): HasOne
    {
        return $this->hasOne(spp::class, 'id', 'id_spp');
    }

    public function petugas(): HasOne
    {
        return $this->hasOne(petugas::class, 'id', 'id_petugas');
    }

    public function siswa(): HasOne
    {
        return $this->hasOne(siswa::class, 'id', 'nisn');
    }
}
