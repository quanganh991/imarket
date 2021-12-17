@extends('seller.home')
@section('all_branch_category')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Sửa đơn hàng</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="{{URL::to('/submit-edit-order-detail')}}" method="GET">
                            <input type="hidden" name="id_oder_detail" value="{{$oder_detail->id_oder_detail}}">
                            <div class="form-group">
                                <label>STT</label>
                                <input readonly type="text" name="item_oder" class="form-control" id="item_oder"
                                       value="{{$oder_detail->item_oder}}">
                            </div>

                            <div class="form-group">
                                <label>Id_order </label>
                                <input readonly type="text" name="id_oder" class="form-control" id="id_oder"
                                       value="{{$oder_detail->id_oder}}">
                            </div>

                            <div class="form-group">
                                <label>Sản phẩm</label>
                                <input hidden readonly class="form-control" name="id_news" id="id_news"
                                       value="{{$oder_detail->id_news}}">
                                <?php
                                $sp = DB::table('news')
                                    ->join('product','news.id_product','=','product.id_product')
                                    ->where('id_news',$oder_detail->id_news)->get()->first();
                                ?>
                                <p class="form-control">
                                {{$sp->product_name}}
                                </p>
                            </div>

                            <div class="form-group">
                                <label>Số lượng</label>
                                <input type="text" name="quantity" class="form-control" id="quantity"
                                       value="{{$oder_detail->quantity}}">
                            </div>

                            <div class="form-group">
                                <label>Đơn giá</label>
                                <input type="text" name="subprice" class="form-control" id="subprice"
                                       value="{{$oder_detail->subprice}}">
                            </div>

                            <div class="form-group">
                                <label>Đối tác vận chuyển</label>
                                <input type="text" name="partner_delivery" class="form-control" id="partner_delivery"--}}
                                       value="{{$oder_detail->partner_delivery}}">
                            </div>

                            <div class="form-group">
                                <label>Ngày mua</label>
                                <input type="datetime-local" name="boughtdate" class="form-control" id="boughtdate"
                                       value="{{str_replace(" ","T",$oder_detail->boughtdate)}}">
                            </div>

                            <button type="submit" name="edit_submit" class="btn btn-info">Xác nhận sửa</button>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </section>
@endsection
