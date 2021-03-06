@extends('header_footer')
@section('viewAllComment')
    <p style="color: red; font-size: 35px; font-weight: bold">Tất cả bình luận</p>
    <table id="example1" class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>ID tin tức</th>
            <th>Branch của tin tức</th>
            <th>Tiêu đề bài viết</th>
            <th>Hình ảnh bài viết</th>
            <th>Nội dung bình luận</th>
        </tr>
        </thead>
        <tbody>
        @foreach($allUserComment as $eachUserComment)
            <?php
            $branchCategoryOnly = DB::table('branch_category')->where('id_branch_category', $eachUserComment->id_branch_category)->get()->first();   //chứa 1 bản ghi trong bảng branch
            $mainCategoryOnly = DB::table('main_category')->where('id_main_category', $branchCategoryOnly->id_main_category)->get()->first();

            ?>
            <tr>
                <td>{{ $eachUserComment->id_news }}</td>
                <td>
                    <a style="color: darkorange"
                       href="{{URL::to('/news-result-'.$branchCategoryOnly->id_branch_category) }}">
                        {{$branchCategoryOnly->name_branch}}
                    </a>
                </td>
                <td>
                    <a style="color: rebeccapurple" href="{{URL::to('/news-detail-'.$eachUserComment->id_news) }}">{{ $eachUserComment->title }}</a>

                </td>
                <td>
                    <?php
                    $eachNews = DB::table('news')
                        ->where('id_news',$eachUserComment->id_news)
                        ->get()->first();
                    ?>
                    <a href="{{URL::to('/news-detail-'.$eachUserComment->id_news)}}">
                        <img height="70px" width="70px"
                             src="{{$eachNews->title_img}}"
                             alt="">
                    </a>
                </td>
                <td>
                    <a href="{{URL::to('/news-detail-'.$eachUserComment->id_news) }}">
                        {{$eachUserComment->context_coment}}
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
<br>
    <p style="color: red; font-size: 35px; font-weight: bold">Tất cả phản hồi</p>
    <table id="example1" class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>ID tin tức</th>
            <th>Branch của tin tức</th>
            <th>Tiêu đề bài viết</th>
            <th>Hình ảnh bài viết</th>
            <th>Nội dung phản hồi</th>
        </tr>
        </thead>
        <tbody>
        @foreach($allUserReply as $eachUserReply)
            <?php
            $branchCategoryOnly = DB::table('branch_category')->where('id_branch_category', $eachUserReply->id_branch_category)->get()->first();   //chứa 1 bản ghi trong bảng branch
            $mainCategoryOnly = DB::table('main_category')->where('id_main_category', $branchCategoryOnly->id_main_category)->get()->first();
            ?>
            <tr>
                <?php
                $eachUserComment = DB::table('coment')
                ->where('id_coment',$eachUserReply->id_coment)
                ->get()->first();
                ?>
                <td>{{ $eachUserComment->id_news }}</td>
                <td>
                    <a style="color: darkorange"
                       href="{{URL::to('/news-result-'.$branchCategoryOnly->id_branch_category) }}">
                        {{$branchCategoryOnly->name_branch}}
                    </a>
                </td>
                <td>
                        <a style="color: rebeccapurple" href="{{URL::to('/news-detail-'.$eachUserReply->id_news) }}">{{ $eachUserReply->title }}</a>

                </td>
                <td>
                        <?php
                        $eachNews = DB::table('news')
                            ->where('id_news',$eachUserComment->id_news)
                            ->get()->first();
                        ?>
                        <a href="{{URL::to('/news-detail-'.$eachUserComment->id_news)}}">
                            <img height="70px" width="70px"
                                 src="{{$eachNews->title_img}}"
                                 alt="">
                        </a>
                </td>
                <td>
                    <a href="{{URL::to('/news-detail-'.$eachUserReply->id_news) }}">
                        {{$eachUserReply->context_reply}}
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
