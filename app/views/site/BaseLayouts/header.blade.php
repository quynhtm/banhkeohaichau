<div class="top-head">
    <div class="container">
        <ul class="lang">
            <li><a class="act" href="?vi">Vi</a> / </li>
            <li><a href="?en">En</a></li>
        </ul>
        <ul class="support">
            <li>Hotline: {{$hotline}}</li>
            <li><a href="{{URL::route('site.pageCareCustomer')}}">Chăm sóc khách hàng</a></li>
            <li><a href="">Kiểm tra đơn hàng</a></li>
        </ul>
    </div>
</div>
<div class="mid-head">
    <div class="container">
        @if(Route::currentRouteName() == 'site.home')
            <h1 id="logo">
                <a href="{{URL::route('site.home')}}">
                    <img src="{{URL::route('site.home')}}/assets/frontend/img/logo.png" alt="{{CGlobal::web_name}}">
                </a>
            </h1>
        @else
            <div id="logo">
                <img src="{{URL::route('site.home')}}/assets/frontend/img/logo.png" alt="{{CGlobal::web_name}}">
            </div>
        @endif
        <div class="box-search">
            {{Form::open(array('method' => 'GET', 'id'=>'frmsearch', 'class'=>'frmsearch', 'name'=>'frmsearch', 'url'=>URL::route('site.home') ))}}
            <input name="keyword" class="keyword" @if(isset($keyword) && $keyword != '')value="{{$keyword}}"@endif autocomplete="off" placeholder="Tìm kiếm nhiều: Hộp bánh kem xốp phủ Socola..." type="text">
            <button type="submit" class="btn-search"><i class="fa fa-search"></i></button>
            {{Form::close()}}
        </div>
        <div class="box-right-mid">
            <ul class="line text-right">
                <li class="box-radius box-cart"><a href=""><i class="bg"></i> Giỏ hàng <span>25</span></a></li>
                <li class="box-radius box-favorite"><a href=""><i class="bg"></i> Yêu thích <span>10</span></a></li>
            </ul>
            <ul class="box-reg line text-right">
                <li class="box-radius"><a href="">Đăng nhập</a></li>
                <li class="box-radius"><a href="">Đăng ký</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="bottom-head">
    <div class="container">
        <div class="line-bottom-head first">
            <div class="box-title-category">Danh mục sản phẩm</div>
            <div class="box-catid">
                <ul class="menu">
                    <li><a href="{{URL::route('site.home')}}" title="Trang chủ">Trang chủ</a></li>
                    @if(isset($menuCateHorizontal) && sizeof($menuCateHorizontal) > 0)
                        @foreach($menuCateHorizontal as $k=>$item)
                            @if($item['category_menu_status'] == CGlobal::status_show && $item['category_parent_id'] == 0)
                            <li>
                                <a href="{{FunctionLib::buildLinkCategory($item['category_id'], $item['category_name'])}}" title="{{$item['category_name']}}">{{$item['category_name']}}</a>
                                <ul class="menu-sub">
                                    @foreach($menuCateHorizontal as $sub)
                                        @if($sub['category_parent_id'] == $item['category_id'] && $sub['category_menu_status'] == CGlobal::status_show)
                                            <li><a href="{{FunctionLib::buildLinkCategory($sub['category_id'], $sub['category_name'])}}" title="{{$sub['category_name']}}">{{$sub['category_name']}}</a></li>
                                        @endif
                                    @endforeach
                                </ul>
                            </li>
                            @endif
                        @endforeach
                    @endif
					<li><a href="{{URL::route('site.pageVideo')}}" title="Video">Video</a></li>
                    <li><a href="{{URL::route('site.pageContact')}}" title="contact">Liên hệ</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>