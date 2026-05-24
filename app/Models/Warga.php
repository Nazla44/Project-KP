<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Warga extends Model
{
    use HasFactory;

    protected $table = 'wargas';
    protected $primaryKey = 'nik';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['nik','nama_lengkap','alamat','tanggal_lahir','jenis_kelamin','consent_verbal','consent_at'];

    protected function casts(): array
    {
        return [
            'tanggal_lahir' => 'date',
            'consent_verbal' => 'boolean',
            'consent_at' => 'datetime',
        ];
    }

    public function screeningResults(): HasMany
    {
        return $this->hasMany(ScreeningResult::class, 'warga_nik', 'nik');
    }
}
