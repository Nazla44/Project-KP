<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ScreeningResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'sesi_id','warga_nik','jawaban_gejala','skor_total','level_risiko','rekomendasi_tindakan',
        'klinik_id','catatan_kader','diperiksa_pada',
    ];

    protected function casts(): array
    {
        return [
            'jawaban_gejala' => 'array',
            'diperiksa_pada' => 'datetime',
        ];
    }

    public function session(): BelongsTo
    {
        return $this->belongsTo(ScreeningSession::class, 'sesi_id');
    }

    public function warga(): BelongsTo
    {
        return $this->belongsTo(Warga::class, 'warga_nik', 'nik');
    }

    public function klinik(): BelongsTo
    {
        return $this->belongsTo(Klinik::class);
    }
}
