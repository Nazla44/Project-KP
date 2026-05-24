<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kader extends Model
{
    use HasFactory;

    public const STATUS_VERIFIKASI = 'verifikasi';
    public const STATUS_AKTIF = 'aktif';
    public const STATUS_DITOLAK = 'ditolak';
    public const STATUS_SUSPEND = 'suspend';

    protected $fillable = [
        'user_id',
        'nama',
        'nik',
        'klinik_id',
        'hp',
        'email',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'provinsi',
        'kab_kota',
        'kecamatan',
        'pekerjaan',
        'pendidikan',
        'motivasi',
        'pengalaman_tb',
        'ketersediaan',
        'tgl_bergabung',
        'status',
        'approved_at',
        'approved_by',
        'rejected_at',
        'rejected_by',
        'rejection_reason',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_lahir' => 'date',
            'tgl_bergabung' => 'date',
            'approved_at' => 'datetime',
            'rejected_at' => 'datetime',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function klinik()
    {
        return $this->belongsTo(Klinik::class);
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function rejectedBy()
    {
        return $this->belongsTo(User::class, 'rejected_by');
    }

    public function isPending(): bool
    {
        return $this->status === self::STATUS_VERIFIKASI;
    }

    public function isActive(): bool
    {
        return $this->status === self::STATUS_AKTIF;
    }

    public function isRejected(): bool
    {
        return $this->status === self::STATUS_DITOLAK;
    }

    public function statusLabel(): string
    {
        return match ($this->status) {
            self::STATUS_VERIFIKASI => 'Menunggu Verifikasi',
            self::STATUS_AKTIF => 'Aktif',
            self::STATUS_DITOLAK => 'Ditolak',
            self::STATUS_SUSPEND => 'Suspend',
            default => ucfirst((string) $this->status),
        };
    }
}