<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Materi edukasi TBC yang ditampilkan di detail kegiatan (publik)
        Schema::create('materi_kegiatan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kegiatan_id')
                  ->constrained('kegiatan_sosial')
                  ->onDelete('cascade');

            $table->string('judul');   // "Apa itu TBC", "Gejala TBC", dst.
            $table->text('konten');    // HTML atau plain text
            $table->string('icon')->nullable(); // nama icon opsional
            $table->unsignedTinyInteger('urutan')->default(0);
            $table->timestamps();

            $table->index(['kegiatan_id', 'urutan']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('materi_kegiatan');
    }
};
