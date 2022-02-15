@extends('header_footer')
@section('order')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Tạo đơn hàng</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="{{URL::to('/user-save-order')}}" method="GET">
                            <div class="form-group">
                                <label>item_oder</label>
                                <input hidden name="id_news" id="id_news" value="{{$news->id_news}}">
                                <input readonly type="text" name="item_oder" class="form-control" id="item_oder"
                                       value=1>
                                <label>Tỉnh thành</label>
                                <input type="text" name="province" class="form-control" id="province">

                                <label>Ghi chú</label>
                                <textarea name="oder_note" class="form-control" id="oder_note"></textarea>

                                <label>Số lượng</label>
                                <input type="number" name="quantity" class="form-control" id="quantity">

                                <label>Đơn giá</label>
                                <input readonly value="{{$news->price}}" type="number" name="subprice" class="form-control" id="subprice">
                            </div>

                            <button type="submit" name="edit_submit" class="btn btn-info">Gửi đơn hàng tới người bán</button>

                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </section>
@endsection
