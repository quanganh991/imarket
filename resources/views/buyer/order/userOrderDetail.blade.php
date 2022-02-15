@extends('header_footer')
@section('order')
<div id="heading-breadcrumbs">
    <div class="container">
        <div class="row d-flex align-items-center flex-wrap">
            <div class="col-md-7">
                <h1 class="h2">Xem chi tiết đơn hàng</h1>
            </div>
            <div class="col-md-5">
                <ul class="breadcrumb d-flex justify-content-end">
                    <li class="breadcrumb-item"><a href="{{URL::to('/home')}}">Trang chủ</a></li>
                    <li class="breadcrumb-item">Xem chi tiết đơn hàng</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="container-sm">
    <div>
        <h1 style="text-align:center; color: red">Có {{$countAllUserOrderDetail}} sản phẩm trong đơn hàng có mã: {{$idDonHang}}</h1>
    </div>
    <div class="table-responsive">
        <table class="table table-striped b-t b-light">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Sản phẩm</th>
                    <th>Hình ảnh</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Đối tác giao hàng</th>
                    <th>Ngày mua</th>
                    <th>Tổng</th>
                    <th>Trạng thái</th>
                </tr>
            </thead>
            <tbody>
                @if($countAllUserOrderDetail>0)
                    @foreach($allUserOrderDetail as $eachUserOrderDetail)
                    <tr>
                        <td>{{$eachUserOrderDetail->item_oder}}</td>
                        <td>
                            <?php
                            $tensp = DB::table('news')
                                ->where('id_news',$eachUserOrderDetail->id_news)
                                ->join('product','news.id_product','=','product.id_product')
                                ->get()->first();
                            ?>
                            <a href="{{URL::to('/news-detail-'.$eachUserOrderDetail->id_news) }}">
                                {{ $tensp->product_name }}
                            </a>
                        </td>
                        <td>
                            <a href="{{URL::to('/news-detail-'.$eachUserOrderDetail->id_news) }}">
                                <img height="100" width="100" src="{{$tensp->title_img}}" class="img-fluid" alt="">
                            </a>
                        </td>
                        <td>{{ $eachUserOrderDetail->quantity }}</td>
                        <td>{{ $eachUserOrderDetail->subprice }}</td>
                        <td style="color: orangered">{{$eachUserOrderDetail->partner_delivery }}</td>
                        <td>{{ $eachUserOrderDetail->boughtdate }}</td>
                        <td>{{ $eachUserOrderDetail->quantity*$eachUserOrderDetail->subprice }}</td>
                        <td>
                            <?php
                            $statu = $eachUserOrderDetail->isapproved;
                            ?>
                            @if($statu == 0) {{--đơn hàng nào chưa được duyệt thì user có thể hủy--}}
                            <h5 style="color: dodgerblue">Đang chờ phê duyệt</h5>
                            <a href="{{URL::to('/user-cancel-order-'.$eachUserOrderDetail->id_oder_detail)}}">Hủy</a>
                            @elseif($statu == 1) {{--đơn hàng đang được vận chuyển--}}
                            <h5 style="color: orangered">Đang vận chuyển</h5>
                            @elseif($statu == 2) {{--đơn hàng đã giao thành công--}}
                            <h5 style="color: green">Đã giao thành công</h5>
                            @elseif($statu == 3) {{--đơn hàng bị hủy--}}
                            <h5 style="color: black">Đơn hàng bị hủy</h5>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
