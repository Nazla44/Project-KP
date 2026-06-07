<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Pivot: kader mana saja yang terlibat di sebuah kegiatan
        Schema::create('kegiatan_kader', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kegiatan_id')
                  ->constrained('kegiatan_sosial')
                  ->onDelete('cascade');
            $table->foreignId('kader_id')
                  ->constrained('kaders')
                  ->onDelete('cascade');

            // peran: koordinator | pelaksana | pendamping
            $table->enum('peran', ['koordinator', 'pelaksana', 'pendamping'])
                  ->default('pelaksana');

            $table->timestamps();

            // Satu kader hanya bisa punya satu peran per kegiatan
            $table->unique(['kegiatan_id', 'kader_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kegiatan_kader');
    }
};
