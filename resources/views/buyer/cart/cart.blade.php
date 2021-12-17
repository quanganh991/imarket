@extends('header_footer')
@section('cart')
<section id="cart_items">
    <div id="heading-breadcrumbs">
        <div class="container">
            <div class="row d-flex align-items-center flex-wrap">
                <div class="breadcrumbs">
                    <ul class="breadcrumb d-flex justify-content-end">
                        <li class="breadcrumb-item"><a href="{{URL::to('/')}}">Home</a></li>
                        <li class="breadcrumb-item">Cart</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <?php
        $content = Cart::content(); //lấy nội dung của giỏ hàng
        //gồm id, qty, name, price, weight, option/image
        $numberOfItems = 0;
        foreach ($content as $eachItem) {
            $numberOfItems += $eachItem->qty;
        }
        ?>
        <div class="row bar">
            <div class="col-lg-12">
                <p class="text-muted lead">Bạn đang có {{$numberOfItems}} mặt hàng trong giỏ hàng.</p>
            </div>
            <div id="basket" class="col-lg-9">
                <div class="box mt-0 pb-0 no-horizontal-padding">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>

                                <th>Hình ảnh</th>
                                <th>Sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Giá</th>
                                <th>Khuyến mại</th>
                                <th>Tạm tính</th>
                                <th>Xóa</th>
                                </tr>
                            </thead>
                            @foreach($content as $eachContentItem)
                            <tr>
                                <?php
                                $produc = DB::table('product')->where('id_product', $eachContentItem->id)->get()->first();
                                $categoryBranchOnly = DB::table('category_branch')->where('id_category_branch', $produc->id_category_branch)->get()->first();   //chứa 1 bản ghi trong bảng branch
                                $categoryMainOnly = DB::table('category_main')->where('id_category_main', $categoryBranchOnly->id_category_main)->get()->first();
                                ?>
                                <td>
                                    <a href="{{URL::to('/detail/'.$produc->id_product) }}">
                                        <img src="{{ URL::to('/') }}/public/imgproduct/{{$produc->image}}" class="img-fluid">
                                    </a>
                                </td>
                                <td>
                                    <a href="{{URL::to('/detail/'.$produc->id_product) }}">
                                    {{$eachContentItem->name}}
                                    </a>
                                </td>
                                <td>
                                    <form action="{{URL::to('/update-cart-quantity')}}" method="GET">
                                        <select class="form-control form-control-sm" name="quantity">
                                            @for ($i = 1; $i < $produc->amount; $i++)
                                                @if ($eachContentItem->qty == $i)
                                                <option selected="selected" value="{{$i}}">
                                                    {{$i}}
                                                </option>
                                                @else
                                                <option value="{{$i}}">{{$i}}</option>
                                                @endif
                                            @endfor
                                        </select>

                                        <!-- <input type="number" name="quantity" value="{{$eachContentItem->qty}}"  max="{{$produc->amount}}"> -->
                                        <input type="hidden" value="{{$eachContentItem->rowId}}" name="id" class="form-control">
                                        <input type="submit" value="Cập nhật" name="update_qty" class="btn btn-default btn-sm">
                                    </form>
                                </td>
                                <td>{{'$'.number_format($eachContentItem->price)}}</td>
                                <td>$0.00</td>
                                <td>{{'$'.number_format($eachContentItem->price * $eachContentItem->qty)}}</td>
                                <td><a href="{{URL::to('/delete-from-cart/'.$eachContentItem->rowId)}}"><i class="fa fa-trash-o"></i></a></td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                    <div class="box-footer d-flex justify-content-between align-items-center">
                        <div class="left-col"><a href="{{URL::to('/home')}}" class="btn btn-secondary mt-0"><i class="fa fa-chevron-left"></i>Tiếp tục mua sắm</a></div>
                        <div class="right-col">
                            <?php
                            $href = "";
                            $id_customer = Session::get('id_customer');
                            if ($id_customer != NULL) {
                                $href = "previewOrder";
                            } else {
                                $href = "login";
                            }
                            ?>
                            @if($numberOfItems > 0)
                            <a class="btn btn-template-outlined" href={{URL::to($href)}}> Xử lý giỏ hàng <i class="fa fa-chevron-right"></i></a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div id="order-summary" class="box mt-0 mb-4 p-0">
                    <div class="box-header mt-0">
                        <h3>Tổng giá tiền</h3>
                    </div>
                    <p class="text-muted">(Lưu ý: Giá dưới đây chưa bao chi phí giao hàng)</p>
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Tổng giá tiền (chưa bao gồm VAT)</td>
                                    <th>{{"$".Cart::subTotal()}}</th>
                                </tr>
                                <tr>
                                    <td>Thuế VAT</td>
                                    <th>{{"$".Cart::tax()}}</th>
                                </tr>
                                <tr class="total">
                                    <td>Tổng giá tiền (Đã bao gồm VAT)</td>
                                    <th>{{"$".Cart::total()}}</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
