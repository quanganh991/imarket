@extends('seller.home')
@section('all_branch_category')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Sửa sản phẩm</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="{{URL::to('/seller-submit-edit-product')}}" method="POST">
                            @csrf
                            <input type="hidden" name="id_product" value="{{$edit_product->id_product}}">

                            <div class="form-group">
                                <label for="brand_name">Thương hiệu</label>
                                <input placeholder="Thương hiệu" type="text" name="brand_name" class="form-control" id="brand_name" value="{{$edit_product->brand_name}}">
                            </div>

                            <div class="form-group">
                                <label for="situation">Vị trí</label>
                                <input placeholder="Vị trí" type="text" name="situation" class="form-control" id="situation" value="{{$edit_product->situation}}">
                            </div>

                            <div class="form-group">
                                <label for="product_name">Tên sản phẩm</label>
                                <input placeholder="Tên sản phẩm" type="text" name="product_name" class="form-control" id="product_name" value="{{$edit_product->product_name}}">
                            </div>

                            <div class="form-group">
                                <label for="product_descrb">Mô tả sản phẩm</label>
                                <textarea placeholder="Mô tả sản phẩm" name="product_descrb" class="form-control" id="product_descrb">{{$edit_product->product_descrb}}</textarea>
                            </div>

                            <button type="submit" name="edit_submit" class="btn btn-info">Xác nhận sửa sản phẩm</button>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </section>
@endsection
