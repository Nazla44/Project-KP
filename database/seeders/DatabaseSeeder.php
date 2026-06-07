<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::query()->updateOrCreate([
            'email' => 'admin@gmail.com',
        ], [
            'name' => 'Super Admin',
            'password' => Hash::make('password123'),
            'role' => User::ROLE_SUPER_ADMIN,
            'is_active' => true,
        ]);

        $this->call([
            KlinikSeeder::class,
            ScoringRuleSeeder::class,
            ArtikelSeeder::class,
        ]);
    }
}