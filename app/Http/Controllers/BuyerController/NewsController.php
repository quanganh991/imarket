<?php

namespace App\Http\Controllers\BuyerController;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request,Illuminate\Support\Facades\DB;

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
                ->take(6)
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
            ->take(6)
            ->get();
        //Ảnh
        $newsSearchImageOnly = DB::table('news') //chứa các tin tức chỉ toàn ảnh có $id_branch
            ->where('id_branch_category', $id_branch)
            ->get();
        //Video
        $newsSearchVideoOnly = DB::table('news') //chứa các tin tức chỉ toàn video có $id_branch
            ->where('id_branch_category', $id_branch)
            ->get();
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
        return view('buyer.news.news_detail', [
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
        } else {
            $search_news = DB::table('news')
                ->where('title',$keyword)
                ->whereDate('publish_date', '>', $dateFrom)
                ->whereDate('publish_date', '<', $dateTo)
                ->get();
        }
        return view('buyer.news.search_news')
            ->with('search_news',$search_news)
            ->with('dateFrom',$dateFrom)
            ->with('dateTo',$dateTo);
    }
}
