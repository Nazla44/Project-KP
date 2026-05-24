<?php

namespace Database\Seeders;

use App\Models\Kader;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class KaderSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        for ($i = 0; $i < 10; $i++) {
            Kader::query()->updateOrCreate([
                'nik' => $faker->unique()->numerify('################'),
            ], [
                'nama' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'hp' => $faker->phoneNumber,
                'tanggal_lahir' => $faker->date('Y-m-d', '-20 years'),
                'jenis_kelamin' => $faker->randomElement(['L', 'P']),
                'alamat' => $faker->address,
                'provinsi' => 'DKI Jakarta',
                'kab_kota' => 'Jakarta Selatan',
                'kecamatan' => 'Kebayoran Baru',
                'pekerjaan' => $faker->jobTitle,
                'pendidikan' => $faker->randomElement(['SMA', 'D3', 'S1']),
                'motivasi' => $faker->sentence(12),
                'pengalaman_tb' => $faker->randomElement(['penyintas', 'keluarga', 'relawan', 'belum']),
                'ketersediaan' => $faker->randomElement(['penuh', 'paruh', 'akhir_pekan']),
                'tgl_bergabung' => now()->toDateString(),
                'status' => $faker->randomElement([Kader::STATUS_VERIFIKASI, Kader::STATUS_AKTIF]),
            ]);
        }
    }
}
