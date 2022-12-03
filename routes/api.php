<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
	return $request->user();

});

Route::get('/cekMat/{id}', 'HomeController@viewMatkulSelect');//Mencari Matkul Berdsarkan Id

Route::get('/select/{id}', 'HomeController@selectmat');///Mencari Data Presensi matkul dosen dengan id matkul


Route::put('/validasiPre{unix}/{id}', 'HomeController@validasiPre'); ////update presensi dosen untuk validasi success pada scanner

Route::put('/valPreKar{id}/{un}', 'HomeController@vkar');

Route::put('/setMatkul{id}/{materi}', 'HomeController@addMateri');//update materi pada presensi matkul dosen pada saat aprove

//----------------View Blade----------------------------------------------------//

Route::get('/cekmat/{id}/{id1}', 'HomeController@cekmatkul'); //mnegecek materi pada matkul dengan parameter id matkul dan nip
Route::get('/ReportPeg', 'HomeController@ReportPeg');	////menampilkan data karyawan umg
Route::get('/ReportDos', 'HomeController@ReportDos');	////menampilkan data Dosen

//--------------------------------------------------------------------//



Route::get('/karyawan{id}', 'HomeController@viewkaryawan'); //menampilkan table karyawan
Route::get('/karyawanHIstory{id}/{day}', 'HomeController@viewPresensiKaryawan');    //menampilkan presensi karyawan di list berdsarkan hari sekarang

Route::post('/addkaryawan{id}', 'HomeController@addPresensiK');//menambah data di table karywan

Route::put('/set{id}/{day}/{materi}', 'HomeController@aprove');//aprove untuk mhs yang masuk kuliah

Route::get('/viewweek{id}/{day}', 'HomeController@ViewWeek');//menampilkan presensi dosen dari 6 hari yang lalu

Route::get('/viewPkar{id}/{day}', 'HomeController@ViewWeekKar');//menampilkan presensi karyawan dari 6 hari yang lalu

Route::get('/sukses/{id}', 'HomeController@ceksuksesPdos');

Route::get('/sukPkar/{id}', 'HomeController@ceksuksesPkar');

Route::get('/SumTimeweek{id}/{day}', 'HomeController@ViewSumWeek');//menampilkan jam kerja selama 6 hari dosen

Route::get('/SumTimekar{id}/{day}', 'HomeController@ViewSumWeeKar');////menampilkan jam kerja selama 6 hari karyawan

Route::get('/SumTime{id}/{day}', 'HomeController@viewSumTime');//menampilkan jam masuk 1 hari dosen

Route::post('/presensidosen{id}' , 'HomeController@PresensiDosen');//menambah data presensi dosen

Route::get('/cekday/{id}/{day}', 'HomeController@viewPresensiDosenAll');//menampilkan data presensi dosen untuk disaring paling baru

Route::get('/cekdayKar/{id}/{day}', 'HomeController@viewPresensiKarAll');//menampilkan data presensi karyawan untuk disaring paling baru

Route::get('/cekkarPre/{id}', 'HomeController@upKar');//mencari data presensi_matkul_dosen
Route::get('/cek/{id}', 'HomeController@up');//mencari data presensi_matkul_dosen
Route::get('/cekPre/{id}', 'HomeController@upPre');//mencari data presensi_dosen
Route::get('/previewdosen{id}/{day}', 'HomeController@viewPresensiDosen');//menampilkan data presensi dosen masuk/pulang
Route::get('/presensi{id}/{day}/{i}', 'HomeController@viewPresensi');//view presensi berdasarkan mhs yang ambil matkul

Route::post('/PresensiMatkul{id}/{id1}' , 'HomeController@storePeg');//menambah data presensi dosen matkul

Route::put('/UpdatePresensiMatkul/{id}' , 'HomeController@updateStorePeg'); //update pulang matkul NEW

//Route::put('/sum_matkul/{id}' , 'HomeController@sum_jam_matkul'); //update pulang matkul



Route::post('/presensi{id}/{id1}' , 'HomeController@addCode');// menambah data mhs dengan scan barcode
Route::post('/add{id}' , 'HomeController@add');//add
Route::post('/addKet/{id}' , 'HomeController@ket');//add keterangan
Route::get('/matkul/{id}', 'HomeController@krs');
Route::get('/view{id}', 'HomeController@view');
Route::get('/peg{id}', 'HomeController@viewpeg');
Route::get('/jadwal{id}', 'HomeController@krsPeg');//presensi 
Route::get('/getEdit{id}', 'HomeController@Edit');

Route::get('/user/{id}', 'HomeController@ketUser');

Route::put('/updateCode{id}', 'HomeController@update');
Route::put('/updatePreKar{id}/{un}', 'HomeController@updatePreKar');
Route::put('/updatePre{id}/{un}', 'HomeController@updatePre');
Route::put('/updateJam/{id}/{h}/{jum}', 'HomeController@updateJam');
Route::put('/updateJamkar/{id}/{h}/{jum}', 'HomeController@updateJamkar');

/*Route::post('/create' , 'RegisterController@store');*/
Route::delete('/delete{id}' , 'HomeController@delete');

/*Route::post('/login/{id1}/{id}' , 'LoginController@Login');
*/
Route::post('login', 'LoginController@Login');	//login mobile
Route::get('cekAll/{id}', 'LoginController@cekAll'); //cek akses
Route::get('cekdos/{id}', 'LoginController@cekdos');//login presensi
Route::get('cekar/{id}', 'LoginController@cekar');	//login presensi  
Route::get('cekAll/{id}', 'LoginController@cekAll'); //cek akses
Route::get('cek_presensi_matkul/{id}', 'HomeController@cek_presensi_matkul');
Route::post('register', 'RegisterController@store');

Route::get('getlabel/{id}', 'HomeController@labelkaryawan'); //cek akses


Route::group(['middleware' => 'auth:api'], function(){

	

});