<?php

namespace App\Http\Controllers\BuyerController;
use App\Http\Controllers\Controller;

use App\Http\Controllers\EvaluateController;
use Illuminate\Http\Request,Illuminate\Support\Facades\Session,Illuminate\Support\Facades\DB,Illuminate\Support\Facades\Redirect;

class BookmarkedController extends Controller
{
    function bookmark(Request $request)
    {
        if (Session::get('id_user')) {
            $id_news = $request->id_news;
            $id_customer = Session::get('id_user');
            DB::insert('insert into bookmarked (id_news, id_customer) values (?, ?)'
                , [$id_news, $id_customer]);
            return back();
        }
        else {
            return Redirect::to('/login');
        }
    }

    function unbookmark(Request $request)
    {
        if (Session::get('id_user')) {
            $id_news = $request->id_news;
            $id_customer = Session::get('id_user');
            DB::table('bookmarked')
                ->where('id_news', $id_news)
                ->where('id_customer',$id_customer)
                ->delete();
            return back();
        }
        else {
            return Redirect::to('/login');
        }
    }

    function unbookmark2($id_news)
    {
        if (Session::get('id_user')) {
            $id_customer = Session::get('id_user');
            DB::table('bookmarked')
                ->where('id_news', $id_news)
                ->where('id_customer',$id_customer)
                ->delete();
            return back();
        }
        else {
            return Redirect::to('/login');
        }
    }

    function viewAllUserBookmark(){
        if (Session::get('id_user')) {
            $allUserBookmark = DB::table('bookmarked')
                ->join('news','bookmarked.id_news','=','news.id_news')
                ->where('bookmarked.id_customer',Session::get('id_user'))
                ->get();
            $allUserBookmark = EvaluateController::evaluate($allUserBookmark);
            return view('buyer.news.viewAllBookmark',[
                'allUserBookmark'=> $allUserBookmark
            ]);
        }
        else {
            return Redirect::to('/login');
        }
    }
}
