<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kaders', function (Blueprint $table) {
            $table->foreign('klinik_id')
                ->references('id')
                ->on('klinik')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('kaders', function (Blueprint $table) {
            $table->dropForeign(['klinik_id']);
        });
    }
};
