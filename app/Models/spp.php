<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class spp extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'tahun',
        'nominal',
    ];
}
