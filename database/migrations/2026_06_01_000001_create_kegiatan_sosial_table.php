<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kegiatan_sosial', function (Blueprint $table) {
            $table->id();
            $table->foreignId('created_by')->constrained('users')->onDelete('restrict');

            // Informasi utama
            $table->string('judul');
            $table->string('slug')->unique();
            $table->date('tanggal');
            $table->time('jam_mulai')->nullable();
            $table->time('jam_selesai')->nullable();
            $table->string('lokasi');
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->text('deskripsi');

            // Media
            $table->string('banner')->nullable(); // path ke storage

            // Status: draft | published | ongoing | completed | cancelled
            $table->enum('status', ['draft', 'published', 'ongoing', 'completed', 'cancelled'])
                  ->default('draft');

            $table->timestamp('published_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Index untuk query publik (tampilkan event yang published, urutkan tanggal)
            $table->index(['status', 'tanggal']);
            $table->index('slug');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kegiatan_sosial');
    }
};
