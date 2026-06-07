<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class KegiatanSosial extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'kegiatan_sosial';

    protected $fillable = [
        'created_by',
        'judul',
        'slug',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'lokasi',
        'latitude',
        'longitude',
        'deskripsi',
        'banner',
        'status',
        'published_at',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'published_at' => 'datetime',
        'latitude' => 'float',
        'longitude' => 'float',
    ];

    // -------------------------------------------------------
    // Boot: auto-generate slug dari judul
    // -------------------------------------------------------
    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($kegiatan) {
            if (empty($kegiatan->slug)) {
                $kegiatan->slug = static::generateSlug($kegiatan->judul);
            }
        });

        static::updating(function ($kegiatan) {
            if ($kegiatan->isDirty('judul') && empty($kegiatan->slug)) {
                $kegiatan->slug = static::generateSlug($kegiatan->judul);
            }
        });
    }

    protected static function generateSlug(string $judul): string
    {
        $slug = Str::slug($judul);
        $count = static::where('slug', 'like', "{$slug}%")->count();
        return $count > 0 ? "{$slug}-{$count}" : $slug;
    }

    // -------------------------------------------------------
    // Relationships
    // -------------------------------------------------------

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function kaders()
    {
        return $this->belongsToMany(Kader::class, 'kegiatan_kader', 'kegiatan_id', 'kader_id')
            ->withPivot('peran')
            ->withTimestamps();
    }

    public function materi()
    {
        return $this->hasMany(MateriKegiatan::class, 'kegiatan_id')
            ->orderBy('urutan');
    }

    public function dokumentasi()
    {
        return $this->hasMany(DokumentasiKegiatan::class, 'kegiatan_id')
            ->orderBy('urutan');
    }

    public function ringkasan()
    {
        return $this->hasOne(RingkasanKegiatan::class, 'kegiatan_id');
    }

    /** Relasi ke screening — siap untuk fase berikutnya */
    public function screeningSessions()
    {
        return $this->hasMany(ScreeningSession::class, 'kegiatan_id');
    }

    // -------------------------------------------------------
    // Scopes
    // -------------------------------------------------------

    /** Hanya kegiatan yang sudah dipublish (untuk halaman publik) */
    public function scopePublished($query)
    {
        return $query->whereIn('status', ['published', 'ongoing', 'completed']);
    }

    /** Kegiatan yang akan datang */
    public function scopeUpcoming($query)
    {
        return $query->where('status', 'published')
            ->where('tanggal', '>=', now()->toDateString());
    }

    /** Kegiatan yang sudah selesai */
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    // -------------------------------------------------------
    // Accessors
    // -------------------------------------------------------

    /** Status dalam bahasa Indonesia untuk tampilan */
    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'draft' => 'Draft',
            'published' => 'Akan Datang',
            'ongoing' => 'Berlangsung',
            'completed' => 'Selesai',
            'cancelled' => 'Dibatalkan',
            default => '-',
        };
    }

    /** Warna badge Tailwind sesuai status */
    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            'draft' => 'gray',
            'published' => 'blue',
            'ongoing' => 'green',
            'completed' => 'purple',
            'cancelled' => 'red',
            default => 'gray',
        };
    }

    public function getBannerUrlAttribute(): string
    {
        return $this->banner
            ? asset('storage/' . $this->banner)
            : asset('assets/image/Hero-bg.png');
    }
}