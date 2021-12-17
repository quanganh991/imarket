@extends('seller.home')
@section('all_branch_category')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Quản lý đơn hàng của người dùng</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">

                            <thead>
                            <tr>
                                <th>ID Oder</th>
                                <th>Khách hàng</th>
                                <th>Ngày mua</th>
                                <th>Ghi chú</th>
                                <th>Xem chi tiết</th>
                                <th>Tỉnh thành</th>
                                <th>Thành Tiền</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($allOrder as $eachOrder)
                                <tr>
                                    <td>{{ $eachOrder->id_oder }}</td>
                                    <td style="color: deeppink">
                                        <?php
                                        $cus = DB::table('users')->where('id_user',$eachOrder->id_customer)->get()->first();
                                        ?>

                                            {{$cus->name_user}}

                                    </td>
                                    <td>{{ $eachOrder->oder_date }}</td>

                                    <td>{{ $eachOrder->oder_note }}</td>
                                    <td><a href="{{URL::to('/view-order-detail-'.$eachOrder->id_oder)}}">Chi tiết</a></td>
                                    <td>{{ $eachOrder->province }}</td>
                                    <td style="color: peru">{{ $eachOrder->totalcost }}</td>

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
