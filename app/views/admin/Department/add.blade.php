<div class="main-content-inner">
    <div class="breadcrumbs breadcrumbs-fixed" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-home home-icon"></i>
                <a href="{{URL::route('admin.dashboard')}}">Home</a>
            </li>
            <li><a href="{{URL::route('admin.department_list')}}"> Danh sách chuyên mục</a></li>
            <li class="active">@if($id > 0)Cập nhật chuyên mục @else Tạo mới chuyên mục @endif</li>
        </ul><!-- /.breadcrumb -->
    </div>

    <div class="page-content">
        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->
                {{Form::open(array('role'=>'form','url' =>($id > 0)? "admin/department/postDepartment/$id" : 'admin/department/postDepartment','files' => true))}}
                @if(isset($error))
                    <div class="alert alert-danger" role="alert">
                        @foreach($error as $itmError)
                            <p>{{ $itmError }}</p>
                        @endforeach
                    </div>
                @endif

                <div style="float: left; width: 50%">
                    <div class="col-sm-10">
                        <div class="form-group">
                            <label for="name" class="control-label">Tên chuyên mục<span class="red"> (*) </span></label>
                            <input type="text" placeholder="Tên khoa - trung tâm" id="department_name" name="department_name"  class="form-control input-sm" value="@if(isset($data['department_name'])){{$data['department_name']}}@endif">
                        </div>
                    </div>
                    @if($id > 0)
                    <div class="col-sm-10">
                        <div class="form-group">
                            <label for="name" class="control-label">Tên rút gọn</label>
                            <input type="text" disabled id="department_alias" name="department_alias"  class="form-control input-sm" value="@if(isset($data['department_alias'])){{$data['department_alias']}}@endif">
                        </div>
                    </div>
                    @endif

                    <div class="clearfix"></div>
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label for="name" class="control-label">Kiểu</label>
                            <select name="department_type" id="department_type" class="form-control input-sm">
                                {{$optionTypeDepart}}
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label for="name" class="control-label">Layous hiển thị</label>
                            <select name="department_layouts" id="department_layouts" class="form-control input-sm">
                                {{$optionLayoutsDepart}}
                            </select>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label for="name" class="control-label">Hiển thị trang chủ</label>
                            <select name="department_status_home" id="department_status_home" class="form-control input-sm">
                                {{$optionStatusHome}}
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label for="name" class="control-label">Trạng thái</label>
                            <select name="department_status" id="department_status" class="form-control input-sm">
                                {{$optionStatus}}
                            </select>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                    <div class="col-sm-10">
                        <div class="form-group">
                            <label for="name" class="control-label">Vị trí hiển thị</label>
                            <input type="text" placeholder="Vị trí hiển thị" id="department_order" name="department_order"  class="form-control input-sm" value="@if(isset($data['department_order'])){{$data['department_order']}}@endif">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group col-sm-12 text-left">
                        <a class="btn btn-warning" href="{{URL::route('admin.department_list')}}"><i class="fa fa-reply"></i> Trở lại</a>
                        <button  class="btn btn-primary"><i class="glyphicon glyphicon-floppy-saved"></i> Lưu lại</button>
                    </div>
                    <input type="hidden" id="id_hiden" name="id_hiden" value="{{$id}}"/>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
