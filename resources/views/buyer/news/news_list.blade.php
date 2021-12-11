@extends('header_footer')
@section('news_list')
    <section id="sliderSection">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-8">
                <div class="slick_slider">
                    <ol class="breadcrumb">
                        <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
                        <li>
                            <a href="{{URL::to('/branch-result-'.$mainSearch->id_main_category)}}">{{$mainSearch->name_main}}</a>
                        </li>
                        <li  style="color: yellow">
                            {{$branchSearch->name_branch}}
                        </li>
                    </ol>
                    @if(count($newsSearch) > 0)
                        <div class="single_iteam"><a href="{{URL::to('/news-detail-'.$newsSearch[0]->id_news)}}"> <img
                                    src="{{$newsSearch[0]->title_img}}" alt=""></a>
                            <div class="slider_article">
                                <h2><a class="slider_tittle"
                                       href="{{URL::to('/news-detail-'.$newsSearch[0]->id_news)}}">{{$newsSearch[0]->title}}</a>
                                </h2>
                                <p>{{strlen($newsSearch[0]->news_context) > 200 ? substr($newsSearch[0]->news_context,0,200).'...' : $newsSearch[0]->news_context}}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
                <div class="latest_post">
                    <h2><span>Bài viết mới nhất về {{$branchSearch->name_branch}}</span></h2>
                    <div class="latest_post_container">
                        <div id="prev-button"><i class="fa fa-chevron-up"></i></div>
                        <ul class="latest_postnav">
                            @foreach($newsSearch as $key => $eachOfNewsSearch)
                                <li>
                                    <div class="media"><a href="{{URL::to('/news-detail-'.$eachOfNewsSearch->id_news)}}"
                                                          class="media-left"> <img
                                                alt="" src="{{$eachOfNewsSearch->title_img}}"> </a>
                                        <div class="media-body"><a
                                                href="{{URL::to('/news-detail-'.$eachOfNewsSearch->id_news)}}"
                                                class="catg_title">
                                                {{$eachOfNewsSearch->title}}</a></div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        <div id="next-button"><i class="fa  fa-chevron-down"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="contentSection">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-8">
                <div class="left_content">
                    <div class="single_post_content">
                        <h2><span>{{$branchSearch->name_branch}}</span></h2>
                        <ul class="business_catgnav  wow fadeInDown">
                            <li>
                                @if(count($newsSearch) > 1)
                                    <figure class="bsbig_fig"><a
                                            href="{{URL::to('/news-detail-'.$newsSearch[1]->id_news)}}"
                                            class="featured_img"> <img alt=""
                                                                       src="{{$newsSearch[1]->title_img}}"
                                                                       height="200px">
                                            <span class="overlay"></span> </a>
                                        <figcaption><a
                                                href="{{URL::to('/news-detail-'.$newsSearch[1]->id_news)}}">{{$newsSearch[1]->title}}</a>
                                        </figcaption>
                                        <p>{{strlen($newsSearch[1]->news_context) > 200 ? substr($newsSearch[1]->news_context,0,195).'...' : $newsSearch[1]->news_context}}</p>
                                        <br>
                                    </figure>
                                @endif
                            </li>
                        </ul>
                        <ul class="spost_nav">
                            @foreach($newsSearch as $key => $eachOfNewsSearch)
                                @if($key>=2)
                                    <li>
                                        <div class="media wow fadeInDown"><a
                                                href="{{URL::to('/news-detail-'.$eachOfNewsSearch->id_news)}}"
                                                class="media-left"> <img alt=""
                                                                         src="{{$eachOfNewsSearch->title_img}}">
                                            </a>
                                            <div class="media-body">
                                                <a href="{{URL::to('/news-detail-'.$eachOfNewsSearch->id_news)}}"
                                                   class="catg_title">{{$eachOfNewsSearch->title}}</a>
                                                <br>
                                                <p>{{strlen($eachOfNewsSearch->news_context) > 200 ? substr($eachOfNewsSearch->news_context,0,195).'...' : $eachOfNewsSearch->news_context}}</p>
                                            </div>
                                        </div>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>

                    <div class="single_post_content">
                        <h2><span>Ảnh/Video về sản phẩm</span></h2>
                        <ul class="photograph_nav  wow fadeInDown">
                            @foreach($newsSearchImageOnly as $eachOfNewsSearchImageOnly)
                                <?php
                                $product = DB::table('product')
                                    ->where('id_product',$eachOfNewsSearchImageOnly->id_product)
                                    ->get()
                                    ->first();  //lấy ra product duy nhất ứng với news
                                $img = DB::table('multimedia')
                                    ->where('id_product',$product->id_product)
                                    ->where('type_multi',1)
                                    ->get();    //lấy ra tất cả hình ảnh
                                ?>
                                @foreach($img as $key=> $each_img)
                                <li>

                                    <div class="photo_grid">
                                        <figure class="effect-layla">
                                            <a class="fancybox-buttons" data-fancybox-group="button" href="{{URL::to('/news-detail-'.$eachOfNewsSearchImageOnly->id_news)}}"
                                               title="{{$eachOfNewsSearchImageOnly->title}}">
                                                <img src="{{$each_img->url_multi}}" alt=""/>
                                            </a>
                                        </figure>
                                    </div>
                                </li>
                            @endforeach

                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
                <aside class="right_content">
                    <div class="single_sidebar">
                        <h2><span>Phổ biến nhất về {{$branchSearch->name_branch}}</span></h2>
                        <!--Nhiều lượt xem nhất đến ít lượt xem nhất-->
                        <ul class="spost_nav">
                            @foreach($newsSearchPopular as $eachNewsSearchPopular)
                                <li>
                                    <div class="media wow fadeInDown"><a
                                            href="{{URL::to('/news-detail-'.$eachNewsSearchPopular->id_news)}}"
                                            class="media-left"> <img alt=""
                                                                     src="{{$eachNewsSearchPopular->title_img}}">
                                        </a>
                                        <div class="media-body"><a
                                                href="{{URL::to('/news-detail-'.$eachNewsSearchPopular->id_news)}}"
                                                class="catg_title">
                                                {{$eachNewsSearchPopular->title}}</a></div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="single_sidebar">
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#category" aria-controls="home" role="tab"
                                                                      data-toggle="tab">Chuyên mục {{$branchSearch->name_branch}}</a></li>
                            <li role="presentation"><a href="#video" aria-controls="profile" role="tab"
                                                       data-toggle="tab">Video về {{$branchSearch->name_branch}}</a>
                            </li>
                            <li role="presentation"><a href="#comments" aria-controls="messages" role="tab"
                                                       data-toggle="tab">Bình luận về {{$branchSearch->name_branch}}</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="category"> <!--Chuyên mục cùng branch-->
                                <ul>
                                    <?php
                                    $branch = DB::table('branch_category')
                                        ->where('id_main_category', $mainSearch->id_main_category)
                                        ->get();
                                    ?>
                                    @foreach($branch as $eachOfBranch)
                                        <li class="cat-item"><a
                                                href="{{URL::to('/news-result-'.$eachOfBranch->id_branch_category)}}">{{$eachOfBranch->name_branch}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="video">   <!--Video trong cùng branch-->
                                <div class="vide_area">
                                    @foreach($newsSearchVideoOnly as $eachOfNewsSearchVideoOnly)
                                        <?php
                                        $product = DB::table('product')
                                            ->where('id_product',$eachOfNewsSearchVideoOnly->id_product)
                                            ->get()
                                            ->first();  //lấy ra product duy nhất ứng với news
                                        $vid = DB::table('multimedia')
                                            ->where('id_product',$product->id_product)
                                            ->where('type_multi',2)
                                            ->get();    //lấy ra tất cả Video
                                        ?>
                                        @foreach($vid as $each_vid)
                                            <iframe width="560" height="315"
                                                    src="{{$each_vid->url_multi}}"
                                                    frameborder="0"
                                                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                                    allowfullscreen>
                                                {{$eachOfNewsSearchVideoOnly->title}}
                                            </iframe>
                                        @endforeach
                                    @endforeach
                                </div>
                            </div>
{{--                            <div role="tabpanel" class="tab-pane" id="comments">--}}
{{--                                <!--Bình luận nhiều like nhất đến ít like nhất-->--}}
{{--                                <ul class="spost_nav">--}}
{{--                                    @foreach($newsSearch as $eachOfNewsSearch)--}}
{{--                                        <?php--}}
{{--                                        $comment = DB::table('coment')--}}
{{--                                            ->where('id_news', $eachOfNewsSearch->id_news)--}}
{{--                                            ->orderBy('likes_coment', 'DESC')--}}
{{--                                            ->get();--}}
{{--                                        ?>--}}
{{--                                        @foreach($comment as $eachOfComment)--}}
{{--                                            <li>--}}
{{--                                                <div class="media wow fadeInDown"><a--}}
{{--                                                        href="{{URL::to('/news-detail-'.$eachOfComment->id_news)}}"--}}
{{--                                                        class="media-left"> <img alt=""--}}
{{--                                                                                 src="<?php echo (explode("***<paragraph/>***", nl2br($eachOfNewsSearch->multimedia)))[0] ?>">--}}
{{--                                                    </a>--}}
{{--                                                    <?php--}}
{{--                                                    $commentPeople = DB::table('users')--}}
{{--                                                        ->where('id_user',$eachOfComment->id_customer)--}}
{{--                                                        ->get()->first();--}}
{{--                                                    ?>--}}
{{--                                                    <p>{{$commentPeople->name_user}}</p>--}}
{{--                                                    <div class="media-body"><a--}}
{{--                                                            href="{{URL::to('/news-detail-'.$eachOfComment->id_news)}}"--}}
{{--                                                            class="catg_title">{{$eachOfComment->context_coment}}</a>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </li>--}}
{{--                                        @endforeach--}}
{{--                                    @endforeach--}}
{{--                                </ul>--}}
{{--                            </div>--}}
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </section>
@endsection
