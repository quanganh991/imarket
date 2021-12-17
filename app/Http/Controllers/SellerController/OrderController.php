<?php

namespace App\Http\Controllers\SellerController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function viewOrder()
    {
        if (Session::get('id_seller')) {    #lấy tất cả các đơn hàng mà id_seller bán
            $allOrder = DB::table('oder')
                ->orderBy('oder.oder_date','DESC')
                ->get();
            return view('seller.orderManagement.view_order')->with('allOrder', $allOrder);
        } else {
            return redirect('login');
        }
    }

    public function approveOrder($id_oder_detail)
    { //duyệt
        if (Session::get('id_seller')) {
            DB::table('oder_detail')
                ->where('id_oder_detail', $id_oder_detail)
                ->update(['isapproved' => 1]);

            $oder = DB::table('oder')
                ->join('oder_detail','oder.id_oder','=','oder_detail.id_oder')
                ->where('oder_detail.id_oder_detail',$id_oder_detail)
                ->get()->first();

            DB::table('notification')
                ->insert(
                    ['id_user' => $oder->id_customer,
                        'link_noti' => '/user-view-order-detail-'.$oder->id_oder,
                        'is_read'=>"not seen",
                        'date_noti'=>date('Y-m-d H:i:s'),
                    'context_noti' => "Đơn hàng " . $id_oder_detail . " đang được giao đến quý khách"]);
            $tb = Session::get('notification') + 1;
            Session::remove('notification');
            Session::put('notification', $tb);
            return back();

        } else {
            return redirect('login');
        }
    }

    public function unApproveOrder($id_oder_detail)
    { //hủy
        if (Session::get('id_seller')) {
            DB::table('oder_detail')
                ->where('id_oder_detail', $id_oder_detail)
                ->update(['isapproved' => 3]);

            $oder = DB::table('oder')
                ->join('oder_detail','oder.id_oder','=','oder_detail.id_oder')
                ->where('oder_detail.id_oder_detail', $id_oder_detail)
                ->get()->first();
            DB::table('notification')
                ->insert([
                    'id_user' => $oder->id_customer,
                    'link_noti' => '/user-view-order-detail-'.$oder->id_oder,
                    'is_read'=>"not seen",
                    'date_noti'=>date('Y-m-d H:i:s'),
                    'context_noti'=>"Đơn hàng ".$id_oder_detail." đã bị hủy"
                    ]);
            $tb = Session::get('notification') + 1;
            Session::remove('notification');
            Session::put('notification', $tb);
            return back();
        } else {
            return redirect('login');
        }
    }

    public function succeedOrder($id_oder_detail)
    { //đánh dấu giao thành công
        if (Session::get('id_seller')) {
            DB::table('oder_detail')
                ->where('id_oder_detail', $id_oder_detail)
                ->update(['isapproved' => 2]);

            $oder = DB::table('oder')
                ->join('oder_detail','oder.id_oder','=','oder_detail.id_oder')
                ->where('oder_detail.id_oder_detail',$id_oder_detail)
                ->get()->first();

            DB::table('notification')
                ->insert([
                    'id_user' => $oder->id_customer,
                    'link_noti' => '/user-view-order-detail-'.$oder->id_oder,
                    'is_read'=>"not seen",
                    'date_noti'=>date('Y-m-d H:i:s'),
                    'context_noti'=>"Đơn hàng ".$id_oder_detail." đã được giao thành công"]);
            $tb = Session::get('notification') + 1;
            Session::remove('notification');
            Session::put('notification', $tb);

            return back();
        } else {
            return redirect('login');
        }
    }

    public function viewOrderDetail($id_oder)   #lấy tất cả các items trong đơn hàng có id_oder
    {
        if (Session::get('id_seller')) {
            $allOrderDetail = DB::table('oder_detail')
                ->join('news','oder_detail.id_news','=','news.id_news')
                ->where('news.id_user',Session::get('id_seller'))
                ->where('id_oder', $id_oder)
                ->get();
            $DONHANG = DB::table('oder')->where('id_oder', $id_oder)->get()->first();
            $KH = DB::table('users')->where('id_user', $DONHANG->id_customer)->get()->first();
            return view('seller.orderManagement.view_order_detail')->with('allOrderDetail', $allOrderDetail)->with('KH', $KH->name_user)
                ->with('DONHANG', $DONHANG);
        } else {
            return redirect('login');
        }
    }

    public function editOrderDetail($id_oder_detail)
    {
        if (Session::get('id_seller')) {
            $oder_detail = DB::table('oder_detail')
                ->where('id_oder_detail', $id_oder_detail)
                ->get()->first();
            return view('seller.orderManagement.edit_order_detail')->with('oder_detail', $oder_detail);
        } else {
            return redirect('login');
        }
    }

    public function submitEditOrderDetail(Request $request)
    {
        if (Session::get('id_seller')) {
            $id_oder_detail = $request->id_oder_detail;
            $item_oder = $request->item_oder;
            $id_oder = $request->id_oder;
            $id_news = $request->id_news;
            $quantity = $request->quantity;
            $subprice = $request->subprice;
            $partner_delivery = $request->partner_delivery;

            DB::table('oder_detail')
                ->where('id_oder_detail', $id_oder_detail)
                ->update([
                    'item_oder' => $item_oder,
                    'id_oder' => $id_oder,
                    'id_news' => $id_news,
                    'quantity' => $quantity,
                    'subprice' => $subprice,
                    'partner_delivery' => $partner_delivery,
                    'boughtdate' => date('Y-m-d H:i:s'),
                    'totaleachcost' => $item_oder * $subprice]);
            return Redirect::to('/view-order-detail-' . $id_oder);
        } else {
            return redirect('login');
        }
    }
}
