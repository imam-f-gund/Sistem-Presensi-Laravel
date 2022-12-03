<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\parkir;
use DateTime;
use App\mhs;
use App\absesnsi;
use App\pegawai;    //karyawan_umg
use App\presensi_pegawai;   //presensi matkul dosen
use App\presen_karyawan;
use App\presensi_dosen;
use App\Dosen;  
use App\jabatan;  
use App\matkul; 
use App\periode;
use App\periode_matkul; 
use Excel;
use Session;
use Charts;
use App\Exports\mhsPresensiExport;
use App\Exports\karyawanPresensiExport;
use App\Exports\dosenPresensiExport;
use App\Exports\MatkulDosenPresensiExport;
use App\karyawan;  
use Carbon\Carbon;
use Validator;

use \Milon\Barcode\DNS2D;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
     // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {


    }

    public function chartKar(){
      $k = Session::get('id_karyawan');
      $karY = presen_karyawan::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))
      ->where('id_karyawan', '=', $k)
      ->where('validasi', '=', 'success')
      ->get();
      $karyawan = Charts::database($karY, 'bar', 'highcharts')
      ->title("Index Presensi karyawan")
      ->elementLabel("Total presensi")
      ->dimensions(1000, 500)
      ->responsive(false)
      ->groupByMonth(date('Y'), true);

      return view('home',compact('karyawan'));
    }
    public function bsdm()  //Chart
    {

      $users = presensi_pegawai::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))
      ->get();
      $chart = Charts::database($users, 'bar', 'highcharts')
      ->title("Presensi Mata kuliah Dosen Perbulan")
      ->elementLabel("Total presensi matkul dosen")
      ->dimensions(1000, 500)
      ->responsive(false)
      ->groupByMonth(date('Y'), true);


      $users3 = absesnsi::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))
      ->where('aprove','success')
      ->get();

      $pie = Charts::database($users3, 'bar', 'highcharts')
      ->title("Index Presensi Mahasiswa Perbulan")
      ->elementLabel("Total presensi mahasiswa")
      ->dimensions(1000, 500)
      ->responsive(false)
      ->groupByMonth(date('Y'), true);

      $presensi = presensi_dosen::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))
      ->where('validasi','success')
      ->where('history','pulang')
      ->get();

      $pie2 = Charts::database($presensi, 'bar', 'highcharts')
      ->title("Index Presensi Dosen")
      ->elementLabel("Total presensi Dosen")
      ->dimensions(1000, 500)
      ->responsive(false)
      ->groupByMonth(date('Y'), true);

      $presensi_kar = presen_karyawan::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))
      ->where('validasi','success')
      ->where('history','pulang')
      ->get();
      $kar = Charts::database($presensi_kar, 'bar', 'highcharts')
      ->title("Index Presensi Karyawan")
      ->elementLabel("Total presensi Karyawan")
      ->dimensions(1000, 500)
      ->responsive(false)
      ->groupByMonth(date('Y'), true);


      $presensi_kar = presen_karyawan::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))
      ->where('validasi','success')
      ->where('history','pulang')
      ->get();
      $kar = Charts::database($presensi_kar, 'bar', 'highcharts')
      ->title("Index Presensi Karyawan")
      ->elementLabel("Total presensi Karyawan")
      ->dimensions(1000, 500)
      ->responsive(false)
      ->groupByMonth(date('Y'), true);

      $i = Session::get('id_dosen');
      if ($i == null) {
        $i = Session::get('id_dos');
      }
      $Dosen = presensi_dosen::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))
      ->where('id_dosen', '=', $i)
      ->where('history','pulang')
      ->get();
      $dos = Charts::database($Dosen, 'bar', 'highcharts')
      ->title("Index Presensi Dosen")
      ->elementLabel("Total presensi")
      ->dimensions(1000, 500)
      ->responsive(false)
      ->groupByMonth(date('Y'), true);

      $k = Session::get('id_karyawan');
      $karY = presen_karyawan::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))
      ->where('id_karyawan', '=', $k)
      ->where('validasi', '=', 'success')
      ->get();
      $karyawan = Charts::database($karY, 'bar', 'highcharts')
      ->title("Index Presensi karyawan")
      ->elementLabel("Total presensi")
      ->dimensions(1000, 500)
      ->responsive(false)
      ->groupByMonth(date('Y'), true);  
    //  dd($presensi);
    return view('home',compact('chart','pie','pie2','kar','dos','karyawan'));
    }

public function ReportDos(){  ////menampilkan data Dosen
  Session::forget('message');
  Session::forget('total_sks');
  $Dosen = DB::table('Dosen')
  ->join('prodi', 'prodi.id_prodi', '=', 'Dosen.id_prodi')
  ->get();

  $DosenFil = DB::table('prodi')
  ->get('nama_prodi');
  return view('Rbsdm',['Dosen'=> $Dosen,'F'=> $DosenFil]);
}

public function ReportDosFil($id){  ////menampilkan data Dosen
 $Dosen = DB::table('Dosen')
 ->join('prodi', 'prodi.id_prodi', '=', 'Dosen.id_prodi')
 ->where('prodi.nama_prodi','=',$id)
 ->get();

 $DosenFil = DB::table('prodi')
 ->get('nama_prodi');
 return view('Rbsdm',['Dosen'=> $Dosen,'F'=> $DosenFil]);
}


public function filter($month,$years){ //filter BSDM
 Session::forget('Total_jam');
 Session::forget('hari');
 Session::forget('hari_aktif');
 Session::forget('a');  //
 Session::forget('b');  //
 Session::put('month', $month);
 Session::put('years', $years);
 $i = Session::get('id_dosen');
 if ($i == null) {
  $i = Session::get('id_dos');
}
//$date = \Carbon\Carbon::now()->subMonth();
$Dos = Dosen::find($i);
/*$Dosen = DB::table('presensi_dosen')
->join('Dosen', 'presensi_dosen.id_dosen', '=', 'Dosen.id_dosen')
->where('presensi_dosen.id_dosen', '=', $i)
->where('presensi_dosen.validasi', '=', 'success')
->whereMonth('created_at', '=', $month)
->whereYear('created_at', '=', $years )
->orderBy('id_presensi_dosen', 'desc')
->get(['Dosen.nip','Dosen.nidn','name','jenis_kelamin','alamat','validasi','created_at','days','history','jumlah_masuk','keterangan']);*/

$Dosen = DB::table('pdanpdbn')
->where('Dosen', '=', $i)
->whereMonth('tanggal', '=', $month)
->whereYear('tanggal', '=', $years )
->get();


$Db= DB::table('presensi_dosen')
->where('id_dosen', '=', $i)
->where('validasi', '=', 'success')
->get();

$periode= DB::table('periode')
->get();

$datatahun = [];
$databulan = [];

foreach ($Db as $d ) {
  $tahun = \Carbon\Carbon::parse($d->created_at)->format('Y');
  array_push($datatahun,$tahun);
}

foreach ($Db as $m ) {
  $bulan = \Carbon\Carbon::parse($m->created_at)->format('F');
  array_push($databulan,$bulan);
}

$datatahun = array_unique($datatahun);
$databulan = array_unique($databulan);
$message='';
$total_jam='';
$hasil_hari='';
return view('reportdos',['Dosen'=> $Dosen,'Dos'=> $Dos,'D'=> $datatahun, 'M'=> $databulan,'periode'=> $periode,'message'=> $message,'total'=> $total_jam,'hari_aktif'=>$hasil_hari]); 
}

public function filterYear($years){ //BSDM FILTER
  Session::forget('Total_jam');
  Session::forget('hari');
  Session::forget('hari_aktif');
  Session::forget('a'); //
  Session::forget('b'); //
  Session::forget('Total');
  Session::forget('month');
  Session::put('years', $years);
  $i = Session::get('id_dosen');
  if ($i == null) {
    $i = Session::get('id_dos');
  }
//$date = \Carbon\Carbon::now()->subMonth();
  $Dos = Dosen::find($i);
/*  $Dosen = DB::table('presensi_dosen')
  ->join('Dosen', 'presensi_dosen.id_dosen', '=', 'Dosen.id_dosen')
  ->where('presensi_dosen.id_dosen', '=', $i)
  ->where('presensi_dosen.validasi', '=', 'success')
  ->whereYear('created_at', '=', $years )
  ->orderBy('presensi_dosen.created_at', 'desc')
  ->get(['Dosen.nip','Dosen.nidn','name','jenis_kelamin','alamat','validasi','created_at','days','history','jumlah_masuk','keterangan']);*/
  $Dosen = DB::table('pdanpdbn')
  ->where('Dosen', '=', $i)
  ->whereYear('tanggal', '=', $years )
  ->get();

  $Db= DB::table('presensi_dosen')
  ->where('id_dosen', '=', $i)
  ->where('validasi', '=', 'success')
  ->get();


  $periode= DB::table('periode')
  ->get();

  $datatahun = [];
  $databulan = [];

  foreach ($Db as $d ) {
    $tahun = \Carbon\Carbon::parse($d->created_at)->format('Y');
    array_push($datatahun,$tahun);
  }

  foreach ($Db as $m ) {
    $bulan = \Carbon\Carbon::parse($m->created_at)->format('F');
    array_push($databulan,$bulan);
  }

  $datatahun = array_unique($datatahun);
  $databulan = array_unique($databulan);

  $message='';
  $total_jam='';
  $hasil_hari='';
  return view('reportdos',['Dosen'=> $Dosen,'Dos'=> $Dos,'D'=> $datatahun, 'M'=> $databulan,
    'periode'=> $periode,'message'=> $message,'total'=> $total_jam,'hari_aktif'=>$hasil_hari]); 
}


public function filterKarYear($years){ //filter presensi dosen
  Session::forget('Totalk');
  Session::forget('total_hari_kar');
  Session::forget('hari_kar_aktif');
  Session::forget('message');

  Session::forget('Ka');
  Session::forget('Kb');
  Session::forget('month');
  Session::put('years', $years);
  $i = Session::get('id_karyawan');
 $date = \Carbon\Carbon::now()->subMonth();//subWeek();//subDays(2);

 /* $year = \Carbon\Carbon::now();
  $parse = \Carbon\Carbon::parse($year)->format('Y');
 */


 /* $kar = DB::table('presensi_karyawan')
  ->join('Karyawan', 'karyawan.id_karyawan', '=', 'presensi_karyawan.id_karyawan')
  ->where('presensi_karyawan.id_karyawan', '=', $i)
  ->whereYear('presensi_karyawan.created_at', '=', $years )
  ->where('presensi_karyawan.validasi', '=', 'success')
  ->get();*/
    //dd($kar);
  $kar = DB::table('pkanpkbn')
  ->join('Karyawan', 'pkanpkbn.karyawan', '=', 'karyawan.id_karyawan')
  ->where('karyawan', '=', $i)
  ->whereYear('tanggal', '=', $years )
  ->get();


  $karFil = DB::table('presensi_karyawan')
  ->where('id_karyawan', '=', $i)
  ->where('validasi', '=', 'success')
  ->orderBy('id_presensi_karyawan', 'desc')
  ->get();

  $datatahun = [];
  $databulan = [];
  $databulan1 = [];

  foreach ($karFil as $d ) {

    $tahun = \Carbon\Carbon::parse($d->created_at)->format('Y');
    array_push($datatahun,$tahun);

  }

  foreach ($karFil as $m ) {

    $bulan = \Carbon\Carbon::parse($m->created_at)->format('F');
    array_push($databulan,$bulan);

  }



  $datatahun = array_unique($datatahun);
  $databulan = array_unique($databulan);
  $databulan1 = array_unique($databulan1);


  $periode= DB::table('periode')
  ->get();
  $message='';
  $total_jam = '';
  $hasil_hari = '';

  return view('PresensiKar',['kar'=> $kar,'D'=> $datatahun, 'M'=> $databulan,'periode'=> $periode,'message'=> $message,'total'=> $total_jam,'hari_aktif'=>$hasil_hari]);
}


public function filterYearMat($years){ //filter presensi dosen
 Session::forget('awal'); 
 Session::forget('akhir'); 
 Session::put('matkul_years', $years);
 $id = Session::get('id_dosen');
 $id1 = Session::get('id_matkul');

 $Dosen = DB::table('Dosen')

 ->where('id_dosen', '=', $id)
 ->get();

 $periode = DB::table('periode_matkul')
 ->get();

 $Matkul = DB::table('presensi_matkul_dosen')
 ->where('id_matkul','=',$id1)
 ->whereYear('created_at', '=', $years )
 ->orderBy('id_presensi_matkul', 'desc')
 ->get();

 $M = DB::table('presensi_matkul_dosen')
 ->where('id_matkul','=',$id1)
 ->orderBy('id_presensi_matkul', 'desc')
 ->get();
 // dd($Dosen);

 $datatahun = [];

 foreach ($M as $d ) {
  $tahun = \Carbon\Carbon::parse($d->created_at)->format('Y');
  array_push($datatahun,$tahun);
}

$datatahun = array_unique($datatahun);

$a='';
$hasil_hari='';
$message='null';
return view('MatkulPage',['Matkul'=> $Matkul,'Dosen'=> $Dosen,'D'=> $datatahun,'periode_matkul'=> $periode,'total'=> $a,'hari_aktif'=>$hasil_hari])->with('message', $message); 

}

public function showPre($id){   //BSDM
 Session::forget('Total_jam');
 Session::forget('hari');
 Session::forget('hari_aktif');
 Session::forget('a');  //
 Session::forget('b');  //
 Session::put('id_dosen', $id);
 
 $Dos = Dosen::find($id);
 /*$Dosen = DB::table('presensi_dosen')
 ->join('Dosen', 'presensi_dosen.id_dosen', '=', 'Dosen.id_dosen')
 ->where('presensi_dosen.id_dosen', '=', $id)
 ->where('presensi_dosen.validasi', '=', 'success')
 ->orderBy('presensi_dosen.created_at', 'desc')
 ->get(['Dosen.nip','name','jenis_kelamin','alamat','validasi','created_at','days','history','jumlah_masuk','keterangan','Dosen.nidn']);*/
 $Dosen = DB::table('pdanpdbn')
 ->where('Dosen', '=', $id)
 ->get();

//dd($Dosen);

 $periode= DB::table('periode')
 ->get();


 $Db= DB::table('presensi_dosen')
 ->where('id_dosen', '=', $id)
 ->where('validasi', '=', 'success')
 ->get();

 $datatahun = [];
 $databulan = [];
 $databulan1 = [];

 foreach ($Db as $d ) {

  $tahun = \Carbon\Carbon::parse($d->created_at)->format('Y');
  array_push($datatahun,$tahun);
}

foreach ($Db as $m ) {
  $bulan = \Carbon\Carbon::parse($m->created_at)->format('F');
  array_push($databulan,$bulan);
}


$datatahun = array_unique($datatahun);
$databulan = array_unique($databulan);
$databulan1 = array_unique($databulan1);
$message = '';
$total_jam = '';
$hasil_hari='';


return view('reportdos',['Dosen'=> $Dosen,'Dos'=> $Dos,'D'=> $datatahun, 'M'=> $databulan,'periode'=> $periode,'message'=> $message,'total'=> $total_jam,'hari_aktif'=>$hasil_hari]); 
}

public function showPreDos(){
 Session::forget('Total_jam');
 Session::forget('hari');
 Session::forget('hari_aktif');
 Session::forget('a');  //
 Session::forget('b');  //
 Session::forget('years');
 Session::forget('month');
 $id = Session::get('id_dosen');
 $date = \Carbon\Carbon::now()->subWeek();
 $year = \Carbon\Carbon::now('Y');
 
 $Dos = Dosen::find($id);
/* $Dosen = DB::table('presensi_dosen')
 ->join('Dosen', 'presensi_dosen.id_dosen', '=', 'Dosen.id_dosen')
 ->where('presensi_dosen.id_dosen', '=', $id)
 ->where('presensi_dosen.validasi', '=', 'success')
 ->orderBy('presensi_dosen.created_at', 'desc')
 ->get(['Dosen.nip','Dosen.nidn','name','jenis_kelamin','alamat','validasi','created_at','days','history','jumlah_masuk','keterangan']);*/
 $Dosen= DB::table('pdanpdbn')
 ->where('Dosen', '=', $id)
 ->get();

 $Db= DB::table('presensi_dosen')
 ->where('id_dosen', '=', $id)
 ->where('validasi', '=', 'success')
 ->get();

 $periode= DB::table('periode')
 ->get();

 $datatahun = [];
 $databulan = [];
 $databulan1 = [];

 foreach ($Db as $d ) {

  $tahun = \Carbon\Carbon::parse($d->created_at)->format('Y');
  array_push($datatahun,$tahun);
}

foreach ($Db as $m ) {
  $bulan = \Carbon\Carbon::parse($m->created_at)->format('F');
  array_push($databulan,$bulan);
}

$datatahun = array_unique($datatahun);
$databulan = array_unique($databulan);
$databulan1 = array_unique($databulan1);

$message = '';
$total_jam = '';
$hasil_hari='';

return view('reportdos',['Dosen'=> $Dosen,'Dos'=> $Dos,'D'=> $datatahun, 'M'=> $databulan,'periode'=> $periode,'message'=> $message,'total'=> $total_jam,'hari_aktif'=>$hasil_hari]); 

}

public function showPreR(){       //BSDM
 Session::forget('Total_jam');
 Session::forget('hari');
 Session::forget('hari_aktif');
 $id = Session::get('id_dosen');
 Session::forget('a');  //
 Session::forget('b');//
 $date = \Carbon\Carbon::now()->subWeek();
 $year = \Carbon\Carbon::now('Y');

 $Dos = Dosen::find($id);
 $Dosen = DB::table('presensi_dosen')
 ->join('Dosen', 'presensi_dosen.id_dosen', '=', 'Dosen.id_dosen')
 ->where('presensi_dosen.id_dosen', '=', $id)
 ->where('presensi_dosen.validasi', '=', 'success')
 ->orderBy('id_presensi_dosen', 'desc')
 ->get(['Dosen.nip','Dosen.nidn','name','jenis_kelamin','alamat','validasi','created_at','days','history','jumlah_masuk','keterangan']);

 $Db= DB::table('presensi_dosen')
 ->where('id_dosen', '=', $id)
 ->where('validasi', '=', 'success')
 ->get();

 $datatahun = [];
 $databulan = [];
 $databulan1 = [];

 foreach ($Db as $d ) {
  $tahun = \Carbon\Carbon::parse($d->created_at)->format('Y');
  array_push($datatahun,$tahun);
}

foreach ($Db as $m ) {
  $bulan = \Carbon\Carbon::parse($m->created_at)->format('F');
  array_push($databulan,$bulan);
}

$datatahun = array_unique($datatahun);
$databulan = array_unique($databulan);
$databulan1 = array_unique($databulan1);



return view('reportdos',['Dosen'=> $Dosen,'Dos'=> $Dos,'D'=> $datatahun, 'M'=> $databulan]); 

}


public function showMat($id){ 
  Session::forget('message');
  Session::forget('total_sks');
  Session::put('id_dosen', $id);
  $Dos = Dosen::find($id);
  $Dosen = DB::table('mata_kuliah')
  ->where('id_dosen', '=', $id)
  ->get();
  return view('ReportMatDos',['Dosen'=> $Dosen,'Dos'=> $Dos]); 
}

public function matkulID($id){ 
  $id_dosen = DB::table('Dosen')
  ->join('users', 'users.user_id', '=', 'Dosen.user_id')
  ->where('Dosen.user_id','=',$id)
  ->get('Dosen.id_dosen');
//dd($id_dosen[0]);
  $data = json_decode($id_dosen, TRUE);
  foreach ($data as $dt) {
      //  echo $dt['id_dosen'];

    $d = $dt['id_dosen'];
    Session::put('id_dos', $d);
  }

  $id = Session::get('id_dos');

  $Dos = Dosen::find($id);
  $Dosen = DB::table('mata_kuliah')
     //->selectRaw('SEC_TO_TIME(sum(TIME_TO_SEC(jumlah_masuk))) as timesum')
  ->where('id_dosen', '=', $id)
  ->get();


  return view('ReportMatDos',['Dosen'=> $Dosen,'Dos'=> $Dos]); 


}

public function selectmatViewR(){
 Session::forget('matkul_years');
 Session::forget('awal');
 Session::forget('akhir');
 $id1 = Session::get('id_matkul');
 $id = Session::get('id_dosen');
 $Dosen = DB::table('Dosen')
 ->where('id_dosen', '=', $id)
 ->get();

 $periode = DB::table('periode_matkul')
 ->get();

 $Matkul = DB::table('presensi_matkul_dosen')
 ->where('id_matkul','=',$id1)
 ->orderBy('id_presensi_matkul', 'desc')
 ->get();
 // dd($Dosen);

 $datatahun = [];

 foreach ($Matkul as $d ) {
  $tahun = \Carbon\Carbon::parse($d->created_at)->format('Y');
  array_push($datatahun,$tahun);
}

$datatahun = array_unique($datatahun);
$a='';
$hasil_hari='';
$message='null';
return view('MatkulPage',['Matkul'=> $Matkul,'Dosen'=> $Dosen,'D'=> $datatahun,'periode_matkul'=> $periode,'total'=> $a,'hari_aktif'=>$hasil_hari])->with('message', $message); 
}

public function selectmatView($id1){  //Mencari Data Presensi matkul dosen dengan id matkul
 Session::forget('matkul_years');
 Session::put('id_matkul', $id1);
 $id = Session::get('id_dosen');

 $Dosen = DB::table('Dosen')
 ->where('id_dosen', '=', $id)
 ->get();

 $periode = DB::table('periode_matkul')
 ->get();

 $Matkul = DB::table('presensi_matkul_dosen')
 ->where('id_matkul','=',$id1)
 ->orderBy('created_at', 'desc')
 ->get();

 $datatahun = [];
 foreach ($Matkul as $d ) {
  $tahun = \Carbon\Carbon::parse($d->created_at)->format('Y');
  array_push($datatahun,$tahun);
}
$a = '';
$hasil_hari = '';
$message = 'null';

$datatahun = array_unique($datatahun);
return view('MatkulPage',['Matkul'=> $Matkul,'Dosen'=> $Dosen,'D'=> $datatahun,'periode_matkul'=> $periode,'total'=> $a,'hari_aktif'=>$hasil_hari])->with('message', $message); 

}


public function MPresensiMhs($id,$i){
 $idD = Session::get('id_dosen');
 if ($idD == null) {
   $idD = Session::get('id_dos');
 }
 
 $Dos = Dosen::find($idD);

 $Dosen = DB::table('Dosen')
 ->where('id_dosen', '=', $idD)
 ->get();
 Session::put('id_matkul', $id);
 Session::put('uniq', $i);

 $krs = DB::table('presensi_mahasiswa')
 ->join('mahasiswa', 'presensi_mahasiswa.nim', '=', 'mahasiswa.nim')
 ->join('mata_kuliah', 'mata_kuliah.id_matkul', '=', 'presensi_mahasiswa.id_matkul')
 ->where('presensi_mahasiswa.id_matkul', '=', $id)
 ->where('presensi_mahasiswa.uniq', '=', $i)
 ->where('presensi_mahasiswa.aprove', '=', 'success')
 ->orderBy('id_presensi_mhs', 'desc')
 ->get(['presensi_mahasiswa.nim','mahasiswa.name','presensi_mahasiswa.device','presensi_mahasiswa.keterangan','mata_kuliah.nama_matkul','presensi_mahasiswa.materi','presensi_mahasiswa.created_at','presensi_mahasiswa.days']);

//dd($krs);
 $matkul = DB::table('mata_kuliah')
 ->where('id_matkul', '=', $id)
 ->get();
  //dd($matkul);
 return view('PresensiMhs',['Presensi'=> $krs,'Dosen'=> $Dosen,'Matkul'=> $matkul]);   



}


public function ReportMatDos(){
  $Dosen = Dosen::all();
  return view('RTu',['Dosen'=> $Dosen]);
}

public function ReportPeg(){  //menampilkan data karyawan umg

  Session::forget('message');
  Session::forget('total_sks');
    //karyawan_umg
  $kr = karyawan::all();
      //dd($kr);
  return view('reportkar',['kar'=> $kr]); 
}

public function ReportPegID($id){                                 //REPORTING KAARYAWAN BY ID
  $kr = DB::table('karyawan')
  ->where('user_id', '=', $id)
  ->get();
  $data = json_decode($kr, TRUE);
  foreach ($data as $dt) {
   // dd($dt['id_karyawan']);
    $d = $dt['id_karyawan'];
    Session::put('id_karyawan', $d);
  }
  $id = Session::get('id_karyawan');
  /*$kar = DB::table('presensi_karyawan')
  ->join('Karyawan', 'karyawan.id_karyawan', '=', 'presensi_karyawan.id_karyawan')
  ->where('presensi_karyawan.id_karyawan', '=', $id)
  ->where('presensi_karyawan.validasi', '=', 'success')
  ->orderBy('presensi_karyawan.created_at', 'desc')
  ->get();*/

  $kar = DB::table('pkanpkbn')
  ->join('Karyawan', 'pkanpkbn.karyawan', '=', 'karyawan.id_karyawan')
  ->where('karyawan', '=', $id)
  ->get();

  $karFil = DB::table('presensi_karyawan')
  ->where('id_karyawan', '=', $id)
  ->where('validasi', '=', 'success')
  ->orderBy('id_presensi_karyawan', 'desc')
  ->get();

  $datatahun = [];
  $databulan = [];

  foreach ($karFil as $d ) {

    $tahun = \Carbon\Carbon::parse($d->created_at)->format('Y');
    array_push($datatahun,$tahun);

  }

  foreach ($karFil as $m ) {

    $bulan = \Carbon\Carbon::parse($m->created_at)->format('F');
    array_push($databulan,$bulan);

  }

  $datatahun = array_unique($datatahun);
  $databulan = array_unique($databulan);

  $periode= '';
  $message= '';
  $total_jam= '';
  $hasil_hari= '';


  return view('PresensiKar',['kar'=> $kar,'D'=> $datatahun, 'M'=> $databulan,'periode'=> $periode,'message'=> $message,'total'=> $total_jam,'hari_aktif'=>$hasil_hari]);
}

public function filterKar($month,$years){ //filter kar
 Session::forget('Totalk');
 Session::forget('total_hari_kar');
 Session::forget('hari_kar_aktif'); 
 Session::put('month', $month);
 Session::put('years', $years);
 Session::forget('Totalk');
 //$date = new Carbon\Carbon;
 $i = Session::get('id_karyawan');
 $date = \Carbon\Carbon::now()->subMonth();//subWeek();//subDays(2);
/* $kar = DB::table('presensi_karyawan')
 ->join('Karyawan', 'karyawan.id_karyawan', '=', 'presensi_karyawan.id_karyawan')
 ->where('presensi_karyawan.id_karyawan', '=', $i)
 ->whereMonth('presensi_karyawan.created_at', '=', $month)
 ->whereYear('presensi_karyawan.created_at', '=', $years )
 ->where('presensi_karyawan.validasi', '=', 'success')
 ->orderBy('presensi_karyawan.created_at', 'desc')
 ->get();*/
    //dd($kar);

 $kar = DB::table('pkanpkbn')
 ->join('Karyawan', 'pkanpkbn.karyawan', '=', 'karyawan.id_karyawan')
 ->where('karyawan', '=', $i)
 ->whereMonth('tanggal', '=', $month)
 ->whereYear('tanggal', '=', $years )
 ->get();

 $karFil = DB::table('presensi_karyawan')
 ->where('id_karyawan', '=', $i)
 ->where('validasi', '=', 'success')
 ->orderBy('id_presensi_karyawan', 'desc')
 ->get();

 $datatahun = [];
 $databulan = [];
 $databulan1 = [];

 foreach ($karFil as $d ) {

  $tahun = \Carbon\Carbon::parse($d->created_at)->format('Y');
  array_push($datatahun,$tahun);

}

foreach ($karFil as $m ) {

  $bulan = \Carbon\Carbon::parse($m->created_at)->format('F');
  array_push($databulan,$bulan);

}


$datatahun = array_unique($datatahun);
$databulan = array_unique($databulan);
$databulan1 = array_unique($databulan1);


$periode= DB::table('periode')
->get();
$message='';
$total_jam = '';
$hasil_hari = '';

return view('PresensiKar',['kar'=> $kar,'D'=> $datatahun, 'M'=> $databulan,'periode'=> $periode,'message'=> $message,'total'=> $total_jam,'hari_aktif'=>$hasil_hari]);
}

public function PresensiKar($id){
  Session::forget('Totalk');
  Session::forget('total_hari_kar');
  Session::forget('hari_kar_aktif'); 
  Session::forget('Ka');
  Session::forget('Kb');
  Session::put('id_karyawan', $id);
 $date = \Carbon\Carbon::now()->subWeek();//subDays(2);
 $year = \Carbon\Carbon::now('Y');


 Session::put('id_karyawan', $id);

/* $kar = DB::table('presensi_karyawan')
 ->join('Karyawan', 'karyawan.id_karyawan', '=', 'presensi_karyawan.id_karyawan')
 ->where('presensi_karyawan.id_karyawan', '=', $id)
 ->where('presensi_karyawan.validasi', '=', 'success')
 ->orderBy('presensi_karyawan.id_presensi_karyawan', 'desc')
 ->get();*/

 $kar = DB::table('pkanpkbn')
 ->join('Karyawan', 'pkanpkbn.karyawan', '=', 'karyawan.id_karyawan')
 ->where('karyawan', '=', $id)
 ->get();
 //dd($kar);

 $karFil = DB::table('presensi_karyawan')
 ->where('id_karyawan', '=', $id)
 ->where('validasi', '=', 'success')
 ->orderBy('id_presensi_karyawan', 'desc')
 ->get();
    //dd($kar);
 $periode= DB::table('periode')
 ->get();



 $datatahun = [];
 $databulan = [];
 $databulan1 = [];
 $datamingguan = [];

 foreach ($karFil as $d ) {

  $tahun = \Carbon\Carbon::parse($d->created_at)->format('Y');
  array_push($datatahun,$tahun);
}

foreach ($karFil as $m ) {

  $bulan = \Carbon\Carbon::parse($m->created_at)->format('F');
  array_push($databulan,$bulan);

}
foreach ($karFil as $m ) {

  $minggu = \Carbon\Carbon::parse($m->created_at)->format('F');
  array_push($datamingguan,$minggu);

}

$datatahun = array_unique($datatahun);
$databulan = array_unique($databulan);
$databulan1 = array_unique($databulan1);
$datamingguan = array_unique($datamingguan);

$message='';
$total_jam = '';
$hasil_hari = '';

return view('PresensiKar',['kar'=> $kar,'D'=> $datatahun,'M'=> $databulan,'periode'=> $periode,'message'=> $message,'total'=> $total_jam,'hari_aktif'=>$hasil_hari]);

}

public function PresensiR(){
  Session::forget('Totalk');
  Session::forget('total_hari_kar');
  Session::forget('hari_kar_aktif');
  Session::forget('Ka');
  Session::forget('Kb');
  Session::forget('month');
  Session::forget('years');
  Session::forget('Totalk');
  $id = Session::get('id_karyawan');
 $date = \Carbon\Carbon::now()->subWeek();//subDays(2);
 $year = \Carbon\Carbon::now('Y');


 Session::put('id_karyawan', $id);

 /*$kar = DB::table('presensi_karyawan')
 ->join('Karyawan', 'karyawan.id_karyawan', '=', 'presensi_karyawan.id_karyawan')
 ->where('presensi_karyawan.id_karyawan', '=', $id)
 ->where('presensi_karyawan.validasi', '=', 'success')
 ->orderBy('presensi_karyawan.id_presensi_karyawan', 'desc')
 ->get();*/

 $kar = DB::table('pkanpkbn')
 ->join('Karyawan', 'pkanpkbn.karyawan', '=', 'karyawan.id_karyawan')
 ->where('karyawan', '=', $id)
 ->get();

 $karFil = DB::table('presensi_karyawan')
 ->where('id_karyawan', '=', $id)
   // ->where('created_at', '>=', $day)
 
 ->where('validasi', '=', 'success')
 ->orderBy('id_presensi_karyawan', 'desc')
 ->get();
    //dd($kar);
 $periode= DB::table('periode')
 ->get();

 $datatahun = [];
 $databulan = [];
 $databulan1 = [];
 $datamingguan = [];

 foreach ($karFil as $d ) {

  $tahun = \Carbon\Carbon::parse($d->created_at)->format('Y');
  array_push($datatahun,$tahun);

}

foreach ($karFil as $m ) {

  $bulan = \Carbon\Carbon::parse($m->created_at)->format('F');
  array_push($databulan,$bulan);

}
foreach ($karFil as $m ) {

  $minggu = \Carbon\Carbon::parse($m->created_at)->format('F');
  array_push($datamingguan,$minggu);

}

$datatahun = array_unique($datatahun);
$databulan = array_unique($databulan);
$databulan1 = array_unique($databulan1);
$datamingguan = array_unique($datamingguan);

$message='';
$total_jam = '';
$hasil_hari = '';

return view('PresensiKar',['kar'=> $kar,'D'=> $datatahun, 'M'=> $databulan,'periode'=> $periode,'message'=> $message,'total'=> $total_jam,'hari_aktif'=>$hasil_hari]);

}

public function  DBTu($id){  //menampilkan data karyawan umg
    //karyawan_umg
  $kr = DB::table('prodi') 
  ->where('id_fakultas', $id)
  ->get();
      //dd($kr);
  return view('DasbordTu',['pr'=> $kr]); 
}

public function ReporTU(){  //menampilkan data karyawan umg
    //karyawan_umg
  $DosenFil = DB::table('prodi')
  ->get('nama_prodi');
  $kr = DB::table('Dosen')
  ->join('prodi', 'prodi.id_prodi', '=', 'Dosen.id_prodi')
  ->get();
  return view('Fakultas',['pr'=> $kr,'FF'=> $DosenFil]); 
}

public function DosenID($id){  //menampilkan data Dosen by id
 Session::forget('Total_jam');
 Session::forget('hari');
 Session::forget('hari_aktif');
 Session::forget('Total');
 $id_dosen = DB::table('Dosen')
 ->join('users', 'users.user_id', '=', 'Dosen.user_id')
 ->where('Dosen.user_id','=',$id)
 ->get('Dosen.id_dosen');
//dd($id_dosen[0]);
 $data = json_decode($id_dosen, TRUE);
 foreach ($data as $dt) {
      //  echo $dt['id_dosen'];

  $d = $dt['id_dosen'];
  Session::put('id_dos', $d);
}

$date = \Carbon\Carbon::now()->subWeek();
$year = \Carbon\Carbon::now('Y');

$idD = Session::get('id_dos');
//dd($idD[0]);
$Dos = Dosen::find($idD);
/*$Dosen = DB::table('presensi_dosen')
->join('Dosen', 'presensi_dosen.id_dosen', '=', 'Dosen.id_dosen')
->where('presensi_dosen.id_dosen', '=', $idD)
->where('presensi_dosen.validasi', '=', 'success')
->orderBy('id_presensi_dosen', 'desc')
->get(['Dosen.nip','Dosen.nidn','name','jenis_kelamin','alamat','validasi','created_at','days','history','jumlah_masuk','keterangan']);*/
$Dosen = DB::table('pdanpdbn')
->where('Dosen', '=', $idD)
->get();

$Db= DB::table('presensi_dosen')
->where('id_dosen', '=', $idD)
->where('validasi', '=', 'success')
->get();

$datatahun = [];
$databulan = [];
$databulan1 = [];

foreach ($Db as $d ) {
  $tahun = \Carbon\Carbon::parse($d->created_at)->format('Y');
  array_push($datatahun,$tahun);
}

foreach ($Db as $m ) {
  $bulan = \Carbon\Carbon::parse($m->created_at)->format('F');
  array_push($databulan,$bulan);
}

$datatahun = array_unique($datatahun);
$databulan = array_unique($databulan);
$databulan1 = array_unique($databulan1);

$periode ='';
$message ='';
$total_jam ='';
$hasil_hari ='';
if ($Dosen != '[]') {

 return view('reportdos',['Dosen'=> $Dosen,'Dos'=> $Dos,'D'=> $datatahun, 'M'=> $databulan,'periode'=> $periode,'message'=> $message,'total'=> $total_jam,'hari_aktif'=>$hasil_hari]); 
}else{
 return view('api');  
}


}


public function RepotDosenIDAll(){  //menampilkan data Dosen by id
  Session::forget('Total_jam');
  Session::forget('hari');
  Session::forget('hari_aktif');
  Session::forget('Total');
  Session::forget('month');
  Session::forget('years');
  Session::forget('a'); //
  Session::forget('b'); //
  $date = \Carbon\Carbon::now()->subWeek();
  $year = \Carbon\Carbon::now('Y');

  $idD = Session::get('id_dos');
//dd($idD[0]);
  $Dos = Dosen::find($idD);
/*  $Dosen = DB::table('presensi_dosen')
  ->join('Dosen', 'presensi_dosen.id_dosen', '=', 'Dosen.id_dosen')
  ->where('presensi_dosen.id_dosen', '=', $idD)
  ->where('presensi_dosen.validasi', '=', 'success')
  ->orderBy('id_presensi_dosen', 'desc')
  ->get(['Dosen.nip','Dosen.nidn','name','jenis_kelamin','alamat','validasi','created_at','days','history','jumlah_masuk','keterangan']);
*/
  $Dosen= DB::table('pdanpdbn')
  ->where('Dosen', '=', $idD)
  ->get();
  $Db= DB::table('presensi_dosen')
  ->where('id_dosen', '=', $idD)
  ->where('validasi', '=', 'success')
  ->get();

  $datatahun = [];
  $databulan = [];
  $databulan1 = [];

  foreach ($Db as $d ) {
    $tahun = \Carbon\Carbon::parse($d->created_at)->format('Y');
    array_push($datatahun,$tahun);
  }

  foreach ($Db as $m ) {
    $bulan = \Carbon\Carbon::parse($m->created_at)->format('F');
    array_push($databulan,$bulan);
  }

  $datatahun = array_unique($datatahun);
  $databulan = array_unique($databulan);
  $databulan1 = array_unique($databulan1);

  if ($Dosen != '[]') {

   return view('reportdos',['Dosen'=> $Dosen,'Dos'=> $Dos,'D'=> $datatahun, 'M'=> $databulan]); 
 }else{
   return view('api');  
 }



}
public function ReportDosMatFil($id){  ////menampilkan data Dosen
 $kr = DB::table('Dosen')
 ->join('prodi', 'prodi.id_prodi', '=', 'Dosen.id_prodi')
 ->where('prodi.nama_prodi','=',$id)
 ->get();

 $DosenFil = DB::table('prodi')
 ->get('nama_prodi');
 return view('Fakultas',['pr'=> $kr,'FF'=> $DosenFil]);
}

public function downloadExcel($type)
{

  return Excel::download(new mhsPresensiExport, 'DataMhsPresensi.xls');

}

public function downloadExcelKar($type)
{


  return Excel::download(new karyawanPresensiExport, 'DataKaryawanPresensi.xls');

}
public function downloadExcelDos($type)
{


  return Excel::download(new DosenPresensiExport, 'DataDosenPresensi.xls');

}

public function downloadExceMatlDos($type)
{


  return Excel::download(new MatkulDosenPresensiExport, 'DataMatkulDosen.xls');

}

public function sumkar($a,$b){
 $i = Session::get('id_karyawan');
 $kar = DB::table('presensi_karyawan')
 ->selectRaw('SEC_TO_TIME(sum(TIME_TO_SEC(jumlah_masuk))) as timesum')
 ->where('id_karyawan', '=', $i)
 ->where('created_at','<=',$b)
 ->where('created_at','>=',$a)
 ->get();

 Session::put('Totalk', $kar); 

 return $kar;

}
public function getotal($id){

//dd($id);

}

public function sumdos($id,$id1){ //sum tpresensi dosen
 $i = Session::get('id_dosen');
 if ($i == null) {
  $i = Session::get('id_dos');
}

$kr = DB::table('presensi_dosen')
->selectRaw('SEC_TO_TIME(sum(TIME_TO_SEC(jumlah_masuk))) as timesum')
->where('id_dosen', '=', $i)
->where('created_at','<=',$id1)
->where('created_at','>=',$id)
->get();
Session::put('Total', $kr);
return $kr;

}

public function sumdosFil($id,$id1){    //BSDM rage
  Session::put('a', $id);
  Session::put('b', $id1);
  $i = Session::get('id_dosen');
  if ($i == null) {
    $i = Session::get('id_dos');
  }
  $Dosen = DB::table('presensi_dosen')
  ->join('Dosen', 'presensi_dosen.id_dosen', '=', 'Dosen.id_dosen')
  ->where('presensi_dosen.id_dosen', '=', $i)
  ->where('presensi_dosen.validasi', '=', 'success')
  ->where('presensi_dosen.created_at','<=',$id1)
  ->where('presensi_dosen.created_at','>=',$id)
  ->orderBy('id_presensi_dosen', 'desc')
  ->get(['Dosen.nip','Dosen.nidn','name','jenis_kelamin','alamat','validasi','created_at','days','history','jumlah_masuk','keterangan']);

  $Dos = Dosen::find($i);
  $Db= DB::table('presensi_dosen')
  ->where('id_dosen', '=', $i)
  ->where('validasi', '=', 'success')
  ->get();
  $datatahun = [];
  $databulan = [];

  foreach ($Db as $d ) {
    $tahun = \Carbon\Carbon::parse($d->created_at)->format('Y');
    array_push($datatahun,$tahun);

  }

  foreach ($Db as $m ) {
    $bulan = \Carbon\Carbon::parse($m->created_at)->format('F');
    array_push($databulan,$bulan);

  }
  $datatahun = array_unique($datatahun);
  $databulan = array_unique($databulan);

  return view('reportdos',['Dosen'=> $Dosen,'Dos'=> $Dos,'D'=> $datatahun, 'M'=> $databulan]); 

}

public function sumkarFil($a,$b){
  Session::put('Ka', $a);
  Session::put('Kb', $b);

  $id = Session::get('id_karyawan');
 $date = \Carbon\Carbon::now()->subWeek();//subDays(2);
 $year = \Carbon\Carbon::now('Y');


 Session::put('id_karyawan', $id);

 $kar = DB::table('presensi_karyawan')
 ->join('Karyawan', 'karyawan.id_karyawan', '=', 'presensi_karyawan.id_karyawan')
 ->where('presensi_karyawan.id_karyawan', '=', $id)

 ->where('presensi_karyawan.created_at','<=',$b)
 ->where('presensi_karyawan.created_at','>=',$a)

   // ->where('created_at', '>=', $day)
 ->where('presensi_karyawan.validasi', '=', 'success')
 ->orderBy('id_presensi_karyawan', 'desc')
 ->get();
 

 $karFil = DB::table('presensi_karyawan')
 ->where('id_karyawan', '=', $id)
 ->where('validasi', '=', 'success')
 ->orderBy('id_presensi_karyawan', 'desc')
 ->get();
    //dd($kar);
 
 $datatahun = [];
 $databulan = [];
 $databulan1 = [];
 

 foreach ($karFil as $d ) {

  $tahun = \Carbon\Carbon::parse($d->created_at)->format('Y');
  array_push($datatahun,$tahun);

}

foreach ($karFil as $m ) {

  $bulan = \Carbon\Carbon::parse($m->created_at)->format('F');
  array_push($databulan,$bulan);

}


$datatahun = array_unique($datatahun);
$databulan = array_unique($databulan);
$databulan1 = array_unique($databulan1);


return view('PresensiKar',['kar'=> $kar,'D'=> $datatahun, 'M'=> $databulan]);

}




//------------------Reporting----------------VIEW BLADE-----------------------------//





public function ketUser($id){
  $user = DB::table('users')
  ->where('nim','=',$id)->get(['email']);

  return $user;

}

public function login()
{
  return view('login');
}

public function krs($id){
  $krs = DB::table('krs')
  ->join('mahasiswa', 'krs.nim', '=', 'mahasiswa.nim')
  ->join('mata_kuliah', 'mata_kuliah.id', '=', 'krs.id_matkul')
  ->where('krs.nim', '=', $id)
  ->get(['krs.id_matkul', 'mata_kuliah.matkul']);
  return $krs;
}



public function view($id)
{

  $absen = mhs::where('nim',$id)->get();

  return $absen ;

}

public function add(Request $request,$id1){
 $krs = DB::table('presensi_mahasiswa')
 ->where('uniq', '=', $request->uniq)
 ->where('nim', '=', $id1)
 ->get();

 $krs = $krs->count();

 if ($krs > 0 ) {
  return 'ya';
}else{
  $abb =  new absesnsi;

  $abb->nim = $id1;
  $abb->generate = $request->generate;
  $abb->days = $request->days;
  $abb->aprove = 'success';
  $abb->id_matkul = $request->id_matkul;
  $abb->uniq = $request->uniq;
  $abb->device = $request->device;


  $abb->save();
  return 'tidak';
}


}

public function edit($id1){

  $user =absesnsi::where('nim',$id1)
  ->orderBy('id_presensi_mhs', 'desc')
  ->get();


  return $user;
}

public function up($id1){  

      $edit= presensi_pegawai::where('generate',$id1)->get(); //mencari data yang paling depan
      if ($edit != '[]') {
       return $edit;

     }
     return 'tidak';
     
    // return $edit;
   }

   public function upPre($id1){  

      $edit= presensi_dosen::where('generate',$id1)->get(); //mencari data yang paling depan
     // return $edit;
      if ($edit != '[]') {
       return $edit;

     }
     return 'tidak';
     
    // return $edit;
   }

   public function upKar($id1){  

      $edit= presen_karyawan::where('generate',$id1)->get(); //mencari data yang paling depan
     // return $edit;
      if ($edit != '[]') {
       return $edit;

     }
     return 'tidak';
     
    // return $edit;
   }
   
   public function delete($id){
    $del=absesnsi::find($id);
    $del->delete();
  }


  public function addCode(Request $request,$id,$nim){
   $cd =  new absesnsi;
   $cd->nim = $nim;
   $cd->generate = $request->generate;
   $cd->validasi = $request->validasi;
   $cd->id_matkul = $id;

   $cd->save();

   return 'sukses';
 }
 

 public function ket(Request $request,$id){
   $cd =  new absesnsi;
   $cd->nim = $request->nim;
   $cd->generate = $request->generate;
   $cd->device = $request->device;
   $cd->keterangan = $request->keterangan;
   $cd->id_matkul = $id;
   $cd->aprove = 'success';
   $cd->days = $request->days;
   $cd->uniq = $request->uniq;
   $cd->save();

   return 'sukses';
 }

 // presensi karyawan
 public function storePeg(Request $request,$id,$nip){ //new
   $date = \Carbon\Carbon::now();

   $cd =  new presensi_pegawai;
   $cd->id_dosen = $nip;
   $cd->id_matkul = $id;
   $cd->jam_masuk = $date;
   $cd->generate = $request->generate;
   $cd->device = $request->device;
   $cd->keterangan = $request->keterangan;
   $cd->save();
   return 'sukses';
 }

 public function updateStorePeg(Request $request,$id){  //new
  $date = \Carbon\Carbon::now();
  $cd=presensi_pegawai::find($id);//mencari data yang paling depan
  $cd->jam_pulang = $date;
  $cd->save();

  $sum=DB::table('presensi_matkul_dosen')
  ->selectRaw('TIMEDIFF(jam_pulang,jam_masuk) as total')
  ->where('id_presensi_matkul',$id)
  ->get();

  $arr=[];
  foreach ($sum as $a) {
   array_push($arr,$a->total);
 }
 $arr = array_unique($arr);

 $update=DB::table('presensi_matkul_dosen')
 ->where('id_presensi_matkul',$id)
 ->update(['total' => $arr[0]]);
 
 return 'success';
}

 /*public function sum_jam_matkul($id){
$masuk=DB::table('presensi_matkul_dosen')
 ->selectRaw('TIMEDIFF(jam_pulang,jam_masuk) as total')
 ->where('id_presensi_matkul',$id)
 ->get();

 return $masuk;
}*/

public function krsPeg($id){

 $jd = DB::table('mata_kuliah')
 ->where('id_dosen',$id)
 ->get(['id_matkul', 'nama_matkul','kode_matkul']);
 return $jd;
}

    public function viewMatkulSelect($id){  //Mencari Matkul Berdsarkan Id
     $jd = DB::table('mata_kuliah')->where('id',$id)->get(['kode_matkul','matkul']);
     return $jd;
   }

   public function viewPeg($id)
   {
    $peg = pegawai::where('nip',$id)->get();

    return $peg;

  }

  public function viewkaryawan($id)
  {
    $cd = DB::table('karyawan')
    ->where('nip',$id)->get();

    return $cd;

  }

     //update generate
  public function update(Request $request,$id){

      $cd=presensi_pegawai::find($id);//mencari data yang paling depan
      $cd->id_dosen = $request->id_dosen;
      $cd->id_matkul = $request->id_matkul;
      $cd->generate = $request->generate;
      $cd->device = $request->device;
      $cd->keterangan = $request->keterangan;
      $cd->save();
      return 'sukses';
      
    }

    public function updatePre(Request $request,$id,$unix){

     //mencari data yang paling depan UPDATE `presensi_dosen` SET `generate`='ahgchjacghj' WHERE id = 278
     $cd=DB::table('presensi_dosen') 
     ->where('id_presensi_dosen','=',$id)
     ->update(['generate' => $unix]);

     return 'sukses';

   }

   public function ceksuksesPdos($id){

     $cd=presensi_dosen::find($id);

     return $cd;

   }
   public function cek_jam_masuk($id){
    $cd=DB::table('presensi_dosen') 
    ->where('id_presensi_dosen','=',$id)

    ->get(['created_at']);
    

  }

  public function ceksuksesPkar($id){

   $cd=presen_karyawan::find($id);
      /* $cd=DB::table('presensi_dosen') 
      ->where('id','=',$id)
      ->get('validasi');*/
      
      return $cd;

      
    }

 public function validasiPre(Request $request,$id,$unix){ //update presensi dosen untuk validasi success pada scanner
   $cd=DB::table('presensi_dosen') 
   ->where('generate','=',$id)
   ->where('id_presensi_dosen','=',$unix)
   ->update(['validasi'  => 'success']);

   return 'sukses';

 }



public function vkar(Request $request,$id,$unix){ //update presensi dosen untuk validasi success pada scanner
 $cd=DB::table('presensi_karyawan') 
 ->where('generate','=',$id)
 ->where('id_presensi_karyawan','=',$unix)
 ->update(['validasi'  => 'success']);

 return 'sukses';

}




public function updatePreKar(Request $request,$id,$unix){

     //mencari data yang paling depan UPDATE `presensi_dosen` SET `generate`='ahgchjacghj' WHERE id = 278
 $cd=DB::table('presensi_karyawan') 
 ->where('id_presensi_karyawan','=',$id)
 ->update(['generate' => $unix]);

 return 'sukses';

}
    //tambah jam per hari masuk
public function updateJam($id,$history,$jum){

     /* $cd=presensi_dosen::find($id);
         $cd->jumlah_masuk = $request->jumlah_masuk;
         $cd->save();*/
         $cd=DB::table('presensi_dosen') 
         ->where('id_presensi_dosen','=',$id)
         ->where('validasi','=','success')
         ->where('history','=',$history)
         ->update(['jumlah_masuk' => $jum]);
         return 'sukses';

       }


       public function updateJamkar($id,$history,$jum){

      /*$cd=presen_karyawan::find($id);
      $cd->jumlah_masuk = $request->jumlah_masuk;
      $cd->save();*/

      $cd=DB::table('presensi_karyawan') 
      ->where('id_presensi_karyawan','=',$id)
      ->where('history','=',$history)
      ->update(['jumlah_masuk' => $jum]);

     // ->update(['aprove' => 'success','materi' => $materi]);
       // $cd->save();


      return 'sukses';
      
    }

  //aprove absensi mhs
    public function aprove(Request $request,$id,$day,$materi){
//UPDATE `presensi` SET aprove = 'succes' WHERE id_matkul = '11' and days = 'rabu'
      $cd = DB::table('presensi_mahasiswa')
      ->where('id_matkul','=',$id)
      ->where('uniq','=',$day)
      ->update(['aprove' => 'success','materi' => $materi]);

      return 'sukses';
      
    }
  //tampi presensi dosen
    public function viewPresensi($id,$day,$i){

     $krs = DB::table('mahasiswa')
     ->join('presensi_mahasiswa', 'mahasiswa.nim', '=', 'presensi_mahasiswa.nim')
     ->where('presensi_mahasiswa.id_matkul', '=', $id)
     ->where('presensi_mahasiswa.uniq', '=', $i)
     ->orderBy('nim', 'desc')
     ->get(['presensi_mahasiswa.nim', 'mahasiswa.name','presensi_mahasiswa.days','presensi_mahasiswa.materi','presensi_mahasiswa.id_presensi_mhs','presensi_mahasiswa.aprove','presensi_mahasiswa.created_at']);

     return $krs;        


   }

  //tambah presensi dosen
   public function PresensiDosen(Request $request,$id1){

    $date = Carbon::now()->format('Y-m-d'); 

    $abb =  new presensi_dosen;
    $abb->id_dosen = $id1;
    $abb->generate = $request->generate;
    $abb->days = $request->days;
    $abb->validasi = $request->validasi;
    $abb->history = $request->history;
    $abb->time = $request->time;
    $abb->keterangan = $request->keterangan;
    $abb->tanggal = $date;
    $abb->save();
  }

 //tampi presensi dosen
  public function viewPresensiDosen($id,$day){

   $krs = DB::table('presensi_dosen')
   ->where('id_dosen', '=', $id)
   ->where('validasi', '=', 'success')
   ->where('days', '=', $day)
   ->orderBy('id_presensi_dosen', 'desc')
   ->limit(2)
   ->get();
   return $krs;        


 }
 

 public function viewPresensiDosenAll($id,$day){

   $krs = DB::table('presensi_dosen')
   ->where('id_dosen', '=', $id)
  //->where('days', '=', $day)
   ->orderBy('id', 'desc')
   ->limit(12)
   ->get();
   return $krs;        


 }
 
 public function viewPresensiKarAll($id,$day){

   $krs = DB::table('presensi_karyawan_umg')
   ->where('nip', '=', $id)
  //->where('days', '=', $day)
   ->orderBy('id', 'desc')
   ->limit(12)
   ->get();
   return $krs;        


 }
 
 //tampi presensi karyawan
 public function viewPresensiKaryawan($id,$day){


  $kr = DB::table('presensi_karyawan')
  ->where('id_karyawan', '=', $id)
  ->where('validasi', '=', 'success')
  ->where('days', '=', $day)
  ->orderBy('id_presensi_karyawan', 'desc')
  ->limit(2)
  ->get();
  return $kr;        


}
 //Tambah presensi karyawan
public function addPresensiK(Request $request,$nip){
  $date = Carbon::now()->format('Y-m-d'); 
 // return $date;
  $cd =  new presen_karyawan;
  $cd->id_karyawan = $nip;
  $cd->generate = $request->generate;
  $cd->device = $request->device;
  $cd->days = $request->days;
  $cd->history = $request->history;
  $cd->validasi = $request->validasi;
  $cd->time = $request->time;
  $cd->keterangan = $request->keterangan;
  $cd->tanggal = $date;

  $cd->save();

  return 'sukses';
}


    //tampi presensi karyawan
public function viewSumTime($id,$day){

  $orders = DB::table('presensi_dosen')
     //->selectRaw('SEC_TO_TIME(sum(TIME_TO_SEC(jumlah_masuk))) as timesum')
  ->where('id_dosen', '=', $id)
  ->where('validasi', '=', 'success')
  ->where('created_at','=',$day)
  ->get();

  return $orders; 
}


 //juml presensi dosen 6 hari
public function ViewSumWeek($id,$day){
 $kr = DB::table('presensi_dosen')
 ->selectRaw('SEC_TO_TIME(sum(TIME_TO_SEC(jumlah_masuk))) as timesum')
 ->where('id_dosen', '=', $id)
 ->where('validasi', '=', 'success')
 ->where('created_at','>=',$day)
   //->orderBy('id', 'desc')
    //->limit(12)
    ///->take(2)
 ->get();
 return $kr; 

}



public function Reportweek($id,$day){
 $kr = DB::table('presensi_karyawan_umg')
 ->selectRaw('SEC_TO_TIME(sum(TIME_TO_SEC(jumlah_masuk))) as timesum')
 ->where('nip', '=','nip')
 ->where('created_at','>=',$day)
 ->get();
 return $kr; 

}


 //juml presensi karyawan 6 hari
public function ViewSumWeeKar($id,$day){
 $kr = DB::table('presensi_karyawan')
 ->selectRaw('SEC_TO_TIME(sum(TIME_TO_SEC(jumlah_masuk))) as timesum')
 ->where('id_karyawan', '=', $id)
 ->where('validasi', '=', 'success')
 ->where('created_at','>=',$day)
 ->get();
 return $kr; 

}

 //tampil dosen
public function ViewWeek($id,$day){

  $krs = DB::table('presensi_dosen')
  ->where('id_dosen', '=', $id)
  ->where('created_at', '>=', $day)
  ->where('validasi', '=', 'success')
  ->orderBy('id_presensi_dosen', 'desc')
  ->limit(12)
  ->get();
  return $krs; 

}

public function ViewWeekKar($id,$day){

  $krs = DB::table('presensi_karyawan')
  ->where('id_karyawan', '=', $id)
  ->where('created_at', '>=', $day)
  ->where('validasi', '=', 'success')
  ->orderBy('id_presensi_karyawan', 'desc')
  ->limit(12)
  ->get();
  return $krs; 

}
  public function cekmatkul($id1,$idm){  //mnegecek materi pada matkul dengan parameter id matkul dan nip

    $edi= DB::table('presensi_matkul_dosen')
    ->join('mata_kuliah', 'presensi_matkul_dosen.id_matkul', '=','mata_kuliah.id')
    ->where('mata_kuliah.nip', '=', $id1)
    ->where('presensi_matkul_dosen.id_matkul', '=', $idm)
    ->get(['presensi_matkul_dosen.id','presensi_matkul_dosen.id_matkul','mata_kuliah.matkul','presensi_matkul_dosen.materi','presensi_matkul_dosen.created_at']); 

    return $edi;
  }

  public function addMateri(Request $request,$id,$materi)
 { //update materi pada presensi matkul dosen pada saat aprove
  $cd = DB::table('presensi_matkul_dosen')
  ->where('id_presensi_matkul','=',$id)
  ->update(['materi' => $materi]);

  return 'sukses';
}

 public function selectmat($id1){  //Mencari Data Presensi matkul dosen dengan id matkul

   $cd = DB::table('presensi_matkul_dosen')
   ->where('id_matkul','=',$id1)
   ->orderBy('id', 'desc')
   ->get();
   return $cd;
 }
 public function jabatan(){  //Mencari Data Presensi matkul dosen dengan id matkul
  Session::forget('message');
  Session::forget('total_sks');
  $cd = DB::table('jabatan')
  ->get();
  return view('jabatan',['jabatan'=> $cd]);
}
 public function jabatan_Edit(Request $request,$id){  //Mencari Data Presensi matkul dosen dengan id matkul
   $validator = Validator::make($request->all(),
     [
       'jumlah_jam'=> 'required|integer',
       'jumlah_hari_1_minggu' => 'required|integer'
     ]
   );
   $errors = $validator->errors();
   $err = $errors->first('jumlah_jam');
   $err1 = $errors->first('jumlah_hari_1_minggu');

   if($err == "The jumlah jam must be an integer." || $err == "The jumlah hari 1 minggu must be an integer.")
   {
    return redirect('/jabatan')->with('error', 'Mohon isi angka..!'); 
  }

  if ($validator->fails()) {
   return redirect('/jabatan')->with('error', 'Mohon isi semua data..!'); 
 }
   function hour_min($minutes){// Total
     if($minutes <= 0) return '00:00';
     else    
       return sprintf("%02d",floor($minutes / 60)).':'.sprintf("%02d",str_pad(($minutes % 60), 2, "0", STR_PAD_LEFT));
   }

   $jumlah_jam = $request->jumlah_jam;
   echo $jumlah_jam;
   $jumlah_hari_1_minggu = $request->jumlah_hari_1_minggu;

   $menit = $jumlah_jam * 60;
   $perhari = $menit / $jumlah_hari_1_minggu;
   $jam_perhari = hour_min($perhari);

   $cd = jabatan::find($id);
   
   $cd->jumlah_jam = $jumlah_jam;
   $cd->jumlah_hari_1_minggu = $jumlah_hari_1_minggu;
   $cd->jam_perhari = $jam_perhari;

   $cd->save();

   return redirect('jabatan')->with('info', 'UPDATE BERHASIL'); 
 }

 public function periode(){  //Mencari Data Presensi matkul dosen dengan id matkul 
  Session::forget('message');
  Session::forget('total_sks');
  $pr = periode::all();
  return view('periode',['periode'=> $pr]);
}
public function periode_matkul(){  //Mencari Data Presensi matkul dosen dengan id matkul 
  Session::forget('message');
  Session::forget('total_sks');
  $mat = DB::table('periode_matkul')
  ->get();

  return view('periode_matkul',['periode'=> $mat]);
}

public function periode_post(Request $request){
  $validator = Validator::make($request->all(),
   [
     'nama_periode'=> 'required',
     'awal_periode'=>'required',
     'akhir_periode' => 'required',
     'jumlah_hari_libur' => 'required|integer'
   ]
 );
  $errors = $validator->errors();
  $err = $errors->first('jumlah_hari_libur');

  if($err == "The jumlah hari libur must be an integer.")
  {
    return redirect('/periode')->with('error', 'Mohon isi angka untuk jumlah hari libur'); 
  }

  if ($validator->fails()) {
   return redirect('/periode')->with('error', 'Mohon isi semua data..!'); 
 }
  //echo $request->jumlah_hari_libur;;
 $abb =  new periode;
 $abb->nama_periode = $request->nama_periode;
 $abb->awal_periode= $request->awal_periode;
 $abb->akhir_periode= $request->akhir_periode;
 $abb->jumlah_hari_libur = $request->jumlah_hari_libur;
 $abb->save();
 return redirect('/periode')->with('info', 'BERHASIL');  
}
public function periode_Edit(Request $request,$id){
 $abb =periode::find($id);
 $validator = Validator::make($request->all(),
   [
     'nama_periode'=> 'required',
     'awal_periode'=>'required',
     'akhir_periode' => 'required',
     'jumlah_hari_libur' => 'required|integer'
   ]
 );
 $errors = $validator->errors();
 $err = $errors->first('jumlah_hari_libur');

 if($err == "The jumlah hari libur must be an integer.")
 {
  return redirect('/periode')->with('error', 'Mohon isi angka untuk jumlah hari libur'); 
}

if ($validator->fails()) {
 return redirect('/periode')->with('error', 'Mohon isi semua data..!'); 
}

$abb->nama_periode = $request->nama_periode;
$abb->awal_periode= $request->awal_periode;
$abb->akhir_periode= $request->akhir_periode;
$abb->jumlah_hari_libur = $request->jumlah_hari_libur;
$abb->save();
return redirect('/periode')->with('info', 'UPDATE BERHASIL'); 
} 

public function periode_delete($id){
  $del=periode::find($id)->delete();

  if ($del == true) {
    return redirect('/periode')->with('info', 'DELETE BERHASIL'); 
  }
  return redirect('/periode')->with('error', 'Delete Error');   
}

public function hitung_periode(Request $request){

  //echo $request->role_periode;
  $cd = periode::find($request->role_periode);


  $fdate =$cd->awal_periode;
  $tdate = $cd->akhir_periode;
  $datetime1 = new DateTime($fdate);
  $datetime2 = new DateTime($tdate);
  $interval = $datetime1->diff($datetime2);
  $days = $interval->format('%a');

  $hari_aktif = $days - $cd->jumlah_hari_libur;
 //echo $sum;


  $i = Session::get('id_dosen');
  if ($i == null) {
    $i = Session::get('id_dos');
  }

  $total_jam = DB::table('presensi_dosen')
  ->selectRaw('SEC_TO_TIME(sum(TIME_TO_SEC(jumlah_masuk))) as timesum')
  ->where('id_dosen', '=',$i)
  ->where('created_at','<=',$tdate)
  ->where('created_at','>=',$fdate)
  ->where('validasi','=','success')  
  ->get();


  $total_jam = json_decode($total_jam, true);
  $total_jam = $total_jam[0]["timesum"];


  $jam_perhari = DB::table('Dosen')
  ->join('jabatan', 'Dosen.id_jabatan', '=', 'jabatan.id_jabatan')
  ->where('Dosen.id_dosen', '=',$i)
  ->get();

  $jam_perhari = json_decode($jam_perhari, true);
  $jam_perhari = $jam_perhari[0]["jam_perhari"];

  function hitung_menit($minutes){
    $str_time = $minutes;

    sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);

    $time_seconds = isset($hours) ? $hours * 60 + $minutes * 1 + $seconds : $minutes * 0 + $seconds;
    return $time_seconds;
  }

  function menit_jam($minutes){// Total
   if($minutes <= 0) return '00:00';
   else    
     return sprintf("%02d",floor($minutes / 60)).':'.sprintf("%02d",str_pad(($minutes % 60), 2, "0", STR_PAD_LEFT));
 }

 $Dos = Dosen::find($i);
 $Dosen = DB::table('pdanpdbn')
 ->where('Dosen', '=', $i)
 ->where('tanggal','<=',$tdate)
 ->where('tanggal','>=',$fdate)
 ->get();

 Session::put('a', $tdate);  
 Session::put('b', $fdate);
 $hasil_hari = count($Dosen);

 $minimal = hitung_menit($jam_perhari);
 $hasil_hitung = hitung_menit($total_jam);

 $minimal = $minimal * $hari_aktif;

 $jumlah_jam_kerja = menit_jam($hasil_hitung);

 $minimal_jam_kerja_periode = menit_jam($minimal);

 if($hasil_hitung >= $minimal && $hasil_hari >= $hari_aktif) {
   $message =    "AMAN";
   $total_jam;
   $hasil_hari;
   Session::put('Total_jam', $total_jam); 
   Session::put('total_hari', $hasil_hari); 
   Session::put('hari_aktif', $hari_aktif); 
   Session::put('message', $message);

 }
 else {
  $message =  "PERINGATAN";
  $total_jam;
  $hasil_hari;
  Session::put('Total_jam', $total_jam); 
  Session::put('total_hari', $hasil_hari); 
  Session::put('hari_aktif', $hari_aktif); 
  Session::put('message', $message);
}

//dd($Dosen);
$periode= DB::table('periode')
->get();


$Db= DB::table('presensi_dosen')
->where('id_dosen', '=', $i)
->where('validasi', '=', 'success')
->get();

$datatahun = [];
$databulan = [];
$databulan1 = [];

foreach ($Db as $d ) {

  $tahun = \Carbon\Carbon::parse($d->created_at)->format('Y');
  array_push($datatahun,$tahun);
}

foreach ($Db as $m ) {
  $bulan = \Carbon\Carbon::parse($m->created_at)->format('F');
  array_push($databulan,$bulan);
}

$datatahun = array_unique($datatahun);
$databulan = array_unique($databulan);
$databulan1 = array_unique($databulan1);
return view('reportdos',['Dosen'=> $Dosen,'Dos'=> $Dos,'D'=> $datatahun, 'M'=> $databulan,'periode'=> $periode,'message'=> $message,'total'=> $total_jam,'hari_aktif'=>$hasil_hari])->with('message', $message); 
}



public function hitung_periode_kar(Request $request){

  //echo $request->role_periode;
  $cd = periode::find($request->role_periode);


  $fdate =$cd->awal_periode;
  $tdate = $cd->akhir_periode;
  $datetime1 = new DateTime($fdate);
  $datetime2 = new DateTime($tdate);
  $interval = $datetime1->diff($datetime2);
  $days = $interval->format('%a');

  $hari_aktif = $days - $cd->jumlah_hari_libur;

  $i = Session::get('id_karyawan');

  $total_jam = DB::table('presensi_karyawan')
  ->selectRaw('SEC_TO_TIME(sum(TIME_TO_SEC(jumlah_masuk))) as timesum')
  ->where('id_karyawan', '=', $i)
  ->where('created_at','<=',$tdate)
  ->where('created_at','>=',$fdate)
  ->where('validasi','=','success') 
  ->get();

//echo $kar;
  $total_jam = json_decode($total_jam, true);
  $total_jam = $total_jam[0]["timesum"];


  $jam_perhari = DB::table('karyawan')
  ->join('jabatan', 'karyawan.id_jabatan', '=', 'jabatan.id_jabatan')
  ->where('karyawan.id_karyawan', '=',$i)
  ->get();

  $jam_perhari = json_decode($jam_perhari, true);
  $jam_perhari = $jam_perhari[0]["jam_perhari"];

  function hitung_menit($minutes){
    $str_time = $minutes;

    sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);

    $time_seconds = isset($hours) ? $hours * 60 + $minutes * 1 + $seconds : $minutes * 0 + $seconds;
    return $time_seconds;
  }

  function menit_jam($minutes){// Total
   if($minutes <= 0) return '00:00';
   else    
     return sprintf("%02d",floor($minutes / 60)).':'.sprintf("%02d",str_pad(($minutes % 60), 2, "0", STR_PAD_LEFT));
 }
 Session::put('Ka', $fdate);  
 Session::put('Kb', $tdate);

 $kar = DB::table('pkanpkbn')
 ->join('Karyawan', 'pkanpkbn.karyawan', '=', 'karyawan.id_karyawan')
 ->where('karyawan', '=', $i)
 ->where('tanggal','<=',$tdate)
 ->where('tanggal','>=',$fdate)
 ->get();
 $hasil_hari = count($kar);
 $minimal = hitung_menit($jam_perhari);
 $hasil_hitung = hitung_menit($total_jam);

 $minimal = $minimal * $hari_aktif;

 $jumlah_jam_kerja = menit_jam($hasil_hitung);
 $minimal_jam_kerja_periode = menit_jam($minimal);

 if($hasil_hitung >= $minimal && $hasil_hari >= $hari_aktif) {
   $message =    "AMAN";
   $total_jam;
   $hasil_hari;
   Session::put('Totalk', $total_jam); 
   Session::put('total_hari_kar', $hasil_hari); 
   Session::put('hari_kar_aktif', $hari_aktif); 
   Session::put('message', $message);

 }
 else {
  $message =  "PERINGATAN";
  $total_jam;
  $hasil_hari;
  Session::put('Totalk', $total_jam); 
  Session::put('total_hari_kar', $hasil_hari); 
  Session::put('hari_kar_aktif', $hari_aktif); 
  Session::put('message', $message);
}

$karFil = DB::table('presensi_karyawan')
->where('id_karyawan', '=', $i)
->where('validasi', '=', 'success')
->orderBy('id_presensi_karyawan', 'desc')
->get();

$periode= DB::table('periode')
->get();

$datatahun = [];
$databulan = [];

foreach ($karFil as $d ) {

  $tahun = \Carbon\Carbon::parse($d->created_at)->format('Y');
  array_push($datatahun,$tahun);
}

foreach ($karFil as $m ) {

  $bulan = \Carbon\Carbon::parse($m->created_at)->format('F');
  array_push($databulan,$bulan);

}

$datatahun = array_unique($datatahun);
$databulan = array_unique($databulan);

return view('PresensiKar',['kar'=> $kar,'D'=> $datatahun,'M'=> $databulan,'periode'=> $periode,'message'=> $message,'total'=> $total_jam,'hari_aktif'=>$hasil_hari])->with('message', $message); 

}

public function periode_matkul_post(Request $request){
 $validator = Validator::make($request->all(),
   [
     'nama_periode'=> 'required',
     'periode_awal'=>'required',
     'periode_akhir' => 'required',
     'jumlah_sks' => 'required|integer'
   ]
 );
 $errors = $validator->errors();
 $err = $errors->first('jumlah_sks');

 if($err == "The jumlah sks must be an integer.")
 {
  return redirect('/periode_matkul')->with('error', 'Mohon isi angka untuk jumlah SKS'); 
}

if ($validator->fails()) {
 return redirect('/periode_matkul')->with('error', 'Mohon isi semua data..!'); 
}

$abb =  new periode_matkul;
$abb->nama_periode = $request->nama_periode;
$abb->periode_awal= $request->periode_awal;
$abb->periode_akhir= $request->periode_akhir;
$abb->jumlah_sks = $request->jumlah_sks;
$abb->save();

 //$message = 'SUCCESS';
return redirect('/periode_matkul')->with('info', 'BERHASIL');  
}

public function periode_matkul_Edit(Request $request,$id){
 $abb =periode_matkul::find($id);
 $validator = Validator::make($request->all(),
   [
     'nama_periode'=> 'required',
     'periode_awal'=>'required',
     'periode_akhir' => 'required',
     'jumlah_sks' => 'required|integer'
   ]
 );
 $errors = $validator->errors();
 $err = $errors->first('jumlah_sks');

 if($err == "The jumlah sks must be an integer.")
 {
  return redirect('/periode_matkul')->with('error', 'Mohon isi angka untuk jumlah SKS'); 
}

if ($validator->fails()) {
 return redirect('/periode_matkul')->with('error', 'Mohon isi semua data..!'); 
}

$abb->nama_periode = $request->nama_periode;
$abb->periode_awal= $request->periode_awal;
$abb->periode_akhir= $request->periode_akhir;
$abb->jumlah_sks = $request->jumlah_sks;
$abb->save();
$message = 'SUCCESS';
return redirect('/periode_matkul')->with('info', 'UPDATE BERHASIL'); 
} 

public function periode_matkul_delete($id){
  $del=periode_matkul::find($id)->delete();
  if ($del == true) {
    return redirect('/periode_matkul')->with('info', 'DELETE BERHASIL'); 
  }
  return redirect('/periode_matkul')->with('error', 'Delete Error');
}
public function hitung_periode_matkul(Request $request){
  $id = Session::get('id_dosen');
  $id1 = Session::get('id_matkul');
//dd($id);

  $cd = periode_matkul::find($request->periode_matkul);

  $fdate = $cd->periode_awal;
  $tdate = $cd->periode_akhir;
  $sks = $cd->jumlah_sks;
  Session::put('awal', $fdate); 
  Session::put('akhir', $tdate); 

  $result = DB::table('presensi_matkul_dosen')
  ->join('mata_kuliah','presensi_matkul_dosen.id_matkul','=','mata_kuliah.id_matkul')
  ->selectRaw('sum(mata_kuliah.sks) as skssum')
  ->where('presensi_matkul_dosen.id_dosen',$id)
  ->where('mata_kuliah.id_matkul',$id1)
  ->where('presensi_matkul_dosen.jam_masuk','<=',$tdate)
  ->where('presensi_matkul_dosen.jam_pulang','>=',$fdate)
  ->get();

  $jam = DB::table('presensi_matkul_dosen')
  ->join('mata_kuliah','presensi_matkul_dosen.id_matkul','=','mata_kuliah.id_matkul')
  ->selectRaw('SEC_TO_TIME(sum(TIME_TO_SEC(total))) as timesum')
  ->where('presensi_matkul_dosen.id_dosen',$id)
  ->where('mata_kuliah.id_matkul',$id1)
  ->where('presensi_matkul_dosen.jam_masuk','<=',$tdate)
  ->where('presensi_matkul_dosen.jam_pulang','>=',$fdate)
  ->get();
  //dd($jam);

  $Dosen = DB::table('presensi_matkul_dosen')
  ->join('mata_kuliah','presensi_matkul_dosen.id_matkul','=','mata_kuliah.id_matkul')
  ->where('presensi_matkul_dosen.id_dosen',$id)
  ->where('mata_kuliah.id_matkul',$id1)
  ->where('presensi_matkul_dosen.jam_masuk','<=',$tdate)
  ->where('presensi_matkul_dosen.jam_pulang','>=',$fdate)
  ->get();

  $hasil_hari = count($Dosen);

  $arr=[];
  foreach ($result as $a) {
   array_push($arr,$a->skssum);
 }
 $arr = array_unique($arr);


//dd($arr[0]);
 $sum = $arr[0];
 if ($sks<$sum) {
   $a = $sum;
   $message = 'PERINGATAN';
   Session::put('total_sks', $a);
   Session::put('message', $message);
 }else{
  $a = $sum;
 // dd($a);
  $message = 'AMAN';
  Session::put('total_sks', $a);
  Session::put('message', $message);
}


$periode = DB::table('periode_matkul')
->get();

$Matkul = DB::table('presensi_matkul_dosen')
->where('id_matkul','=',$id1)
->where('jam_masuk','<=',$tdate)
->where('jam_pulang','>=',$fdate)
->get();


$datatahun = [];
foreach ($Matkul as $d ) {
  $tahun = \Carbon\Carbon::parse($d->created_at)->format('Y');
  array_push($datatahun,$tahun);
}
$datatahun = array_unique($datatahun);

return view('MatkulPage',['Matkul'=> $Matkul,'Dosen'=> $Dosen,'D'=> $datatahun,'periode_matkul'=> $periode,'total'=> $a,'hari_aktif'=>$hasil_hari])->with('message', $message); 

}

public function cek_presensi_matkul($id){
 $Dosen = presensi_pegawai::where('id_dosen',$id)
 ->orderBy('id_presensi_matkul', 'desc')
 ->first();
  //dd($Dosen);
 return $Dosen;
}

public function labelkaryawan($id)
  {
    $cd = DB::table('karyawan')
    ->where('nip',$id)->get();

    

    return $cd;

  }


}

