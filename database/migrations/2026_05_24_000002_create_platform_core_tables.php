<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kader_id')->constrained('kaders')->cascadeOnDelete();
            $table->string('judul');
            $table->date('tanggal_pelaksanaan');
            $table->text('lokasi_alamat');
            $table->decimal('lokasi_lat', 10, 7)->nullable();
            $table->decimal('lokasi_lng', 10, 7)->nullable();
            $table->text('deskripsi')->nullable();
            $table->enum('status', ['draft','menunggu','disetujui','ditolak','selesai','batal'])->default('draft')->index();
            $table->text('catatan_admin')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('approved_at')->nullable();
            $table->timestamp('submitted_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            $table->timestamps();
            $table->index(['tanggal_pelaksanaan', 'status']);
        });

        Schema::create('report_a', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->unique()->constrained('events')->cascadeOnDelete();
            $table->foreignId('kader_id')->constrained('kaders')->cascadeOnDelete();
            $table->unsignedInteger('jumlah_peserta');
            $table->text('topik')->nullable();
            $table->text('catatan')->nullable();
            $table->json('foto_urls')->nullable();
            $table->enum('status', ['selesai','dibatalkan'])->default('selesai');
            $table->timestamp('dibuat_pada')->nullable();
            $table->timestamps();
        });

        Schema::create('screening_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kader_id')->constrained('kaders')->cascadeOnDelete();
            $table->foreignId('event_id')->nullable()->constrained('events')->nullOnDelete();
            $table->date('tanggal_sesi');
            $table->text('lokasi_alamat');
            $table->decimal('lokasi_lat', 10, 7)->nullable();
            $table->decimal('lokasi_lng', 10, 7)->nullable();
            $table->unsignedInteger('total_diperiksa')->default(0);
            $table->unsignedInteger('total_rendah')->default(0);
            $table->unsignedInteger('total_sedang')->default(0);
            $table->unsignedInteger('total_tinggi')->default(0);
            $table->enum('status', ['aktif','selesai'])->default('aktif')->index();
            $table->timestamp('closed_at')->nullable();
            $table->timestamps();
        });

        Schema::create('wargas', function (Blueprint $table) {
            $table->string('nik', 16)->primary();
            $table->string('nama_lengkap');
            $table->text('alamat');
            $table->date('tanggal_lahir')->nullable();
            $table->enum('jenis_kelamin', ['L','P'])->nullable();
            $table->boolean('consent_verbal')->default(false);
            $table->timestamp('consent_at')->nullable();
            $table->timestamps();
        });

        Schema::create('screening_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sesi_id')->constrained('screening_sessions')->cascadeOnDelete();
            $table->string('warga_nik', 16);
            $table->json('jawaban_gejala');
            $table->unsignedSmallInteger('skor_total')->default(0);
            $table->enum('level_risiko', ['rendah','sedang','tinggi'])->index();
            $table->text('rekomendasi_tindakan')->nullable();
            $table->foreignId('klinik_id')->nullable()->constrained('klinik')->nullOnDelete();
            $table->text('catatan_kader')->nullable();
            $table->timestamp('diperiksa_pada')->nullable();
            $table->timestamps();
            $table->foreign('warga_nik')->references('nik')->on('wargas')->cascadeOnDelete();
            $table->unique(['sesi_id', 'warga_nik']);
        });

        Schema::create('scoring_rules', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('label');
            $table->string('group')->default('gejala');
            $table->unsignedSmallInteger('score')->default(0);
            $table->boolean('is_gate')->default(false);
            $table->boolean('is_active')->default(true);
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('scoring_rules');
        Schema::dropIfExists('screening_results');
        Schema::dropIfExists('wargas');
        Schema::dropIfExists('screening_sessions');
        Schema::dropIfExists('report_a');
        Schema::dropIfExists('events');
    }
};
