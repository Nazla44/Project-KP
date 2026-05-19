<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KlinikImport extends Model
{
    protected $fillable = [
        'user_id',
        'original_filename',
        'stored_path',
        'status',
        'total_rows',
        'valid_rows',
        'invalid_rows',
        'imported_rows',
        'created_rows',
        'updated_rows',
        'preview_payload',
        'imported_at',
    ];

    protected function casts(): array
    {
        return [
            'preview_payload' => 'array',
            'imported_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
