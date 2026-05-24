<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReportA extends Model
{
    use HasFactory;

    protected $table = 'report_a';

    protected $fillable = ['event_id','kader_id','jumlah_peserta','topik','catatan','foto_urls','status','dibuat_pada'];

    protected function casts(): array
    {
        return [
            'foto_urls' => 'array',
            'dibuat_pada' => 'datetime',
        ];
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function kader(): BelongsTo
    {
        return $this->belongsTo(Kader::class);
    }
}
