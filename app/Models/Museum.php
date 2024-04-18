<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Museum extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'alamat',
        'kota',
        'provinsi',
        'kode_pos',
        'telepon',
        'email',
        'website',
        'medsos_instagram',
        'medsos_twitter',
        'medsos_facebook',
        'medsos_tiktok',
        'googlemap',
        'jenis',
        'status',
        'owner',
        'nama_owner',
        'foto_utama',
        'foto_umum',
        'logo',
        'keterangan',
    ];
}
