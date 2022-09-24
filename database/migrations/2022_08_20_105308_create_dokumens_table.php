<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dokumens', function (Blueprint $table) {
            $table->id();
            $table->uuid('id_dokumen')->unique();
            $table->foreignUuid('id_sdm');
            $table->integer('id_jenis_dokumen')->nullable();
            $table->string('jenis_dokumen')->nullable();
            $table->string('nama')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('tautan')->nullable();
            $table->date('tanggal_upload')->nullable();
            $table->string('nama_file')->nullable();
            $table->string('jenis_file')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dokumens');
    }
};
