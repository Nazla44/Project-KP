<?php

namespace Database\Seeders;

use App\Models\Klinik;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class KlinikSeeder extends Seeder
{
    public function run(): void
    {
        $path = public_path('data/klinik.json');

        if (!File::exists($path)) {
            $this->command->error('File klinik.json tidak ditemukan.');
            return;
        }

        $data = json_decode(File::get($path), true);

        if (!is_array($data)) {
            $this->command->error('Format klinik.json tidak valid.');
            return;
        }

        foreach ($data as $item) {
            Klinik::updateOrCreate(
                [
                    'nama' => $item['nama'] ?? null,
                    'alamat' => $item['alamat'] ?? null,
                ],
                [
                    'tipe' => $item['tipe'] ?? 'Klinik',
                    'kota' => $item['kota'] ?? '-',
                    'provinsi' => $item['provinsi'] ?? '-',
                    'telepon' => $item['telepon'] ?? '-',
                    'lat' => $item['lat'] ?? null,
                    'lng' => $item['lng'] ?? null,
                    'jam_buka' => $item['jam_buka'] ?? '08:00',
                    'jam_tutup' => $item['jam_tutup'] ?? '16:00',
                    'hari_buka' => $item['hari_buka'] ?? 'Senin – Jumat',
                    'layanan' => $item['layanan'] ?? [],
                    'status' => 'aktif',
                ]
            );
        }
    }
}