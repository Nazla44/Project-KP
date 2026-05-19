<?php

namespace App\Http\Requests\Admin;

use App\Models\Klinik;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateKlinikRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        /** @var Klinik|null $klinik */
        $klinik = $this->route('klinik');

        return [
            'kode_klinik' => ['nullable', 'string', 'max:100', Rule::unique('klinik', 'kode_klinik')->ignore($klinik?->id)],
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
            'layanan' => ['nullable', 'string', 'max:2000'],
            'status' => ['required', Rule::in(['aktif', 'nonaktif'])],
        ];
    }
}
