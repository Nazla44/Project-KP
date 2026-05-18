<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Klinik extends Model
{
    use HasFactory;

    protected $table = 'klinik';
    protected $fillable = ['nama', 'alamat', 'provinsi', 'telepon', 'status'];

    public function kaders()
    {
        return $this->hasMany(Kader::class);
    }
}