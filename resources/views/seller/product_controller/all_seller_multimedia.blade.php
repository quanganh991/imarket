@extends('seller.home')
@section('all_branch_category')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Quản lý đa phương tiện</h3>
                    </div>
                    <div class="card-body">
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target=".bs-example-modal-lg">Thêm Multimedia mới
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
                                                                <h3 class="card-title">Thêm Multimedia</h3>
                                                            </div>
                                                            <form role="form" action="{{URL::to('/seller-save-multimedia')}}"
                                                                  method="post">
                                                                @csrf
                                                                {{ csrf_field() }}
                                                                <div class="card-body">
                                                                    <div class="form-group">
                                                                        <label for="id_product">Multimedia của sản phẩm</label>
                                                                        <select class="form-control input-sm m-bot15"
                                                                                name="id_product"
                                                                                id="id_product">
                                                                            @foreach($all_seller_products as $each_seller_products)
                                                                                <option
                                                                                    value="{{$each_seller_products->id_product}}">
                                                                                    {{$each_seller_products->product_name}} / {{$each_seller_products->brand_name}}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="type_multi">Loại multimedia</label>
                                                                        <select class="form-control input-sm m-bot15"
                                                                                name="type_multi"
                                                                                id="type_multi">
                                                                            <option value=1>Ảnh</option>
                                                                            <option value=2>Video</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="url_multi">URL</label>
                                                                        <textarea type="text" class="form-control"
                                                                                  name="url_multi" id="url_multi" placeholder="URL"></textarea>
                                                                    </div>
                                                                    <div class="card-footer">
                                                                        <button type="submit" name="add_news"
                                                                                class="btn btn-primary">Thêm multimedia mới
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
                                <th>ID của multimedia</th>
                                <th>Của sản phẩm?</th>
                                <th>Loại Ảnh/Video</th>
                                <th>Hiển thị</th>
                                <th>Của bài viết?</th>
                                <th>Sửa</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($all_multimedia as $each_multimedia)
                                <tr>
                                    <td>{{ $each_multimedia->id_multimedia }}</td>
                                    <td>
                                        {{$each_multimedia->product_name}}
                                        <br>
                                        {{$each_multimedia->brand_name}}
                                    </td>
                                    <td>
                                        @if($each_multimedia->type_multi == 1)
                                            Ảnh
                                        @elseif($each_multimedia->type_multi == 2)
                                            Video
                                        @endif
                                    </td>
                                    <td>
                                        @if($each_multimedia->type_multi == 1)
                                            <img height="100px" width="100px"
                                                 src="{{$each_multimedia->url_multi}}"
                                                 alt="{{$each_multimedia->product_name}}">
                                        @elseif($each_multimedia->type_multi == 2)
                                            <iframe width="100" height="100"
                                                    src="{{$each_multimedia->url_multi}}"
                                                    frameborder="0"
                                                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                                    allowfullscreen>
                                            </iframe>
                                        @endif
                                    </td>
                                    <td>
                                        <?php
                                        $news = DB::table('news')
                                            ->where('id_product',$each_multimedia->id_product)
                                            ->where('id_user',Session::get('id_seller'))
                                            ->get();
                                        ?>
                                        @foreach($news as $each_news)
                                            {{$each_news->title}}
                                            <br>
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="{{URL::to('/seller-edit-multimedia/'.$each_multimedia->id_multimedia)}}">Sửa</a>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                        <div>
                            <br/>
                            <div style="float: right">
{{--                                {!! $all_multimedia->links() !!}--}}
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </section>
@endsection
