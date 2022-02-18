<?php

namespace App\Http\Controllers\BuyerController;
use App\Http\Controllers\Controller;

use Illuminate\Support\Collection;
use Illuminate\Http\Request,Illuminate\Support\Facades\DB;
use App\Http\Controllers\EvaluateController;
use Illuminate\Support\Facades\Session;

class NewsController extends Controller
{
    public function ViewBranchList($id_main){
            $mainSearch = DB::table('main_category')
                ->where('id_main_category', $id_main)
                ->get()
                ->first();  //chứa $id_main
            $branchSearch = DB::table('branch_category')->where('id_main_category', $id_main)->get();   //chứa tất cả các branch có $id_main
            $newsSearch = DB::table('news') //chứa 5 tin tức mới nhất có $id_main
                ->join('branch_category', 'branch_category.id_branch_category', '=', 'news.id_branch_category')
                ->where('branch_category.id_main_category', $id_main)
                ->orderBy('latest_update', 'DESC')
                ->get();
            $newsSearchCheapest = DB::table('news') //chứa 4 tin tức có giá rẻ nhất có $id_main
                ->join('branch_category', 'branch_category.id_branch_category', '=', 'news.id_branch_category')
                ->where('branch_category.id_main_category', $id_main)
                ->orderBy('price', 'DESC')
                ->take(6)
                ->get();
            $newsSearchProductImageOnly = DB::table('news') //chứa các ảnh của product
                ->join('branch_category', 'branch_category.id_branch_category', '=', 'news.id_branch_category')
                ->where('branch_category.id_main_category', $id_main)
                ->get();
            $newsSearchProductVideoOnly = DB::table('news') //chứa các video của product
                ->join('branch_category', 'branch_category.id_branch_category', '=', 'news.id_branch_category')
                ->where('branch_category.id_main_category', $id_main)
                ->get();

            //Dự đoán

//            $newsSearch = $newsSearch->take(6);
//            $newsSearchCheapest = $newsSearchCheapest->take(6);

            $newsSearch = EvaluateController::evaluate($newsSearch)->take(6);
            $newsSearchCheapest = EvaluateController::evaluate($newsSearchCheapest);

            return view('buyer.news.branch_list', [
                    'branchSearch' => $branchSearch,
                    'newsSearch' => $newsSearch,
                    'mainSearch' => $mainSearch,
                    'newsSearchCheapest' => $newsSearchCheapest,
                    'newsSearchProductImageOnly' => $newsSearchProductImageOnly,
                    'newsSearchProductVideoOnly' => $newsSearchProductVideoOnly,
                ]);
    }
    public function ViewNewsList($id_branch){
        $branchSearch = DB::table('branch_category')->where('id_branch_category', $id_branch)->get()->first();   //chứa $id_branch
        $mainSearch = DB::table('main_category')->where('id_main_category', $branchSearch->id_main_category)->get()->first();  //chứa $id_main
        //Sắp xếp theo mới nhất-cũ nhất
        $newsSearch = DB::table('news')->where('id_branch_category', $id_branch)
            ->orderBy('publish_date', 'DESC')
            ->take(6)
            ->get();
        //Sắp xếp theo giá rẻ nhất
        $newsSearchPopular = DB::table('news')->where('id_branch_category', $id_branch)
            ->orderBy('price', 'DESC')
            ->get();
        //Ảnh
        $newsSearchImageOnly = DB::table('news') //chứa các tin tức chỉ toàn ảnh có $id_branch
            ->where('id_branch_category', $id_branch)
            ->get();
        //Video
        $newsSearchVideoOnly = DB::table('news') //chứa các tin tức chỉ toàn video có $id_branch
            ->where('id_branch_category', $id_branch)
            ->get();

        $newsSearch = EvaluateController::evaluate($newsSearch);
        $newsSearchPopular = EvaluateController::evaluate($newsSearchPopular)->take(6);

        return view('buyer.news.news_list', [
            'newsSearch' => $newsSearch,
            'branchSearch' => $branchSearch,
            'mainSearch' => $mainSearch,
            'newsSearchPopular' => $newsSearchPopular,
            'newsSearchImageOnly' => $newsSearchImageOnly,
            'newsSearchVideoOnly' => $newsSearchVideoOnly,
        ]);
    }
    public function ViewNewsDetail($id_news){
        $newsDetail = DB::table('news')->where('id_news', $id_news)->get()->first(); //lấy thông tin về bài viết
        $newsDetailBranch = DB::table('branch_category')->where('id_branch_category', $newsDetail->id_branch_category)->get()->first();  //thông tin về branch của bài viết
        $newsDetailMain = DB::table('main_category')->where('id_main_category', $newsDetailBranch->id_main_category)->get()->first();  //thông tin về main của bài viết
        $relevantNewsDetail = DB::table('news')->where('id_branch_category', $newsDetailBranch->id_branch_category)->get();  //lấy tất cả các bài viết có cùng branch
        $branchInSameMain = DB::table('branch_category')
            ->where('id_main_category', $newsDetailBranch->id_main_category)->get();    //lấy tất cả các branch trong cùng main của $id_news
        $videoInSameBranch = DB::table('news') //chứa các tin tức chỉ toàn video nằm trong $id_main_category
            ->join('branch_category', 'branch_category.id_branch_category', '=', 'news.id_branch_category')
            ->where('branch_category.id_main_category', $newsDetailMain->id_main_category)
            ->get();

        $statistic = DB::table('statistic')
            ->where('id_news',$id_news)
            ->get();
        $score_rated = 0;
        $times_visited = 0;
        foreach($statistic as $each_statistic){
            $score_rated += $each_statistic->score_rated;
            $times_visited = $each_statistic->times_visitted + 1;
        }
        if (count($statistic) > 0) {
            $score_rated /= count($statistic);
        }

        $relevantNewsDetail = EvaluateController::evaluate($relevantNewsDetail);


        if (Session::get('id_user')) {
            $has_rated_yet = DB::table('statistic')
                ->where('id_user',Session::get('id_user'))
                ->where('id_news', $id_news)->get();

            if (count($has_rated_yet) > 0){
                DB::table('statistic')
                    ->where('id_user',Session::get('id_user'))
                    ->where('id_news', $id_news)
                    ->update(['times_visitted' => $times_visited]);
            } else {    #id_user chưa từng đánh giá $id_news
                DB::insert('insert into statistic (id_news, id_user, score_rated, times_visitted) values (?, ?, ?, ?)'
                    , [$id_news,Session::get('id_user'),(int)$score_rated,1]);
            }
        }
        return view('buyer.news.news_detail', [
            'statistic' =>$statistic,
            'score_rated' =>$score_rated,
            'time_visited' =>$times_visited,
            'newsDetail' => $newsDetail,
            'newsDetailBranch' => $newsDetailBranch,
            'newsDetailMain' => $newsDetailMain,
            'relevantNewsDetail' => $relevantNewsDetail,
            'branchInSameMain' => $branchInSameMain,
            'videoInSameBranch' => $videoInSameBranch,
        ]);
    }
    function searchNews(Request $request){
        $keyword = $request->keyword;
        $dateFrom = $request->dateFrom;
        $dateTo = $request->dateTo;

        if ($dateTo == null){
            $dateTo = date('Y-m-d H:i:s');
        }

        if ($dateFrom == null){
            $dateFrom = mktime(0, 0, 0, 1, 1, 1970);
            $dateFrom = date('Y-m-d H:i:s',$dateFrom);
        }

        if($keyword != null) {
            $search_news = DB::table('news')
                ->where('title', 'like', '%' . $keyword . '%')
                ->whereDate('publish_date', '>', $dateFrom)
                ->whereDate('publish_date', '<', $dateTo)
                ->get();
            $search_news = EvaluateController::evaluate($search_news);

        } else {
            $search_news = DB::table('news')
                ->where('title',$keyword)
                ->whereDate('publish_date', '>', $dateFrom)
                ->whereDate('publish_date', '<', $dateTo)
                ->get();
            $search_news = EvaluateController::evaluate($search_news);

        }
        return view('buyer.news.search_news')
            ->with('search_news',$search_news)
            ->with('dateFrom',$dateFrom)
            ->with('dateTo',$dateTo);
    }
}
