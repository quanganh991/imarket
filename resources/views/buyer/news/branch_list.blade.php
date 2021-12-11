@extends('header_footer')
@section('branch_list')
    <section id="sliderSection">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-8">
                <div class="slick_slider">
                    <ol class="breadcrumb">
                        <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
                        <li style="color: yellow">
                            Các bài viết trong main {{$mainSearch->name_main}}
                        </li>
                    </ol>
                    @foreach($newsSearch as $eachOfNewsSearch)
                        <div class="single_iteam"><a href="{{URL::to('/news-detail-'.$eachOfNewsSearch->id_news)}}">
                                <img href="{{URL::to('/news-detail-'.$eachOfNewsSearch->id_news)}}"
                                     src="{{$eachOfNewsSearch->title_img}}">
                            </a>
                            <div class="slider_article">
                                <h2><a class="slider_tittle"
                                       href="{{URL::to('/news-detail-'.$eachOfNewsSearch->id_news)}}">{{$eachOfNewsSearch->title}}</a>
                                </h2>
                                <p>{{strlen($eachOfNewsSearch->news_context) > 200 ? substr($eachOfNewsSearch->news_context,0,200).'...' : $eachOfNewsSearch->news_context}}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
                <div class="latest_post">
                    <h2><span>Mới nhất về {{$mainSearch->name_main}}</span></h2>
                    <div class="latest_post_container">
                        <div id="prev-button"><i class="fa fa-chevron-up"></i></div>
                        <ul class="latest_postnav">
                            @foreach($newsSearch as $key => $eachOfNewsSearch)
                                <li>
                                    <div class="media"><a href="{{URL::to('/news-detail-'.$eachOfNewsSearch->id_news)}}" class="media-left">
                                            <img alt="" src="{{$eachOfNewsSearch->title_img}}"></a>
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
                        @if(count($branchSearch) > 0)
                            <h2><span>{{$branchSearch[0]->name_branch}}</span></h2>
                            <div class="single_post_content_left">
                                <ul class="business_catgnav  wow fadeInDown">
                                    <li>
                                        <?php
                                        $newSearch2 = DB::table('news')
                                            ->where('id_branch_category', $branchSearch[0]->id_branch_category)->get()->first();
                                        ?>
                                        @if($newSearch2 != null)
                                            <figure class="bsbig_fig"><a href="{{URL::to('/news-detail-'.$newSearch2->id_news)}}" class="featured_img">
                                                    <img src="{{$newSearch2->title_img}}">
                                                    <span class="overlay"></span> </a>
                                                <figcaption><a
                                                        href="{{URL::to('/news-detail-'.$newSearch2->id_news)}}">{{$newSearch2->title}}</a>
                                                </figcaption>
                                                <p>{{strlen($newSearch2->news_context) > 100 ? substr($newSearch2->news_context,0,100).'...' : $newSearch2->news_context}}</p>
                                            </figure>
                                        @endif
                                    </li>
                                </ul>
                            </div>
                        @endif
                        <div class="single_post_content_right">
                            <ul class="spost_nav">
                                @if(count($branchSearch) > 0)
                                    <?php
                                    $newsSearch3 = DB::table('news')
                                        ->where('id_branch_category', $branchSearch[0]->id_branch_category)->get();
                                    ?>
                                    @foreach($newsSearch3 as $key => $eachOfNewsSearch3)
                                        @if($key!=0)
                                            <li>
                                                <div class="media wow fadeInDown">
                                                    <a href="{{URL::to('/news-detail-'.$eachOfNewsSearch3->id_news)}}"
                                                       class="media-left">
                                                        <img alt=""
                                                             src="{{$eachOfNewsSearch3->title_img}}">
                                                    </a>
                                                    <div class="media-body"><a
                                                            href="{{URL::to('/news-detail-'.$eachOfNewsSearch3->id_news)}}"
                                                            class="catg_title">{{$eachOfNewsSearch3->title}}</a>
                                                    </div>
                                                </div>
                                            </li>
                                        @endif
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                    <div class="fashion_technology_area">
                        <div class="fashion">
                            <div class="single_post_content">
                                @if(count($branchSearch) > 1)
                                    <h2><span>{{$branchSearch[1]->name_branch}}</span></h2>
                                    <ul class="business_catgnav wow fadeInDown">
                                        <?php
                                        $newsSearch4 = DB::table('news')
                                            ->where('id_branch_category', $branchSearch[1]->id_branch_category)->get()->first();
                                        ?>
                                        <li>@if($newsSearch4 != null)
                                                <figure class="bsbig_fig"><a
                                                        href="{{URL::to('/news-detail-'.$newsSearch4->id_news)}}"
                                                        class="featured_img">
                                                        <img alt=""
                                                             src="{{$newsSearch4->title_img}}">
                                                        <span class="overlay"></span> </a>
                                                    <figcaption><a
                                                            href="{{URL::to('/news-detail-'.$newsSearch4->id_news)}}">{{$newsSearch4->title}}</a>
                                                    </figcaption>
                                                    <p>{{strlen($newsSearch4->news_context) > 100 ? substr($newsSearch4->news_context,0,100).'...' : $newsSearch4->news_context}}</p>
                                                </figure>@endif
                                        </li>
                                    </ul>
                                @endif
                                <ul class="spost_nav">
                                    @if(count($branchSearch) > 1)
                                        <li>
                                            <?php
                                            $newsSearch5 = DB::table('news')
                                                ->where('id_branch_category', $branchSearch[1]->id_branch_category)->get();
                                            ?>
                                            @foreach($newsSearch5 as $key => $eachOfNewsSearch5)
                                                @if($key!=0)
                                                    <div class="media wow fadeInDown"><a
                                                            href="{{URL::to('/news-detail-'.$eachOfNewsSearch5->id_news)}}"
                                                            class="media-left"> <img alt=""
                                                                                     src="{{$eachOfNewsSearch5->title_img}}">
                                                        </a>
                                                        <div class="media-body"><a
                                                                href="{{URL::to('/news-detail-'.$eachOfNewsSearch5->id_news)}}"
                                                                class="catg_title">{{$eachOfNewsSearch5->title}}</a>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <div class="technology">
                            <div class="single_post_content">
                                @if(count($branchSearch) > 2)
                                    <h2><span>{{$branchSearch[2]->name_branch}}</span></h2>
                                    <ul class="business_catgnav">
                                        <?php
                                        $newsSearch6 = DB::table('news')
                                            ->where('id_branch_category', $branchSearch[2]->id_branch_category)->get()->first();
                                        ?>
                                        <li>@if(($newsSearch6) != null)
                                                <figure class="bsbig_fig wow fadeInDown"><a
                                                        href="{{URL::to('/news-detail-'.$newsSearch6->id_news)}}"
                                                        class="featured_img">
                                                        <img alt=""
                                                             src="{{$newsSearch6->title_img}}">
                                                        <span class="overlay"></span> </a>
                                                    <figcaption><a
                                                            href="{{URL::to('/news-detail-'.$newsSearch6->id_news)}}">{{$newsSearch6->title}}</a>
                                                    </figcaption>
                                                    <p>{{strlen($newsSearch6->news_context) > 100 ? substr($newsSearch6->news_context,0,100).'...' : $newsSearch6->news_context}}</p>
                                                </figure>@endif
                                        </li>
                                    </ul>
                                @endif
                                <ul class="spost_nav">
                                    @if(count($branchSearch) > 2)
                                        <li>
                                            <?php
                                            $newsSearch7 = DB::table('news')
                                                ->where('id_branch_category', $branchSearch[2]->id_branch_category)->get();
                                            ?>
                                            @foreach($newsSearch7 as $key => $eachOfNewsSearch7)
                                                @if($key!=0)
                                                    <div class="media wow fadeInDown"><a
                                                            href="{{URL::to('/news-detail-'.$eachOfNewsSearch7->id_news)}}"
                                                            class="media-left"> <img alt=""
                                                                                     src="{{$eachOfNewsSearch7->title_img}}">
                                                        </a>
                                                        <div class="media-body"><a
                                                                href="{{URL::to('/news-detail-'.$eachOfNewsSearch7->id_news)}}"
                                                                class="catg_title">{{$eachOfNewsSearch7->title}}</a>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="single_post_content">
                        <h2><span>Ảnh/Video về Sản phẩm</span></h2>
                        <ul class="photograph_nav  wow fadeInDown">
                            @foreach($newsSearchProductImageOnly as $eachOfNewsSearchProductImageOnly)
                                <li>
                                    <?php
                                        $product = DB::table('product')
                                            ->where('id_product',$eachOfNewsSearchProductImageOnly->id_product)
                                            ->get()
                                            ->first();  //lấy ra product duy nhất ứng với news
                                        $img = DB::table('multimedia')
                                            ->where('id_product',$product->id_product)
                                            ->where('type_multi',1)
                                            ->get();    //lấy ra tất cả hình ảnh
                                    ?>
                                    @foreach($img as $each_img)
                                    <div class="photo_grid">
                                        <figure class="effect-layla">
                                            <a class="fancybox-buttons" data-fancybox-group="button"
                                               href="{{URL::to('/news-detail-'.$eachOfNewsSearchProductImageOnly->id_news)}}"
                                               title="{{$eachOfNewsSearchProductImageOnly->title}}">
                                                <img
                                                    src="{{$each_img->url_multi}}"
                                                    alt=""/>
                                            </a>
                                        </figure>
                                    </div>
                                    @endforeach
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
                <aside class="right_content">
                    <div class="single_sidebar">
                        <h2><span>Phổ biến nhất về {{$mainSearch->name_main}}</span></h2>
                        <ul class="spost_nav">
                            @foreach($newsSearchCheapest as $eachNewsSearchCheapest)
                                <li>
                                    <div class="media wow fadeInDown"><a
                                            href="{{URL::to('/news-detail-'.$eachNewsSearchCheapest->id_news)}}"
                                            class="media-left"> <img alt=""
                                                                     src="{{$eachNewsSearchCheapest->title_img}}">
                                        </a>
                                        <div class="media-body"><a
                                                href="{{URL::to('/news-detail-'.$eachNewsSearchCheapest->id_news)}}"
                                                class="catg_title">
                                                {{$eachNewsSearchCheapest->title}}</a></div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="single_sidebar">
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#category" aria-controls="home" role="tab"
                                                                      data-toggle="tab">Chuyên mục {{$mainSearch->name_main}}</a></li>
                            <li role="presentation"><a href="#video" aria-controls="profile" role="tab"
                                                       data-toggle="tab">Video về {{$mainSearch->name_main}}</a></li>
                            <li role="presentation"><a href="#comments" aria-controls="messages" role="tab"
                                                       data-toggle="tab">Bình luận về {{$mainSearch->name_main}}</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="category"> <!--Chuyên mục-->
                                <ul>
                                    @foreach($branchSearch as $eachOfBranchSearch)
                                        <li class="cat-item"><a
                                                href="{{URL::to('/news-result-'.$eachOfBranchSearch->id_branch_category)}}">{{$eachOfBranchSearch->name_branch}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="video">   <!--Video trong cùng main-->
                                <div class="vide_area">
                                    @foreach($newsSearchProductVideoOnly as $eachOfNewsSearchProductVideoOnly)
                                        <?php
                                        $product = DB::table('product')
                                            ->where('id_product',$eachOfNewsSearchProductVideoOnly->id_product)
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
                                                {{$eachOfNewsSearchProductVideoOnly->title}}
                                            </iframe>
                                        @endforeach
                                    @endforeach
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="comments">    <!--Bình luận-->
                                <ul class="spost_nav">
                                    @foreach($newsSearch as $eachOfNewsSearch)
                                        <?php
                                        $comment = DB::table('coment')
                                            ->where('id_news', $eachOfNewsSearch->id_news)
                                            ->orderBy('likes_coment', 'DESC')
                                            ->get();
                                        ?>
                                        @foreach($comment as $eachOfComment)
                                            <li>
                                                <div class="media wow fadeInDown"><a
                                                        href="{{URL::to('/news-detail-'.$eachOfComment->id_news)}}"
                                                        class="media-left"> <img alt=""
                                                                                 src="{{$eachOfNewsSearch->title_img}}">
                                                    </a>
                                                    <?php
                                                    $commentPeople = DB::table('users')
                                                        ->where('id_user', $eachOfComment->id_customer)
                                                        ->get()->first();
                                                    ?>
                                                    <p>{{$commentPeople->name_user}}</p>
                                                    <div class="media-body"><a
                                                            href="{{URL::to('/news-detail-'.$eachOfComment->id_news)}}"
                                                            class="catg_title">{{$eachOfComment->context_coment}}</a>
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
