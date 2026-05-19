<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            KlinikSeeder::class,
            ArtikelSeeder::class,
            LaporanSeeder::class,
        ]);

        User::query()->updateOrCreate([
            'email' => env('SUPER_ADMIN_EMAIL', 'superadmin@stpi.test'),
        ], [
            'name' => env('SUPER_ADMIN_NAME', 'Super Admin'),
            'phone_number' => env('SUPER_ADMIN_PHONE', '081234567890'),
            'password' => env('SUPER_ADMIN_PASSWORD', 'password'),
            'role' => User::ROLE_SUPER_ADMIN,
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        User::query()->updateOrCreate([
            'email' => env('KADER_EMAIL', 'kader@stpi.test'),
        ], [
            'name' => env('KADER_NAME', 'Kader Demo'),
            'phone_number' => env('KADER_PHONE', '081234567891'),
            'password' => env('KADER_PASSWORD', 'password'),
            'role' => User::ROLE_KADER,
            'is_active' => true,
            'email_verified_at' => now(),
        ]);
    }
}
