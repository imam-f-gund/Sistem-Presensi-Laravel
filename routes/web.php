<?php


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('Auth/login');
});




Auth::routes();

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/DasbordTu/{id}', 'HomeController@DBTu');
Route::get('/reportingTU', 'HomeController@ReporTU');////
Route::get('/Pgsd/{id}', 'HomeController@FakPgsd');

Route::get('/RepotKaryawan', 'HomeController@ReportPeg');
Route::get('/RepotDosen', 'HomeController@ReportDos');
Route::get('/RepotDosen/null', 'HomeController@ReportDos');
Route::get('/RepotDosenMat/null', 'HomeController@ReporTU');////
Route::get('/RepotDosen/{id}', 'HomeController@ReportDosFil');
Route::get('/RepotDosenMat/{id}', 'HomeController@ReportDosMatFil');
Route::get('/TU', 'HomeController@ReportMatDos');

//dos
Route::get('/reportdos/{id}', 'HomeController@showPre');
Route::get('/reportdos', 'HomeController@showPreR');		//bsdm
//kar
Route::get('/reportMatdos/{id}', 'HomeController@showMat');
Route::get('/reportKaryawan/{id}', 'HomeController@showMat');


Route::get('/matkul/{id}', 'HomeController@selectmatView');
Route::get('/MPresensiMhs/{id}/{i}', 'HomeController@MPresensiMhs');
Route::get('/PresensiKar/{id}', 'HomeController@PresensiKar');
Route::get('/PresensiKar', 'HomeController@PresensiR');

Route::get('/home', 'HomeController@bsdm');
Route::get('/homeKar', 'HomeController@chartKar');
//export
Route::get('downloadExcel/{type}', 'HomeController@downloadExcel');
Route::get('downloadExcelKar/{type}', 'HomeController@downloadExcelKar');
Route::get('downloadExcelDos/{type}', 'HomeController@downloadExcelDos');
Route::get('downloadExcelMatDos/{type}', 'HomeController@downloadExceMatlDos');

Route::get('filter/{id}/{th}', 'HomeController@filter');		//BSDM FILTER
Route::get('filterKar/{id}/{th}', 'HomeController@filterKar');


Route::post('/create' , 'HomeController@store');
Route::post('/Postregister', 'RegisterController@store');

Route::get('chart', 'ChartController@index');
//sum
Route::get('/totalkar/{id}/{id1}', 'HomeController@sumkar');
Route::get('/totalkarF/{id}/{id1}', 'HomeController@sumkarFil');
Route::get('/totaldos/{id}/{id1}', 'HomeController@sumdos');		//total presensi dosen
Route::get('/totaldosF/{id}/{id1}', 'HomeController@sumdosFil');		//BSDM rage

Route::get('/dosen/{id}', 'HomeController@sumdosFil');
//report dosen
Route::get('/RepotDosenID/{id}', 'HomeController@DosenID');		//dosen by id
Route::get('/RepotDosenIDAll', 'HomeController@RepotDosenIDAll');
Route::get('/filter/{id}', 'HomeController@filterYear');		//bsdm
Route::get('/matkulID/{id}', 'HomeController@matkulID');
Route::get('/filterThMat/{id}', 'HomeController@filterYearMat');
Route::get('/matkulR', 'HomeController@selectmatViewR');
Route::get('/reportdosR', 'HomeController@showPreDos');			//bsdm
//report kar 
Route::get('/RepotKaryawanID/{id}', 'HomeController@ReportPegID');
Route::get('/filterKarY/{id}', 'HomeController@filterKarYear');
Route::get('/total/{id}', 'HomeController@getotal');		//send total  


Route::get('/jabatan' , 'HomeController@jabatan');
Route::get('/periode' , 'HomeController@periode');
Route::put('/periode/{id}' , 'HomeController@periode_edit');
Route::put('/jabatan/{id}' , 'HomeController@jabatan_Edit');
Route::post('/periode_post' , 'HomeController@periode_post');
Route::post('/hitung_periode' , 'HomeController@hitung_periode');
Route::delete('/periode_delete/{id}' , 'HomeController@periode_delete');

Route::post('/hitung_periode_kar' , 'HomeController@hitung_periode_kar');

Route::get('/periode_matkul' , 'HomeController@periode_matkul');

Route::post('/periode_post_matkul' , 'HomeController@periode_matkul_post');
Route::put('/periode_matkul/{id}' , 'HomeController@periode_matkul_Edit');
Route::delete('/periode_Matkul_delete/{id}' , 'HomeController@periode_matkul_delete');
Route::post('/hitung_sks' , 'HomeController@hitung_periode_matkul');

Route::get('/face_post' , 'HomeController@face_post');

Route::get('/hhh', function () {

    return view('face');
});


/*Route::get('/coba', function () {
    return view('/coba');
});
*/