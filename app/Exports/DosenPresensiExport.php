<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\presensi_dosen;
use Maatwebsite\Excel\Concerns\FromCollection;
use Session;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Dosen;
class DosenPresensiExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
    	$id = Session::get('id_dosen');
      $a = Session::get('a');
        $b = Session::get('b');

      if ($id == null) {

        $id = Session::get('id_dos');

        // 
        $date = \Carbon\Carbon::now()->subWeek();
    //    dd($a.$b);
        $years = Session::get('years');
        $month = Session::get('month');
        if ($a == null and $b == null) {
          if ($years != null  and $month == null) {
           /* $Dosen = DB::table('presensi_dosen')
            ->join('Dosen', 'presensi_dosen.id_dosen', '=', 'Dosen.id_dosen')
            ->where('presensi_dosen.id_dosen', '=', $id)
            ->where('presensi_dosen.validasi', '=', 'success')
            ->whereYear('created_at', '=', $years)
            ->orderBy('id_presensi_dosen', 'desc')
            ->get(['Dosen.nip','Dosen.nidn','name','created_at','days','history','jumlah_masuk','keterangan']);
            */
            $Dosen = DB::table('pdanpdbn')
            ->where('dosen', '=', $id)
            ->whereYear('tanggal', '=', $years)
           // ->whereMonth('tanggal', '=', $month)
            ->get(['nip','name','tanggal','hari','ketmasuk','jammasuk','ketkeluar','jamkeluar','totjam','keterangan']);
            
            return $Dosen;
          }else if ($month != null and $years != null) {
            /*$Dosen = DB::table('presensi_dosen')
            ->join('Dosen', 'presensi_dosen.id_dosen', '=', 'Dosen.id_dosen')
            ->where('presensi_dosen.id_dosen', '=', $id)
            ->where('presensi_dosen.validasi', '=', 'success')
            ->whereYear('created_at', '=', $years)
            ->whereMonth('created_at', '=', $month)
            ->orderBy('id_presensi_dosen', 'desc')
            ->get(['Dosen.nip','Dosen.nidn','name','created_at','days','history','jumlah_masuk','keterangan']);
           */ $Dosen = DB::table('pdanpdbn')
            ->where('dosen', '=', $id)
            ->whereYear('tanggal', '=', $years)
            ->whereMonth('tanggal', '=', $month)
            ->get(['nip','name','tanggal','hari','ketmasuk','jammasuk','ketkeluar','jamkeluar','totjam','keterangan']);
            
            return $Dosen;
          }else{
            /*$Dosen = DB::table('presensi_dosen')
            ->join('Dosen', 'presensi_dosen.id_dosen', '=', 'Dosen.id_dosen')
            ->where('presensi_dosen.id_dosen', '=', $id)
            ->where('presensi_dosen.validasi', '=', 'success')
            ->orderBy('id_presensi_dosen', 'desc')
            ->get(['Dosen.nip','Dosen.nidn','name','created_at','days','history','jumlah_masuk','keterangan']);*/
            $Dosen = DB::table('pdanpdbn')
            ->where('dosen', '=', $id)
            ->get(['nip','name','tanggal','hari','ketmasuk','jammasuk','ketkeluar','jamkeluar','totjam','keterangan']);
            
            return $Dosen;        
          }
        } else {
          /*$Dosen = DB::table('presensi_dosen')
          ->join('Dosen', 'presensi_dosen.id_dosen', '=', 'Dosen.id_dosen')
          ->where('presensi_dosen.id_dosen', '=', $id)
          ->where('presensi_dosen.validasi', '=', 'success')
          ->where('presensi_dosen.created_at','<=',$b)
          ->where('presensi_dosen.created_at','>=',$a)
          ->orderBy('id_presensi_dosen', 'desc')
          ->get(['Dosen.nip','Dosen.nidn','name','created_at','days','history','jumlah_masuk','keterangan']);
          */
          $Dosen = DB::table('pdanpdbn')
          ->where('dosen', '=', $id)
          ->whereYear('tanggal', '<=', $b)
          ->whereMonth('tanggal', '>=', $a)
          ->get(['nip','name','tanggal','hari','ketmasuk','jammasuk','ketkeluar','jamkeluar','totjam','keterangan']);

          return $Dosen;
        }

      }else{
        $years = Session::get('years');
        $month = Session::get('month');
           // dd($years.$month);
        if ($a == null and $b == null) {
          if ($years != null  and $month == null) {
            /*$Dosen = DB::table('presensi_dosen')
            ->join('Dosen', 'presensi_dosen.id_dosen', '=', 'Dosen.id_dosen')
            ->where('presensi_dosen.id_dosen', '=', $id)
            ->where('presensi_dosen.validasi', '=', 'success')
            ->whereYear('created_at', '=', $years)
            ->orderBy('id_presensi_dosen', 'desc')
            ->get(['Dosen.nip','Dosen.nidn','name','created_at','days','history','jumlah_masuk','keterangan']);
            */
            $Dosen = DB::table('pdanpdbn')
            ->where('dosen', '=', $id)
            ->whereYear('tanggal', '=', $years)
            //->whereMonth('tanggal', '>=', $month)
            ->get(['nip','name','tanggal','hari','ketmasuk','jammasuk','ketkeluar','jamkeluar','totjam','keterangan']);
            
            return $Dosen;
          }else if ($month != null and $years != null) {
            /*$Dosen = DB::table('presensi_dosen')
            ->join('Dosen', 'presensi_dosen.id_dosen', '=', 'Dosen.id_dosen')
            ->where('presensi_dosen.id_dosen', '=', $id)
            ->where('presensi_dosen.validasi', '=', 'success')
            ->whereYear('created_at', '=', $years)
            ->whereMonth('created_at', '=', $month)
            ->orderBy('id_presensi_dosen', 'desc')
            ->get(['Dosen.nip','Dosen.nidn','name','created_at','days','history','jumlah_masuk','keterangan']);
            */
            $Dosen = DB::table('pdanpdbn')
            ->where('dosen', '=', $id)
            ->whereYear('tanggal', '=', $years)
            ->whereMonth('tanggal', '=', $month)
            ->get(['nip','name','tanggal','hari','ketmasuk','jammasuk','ketkeluar','jamkeluar','totjam','keterangan']);
            
            return $Dosen;
          }else{
            /*$Dosen = DB::table('presensi_dosen')
            ->join('Dosen', 'presensi_dosen.id_dosen', '=', 'Dosen.id_dosen')
            ->where('presensi_dosen.id_dosen', '=', $id)
            ->where('presensi_dosen.validasi', '=', 'success')
            ->orderBy('id_presensi_dosen', 'desc')
            ->get(['Dosen.nip','Dosen.nidn','name','created_at','days','history','jumlah_masuk','keterangan']);
            */
            $Dosen = DB::table('pdanpdbn')
            ->where('dosen', '=', $id)
            ->get(['nip','name','tanggal','hari','ketmasuk','jammasuk','ketkeluar','jamkeluar','totjam','keterangan']);
            
            return $Dosen;        
          }
        } else {
          /*$Dosen = DB::table('presensi_dosen')
          ->join('Dosen', 'presensi_dosen.id_dosen', '=', 'Dosen.id_dosen')
          ->where('presensi_dosen.id_dosen', '=', $id)
          ->where('presensi_dosen.validasi', '=', 'success')
          ->where('presensi_dosen.created_at','<=',$b)
          ->where('presensi_dosen.created_at','>=',$a)
          ->orderBy('id_presensi_dosen', 'desc')
          ->get(['Dosen.nip','Dosen.nidn','name','created_at','days','history','jumlah_masuk','keterangan']);
        */ 
          $Dosen = DB::table('pdanpdbn')
          ->where('dosen', '=', $id)
          ->where('tanggal', '<=', $a)
          ->where('tanggal', '>=', $b)
          ->get(['nip','name','tanggal','hari','ketmasuk','jammasuk','ketkeluar','jamkeluar','totjam','keterangan']);

          return $Dosen;
        }

      }
    }
    public function headings(): array
    {
      $total = Session::get('Total_jam');
        $total_hari = Session::get('total_hari');
        $total_kerja = Session::get('hari_aktif');
        $status = Session::get('message');
   // dd($total.'='.$total_hari.'='.$total_kerja.'='.$status);
      if ($total == null) {
       return 
       [
         /*'NIP',
         'NIDN',
         'NAME',
         'DATE',
         'HARI',
         'PULANG/MASUK',
         'JUMLAH MASUK',
         'KETERANGAN',
         '',*/
    // 'TOTAL JAM MASUK = '.$total,
     //'TOTAL HARI MASUK = '.$hari,
         'NIP',
         'NAMA',
         'DATE',
         'HARI',
         'history',
         'JAM MASUK',
         'history',
         'JAM KELUAR',
         'TOTAL JAM PERHARI',
         'KETERANGAN',
       ];
     }else {
      return 
      [
        array('TOTAL JAM MASUK',
                        'TOTAL HARI MASUK',
                        'TOTAL HARI AKTIF',
                        'STATUS',),
                          array($total,
                        $total_hari,
                        $total_kerja,
                      $status,),

                           array('',),
            array('NIP',
                        'NAMA',
                        'DATE',
                        'HARI',
                        'history',
                        'JAM MASUK',
                        'history',
                        'JAM KELUAR',
                        'TOTAL JAM PERHARI',
                      'KETERANGAN',),
     ];
   }
 }
}



