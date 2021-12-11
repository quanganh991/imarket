@extends('header_footer')
@section('news_detail')
    <section id="contentSection">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-8">
                <div class="left_content">
                    <div class="single_page">
                        <ol class="breadcrumb">
                            <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
                            <li>
                                <a href="{{URL::to('/branch-result-'.$newsDetailMain->id_main_category)}}">{{$newsDetailMain->name_main}}</a>
                            </li>
                            <li>
                                <a href="{{URL::to('/news-result-'.$newsDetailBranch->id_branch_category)}}">{{$newsDetailBranch->name_branch}}</a>
                            </li>
                        </ol>
                        <p style="color: saddlebrown; font-size: 35px; font-weight: bold">{{$newsDetail->title}}</p>
                        <?php
                        $author = DB::table('users')
                            ->where('id_user', $newsDetail->id_user)
                            ->get()->first();   //lấy tác giả của bài đăng
                        ?>
                        <div class="post_commentbox"><a href="#"><i class="fa fa-user"></i>{{$author->name_user}}</a>
                            <span><i
                                    class="fa fa-calendar"></i>{{$newsDetail->latest_update}}
                            </span>
                            <a href="{{URL::to('/news-result-'.$newsDetailBranch->id_branch_category)}}"><i
                                    class="fa fa-tags"></i>{{$newsDetailBranch->name_branch}}
                            </a>
                        </div>

                        <div class="single_page_content">
                            <div class="slick_slider">

                                <div class="single_iteam"><a href="{{URL::to('/news-detail-'.$newsDetail->id_news)}}">
                                        <img href="{{URL::to('/news-detail-'.$newsDetail->id_news)}}"
                                             src="{{$newsDetail->title_img}}">
                                    </a>
                                    <div class="slider_article">
                                        <h2><a class="slider_tittle"
                                               href="{{URL::to('/news-detail-'.$newsDetail->id_news)}}"></a>
                                        </h2>
                                        <p></p>
                                    </div>
                                </div>

                                <?php
                                $product = DB::table('product')
                                    ->where('id_product',$newsDetail->id_product)
                                    ->get()
                                    ->first();  //lấy ra product duy nhất ứng với news
                                $img = DB::table('multimedia')
                                    ->where('id_product',$product->id_product)
                                    ->where('type_multi',1)
                                    ->get();    //lấy ra tất cả hình ảnh
                                $vid = DB::table('multimedia')
                                    ->where('id_product',$product->id_product)
                                    ->where('type_multi',2)
                                    ->get();    //lấy ra tất cả video
                                ?>

                                @foreach($vid as $each_of_vid)
                                    <div class="single_iteam">
                                        <div class="slider_article">
                                            <iframe
                                                width="705" height="450"
                                                    src="{{$each_of_vid->url_multi}}"
                                                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                                    allowfullscreen>
                                            </iframe>
                                        </div>
                                    </div>
                                @endforeach

                                @foreach($img as $each_of_img)
                                    <div class="single_iteam"><a href="{{$each_of_img->url_multi}}">
                                            <img href="{{$each_of_img->url_multi}}"
                                                 src="{{$each_of_img->url_multi}}">
                                        </a>
                                        <div class="slider_article">
                                            <h2><a class="slider_tittle"
                                                   href="{{URL::to('/news-detail-'.$newsDetail->id_news)}}"></a>
                                            </h2>
                                            <p></p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>


                            @if(Session::get('id_buyer'))
                                <?php
                                $isSaved = DB::table('bookmarked')
                                    ->where('id_customer', Session::get('id_buyer'))
                                    ->where('id_news', $newsDetail->id_news)
                                    ->get();
                                ?>
                                @if(count($isSaved)==0)
                                    <form action="{{URL::to('/bookmark')}}" method="get">
                                        <input name="id_news" value="{{$newsDetail->id_news}}" type="hidden"/>
                                        <button class="btn default-btn">Lưu bài viết</button>
                                    </form>
                                @else
                                    <form action="{{URL::to('/unbookmark')}}" method="get">
                                        <input name="id_news" value="{{$newsDetail->id_news}}" type="hidden"/>
                                        <button style="background-color: red" class="btn default-btn">Bỏ lưu bài viết</button>
                                    </form>
                                @endif
                            @endif
{{--                            <button class="btn btn-red">Red Button</button>--}}
                        </div>


                        <p style="color: orangered; font-size: 25px; font-weight: bold" >Thông tin:</p>


                        <p style="color: #0b5509">{{$newsDetail->news_context}}</p>


                        <!--Bình luận-->
                        <p style="color: orangered; font-size: 25px; font-weight: bold" >Bình luận:</p>
                        <?php
                        if (Session::get('id_user')) {
                        ?>
                        <form action="{{URL::to('/comment')}}" method="GET">
                            <textarea name="comment" placeholder="Bình luận" rows="6" cols="50"></textarea>
                            <input name="newsid_hidden" type="hidden" value="{{$newsDetail->id_news}}"/>
                            <input id="userid_hidden" name="userid_hidden" type="hidden"
                                   value="{{Session::get('id_user')}}"/>
                            <br>
                            <button type="submit" class="btn-template-main">Gửi bình luận</button>
                        </form>
                        <?php
                        } else {
                            echo "Bạn phải đăng nhập để bình luận";
                        }
                        //hiển thị bình luận
                        $commentList = DB::table('coment')  //chứa coment của user
                        ->join('users', 'users.id_user', '=', 'coment.id_customer')
                            ->where('coment.id_news', $newsDetail->id_news)
                            ->get();
                        ?>
                        @foreach($commentList as $eachCommentList)
                            @if($eachCommentList->status_user == 1 && $eachCommentList->is_valid_coment == 1)
                            <row>
                            <?php
                            $user = DB::table('users') //chứa coment của độc giả
                            ->where('id_user', $eachCommentList->id_customer)
                                ->get()->first();
                            ?>
                            @if($user->status_user == 1)    <!--Nếu ko bị khóa tài khoản thì mới hiển thị bình luận-->
                                <hr>
                                @if($user->type_of_user != 2)
                                    <p style="color: #2b527e; font-size: 20px; font-weight: bold">{{$eachCommentList->name_user}}</p>
                                @elseif($user->type_of_user == 2)
                                    <p style="color: red; font-size: 20px; font-weight: bold">Admin: {{$eachCommentList->name_user}}</p>
                                @endif
                                <p style="color: red; font-size: 15px; font-weight: bold"><i class="fa fa-comment"
                                       aria-hidden="true"></i> {{$eachCommentList->context_coment}}</p>
                            @endif

                            @if(Session::get('id_admin'))
                                <a href="{{URL::to('/admin-delete-comment/'.$eachCommentList->id_coment)}}">Xóa
                                    comment</a>
                                |
                                <a href="{{URL::to('/admin-block-user/'.$eachCommentList->id_customer)}}">Khóa tài
                                    khoản</a>
                            @endif
                            </row>
                            {{-- 2 sự lựa chọn: Trả lời bình luận và xem các câu trả lời--}}
                                <li class="dropdown">
                                    <button class="btn btn-sm btn-secondary dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false" style="color: green">
                                        Trả lời {{$eachCommentList->name_user}}
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <form class="dropdown-item" action="{{URL::to('/reply')}}" method="GET">
                                            <textarea name="reply" placeholder="Bình luận" rows="6" cols="50"></textarea>
                                            <input name="commentid_hidden" type="hidden"
                                                   value="{{$eachCommentList->id_coment}}"/>
                                            <input id="userid_hidden" name="userid_hidden" type="hidden"
                                                   value="{{Session::get('id_user')}}"/>
                                            <br>
                                            <button type="submit" class="btn-template-main">Gửi trả lời</button>
                                        </form>
                                    </div>
                                </li>
                                <!--Reply-->
                                <li class="dropdown">
                                    <button class="btn btn-sm btn-secondary dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false" style="color: green">
                                        Xem các phản hồi về bình luận
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <?php
                                        $reply = DB::table('reply')
                                            ->where('id_coment', $eachCommentList->id_coment)
                                            ->get();
                                        ?>
                                        @foreach($reply as $eachOfReply)
                                            <?php
                                            $userRep = DB::table('users') //chứa reply của độc giả
                                            ->where('id_user', $eachOfReply->id_customer)
                                                ->get()->first();
                                            ?>
                                            @if($userRep->status_user == 1 && $eachOfReply->is_valid_reply == 1)
                                                @if($userRep->type_of_user != 2)
                                                    <p style="color: white; font-size: 20px; font-weight: bold" class="dropdown-item">{{$userRep->name_user}}</p>
                                                @elseif($userRep->type_of_user == 2)
                                                    <p style="color: yellow; font-size: 20px; font-weight: bold" class="dropdown-item">Admin: {{$userRep->name_user}}</p>
                                                @endif
                                                <p style="color: lightsalmon; font-size: 20px; font-weight: bold" class="dropdown-item"><i
                                                        class="fa fa-comment"
                                                        aria-hidden="true"></i> {{$eachOfReply->context_reply}}
                                                </p>

                                                @if(Session::get('id_admin'))
                                                    <a style="color: #e63084"
                                                       href="{{URL::to('/admin-delete-reply/'.$eachOfReply->id_reply)}}">Xóa
                                                        comment</a>
                                                    |
                                                    <a style="color: #e63084"
                                                       href="{{URL::to('/admin-block-user/'.$eachCommentList->id_customer)}}">Khóa tài
                                                        khoản</a>
                                                @endif
                                            @endif

                                            @endforeach
                                    </div>
                                </li>
                            @endif
                            <!--Hết Reply-->
                            <hr>
                            <hr>
                        @endforeach
                    <!--Hết Bình luận-->
                        <div class="social_link">
                            <ul class="sociallink_nav">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                            </ul>
                        </div>
                        <div class="related_post">
                            <p style=" font-size: 30px; font-weight: bold">Bài viết liên quan<i class="fa fa-thumbs-o-up"></i></p>
                            <ul class="spost_nav wow fadeInDown animated">
                                @foreach($relevantNewsDetail as $eachOfRelevantNewsDetail)
                                    <li>
                                        <div class="media">
                                            <a class="media-left"
                                               href="{{URL::to('/news-detail-'.$eachOfRelevantNewsDetail->id_news)}}">
                                                <img
                                                    src="{{$eachOfRelevantNewsDetail->title_img}}"
                                                    alt="">
                                            </a>
                                            <div class="media-body"><a class="catg_title"
                                                                       href="{{URL::to('/news-detail-'.$eachOfRelevantNewsDetail->id_news)}}">{{$eachOfRelevantNewsDetail->title}}</a>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            $relevantNews = DB::table('news')->where('id_branch_category', $newsDetailBranch->id_branch_category)->get();
            $pre = 0;
            $next = 0;
            foreach ($relevantNews as $key => $eachOfRelevantNews) {
                if ($eachOfRelevantNews->id_news == $newsDetail->id_news) {
                    if ($key == 0) {
                        $pre = count($relevantNews) - 1;
                        $next = ($key + 1) % count($relevantNews);
                    } else if ($key == count($relevantNews) - 1) {
                        $pre = ($key - 1) % count($relevantNews);
                        $next = 0;
                    } else {
                        $pre = ($key - 1) % count($relevantNews);
                        $next = ($key + 1) % count($relevantNews);
                    }
                    $pre = $relevantNews[$pre];
                    $next = $relevantNews[$next];
                    break;
                }
            }
            ?>
            <nav class="nav-slit">
                <a class="prev" href="{{URL::to('/news-detail-'.$pre->id_news)}}">
                    <span class="icon-wrap">
                        <i class="fa fa-angle-left"></i>
                    </span>
                    <div>
                        <h3>{{$pre->title}}</h3>
                        <img src="{{$pre->title_img}}" alt=""/>
                    </div>
                </a>
                <a class="next" href="{{URL::to('/news-detail-'.$next->id_news)}}">
                    <span class="icon-wrap">
                        <i class="fa fa-angle-right"></i>
                    </span>
                    <div>
                        <h3>{{$next->title}}</h3>
                        <img src="{{$pre->title_img}}" alt=""/>
                    </div>
                </a>
            </nav>
            <div class="col-lg-4 col-md-4 col-sm-4">
                <aside class="right_content">
                    <div class="single_sidebar">
                        <h2><span>Bài viết mới nhất về {{$newsDetailBranch->name_branch}}</span></h2>
                        <ul class="spost_nav">
                            <?php
                            $newsEst = DB::table('news') //chứa 5 tin tức mới nhất có $id_branch_category
                            ->where('id_branch_category', $newsDetailBranch->id_branch_category)
                                ->orderBy('latest_update', 'DESC')
                                ->take(5)
                                ->get();
                            ?>
                            @foreach($newsEst as $eachOfNewsEst)
                                <li>
                                    <div class="media wow fadeInDown"><a
                                            href="{{URL::to('/news-detail-'.$eachOfNewsEst->id_news)}}"
                                            class="media-left">
                                            <img alt=""
                                                 src="{{$eachOfNewsEst->title_img}}">
                                        </a>
                                        <div class="media-body"><a
                                                href="{{URL::to('/news-detail-'.$eachOfNewsEst->id_news)}}"
                                                class="catg_title">{{$eachOfNewsEst->title}}</a>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="single_sidebar">
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#category" aria-controls="home" role="tab"
                                                                      data-toggle="tab">{{$newsDetailMain->name_main}}
                                    /{{$newsDetailBranch->name_branch}}</a></li>
                            <li role="presentation"><a href="#video" aria-controls="profile" role="tab"
                                                       data-toggle="tab">Video
                                    trong {{$newsDetailBranch->name_branch}}</a></li>
                            <li role="presentation"><a href="#comments" aria-controls="messages" role="tab"
                                                       data-toggle="tab">Bình luận
                                    trong {{$newsDetailBranch->name_branch}}</a></li>
                        </ul>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="category">
                                <!--Các branch khác trong cùng main-->
                                <ul>
                                    @foreach($branchInSameMain as $eachOfBranchInSameMain)
                                        <li class="cat-item"><a
                                                href="{{URL::to('/branch-result-'.$eachOfBranchInSameMain->id_branch_category)}}">{{$eachOfBranchInSameMain->name_branch}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="video">   <!--Video trong cùng branch-->
                                <div class="vide_area">
                                    @foreach($videoInSameBranch as $eachOfVideoInSameBranch)
                                        <?php
                                        $product = DB::table('product')
                                            ->where('id_product',$eachOfVideoInSameBranch->id_product)
                                            ->get()
                                            ->first();  //lấy ra product duy nhất ứng với news
                                        $vid = DB::table('multimedia')
                                            ->where('id_product',$product->id_product)
                                            ->where('type_multi',2)
                                            ->get();    //lấy ra tất cả video
                                        ?>
                                        @foreach($vid as $each_of_vid)
                                            <iframe width="320" height="180"
                                                    src="{{$each_of_vid->url_multi}}"
                                                    frameborder="0"
                                                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                                    allowfullscreen>
                                            </iframe>
                                        @endforeach
                                    @endforeach
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="comments">   <!--Comment hàng đầu trong cùng branch-->
                                <ul class="spost_nav">
                                    @foreach($relevantNewsDetail as $eachOfRelevantNewsDetail)
                                        <?php
                                        $comment = DB::table('coment')
                                            ->where('id_news', $eachOfRelevantNewsDetail->id_news)
                                            ->orderBy('likes_coment', 'DESC')
                                            ->get();
                                        ?>
                                        @foreach($comment as $eachOfComment)
                                            <li>
                                                <div class="media wow fadeInDown">
                                                    <a href="{{URL::to('/news-detail-'.$eachOfComment->id_news)}}"
                                                       class="media-left">
                                                        <img alt=""
                                                             src="{{$eachOfRelevantNewsDetail->title_img}}">
                                                    </a>
                                                    <?php
                                                    $commentPeople = DB::table('users')
                                                        ->where('id_user', $eachOfComment->id_customer)
                                                        ->get()->first();
                                                    ?>
                                                    <p>{{$commentPeople->name_user}}</p>
                                                    <div class="media-body">
                                                        <a href="{{URL::to('/news-detail-'.$eachOfComment->id_news)}}"
                                                           class="catg_title">
                                                            {{$eachOfComment->context_coment}}
                                                        </a>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </section>
@endsection
