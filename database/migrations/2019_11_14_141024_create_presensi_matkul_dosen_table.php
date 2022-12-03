<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePresensiMatkulDosenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presensi_matkul_dosen', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('nip');
            $table->bigInteger('id_matkul');
            $table->string('generate');
            $table->string('keterangan');
            $table->string('materi')->nullable();
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
        Schema::dropIfExists('presensi_matkul_dosen');
    }
}
