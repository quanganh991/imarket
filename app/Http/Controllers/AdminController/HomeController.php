<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session,Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function welcomeAdmin(){

        if (Session::get('id_admin')) {
            $resultUser = DB::table('users')->where('id_user', Session::get('id_admin'))->first();    //chứa thông tin người dùng
            return view('admin.home')->with('resultUser',$resultUser);
        } else {
            return redirect('login');
        }
    }
}
