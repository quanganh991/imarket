{{--<!DOCTYPE html>--}}
{{--<html lang="zxx">--}}
{{--<head>--}}
{{--    <!-- Meta Tag -->--}}
{{--    <meta charset="utf-8">--}}
{{--    <meta http-equiv="X-UA-Compatible" content="IE=edge">--}}
{{--    <meta name='copyright' content=''>--}}
{{--    <meta http-equiv="X-UA-Compatible" content="IE=edge">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">--}}
{{--    <!-- Title Tag  -->--}}
{{--    <title>I Market</title>--}}
{{--    <!-- Favicon -->--}}
{{--    <link rel="icon" type="image/png" href="public/images/favicon.png">--}}
{{--    <!-- Web Font -->--}}
{{--    <link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">--}}

{{--    <!-- StyleSheet -->--}}

{{--    <!-- Bootstrap -->--}}
{{--    <link rel="stylesheet" href="public/assets/css/bootstrap.css">--}}
{{--    <!-- Magnific Popup -->--}}
{{--    <link rel="stylesheet" href="public/assets/css/magnific-popup.min.css">--}}
{{--    <!-- Font Awesome -->--}}
{{--    <link rel="stylesheet" href="public/assets/css/font-awesome.css">--}}
{{--    <!-- Fancybox -->--}}
{{--    <link rel="stylesheet" href="public/assets/css/jquery.fancybox.min.css">--}}
{{--    <!-- Themify Icons -->--}}
{{--    <link rel="stylesheet" href="public/assets/css/themify-icons.css">--}}
{{--    <!-- Nice Select CSS -->--}}
{{--    <link rel="stylesheet" href="public/assets/css/niceselect.css">--}}
{{--    <!-- Animate CSS -->--}}
{{--    <link rel="stylesheet" href="public/assets/css/animate.css">--}}
{{--    <!-- Flex Slider CSS -->--}}
{{--    <link rel="stylesheet" href="public/assets/css/flex-slider.min.css">--}}
{{--    <!-- Owl Carousel -->--}}
{{--    <link rel="stylesheet" href="public/assets/css/owl-carousel.css">--}}
{{--    <!-- Slicknav -->--}}
{{--    <link rel="stylesheet" href="public/assets/css/slicknav.min.css">--}}

{{--    <!-- Eshop StyleSheet -->--}}
{{--    <link rel="stylesheet" href="public/assets/css/reset.css">--}}
{{--    <link rel="stylesheet" href="public/style.css">--}}
{{--    <link rel="stylesheet" href="public/assets/css/responsive.css">--}}



{{--</head>--}}
{{--<body class="js">--}}

{{--<!-- Preloader -->--}}
{{--<div class="preloader">--}}
{{--    <div class="preloader-inner">--}}
{{--        <div class="preloader-icon">--}}
{{--            <span></span>--}}
{{--            <span></span>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--<!-- End Preloader -->--}}


{{--<!-- Header -->--}}
{{--<header class="header shop">--}}
{{--    <!-- Topbar -->--}}
{{--    <div class="topbar">--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <div class="col-lg-5 col-md-12 col-12">--}}
{{--                    <!-- Top Left -->--}}
{{--                    <div class="top-left">--}}
{{--                        <ul class="list-main">--}}
{{--                            <li><i class="ti-headphone-alt"></i> +060 (800) 801-582</li>--}}
{{--                            <li><i class="ti-email"></i> support@shophub.com</li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                    <!--/ End Top Left -->--}}
{{--                </div>--}}
{{--                <div class="col-lg-7 col-md-12 col-12">--}}
{{--                    <!-- Top Right -->--}}
{{--                    <div class="right-content">--}}
{{--                        <ul class="list-main">--}}
{{--                            <li><i class="ti-location-pin"></i> Store location</li>--}}
{{--                            <li><i class="ti-alarm-clock"></i> <a href="#">Daily deal</a></li>--}}
{{--                            <li><i class="ti-user"></i> <a href="#">My account</a></li>--}}
{{--                                @if(Session::get('login') == false)--}}
{{--                                <i class="ti-power-off"></i><a href="{{URL::to('/login')}}">Login</a>--}}

{{--                                @elseif(Session::get('login') == true)--}}
{{--                                <li class="dropdown">--}}
{{--                                    <?php--}}
{{--                                    $nameCustomer = DB::table('users')--}}
{{--                                        ->where('id_user', Session::get('id_user'))--}}
{{--                                        ->get()->first();--}}
{{--                                    ?>--}}
{{--                                    <button class="btn btn-sm btn-secondary dropdown-toggle" type="button"--}}
{{--                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"--}}
{{--                                            aria-expanded="false" style="color: #ffffff">--}}
{{--                                        Xin chào: {{$nameCustomer->name_user}}--}}
{{--                                    </button>--}}
{{--                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">--}}
{{--                                        <a class="dropdown-item" href="{{URL::to('/logout')}}">Đăng xuất</a>--}}
{{--                                        <a class="dropdown-item" href="{{URL::to('/change-user-information')}}">Thông--}}
{{--                                            tin cá nhân</a>--}}
{{--                                        <a class="dropdown-item" href="{{URL::to('/view-all-bookmark')}}">Bookmark--}}
{{--                                            đã lưu</a>--}}
{{--                                        <a class="dropdown-item" href="{{URL::to('/view-all-comment')}}">Danh mục--}}
{{--                                            bình luận</a>--}}
{{--                                    </div>--}}
{{--                                </li>--}}
{{--                                @endif--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                    <!-- End Top Right -->--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <!-- End Topbar -->--}}
{{--    <div class="middle-inner">--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <div class="col-lg-2 col-md-2 col-12">--}}
{{--                    <!-- Logo -->--}}
{{--                    <div class="logo">--}}
{{--                        <a href="public/assets/index.html"><img src="public/images/logo.png" alt="logo"></a>--}}
{{--                    </div>--}}
{{--                    <!--/ End Logo -->--}}
{{--                    <!-- Search Form -->--}}
{{--                    <div class="search-top">--}}
{{--                        <div class="top-search"><a href="#0"><i class="ti-search"></i></a></div>--}}
{{--                        <!-- Search Form -->--}}
{{--                        <div class="search-top">--}}
{{--                            <form class="search-form">--}}
{{--                                <label>--}}
{{--                                    <input type="text" placeholder="Search here..." name="search">--}}
{{--                                </label>--}}
{{--                                <button value="search" type="submit"><i class="ti-search"></i></button>--}}
{{--                            </form>--}}
{{--                        </div>--}}
{{--                        <!--/ End Search Form -->--}}
{{--                    </div>--}}
{{--                    <!--/ End Search Form -->--}}
{{--                    <div class="mobile-nav"></div>--}}
{{--                </div>--}}
{{--                <div class="col-lg-8 col-md-7 col-12">--}}
{{--                    <div class="search-bar-top">--}}
{{--                        <div class="search-bar">--}}
{{--                            <label>--}}
{{--                                <select>--}}
{{--                                    <option selected="selected">Tất cả</option>--}}
{{--                                    <option>Bài đăng</option>--}}
{{--                                    <option>Branch</option>--}}
{{--                                    <option>Category</option>--}}
{{--                                </select>--}}
{{--                            </label>--}}
{{--                            <form>--}}
{{--                                <label>--}}
{{--                                    <input name="search" placeholder="Tìm kiếm..." type="search">--}}
{{--                                </label>--}}
{{--                                <button class="btnn"><i class="ti-search"></i></button>--}}
{{--                            </form>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-lg-2 col-md-3 col-12">--}}
{{--                    <div class="right-bar">--}}
{{--                        <!-- Search Form -->--}}
{{--                        <div class="sinlge-bar">--}}
{{--                            <a href="{{URL::to('/view-all-bookmark')}}" class="single-icon">--}}
{{--                                <i class="fa fa-heart-o" aria-hidden="true"></i>--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                        <div class="sinlge-bar">--}}
{{--                            <a href="{{URL::to('/change-user-information')}}" class="single-icon">--}}
{{--                                <i class="fa fa-user-circle-o" aria-hidden="true"></i>--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                        <div class="sinlge-bar shopping">--}}
{{--                            <a href="#" class="single-icon"><i class="ti-bag"></i> <span class="total-count">2</span></a>--}}
{{--                            <!-- Shopping Item -->--}}
{{--                            <div class="shopping-item">--}}
{{--                                <div class="dropdown-cart-header">--}}
{{--                                    <span>2 Items</span>--}}
{{--                                    <a href="#">View Cart</a>--}}
{{--                                </div>--}}
{{--                                <ul class="shopping-list">--}}
{{--                                    <li>--}}
{{--                                        <a href="#" class="remove" title="Remove this item"><i class="fa fa-remove"></i></a>--}}
{{--                                        <a class="cart-img" href="#"><img src="https://via.placeholder.com/70x70" alt="#"></a>--}}
{{--                                        <h4><a href="#">Woman Ring</a></h4>--}}
{{--                                        <p class="quantity">1x - <span class="amount">$99.00</span></p>--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                                        <a href="#" class="remove" title="Remove this item"><i class="fa fa-remove"></i></a>--}}
{{--                                        <a class="cart-img" href="#"><img src="https://via.placeholder.com/70x70" alt="#"></a>--}}
{{--                                        <h4><a href="#">Woman Necklace</a></h4>--}}
{{--                                        <p class="quantity">1x - <span class="amount">$35.00</span></p>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
{{--                                <div class="bottom">--}}
{{--                                    <div class="total">--}}
{{--                                        <span>Total</span>--}}
{{--                                        <span class="total-amount">$134.00</span>--}}
{{--                                    </div>--}}
{{--                                    <a href="public/assets/checkout.html" class="btn animate">Checkout</a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <!--/ End Shopping Item -->--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <!-- Header Inner -->--}}
{{--    <div class="header-inner">--}}
{{--        <div class="container">--}}
{{--            <div class="cat-nav-head">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-lg-3">--}}
{{--                        <div class="all-category">--}}
{{--                            <h3 class="cat-heading"><i class="fa fa-bars" aria-hidden="false"></i>CATEGORIES</h3>--}}
{{--                            <ul class="main-category">--}}
{{--                                <li><a href="#">Menu<i class="fa fa-angle-right" aria-hidden="true"></i></a>--}}
{{--                                    <ul class="sub-category">--}}
{{--                                        <li><a href="#">Thông tin cá nhân</a></li>--}}
{{--                                        <li><a href="#">Quản lý bookmark</a></li>--}}
{{--                                        <li><a href="#">Bình luận của tôi</a></li>--}}
{{--                                        <li><a href="#">Quản lý notification</a></li>--}}
{{--                                        <li><a href="#">Sản phẩm đã mua</a></li>--}}
{{--                                        <li><a href="#">Tin nhắn</a></li>--}}
{{--                                        <li><a href="#">ladies</a></li>--}}
{{--                                        <li><a href="#">westrn dress</a></li>--}}
{{--                                        <li><a href="#">denim </a></li>--}}
{{--                                    </ul>--}}
{{--                                </li>--}}
{{--                                <li class="main-mega"><a href="#">Có thể bạn sẽ thích<i class="fa fa-angle-right" aria-hidden="true"></i></a>--}}
{{--                                    <ul class="mega-menu">--}}
{{--                                        <li class="single-menu">--}}
{{--                                            <a href="#" class="title-link">Shop Kid's</a>--}}
{{--                                            <div class="image">--}}
{{--                                                <img src="https://via.placeholder.com/225x155" alt="#">--}}
{{--                                            </div>--}}
{{--                                            <div class="inner-link">--}}
{{--                                                <a href="#">Kids Toys</a>--}}
{{--                                                <a href="#">Kids Travel Car</a>--}}
{{--                                                <a href="#">Kids Color Shape</a>--}}
{{--                                                <a href="#">Kids Tent</a>--}}
{{--                                            </div>--}}
{{--                                        </li>--}}
{{--                                        <li class="single-menu">--}}
{{--                                            <a href="#" class="title-link">Shop Men's</a>--}}
{{--                                            <div class="image">--}}
{{--                                                <img src="https://via.placeholder.com/225x155" alt="#">--}}
{{--                                            </div>--}}
{{--                                            <div class="inner-link">--}}
{{--                                                <a href="#">Watch</a>--}}
{{--                                                <a href="#">T-shirt</a>--}}
{{--                                                <a href="#">Hoodies</a>--}}
{{--                                                <a href="#">Formal Pant</a>--}}
{{--                                            </div>--}}
{{--                                        </li>--}}
{{--                                        <li class="single-menu">--}}
{{--                                            <a href="#" class="title-link">Shop Women's</a>--}}
{{--                                            <div class="image">--}}
{{--                                                <img src="https://via.placeholder.com/225x155" alt="#">--}}
{{--                                            </div>--}}
{{--                                            <div class="inner-link">--}}
{{--                                                <a href="#">Ladies Shirt</a>--}}
{{--                                                <a href="#">Ladies Frog</a>--}}
{{--                                                <a href="#">Ladies Sun Glass</a>--}}
{{--                                                <a href="#">Ladies Watch</a>--}}
{{--                                            </div>--}}
{{--                                        </li>--}}
{{--                                    </ul>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-9 col-12">--}}
{{--                        <div class="menu-area">--}}
{{--                            <!-- Main Menu -->--}}
{{--                            <nav class="navbar navbar-expand-lg">--}}
{{--                                <div class="navbar-collapse">--}}
{{--                                    <div class="nav-inner">--}}
{{--                                        <ul class="nav main-menu menu navbar-nav">--}}
{{--                                <?php--}}
{{--                                $all_main = DB::table('main_category')->get();--}}
{{--                                ?>--}}
{{--                                            @foreach($all_main as $each_main)--}}
{{--                                            <li><a href="#">{{$each_main->name_main}}<i class="ti-angle-down"></i></a>--}}
{{--                                            <?php--}}
{{--                                                $all_branch = DB::table('branch_category')->where('id_main_category',$each_main->id_main_category)->get();--}}
{{--                                            ?>--}}
{{--                                                    <ul class="dropdown">--}}
{{--                                                        @foreach($all_branch as $each_branch)--}}
{{--                                                        <li><a href="#">{{$each_branch->name_branch}}</a></li>--}}
{{--                                                        @endforeach--}}
{{--                                                    </ul>--}}
{{--                                            </li>--}}
{{--                                            @endforeach--}}
{{--                                        </ul>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </nav>--}}
{{--                            <!--/ End Main Menu -->--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <!--/ End Header Inner -->--}}
{{--</header>--}}
{{--<!--/ End Header -->--}}

{{--@yield('home')--}}
{{--@yield('login')--}}
{{--@yield('signup')--}}

{{--<!-- Start Footer Area -->--}}
{{--<footer class="footer">--}}
{{--    <!-- Footer Top -->--}}
{{--    <div class="footer-top section">--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <div class="col-lg-5 col-md-6 col-12">--}}
{{--                    <!-- Single Widget -->--}}
{{--                    <div class="single-footer about">--}}
{{--                        <div class="logo">--}}
{{--                            <a href="public/assets/index.html"><img src="public/images/logo2.png" alt="#"></a>--}}
{{--                        </div>--}}
{{--                        <p class="text">Praesent dapibus, neque id cursus ucibus, tortor neque egestas augue,  magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus.</p>--}}
{{--                        <p class="call">Got Question? Call us 24/7<span><a href="tel:123456789">+0123 456 789</a></span></p>--}}
{{--                    </div>--}}
{{--                    <!-- End Single Widget -->--}}
{{--                </div>--}}
{{--                <div class="col-lg-2 col-md-6 col-12">--}}
{{--                    <!-- Single Widget -->--}}
{{--                    <div class="single-footer links">--}}
{{--                        <h4>Information</h4>--}}
{{--                        <ul>--}}
{{--                            <li><a href="#">About Us</a></li>--}}
{{--                            <li><a href="#">Faq</a></li>--}}
{{--                            <li><a href="#">Terms & Conditions</a></li>--}}
{{--                            <li><a href="#">Contact Us</a></li>--}}
{{--                            <li><a href="#">Help</a></li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                    <!-- End Single Widget -->--}}
{{--                </div>--}}
{{--                <div class="col-lg-2 col-md-6 col-12">--}}
{{--                    <!-- Single Widget -->--}}
{{--                    <div class="single-footer links">--}}
{{--                        <h4>Customer Service</h4>--}}
{{--                        <ul>--}}
{{--                            <li><a href="#">Payment Methods</a></li>--}}
{{--                            <li><a href="#">Money-back</a></li>--}}
{{--                            <li><a href="#">Returns</a></li>--}}
{{--                            <li><a href="#">Shipping</a></li>--}}
{{--                            <li><a href="#">Privacy Policy</a></li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                    <!-- End Single Widget -->--}}
{{--                </div>--}}
{{--                <div class="col-lg-3 col-md-6 col-12">--}}
{{--                    <!-- Single Widget -->--}}
{{--                    <div class="single-footer social">--}}
{{--                        <h4>Get In Tuch</h4>--}}
{{--                        <!-- Single Widget -->--}}
{{--                        <div class="contact">--}}
{{--                            <ul>--}}
{{--                                <li>NO. 342 - London Oxford Street.</li>--}}
{{--                                <li>012 United Kingdom.</li>--}}
{{--                                <li>info@eshop.com</li>--}}
{{--                                <li>+032 3456 7890</li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                        <!-- End Single Widget -->--}}
{{--                        <ul>--}}
{{--                            <li><a href="#"><i class="ti-facebook"></i></a></li>--}}
{{--                            <li><a href="#"><i class="ti-twitter"></i></a></li>--}}
{{--                            <li><a href="#"><i class="ti-flickr"></i></a></li>--}}
{{--                            <li><a href="#"><i class="ti-instagram"></i></a></li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                    <!-- End Single Widget -->--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <!-- End Footer Top -->--}}
{{--    <div class="copyright">--}}
{{--        <div class="container">--}}
{{--            <div class="inner">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-lg-6 col-12">--}}
{{--                        <div class="left">--}}
{{--                            <p>Copyright © 2020 <a href="http://www.wpthemesgrid.com" target="_blank">Wpthemesgrid</a>  -  All Rights Reserved.</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-6 col-12">--}}
{{--                        <div class="right">--}}
{{--                            <img src="public/images/payments.png" alt="#">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</footer>--}}
{{--<!-- /End Footer Area -->--}}

{{--<!-- Jquery -->--}}
{{--<script src="public/assets/js/jquery.min.js"></script>--}}
{{--<script src="public/assets/js/jquery-migrate-3.0.0.js"></script>--}}
{{--<script src="public/assets/js/jquery-ui.min.js"></script>--}}
{{--<!-- Popper JS -->--}}
{{--<script src="public/assets/js/popper.min.js"></script>--}}
{{--<!-- Bootstrap JS -->--}}
{{--<script src="public/assets/js/bootstrap.min.js"></script>--}}
{{--<!-- Color JS -->--}}
{{--<script src="public/assets/js/colors.js"></script>--}}
{{--<!-- Slicknav JS -->--}}
{{--<script src="public/assets/js/slicknav.min.js"></script>--}}
{{--<!-- Owl Carousel JS -->--}}
{{--<script src="public/assets/js/owl-carousel.js"></script>--}}
{{--<!-- Magnific Popup JS -->--}}
{{--<script src="public/assets/js/magnific-popup.js"></script>--}}
{{--<!-- Waypoints JS -->--}}
{{--<script src="public/assets/js/waypoints.min.js"></script>--}}
{{--<!-- Countdown JS -->--}}
{{--<script src="public/assets/js/finalcountdown.min.js"></script>--}}
{{--<!-- Nice Select JS -->--}}
{{--<script src="public/assets/js/nicesellect.js"></script>--}}
{{--<!-- Flex Slider JS -->--}}
{{--<script src="public/assets/js/flex-slider.js"></script>--}}
{{--<!-- ScrollUp JS -->--}}
{{--<script src="public/assets/js/scrollup.js"></script>--}}
{{--<!-- Onepage Nav JS -->--}}
{{--<script src="public/assets/js/onepage-nav.min.js"></script>--}}
{{--<!-- Easing JS -->--}}
{{--<script src="public/assets/js/easing.js"></script>--}}
{{--<!-- Active JS -->--}}
{{--<script src="public/assets/js/active.js"></script>--}}
{{--</body>--}}
{{--</html>--}}


    <!DOCTYPE html>
<html>
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
                            {{--                            @if(Session::get('id_user'))--}}
                            {{--                                <li>--}}
                            {{--                                    <a--}}
                            {{--                                        <?php--}}
                            {{--                                        $allUserNotification = DB::table('notification')    //lấy hết noti ra--}}
                            {{--                                        ->join('users','notification.id_customer','=','users.id_user')--}}
                            {{--                                            ->where('users.id_user', Session::get('id_user'))--}}
                            {{--                                            ->where('notification.isread_noti','not seen')--}}
                            {{--                                            ->orderBy('notification.date_noti','DESC')--}}
                            {{--                                            ->get();--}}
                            {{--                                        $cnt = count($allUserNotification); //số lượng thông báo mới--}}
                            {{--                                        if($cnt) {--}}
                            {{--                                            echo 'style="color: red"';--}}
                            {{--                                        }--}}
                            {{--                                        ?>--}}
                            {{--                                        href="{{URL::to('/user-view-notification')}}">--}}
                            {{--                                        Thông báo ({{$cnt}})--}}
                            {{--                                    </a>--}}
                            {{--                                </li>--}}
                            {{--                            @endif--}}
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
                    <div class="logo_area"><a href="{{URL::to('/')}}" class="logo"><img src="public/newsfeed/images/logo.jpg" alt="IMarket"></a></div>
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
                    <li class="active"><a href="public/newsfeed/index.html"><span class="fa fa-home desktop-home"></span><span class="mobile-show">Home</span></a></li>

                    <?php
                    $all_main = DB::table('main_category')->get();
                    ?>
                    @foreach($all_main as $each_main)
                        <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{$each_main->name_main}}</a>
                            <?php
                            $all_branch = DB::table('branch_category')->where('id_main_category',$each_main->id_main_category)->get();
                            ?>
                            <ul class="dropdown-menu" role="menu">
                                @foreach($all_branch as $each_branch)
                                    <li><a href="#">{{$each_branch->name_branch}}</a></li>
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
                                        src=""
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


<footer id="footer">
    <div class="footer_top">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4">
                <div class="footer_widget wow fadeInLeftBig">
                    <h2>Flickr Images</h2>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
                <div class="footer_widget wow fadeInDown">
                    <h2>Tag</h2>
                    <ul class="tag_nav">
                        <li><a href="#">Games</a></li>
                        <li><a href="#">Sports</a></li>
                        <li><a href="#">Fashion</a></li>
                        <li><a href="#">Business</a></li>
                        <li><a href="#">Life &amp; Style</a></li>
                        <li><a href="#">Technology</a></li>
                        <li><a href="#">Photo</a></li>
                        <li><a href="#">Slider</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
                <div class="footer_widget wow fadeInRightBig">
                    <h2>Contact</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                    <address>
                        Perfect News,1238 S . 123 St.Suite 25 Town City 3333,USA Phone: 123-326-789 Fax: 123-546-567
                    </address>
                </div>
            </div>
        </div>
    </div>
    <div class="footer_bottom">
        <p class="copyright">Copyright &copy; 2021 <a href="public/newsfeed/index.html">IMarket</a></p>
        <p class="developer">All Rights Reserved</p>
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
