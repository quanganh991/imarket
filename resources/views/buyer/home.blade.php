@extends('header_footer')
@section('home')
    <section id="sliderSection">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-8">
                <div class="slick_slider">

                    @if(count($newsSearch_newest)>0)
                    @foreach($newsSearch_newest as $eachOfNewsSearch_newest)
                        <div class="single_iteam">
                            <a href="{{URL::to('/news-detail-'.$eachOfNewsSearch_newest->id_news)}}">
                                <img src="{{$eachOfNewsSearch_newest->title_img}}">
                            </a>
                            <div class="slider_article">
                                <h2>
                                    <a class="slider_tittle"
                                       href="{{URL::to('/news-detail-'.$eachOfNewsSearch_newest->id_news)}}">{{$eachOfNewsSearch_newest->title}}</a>
                                </h2>
                                <p>{{strlen($eachOfNewsSearch_newest->news_context) > 200 ? substr($eachOfNewsSearch_newest->news_context,0,195).'...' : $eachOfNewsSearch_newest->news_context}}</p>
                            </div>
                        </div>
                    @endforeach
                    @endif
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
                <div class="latest_post">
                    <h2><span>{{$all_main[0]->name_main}}</span></h2>
                    <div class="latest_post_container">
                        <div id="prev-button"><i class="fa fa-chevron-up"></i></div>
                        <ul class="latest_postnav">
                            @if(count($newsSearch_main0)>0)
                            @foreach($newsSearch_main0 as $each_of_newsSearch_main0)
                                <li>
                                    <div class="media">
                                        <a href="{{URL::to('/news-detail-'.$each_of_newsSearch_main0->id_news)}}"
                                           class="media-left">
                                            <img alt="" src="{{$each_of_newsSearch_main0->title_img}}"> </a>
                                        <div class="media-body">
                                            <a href="{{URL::to('/news-detail-'.$each_of_newsSearch_main0->id_news)}}"
                                               class="catg_title">{{$each_of_newsSearch_main0->title}}</a></div>
                                    </div>
                                </li>
                            @endforeach
                            @endif
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
                        <h2><span>{{$all_main[1]->name_main}}</span></h2>
                        <div class="single_post_content_left">
                            <ul class="business_catgnav  wow fadeInDown">
                                @if(count($newsSearch_main1)>0)
                                <li>
                                    <figure class="bsbig_fig"><a href="{{URL::to('/news-detail-'.$newsSearch_main1[0]->id_news)}}"
                                                                 class="featured_img"> <img alt=""
                                                                                            src="{{$newsSearch_main1[0]->title_img}}">
                                            <span class="overlay"></span> </a>
                                        <figcaption><a
                                                href="{{URL::to('/news-detail-'.$newsSearch_main1[0]->id_news)}}">{{$newsSearch_main1[0]->title}}</a>
                                        </figcaption>
                                        <p>{{strlen($newsSearch_main1[0]->news_context) > 200 ? substr($newsSearch_main1[0]->news_context,0,195).'...' : $newsSearch_main1[0]->news_context}}</p>
                                    </figure>
                                </li>
                                @endif
                            </ul>
                        </div>
                        <div class="single_post_content_right">
                            <ul class="spost_nav">
                                @if(count($newsSearch_main1)>0)
                                @foreach($newsSearch_main1 as $key => $each_of_newsSearch_main1)
                                    @if($key>0)
                                        <li>
                                            <div class="media wow fadeInDown"><a
                                                    href="{{URL::to('/news-detail-'.$each_of_newsSearch_main1->id_news)}}"
                                                    class="media-left"> <img alt=""
                                                                             src="{{$each_of_newsSearch_main1->title_img}}">
                                                </a>
                                                <div class="media-body"><a
                                                        href="{{URL::to('/news-detail-'.$each_of_newsSearch_main1->id_news)}}"
                                                        class="catg_title">{{$each_of_newsSearch_main1->title}}</a>
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
                                <h2><span>{{$all_main[2]->name_main}}</span></h2>
                                <ul class="business_catgnav wow fadeInDown">
                                    <li>
                                        @if(count($newsSearch_main2)>0)
                                        <figure class="bsbig_fig"><a href="{{URL::to('/news-detail-'.$newsSearch_main2[0]->id_news)}}"
                                                                     class="featured_img"> <img alt=""
                                                                                                src="{{$newsSearch_main2[0]->title_img}}">
                                                <span class="overlay"></span> </a>
                                            <figcaption><a
                                                    href="{{URL::to('/news-detail-'.$newsSearch_main2[0]->id_news)}}">{{$newsSearch_main2[0]->title}}</a>
                                            </figcaption>
                                            <p>{{strlen($newsSearch_main2[0]->news_context) > 200 ? substr($newsSearch_main2[0]->news_context,0,195).'...' : $newsSearch_main2[0]->news_context}}</p>
                                        </figure>
                                        @endif
                                    </li>
                                </ul>
                                <ul class="spost_nav">
                                    @if(count($newsSearch_main2)>0)
                                    @foreach($newsSearch_main2 as $key => $each_of_newsSearch_main2)
                                        @if($key>0)
                                            <li>
                                                <div class="media wow fadeInDown"><a
                                                        href="{{URL::to('/news-detail-'.$each_of_newsSearch_main2->id_news)}}"
                                                        class="media-left"> <img alt=""
                                                                                 src="{{$each_of_newsSearch_main2->title_img}}">
                                                    </a>
                                                    <div class="media-body"><a
                                                            href="{{URL::to('/news-detail-'.$each_of_newsSearch_main2->id_news)}}"
                                                            class="catg_title">{{$each_of_newsSearch_main2->title}}</a>
                                                    </div>
                                                </div>
                                            </li>
                                        @endif
                                    @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <div class="technology">
                            <div class="single_post_content">
                                <h2><span>{{$all_main[3]->name_main}}</span></h2>
                                <ul class="business_catgnav">
                                    @if(count($newsSearch_main3)>0)
                                    <li>
                                        <figure class="bsbig_fig"><a href="{{URL::to('/news-detail-'.$newsSearch_main3[0]->id_news)}}"
                                                                     class="featured_img"> <img alt=""
                                                                                                src="{{$newsSearch_main3[0]->title_img}}">
                                                <span class="overlay"></span> </a>
                                            <figcaption><a
                                                    href="{{URL::to('/news-detail-'.$newsSearch_main3[0]->id_news)}}">{{$newsSearch_main3[0]->title}}</a>
                                            </figcaption>
                                            <p>{{strlen($newsSearch_main3[0]->news_context) > 200 ? substr($newsSearch_main3[0]->news_context,0,195).'...' : $newsSearch_main3[0]->news_context}}</p>
                                        </figure>
                                    </li>
                                    @endif
                                </ul>
                                <ul class="spost_nav">
                                    @if(count($newsSearch_main3)>0)
                                    @foreach($newsSearch_main3 as $key => $each_of_newsSearch_main3)
                                        @if($key>0)
                                            <li>
                                                <div class="media wow fadeInDown"><a
                                                        href="{{URL::to('/news-detail-'.$each_of_newsSearch_main3->id_news)}}"
                                                        class="media-left"> <img alt=""
                                                                                 src="{{$each_of_newsSearch_main3->title_img}}">
                                                    </a>
                                                    <div class="media-body"><a
                                                            href="{{URL::to('/news-detail-'.$each_of_newsSearch_main3->id_news)}}"
                                                            class="catg_title">{{$each_of_newsSearch_main3->title}}</a>
                                                    </div>
                                                </div>
                                            </li>
                                        @endif
                                    @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="single_post_content">
                        <h2><span>Sản phẩm mới nhất</span></h2>
                        <ul class="photograph_nav  wow fadeInDown">
                            <?php
                            $all_multimedia = DB::table('multimedia') #Sản phẩm nào mà chưa thuộc bài viết nào thì sẽ ko hiển thị ra cho người dùng
                                ->get();
                            ?>
                            @foreach($all_multimedia as $each_multimedia)
                                    <?php
                                        $product = DB::table('product')
                                        ->where('id_product',$each_multimedia->id_product)
                                        ->get()->first();

                                        $news = DB::table('news')
                                            ->where('id_product',$product->id_product)
                                            ->get()->first();
                                    ?>
                                @if($each_multimedia->url_multi != null && $product != null && $news != null && $each_multimedia->type_multi == 1)
                                    <li>
                                    <div class="photo_grid">
                                        <figure class="effect-layla">
                                            <a class="fancybox-buttons"
                                                                        data-fancybox-group="button"
                                                                        href="{{URL::to('/news-detail-'.$news->id_news)}}"
                                                                        title="{{$each_multimedia->id_multimedia}}">

                                                    <img src="{{$each_multimedia->url_multi}}" alt="{{$each_multimedia->id_multimedia}}"/>

                                            </a>
                                        </figure>
                                    </div>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                    <div class="single_post_content">
                        <h2><span>{{$all_main[4]->name_main}}</span></h2>
                        <div class="single_post_content_left">
                            <ul class="business_catgnav">
                                @if(count($newsSearch_main4)>0)
                                <li>
                                    <figure class="bsbig_fig"><a href="{{URL::to('/news-detail-'.$newsSearch_main4[0]->id_news)}}"
                                                                 class="featured_img"> <img alt=""
                                                                                            src="{{$newsSearch_main4[0]->title_img}}">
                                            <span class="overlay"></span> </a>
                                        <figcaption><a
                                                href="{{URL::to('/news-detail-'.$newsSearch_main4[0]->id_news)}}">{{$newsSearch_main4[0]->title}}</a>
                                        </figcaption>
                                        <p>{{strlen($newsSearch_main4[0]->news_context) > 200 ? substr($newsSearch_main4[0]->news_context,0,195).'...' : $newsSearch_main4[0]->news_context}}</p>
                                    </figure>
                                </li>
                                @endif
                            </ul>
                        </div>
                        <div class="single_post_content_right">
                            <ul class="spost_nav">
                                @if(count($newsSearch_main4)>0)
                                @foreach($newsSearch_main4 as $key => $each_of_newsSearch_main4)
                                    @if($key>0)
                                        <li>
                                            <div class="media wow fadeInDown"><a
                                                    href="{{URL::to('/news-detail-'.$each_of_newsSearch_main4->id_news)}}"
                                                    class="media-left"> <img alt=""
                                                                             src="{{$each_of_newsSearch_main4->title_img}}">
                                                </a>
                                                <div class="media-body"><a
                                                        href="{{URL::to('/news-detail-'.$each_of_newsSearch_main4->id_news)}}"
                                                        class="catg_title">{{$each_of_newsSearch_main4->title}}</a>
                                                </div>
                                            </div>
                                        </li>
                                    @endif
                                @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
                <aside class="right_content">
                    <div class="single_sidebar">
                        <h2><span>Giá cạnh tranh nhất</span></h2>
                        <ul class="spost_nav">
                            @foreach($newsSearch_price as $each_newsSearch_price)
                            <li>
                                <div class="media wow fadeInDown"><a href="{{URL::to('/news-detail-'.$each_newsSearch_price->id_news)}}"
                                                                     class="media-left"> <img src="{{$each_newsSearch_price->title_img}}">
                                    </a>
                                    <div class="media-body"><a href="{{URL::to('/news-detail-'.$each_newsSearch_price->id_news)}}"
                                                               class="catg_title">{{$each_newsSearch_price->title}}</a></div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="single_sidebar">
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#category" aria-controls="home" role="tab"
                                                                      data-toggle="tab">Danh mục</a></li>
                            <li role="presentation"><a href="#video" aria-controls="profile" role="tab"
                                                       data-toggle="tab">Video</a></li>
                            <li role="presentation"><a href="#comments" aria-controls="messages" role="tab"
                                                       data-toggle="tab">Bình luận</a></li>
                        </ul>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="category">
                                <ul>
                                    @foreach($all_main as $eachOfAllMain)
                                        <li class="cat-item"><a
                                                href="{{URL::to('/branch-result-'.$eachOfAllMain->id_main_category)}}">{{$eachOfAllMain->name_main}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="video">
                                <div class="vide_area">
                                    @foreach($all_multimedia as $each_multimedia)

                                        @if($each_multimedia->type_multi == 2)
                                        <iframe width="320" height="180"
                                                src="{{$each_multimedia->url_multi}}"
                                                frameborder="0"
                                                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                                allowfullscreen>
                                        </iframe>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="comments">
                                <ul class="spost_nav">
                                    <li>
                                        <div class="media wow fadeInDown"><a
                                                href="public/newsfeed/pages/single_page.html" class="media-left"> <img
                                                    alt="" src="public/newsfeed/images/post_img1.jpg"> </a>
                                            <div class="media-body"><a href="public/newsfeed/pages/single_page.html"
                                                                       class="catg_title"> Aliquam malesuada diam eget turpis varius 1</a></div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="single_sidebar wow fadeInDown">
                        <h2><span>Sponsor</span></h2>
                        <a class="sideAdd" href="#"><img src="public/newsfeed/images/add_img.jpg" alt=""></a></div>
                    <div class="single_sidebar wow fadeInDown">
                        <h2><span>Category Archive</span></h2>
                        <select class="catgArchive">
                            <option>Select Category</option>
                            <option>Life styles</option>
                            <option>Sports</option>
                            <option>Technology</option>
                            <option>Treads</option>
                        </select>
                    </div>
                    <div class="single_sidebar wow fadeInDown">
                        <h2><span>Links</span></h2>
                        <ul>
                            <li><a href="#">Blog</a></li>
                            <li><a href="#">Rss Feed</a></li>
                            <li><a href="#">Login</a></li>
                            <li><a href="#">Life &amp; Style</a></li>
                        </ul>
                    </div>
                </aside>
            </div>
            <!-- 2 thẻ mở của div và section nằm hết ở trong yield rồi-->
        </div>
    </section>

@endsection
