<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class absesnsi extends Model
{
    //
    protected $table = 'presensi_mahasiswa';

    protected $primaryKey = 'id_presensi_mhs';
   protected $date = 'created_at';
}
