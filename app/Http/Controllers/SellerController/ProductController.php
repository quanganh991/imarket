<?php

namespace App\Http\Controllers\SellerController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session,Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    #1. Product
    public function product_management(){
        //quản lý các sản phẩm của seller
        if (Session::get('id_seller')) {

            $all_seller_products = DB::table('product')
                ->where('id_user',Session::get('id_seller'))
                ->orderBy('id_product','DESC')
                ->get();

            return view('seller.product_controller.all_seller_products')
                ->with('all_seller_products',$all_seller_products);
        } else {
            return redirect('login');
        }
    }

    public function edit_product($id_product){
        if (Session::get('id_seller')) {
            $edit_product = DB::table('product')->where('id_product', $id_product)->get()->first();
            //quăng sang trang edit
            return view('seller.product_controller.edit_seller_products')->with('edit_product', $edit_product);
        } else {
            return redirect('login');
        }
    }
    public function save_product(Request $request){
        if (Session::get('id_seller')) {
            $brand_name = $request->brand_name;
            $product_name = $request->product_name;
            $product_descrb = $request->product_descrb;

            DB::insert('insert into product (brand_name,id_user,product_name,product_descrb)
                        values (?,?,?,?)'
                , [$brand_name,Session::get('id_seller'),$product_name,$product_descrb]);


            return Redirect::to('/seller-product-management');
        } else {
            return redirect('login');
        }
    }
    public function submit_edit_product(Request $request){
        if (Session::get('id_seller')) {
            $id_product = $request->id_product;
            $brand_name = $request->brand_name;
            $situation = $request->situation;
            $product_name = $request->product_name;
            $product_descrb = $request->product_descrb;

            DB::table('product')->where('id_product', $id_product)
                ->update([
                    'brand_name' => $brand_name,
                    'situation' => $situation,
                    'product_name' => $product_name,
                    'product_descrb' => $product_descrb,
                ]);

            return Redirect::to('/seller-product-management');
        } else {
            return redirect('login');
        }
    }

    #2. Multimedia
    public function multimedia_management(){
        //quản lý các ảnh của sản phẩm của seller
        if (Session::get('id_seller')) {
            //1. Lấy các sản phẩm của seller
            $all_seller_products = DB::table('product')
                ->where('id_user',Session::get('id_seller'))
                ->get();

            //2. Lấy tất cả multimedia của tất cả các sản phẩm của seller
            $all_multimedia = DB::table('multimedia')
                ->join('product','multimedia.id_product','=','product.id_product')
                ->where('product.id_user',Session::get('id_seller'))
                ->orderBy('multimedia.id_multimedia','DESC')
                ->get();

            return view('seller.product_controller.all_seller_multimedia')
                ->with('all_seller_products',$all_seller_products)
                ->with('all_multimedia',$all_multimedia);
        } else {
            return redirect('login');
        }
    }

    public function save_multimedia(Request $request){
        if (Session::get('id_seller')) {
            $id_product = $request->id_product;
            $type_multi = $request->type_multi;
            $url_multi = $request->url_multi;

            DB::insert('insert into multimedia (id_product,type_multi,url_multi)
                        values (?,?,?)'
                , [$id_product,$type_multi,$url_multi]);


            return Redirect::to('/seller-multimedia-management');
        } else {
            return redirect('login');
        }
    }

    public function edit_multimedia($id_multimedia){
        if (Session::get('id_seller')) {
            $edit_multimedia = DB::table('multimedia')->where('id_multimedia', $id_multimedia)->get()->first();
            //quăng sang trang edit
            return view('seller.product_controller.edit_seller_multimedia')->with('edit_multimedia', $edit_multimedia);
        } else {
            return redirect('login');
        }
    }

    public function submit_edit_multimedia(Request $request){
        if (Session::get('id_seller')) {
            $id_multimedia = $request->id_multimedia;
            $id_product = $request->id_product;
            $type_multi = $request->type_multi;
            $url_multi = $request->url_multi;

            DB::table('multimedia')->where('id_multimedia', $id_multimedia)
                ->update([
                    'id_product' => $id_product,
                    'type_multi' => $type_multi,
                    'url_multi' => $url_multi,
                ]);

            return Redirect::to('/seller-multimedia-management');
        } else {
            return redirect('login');
        }
    }
}
