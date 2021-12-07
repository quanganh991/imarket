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
                        <form action="{{URL::to('/seller-submit-edit-news')}}" method="POST">
                            @csrf
                            <input type="hidden" name="id_news" value="{{$edit_news->id_news}}">
                            <div class="form-group">
                                <label>Tên Branch</label>
                                <?php
                                $bra = DB::table('branch_category')->get();
                                ?>
                                <select  class="form-control input-sm m-bot15" name="id_branch_category" id="id_branch_category" >
                                    @foreach($bra as $indexbra)
                                        <option
                                            <?php if($indexbra->id_branch_category ==  $edit_news->id_branch_category) echo "selected" ?>
                                            value="{{$indexbra->id_branch_category}}">{{$indexbra->name_branch}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Tiêu đề</label>
                                <input type="text" name="title" class="form-control" id="title"
                                       value="{{$edit_news->title}}">
                            </div>

                            <div class="form-group">
                                <label>Địa chỉ</label>
                                <input type="text" name="location" class="form-control" id="location"
                                       value="{{$edit_news->location}}">
                            </div>

                            <div class="form-group">
                                <label>Nội dung</label>
                                <textarea style="resize: none" rows="8" class="form-control" name="news_context"
                                          id="news_context">{{$edit_news->news_context}}</textarea>
                            </div>

                            <div class="form-group">
                                <label>Người đăng</label>
                                <?php
                                $user = DB::table('users')->where('id_user', $edit_news->id_user)->get()->first();
                                ?>
                                <input type="text" hidden name="id_user" id="id_user" value={{$edit_news->id_user}}>
                                <input type="text" readonly value={{$user->name_user}}>
                            </div>

                            <div class="form-group">
                                <label>Giá</label>
                                <input type="text" name="price" class="form-control" id="price"
                                       value="{{$edit_news->price}}">
                            </div>

                            <div class="form-group">
                                <label>Trạng thái</label>
                                <select name="news_status" class="form-control input-sm m-bot15">
                                    <option value="0">Ẩn</option>
                                    <option selected value="1">Hiển thị</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Ngày hết hạn</label>
                                <input type="datetime-local" name="expired" class="form-control" id="expired"
                                       value="{{str_replace(" ","T",$edit_news->expired)}}">
                            </div>

                            <div class="form-group">
                                <label>Ngày đăng</label>
                                <input readonly type="datetime-local" name="publish_date" class="form-control" id="publish_date"
                                       value="{{str_replace(" ","T",$edit_news->publish_date)}}">
                            </div>

                            <div class="form-group">
                                <label>Cập nhật gần nhất</label>
                                <input readonly type="datetime-local" name="latest_update" class="form-control" id="latest_update"
                                       value="{{str_replace(" ","T",$edit_news->latest_update)}}">
                            </div>

                            <div class="form-group">
                                <label>Thể loại bài đăng</label>
                                <input type="text" name="type_of_news" class="form-control" id="type_of_news" value="{{$edit_news->type_of_news}}">
                            </div>

                            <div class="form-group">
                                <?php
                                $product = DB::table('product')->where('id_user',$edit_news->id_user)->get();
                                ?>
                                <label>Sản phẩm trong bài đăng</label>
                                    <select  class="form-control input-sm m-bot15" name="id_product" id="id_product" >
                                        @foreach($product as $each_of_product)
                                            <option
                                                <?php if($each_of_product->id_product ==  $edit_news->id_product) echo "selected" ?>
                                                value="{{$each_of_product->id_product}}">{{$each_of_product->product_name}}
                                            </option>
                                        @endforeach
                                    </select>
                            </div>

                            <button type="submit" name="edit_submit" class="btn btn-info">Xác nhận sửa news</button>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </section>
@endsection
