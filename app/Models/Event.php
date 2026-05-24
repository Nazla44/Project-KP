<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    use HasFactory;

    public const STATUS_DRAFT = 'draft';
    public const STATUS_MENUNGGU = 'menunggu';
    public const STATUS_DISETUJUI = 'disetujui';
    public const STATUS_DITOLAK = 'ditolak';
    public const STATUS_SELESAI = 'selesai';
    public const STATUS_BATAL = 'batal';

    protected $fillable = [
        'kader_id','judul','tanggal_pelaksanaan','lokasi_alamat','lokasi_lat','lokasi_lng','deskripsi',
        'status','catatan_admin','approved_by','approved_at','submitted_at','cancelled_at',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_pelaksanaan' => 'date',
            'lokasi_lat' => 'float',
            'lokasi_lng' => 'float',
            'approved_at' => 'datetime',
            'submitted_at' => 'datetime',
            'cancelled_at' => 'datetime',
        ];
    }

    public function kader(): BelongsTo
    {
        return $this->belongsTo(Kader::class);
    }

    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function reportA(): HasOne
    {
        return $this->hasOne(ReportA::class);
    }

    public function screeningSessions(): HasMany
    {
        return $this->hasMany(ScreeningSession::class);
    }
}
