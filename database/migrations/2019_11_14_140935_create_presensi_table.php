<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePresensiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presensi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('nim');
            $table->string('generate');
            $table->string('validasi')->nullable();
            $table->string('aprove')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('materi')->nullable();
            $table->bigInteger('id_matkul');
            $table->bigInteger('uniq');
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
        Schema::dropIfExists('presensi');
    }
}
