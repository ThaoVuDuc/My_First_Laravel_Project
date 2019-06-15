<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class LoginController extends Controller
{
    //
    public function getLogin(){
    	return view('backend.login');
    }
    public function postLogin(Request $request){
    	$arr = ['email'=>$request->email, 'password'=>$request->password];
    	if($request->remember = 'Remember Me'){
    		$remember = true;
    	}
    	else
    	{
    		$remember = false;
    	}
 		if(Auth::attempt($arr))
 		{
 			//nếu đăng nhập thành công thì đi đến trang chủ của admin
 			return redirect()->intended('admin/home');
 		}	
 		else
 		{
 			//nếu đăng nhập không thành công thì trở về trang trước bằng phương thức back, lưu infor các thông tin đã pos dùng withInput và tạo session bằng with()
 			return back()->withInput()->with('error', 'Tài khoản hoặc mật khẩu không chính xác !');
 		}
    }
}
