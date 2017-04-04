<div class="main-content-inner">
    <div class="breadcrumbs breadcrumbs-fixed" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-home home-icon"></i>
                <a href="{{URL::route('admin.dashboard')}}">Home</a>
            </li>
            <li><a href="{{URL::route('admin.managerOrderView')}}"> Danh sách đơn hàng</a></li>
            <li class="active">Thông tin chi tiết đơn hàng</li>
        </ul><!-- /.breadcrumb -->
    </div>

    <div class="page-content">
        <div class="row">
            <div class="col-xs-12">
                <!--thông tin khách hàng-->
                <div class="panel panel-info" style="width: 50%">
                    <div class="panel-footer text-left">
                        <h3>Thông tin khách hàng</h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group col-lg-12">
                            <label class="col-lg-3">Tên khách hàng:</label>
                            <label class="col-lg-8"><b>Trương mạnh quỳnh</b></label>
                        </div>
                    </div>
                </div>
                <!--thông tin khách hàng-->
                <div class="panel panel-info" style="width: 50%">
                    <div class="panel-footer text-left">
                        <h3>Thông tin khách hàng</h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group col-lg-3">
                            <label for="order_product_name">Tên sản phẩm</label>
                            <input type="text" class="form-control input-sm" id="order_product_name" name="order_product_name" placeholder="Tên sản phẩm" @if(isset($search['order_product_name']))value="{{$search['order_product_name']}}"@endif>
                        </div>
                    </div>
                </div>

                <!--thông tin sản phẩm trong đơn hàng-->
                <div class="panel panel-info">
                    <div class="panel-footer text-left">
                        <h3>Thông tin sản phẩm</h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group col-lg-3">
                            <label for="order_product_name">Tên sản phẩm</label>
                            <input type="text" class="form-control input-sm" id="order_product_name" name="order_product_name" placeholder="Tên sản phẩm" @if(isset($search['order_product_name']))value="{{$search['order_product_name']}}"@endif>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.page-content -->
</div>
