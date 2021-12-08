@extends('welcome')
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
                                    src="<?php echo (explode("***<paragraph/>***", nl2br($newsSearch[0]->multimedia)))[0] ?>" alt=""></a>
                            <div class="slider_article">
                                <h2><a class="slider_tittle"
                                       href="{{URL::to('/news-detail-'.$newsSearch[0]->id_news)}}">{{$newsSearch[0]->title}}</a>
                                </h2>
                                <p>{{strlen($newsSearch[0]->context) > 200 ? substr($newsSearch[0]->context,0,200).'...' : $newsSearch[0]->context}}</p>
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
                                                alt="" src="<?php echo (explode("***<paragraph/>***", nl2br($eachOfNewsSearch->multimedia)))[0] ?>"> </a>
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
                                                                       src="<?php echo (explode("***<paragraph/>***", nl2br($newsSearch[1]->multimedia)))[0] ?>"
                                                                       height="200px">
                                            <span class="overlay"></span> </a>
                                        <figcaption><a
                                                href="{{URL::to('/news-detail-'.$newsSearch[1]->id_news)}}">{{$newsSearch[1]->title}}</a>
                                        </figcaption>
                                        <p>{{strlen($newsSearch[1]->context) > 200 ? substr($newsSearch[1]->context,0,195).'...' : $newsSearch[1]->context}}</p>
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
                                                                         src="<?php echo (explode("***<paragraph/>***", nl2br($eachOfNewsSearch->multimedia)))[0] ?>">
                                            </a>
                                            <div class="media-body">
                                                <a href="{{URL::to('/news-detail-'.$eachOfNewsSearch->id_news)}}"
                                                   class="catg_title">{{$eachOfNewsSearch->title}}</a>
                                                <br>
                                                <p>{{strlen($eachOfNewsSearch->context) > 200 ? substr($eachOfNewsSearch->context,0,195).'...' : $eachOfNewsSearch->context}}</p>
                                            </div>
                                        </div>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>

                    <div class="single_post_content">
                        <h2><span>Ảnh</span></h2>
                        <ul class="photograph_nav  wow fadeInDown">
                            @foreach($newsSearchImageOnly as $eachOfNewsSearchImageOnly)
                                <li>
                                    <div class="photo_grid">
                                        <figure class="effect-layla">
                                            <a class="fancybox-buttons" data-fancybox-group="button" href="{{URL::to('/news-detail-'.$eachOfNewsSearchImageOnly->id_news)}}"
                                               title="<?php echo (explode("***<paragraph/>***", nl2br($eachOfNewsSearchImageOnly->describ_multimedia)))[0] ?>">
                                                <img src="<?php echo (explode("***<paragraph/>***", nl2br($eachOfNewsSearchImageOnly->multimedia)))[0] ?>" alt=""/>
                                            </a>
                                        </figure>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="single_post_content">
                        <h2><span>Khảo sát độc giả/ Trắc nghiệm</span></h2>
                        <div class="single_post_content_left">
                            <ul class="business_catgnav">
                                <li>
                                    @if(count($newsSearchMultipleChoice)>0)
                                        <figure class="bsbig_fig  wow fadeInDown"><a class="featured_img"
                                                                                     href="{{URL::to('/news-detail-'.$newsSearchMultipleChoice[0]->id_news)}}">
                                                <img src="<?php echo (explode("***<paragraph/>***", nl2br($newsSearchMultipleChoice[0]->multimedia)))[0] ?>" alt=""> <span
                                                    class="overlay"></span> </a>
                                            <figcaption><a
                                                    href="{{URL::to('/news-detail-'.$newsSearchMultipleChoice[0]->id_news)}}">{{$newsSearchMultipleChoice[0]->title}}</a>
                                            </figcaption>
                                            <p>{{strlen($newsSearchMultipleChoice[0]->context) > 200 ? substr($newsSearchMultipleChoice[0]->context,0,195).'...' : $newsSearchMultipleChoice[0]->context}}</p>
                                        </figure>
                                    @endif
                                </li>
                            </ul>
                        </div>
                        <div class="single_post_content_right">
                            <ul class="spost_nav">
                                @foreach($newsSearchMultipleChoice as $key => $eachOfNewsSearchMultipleChoice)
                                    @if($key>0)
                                        <li>
                                            <div class="media wow fadeInDown"><a
                                                    href="{{URL::to('/news-detail-'.$eachOfNewsSearchMultipleChoice->id_news)}}"
                                                    class="media-left"> <img alt=""
                                                                             src="<?php echo (explode("***<paragraph/>***", nl2br($eachOfNewsSearchMultipleChoice->multimedia)))[0] ?>">
                                                </a>
                                                <div class="media-body"><a
                                                        href="{{URL::to('/news-detail-'.$eachOfNewsSearchMultipleChoice->id_news)}}"
                                                        class="catg_title">{{$eachOfNewsSearchMultipleChoice->title}}</a>
                                                </div>
                                            </div>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
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
                                                                     src="<?php echo (explode("***<paragraph/>***", nl2br($eachNewsSearchPopular->multimedia)))[0] ?>">
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
                                                                      data-toggle="tab">Chuyên mục {{$mainSearch->name_main}}</a></li>
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
                                                href="{{URL::to('/branch-result-'.$eachOfBranch->id_branch_category)}}">{{$eachOfBranch->name_branch}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="video">   <!--Video trong cùng branch-->
                                <div class="vide_area">
                                    @foreach($newsSearchVideoOnly as $eachOfNewsSearchVideoOnly)
                                        <?php
                                        $allMultimedia = explode("***<paragraph/>***", nl2br($eachOfNewsSearchVideoOnly->multimedia)); //tách tất cả video trong mỗi bản tin
                                        $allDescribMultimedia = explode("***<paragraph/>***", nl2br($eachOfNewsSearchVideoOnly->describ_multimedia)); //tách tất cả mô tả video trong mỗi bản tin
                                        ?>
                                        @for($index = 0; $index < count($allMultimedia) ; $index++)
                                            <iframe width="560" height="315"
                                                    src="{{$allMultimedia[$index]}}"
                                                    frameborder="0"
                                                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                                    allowfullscreen>
                                                {{$allDescribMultimedia[$index]}}
                                            </iframe>
                                        @endfor
                                    @endforeach
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="comments">
                                <!--Bình luận nhiều like nhất đến ít like nhất-->
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
                                                                                 src="<?php echo (explode("***<paragraph/>***", nl2br($eachOfNewsSearch->multimedia)))[0] ?>">
                                                    </a>
                                                    <?php
                                                    $commentPeople = DB::table('users')
                                                        ->where('id_user',$eachOfComment->id_customer)
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
                    <div class="single_sidebar wow fadeInDown">
                        <h2><span>Đại dịch Covid-19</span></h2>
                        <div style="height: 350px; overflow: scroll">
                            <?php
                            $url = 'https://tygia.com/app/covid-19/api.json?type=2';
                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_URL, $url);
                            curl_setopt($ch, CURLOPT_HTTPHEADER, Array("User-Agent: Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.15) Gecko/20080623 Firefox/2.0.0.15"));
                            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                            $result = curl_exec($ch);
                            curl_close($ch);
                            $info = json_decode($result, true);
                            ?>
                            <table style="border: 1px solid black">
                                <tr style="border: white">
                                    <th style="border: 1px solid black; color: #fd7605">Nghiêm trọng</th>
                                    <th style="border: 1px solid black; color: red">Tử vong</th>
                                    <th style="border: 1px solid black; color: green">Khỏi bệnh</th>
                                    <th style="border: 1px solid black;  color: blue">Nhiễm</th>
                                    <th style="border: 1px solid black">Quốc gia</th>
                                </tr>
                                @for ($i = 1; $i < count($info["items"]); $i++)
                                    <tr style="border: white">
                                        @foreach ($info["items"][$i] as $key => $value)
                                            @if ($key != "changed")
                                                <th style="border: 1px solid black">
                                                    <?php print_r($value . "\t" . " ") // print all data
                                                    ?>
                                                </th>
                                            @endif
                                        @endforeach
                                    </tr>
                                @endfor
                            </table>
                        </div>
                    </div>
                    <div class="single_sidebar wow fadeInDown">
                        <h2><span>Danh mục khác</span></h2>
                        <select class="catgArchive">
                            <option>Danh mục khác</option>
                            <?php
                            $main = DB::table('main_category')->get();
                            ?>
                            @foreach($main as $eachOfMain)
                                <option>{{$eachOfMain->name_main}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="single_sidebar wow fadeInDown">
                        <h2><span>Thời tiết - Giá Vàng - Tỷ giá</span></h2>
                        <iframe frameborder="0" marginwidth="0" marginheight="0"
                                src="http://thienduongweb.com/tool/weather/?r=1&w=1&g=1&d=0" width="100%" height="370"
                                scrolling="yes"></iframe>

                    </div>
                </aside>
            </div>
        </div>
    </section>
@endsection
