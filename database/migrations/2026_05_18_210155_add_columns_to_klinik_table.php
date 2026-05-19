<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('klinik', function (Blueprint $table) {
            if (!Schema::hasColumn('klinik', 'tipe')) {
                $table->string('tipe')->nullable();
            }

            if (!Schema::hasColumn('klinik', 'kota')) {
                $table->string('kota')->nullable();
            }

            if (!Schema::hasColumn('klinik', 'provinsi')) {
                $table->string('provinsi')->nullable();
            }

            if (!Schema::hasColumn('klinik', 'alamat')) {
                $table->text('alamat')->nullable();
            }

            if (!Schema::hasColumn('klinik', 'telepon')) {
                $table->string('telepon')->nullable();
            }

            if (!Schema::hasColumn('klinik', 'lat')) {
                $table->decimal('lat', 10, 7)->nullable();
            }

            if (!Schema::hasColumn('klinik', 'lng')) {
                $table->decimal('lng', 10, 7)->nullable();
            }

            if (!Schema::hasColumn('klinik', 'jam_buka')) {
                $table->string('jam_buka')->nullable();
            }

            if (!Schema::hasColumn('klinik', 'jam_tutup')) {
                $table->string('jam_tutup')->nullable();
            }

            if (!Schema::hasColumn('klinik', 'hari_buka')) {
                $table->string('hari_buka')->nullable();
            }

            if (!Schema::hasColumn('klinik', 'layanan')) {
                $table->text('layanan')->nullable();
            }

            if (!Schema::hasColumn('klinik', 'status')) {
                $table->string('status')->default('aktif');
            }
        });
    }

    public function down(): void
    {
        Schema::table('klinik', function (Blueprint $table) {
            $table->dropColumn([
                'tipe',
                'kota',
                'provinsi',
                'alamat',
                'telepon',
                'lat',
                'lng',
                'jam_buka',
                'jam_tutup',
                'hari_buka',
                'layanan',
                'status',
            ]);
        });
    }
};