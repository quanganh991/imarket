@extends('admin.home')
@section('all_branch_category')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Thống Kê truy cập người dùng</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <?php
                        $date = array();
                        $access_quantity = array();
                        $bat_dong_san = array();
                        $xe_co = array();
                        $do_dien_tu = array();
                        $gia_dung_noi_that_cay_canh = array();
                        $giai_tri_the_thao_so_thich = array();
                        $me_va_be = array();
                        $dich_vu_du_lich = array();
                        ?>
                        @foreach ($accessQty as $each_of_accessQty)
                            <?php
                            $date[] = $each_of_accessQty->date_time;
                            $access_quantity[] = $each_of_accessQty->access_quantity;
                            $bat_dong_san[] = $each_of_accessQty->bat_dong_san;
                            $xe_co[] = $each_of_accessQty->xe_co;
                            $do_dien_tu[] = $each_of_accessQty->do_dien_tu;
                            $gia_dung_noi_that_cay_canh[] = $each_of_accessQty->gia_dung_noi_that_cay_canh;
                            $giai_tri_the_thao_so_thich[] = $each_of_accessQty->giai_tri_the_thao_so_thich;
                            $me_va_be[] = $each_of_accessQty->me_va_be;
                            $dich_vu_du_lich[] = $each_of_accessQty->dich_vu_du_lich;
                            ?>
                        @endforeach

                        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                        <script type="text/javascript">
                            google.charts.load('current', {'packages': ['corechart']});
                            google.charts.setOnLoadCallback(drawVisualization);

                            var table = [
                                ['Thời gian', 'Lượt truy cập', 'Bất động sản', 'Xe cộ', 'Đồ điện tử', 'Gia dụng, nội thất, cây cảnh','Giải trí, thể thao, sở thích','Mẹ và bé', 'Dịch vụ, du lịch'],
                                ['<?php echo $date[0] ?>',<?php echo $access_quantity[0] ?>,<?php echo $bat_dong_san[0] ?>,<?php echo $xe_co[0] ?>,<?php echo $do_dien_tu[0] ?>,<?php echo $gia_dung_noi_that_cay_canh[0] ?>,<?php echo $giai_tri_the_thao_so_thich[0] ?>,<?php echo $me_va_be[0] ?>,<?php echo $dich_vu_du_lich[0] ?>],
                                ['<?php echo $date[1] ?>',<?php echo $access_quantity[1] ?>,<?php echo $bat_dong_san[1] ?>,<?php echo $xe_co[1] ?>,<?php echo $do_dien_tu[1] ?>,<?php echo $gia_dung_noi_that_cay_canh[1] ?>,<?php echo $giai_tri_the_thao_so_thich[1] ?>,<?php echo $me_va_be[1] ?>,<?php echo $dich_vu_du_lich[1] ?>],
                                ['<?php echo $date[2] ?>',<?php echo $access_quantity[2] ?>,<?php echo $bat_dong_san[2] ?>,<?php echo $xe_co[2] ?>,<?php echo $do_dien_tu[2] ?>,<?php echo $gia_dung_noi_that_cay_canh[2] ?>,<?php echo $giai_tri_the_thao_so_thich[2] ?>,<?php echo $me_va_be[2] ?>,<?php echo $dich_vu_du_lich[2] ?>],
                                ['<?php echo $date[3] ?>',<?php echo $access_quantity[3] ?>,<?php echo $bat_dong_san[3] ?>,<?php echo $xe_co[3] ?>,<?php echo $do_dien_tu[3] ?>,<?php echo $gia_dung_noi_that_cay_canh[3] ?>,<?php echo $giai_tri_the_thao_so_thich[3] ?>,<?php echo $me_va_be[3] ?>,<?php echo $dich_vu_du_lich[3] ?>],
                                ['<?php echo $date[4] ?>',<?php echo $access_quantity[4] ?>,<?php echo $bat_dong_san[4] ?>,<?php echo $xe_co[4] ?>,<?php echo $do_dien_tu[4] ?>,<?php echo $gia_dung_noi_that_cay_canh[4] ?>,<?php echo $giai_tri_the_thao_so_thich[4] ?>,<?php echo $me_va_be[4] ?>,<?php echo $dich_vu_du_lich[4] ?>]
                            ];

                            function drawVisualization() {
                                // Some raw data (not necessarily accurate)
                                var data = google.visualization.arrayToDataTable(table);

                                var options = {
                                    title: 'Thống kê truy cập người dùng',
                                    vAxis: {title: 'Doanh thu'},     //trục Oy
                                    hAxis: {title: 'Thời gian'},    //trục Ox
                                    seriesType: 'bars',
                                    series: {0: {type: 'line'}, 7: {type: 'line'},3: {type: 'line'},5: {type: 'line'}}
                                };

                                var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
                                chart.draw(data, options);
                            }
                        </script>
                        </head>
                        <body>
                        <div id="chart_div" style="width: 1150px; height: 500px;"></div>
                        </body>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </section>
@endsection
