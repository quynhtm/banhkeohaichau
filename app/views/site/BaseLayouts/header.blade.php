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
        <div class="toggle-menu" id="toggle-menu">
            <i class="fa fa-th-list"></i>
        </div>
        @if(Route::currentRouteName() == 'site.home')
            <h1 id="logo">
                <a href="{{URL::route('site.home')}}">
                    <img src="{{URL::route('site.home')}}/assets/frontend/img/logo.png" alt="{{CGlobal::web_name}}">
                </a>
            </h1>
        @else
            <div id="logo">
                <a href="{{URL::route('site.home')}}">
                    <img src="{{URL::route('site.home')}}/assets/frontend/img/logo.png" alt="{{CGlobal::web_name}}">
                </a>
            </div>
        @endif
        <div class="box-search">
            {{Form::open(array('method' => 'GET', 'id'=>'frmsearch', 'class'=>'frmsearch', 'name'=>'frmsearch', 'url'=>URL::route('site.pageSearchProduct') ))}}
            <input name="keyword" class="keyword" @if(isset($keyword) && $keyword != '')value="{{$keyword}}"@endif autocomplete="off" placeholder="Tìm kiếm nhiều: Hộp bánh kem xốp phủ Socola..." type="text">
            <button type="submit" class="btn-search"><i class="fa fa-search"></i></button>
            {{Form::close()}}
        </div>
        <div class="box-right-mid">
            <ul class="line text-right">
                @if(isset($numCart))
                <li class="box-radius box-cart"><a href="{{URL::route('site.listCartOrder')}}"><i class="bg"></i> Giỏ hàng <span title="{{$numCart}}">{{$numCart}}</span></a></li>
                @endif
                @if(isset($numFavorite))
                <li class="box-radius box-favorite"><a href="{{URL::route('site.favoriteProduct')}}"><i class="bg"></i> Yêu thích <span title="{{$numFavorite}}">{{$numFavorite}}</span></a></li>
                @endif
            </ul>
            @if(empty($user_customer))
                <ul class="box-reg line text-right">
                    <li class="box-radius clickLogin"><a href="javascript:void(0);">Đăng nhập</a></li>
                    <li class="box-radius clickRegister"><a href="javascript:void(0);">Đăng ký</a></li>
                </ul>
            @else
                <div class="box-login">
                    <div class="cpanel-page">
                        <a href="javascript:void(0)" class="name-customer">Chào: {{isset($user_customer['customer_name']) ? $user_customer['customer_name'] : 'No Name'}}</a>
                        <ul class="list-cpanel">
                            <li><a href="{{URL::route('customer.historyBuy')}}" rel="nofollow"><i class="glyphicon glyphicon-shopping-cart"></i> Lịch sử mua hàng</a></li>
                            <li><a href="{{URL::route('customer.pageChageInfo')}}" rel="nofollow"><i class="glyphicon glyphicon-align-left"></i> Thông tin cá nhân</a></li>
                            <li><a href="{{URL::route('customer.logout')}}" rel="nofollow"><i class="glyphicon glyphicon-share-alt"></i> Thoát</a></li>
                        </ul>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
<div class="bottom-head">
    <div class="container">
        <div class="line-bottom-head first">
            <div class="box-title-category">
                <span class="txt-title-category">Danh mục sản phẩm</span>
                @if(Route::currentRouteName() != 'site.home')
                <div class="box-list-category dropdown">
                    <div class="line-text-close">
                        <span class="icon-close">Close Menu</span>
                    </div
                    @if(sizeof($menuCateVertical) > 0)
                        <ul>
                            <?php $i=1; ?>
                            @foreach($menuCateVertical as $cat)
                                @if($cat->category_menu_status == CGlobal::status_show && $cat->category_parent_id == 0 && $i <= 13)
                                    <?php $s=1; ?>
                                    <?php
                                    $i++;
                                    foreach($menuCateVertical as $sub){
                                        if($sub->category_parent_id == $cat->category_id && $sub->category_menu_status == CGlobal::status_show){
                                            $s++;
                                        }
                                    }
                                    ?>
                                    <li><a href="{{FunctionLib::buildLinkCategory($cat->category_id, $cat->category_name)}}">{{$cat->category_name}}
                                            @if($s > 1)
                                                <i class="fa fa-angle-right"></i>
                                            @endif
                                        </a>
                                        @if($s > 1)
                                            <div class="list-subcat" style="background: #89122b">
                                                <ul>
                                                    @foreach($menuCateVertical as $sub)
                                                        @if($sub->category_menu_status == CGlobal::status_show && $sub->category_parent_id == $cat->category_id && $sub->category_parent_id > 0)
                                                            <li><a href="{{FunctionLib::buildLinkCategory($sub->category_id, $sub->category_name)}}">{{$sub->category_name}}</a></li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                        <div class="link-last"><a href="#">Xem tất cả</a></div>
                    @endif
                </div>
                @endif
            </div>
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