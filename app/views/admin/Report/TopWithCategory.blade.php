<div style="margin-top: 20px">
    <ul class="nav nav-tabs" style="border-bottom: 1px solid #ED9C28;">
        <li >
            <a href="{{Config::get('config.WEB_ROOT')}}admin/adminReport/ReportSumDealIsGet" @if($actionTag === 'reportSumDealIsGet') class="active actionTag" @else class="noActionTag" @endif>
                Trạng thái deal
            </a>
        </li>
        <li >
            <a href="{{Config::get('config.WEB_ROOT')}}admin/adminReport/GeneralAssessment" @if($actionTag === 'generalAssessment') class="active actionTag" @else class="noActionTag" @endif>
                Hiệu quả Onsite
            </a>
        </li>
        <li >
            <a href="{{Config::get('config.WEB_ROOT')}}admin/adminReport/EffectWithCategory" @if($actionTag === 'effectWithCategory') class="active actionTag" @else class="noActionTag" @endif>
                Hiệu quả ngành hàng
            </a>
        </li>
        <li >
            <a href="{{Config::get('config.WEB_ROOT')}}admin/adminReport/CompareEffectWithCategory" @if($actionTag === 'compareEffectWithCategory') class="active actionTag" @else class="noActionTag" @endif>
                So sánh hiểu quả ngành hàng
            </a>
        </li>
        <li >
            <a href="{{Config::get('config.WEB_ROOT')}}admin/adminReport/TopWithCategory" @if($actionTag === 'topWithCategory') class="active actionTag" @else class="noActionTag" @endif>
                TOP bán hàng - doanh số - lợi nhuận
            </a>
        </li>
    </ul>
</div>

<div class="box">
    <header>
        <h5>Thông tin tìm kiếm</h5>
    </header>
    <div id="div-4" class="body">
        @if(isset($error))
            @foreach($error as $itmError)
                <p><span style=" color:red">{{ $itmError }}</span></p>
            @endforeach
        @endif
        {{ Form::open(array('class'=>'form-horizontal','id'=>'form_thongke', 'method'=>'GET')) }}
            <div id="div-4">
               <div class="form-group">
                   <div class="col-lg-2 padding-top-1">
                        <div>
                            <label for="category_id">Chọn ngành hàng</label>
                            <div>
                                <select name="category_id" id="category_id" class="form-control input-sm">
                                    {{$optionParentCategory}}
                                </select>
                            </div>
                        </div>
                   </div>
                   <div class="col-lg-3 padding-top-1">
                        <div>
                            <label for="category_id">Kiểu lọc</label>
                            <div>
                                <select name="type_search" id="type_search" class="form-control input-sm">
                                    {{$optionTypeSearch}}
                                </select>
                            </div>
                        </div>
                   </div>
                   <div class="col-lg-2 padding-top-1">
                        <div>
                            <label for="name" class="control-label">Từ ngày</label>
                            <div><input type="text" class="form-control" id="start_time" name="start_time"  data-date-format="dd-mm-yyyy" value="@if(isset($dataSearch['start_time'])) {{date('d-m-Y',$dataSearch['start_time'])}} @endif"></div>
                        </div>
                   </div>
                   <div class="col-lg-2 padding-top-1">
                        <div>
                            <label for="name" class="control-label">Đến ngày</label>
                            <div><input type="text" class="form-control" id="end_time" name="end_time"  data-date-format="dd-mm-yyyy" value="@if(isset($dataSearch['end_time'])) {{date('d-m-Y',$dataSearch['end_time'])}} @endif"></div>
                        </div>
                   </div>
                   <div class="col-lg-3 padding-top-1">
                        <div>
                            <label for="name" class="control-label">&nbsp;</label>
                            <button class="btn btn-primary" name="submit" value="1">Tìm kiếm</button>
                            <button class="btn btn-info" name="submit" value="2">Xuất Excel</button>
                        </div>
                   </div>

                </div><!-- /.form-group -->
            </div>
        {{ Form::close() }}
    </div>
</div>

@if($data_banhang)
    <h3 class="text-left">TOP bán hàng</h3>
    <!--bang du lieu-->
    <div class="float-left" style="width:40%">
    <table class="table-hover table table-bordered success font_14" style="margin-top: 10px;">
        <thead>
        <tr style="background-color: #00b3ee">
            <th width="10%" class="text-center">Id deal onsite</th>
            <th width="10%" class="text-center">Số lượng bán</th>
            <th width="10%" class="text-right">Doanh số</th>
            <th width="13%" class="text-right">Lợi nhuận</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($data_banhang as $k=>$dataView)
            <tr>
                <td class="text-center text-middle">
                    <a href="{{ URL::route('site.detail', array('cat'=>'Nemo','name'=>strtolower(FunctionLib::safe_title('sản phẩm')),'id'=>$dataView['product_id'])) }}" target="_blank" title="Chi tiết sản phẩm"> {{ $dataView['product_id'] }}</a>
                </td>
                <td class="text-center text-middle" style="background-color: #d58512">{{ $dataView['total_product'] }}</td>
                <td class="text-right text-middle">
                    <b>{{ FunctionLib::numberFormat($dataView['total_price']) }}</b>
                </td>
                <td class="text-right text-middle">
                    <b>{{ FunctionLib::numberFormat($dataView['total_profit']) }}</b>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    </div>
    <!--Do thi-->
    <div id="container" class="float-left" style="width: 60%; height: 400px; margin: 0 auto"></div>
    <div style="clear: both"></div>
    <hr style="border-bottom: 1px solid #ccc"/>
@endif

@if($data_doanhso)
    <h3 class="text-left">TOP doanh số</h3>
    <!--bang du lieu-->
    <div class="float-left" style="width:40%">
    <table class="table-hover table table-bordered success font_14" style="margin-top: 10px;">
        <thead>
        <tr style="background-color: #00b3ee">
            <th width="10%" class="text-center">Id deal onsite</th>
            <th width="10%" class="text-center">Số lượng bán</th>
            <th width="10%" class="text-right">Doanh số</th>
            <th width="13%" class="text-right">Lợi nhuận</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($data_doanhso as $kk=>$dataView2)
            <tr>
                <td class="text-center text-middle">
                    <a href="{{ URL::route('site.detail', array('cat'=>'Nemo','name'=>strtolower(FunctionLib::safe_title('sản phẩm')),'id'=>$dataView2['product_id'])) }}" target="_blank" title="Chi tiết sản phẩm"> {{ $dataView2['product_id'] }}</a>
                </td>
                <td class="text-center text-middle">{{ $dataView2['total_product'] }}</td>
                <td class="text-right text-middle" style="background-color: #d58512">
                    <b>{{ FunctionLib::numberFormat($dataView2['total_price']) }}</b>
                </td>
                <td class="text-right text-middle">
                    <b>{{ FunctionLib::numberFormat($dataView2['total_profit']) }}</b>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    </div>
    <!--Do thi-->
    <div id="container_2" class="float-left" style="width: 60%; height: 400px; margin: 0 auto"></div>
    <div style="clear: both"></div>
    <hr style="border-bottom: 1px solid #ccc"/>
@endif

@if($data_doanhthu)
    <h3 class="text-left">TOP lợi nhuận</h3>
    <!--bang du lieu-->
    <div class="float-left" style="width:40%">
    <table class="table-hover table table-bordered success font_14" style="margin-top: 10px;">
        <thead>
        <tr style="background-color: #00b3ee">
            <th width="10%" class="text-center">Id deal onsite</th>
            <th width="10%" class="text-center">Số lượng bán</th>
            <th width="10%" class="text-right">Doanh số</th>
            <th width="13%" class="text-right">Lợi nhuận</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($data_doanhthu as $kkk=>$dataView3)
            <tr>
                <td class="text-center text-middle">
                    <a href="{{ URL::route('site.detail', array('cat'=>'Nemo','name'=>strtolower(FunctionLib::safe_title('sản phẩm')),'id'=>$dataView3['product_id'])) }}" target="_blank" title="Chi tiết sản phẩm"> {{ $dataView3['product_id'] }}</a>
                </td>
                <td class="text-center text-middle">{{ $dataView3['total_product'] }}</td>
                <td class="text-right text-middle">
                    <b>{{ FunctionLib::numberFormat($dataView3['total_price']) }}</b>
                </td>
                <td class="text-right text-middle" style="background-color: #d58512">
                    <b>{{ FunctionLib::numberFormat($dataView3['total_profit']) }}</b>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    </div>
    <!--Do thi-->
    <div id="container_3" class="float-left" style="width: 60%; height: 400px; margin: 0 auto"></div>
    <div style="clear: both"></div>
@endif

<script type="text/javascript">
    $(function () {
        var checkin = $('#start_time').datepicker({ });
        var checkout = $('#end_time').datepicker({ });
        $('#container').highcharts({
            chart: {
                type: 'pie',
                options3d: {
                    enabled: true,
                    alpha: 50,
                    beta: 0
                }
            },
            title: {
                text: 'Cơ cấu số lượng bán <?php echo $name_category;?>'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    depth: 35,
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b> - {point.percentage:.2f} %',
                        style: {
                            color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                        }
                    }
                }
            },
            series: [{
                type: 'pie',
                name: 'lượng bán',
                data: [
                        <?php
                            foreach($dothi_banhang as $k1=>$v1){
                            if($k1 == 0){
                        ?>
                            {
                                name: '<?php echo $v1['total_product'];?>',
                                y: <?php echo $v1['percent_sale'];?>,
                                sliced: true,
                                selected: true
                            },
                        <?php }else{?>
                            ['<?php echo $v1['total_product'];?>', <?php echo $v1['percent_sale'];?>],
                        <?php }}?>
                ]
            }]
        });

        $('#container_2').highcharts({
            chart: {
                type: 'pie',
                options3d: {
                    enabled: true,
                    alpha: 50,
                    beta: 0
                }
            },
            title: {
                text: 'Cơ cấu số doanh số <?php echo $name_category;?>'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    depth: 70,
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b> - {point.percentage:.1f} %',
                        style: {
                            color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                        }
                    }
                }
            },
            series: [{
                type: 'pie',
                name: 'doanh số',
                data: [
                        <?php
                            foreach($dothi_doanhso as $k2=>$v2){
                            if($k2 == 1){
                        ?>
                            {
                                name: '<?php echo FunctionLib::numberFormat($v2['total_price']);?>',
                                y: <?php echo $v2['percent_price'];?>,
                                sliced: true,
                                selected: true
                            },
                        <?php }else{?>
                            ['<?php echo FunctionLib::numberFormat($v2['total_price']);?>', <?php echo $v2['percent_price'];?>],
                        <?php }}?>
                ]
            }]
        });

        $('#container_3').highcharts({
            chart: {
                type: 'pie',
                options3d: {
                    enabled: true,
                    alpha: 50,
                    beta: 0
                }
            },
            title: {
                text: 'Cơ cấu số doanh thu <?php echo $name_category;?>'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    depth: 95,
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b> - {point.percentage:.1f} %',
                        style: {
                            color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                        }
                    }
                }
            },
            series: [{
                type: 'pie',
                name: 'doanh thu',
                data: [
                        <?php
                            foreach($dothi_doanhthu as $k3=>$v3){
                            if($k3 == 2){
                        ?>
                            {
                                name: '<?php echo FunctionLib::numberFormat($v3['total_profit']);?>',
                                y: <?php echo $v3['percent_profit'];?>,
                                sliced: true,
                                selected: true
                            },
                        <?php }else{?>
                            ['<?php echo FunctionLib::numberFormat($v3['total_profit']);?>', <?php echo $v3['percent_profit'];?>],
                        <?php }}?>
                ]
            }]
        });

    });
</script>

