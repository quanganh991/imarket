 <!DOCTYPE html>
<html lang="vi">
<head>
    <title>I Market</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="public/newsfeed/assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="public/newsfeed/assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="public/newsfeed/assets/css/animate.css">
    <link rel="stylesheet" type="text/css" href="public/newsfeed/assets/css/font.css">
    <link rel="stylesheet" type="text/css" href="public/newsfeed/assets/css/li-scroller.css">
    <link rel="stylesheet" type="text/css" href="public/newsfeed/assets/css/slick.css">
    <link rel="stylesheet" type="text/css" href="public/newsfeed/assets/css/jquery.fancybox.css">
    <link rel="stylesheet" type="text/css" href="public/newsfeed/assets/css/theme.css">
    <link rel="stylesheet" type="text/css" href="public/newsfeed/assets/css/style.css">
    <!--[if lt IE 9]>
    <script src="public/newsfeed/assets/js/html5shiv.min.js"></script>
    <script src="public/newsfeed/assets/js/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div id="preloader">
    <div id="status">&nbsp;</div>
</div>
<a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>
<div class="container">
    <header id="header">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="header_top">
                    <div class="header_top_left">
                        <ul class="top_nav">
                            <li><a href="{{URL::to('/')}}">Home</a></li>
                                @if(Session::get('id_user'))
                                    <li>
                                        <a
                                            <?php
                                            $allUserNotification = DB::table('notification')    //lấy hết noti ra
                                            ->join('users','notification.id_user','=','users.id_user')
                                                ->where('users.id_user', Session::get('id_user'))
                                                ->where('notification.is_read','not seen')
                                                ->orderBy('notification.date_noti','DESC')
                                                ->get();
                                            $cnt_notification = count($allUserNotification); //số lượng thông báo mới
                                            if($cnt_notification != 0) {
                                                echo 'style="color: red"';
                                            }
                                            ?>
                                            href="{{URL::to('/user-view-notification')}}">
                                            Thông báo ({{$cnt_notification}})
                                        </a>
                                    </li>

                                <li>
                                    <a
                                        <?php
                                        $cnt_message = [];
                                        $all_message = DB::table('message')
                                            ->where('id_sender',Session::get('id_user'))
                                            ->orWhere('id_receiver',Session::get('id_user'))    //lấy tất cả tin nhắn mà có liên quan tới tôi
                                            ->get();

                                        foreach($all_message as $each_message){
                                            $detail_message = DB::table('detail_message')
                                                ->where('id_message',$each_message->id_message)
                                                ->where('id_user','<>',Session::get('id_user')) #tìm các tin nhắn gửi đến tôi
                                                ->where('has_been_read',0)
                                                ->get();
                                            array_push($cnt_message,count($detail_message));
                                        }

                                        if(array_sum($cnt_message) != 0) {
                                            echo 'style="color: red"';
                                        }
                                        ?>
                                        href="{{URL::to('/all-chat')}}">
                                        Tin nhắn ({{array_sum($cnt_message)}})
                                    </a>
                                </li>

                                @endif
                            @if(!Session::get('id_user'))
                                <li><a href="{{URL::to('/login')}}">Login</a></li>
                                <li><a href="{{URL::to('/signup')}}">Signup</a></li>
                            @elseif(Session::get('id_buyer'))
                                <?php
                                $nameCustomer = DB::table('users')
                                    ->where('id_user', Session::get('id_buyer'))
                                    ->get()->first();
                                ?>

                                <li class="dropdown">
                                    <button class="btn btn-sm btn-secondary dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false" style="color: green">
                                        Hello: {{$nameCustomer->name_user}}
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="{{URL::to('/logout')}}">Logout</a>
                                        <a class="dropdown-item" href="{{URL::to('/change-user-information')}}">User Information</a>
                                        <a class="dropdown-item" href="{{URL::to('/view-all-bookmark')}}">Bookmarked</a>
                                        <a class="dropdown-item" href="{{URL::to('/view-all-comment')}}">Your Comments</a>
                                        <a class="dropdown-item" href="{{URL::to('/user-view-order')}}">Your Orders</a>
                                    </div>
                                </li>
                            @elseif(Session::get('id_admin'))
                                <?php
                                $nameAdmin = DB::table('users')
                                    ->where('id_user', Session::get('id_admin'))
                                    ->get()->first();
                                ?>

                                <li class="dropdown">
                                    <button class="btn btn-sm btn-secondary dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false" style="color: red">
                                        {{$nameAdmin->name_user}} - Admin
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="{{URL::to('/logout')}}">Logout</a>
                                        <a class="dropdown-item" href="{{URL::to('/change-admin-information')}}">Admin Information</a>
                                        <a class="dropdown-item" href="{{URL::to('/home-admin')}}">Go to admin homepage</a>
                                    </div>
                                </li>
                            @elseif(Session::get('id_seller'))
                                <?php
                                $nameSeller = DB::table('users')
                                    ->where('id_user', Session::get('id_seller'))
                                    ->get()->first();
                                ?>

                                <li class="dropdown">
                                    <button class="btn btn-sm btn-secondary dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false" style="color: red">
                                        {{$nameSeller->name_user}} - Seller
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="{{URL::to('/logout')}}">Logout</a>
                                        <a class="dropdown-item" href="{{URL::to('/welcome-seller')}}">Go to seller homepage</a>
                                    </div>
                                </li>
                            @endif
                            <li>
                                <form method="GET" action="{{URL::to('/search-news')}}">
                                    <input required size="10" type="text" name="keyword" id="keyword"
                                           placeholder="Search..."/>
                                </form>
                            </li>
                        </ul>
                    </div>
                    <div class="header_top_right">
                        <p>{{date('D, d-m-Y h:m')}}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="header_bottom">
                    <div class="logo_area"><a href="{{URL::to('/')}}" class="logo"><img height=72 width=123 src="public/newsfeed/images/imarket.png" alt="IMarket"></a></div>
                </div>
            </div>
        </div>
    </header>
    <section id="navArea">
        <nav class="navbar navbar-inverse" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav main_nav">
                    <li class="active"><a href="{{URL::to('/')}}"><span class="fa fa-home desktop-home"></span><span class="mobile-show">Home</span></a></li>

                    <?php
                    $all_main = DB::table('main_category')->get();
                    ?>
                    @foreach($all_main as $each_main)
                        <li class="dropdown"> <a href="{{URL::to('/branch-result-'.$each_main->id_main_category)}}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{$each_main->name_main}}</a>
                            <?php
                            $all_branch = DB::table('branch_category')->where('id_main_category',$each_main->id_main_category)->get();
                            ?>
                            <ul class="dropdown-menu" role="menu">
                                @foreach($all_branch as $each_branch)
                                    <li><a href="{{URL::to('/news-result-'.$each_branch->id_branch_category)}}">{{$each_branch->name_branch}}</a></li>
                                @endforeach
                            </ul>
                        </li>
                    @endforeach

                </ul>
            </div>
        </nav>
    </section>
    <section id="newsSection">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="latest_newsarea"> <span>Suggestion for you</span>
                    <ul id="ticker01" class="news_sticker">
                        <?php
                        $latest_news = DB::table('news')->orderBy('latest_update', 'DESC')->take(10)->get();
                        ?>
                        @foreach($latest_news as $each_latest_news)
                            <li><a href="{{URL::to('/news-detail-'.$each_latest_news->id_news)}}">
                                    <img
                                        src="{{$each_latest_news->title_img}}"
                                        alt="">
                                    {{$each_latest_news->title}}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="social_area">
                        <ul class="social_nav">
                            <li class="facebook"><a href="https://www.facebook.com/"></a></li>
                            <li class="twitter"><a href="https://twitter.com/?lang=vi"></a></li>
                            <li class="flickr"><a href="https://www.flickr.com/"></a></li>
                            <li class="pinterest"><a href="https://www.pinterest.com/"></a></li>
                            <li class="googleplus"><a href="https://plus.google.com/"></a></li>
                            <li class="vimeo"><a href="https://vimeo.com/"></a></li>
                            <li class="youtube"><a href="https://www.youtube.com/"></a></li>
                            <li class="mail"><a href="https://mail.google.com/mail/u/0/#inbox"></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>


    @yield('home')
    @yield('login')
    @yield('signup')
    @yield('news_detail')
    @yield('branch_list')
    @yield('news_list')
    @yield('userInformation')
    @yield('viewAllBookmark')
    @yield('viewAllComment')
    @yield('order')


    <footer id="footer">
        <div class="footer_top">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="footer_widget wow fadeInDown">
                        <h2>Tìm kiếm</h2>
                        <ul class="tag_nav">
                            <li>
                                <form method="GET" action="{{URL::to('/search-news')}}">
                                    <input required size="40" type="text" name="keyword" id="keyword"
                                           placeholder="Tìm kiếm..."/>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="footer_widget wow fadeInRightBig">
                        <h2>Liên hệ</h2>
                        <p>I Market</p>
                        <address>
                            Số 1 Đại Cồ Việt, Hai Bà Trưng, Hà Nội ,Điện thoại: 123-326-789 Đường dây nóng: 123-546-567
                        </address>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer_bottom">
            <p class="copyright">Copyright &copy; 2021 <a href="{{URL::to('/')}}">I Market</a></p>
            <p class="developer">Developed By Wpfreeware</p>
        </div>
    </footer>
</div>
<script src="public/newsfeed/assets/js/jquery.min.js"></script>
<script src="public/newsfeed/assets/js/wow.min.js"></script>
<script src="public/newsfeed/assets/js/bootstrap.min.js"></script>
<script src="public/newsfeed/assets/js/slick.min.js"></script>
<script src="public/newsfeed/assets/js/jquery.li-scroller.1.0.js"></script>
<script src="public/newsfeed/assets/js/jquery.newsTicker.min.js"></script>
<script src="public/newsfeed/assets/js/jquery.fancybox.pack.js"></script>
<script src="public/newsfeed/assets/js/custom.js"></script>
</body>
</html>
