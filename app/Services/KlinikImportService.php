<?php

namespace App\Services;

use App\Models\Klinik;
use App\Models\KlinikImport;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use SplFileObject;

class KlinikImportService
{
    private const HEADER_ALIASES = [
        'kode_klinik' => 'kode_klinik',
        'kode' => 'kode_klinik',
        'clinic_code' => 'kode_klinik',
        'nama' => 'nama',
        'name' => 'nama',
        'tipe' => 'tipe',
        'type' => 'tipe',
        'alamat' => 'alamat',
        'address' => 'alamat',
        'kota' => 'kota',
        'city' => 'kota',
        'provinsi' => 'provinsi',
        'province' => 'provinsi',
        'telepon' => 'telepon',
        'phone' => 'telepon',
        'latitude' => 'latitude',
        'lat' => 'latitude',
        'longitude' => 'longitude',
        'lng' => 'longitude',
        'jam_buka' => 'jam_buka',
        'open_time' => 'jam_buka',
        'jam_tutup' => 'jam_tutup',
        'close_time' => 'jam_tutup',
        'hari_buka' => 'hari_buka',
        'open_days' => 'hari_buka',
        'hari_tutup' => 'hari_tutup',
        'closed_days' => 'hari_tutup',
        'layanan' => 'layanan',
        'services' => 'layanan',
        'status' => 'status',
    ];

    private const REQUIRED_HEADERS = [
        'nama',
        'tipe',
        'alamat',
        'kota',
        'provinsi',
        'latitude',
        'longitude',
        'status',
    ];

    public function preview(UploadedFile $file, ?User $user = null): KlinikImport
    {
        $storedPath = $file->store('imports/kliniks', 'local');
        $payload = $this->parseStoredCsv($storedPath);

        return KlinikImport::query()->create([
            'user_id' => $user?->id,
            'original_filename' => $file->getClientOriginalName(),
            'stored_path' => $storedPath,
            'status' => $payload['invalid_rows'] > 0 ? 'failed' : 'draft',
            'total_rows' => $payload['total_rows'],
            'valid_rows' => $payload['valid_rows'],
            'invalid_rows' => $payload['invalid_rows'],
            'preview_payload' => $payload,
        ]);
    }

    public function commit(KlinikImport $import): array
    {
        $payload = $this->parseStoredCsv($import->stored_path);

        if (($payload['invalid_rows'] ?? 0) > 0 || ($payload['missing_headers'] ?? []) !== []) {
            $import->update([
                'status' => 'failed',
                'total_rows' => $payload['total_rows'],
                'valid_rows' => $payload['valid_rows'],
                'invalid_rows' => $payload['invalid_rows'],
                'preview_payload' => $payload,
            ]);

            throw ValidationException::withMessages([
                'file' => ['File import masih memiliki error. Perbaiki file CSV lalu preview ulang.'],
            ]);
        }

        $createdRows = 0;
        $updatedRows = 0;

        DB::transaction(function () use ($payload, &$createdRows, &$updatedRows) {
            foreach ($payload['valid_items'] as $item) {
                $data = $item['normalized'];

                $model = !blank($data['kode_klinik'])
                    ? Klinik::query()->firstOrNew(['kode_klinik' => $data['kode_klinik']])
                    : Klinik::query()->firstOrNew([
                        'nama' => $data['nama'],
                        'alamat' => $data['alamat'],
                    ]);

                $exists = $model->exists;
                $model->fill($data);
                $model->save();

                if ($exists) {
                    $updatedRows++;
                } else {
                    $createdRows++;
                }
            }
        });

        $summary = [
            'headers' => $payload['headers'],
            'missing_headers' => [],
            'total_rows' => $payload['total_rows'],
            'valid_rows' => $payload['valid_rows'],
            'invalid_rows' => 0,
            'created_rows' => $createdRows,
            'updated_rows' => $updatedRows,
            'sample_valid_rows' => $payload['sample_valid_rows'],
            'invalid_items' => [],
        ];

        $import->update([
            'status' => 'imported',
            'total_rows' => $payload['total_rows'],
            'valid_rows' => $payload['valid_rows'],
            'invalid_rows' => 0,
            'imported_rows' => $createdRows + $updatedRows,
            'created_rows' => $createdRows,
            'updated_rows' => $updatedRows,
            'preview_payload' => $summary,
            'imported_at' => now(),
        ]);

        return $summary;
    }

    public function parseStoredCsv(string $storedPath): array
    {
        $absolutePath = Storage::disk('local')->path($storedPath);
        $file = new SplFileObject($absolutePath);
        $file->setFlags(SplFileObject::READ_CSV | SplFileObject::SKIP_EMPTY | SplFileObject::DROP_NEW_LINE);

        $headers = null;
        $rows = [];

        foreach ($file as $index => $row) {
            if (!is_array($row)) {
                continue;
            }

            if ($headers === null) {
                $headers = $this->normalizeHeaders($row);
                continue;
            }

            if ($this->isEmptyRow($row)) {
                continue;
            }

            $rows[] = [
                'row_number' => $index + 1,
                'values' => $this->combineRow($headers, $row),
            ];
        }

        if ($headers === null) {
            throw ValidationException::withMessages([
                'file' => ['File CSV kosong atau tidak memiliki header.'],
            ]);
        }

        $missingHeaders = array_values(array_diff(self::REQUIRED_HEADERS, array_filter($headers)));
        $validItems = [];
        $invalidItems = [];

        foreach ($rows as $row) {
            $normalized = $this->normalizeRow($row['values']);
            $validator = Validator::make($normalized, $this->rowRules(), $this->rowMessages());

            if ($validator->fails()) {
                $invalidItems[] = [
                    'row_number' => $row['row_number'],
                    'values' => $row['values'],
                    'errors' => $validator->errors()->all(),
                ];

                continue;
            }

            $validItems[] = [
                'row_number' => $row['row_number'],
                'normalized' => $validator->validated(),
            ];
        }

        if ($missingHeaders !== []) {
            $invalidItems[] = [
                'row_number' => 1,
                'values' => [],
                'errors' => ['Header wajib tidak lengkap: '.implode(', ', $missingHeaders)],
            ];
        }

        return [
            'headers' => $headers,
            'missing_headers' => $missingHeaders,
            'total_rows' => count($rows),
            'valid_rows' => $missingHeaders === [] ? count($validItems) : 0,
            'invalid_rows' => count($invalidItems),
            'sample_valid_rows' => array_slice(array_map(fn ($item) => $item['normalized'], $validItems), 0, 5),
            'valid_items' => $missingHeaders === [] ? $validItems : [],
            'invalid_items' => $invalidItems,
        ];
    }

    private function normalizeHeaders(array $headers): array
    {
        return array_map(function ($header) {
            $normalized = trim((string) $header);
            $normalized = preg_replace('/^\xEF\xBB\xBF/', '', $normalized);
            $normalized = mb_strtolower($normalized);
            $normalized = str_replace([' ', '-'], '_', $normalized);

            return self::HEADER_ALIASES[$normalized] ?? $normalized;
        }, $headers);
    }

    private function combineRow(array $headers, array $row): array
    {
        $combined = [];

        foreach ($headers as $index => $header) {
            if ($header === null || $header === '') {
                continue;
            }

            $combined[$header] = isset($row[$index]) ? trim((string) $row[$index]) : null;
        }

        return $combined;
    }

    private function normalizeRow(array $row): array
    {
        return [
            'kode_klinik' => $this->nullIfBlank($row['kode_klinik'] ?? null),
            'nama' => trim((string) ($row['nama'] ?? '')),
            'tipe' => trim((string) ($row['tipe'] ?? '')),
            'alamat' => trim((string) ($row['alamat'] ?? '')),
            'kota' => trim((string) ($row['kota'] ?? '')),
            'provinsi' => trim((string) ($row['provinsi'] ?? '')),
            'telepon' => $this->nullIfBlank($row['telepon'] ?? null),
            'latitude' => $this->nullIfBlank($row['latitude'] ?? null),
            'longitude' => $this->nullIfBlank($row['longitude'] ?? null),
            'jam_buka' => $this->nullIfBlank($row['jam_buka'] ?? null),
            'jam_tutup' => $this->nullIfBlank($row['jam_tutup'] ?? null),
            'hari_buka' => $this->nullIfBlank($row['hari_buka'] ?? null),
            'hari_tutup' => $this->nullIfBlank($row['hari_tutup'] ?? null),
            'layanan' => $this->parseServices((string) ($row['layanan'] ?? '')),
            'status' => trim((string) ($row['status'] ?? 'aktif')),
        ];
    }

    private function rowRules(): array
    {
        return [
            'kode_klinik' => ['nullable', 'string', 'max:100'],
            'nama' => ['required', 'string', 'max:255'],
            'tipe' => ['required', 'string', 'max:100'],
            'alamat' => ['required', 'string', 'max:1000'],
            'kota' => ['required', 'string', 'max:100'],
            'provinsi' => ['required', 'string', 'max:100'],
            'telepon' => ['nullable', 'string', 'max:50'],
            'latitude' => ['required', 'numeric', 'between:-90,90'],
            'longitude' => ['required', 'numeric', 'between:-180,180'],
            'jam_buka' => ['nullable', 'date_format:H:i'],
            'jam_tutup' => ['nullable', 'date_format:H:i'],
            'hari_buka' => ['nullable', 'string', 'max:100'],
            'hari_tutup' => ['nullable', 'string', 'max:100'],
            'layanan' => ['nullable', 'array'],
            'status' => ['required', 'in:aktif,nonaktif'],
        ];
    }

    private function rowMessages(): array
    {
        return [
            'latitude.required' => 'Latitude wajib diisi.',
            'longitude.required' => 'Longitude wajib diisi.',
            'jam_buka.date_format' => 'Format jam_buka harus HH:MM.',
            'jam_tutup.date_format' => 'Format jam_tutup harus HH:MM.',
            'status.in' => 'Status hanya boleh aktif atau nonaktif.',
        ];
    }

    private function parseServices(string $value): array
    {
        if (trim($value) === '') {
            return [];
        }

        $parts = preg_split('/[|,;]/', $value) ?: [];

        return array_values(array_filter(array_map(fn ($item) => trim((string) $item), $parts)));
    }

    private function nullIfBlank(mixed $value): mixed
    {
        return blank($value) ? null : $value;
    }

    private function isEmptyRow(array $row): bool
    {
        foreach ($row as $value) {
            if (!blank($value)) {
                return false;
            }
        }

        return true;
    }
}
