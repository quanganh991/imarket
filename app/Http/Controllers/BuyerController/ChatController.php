<?php

namespace App\Http\Controllers\BuyerController;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session,Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    public function view_all_chat(){
        if(Session::get('id_user')) {
            $all_message = DB::table('message')
                ->where('id_sender',Session::get('id_user'))
                ->orWhere('id_receiver',Session::get('id_user'))
                ->get();
            return view('buyer.chat.view_all_chat')
                ->with('all_message',$all_message);
        }
        else {
            return Redirect::to('/login');
        }
    }

    public function search_chat(Request $request){
        if(Session::get('id_user')) {
            $key_word = $request->keyword;

            $all_message = DB::table('message')
                ->join('users','message.id_receiver','=','users.id_user')
                ->where(
                    [['message.id_sender','=',Session::get('id_user')],['users.name_user','like', '%'.$key_word.'%']])
                ->orWhere(
                    [['message.id_receiver','=',Session::get('id_user')],['users.name_user','like', '%'.$key_word.'%']])
                ->get();
            return view('buyer.chat.search_chat')
                ->with('key_word',$key_word)
                ->with('all_message',$all_message);
        }
        else {
            return Redirect::to('/login');
        }
    }

    public function chat_with($id_user){
        if(Session::get('id_user')) {
            //1. Lấy thông tin của cuộc trò chuyện
            $message = DB::table('message')
                ->where(
                    [['id_sender','=',$id_user],
                    ['id_receiver','=',Session::get('id_user')]])
                ->orWhere(
                    [['id_sender','=',Session::get('id_user')],
                    ['id_receiver','=',$id_user]])
                ->get()->first();
                    //Nếu người mà me đang chat ko có trong danh mục chat -> thêm vào bảng message
            if ($message == null){
                DB::insert('insert into message (id_sender,id_receiver)
                        values (?,?)'
                    , [Session::get('id_user'),$id_user]);

                $message = DB::table('message')
                    ->where(
                        [['id_sender','=',$id_user],
                            ['id_receiver','=',Session::get('id_user')]])
                    ->orWhere(
                        [['id_sender','=',Session::get('id_user')],
                            ['id_receiver','=',$id_user]])
                    ->get()->first();
            }
            //2. Lấy tất cả các tin nhắn trong cuộc trò chuyện đó
            $detail_message_me = DB::table('detail_message')
                ->where('id_user',Session::get('id_user'))
                ->where('id_message',$message->id_message)
                ->get();

            $detail_message_you = DB::table('detail_message')
                ->where('id_user',$id_user)
                ->where('id_message',$message->id_message)
                ->get();

            //3. Lấy tất cả các cuộc trò chuyện
            $all_message = DB::table('message')
                ->where('id_sender',Session::get('id_user'))
                ->orWhere('id_receiver',Session::get('id_user'))
                ->get();

            $all_detail_message = $detail_message_you->merge($detail_message_me);

            //4. Tất cả các tin nhắn của you được coi là đã đọc
            DB::table('detail_message')
                ->where('id_message',$message->id_message)
                ->where('id_user',$id_user)
                ->update([
                    'has_been_read' => 1,
                ]);

            //Sắp xếp:
            for ($i=0;$i<count($all_detail_message);$i++){
                for($j=$i+1;$j<count($all_detail_message);$j++)
                if($all_detail_message[$i]->time_msg < $all_detail_message[$j]->time_msg){
                    $t = $all_detail_message[$j];
                    $all_detail_message[$j] = $all_detail_message[$i];
                    $all_detail_message[$i] = $t;
                }
            }

            return view('buyer.chat.chat')
                ->with('all_message',$all_message)
                ->with('message',$message)
                ->with('all_detail_message',$all_detail_message);
        }
        else {
            return Redirect::to('/login');
        }
    }

    public function send_msg(Request $request){
        $id_user = $request->id_user;
        $id_message = $request->id_message;
        $context_msg = $request->context_msg;
        $your_id = $request->your_id;
        DB::insert('insert into detail_message (id_user,id_message, context_msg)
                        values (?,?,?)'
            , [$id_user,$id_message,$context_msg]);
        return Redirect::to('/chat-with-'.$your_id);
    }
}
