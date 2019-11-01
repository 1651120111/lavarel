<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
class LoginController extends Controller
{
   public function getLogin(){
   	return view('backend.login');
   }

   public function postLogin(Request $request){ 
   	if($request->remember = 'Remember Me'){  
   		$remember = true;
   	}else{
   		$remember = false;
   	}
   	if (Auth::attempt(['email'=> $request-> email, 'password'=>$request-> password],$remember)) {
   			return redirect()->intended('admin/home')	;
   	}else{
   		 return back()->withInput()->with('error','tài khoản mật khẩu chưa đúng');
   	}
   }
}
