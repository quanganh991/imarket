<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request,Illuminate\Support\Facades\DB;

class CommentReplyController extends Controller
{
    public function comment(Request $request)
    {
        $comment = $request->comment;
        $newsid_hidden = $request->newsid_hidden;
        $userid_hidden = $request->userid_hidden;
        DB::table('coment')
            ->insert(['id_news' => $newsid_hidden, 'id_customer' => $userid_hidden, 'context_coment' => $comment, 'is_valid_coment' => 1]);

        return back();
    }

    public function reply(Request $request){
        $reply = $request->reply;
        $commentid_hidden = $request->commentid_hidden;
        $userid_hidden = $request->userid_hidden;
        DB::table('reply')
            ->insert(['id_coment' => $commentid_hidden, 'id_customer' => $userid_hidden, 'context_reply' => $reply, 'is_valid_reply' => 1]);

        $customer = DB::table('users')
            ->where('id_user',$userid_hidden)->get()->first();
        $comment = DB::table('coment')
            ->where('id_coment',$commentid_hidden)->get()->first();
        $news = DB::table('news')
            ->where('id_news',$comment->id_news)->get()->first();
        DB::insert('insert into notification (context_noti,date_noti,is_read,id_user,link_noti) values (?,?,?,?,?)'
            , [$customer->name_user . ' đã trả lời bình luận của bạn trong ' . $news->title, date('Y-m-d H:i:s'), 'not seen', $comment->id_customer,
                'news-detail-' . $news->id_news]);

        return back();
    }
}
