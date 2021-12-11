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
            //1. Lấy tất cả thông tin người đang chat
            return view('buyer.chat.chat');
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


            //Sắp xếp:
            for ($i=0;$i<count($all_detail_message);$i++){
                for($j=$i+1;$j<count($all_detail_message);$j++)
                if($all_detail_message[$i]->time_msg > $all_detail_message[$j]->time_msg){
                    $t = $all_detail_message[$j];
                    $all_detail_message[$j] = $all_detail_message[$i];
                    $all_detail_message[$i] = $t;
                }
            }
            //
//            echo $all_detail_message;

            return view('buyer.chat.chat')
                ->with('all_message',$all_message)
                ->with('message',$message)
                ->with('all_detail_message',$all_detail_message);
        }
        else {
            return Redirect::to('/login');
        }
    }
}
