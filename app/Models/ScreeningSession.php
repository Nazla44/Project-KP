<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ScreeningSession extends Model
{
    use HasFactory;

    public const STATUS_AKTIF = 'aktif';
    public const STATUS_SELESAI = 'selesai';

    protected $fillable = [
        'kader_id',
        'kegiatan_id',
        'event_id',
        'tanggal_sesi',
        'lokasi_alamat',
        'lokasi_lat',
        'lokasi_lng',
        'total_diperiksa',
        'total_rendah',
        'total_sedang',
        'total_tinggi',
        'status',
        'closed_at',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_sesi' => 'date',
            'lokasi_lat' => 'float',
            'lokasi_lng' => 'float',
            'closed_at' => 'datetime',
        ];
    }

    public function kader(): BelongsTo
    {
        return $this->belongsTo(Kader::class);
    }

    public function kegiatan(): BelongsTo
    {
        return $this->belongsTo(KegiatanSosial::class, 'kegiatan_id');
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function results(): HasMany
    {
        return $this->hasMany(ScreeningResult::class, 'sesi_id');
    }
}