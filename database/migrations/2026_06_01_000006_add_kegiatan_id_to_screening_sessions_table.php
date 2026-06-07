<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Menambahkan relasi opsional dari screening_sessions ke kegiatan_sosial.
     *
     * Nullable karena screening bisa dilakukan mandiri (tanpa event).
     * Sesuai dokumen flow: "Sesi terikat event" vs "Sesi mandiri".
     */
    public function up(): void
    {
        Schema::table('screening_sessions', function (Blueprint $table) {
            // Tambahkan setelah kolom kader_id (sesuaikan nama kolom existing)
            $table->foreignId('kegiatan_id')
                  ->nullable()
                  ->after('id')
                  ->constrained('kegiatan_sosial')
                  ->onDelete('set null');

            $table->index('kegiatan_id');
        });
    }

    public function down(): void
    {
        Schema::table('screening_sessions', function (Blueprint $table) {
            $table->dropForeign(['kegiatan_id']);
            $table->dropColumn('kegiatan_id');
        });
    }
};
