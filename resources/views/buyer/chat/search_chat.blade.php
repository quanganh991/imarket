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
                        <form class="input-group" action="{{URL::to('/search-chat')}}" method="GET">
                            <input value="{{$key_word}}" type="text" placeholder="Search..."  name="keyword" id="keyword" class="form-control search">
                        <div class="input-group-prepend">
                            <span class="input-group-text search_btn"><i class="fas fa-search"></i></span>
                        </div>
                        </form>

                    </div>
                </div>
                <div class="card-body contacts_body">
                    <ui class="contacts">
                        @foreach($all_message as $each_of_all_message)
                            <?php
                            $you = DB::table('users')   //các bạn
                                ->where('id_user',$each_of_all_message->id_receiver == Session::get('id_user') ? $each_of_all_message->id_sender : $each_of_all_message->id_receiver)
                                ->get()->first();
                            $detail_message = DB::table('detail_message')
                                    ->where('id_message',$each_of_all_message->id_message)
                                    ->where('id_user','<>',Session::get('id_user')) #tìm các tin nhắn gửi đến tôi
                                    ->where('has_been_read',0)
                                    ->get();
                                $cnt_message = count($detail_message);
                            ?>
                            <li class="active">
                                <a href="{{URL::to('/chat-with-'.$you->id_user)}}"><div class="d-flex bd-highlight">
                                    <div class="img_cont">
                                        <img src="{{$you->avatar}}" class="rounded-circle user_img">
                                        <span class="online_icon"></span>
                                    </div>
                                    <div class="user_info">
                                        <span>{{$you->name_user}} ({{$cnt_message}})</span>
                                        <p>{{$each_of_all_message->last_context_msg}} {{$each_of_all_message->last_time_msg}}</p>
                                    </div>
                                </div></a>
                            </li>
                        @endforeach
                    </ui>
                </div>
                <div class="card-footer">
                    <a href="{{URL::previous()}}">Quay lại</a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
