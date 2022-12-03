<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class presensi_dosen extends Model
{
    //
    protected $table = 'presensi_dosen';
    protected $primaryKey = 'id_presensi_dosen';
      protected $date = 'created_at';
      
}
