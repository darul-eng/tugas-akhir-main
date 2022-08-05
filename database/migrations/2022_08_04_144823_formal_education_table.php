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
        Schema::create('formal_education', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('id_sdm');
            $table->uuid('id_pendidikan')->unique();
            $table->string('jenjang_pendidikan');
            $table->string('gelar_akademik');
            $table->string('bidang_studi');
            $table->string('nama_perguruan_tinggi');
            $table->integer('tahun_lulus');
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
        Schema::dropIfExists('formal_education');
    }
};
