<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;

class siswa extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'code',
        'nisn',
        'nis',
        'name',
        'alamat',
        'telp',
        'image',
        'id_kelas',
        'id_spp',
    ];

    public function kelas(): HasOne
    {
        return $this->hasOne(kelas::class, 'id', 'id_kelas');
    }

    public function spp(): HasOne
    {
        return $this->hasOne(spp::class, 'id', 'id_spp');
    }

    public function getAuthIdentifierName()
    {
        return 'id';
    }

    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }
}
