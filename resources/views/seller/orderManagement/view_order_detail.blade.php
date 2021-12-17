@extends('seller.home')
@section('all_branch_category')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 style="color: red" class="card-title">Chi tiết đơn hàng mã {{$DONHANG->id_oder}} của khách hàng: <label style="color: purple">{{$KH}}</label></h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>STT</th>
                                <th>ID Đơn hàng chi tiết</th>
                                <th>Sản phẩm</th>
                                <th>Hình Ảnh</th>
                                <th>Số lượng</th>
                                <th>Đơn giá</th>
                                <th>Đối tác Giao hàng</th>
                                <th>Ngày mua</th>
                                <th>Tổng</th>
                                <th>Duyệt đơn hàng</th>
                                <th>Sửa</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($allOrderDetail as $eachOrderDetail)
                                <tr>
                                    <td>{{ $eachOrderDetail->item_oder }}</td>
                                    <td>{{ $eachOrderDetail->id_oder_detail }}</td>
                                    <td>
                                        <?php
                                        $sp = DB::table('news')
                                            ->where('id_news',$eachOrderDetail->id_news)
                                            ->join('product','news.id_product','=','product.id_product')
                                            ->get()->first();
                                        ?>
                                            <a href="{{URL::to('/news-detail-'.$eachOrderDetail->id_news) }}">{{$sp->product_name}}</a>
                                    </td>
                                    <td><a href="{{URL::to('/news-detail-'.$eachOrderDetail->id_news) }}">
                                            <img width="100" height="100" src="{{$sp->title_img}}" class="img-fluid">
                                        </a>
                                    </td>
                                    <td>{{ $eachOrderDetail->quantity }}</td>
                                    <td style="color: red">{{ $eachOrderDetail->subprice }}</td>
                                    <td style="color: green">{{$eachOrderDetail ->partner_delivery }}</td>
                                    <td>{{ $eachOrderDetail->boughtdate }}</td>
                                    <td>{{ $eachOrderDetail->quantity * $eachOrderDetail->item_oder }}</td>

                                    <td>

                                        <?php
                                        if($eachOrderDetail->isapproved == 0){    //chưa duyệt
                                        ?>
                                        <p style="color: #ba8b00">Chờ Phê duyệt</p>
                                        <a href="{{URL::to('/approve-order-'.$eachOrderDetail->id_oder_detail)}}">Duyệt</a>
                                        |
                                        <a href="{{URL::to('/unapprove-order-'.$eachOrderDetail->id_oder_detail)}}">Hủy</a>

                                        <?php
                                        }else if($eachOrderDetail->isapproved == 1){ //đã duyệt
                                        ?>
                                        <p style="color: blue">Đã duyệt</p>
                                        <a href="{{URL::to('/succeed-order-'.$eachOrderDetail->id_oder_detail)}}">Xác Nhận Giao Thành Công</a>

                                        <?php
                                        } else if($eachOrderDetail->isapproved == 2){ //giao thành công
                                        ?>

                                        <p style="color: green">Đã giao hàng thành công</p>

                                        <?php
                                        }  else if($eachOrderDetail->isapproved == 3){ //bị hủy
                                        ?>

                                        <p style="color: red">Đơn hàng bị hủy</p>

                                        <?php
                                        }
                                        ?>
                                    </td>

                                    <td><a href="{{URL::to('/edit-order-detail-'.$eachOrderDetail->id_oder_detail)}}">Sửa</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
