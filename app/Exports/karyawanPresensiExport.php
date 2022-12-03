<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\absesnsi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Session;
use Illuminate\Support\Facades\DB;

class karyawanPresensiExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
      $id = Session::get('id_karyawan');
      $a = Session::get('Ka');
      $b = Session::get('Kb');
      $years = Session::get('years');
      $month = Session::get('month');

//dd($id.$a.$b.$years.$month);
      if ($a == null and $b == null) {
        if ($years != null and $month == null) {
 /*         $kar = DB::table('presensi_karyawan')
          ->join('Karyawan', 'karyawan.id_karyawan', '=', 'presensi_karyawan.id_karyawan')
          ->where('presensi_karyawan.id_karyawan', '=', $id)
          ->whereYear('tanggal', '=', $years )
          ->where('presensi_karyawan.validasi', '=', 'success')
          ->orderBy('presensi_karyawan.id_presensi_karyawan', 'desc')
          ->get(['karyawan.nip','karyawan.name','presensi_karyawan.device','presensi_karyawan.days','presensi_karyawan.history','presensi_karyawan.created_at','presensi_karyawan.jumlah_masuk','presensi_karyawan.keterangan']);*/
          $kar = DB::table('pkanpkbn')
          ->where('karyawan', '=', $id)
          ->whereYear('tanggal', '=', $years)
          ->get(['nip','name','tanggal','hari','ketmasuk','jammasuk','ketkeluar','jamkeluar','totjam']);
          return $kar;
        }else if ($years != null and $month != null) {
          /*$kar = DB::table('presensi_karyawan')
          ->join('Karyawan', 'karyawan.id_karyawan', '=', 'presensi_karyawan.id_karyawan')
          ->where('presensi_karyawan.id_karyawan', '=', $id)
          ->whereMonth('tanggal', '=', $month)
          ->whereYear('tanggal', '=', $years )
          ->where('presensi_karyawan.validasi', '=', 'success')
          ->orderBy('presensi_karyawan.id_presensi_karyawan', 'desc')
          ->get(['karyawan.nip','karyawan.name','presensi_karyawan.device','presensi_karyawan.days','presensi_karyawan.history','tanggal','presensi_karyawan.jumlah_masuk','presensi_karyawan.keterangan']);*/
          $kar = DB::table('pkanpkbn')
          ->where('karyawan', '=', $id)
          ->whereMonth('tanggal', '=', $month)
          ->whereYear('tanggal', '=', $years)
          ->get(['nip','name','tanggal','hari','ketmasuk','jammasuk','ketkeluar','jamkeluar','totjam']);
          return $kar;
        }else{
          /*$kar = DB::table('presensi_karyawan')
          ->join('Karyawan', 'karyawan.id_karyawan', '=', 'presensi_karyawan.id_karyawan')
          ->where('presensi_karyawan.id_karyawan', '=', $id)
            ->where('presensi_karyawan.validasi', '=', 'success')
            ->orderBy('presensi_karyawan.id_presensi_karyawan', 'desc')
            ->get(['karyawan.nip','karyawan.name','presensi_karyawan.device','presensi_karyawan.days','presensi_karyawan.history','tanggal','presensi_karyawan.jumlah_masuk','presensi_karyawan.keterangan']);*/
            $kar = DB::table('pkanpkbn')
            ->where('karyawan', '=', $id)
                    ->get(['nip','name','tanggal','hari','ketmasuk','jammasuk','ketkeluar','jamkeluar','totjam']);
            return $kar;
          }
        }else{
          /*$kar = DB::table('presensi_karyawan')
          ->join('Karyawan', 'karyawan.id_karyawan', '=', 'presensi_karyawan.id_karyawan')
          ->where('presensi_karyawan.id_karyawan', '=', $id)
          ->where('tanggal','<=',$b)
          ->where('tanggal','>=',$a)
      ->where('presensi_karyawan.validasi', '=', 'success')
          ->orderBy('presensi_karyawan.id_presensi_karyawan', 'desc')
          ->get(['karyawan.nip','karyawan.name','presensi_karyawan.device','presensi_karyawan.days','presensi_karyawan.history','tanggal','presensi_karyawan.jumlah_masuk','presensi_karyawan.keterangan']);*/
          $kar = DB::table('pkanpkbn')
          ->where('karyawan', '=', $id)
          ->where('tanggal','<=',$b)
          ->where('tanggal','>=',$a)
          ->get(['nip','name','tanggal','hari','ketmasuk','jammasuk','ketkeluar','jamkeluar','totjam']);
          return $kar;
        }


      }

      public function headings(): array
      {
        $total = Session::get('Totalk');
        $total_hari = Session::get('total_hari_kar');
        $total_kerja = Session::get('hari_kar_aktif');
        $status = Session::get('message');

          //dd($total);
        if ($total == null) {
          return 
          [
            
            array('NIP',
                        'NAMA',
                        'DATE',
                        'HARI',
                        'HISTORY',
                        'JAM MASUK',
                        'HISTORY',
                        'JAM KELUAR',
                        'TOTAL JAM PERHARI',
                        'KETERANGAN',
                      ),
          ];
        }else{
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
                        'HISTORY',
                        'JAM MASUK',
                        'HISTORY',
                        'JAM KELUAR',
                        'TOTAL JAM PERHARI',
                      'KETERANGAN',),

           
          ];

        }
        
      }
    }
