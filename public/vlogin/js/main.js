var baseUrl = "http://localhost";
var apiLogin = baseUrl + "/api/login";
var apiRegister = baseUrl + "/api/register";
var apiCekDataDosen = baseUrl + "/api/peg";
var apicekJadwal = baseUrl + "/api/jadwal";
var apiPresensiMatkul = baseUrl + "/api/PresensiMatkul";
var apiListMahasiswa = baseUrl + "/api/cek";
var apiCekPresensiMhs = baseUrl + "/api/presensi";
var apiKeteranganPresensi = baseUrl + "/api/addKet";
var apiSetMatkul = baseUrl + "/api/setMatkul";
var apiSet = baseUrl + "/api/set";
var apiPresensiDosen = baseUrl + "/api/presensidosen";
var apiPresensiToday = baseUrl + "/api/previewdosen";
var apiPresensiWeek = baseUrl + "/api/viewweek";
var apiHitungWeek = baseUrl + "/api/SumTimeweek";
var apiDataKaryawan = baseUrl + "/api/karyawan";
var apiPresensiKaryawan = baseUrl + "/api/addkaryawan";
var apiPresensiKaryawanToday = baseUrl + "/api/karyawanHIstory";
var apiPresensiKaryawanWeek = baseUrl + "/api/viewPkar";
var apiHitungKaryawanWeek = baseUrl + "/api/SumTimekar";
var apiCekDataUser = baseUrl + "/api/view";
var apiScanMahasiswa = baseUrl + "/api/add";
var apiCekSukses = baseUrl + "/api/sukses";
var apiCekPresensiTerakhir = baseUrl + "/api/cekPre";
var apiUpdateTotal = baseUrl + "/api/updateJam";
var apiCekPresensiKaryawan = baseUrl + "/api/cekkarPre";
var apiCekSuksesKaryawan = baseUrl + "/api/sukPkar";
var apiUpdateTotalKaryawan = baseUrl + "/api/updateJamkar";

document.addEventListener("deviceready", onDeviceReady, false);

$body = $("body");

$(document).on({
	ajaxStart: function() { $body.addClass("loading");    },
	ajaxStop: function() { $body.removeClass("loading"); }    
});

function onDeviceReady(){
  document.addEventListener("backbutton", function(e){
   if($.mobile.activePage.is('#homepage')){
     e.preventDefault();
     navigator.app.exitApp();
   }
   else {
     navigator.app.backHistory()
   }
 }, false);
}

const ptr = PullToRefresh.init({
 mainElement: 'body',
 onRefresh() {
  window.location.reload();
}
});

$(document).on({
 ajaxStart: function() { $body.addClass("loading"); },
 ajaxStop: function() { $body.removeClass("loading"); }    
});

$("#login").click(function(){ 
 var username=$("#username").val();
 var password=$("#password").val();

 var dataString="username="+username+"&password="+password;
 ;
 if($.trim(username).length>0 && $.trim(password).length>0 ) {
  $.ajax({
   type: "post",
   url: apiLogin,
   data: dataString,
   crossDomain: true,
   cache: false,
   beforeSend: function(){

   },
   success: function(data){
				//alert(data);
				$("#messege").hide();

				localStorage.setItem("role_id", data["role_id"]);
				localStorage.setItem("username", data["username"]);
				localStorage.setItem("user_id", data["user_id"]);

				var dataDosen = apiCekDataDosen + localStorage.getItem('username');

				if (data["role_id"] == "1") {

					$.getJSON( dataDosen, function( hasil ) {
						var id_dosen = hasil[0]["id_dosen"];

						localStorage.setItem("id_dosen", id_dosen);

						console.log(id_dosen);
						
						if (id_dosen > 0){
							window.location="dosen/index.html";
						}
						else {
							alert("Maaf data tidak tersimpan, silahkan login kembali.");
						}
					});
				}

				else if (data["role_id"] == "2") {
					var username = localStorage.getItem('username');

					var url = apiDataKaryawan + username;
					$.getJSON( url, function( hasil ) {
						var id_karyawan = hasil[0]["id_karyawan"];

						localStorage.setItem("id_karyawan", id_karyawan);

						console.log(id_karyawan);
						
						if (id_karyawan > 0){
							window.location="karyawan/index.html";
						}
						else {
							alert("Maaf ada kendala pada sistem yang mengharuskan anda mengulangi proses login.");
						}
					});
				}

				else if (data["role_id"] == "3") {
					window.location="mahasiswa/index.html";
				}

				else {
					alert("Sistem sedang error, User tidak ditemukan");
				}

			},
			error: function(err){
				//console.log(err);
				if (err.status = '401') {
					$("#messege").show();
					//alert('maaf nim atau password anda salah..!');
					$(".loader").hide();
					$("#spin").hide();
				}
				else if (err.status == '500') {
					$("#messege2").show();
					//alert('periksa koneksi anda..!');
					$(".loader").hide();
					$("#spin").hide();
				}           
			}
		});
}
return false;
});

$("#scanpresensi").click(function(){ 
 cordova.plugins.barcodeScanner.scan(
  function (result) {
   if(!result.cancelled)
   {
    if(result.format == "QR_CODE")
    {

     var value = result.text;

     alert(value);
   }
 }
},
function (error) {
 alert("Scanning failed: " + error);
}
);
});

$("#daftar").click(function(){
 var username=$("#username").val();
 var email=$("#email").val();
 var password=$("#password").val();

 var dataString="username="+username+"&email="+email+"&password="+password;

 if($.trim(username).length>0 && $.trim(email).length>0 && $.trim(password).length>0 ) {
  $.ajax({
   type: "post",
   url: apiRegister,
   data: dataString,
   crossDomain: true,
   cache: false,
   beforeSend: function(){

   },
   success: function(data){
    $("#Register").html("Buat Akun");
    alert('success');
    window.location="index.html";  
  },
  error: function(err){
    $("#Register").html("Error");
    $("#messeges").show();              
  }
});
}
return false;
});

$('#showpwd').click(function(){
 if($(this).is(':checked')){
  $('#psp').attr('type','text');
}else{
  $('#psp').attr('type','password');
}
});

$("#Batal").click(function(){ 
 window.location="index.html";
});

var qrcode = new QRCode("qrcode");

function codeGenerate(length) {
 var result           = '';
 var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
 var charactersLength = characters.length;
 for ( var i = 0; i < length; i++ ) {
  result += characters.charAt(Math.floor(Math.random() * charactersLength));
}
return result;
}

function makeCode() {
 var codeSet = codeGenerate(32);
 qrcode.makeCode(codeSet);
 return codeSet;
}

function toTitleCase(str) {
 return str.replace(/(?:^|\s)\w/g, function(match) {
  return match.toUpperCase();
});
}

function getListMahasiswa(genreate, id_matkul) {

 var apiCekMhs = apiListMahasiswa + "/" + genreate;

 $.getJSON( apiCekMhs, function( hasil ) {

  var id_presensi_matkul = hasil[0]["id_presensi_matkul"];

  var cek_presensi = apiCekPresensiMhs + id_matkul + "/kosong/" + id_presensi_matkul;
  var lismhs = `<div class="list">`;
  var datamhs= '';

  $.getJSON( cek_presensi, function( data ) {
   $("#dataMahasiswa").empty();
   $("#dataMahasiswa").css("display", "block");

   var jumlahmhs = 0;

   $.each(data, function(i, item) {
    datamhs += `<div class="list"><div class="item"><h2>`+ item.nim +`</h2><div class="right"><h2>`+ item.name +`</h2></div></div>`;
    jumlahmhs ++;
  });

   lismhs += `<div class="item"><h2 style="text-align: center;">Data Mahasiswa yang mengikuti kuliah (`+jumlahmhs+`)</h2></div></div>`;

   if (jumlahmhs > 0) {
    $("#tombolsimpan").css("display", "block");
  }

  else {
    $("#tombolsimpan").css("display", "none");
  }


  var tampil = lismhs + datamhs ;

  console.log("jumlah " +jumlahmhs);

  $("#dataMahasiswa").append(tampil);
});
});
}

$("#tombolGenreateQR").click(function(){ 
 var genreate = makeCode();
 var id_matkul = $('select[name=pilihan_mk]').val();
 var id_dosen = localStorage.getItem('id_dosen');
 var keterangan = $("#jenis_mk").val();
 var device = "kosong";

 $("#kodeList").css("display", "block");
 $("#textlist").remove();
 $(".tombolQR").remove();

 $("#hasilgenreate").append(``);

 var urlPresensiMatkul = apiPresensiMatkul + id_matkul + "/" + id_dosen;

 var dataString = "generate="+genreate+"&device="+device+"&keterangan="+keterangan;
 console.log(genreate);

 $.ajax({
  type: "post",
  url: urlPresensiMatkul,
  data: dataString,
  crossDomain: true,
  cache: false,
  success: function(data){
   console.log(data);
   setTimeout(function() {
    setInterval(function() {
     getListMahasiswa(genreate, id_matkul);
   }, 5000);
  }, 100);
 },
 error: function(err){
   console.log("error");
 }
});

 $("#addketerangan").click(function(){ 
  var keterangan = $('select[name=keterangan]').val();
  var nim = $("#nimmhs").val();
  var id = id_matkul;
  var device = "kosong";
  var days = "kosong";

  var apiCekID = apiListMahasiswa + "/" + genreate;
  $.getJSON( apiCekID, function( hasil ) {
   var id_presensi_matkul = hasil[0]["id_presensi_matkul"];
   var uniq = id_presensi_matkul;

   var url = apiKeteranganPresensi + "/" + id;
   var dataString = "nim="+nim+"&generate="+genreate+"&device="+device+"&keterangan="+keterangan+"&days="+days+"&uniq="+uniq;

   $.ajax({
    type: "post",
    url: url,
    data: dataString,
    crossDomain: true,
    cache: false,
    success: function(data){
     console.log(data);
     if(data == "ya") {
      alert("Maaf data gagal ditambahkan, Nim ini sudah ada");
    }

    else {
      alert("Data sukses ditambahkan");
    }
    $("#formketerangan").css("display", "none");
  },
  error: function(err){
   console.log("error");
   alert("Gagal, Nim tidak ditemukan silakan coba lagi !")
 }
});

 });
});

 $("#simpanDataPresensi").click(function(){ 
  var apiCekID = apiListMahasiswa + "/" + genreate;
  $.getJSON( apiCekID, function( hasil ) {
   var id_presensi_matkul = hasil[0]["id_presensi_matkul"];

   var materi = $("#keteranganmateri").val();
   var url = apiSet + id_matkul + "/" + id_presensi_matkul + "/" + materi;

   $.ajax({
    type: "PUT",
    url: url,
    crossDomain: true,
    cache: false,
    success: function(data){
     console.log(data);
     var url = apiSetMatkul + id_presensi_matkul + "/" + materi;
     $.ajax({
      type: "PUT",
      url: url,
      crossDomain: true,
      cache: false,
      success: function(data){
       console.log(data);
       alert("Data sukses ditambahkan");
       window.location="index.html";
     },
     error: function(err){
       console.log("error");
       alert("Gagal, Silakan coba kembali !")
     }
   });

   },
   error: function(err){
     console.log("error");
     alert("Gagal, Silakan coba kembali !");
   }
 });
 });
});
});

$("#logout").click(function(){ 
 localStorage.clear();
 window.location="../index.html";
});

function logout() {
  localStorage.clear();
  window.location="../index.html";
}

$("#masuk").click(function(){ 
 window.location="absenmasuk.html";
});

