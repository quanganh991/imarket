<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request, Illuminate\Support\Facades\DB, Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function login(){
        return view('login');
    }

    public function login_check(Request $request){
        $email = $request->email_account;
        $password = $request->password_account;
        $save_login = $request->save_login;
        $resultUser = DB::table('users')->where('email', $email)->where('password', $password)->first();    //chứa thông tin người dùng
        //Nếu đăng nhập đúng và sai
        if ($resultUser == null) $check = false;
        else $check = true;
        //nếu lưu thông tin đăng nhập
        if($save_login==true){
            cookie('email',$email,720);
            cookie('password',$password,720);
        }
        //
        if ($resultUser) {    //nếu người dùng đăng nhập đúng
            Session::put('login', true);
            Session::put('id_user', $resultUser->id_user);  //dùng chung cho cả 3 người
            if($resultUser->type_of_user == 1) {   //nếu người mua đăng nhập
                Session::put('id_buyer',$resultUser->id_user);
                Session::remove('id_admin');
                Session::remove('id_seller');
                return view('buyer.home')->with('resultUser',$resultUser);
            } else if($resultUser->type_of_user == 2){//nếu quản trị viên đăng nhập
                Session::put('id_admin',$resultUser->id_user);
                Session::remove('id_buyer');
                Session::remove('id_seller');
                return view('admin.home')->with('resultUser',$resultUser);
            } else if($resultUser->type_of_user == 3){//nếu người bán đăng nhập
                Session::put('id_seller',$resultUser->id_user);
                Session::remove('id_admin');
                Session::remove('id_buyer');
                return view('seller.home')->with('resultUser',$resultUser);
            }
        } else {
            $alert = 'Tài khoản hoặc mật khẩu không chính xác';
            return view('login', compact('check', 'alert'));
        }
    }

    public function signup(){

    }

    public function signup_check(){

    }

    public function logout(){
        Session::remove('id_user');
        Session::remove('id_journalist');
        Session::remove('id_customer');
        Session::remove('id_admin');
        Session::remove('login');
        Session::remove('email');
        Session::remove('notification');
        Session::put('login',false);
        return redirect('/');
    }
}
