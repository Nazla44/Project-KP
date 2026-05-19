<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Klinik extends Model
{
    use HasFactory;

    protected $table = 'klinik';

    protected $fillable = [
        'nama',
        'tipe',
        'kota',
        'provinsi',
        'alamat',
        'telepon',
        'lat',
        'lng',
        'jam_buka',
        'jam_tutup',
        'hari_buka',
        'layanan',
        'status',
    ];

    protected $casts = [
        'lat' => 'float',
        'lng' => 'float',
        'layanan' => 'array',
    ];

    public function kaders()
    {
        return $this->hasMany(Kader::class);
    }
}
