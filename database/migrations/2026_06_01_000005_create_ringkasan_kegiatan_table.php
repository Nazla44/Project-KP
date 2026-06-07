<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Ringkasan/rekap hasil kegiatan (Report A versi publik)
        // Dibuat setelah kegiatan selesai — 1 kegiatan : 1 ringkasan
        Schema::create('ringkasan_kegiatan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kegiatan_id')
                  ->unique()                       // 1:1 dengan kegiatan_sosial
                  ->constrained('kegiatan_sosial')
                  ->onDelete('cascade');

            // Statistik yang ditampilkan publik
            $table->unsignedInteger('jumlah_peserta')->default(0);
            $table->unsignedInteger('jumlah_kader')->default(0);
            $table->unsignedInteger('jumlah_materi')->default(0);

            // Catatan internal (tidak ditampilkan publik)
            $table->text('catatan_internal')->nullable();

            // Diisi oleh admin setelah event selesai
            $table->foreignId('diisi_oleh')->nullable()
                  ->constrained('users')
                  ->onDelete('set null');

            $table->timestamps();

            // -------------------------------------------------------
            // PERSIAPAN INTEGRASI SCREENING (fase berikutnya)
            // Kolom-kolom ini NULL dulu, akan diisi oleh modul screening
            // -------------------------------------------------------
            // jumlah_diperiksa, risiko_rendah, risiko_sedang, risiko_tinggi
            // akan di-ALTER atau ditambah via migration baru saat modul
            // screening diimplementasikan.
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ringkasan_kegiatan');
    }
};
