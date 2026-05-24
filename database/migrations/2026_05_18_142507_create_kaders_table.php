<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kaders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('nama');
            $table->string('nik', 16)->unique();
            $table->foreignId('klinik_id')->nullable();
            $table->string('hp', 20);
            $table->string('email', 150)->unique();
            $table->string('tempat_lahir', 100)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable();
            $table->text('alamat')->nullable();
            $table->string('provinsi', 100)->nullable()->index();
            $table->string('kab_kota', 100)->nullable()->index();
            $table->string('kecamatan', 100)->nullable();
            $table->string('pekerjaan', 100)->nullable();
            $table->string('pendidikan', 10)->nullable();
            $table->text('motivasi')->nullable();
            $table->string('pengalaman_tb', 50)->nullable();
            $table->string('ketersediaan', 50)->nullable();
            $table->date('tgl_bergabung')->nullable();
            $table->enum('status', ['verifikasi', 'aktif', 'ditolak', 'suspend'])->default('verifikasi')->index();
            $table->timestamp('approved_at')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('rejected_at')->nullable();
            $table->foreignId('rejected_by')->nullable()->constrained('users')->nullOnDelete();
            $table->text('rejection_reason')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kaders');
    }
};
