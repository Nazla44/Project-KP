<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DokumentasiKegiatan extends Model
{
    protected $table = 'dokumentasi_kegiatan';

    protected $fillable = [
        'kegiatan_id',
        'file_path',
        'caption',
        'urutan',
    ];

    protected $appends = ['url'];

    public function kegiatan()
    {
        return $this->belongsTo(KegiatanSosial::class, 'kegiatan_id');
    }

    public function getUrlAttribute(): string
    {
        return asset('storage/' . $this->file_path);
    }
}