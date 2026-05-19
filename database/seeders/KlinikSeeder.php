<?php

namespace Database\Seeders;

use App\Models\Klinik;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class KlinikSeeder extends Seeder
{
    public function run(): void
    {
        $jsonPath = public_path('data/klinik.json');

        if (!File::exists($jsonPath)) {
            Klinik::query()->updateOrCreate([
                'nama' => 'Klinik Sehat Bersama',
                'alamat' => 'Jl. Merdeka No.10, Jakarta',
            ], [
                'tipe' => 'Klinik',
                'kota' => 'Jakarta',
                'provinsi' => 'DKI Jakarta',
                'telepon' => '081234567890',
                'latitude' => -6.2000000,
                'longitude' => 106.8166667,
                'jam_buka' => '08:00',
                'jam_tutup' => '15:00',
                'hari_buka' => 'Senin - Jumat',
                'hari_tutup' => 'Sabtu, Minggu',
                'layanan' => ['Diagnosis TBC', 'Pengobatan OAT'],
                'status' => 'aktif',
            ]);

            return;
        }

        $kliniks = json_decode(File::get($jsonPath), true);

        if (!is_array($kliniks)) {
            return;
        }

        foreach ($kliniks as $klinik) {
            $layanan = array_values(array_filter(
                array_map(fn ($item) => trim((string) $item), $klinik['layanan'] ?? [])
            ));

            Klinik::query()->updateOrCreate([
                'nama' => (string) ($klinik['nama'] ?? ''),
                'alamat' => (string) ($klinik['alamat'] ?? ''),
            ], [
                'tipe' => (string) ($klinik['tipe'] ?? 'Klinik'),
                'kota' => isset($klinik['kota']) ? (string) $klinik['kota'] : null,
                'provinsi' => (string) ($klinik['provinsi'] ?? ''),
                'telepon' => (string) ($klinik['telepon'] ?? '-'),
                'latitude' => isset($klinik['lat']) ? (float) $klinik['lat'] : null,
                'longitude' => isset($klinik['lng']) ? (float) $klinik['lng'] : null,
                'jam_buka' => isset($klinik['jam_buka']) ? (string) $klinik['jam_buka'] : null,
                'jam_tutup' => isset($klinik['jam_tutup']) ? (string) $klinik['jam_tutup'] : null,
                'hari_buka' => $this->normalizeHariText($klinik['hari_buka'] ?? null),
                'hari_tutup' => $this->resolveHariTutup($klinik),
                'layanan' => $layanan,
                'status' => 'aktif',
            ]);
        }
    }

    private function normalizeHariText(mixed $value): ?string
    {
        if ($value === null) {
            return null;
        }

        return str_replace(["Ã¢â‚¬â€œ", "â€“", "–"], '-', (string) $value);
    }

    private function resolveHariTutup(array $klinik): ?string
    {
        if (!empty($klinik['hari_tutup'])) {
            return $this->normalizeHariText($klinik['hari_tutup']);
        }

        $hariBuka = mb_strtolower((string) $this->normalizeHariText($klinik['hari_buka'] ?? ''));

        if ($hariBuka === '') {
            return null;
        }

        if (str_contains($hariBuka, 'senin') && str_contains($hariBuka, 'jumat') && !str_contains($hariBuka, 'sabtu')) {
            return 'Sabtu, Minggu';
        }

        if (str_contains($hariBuka, 'sabtu') && !str_contains($hariBuka, 'minggu')) {
            return 'Minggu';
        }

        return null;
    }
}
