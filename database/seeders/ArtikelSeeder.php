<?php

namespace Database\Seeders;

use App\Models\Artikel;
use App\Support\StpiData;
use Illuminate\Database\Seeder;

class ArtikelSeeder extends Seeder
{
    public function run(): void
    {
        $artikels = StpiData::allArtikel();

        foreach ($artikels as $item) {
            Artikel::updateOrCreate(
                [
                    'judul' => $item['title'],
                ],
                [
                    'kategori' => $item['category'] ?? 'Berita',
                    'penulis' => $item['author'] ?? 'Admin STPI',
                    'tanggal' => $this->formatTanggal($item['date'] ?? null),
                    'status' => 'tayang',
                    'isi' => $this->formatIsi($item),
                ]
            );
        }
    }

    private function formatIsi(array $item): string
    {
        $isi = '';

        if (!empty($item['excerpt'])) {
            $isi .= $item['excerpt'] . "\n\n";
        }

        if (!empty($item['content']) && is_array($item['content'])) {
            foreach ($item['content'] as $block) {
                if (($block['type'] ?? '') === 'heading') {
                    $isi .= "\n" . strtoupper($block['text'] ?? '') . "\n\n";
                }

                if (($block['type'] ?? '') === 'paragraph') {
                    $isi .= ($block['text'] ?? '') . "\n\n";
                }

                if (($block['type'] ?? '') === 'quote') {
                    $isi .= '"' . ($block['text'] ?? '') . '"';

                    if (!empty($block['author'])) {
                        $isi .= "\n- " . $block['author'];
                    }

                    $isi .= "\n\n";
                }

                if (($block['type'] ?? '') === 'list' && !empty($block['items'])) {
                    foreach ($block['items'] as $list) {
                        $isi .= "- " . $list . "\n";
                    }

                    $isi .= "\n";
                }
            }
        }

        return trim($isi);
    }

    private function formatTanggal(?string $tanggal): string
    {
        if (!$tanggal) {
            return date('Y-m-d');
        }

        $bulan = [
            'Januari' => '01',
            'Februari' => '02',
            'Maret' => '03',
            'April' => '04',
            'Mei' => '05',
            'Juni' => '06',
            'Juli' => '07',
            'Agustus' => '08',
            'September' => '09',
            'Oktober' => '10',
            'November' => '11',
            'Desember' => '12',
        ];

        foreach ($bulan as $namaBulan => $angkaBulan) {
            if (str_contains($tanggal, $namaBulan)) {
                $tanggal = str_replace($namaBulan, $angkaBulan, $tanggal);
                break;
            }
        }

        $parts = explode(' ', $tanggal);

        if (count($parts) === 3) {
            return $parts[2] . '-' . $parts[1] . '-' . str_pad($parts[0], 2, '0', STR_PAD_LEFT);
        }

        return date('Y-m-d');
    }
}