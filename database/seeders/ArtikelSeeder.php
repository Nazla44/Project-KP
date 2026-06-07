<?php

namespace Database\Seeders;

use App\Models\Artikel;
use App\Support\StpiData;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArtikelSeeder extends Seeder
{
    public function run(): void
    {
        foreach (StpiData::allArtikel() as $item) {
            $judul = $item['title'] ?? 'Artikel STPI';
            $slug = $item['slug'] ?? Str::slug($judul);

            Artikel::query()->updateOrCreate(
                ['slug' => $slug],
                [
                    'judul' => $judul,
                    'kategori' => $item['category'] ?? 'Seputar TBC',
                    'cover_image' => $item['img'] ?? null,
                    'penulis' => $item['author'] ?? 'Tim STPI',
                    'tanggal' => $this->parseTanggal($item['date'] ?? null),
                    'status' => 'tayang',
                    'isi' => $this->buildIsiArtikel($item),
                ]
            );
        }
    }

    private function buildIsiArtikel(array $item): string
    {
        $content = $item['content'] ?? [];

        if (empty($content)) {
            return trim($item['excerpt'] ?? '');
        }

        $blocks = [];

        foreach ($content as $block) {
            $type = $block['type'] ?? 'paragraph';

            if ($type === 'heading') {
                $blocks[] = strtoupper($block['text'] ?? '');
                continue;
            }

            if ($type === 'quote') {
                $quote = $block['text'] ?? '';
                $author = $block['author'] ?? null;

                $blocks[] = $author
                    ? "\"{$quote}\"\n— {$author}"
                    : "\"{$quote}\"";

                continue;
            }

            if ($type === 'list') {
                $items = $block['items'] ?? [];

                $blocks[] = collect($items)
                    ->map(fn ($value) => '- ' . $value)
                    ->implode("\n");

                continue;
            }

            $blocks[] = $block['text'] ?? '';
        }

        return trim(implode("\n\n", array_filter($blocks)));
    }

    private function parseTanggal(?string $tanggal): string
    {
        if (! $tanggal) {
            return now()->toDateString();
        }

        $months = [
            'Januari' => 'January',
            'Februari' => 'February',
            'Maret' => 'March',
            'April' => 'April',
            'Mei' => 'May',
            'Juni' => 'June',
            'Juli' => 'July',
            'Agustus' => 'August',
            'September' => 'September',
            'Oktober' => 'October',
            'November' => 'November',
            'Desember' => 'December',
            'Jan' => 'January',
            'Feb' => 'February',
            'Mar' => 'March',
            'Apr' => 'April',
            'Jun' => 'June',
            'Jul' => 'July',
            'Agu' => 'August',
            'Sep' => 'September',
            'Okt' => 'October',
            'Nov' => 'November',
            'Des' => 'December',
        ];

        $normalized = str_replace(array_keys($months), array_values($months), $tanggal);

        try {
            return Carbon::parse($normalized)->toDateString();
        } catch (\Throwable) {
            return now()->toDateString();
        }
    }
}