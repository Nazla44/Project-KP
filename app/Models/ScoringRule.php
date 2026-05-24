<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScoringRule extends Model
{
    use HasFactory;

    protected $fillable = ['code','label','group','score','is_gate','is_active','sort_order'];

    protected function casts(): array
    {
        return [
            'score' => 'integer',
            'is_gate' => 'boolean',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }
}
