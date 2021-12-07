<?php

namespace App\Http\Controllers\SellerController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function welcomeSeller(){
        if (Session::get('id_seller')) {
            return view('seller.home');
        } else {
            return redirect('login');
        }
    }
}
