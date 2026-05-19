<?php

namespace Database\Seeders;

use App\Models\Laporan;
use App\Support\StpiData;
use Illuminate\Database\Seeder;

class LaporanSeeder extends Seeder
{
    public function run(): void
    {
        $documents = StpiData::documents();

        foreach ($documents as $item) {
            Laporan::updateOrCreate(
                [
                    'nama' => $item['nama'],
                ],
                [
                    'kategori' => 'Laporan Dampak',
                    'tanggal' => $this->formatTanggalIndonesia($item['tanggal'] ?? null),
                    'file' => $item['link'] ?? '#',
                    'status' => 'tayang',
                ]
            );
        }
    }

    private function formatTanggalIndonesia(?string $tanggal): string
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

        foreach ($bulan as $nama => $angka) {
            if (str_contains($tanggal, $nama)) {
                $tanggal = str_replace($nama, $angka, $tanggal);
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