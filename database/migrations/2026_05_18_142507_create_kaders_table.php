<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('kaders', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->foreignId('klinik_id')
                ->constrained('klinik')
                ->onDelete('cascade');
            $table->string('hp');
            $table->date('tgl_bergabung');
            $table->enum('status', ['aktif', 'verifikasi'])->default('verifikasi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kaders');
    }
};
