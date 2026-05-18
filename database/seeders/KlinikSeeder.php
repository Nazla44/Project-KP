<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Klinik;

class KlinikSeeder extends Seeder
{
    public function run()
    {
        Klinik::create([
            'nama' => 'Klinik Sehat Bersama',
            'alamat' => 'Jl. Merdeka No.10, Jakarta',
            'provinsi' => 'DKI Jakarta',
            'telepon' => '081234567890',
            'status' => 'aktif'
        ]);
    }
}