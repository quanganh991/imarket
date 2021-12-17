<?php

namespace App\Http\Controllers\BuyerController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function viewUserOrderDetail($id_oder)
    {  //xem chi tiết từng sản phẩm trong đơn hàng
        if (Session::get('id_buyer')) {
            $allUserOrderDetail = DB::table('oder_detail')
                ->where('id_oder', $id_oder)
                ->get();
            return view('buyer.order.userOrderDetail')
                ->with('allUserOrderDetail', $allUserOrderDetail)
                ->with('countAllUserOrderDetail',count($allUserOrderDetail))
                ->with('idDonHang',$id_oder);
        } else {
            return redirect('login');
        }
    }

    public function viewUserOrder()
    {    //xem các đơn hàng của người dùng
        if (Session::get('id_buyer')) {
            $allUserOrder = DB::table('oder')
                ->where('id_customer', Session::get('id_buyer'))
                ->get();
            if (count($allUserOrder) > 0) {
                return view('buyer.order.userOrder')->with('allUserOrder', $allUserOrder);
            } else {
                return view('buyer.order.notBuyYet');
            }
        } else {
            return redirect('login');
        }
    }

    public function cancelUserOrder($id_oder_detail)
    {
        if (Session::get('id_buyer')) {
            DB::table('oder_detail')
                ->where('id_oder_detail', $id_oder_detail)
                ->update(['isapproved' => 3]);

            $oder = DB::table('oder')
                ->join('oder_detail','oder.id_oder','=','oder_detail.id_oder')
                ->where('oder_detail.id_oder_detail',$id_oder_detail)
                ->get()->first();

            DB::table('notification')
                ->insert(
                    ['id_user'=>$oder->id_customer,
                    'link_noti' => '/user-view-order-detail-'.$oder->id_oder,
                    'is_read'=>'not seen',
                    'date_noti'=>date('Y-m-d H:i:s'),
                    'context_noti'=>"Đơn hàng ".$id_oder_detail." đã được hủy"
                    ]);
            $tb = Session::get('notification') + 1;
            Session::remove('notification');
            Session::put('notification',$tb);
            return back();
        } else {
            return redirect('login');
        }
    }
}
