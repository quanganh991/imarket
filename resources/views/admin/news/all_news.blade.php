@extends('admin.home')
@section('all_news')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Quản lý bài đăng</h3>
                    </div>
                    <div class="card-body">
                        <br><br>
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>ID bài đăng</th>
                                <th>Branch của bài đăng</th>
                                <th>Tiêu đề</th>
                                <th>Địa chỉ</th>
                                <th>Nội dung</th>
                                <th>Người đăng tin</th>
                                <th>Giá</th>
                                <th>Trạng thái</th>
                                <th>Ngày hết hạn</th>
                                <th>Ngày đăng</th>
                                <th>Cập nhật gần nhất</th>
                                <th>Loại tin</th>
                                <th>Sản phẩm</th>
                                <th>Sửa</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($allNews as $eachNews)
                                <?php
                                $branchCategoryOnly = DB::table('branch_category')->where('id_branch_category', $eachNews->id_branch_category)->get()->first();   //chứa 1 bản ghi trong bảng branch
                                $mainCategoryOnly = DB::table('main_category')->where('id_main_category', $branchCategoryOnly->id_main_category)->get()->first();
                                ?>
                                <tr>
                                    <td>{{ $eachNews->id_news }}</td>   <!--id của bài đăng-->
                                    <td>
                                        <a style="color: darkorange"
                                           href="{{URL::to('/edit-branch-category/'.$branchCategoryOnly->id_branch_category) }}">
                                            {{$branchCategoryOnly->name_branch}}
                                        </a>
                                    </td>
                                    <td>
                                        <a style="color: rebeccapurple"
                                           href="{{URL::to('/news-detail-'.$eachNews->id_news) }}">{{ $eachNews->title }}</a>
                                    </td>
                                    <td>
                                        <a style="color: rebeccapurple"
                                           href="{{URL::to('/news-detail-'.$eachNews->id_news) }}">{{ $eachNews->location }}</a>
                                    </td>
                                    <td>
                                        <a href="{{URL::to('/news-detail-'.$eachNews->id_news) }}">
                                            {{strlen($eachNews->news_context) > 50 ? substr($eachNews->news_context,0,45).'...' : $eachNews->news_context}}
                                        </a>
                                    </td>
                                    <td style="color: green">
                                        <?php
                                        $author = DB::table('users')
                                            ->where('id_user',$eachNews->id_user)
                                            ->get()->first();
                                        ?>
                                        @if($author!=null)
                                        {{ $author->name_user }}
                                            @endif
                                    </td>
                                    <td>{{$eachNews->price}}</td>
                                    <td>
                                        <?php
                                        if($eachNews->news_status == 1){
                                        ?>
                                        <p style="color: green">Đang hiển thị</p>
                                        <a href="{{URL::to('/admin-unactive-news/'.$eachNews->id_news)}}">Ẩn</a>
                                        <?php
                                        }else{ //if ($eachNews->_status==0)
                                        ?>
                                        <p style="color: red">Đang bị ẩn</p>
                                        <a href="{{URL::to('/admin-active-news/'.$eachNews->id_news)}}">Hiển thị</a>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <td>{{ $eachNews->expired }}</td>
                                    <td>{{ $eachNews->publish_date }}</td>
                                    <td>{{ $eachNews->latest_update }}</td>
                                    <td style="color: #0f401b">
                                        {{ $eachNews->type_of_news }}
                                    </td>
                                    <td>
                                        <?php
                                        $product = DB::table('product')->where('id_product',$eachNews->id_product)->get()->first();
                                        ?>
                                        {{ $product->product_name }}</td>
                                    <td>
                                        <a href="{{URL::to('/admin-edit-news/'.$eachNews->id_news)}}">Sửa</a>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                        <div>
                            <br/>
                            <div style="float: right">
                                {!! $allNews->links() !!}
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </section>
@endsection
