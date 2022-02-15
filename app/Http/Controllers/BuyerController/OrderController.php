<?php

namespace App\Http\Controllers\BuyerController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
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

            $news = DB::table('news')
                ->join('product','news.id_product','=','product.id_product')
                ->where('id_news',$oder->id_news)
                ->get()->first();

            DB::table('notification')
                ->insert(
                    ['id_user'=>$oder->id_customer,
                    'link_noti' => '/user-view-order-detail-'.$oder->id_oder,
                    'is_read'=>'not seen',
                    'date_noti'=>date('Y-m-d H:i:s'),
                    'context_noti'=>"Sản phẩm".$news->product_name." (Trong đơn hàng ".$id_oder_detail.") đã được hủy"
                    ]);
            $tb = Session::get('notification') + 1;
            Session::remove('notification');
            Session::put('notification',$tb);
            return back();
        } else {
            return redirect('login');
        }
    }

    public function saveOrder(Request $request){
        DB::table('oder')
            ->insert([
                'id_customer'=>Session::get('id_buyer'),
                'oder_date'=>date('Y-m-d H:i:s'),
                'province'=>$request->province,
                'oder_note'=>$request->oder_note,
                ]);

        $recently_added_order = DB::table('oder')
            ->latest('id_oder')
            ->first();

        $news = DB::table('news')
            ->join('product','news.id_product','=','product.id_product')
            ->where('news.id_news',$request->id_news)
            ->get()->first();

        DB::table('oder_detail')
            ->insert([
                'item_oder'=>1,
                'id_oder'=>$recently_added_order->id_oder,
                'id_news'=>$request->id_news,
                'quantity'=>$request->quantity,
                'subprice'=>$news->price,
                'boughtdate'=>date('Y-m-d H:i:s'),
                'totaleachcost'=>($request->quantity*$news->price),
                'isapproved'=>0
            ]);

        //Bây giờ mới cập nhật lại giá của đơn hàng này

        DB::table('oder')
            ->where('id_oder',$recently_added_order->id_oder)
            ->update(['totalcost'=>($request->quantity*$news->price)]);

        //Đã cập nhật giá của đơn hàng xong rồi

        //Gửi noti cho người dùng
        DB::table('notification')
            ->insert(
                ['id_user'=>Session::get('id_buyer'),
                    'link_noti' => '/user-view-order-detail-'.$recently_added_order->id_oder,
                    'is_read'=>'not seen',
                    'date_noti'=>date('Y-m-d H:i:s'),
                    'context_noti'=>"Sản phẩm ".$news->product_name." đã được gửi tới người bán thành công và đang chờ phê duyệt"
                ]);
        //
        return Redirect::to('/user-view-order');
    }

    public function makeOrder($id_news){
        if (Session::get('id_buyer')) {
            $news = DB::table('news')
                ->join('product','news.id_product','=','product.id_product')
                ->where('news.id_news',$id_news)
                ->get()->first();
            return view('buyer.order.makeOrder')
                ->with('news',$news);
        } else {
            return redirect('login');
        }
    }
}
