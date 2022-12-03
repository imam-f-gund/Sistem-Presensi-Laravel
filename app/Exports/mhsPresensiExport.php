<?php

namespace App\Exports;

use App\absesnsi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Session;
use Illuminate\Support\Facades\DB;

class mhsPresensiExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
    	$id = Session::get('id_matkul');
    	$i = Session::get('uniq');
    	
      $datae = DB::table('presensi_mahasiswa')
      ->join('mahasiswa', 'presensi_mahasiswa.nim', '=', 'mahasiswa.nim')
      ->join('mata_kuliah', 'mata_kuliah.id_matkul', '=', 'presensi_mahasiswa.id_matkul')
      ->join('Dosen', 'Dosen.id_dosen', '=', 'mata_kuliah.id_dosen')
      ->where('presensi_mahasiswa.id_matkul', '=', $id)
      ->where('presensi_mahasiswa.uniq', '=', $i)
      ->where('presensi_mahasiswa.aprove', '=', 'success')
      ->orderBy('id_presensi_mhs', 'desc')
      ->get(['presensi_mahasiswa.nim', 'mahasiswa.name','presensi_mahasiswa.days','presensi_mahasiswa.materi','mata_kuliah.nama_matkul','presensi_mahasiswa.created_at']);

//dd($datae);
       // return  [$dataM, $data];
      
      return $datae;
  }

  public function headings(): array
  {
    return 
    [
        'NIM',
        'NAME',
        'DAYS',
        'MATERI MATKUL',
        'NAMA MATA KULIAH',
       
        'DATE',
        
        
    ];
}
}
