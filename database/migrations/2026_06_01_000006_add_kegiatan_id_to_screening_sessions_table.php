<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('screening_sessions', 'kegiatan_id')) {
            Schema::table('screening_sessions', function (Blueprint $table) {
                $table->foreignId('kegiatan_id')
                    ->nullable()
                    ->after('id')
                    ->constrained('kegiatan_sosial')
                    ->nullOnDelete();

                $table->index('kegiatan_id');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('screening_sessions', 'kegiatan_id')) {
            Schema::table('screening_sessions', function (Blueprint $table) {
                $table->dropForeign(['kegiatan_id']);
                $table->dropIndex(['kegiatan_id']);
                $table->dropColumn('kegiatan_id');
            });
        }
    }
};