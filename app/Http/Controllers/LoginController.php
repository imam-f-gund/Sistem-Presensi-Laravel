<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\User;

use Illuminate\Support\Facades\Auth; 
use App\Http\Controllers\Controller; 
use Validator;
use Illuminate\Support\Facades\DB;




class LoginController extends Controller
{
  public $successStatus = 200;
    //
    public function __construct()
    {
      // $this->middleware('auth');
    }

   
   /** 
     * login api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
   public function login(){ 
        if(Auth::attempt(['username' => request('username'), 'password' => request('password')])){
            
            
            $user = Auth::User();

            
         //  $success = $user->createToken('MyApp')->accessToken;
           // $success['token'] =  $user->createToken('MyApp')-> accessToken;
           
           /* return response()->json(['success' => $success], $this-> successStatus); */
            
            return $user;
           
        } 
        else{ 
            return response()->json(['error'=>'Unauthorised'], 401); 
        } 
    }


    public function cekAll($id){
      $data = DB::table('users')
             ->where('user_id','=',$id)
             ->get();
             return $data;
    }

    public function cekdos($id){
      $data = DB::table('users')
              ->join('Dosen', 'users.user_id', '=', 'Dosen.user_id')
             ->where('users.user_id','=',$id)
             ->get();
             return $data;
    }
    public function cekar($id){
      $data = DB::table('users')
              ->join('karyawan', 'users.user_id', '=', 'karyawan.user_id')
             ->where('users.user_id','=',$id)
            
             ->get();
             
             return $data;
    }
 
          }




