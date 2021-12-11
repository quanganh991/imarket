<?php

namespace App\Http\Controllers\BuyerController;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request,Illuminate\Support\Facades\DB,Illuminate\Support\Facades\Session,Illuminate\Support\Facades\Redirect;

class CommentReplyController extends Controller
{
    function viewAllUserComment(){
        if (Session::get('id_user')) {
            $allUserComment = DB::table('coment')
                ->join('news','coment.id_news','=','news.id_news')
                ->where('coment.id_customer',Session::get('id_user'))
                ->get();

            $allUserReply = DB::table('reply')
                ->join('coment','reply.id_coment','=','coment.id_coment')
                ->join('news','coment.id_news','=','news.id_news')
                ->where('reply.id_customer',Session::get('id_user'))
                ->get();
            return view('buyer.comment.viewAllComment',[
                'allUserComment'=> $allUserComment,
                'allUserReply'=> $allUserReply,
            ]);
        }
        else {
            return Redirect::to('/login');
        }
    }
}
