<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KlinikResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $currentTime = now()->format('H:i');
        $today = $this->resolveHariIndonesia(now()->dayOfWeek);
        $isClosedToday = $this->stringContainsDay($this->hari_tutup, $today);
        $withinOperationalHours = $this->jam_buka !== null
            && $this->jam_tutup !== null
            && $this->jam_buka <= $currentTime
            && $this->jam_tutup >= $currentTime;

        return [
            'id' => $this->id,
            'nama' => $this->nama,
            'tipe' => $this->tipe,
            'alamat' => $this->alamat,
            'kota' => $this->kota,
            'provinsi' => $this->provinsi,
            'telepon' => $this->telepon,
            'status' => $this->status,
            'latitude' => $this->latitude !== null ? (float) $this->latitude : null,
            'longitude' => $this->longitude !== null ? (float) $this->longitude : null,
            'jam_buka' => $this->jam_buka,
            'jam_tutup' => $this->jam_tutup,
            'hari_buka' => $this->hari_buka,
            'hari_tutup' => $this->hari_tutup,
            'layanan' => $this->layanan ?? [],
            'distance_km' => isset($this->distance_km) ? round((float) $this->distance_km, 2) : null,
            'is_open_now' => !$isClosedToday && $withinOperationalHours,
            'google_maps_url' => $this->latitude !== null && $this->longitude !== null
                ? 'https://www.google.com/maps?q='.$this->latitude.','.$this->longitude
                : null,
            'created_at' => optional($this->created_at)?->toISOString(),
            'updated_at' => optional($this->updated_at)?->toISOString(),
        ];
    }

    private function resolveHariIndonesia(int $dayOfWeek): string
    {
        return [
            'Minggu',
            'Senin',
            'Selasa',
            'Rabu',
            'Kamis',
            'Jumat',
            'Sabtu',
        ][$dayOfWeek] ?? '';
    }

    private function stringContainsDay(?string $value, string $day): bool
    {
        if ($value === null || $value === '') {
            return false;
        }

        return str_contains(mb_strtolower($value), mb_strtolower($day));
    }
}
