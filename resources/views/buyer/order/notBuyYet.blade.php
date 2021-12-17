@extends('header_footer')
@section('order')
<div id="heading-breadcrumbs">
    <div class="container">
        <div class="row d-flex align-items-center flex-wrap">
            <div class="col-md-7">
                <h1 class="h2">Đơn hàng</h1>
            </div>
            <div class="col-md-5">
                <ul class="breadcrumb d-flex justify-content-end">
                    <li class="breadcrumb-item"><a href="{{URL::to('/home')}}">Trang chủ</a></li>
                    <li class="breadcrumb-item"> Đơn hàng </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<h1 style="color: red">Bạn chưa mua sản phẩm nào </h1>
@endsection
