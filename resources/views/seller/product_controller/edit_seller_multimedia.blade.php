@extends('seller.home')
@section('all_branch_category')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Sửa bài đăng</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="{{URL::to('/seller-submit-edit-multimedia')}}" method="POST">
                            @csrf
                            <input type="hidden" name="id_multimedia" value="{{$edit_multimedia->id_multimedia}}">
                            <div class="form-group">
                                <label>Tên sản phẩm</label>
                                <?php
                                $all_products = DB::table('product')
                                    ->where('id_user',Session::get('id_seller'))
                                    ->get();
                                ?>
                                <select class="form-control input-sm m-bot15" name="id_product" id="id_product" >
                                    @foreach($all_products as $each_product)
                                        <option
                                            <?php if($each_product->id_product ==  $edit_multimedia->id_product) echo "selected" ?>
                                            value="{{$each_product->id_product}}">{{$each_product->product_name}}/{{$each_product->brand_name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="type_multi">Ảnh/Video</label>
                                <select class="form-control input-sm m-bot15" name="type_multi" id="type_multi" >
                                    <option value=1>Ảnh</option>
                                    <option value=2>Video</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="url_multi">Link</label>
                                <textarea name="url_multi" class="form-control" id="url_multi">{{$edit_multimedia->url_multi}}</textarea>
                            </div>

                            <button type="submit" name="edit_submit" class="btn btn-info">Xác nhận sửa multimedia</button>


                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </section>
@endsection
