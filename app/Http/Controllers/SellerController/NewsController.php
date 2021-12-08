<?php

namespace App\Http\Controllers\SellerController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class NewsController extends Controller
{
    public function saveMainCategory(Request $request)
    {
        if (Session::get('id_seller')) {
            $name_main = $request->name_main;

            DB::insert('insert into main_category (name_main) values (?)'
                , [$name_main]);

            return back();
        } else {
            return redirect('login');
        }
    }
    public function showAllMainCategory()
    {
        if (Session::get('id_seller')) {
            $allMainCategory = DB::table('main_category')
                ->paginate(10);
            return view('seller.news.all_main_category')->with('allMainCategory', $allMainCategory);
        } else {
            return redirect('login');
        }
    }
    public function editMainCategory($id_main_category)
    {
        if (Session::get('id_seller')) {//tìm id
            $edit_main_category = DB::table('main_category')->where('id_main_category', $id_main_category)->get()->first();
            //quăng sang trang edit
            return view('seller.news.edit_main_category')->with('edit_main_category', $edit_main_category);
        } else {
            return redirect('login');
        }
    }
    public function submitEditMain(Request $request)
    {
        if (Session::get('id_seller')) {
            $id_main_category = $request->id_main_category;
            $name_main = $request->name_main;

            DB::table('main_category')
                ->where('id_main_category', $id_main_category)
                ->update(['name_main' => $name_main]);

            return Redirect::to('/all-main-category');
        } else {
            return redirect('login');
        }
    }


    //Branch
    public function showAllBranchCategory(){
        if (Session::get('id_seller')) {
            $allBranchCategory = DB::table('branch_category')
                ->paginate(10);
            return view('seller.news.all_branch_category')->with('allBranchCategory', $allBranchCategory);
        } else {
            return redirect('login');
        }
    }

    //Thêm
    public function saveBranchCategory(Request $request){
        if (Session::get('id_seller')) {
            $id_main_category = $request->id_main_category;
            $name_branch = $request->name_branch;

            DB::insert('insert into branch_category (id_main_category, name_branch) values (?, ?)'
                , [$id_main_category, $name_branch]);

            return back();
        } else {
            return redirect('login');
        }
    }

    //Sửa
    public function editBranchCategory($id_branch_category)
    {
        if (Session::get('id_seller')) {//tìm id
            $edit_branch_category = DB::table('branch_category')->where('id_branch_category', $id_branch_category)->get()->first();
            //quăng sang trang edit
            return view('seller.news.edit_branch_category')->with('edit_branch_category', $edit_branch_category);
        } else {
            return redirect('login');
        }
    }

    public function submitEditBranch(Request $request)
    {
        if (Session::get('id_seller')) {
            $id_branch_category = $request->id_branch_category;
            $id_main_category = $request->id_main_category;
            $name_branch = $request->name_branch;

            DB::table('branch_category')->where('id_branch_category', $id_branch_category)
                ->update(['id_main_category' => $id_main_category, 'name_branch' => $name_branch]);
//            $checkedit= true;
//            $alert= 'Edit Branch Success';
            return Redirect::to('/all-branch-category')->with('checkedit', 'alert');
        } else {
            return redirect('login');
        }
    }

    //News
    public function saveNews(Request $request)
    {
        if (Session::get('id_seller')) {
            $id_news = $request->id_news;
            $id_branch_category = $request->id_branch_category;
            $title = $request->title;
            $location = $request->location;
            $news_context = $request->news_context;
            $id_user = $request->id_user;
            $price = $request->price;
            $news_status = 1;
            $expired = $request->expired;
            $publish_date = $request->publish_date;
            $latest_update = date('Y-m-d H:i:s');
            $type_of_news = $request->type_of_news == null ? 'bán' : $request->type_of_news;
            $id_product = $request->id_product;
            $title_img = $request->title_img;
            DB::insert('insert into news (id_news,id_branch_category,title,location,news_context,id_user,price,news_status,expired,publish_date,latest_update,type_of_news,id_product,title_img)
                        values (?,?,?,?,?,?,?,?,?,?,?,?,?,?)'
                , [$id_news,$id_branch_category,$title,$location,$news_context,$id_user,$price,$news_status,$expired,$publish_date,$latest_update,$type_of_news,$id_product,$title_img]);
            return back();
        } else {
            return redirect('login');
        }
    }
    public function showAllNews()
    {
        if (Session::get('id_seller')) {
            $allNews = DB::table('news')->orderBy('latest_update','DESC')
                ->paginate(10);

            return view('seller.news.all_news')->with('allNews', $allNews);
        } else {
            return redirect('login');
        }
    }
    public function editNews($id_news)
    {
        if (Session::get('id_seller')) {//tìm id
            $edit_news = DB::table('news')->where('id_news', $id_news)->get()->first();
            //quăng sang trang edit
            return view('seller.news.edit_news')->with('edit_news', $edit_news);
        } else {
            return redirect('login');
        }
    }
    public function submitEditNews(Request $request)
    {
        if (Session::get('id_seller')) {
            $id_news = $request->id_news;
            $id_branch_category = $request->id_branch_category;
            $title = $request->title;
            $location = $request->location;
            $news_context = $request->news_context;
            $id_user = $request->id_user;
            $price = $request->price;
            $news_status = $request->news_status;
            $expired = $request->expired;
            $publish_date = $request->publish_date;
            $latest_update = date('Y-m-d H:i:s');
            $type_of_news = $request->type_of_news;
            $id_product = $request->id_product;
            $title_img = $request->title_img;

            DB::table('news')->where('id_news', $id_news)
                ->update([
                    'id_news' => $id_news,
                    'id_branch_category' => $id_branch_category,
                    'title' => $title,
                    'location' => $location,
                    'news_context' => $news_context,
                    'id_user' => $id_user,
                    'price' => $price,
                    'news_status' => $news_status,
                    'expired' => $expired,
                    'publish_date' => $publish_date,
                    'latest_update' => $latest_update,
                    'type_of_news' => $type_of_news,
                    'id_product' => $id_product,
                    'title_img' => $title_img,
                ]);

            return Redirect::to('/seller-all-news');
        } else {
            return redirect('login');
        }
    }
    public function activeNews($id_news){
        if (Session::get('id_seller')) {
            DB::table('news')->where('id_news', $id_news)->update(['news_status' => 1]);
            Session::put('message', 'Active news thành công');
            return Redirect::to('/seller-all-news');
        } else {
            return redirect('login');
        }
    }
    public function unactiveNews($id_news){
        if (Session::get('id_seller')) {
            DB::table('news')->where('id_news', $id_news)->update(['news_status' => 0]);
            Session::put('message', 'Unactive news thành công');
            return Redirect::to('/seller-all-news');
        } else {
            return redirect('login');
        }
    }
}
