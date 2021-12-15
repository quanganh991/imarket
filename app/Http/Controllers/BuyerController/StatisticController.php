<?php

namespace App\Http\Controllers\BuyerController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class StatisticController extends Controller
{
    public function rate(Request $request){
        if (!Session::get('id_user'))
            return redirect('login');
        else {
            $point = $request->point;
            $id_news = $request->id_news;
            $statistic = DB::table('statistic')
                ->where('id_news',$id_news)
                ->get();

            $rate_qty = count($statistic);  #số lượng đánh giá
//            $score_rated = 0; #
//
//            foreach($statistic as $each_statistic){
//                $score_rated += $each_statistic->score_rated;
//            }
//
//            $score_rated = round(($score_rated + 1.0 * $point)/($rate_qty + 1),2);

            $has_ever_been_rated_yet = count(DB::table('statistic')
                ->where('id_news',$id_news)
                ->where('id_user',Session::get('id_user'))->get());
            if($has_ever_been_rated_yet > 0) {
                DB::table('statistic')
                    ->where('id_news', $id_news)
                    ->where('id_user', Session::get('id_user'))
                    ->update(['score_rated' => $point]);
            } else {
                DB::insert('insert into statistic (id_news, id_user,score_rated,times_visitted) values (?, ?, ?, ?)'
                    , [$id_news, Session::get('id_user'),$point,1]);
            }
            return back();
        }
    }
}
