<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kader;
use App\Models\Klinik;
use Faker\Factory as Faker;

class KaderSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');
        $klinikIds = Klinik::pluck('id');

        for ($i = 0; $i < 10; $i++) {
            Kader::create([
                'nama' => $faker->name,
                'klinik_id' => $faker->randomElement($klinikIds),
                'hp' => $faker->phoneNumber,
                'tgl_bergabung' => $faker->date(),
                'status' => $faker->randomElement(['verifikasi', 'aktif'])
            ]);
        }
    }
}