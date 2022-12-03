<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePresensiKaryawanUmgTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presensi_karyawan_umg', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('nip');
             $table->string('device')->nullable();
            $table->string('generate');
             $table->string('days')->nullable();
            $table->string('validasi')->nullable();
            $table->string('history')->nullable();
            $table->string('time')->nullable();
            $table->time('jumlah_masuk')->nullable();
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
        Schema::dropIfExists('presensi_karyawan_umg');
    }
}
