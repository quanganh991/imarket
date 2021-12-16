<?php

namespace App\Http\Controllers\BuyerController;

use App\Http\Controllers\Controller;
use App\Http\Controllers\EvaluateController;
use Illuminate\Http\Request,Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    function welcomeBuyer () {
        //0. Lấy tất cả các main
        $allMain = DB::table('main_category')
            ->get();

        //1. Lấy tất cả bài đăng mới nhất
        $newsSearch_newest = DB::table('news') //chứa 5 tin tức mới nhất để chạy trên thanh trượt dài dài
            ->join('product','news.id_product','=','product.id_product')
            ->orderBy('latest_update', 'DESC')
            ->get();

        //2. Lấy tất cả tin tức theo giá (Được quan tâm nhất)
        $newsSearch_price = DB::table('news') //chứa 5 tin tức mới nhất về main 3
            ->orderBy('price', 'DESC')
            ->take(5)
            ->get();

        //3. Lấy các bài đăng theo các main
        $newsSearch_main0 = DB::table('news') //chứa 5 tin tức mới nhất về main 0
            ->join('branch_category', 'branch_category.id_branch_category', '=', 'news.id_branch_category')
            ->where('branch_category.id_main_category', $allMain[0]->id_main_category)
            ->orderBy('latest_update', 'DESC')
            ->get();


        $newsSearch_main1 = DB::table('news') //chứa 5 tin tức mới nhất về main 1
        ->join('branch_category', 'branch_category.id_branch_category', '=', 'news.id_branch_category')
            ->where('branch_category.id_main_category', $allMain[1]->id_main_category)
            ->orderBy('latest_update', 'DESC')
            ->get();


        $newsSearch_main2 = DB::table('news') //chứa 5 tin tức mới nhất về main 2
        ->join('branch_category', 'branch_category.id_branch_category', '=', 'news.id_branch_category')
            ->where('branch_category.id_main_category', $allMain[2]->id_main_category)
            ->orderBy('latest_update', 'DESC')
            ->get();


        $newsSearch_main3 = DB::table('news') //chứa 5 tin tức mới nhất về main 3
            ->join('branch_category', 'branch_category.id_branch_category', '=', 'news.id_branch_category')
            ->where('branch_category.id_main_category', $allMain[3]->id_main_category)
            ->orderBy('latest_update', 'DESC')
            ->get();

        $newsSearch_main4 = DB::table('news') //chứa 5 tin tức mới nhất về main 4
        ->join('branch_category', 'branch_category.id_branch_category', '=', 'news.id_branch_category')
            ->where('branch_category.id_main_category', $allMain[4]->id_main_category)
            ->orderBy('latest_update', 'DESC')
            ->get();

        //4. Lấy các bình luận hot nhất
        $hotest_coments = DB::table('coment')
            ->join('news','news.id_news','=','coment.id_news')
            ->join('users','users.id_user','=','coment.id_customer')
            ->orderBy('coment.likes_coment','DESC')
            ->get();

        $newsSearch_newest = EvaluateController::evaluate($newsSearch_newest)->take(5);
        $newsSearch_price = EvaluateController::evaluate($newsSearch_price);
        $newsSearch_main0 = EvaluateController::evaluate($newsSearch_main0)->take(5);
        $newsSearch_main1 = EvaluateController::evaluate($newsSearch_main1)->take(5);
        $newsSearch_main2 = EvaluateController::evaluate($newsSearch_main2)->take(5);
        $newsSearch_main3 = EvaluateController::evaluate($newsSearch_main3)->take(5);
        $newsSearch_main4 = EvaluateController::evaluate($newsSearch_main4)->take(5);

        return view('buyer.home')
            ->with('all_main',$allMain)
            ->with('hotest_coments',$hotest_coments)
            ->with('newsSearch_price',$newsSearch_price)
            ->with('newsSearch_newest',$newsSearch_newest)
            ->with('newsSearch_main0',$newsSearch_main0)
            ->with('newsSearch_main1',$newsSearch_main1)
            ->with('newsSearch_main2',$newsSearch_main2)
            ->with('newsSearch_main3',$newsSearch_main3)
            ->with('newsSearch_main4',$newsSearch_main4);

    }
}
