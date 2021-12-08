@extends('seller.home')
@section('all_news')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Quản lý bài đăng</h3>
                    </div>
                    <div class="card-body">
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target=".bs-example-modal-lg">Thêm bài đăng mới
                        </button>
                        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog"
                             aria-labelledby="myLargeModalLabel">
                            <div class="modal-dialog modal-lg-12" role="document">
                                <div class="modal-content">
                                    <div class="modal-body ">
                                        <section>
                                            <div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="card-primary">
                                                            <div class="card-header">
                                                                <h3 class="card-title">Thêm bài đăng mới</h3>
                                                            </div>
                                                            <form role="form" action="{{URL::to('/seller-save-news')}}"
                                                                  method="post">
                                                                @csrf
                                                                {{ csrf_field() }}
                                                                <div class="card-body">
                                                                    <div class="form-group">
                                                                        <label for="branch">Branch của bài đăng</label>
                                                                        <?php
                                                                        $bra = DB::table('branch_category')->get();
                                                                        ?>
                                                                        <select class="form-control input-sm m-bot15"
                                                                                name="id_branch_category"
                                                                                id="id_branch_category">
                                                                            @foreach($bra as $indexbra)
                                                                                <option
                                                                                    <?php
                                                                                        $cat = DB::table('main_category')
                                                                                        ->where('id_main_category',$indexbra->id_main_category)
                                                                                        ->get()->first();
                                                                                    ?>
                                                                                    value="{{$indexbra->id_branch_category}}">
                                                                                    {{$cat->name_main}} / {{$indexbra->name_branch}}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="title">Tiêu đề</label>
                                                                        <input type="text" name="title"
                                                                               class="form-control" id="title"
                                                                               placeholder="Tiêu đề">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="location">Địa chỉ</label>
                                                                        <textarea type="text" class="form-control"
                                                                               name="location" id="location" placeholder="Địa chỉ"></textarea>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="news_context">Nội dung</label>
                                                                        <textarea type="text" name="news_context"
                                                                               class="form-control" id="news_context"
                                                                                  placeholder="Nội dung"></textarea>
                                                                    </div>

                                                                    <?php
                                                                    $user = DB::table('users')
                                                                        ->where('id_user',Session::get('id_seller'))
                                                                        ->get()->first();
                                                                    ?>
                                                                    <div class="form-group">
                                                                        <label for="id_user" >Người gửi</label>
                                                                        <input readonly value="{{$user->name_user}}" type="text">
                                                                        <input hidden value="{{$user->id_user}}" type="text" name="id_user" id="id_user">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="publish_date" >Ngày phát hành</label>
                                                                        <input type="datetime-local" name="publish_date" id="publish_date" value="{{str_replace(" ","T",date('Y-m-d H:i:s'))}}">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="expired" >Ngày hết hạn</label>
                                                                        <input type="datetime-local" name="expired" id="expired" value="{{str_replace(" ","T",date('Y-m-d H:i:s'))}}">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="price" >Giá</label>
                                                                        <input type="number" step="0.0000000001" name="price" id="price">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="type_of_news" >Thể loại</label>
                                                                        <input type="text" name="type_of_news" id="type_of_news">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="id_product">Sản phẩm</label>
                                                                        <?php
                                                                        $product = DB::table('product')->where('id_user',$user->id_user)->get();
                                                                        ?>
                                                                        <select class="form-control input-sm m-bot15"
                                                                                name="id_product"
                                                                                id="id_product">
                                                                            @foreach($product as $each_of_product)
                                                                                <option
                                                                                    value="{{$each_of_product->id_product}}">
                                                                                    {{$each_of_product->product_name}}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="title_img">Ảnh/Video Thumbnail</label>
                                                                        <textarea type="text" class="form-control"
                                                                                  name="title_img" id="title_img" placeholder="Ảnh Thumbnail"></textarea>
                                                                    </div>

                                                                    <div class="card-footer">
                                                                        <button type="submit" name="add_news"
                                                                                class="btn btn-primary">Thêm bài đăng mới
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end form -->
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
                                <th>Thumbnail</th>
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
                                           href="{{URL::to('/news-detail-'.$eachNews->id_news) }}">
                                            {{strlen($eachNews->location) > 40 ? substr($eachNews->location,0,35).'...' : $eachNews->location}}

                                        </a>
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
                                        <a href="{{URL::to('/seller-unactive-news/'.$eachNews->id_news)}}">Ẩn</a>
                                        <?php
                                        }else{ //if ($eachNews->_status==0)
                                        ?>
                                        <p style="color: red">Đang bị ẩn</p>
                                        <a href="{{URL::to('/seller-active-news/'.$eachNews->id_news)}}">Hiển thị</a>
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
                                            <img height="100px" width="100px"
                                                 src="{{$eachNews->title_img}}">
                                    </td>

                                    <td>
                                        <a href="{{URL::to('/seller-edit-news/'.$eachNews->id_news)}}">Sửa</a>
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
