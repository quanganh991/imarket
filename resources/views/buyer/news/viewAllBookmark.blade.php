@extends('header_footer')
@section('viewAllBookmark')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <p style="color: red; font-size: 35px; font-weight: bold">Bài viết đã lưu</p>
                    </div>

                    <table id="example1" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>ID tin tức</th>
                            <th>Branch của tin tức</th>
                            <th>Tiêu đề</th>
                            <th>Nội dung</th>
                            <th>Tác giả</th>
                            <th>Ngày đăng</th>
                            <th>Ngày cập nhật gần nhất</th>
                            <th>Thể loại</th>
                            <th>Hình ảnh</th>
                            <th>Bỏ lưu</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($allUserBookmark as $eachUserBookmark)
                            <?php
                            $branchCategoryOnly = DB::table('branch_category')->where('id_branch_category', $eachUserBookmark->id_branch_category)->get()->first();   //chứa 1 bản ghi trong bảng branch
                            $mainCategoryOnly = DB::table('main_category')->where('id_main_category', $branchCategoryOnly->id_main_category)->get()->first();
                            ?>
                            <tr>
                                <td>{{ $eachUserBookmark->id_news }}</td>
                                <td>
                                    <a style="color: darkorange"
                                       href="{{URL::to('/branch-result-'.$branchCategoryOnly->id_branch_category) }}">
                                        {{$branchCategoryOnly->name_branch}}
                                    </a>
                                </td>
                                <td>
                                    <a style="color: rebeccapurple"
                                       href="{{URL::to('/news-detail-'.$eachUserBookmark->id_news) }}">{{ $eachUserBookmark->title }}</a>
                                </td>
                                <td>
                                    <a href="{{URL::to('/news-detail-'.$eachUserBookmark->id_news) }}">
                                        {{strlen($eachUserBookmark->news_context) > 100 ? substr($eachUserBookmark->news_context,0,95).'...' : $eachUserBookmark->news_context}}
                                    </a>
                                </td>
                                <td style="color: green">
                                    <?php
                                    $author = DB::table('users')
                                        ->where('id_user', $eachUserBookmark->id_user)  #tác giả của bài đăng, khác với id_customer là người dùng lưu bookmark này
                                        ->get()->first();
                                    ?>
                                    {{ $author->name_user }}
                                </td>
                                <td>{{ $eachUserBookmark->publish_date }}</td>
                                <td>{{ $eachUserBookmark->latest_update }}</td>
                                <td style="color: #0f401b">
                                    {{ $eachUserBookmark->type_of_news }}
                                </td>
                                <td>
                                    <a href="{{URL::to('/news-detail-'.$eachUserBookmark->id_news)}}">
                                        <img height="80px" width="80px"
                                             src="{{$eachUserBookmark->title_img}}"
                                             alt="">
                                    </a>
                                </td>
                                <td>
                                    <a style="color: blue" href="{{URL::to('/unbookmark-'.$eachUserBookmark->id_news)}}">Bỏ lưu</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
