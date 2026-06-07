<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Artikel extends Model
{
    use HasFactory;

    protected $table = 'artikel';

    protected $fillable = [
        'judul',
        'slug',
        'kategori',
        'cover_image',
        'penulis',
        'tanggal',
        'status',
        'isi',
    ];

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'id';
    }

    public function getTopikAttribute(): string
    {
        return (string) $this->kategori;
    }

    public function setTopikAttribute(string $value): void
    {
        $this->attributes['kategori'] = $value;
    }

    public function getCoverImageUrlAttribute(): string
    {
        if ($this->cover_image) {
            if (Storage::disk('public')->exists($this->cover_image)) {
                return asset(Storage::url($this->cover_image));
            }

            if (file_exists(public_path($this->cover_image))) {
                return asset($this->cover_image);
            }
        }

        return asset('assets/image/news-1.png');
    }

    public function buildUniqueSlug(?string $title = null): string
    {
        $baseSlug = Str::slug($title ?: $this->judul);
        $slug = $baseSlug !== '' ? $baseSlug : 'artikel';
        $original = $slug;
        $counter = 2;

        while (
            static::query()
                ->where('slug', $slug)
                ->when($this->exists, fn ($query) => $query->whereKeyNot($this->getKey()))
                ->exists()
        ) {
            $slug = $original . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    public function toPublicArticleArray(): array
    {
        $excerpt = Str::limit(trim(strip_tags($this->isi)), 180);

        return [
            'slug' => $this->slug,
            'img' => $this->cover_image_url,
            'category' => $this->topik,
            'date' => optional($this->tanggal)->translatedFormat('d F Y') ?? $this->created_at?->translatedFormat('d F Y'),
            'author' => $this->penulis ?: 'Super Admin',
            'source' => 'berita',
            'title' => $this->judul,
            'excerpt' => $excerpt,
            'content' => [
                [
                    'type' => 'paragraph',
                    'text' => trim($this->isi),
                ],
            ],
            'tags' => [$this->topik],
            'related' => [],
        ];
    }
}