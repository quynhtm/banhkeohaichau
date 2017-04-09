<div class="top-head">
    <div class="container">
        <ul class="lang">
            <li><a class="act" href="?vi">Vi</a> / </li>
            <li><a href="?en">En</a></li>
        </ul>
        <ul class="support">
            <li>Hotline: 01999.102.888</li>
            <li><a href="">Chăm sóc khách hàng</a></li>
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
                <ul>
                    <li><a href="">Trang chủ</a></li>
                    <li><a href="">Giới thiệu</a></li>
                    <li><a href="">Tin tức</a></li>
                    <li><a href="">Đại lý</a></li>
                    <li><a href="">Khuyến mại</a></li>
                    <li><a href="">Bảng giá</a></li>
                    <li><a href="">video</a></li>
                    <li><a href="">Tuyển Dụng</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>