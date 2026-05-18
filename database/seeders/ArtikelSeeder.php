<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Artikel;
use Faker\Factory as Faker;

class ArtikelSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');

        for ($i = 0; $i < 5; $i++) {
            Artikel::create([
                'judul' => $faker->sentence,
                'kategori' => $faker->randomElement(['Kesehatan', 'Edukasi', 'Kegiatan']),
                'penulis' => $faker->name,
                'tanggal' => $faker->date(),
                'status' => $faker->randomElement(['draft', 'tayang']),
                'isi' => $faker->paragraphs(3, true)
            ]);
        }
    }
}