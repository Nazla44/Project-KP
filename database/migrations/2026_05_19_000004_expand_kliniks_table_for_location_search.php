<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('klinik', function (Blueprint $table) {
            $table->string('tipe')->default('Klinik')->after('nama');
            $table->string('kota')->nullable()->after('provinsi');
            $table->decimal('latitude', 10, 7)->nullable()->after('telepon');
            $table->decimal('longitude', 10, 7)->nullable()->after('latitude');
            $table->string('jam_buka', 5)->nullable()->after('longitude');
            $table->string('jam_tutup', 5)->nullable()->after('jam_buka');
            $table->string('hari_buka')->nullable()->after('jam_tutup');
            $table->json('layanan')->nullable()->after('hari_buka');

            $table->index(['provinsi', 'kota']);
            $table->index('tipe');
            $table->index('status');
            $table->index(['latitude', 'longitude']);
        });
    }

    public function down(): void
    {
        Schema::table('klinik', function (Blueprint $table) {
            $table->dropIndex(['provinsi', 'kota']);
            $table->dropIndex(['tipe']);
            $table->dropIndex(['status']);
            $table->dropIndex(['latitude', 'longitude']);

            $table->dropColumn([
                'tipe',
                'kota',
                'latitude',
                'longitude',
                'jam_buka',
                'jam_tutup',
                'hari_buka',
                'layanan',
            ]);
        });
    }
};
