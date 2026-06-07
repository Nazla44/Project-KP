<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Galeri foto dokumentasi kegiatan
        Schema::create('dokumentasi_kegiatan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kegiatan_id')
                  ->constrained('kegiatan_sosial')
                  ->onDelete('cascade');

            $table->string('file_path');           // path di storage
            $table->string('caption')->nullable(); // keterangan foto
            $table->unsignedTinyInteger('urutan')->default(0);
            $table->timestamps();

            $table->index(['kegiatan_id', 'urutan']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dokumentasi_kegiatan');
    }
};
