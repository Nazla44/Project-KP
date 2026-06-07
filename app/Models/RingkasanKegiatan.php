<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RingkasanKegiatan extends Model
{
    protected $table = 'ringkasan_kegiatan';

    protected $fillable = [
        'kegiatan_id',
        'jumlah_peserta',
        'jumlah_kader',
        'jumlah_materi',
        'catatan_internal',
        'diisi_oleh',
    ];

    protected $casts = [
        'jumlah_peserta' => 'integer',
        'jumlah_kader' => 'integer',
        'jumlah_materi' => 'integer',
    ];

    public function kegiatan()
    {
        return $this->belongsTo(KegiatanSosial::class, 'kegiatan_id');
    }

    public function pengisi()
    {
        return $this->belongsTo(User::class, 'diisi_oleh');
    }
}