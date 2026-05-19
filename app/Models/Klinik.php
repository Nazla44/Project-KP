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
        'alamat',
        'kota',
        'provinsi',
        'telepon',
        'latitude',
        'longitude',
        'jam_buka',
        'jam_tutup',
        'hari_buka',
        'hari_tutup',
        'layanan',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'latitude' => 'float',
            'longitude' => 'float',
            'layanan' => 'array',
        ];
    }

    public function kaders()
    {
        return $this->hasMany(Kader::class);
    }
}
