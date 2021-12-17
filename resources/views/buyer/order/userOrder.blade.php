@extends('header_footer')
@section('order')
    <div id="heading-breadcrumbs">
        <div class="container">
            <div class="row d-flex align-items-center flex-wrap">
                <div class="col-md-7">
                    <h1 class="h2">Đơn hàng của bạn</h1>
                </div>
                <div class="col-md-5">
                    <ul class="breadcrumb d-flex justify-content-end">
                        <li class="breadcrumb-item"><a href="{{URL::to('/home')}}">Home</a></li>
                        <li class="breadcrumb-item">Đơn hàng</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <h2 style="color: red">
            Đơn hàng của bạn
        </h2>
        <div class="table-responsive">
            <table class="table table-striped b-t b-light">
                <thead>
                <tr>
                    <th>Mã đơn hàng</th>
                    <th>Người đặt hàng</th>
                    <th>Ngày đặt hàng</th>
                    <th>Ghi chú</th>
                    <th>Tỉnh thành</th>
                    <th>Tổng giá</th>
                    <th>Xem chi tiết</th>
                </tr>
                </thead>
                <tbody>

                @foreach($allUserOrder as $eachUserOrder)
                    <tr>
                        <td>{{ $eachUserOrder->id_oder }}</td>
                        <td>
                            <?php
                            $cus = DB::table('users')->where('id_user', $eachUserOrder->id_customer)->get()->first();
                            ?>
                            <h5 style="color: red">{{$cus->name_user}}</h5>
                        </td>
                        <td>{{ $eachUserOrder->oder_date }}</td>
{{--                        <td>--}}
{{--                            @if($eachUserOrder->isapproved == 0) --}}{{--đơn hàng nào chưa được duyệt thì user có thể hủy--}}
{{--                            <h5 style="color: dodgerblue">Đang chờ phê duyệt</h5>--}}
{{--                            <a href="{{URL::to('/user-cancel-order/'.$eachUserOrder->id_oder)}}">Hủy</a>--}}
{{--                            @elseif($eachUserOrder->isapproved == 1) --}}{{--đơn hàng đang được vận chuyển--}}
{{--                            <h5 style="color: orangered">Đang vận chuyển</h5>--}}
{{--                            @elseif($eachUserOrder->isapproved == 2) --}}{{--đơn hàng đã giao thành công--}}
{{--                            <h5 style="color: green">Đã giao thành công</h5>--}}
{{--                            @elseif($eachUserOrder->isapproved == 3) --}}{{--đơn hàng bị hủy--}}
{{--                            <h5 style="color: black">Đơn hàng bị hủy</h5>--}}
{{--                            @endif--}}

{{--                        </td>--}}
                        <td style="color: #ba8b00">{{ $eachUserOrder->oder_note }}</td>
                        <td>{{ $eachUserOrder->province }}</td>
                        <td>{{ $eachUserOrder->totalcost }}</td>
                        <td><a href="{{URL::to('/user-view-order-detail-'.$eachUserOrder->id_oder)}}">Xem chi tiết</a>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
