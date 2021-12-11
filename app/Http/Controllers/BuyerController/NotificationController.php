<?php

namespace App\Http\Controllers\BuyerController;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request,Illuminate\Support\Facades\Session,Illuminate\Support\Facades\DB,Illuminate\Support\Facades\Redirect;

class NotificationController extends Controller
{
    function viewAllNotification(){
        if(Session::get('id_user')) {
            $allNotification = DB::table('notification')
                ->where('id_user',Session::get('id_user'))
                ->orderBy('date_noti','DESC')
                ->get();
            return view('buyer.notification.view_all_notification')
                ->with('allNotification',$allNotification)
                ->with('me',Session::get('id_user'));
        } else {
            return Redirect::to('/login');
        }
    }

    function markAsReadNotification($id_notification){
        if (Session::get('id_user')) {
            DB::table('notification')->where('id_notification', $id_notification)->update(['is_read' => 'seen']);
            return Redirect::to('/user-view-notification');
        } else {
            return redirect('login');
        }
    }
}
