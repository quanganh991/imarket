<link href="public/chat_style.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html>
<head>
    <title>Chat</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.js"></script>
</head>
<!--Coded With Love By Mutiullah Samim-->
<body>
<div class="container-fluid h-100">
    <div class="row justify-content-center h-100">
        <div class="col-md-4 col-xl-3 chat"><div class="card mb-sm-3 mb-md-0 contacts_card">
                <div class="card-header">
                    <div class="input-group">
                        <input type="text" placeholder="Search..." name="" class="form-control search">
                        <div class="input-group-prepend">
                            <span class="input-group-text search_btn"><i class="fas fa-search"></i></span>
                        </div>
                    </div>
                </div>
                <div class="card-body contacts_body">
                    <ui class="contacts">
                        @foreach($all_message as $each_of_all_message)
                            <?php
                            $you = DB::table('users')   //các bạn
                                ->where('id_user',$each_of_all_message->id_receiver == Session::get('id_user') ? $each_of_all_message->id_sender : $each_of_all_message->id_receiver)
                                ->get()->first();
                            ?>
                        <li class="active">
                            <div class="d-flex bd-highlight">
                                <div class="img_cont">
                                    <img src="{{$you->avatar}}" class="rounded-circle user_img">
                                    <span class="online_icon"></span>
                                </div>
                                <div class="user_info">
                                    <span>{{$you->name_user}}</span>
                                    <p>{{$each_of_all_message->last_context_msg}} {{$each_of_all_message->last_time_msg}}</p>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ui>
                </div>
                <div class="card-footer"></div>
            </div>
        </div>
        <?php
        $me = DB::table('users')
            ->where('id_user',Session::get('id_user'))
            ->get()->first();
        $your_id = ($message->id_sender == $me->id_user ? $message->id_receiver : $message->id_sender);
        $you = DB::table('users')
            ->where('id_user',$your_id)
            ->get()->first();
        ?>
        <div class="col-md-8 col-xl-6 chat">
            <div class="card">
                <div class="card-header msg_head">
                    <div class="d-flex bd-highlight">
                        <div class="img_cont">
                            <img src="{{$you->avatar}}" class="rounded-circle user_img">
                            <span class="online_icon"></span>
                        </div>
                        <div class="user_info">
                            <span>{{$you->name_user}}</span>
                            <p>1767 Messages</p>
                        </div>
                        <div class="video_cam">
                            <span><i class="fas fa-video"></i></span>
                            <span><i class="fas fa-phone"></i></span>
                        </div>
                    </div>
                    <span id="action_menu_btn"><i class="fas fa-ellipsis-v"></i></span>
                    <div class="action_menu">
                        <ul>
                            <li><i class="fas fa-user-circle"></i> View profile</li>
                            <li><i class="fas fa-users"></i> Add to close friends</li>
                            <li><i class="fas fa-plus"></i> Add to group</li>
                            <li><i class="fas fa-ban"></i> Block</li>
                        </ul>
                    </div>
                </div>
                <div class="card-body msg_card_body">


                    @foreach($all_detail_message as $each_of_detail_message)
                        @if($each_of_detail_message->id_user == $you->id_user)
                            <div class="d-flex justify-content-start mb-4"> {{--justify-content-start là bạn--}}
                                <div class="img_cont_msg">
                                    <img src="{{$you->avatar}}" class="rounded-circle user_img_msg">
                                </div>
                                <div class="msg_cotainer">
                                    {{$each_of_detail_message->context_msg}}
                                    <span class="msg_time">{{$each_of_detail_message->time_msg}}</span>
                                </div>
                            </div>
                        @elseif($each_of_detail_message->id_user == $me->id_user)
                            <div class="d-flex justify-content-end mb-4">   {{--justify-content-end là tôi--}}
                                <div class="msg_cotainer_send">
                                    {{$each_of_detail_message->context_msg}}
                                    <span class="msg_time_send">{{$each_of_detail_message->time_msg}}</span>
                                </div>
                                <div class="img_cont_msg">
                                    <img src="{{$me->avatar}}" class="rounded-circle user_img_msg">
                                </div>
                            </div>
                        @endif
                    @endforeach

                </div>
                <div class="card-footer">
                    <div class="input-group">
                        <div class="input-group-append">
                            <span class="input-group-text attach_btn"><i class="fas fa-paperclip"></i></span>
                        </div>
                        <textarea name="" class="form-control type_msg" placeholder="Type your message..."></textarea>
                        <div class="input-group-append">
                            <span class="input-group-text send_btn"><i class="fas fa-location-arrow"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
