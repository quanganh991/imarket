<?php

namespace App\Http\Controllers\SellerController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SellerInformationController extends Controller
{
    public function changeSellerInformation()
    {
        if (!Session::get('id_seller'))
            return redirect('login');
        else {
            $sellerInformation = DB::table('users')
                ->where('type_of_user',3)
                ->where('id_user', Session::get('id_seller'))
                ->get()
                ->first();
            return view('seller.sellerManagement.sellerInformation')
                ->with('sellerInformation', $sellerInformation);
        }
    }

    public function alterSellerInformation(Request $request)
    {
        if (!Session::get('id_seller'))
            return redirect('login');
        else {

            $name = $request->name;
            $avatar = $request->avatar;
            $email = $request->email;
            $password = $request->password;
            $phone_number = $request->phone_number;
            $address = $request->address;
            $job = $request->job;
            $status_user = $request->status_user;

            DB::table('users')
                ->where('id_user', Session::get('id_seller'))
                ->update(['name_user' => $name, 'email' => $email, 'password' => $password, 'phone_number' => $phone_number, 'address' => $address, 'status_user' => $status_user,
                    'avatar' => $avatar, 'job' => $job]);

            Session::flash('success', 'Bạn thay đổi thông tin thành công');

            return redirect('/welcome-seller');
        }
    }
}
