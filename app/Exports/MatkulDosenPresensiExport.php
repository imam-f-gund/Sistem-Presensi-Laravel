<?php

namespace App\Exports;

use App\presensi_pegawai;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Session;
use Illuminate\Support\Facades\DB;


class MatkulDosenPresensiExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {

      $years = Session::get('matkul_years');
      $tdate = Session::get('awal');
      $fdate = Session::get('akhir');
      $id = Session::get('id_dosen');
      $id1 = Session::get('id_matkul');
      if ($years == null) {
        if ($fdate != null && $tdate != null) {
           $Dosen = DB::table('Dosen')
        ->where('id_dosen', '=', $id)
        ->get();
         $Matkul = DB::table('presensi_matkul_dosen')
         ->join('Dosen', 'Dosen.id_dosen', '=', 'presensi_matkul_dosen.id_dosen')
         ->join('mata_kuliah', 'mata_kuliah.id_matkul', '=', 'presensi_matkul_dosen.id_matkul')
         ->where('presensi_matkul_dosen.id_matkul','=',$id1)
         ->where('presensi_matkul_dosen.jam_masuk','<=',$fdate)
         ->where('presensi_matkul_dosen.jam_pulang','>=',$tdate)
         ->orderBy('id_presensi_matkul', 'desc')
         ->get(['Dosen.nip','Dosen.name','mata_kuliah.nama_matkul','mata_kuliah.kode_matkul','presensi_matkul_dosen.materi','presensi_matkul_dosen.keterangan','presensi_matkul_dosen.jam_masuk','presensi_matkul_dosen.jam_pulang','presensi_matkul_dosen.total']);
         return $Matkul;
       }else{
        $Dosen = DB::table('Dosen')
        ->where('id_dosen', '=', $id)
        ->get();
        $Matkul = DB::table('presensi_matkul_dosen')
       ->join('Dosen', 'Dosen.id_dosen', '=', 'presensi_matkul_dosen.id_dosen')
       ->join('mata_kuliah', 'mata_kuliah.id_matkul', '=', 'presensi_matkul_dosen.id_matkul')
       ->where('presensi_matkul_dosen.id_matkul','=',$id1)
       ->orderBy('id_presensi_matkul', 'desc')
       ->get(['Dosen.nip','Dosen.name','mata_kuliah.nama_matkul','mata_kuliah.kode_matkul','presensi_matkul_dosen.materi','presensi_matkul_dosen.keterangan','presensi_matkul_dosen.jam_masuk','presensi_matkul_dosen.jam_pulang','presensi_matkul_dosen.total']);
       
 //  dd($Matkul);
       return $Matkul;
     }

     }else if($tdate != null && $fdate != null){
       $Dosen = DB::table('Dosen')
       ->where('id_dosen', '=', $id)
       ->get();


       $Matkul = DB::table('presensi_matkul_dosen')
       ->join('Dosen', 'Dosen.id_dosen', '=', 'presensi_matkul_dosen.id_dosen')
       ->join('mata_kuliah', 'mata_kuliah.id_matkul', '=', 'presensi_matkul_dosen.id_matkul')
       ->where('presensi_matkul_dosen.id_matkul','=',$id1)
       ->where('presensi_matkul_dosen.jam_masuk','<=',$fdate)
       ->where('presensi_matkul_dosen.jam_pulang','>=',$tdate)
       ->orderBy('id_presensi_matkul', 'desc')
       ->get(['Dosen.nip','Dosen.name','mata_kuliah.nama_matkul','mata_kuliah.kode_matkul','presensi_matkul_dosen.materi','presensi_matkul_dosen.keterangan','presensi_matkul_dosen.jam_masuk','presensi_matkul_dosen.jam_pulang','presensi_matkul_dosen.total']);
       return $Matkul;
     }else{
       $id = Session::get('id_dosen');
       $id1 = Session::get('id_matkul');

       $Dosen = DB::table('Dosen')

       ->where('id_dosen', '=', $id)
       ->get();


       $Matkul = DB::table('presensi_matkul_dosen')
       ->join('Dosen', 'Dosen.id_dosen', '=', 'presensi_matkul_dosen.id_dosen')
       ->join('mata_kuliah', 'mata_kuliah.id_matkul', '=', 'presensi_matkul_dosen.id_matkul')
       ->where('presensi_matkul_dosen.id_matkul','=',$id1)
       ->whereYear('presensi_matkul_dosen.created_at', '=', $years )
       ->orderBy('id_presensi_matkul', 'desc')
       ->get(['Dosen.nip','Dosen.name','mata_kuliah.nama_matkul','mata_kuliah.kode_matkul','presensi_matkul_dosen.materi','presensi_matkul_dosen.keterangan','presensi_matkul_dosen.jam_masuk','presensi_matkul_dosen.jam_pulang']);

       return $Matkul;


     }


   }
   public function headings(): array
   {
    $total = Session::get('total_sks');
    $status = Session::get('message');
    return 
    [
      array('TOTAL SKS',
        'STATUS',),
      array($total,
       $status,),
      array('',),
      array('NIP',
        'NAME',
        'NAMA MATA KULIAH',
        'KODE MATA KULIAH',
        'MATERI',
        'KETERANGAN',
        'MASUK',
        'PULANG',
        'TOTAL JAM',),

    ];
  }
}
