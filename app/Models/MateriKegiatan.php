<?php
// ============================================================
// app/Models/MateriKegiatan.php
// ============================================================
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MateriKegiatan extends Model
{
    protected $table = 'materi_kegiatan';

    protected $fillable = [
        'kegiatan_id',
        'judul',
        'konten',
        'icon',
        'urutan',
    ];

    protected $casts = [
        'urutan' => 'integer',
    ];

    public function kegiatan()
    {
        return $this->belongsTo(KegiatanSosial::class, 'kegiatan_id');
    }
}