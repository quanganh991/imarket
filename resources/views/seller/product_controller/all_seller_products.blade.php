@extends('seller.home')
@section('all_branch_category')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Quản lý sản phẩm</h3>
                    </div>
                    <div class="card-body">
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target=".bs-example-modal-lg">Thêm sản phẩm mới
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
                                                                <h3 class="card-title">Thêm sản phẩm</h3>
                                                            </div>
                                                            <form role="form" action="{{URL::to('/seller-save-product')}}"
                                                                  method="post">
                                                                @csrf
                                                                {{ csrf_field() }}
                                                                <div class="card-body">
                                                                    <div class="form-group">
                                                                        <label for="brand_name">Thương hiệu</label>
                                                                        <input type="text" class="form-control"
                                                                               name="brand_name" id="brand_name" placeholder="Thương hiệu">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="product_name">Tên sản phẩm</label>
                                                                        <input type="text" class="form-control"
                                                                               name="product_name" id="product_name" placeholder="Tên sản phẩm">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="product_descrb">Mô tả</label>
                                                                        <textarea type="text" class="form-control"
                                                                                  name="product_descrb" id="product_descrb" placeholder="Mô tả"></textarea>
                                                                    </div>
                                                                    <div class="card-footer">
                                                                        <button type="submit" class="btn btn-primary">Thêm sản phẩm mới</button>
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
                                <th>ID sản phẩm</th>
                                <th>Thương hiệu</th>
                                <th>Vị trí</th>
                                <th>Tên sản phẩm</th>
                                <th>Mô tả sản phẩm</th>
                                <th>Ảnh/ Video</th>
                                <th>Tin tức liên quan</th>
                                <th>Sửa</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($all_seller_products as $each_product)
                                <tr>
                                    <td>{{ $each_product->id_product }}</td>
                                    <td>
                                        {{$each_product->brand_name}}
                                    </td>
                                    <td>
                                        {{$each_product->situation}}
                                    </td>
                                    <td>
                                        {{$each_product->product_name}}
                                    </td>
                                    <td>
                                        {{strlen($each_product->product_descrb) > 50 ? substr($each_product->product_descrb,0,45).'...' : $each_product->product_descrb}}
                                    </td>
                                    <td>
                                        <?php
                                        #ảnh
                                        $all_multimedia = DB::table('multimedia')
                                            ->where('id_product',$each_product->id_product)
                                            ->get();
                                        $all_news = DB::table('news')
                                            ->where('id_product',$each_product->id_product)
                                            ->get();
                                        ?>
                                        @foreach($all_multimedia as $each_multimedia)
                                                @if($each_multimedia->type_multi == 1)
                                                    <img height="100px" width="100px"
                                                         src="{{$each_multimedia->url_multi}}"
                                                         alt="{{$each_product->product_name}}">
                                                @elseif($each_multimedia->type_multi == 2)
                                                    <iframe width="100" height="100"
                                                            src="{{$each_multimedia->url_multi}}"
                                                            frameborder="0"
                                                            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                                            allowfullscreen>
                                                    </iframe>
                                                @endif
                                            <br>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach($all_news as $each_news)
                                            {{$each_news->title}}
                                            <br>
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="{{URL::to('/seller-edit-product/'.$each_product->id_product)}}">Sửa</a>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                        <div>
                            <br/>
                            <div style="float: right">
                                {{--                                {!! $all_product->links() !!}--}}
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </section>
@endsection
