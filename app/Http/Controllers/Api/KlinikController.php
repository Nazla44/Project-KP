<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\KlinikResource;
use App\Models\Klinik;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class KlinikController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'q' => ['nullable', 'string', 'max:100'],
            'provinsi' => ['nullable', 'string', 'max:100'],
            'kota' => ['nullable', 'string', 'max:100'],
            'tipe' => ['nullable', 'string', 'max:50'],
            'status' => ['nullable', 'in:aktif,nonaktif'],
            'layanan' => ['nullable', 'string', 'max:100'],
            'buka_di_hari' => ['nullable', 'in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu'],
            'tutup_di_hari' => ['nullable', 'in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu'],
            'per_page' => ['nullable', 'integer', 'min:1', 'max:100'],
        ]);

        $perPage = (int) ($validated['per_page'] ?? 20);

        $query = Klinik::query()
            ->when($validated['q'] ?? null, function (Builder $query, string $keyword) {
                $query->where(function (Builder $subQuery) use ($keyword) {
                    $subQuery
                        ->where('nama', 'like', "%{$keyword}%")
                        ->orWhere('alamat', 'like', "%{$keyword}%")
                        ->orWhere('kota', 'like', "%{$keyword}%")
                        ->orWhere('provinsi', 'like', "%{$keyword}%")
                        ->orWhere('tipe', 'like', "%{$keyword}%")
                        ->orWhere('telepon', 'like', "%{$keyword}%")
                        ->orWhereJsonContains('layanan', $keyword);
                });
            })
            ->when($validated['provinsi'] ?? null, fn (Builder $query, string $provinsi) => $query->where('provinsi', $provinsi))
            ->when($validated['kota'] ?? null, fn (Builder $query, string $kota) => $query->where('kota', $kota))
            ->when($validated['tipe'] ?? null, fn (Builder $query, string $tipe) => $query->where('tipe', $tipe))
            ->when($validated['status'] ?? null, fn (Builder $query, string $status) => $query->where('status', $status))
            ->when($validated['layanan'] ?? null, fn (Builder $query, string $layanan) => $query->whereJsonContains('layanan', $layanan))
            ->when($validated['buka_di_hari'] ?? null, fn (Builder $query, string $day) => $this->applyOpenDayFilter($query, $day))
            ->when($validated['tutup_di_hari'] ?? null, fn (Builder $query, string $day) => $this->applyClosedDayFilter($query, $day))
            ->orderBy('provinsi')
            ->orderBy('kota')
            ->orderBy('nama');

        $paginator = $query->paginate($perPage)->withQueryString();

        return response()->json([
            'message' => 'Daftar klinik berhasil diambil.',
            'data' => KlinikResource::collection($paginator->getCollection())->resolve(),
            'meta' => [
                'current_page' => $paginator->currentPage(),
                'per_page' => $paginator->perPage(),
                'total' => $paginator->total(),
                'last_page' => $paginator->lastPage(),
            ],
        ]);
    }

    public function show(Klinik $klinik): JsonResponse
    {
        return response()->json([
            'message' => 'Detail klinik berhasil diambil.',
            'data' => (new KlinikResource($klinik))->resolve(),
        ]);
    }

    public function nearest(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'latitude' => ['required', 'numeric', 'between:-90,90'],
            'longitude' => ['required', 'numeric', 'between:-180,180'],
            'limit' => ['nullable', 'integer', 'min:1', 'max:50'],
            'radius_km' => ['nullable', 'numeric', 'min:1', 'max:20000'],
            'status' => ['nullable', 'in:aktif,nonaktif'],
            'tipe' => ['nullable', 'string', 'max:50'],
            'buka_di_hari' => ['nullable', 'in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu'],
            'tutup_di_hari' => ['nullable', 'in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu'],
            'open_now' => ['nullable', 'boolean'],
        ]);

        $latitude = (float) $validated['latitude'];
        $longitude = (float) $validated['longitude'];
        $limit = (int) ($validated['limit'] ?? 10);
        $radiusKm = isset($validated['radius_km']) ? (float) $validated['radius_km'] : null;
        $openNow = filter_var($request->query('open_now', false), FILTER_VALIDATE_BOOLEAN);
        $nowTime = now()->format('H:i');
        $today = $this->resolveHariIndonesia(now()->dayOfWeek);

        $distanceExpression = '(6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude))))';

        $query = Klinik::query()
            ->select('klinik.*')
            ->selectRaw($distanceExpression.' as distance_km', [$latitude, $longitude, $latitude])
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->when($validated['status'] ?? null, fn (Builder $query, string $status) => $query->where('status', $status))
            ->when($validated['tipe'] ?? null, fn (Builder $query, string $tipe) => $query->where('tipe', $tipe))
            ->when($validated['buka_di_hari'] ?? null, fn (Builder $query, string $day) => $this->applyOpenDayFilter($query, $day))
            ->when($validated['tutup_di_hari'] ?? null, fn (Builder $query, string $day) => $this->applyClosedDayFilter($query, $day))
            ->when($openNow, function (Builder $query) use ($nowTime, $today) {
                $query->whereNotNull('jam_buka')
                    ->whereNotNull('jam_tutup')
                    ->where('jam_buka', '<=', $nowTime)
                    ->where('jam_tutup', '>=', $nowTime)
                    ->where(function (Builder $subQuery) use ($today) {
                        $subQuery->whereNull('hari_tutup')
                            ->orWhereRaw('LOWER(COALESCE(hari_tutup, "")) NOT LIKE ?', ['%'.mb_strtolower($today).'%']);
                    });
            })
            ->when($radiusKm !== null, fn (Builder $query) => $query->having('distance_km', '<=', $radiusKm))
            ->orderBy('distance_km')
            ->limit($limit);

        $kliniks = $query->get();

        return response()->json([
            'message' => 'Klinik terdekat berhasil diambil.',
            'data' => KlinikResource::collection($kliniks)->resolve(),
            'meta' => [
                'origin' => [
                    'latitude' => $latitude,
                    'longitude' => $longitude,
                ],
                'limit' => $limit,
                'radius_km' => $radiusKm,
                'count' => $kliniks->count(),
            ],
        ]);
    }

    public function filters(): JsonResponse
    {
        $provinsi = Klinik::query()
            ->whereNotNull('provinsi')
            ->distinct()
            ->orderBy('provinsi')
            ->pluck('provinsi')
            ->values();

        $kota = Klinik::query()
            ->whereNotNull('kota')
            ->distinct()
            ->orderBy('kota')
            ->pluck('kota')
            ->values();

        $tipe = Klinik::query()
            ->whereNotNull('tipe')
            ->distinct()
            ->orderBy('tipe')
            ->pluck('tipe')
            ->values();

        $layanan = Klinik::query()
            ->whereNotNull('layanan')
            ->pluck('layanan')
            ->filter(fn ($item) => is_array($item))
            ->flatten()
            ->map(fn ($item) => trim((string) $item))
            ->filter()
            ->unique()
            ->sort()
            ->values();

        return response()->json([
            'message' => 'Filter klinik berhasil diambil.',
            'data' => [
                'provinsi' => $provinsi,
                'kota' => $kota,
                'tipe' => $tipe,
                'layanan' => $layanan,
                'status' => ['aktif', 'nonaktif'],
                'hari' => ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
            ],
        ]);
    }

    private function applyOpenDayFilter(Builder $query, string $day): Builder
    {
        $day = mb_strtolower($day);

        return $query->where(function (Builder $subQuery) use ($day) {
            $subQuery->whereRaw('LOWER(COALESCE(hari_buka, "")) LIKE ?', ['%'.$day.'%'])
                ->orWhereNull('hari_tutup')
                ->orWhereRaw('LOWER(COALESCE(hari_tutup, "")) NOT LIKE ?', ['%'.$day.'%']);
        });
    }

    private function applyClosedDayFilter(Builder $query, string $day): Builder
    {
        $day = mb_strtolower($day);

        return $query->whereRaw('LOWER(COALESCE(hari_tutup, "")) LIKE ?', ['%'.$day.'%']);
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
}
