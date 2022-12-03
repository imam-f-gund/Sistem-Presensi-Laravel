<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //
    public function store(Request $request){
     $blog =  new User;
     	/*$blog->user_id = $request->user_id;*/
        $blog->username =  $request->username;
        $blog->email =  $request->email;
        $blog->password = Hash::make($request['password']);
        $blog->photo = $request->photo;
       /* $blog->role_id = $request->role_id;
        $blog->updated_at= $request->updated_at;
        $blog->status = $request->status;
        $blog->login_session_key = $request->login_session_key;
        $blog->email_status = $request->email_status;
        $blog->password_reset_key = $request->password_reset_key;*/
        $blog->save();

        

}
}
