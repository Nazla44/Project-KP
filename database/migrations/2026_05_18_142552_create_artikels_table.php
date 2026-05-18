<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtikelsTable extends Migration
{
    public function up()
    {
        Schema::create('artikel', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('kategori');
            $table->string('penulis');
            $table->date('tanggal');
            $table->enum('status', ['draft', 'tayang'])->default('draft');
            $table->text('isi');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('artikel');
    }
}