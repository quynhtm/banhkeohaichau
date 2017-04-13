<div class="container">
    @if(sizeof($arrType) > 0)
        @foreach($arrType as $k=>$type)
            @if($type->department_status_home == 1)
            <div class="box-item-line">
                <div class="line-title-menu-post">
                    <div class="box-line-title-menu-post @if($k==1) blue @elseif($k==2) green @elseif($k==3) blue @elseif($k==4) brown @endif">{{$type->department_name}}</div>
                    <ul class="btn-more-title">
                        <li><a href=""><i class="fa fa-angle-double-right icon-more-font"></i> Xem tất cả</a></li>
                    </ul>
                    @if(sizeof($arrAllCategoryProduct) > 0)
                    <ul>
                        <?php $i=1; ?>
                        @foreach($arrAllCategoryProduct as $cat)
                            @if($cat->category_menu_right == 1 && $cat->category_depart_id == $type->department_id && $i <= CGlobal::number_show_5)
                                <?php $i++; ?>
                            <li><a href="">{{$cat->category_name}}</a></li>
                            @endif
                        @endforeach
                    </ul>
                    @endif
                </div>
                <?php
                    $arrBannerTopLeft = Banner::getBannerAdvanced(CGlobal::BANNER_TYPE_LEFT_TOP, $type->department_id, 0, 0);
                    $arrBannerBottomLeft = Banner::getBannerAdvanced(CGlobal::BANNER_TYPE_LEFT_BOTTOM, $type->department_id, 0, 0);
                    $arrBannerCenter = Banner::getBannerAdvanced(CGlobal::BANNER_TYPE_CENTER, $type->department_id, 0, 0);
                ?>
                @if(sizeof($arrBannerTopLeft) == 0 && sizeof($arrBannerBottomLeft) == 0)
                    @if(sizeof($arrBannerCenter) > 0)
                        <div class="line mgt8">
                        @foreach($arrBannerCenter as $item)
                            <a href="{{$item->banner_link}}" @if($item->banner_is_rel == CGlobal::LINK_NOFOLLOW) rel="nofollow" @endif title="{{$item->banner_name}}">
                                <img src="{{ThumbImg::thumbImageBannerNormal($item->banner_id,$item->banner_parent_id, $item->banner_image, CGlobal::sizeImage_1000,CGlobal::sizeImage_450, $item->banner_name,true,true)}}" alt="{{$item->banner_name}}" />
                            </a>
                        @endforeach
                    </div>
                    @endif
                    <div class="box-list-item">
                        <div class="one-item">
                            <a href="#" title="">
                                <div class="ithumb">
                                    <img src="{{URL::route('site.home')}}/assets/frontend/img/1p.png" alt="">
                                </div>
                                <div class="idesc">
                                    <div class="ititle">Hộp bánh kem xốp phủ sôcôla Caste</div>
                                    <div class="iprice">132.000 vnđ</div>
                                    <div class="ibuy"><i></i>Mua hàng</div>
                                </div>
                            </a>
                        </div>
                        <div class="one-item">
                            <a href="#" title="">
                                <div class="ithumb">
                                    <img src="{{URL::route('site.home')}}/assets/frontend/img/1p.png" alt="">
                                </div>
                                <div class="idesc">
                                    <div class="ititle">Hộp bánh kem xốp phủ sôcôla Caste</div>
                                    <div class="iprice">132.000 vnđ</div>
                                    <div class="ibuy"><i></i>Mua hàng</div>
                                </div>
                            </a>
                        </div>
                        <div class="one-item">
                            <a href="#" title="">
                                <div class="ithumb">
                                    <img src="{{URL::route('site.home')}}/assets/frontend/img/1p.png" alt="">
                                </div>
                                <div class="idesc">
                                    <div class="ititle">Hộp bánh kem xốp phủ sôcôla Caste</div>
                                    <div class="iprice">132.000 vnđ</div>
                                    <div class="ibuy"><i></i>Mua hàng</div>
                                </div>
                            </a>
                        </div>
                        <div class="one-item">
                            <a href="#" title="">
                                <div class="ithumb">
                                    <img src="{{URL::route('site.home')}}/assets/frontend/img/1p.png" alt="">
                                </div>
                                <div class="idesc">
                                    <div class="ititle">Hộp bánh kem xốp phủ sôcôla Caste</div>
                                    <div class="iprice">132.000 vnđ</div>
                                    <div class="ibuy"><i></i>Mua hàng</div>
                                </div>
                            </a>
                        </div>
                        <div class="one-item">
                            <a href="#" title="">
                                <div class="ithumb">
                                    <img src="{{URL::route('site.home')}}/assets/frontend/img/1p.png" alt="">
                                </div>
                                <div class="idesc">
                                    <div class="ititle">Hộp bánh kem xốp phủ sôcôla Caste</div>
                                    <div class="iprice">132.000 vnđ</div>
                                    <div class="ibuy"><i></i>Mua hàng</div>
                                </div>
                            </a>
                        </div>
                    </div>
                @elseif(sizeof($arrBannerTopLeft) > 0 || sizeof($arrBannerBottomLeft) > 0)
                <div class="box-list-item">
                    <div class="one-item-ext">
                        @if(sizeof($arrBannerTopLeft) > 0)
                            @foreach($arrBannerTopLeft as $item)
                            <a href="{{$item->banner_link}}" @if($item->banner_is_rel == CGlobal::LINK_NOFOLLOW) rel="nofollow" @endif title="{{$item->banner_name}}">
                                <img src="{{ThumbImg::thumbImageBannerNormal($item->banner_id,$item->banner_parent_id, $item->banner_image, CGlobal::sizeImage_300,CGlobal::sizeImage_750, $item->banner_name,true,true)}}" alt="{{$item->banner_name}}" />
                            </a>
                            @endforeach
                        @endif
                        @if(sizeof($arrBannerBottomLeft) > 0)
                            @foreach($arrBannerBottomLeft as $item)
                                <a href="{{$item->banner_link}}" @if($item->banner_is_rel == CGlobal::LINK_NOFOLLOW) rel="nofollow" @endif title="{{$item->banner_name}}">
                                    <img src="{{ThumbImg::thumbImageBannerNormal($item->banner_id,$item->banner_parent_id, $item->banner_image, CGlobal::sizeImage_300,CGlobal::sizeImage_750, $item->banner_name,true,true)}}" alt="{{$item->banner_name}}" />
                                </a>
                            @endforeach
                        @endif
                    </div>
                    <div class="list-one-item-ext">
                            @if(sizeof($arrBannerCenter) > 0)
                            <div class="line banner-in-content mgb8">
                                @foreach($arrBannerCenter as $item)
                                    <a href="{{$item->banner_link}}" @if($item->banner_is_rel == CGlobal::LINK_NOFOLLOW) rel="nofollow" @endif title="{{$item->banner_name}}">
                                        <img src="{{ThumbImg::thumbImageBannerNormal($item->banner_id,$item->banner_parent_id, $item->banner_image, CGlobal::sizeImage_1020,CGlobal::sizeImage_450, $item->banner_name,true,true)}}" alt="{{$item->banner_name}}" />
                                    </a>
                                @endforeach
                            </div>
                            @endif
                            <div class="line">
                                <div class="one-item">
                                    <a href="#" title="">
                                        <div class="ithumb">
                                            <img src="{{URL::route('site.home')}}/assets/frontend/img/1p.png" alt="">
                                        </div>
                                        <div class="idesc">
                                            <div class="ititle">Hộp bánh kem xốp phủ sôcôla Caste</div>
                                            <div class="iprice">132.000 vnđ</div>
                                            <div class="ibuy"><i></i>Mua hàng</div>
                                        </div>
                                    </a>
                                </div>
                                <div class="one-item">
                                    <a href="#" title="">
                                        <div class="ithumb">
                                            <img src="{{URL::route('site.home')}}/assets/frontend/img/1p.png" alt="">
                                        </div>
                                        <div class="idesc">
                                            <div class="ititle">Hộp bánh kem xốp phủ sôcôla Caste</div>
                                            <div class="iprice">132.000 vnđ</div>
                                            <div class="ibuy"><i></i>Mua hàng</div>
                                        </div>
                                    </a>
                                </div>
                                <div class="one-item">
                                    <a href="#" title="">
                                        <div class="ithumb">
                                            <img src="{{URL::route('site.home')}}/assets/frontend/img/1p.png" alt="">
                                        </div>
                                        <div class="idesc">
                                            <div class="ititle">Hộp bánh kem xốp phủ sôcôla Caste</div>
                                            <div class="iprice">132.000 vnđ</div>
                                            <div class="ibuy"><i></i>Mua hàng</div>
                                        </div>
                                    </a>
                                </div>
                                <div class="one-item">
                                    <a href="#" title="">
                                        <div class="ithumb">
                                            <img src="{{URL::route('site.home')}}/assets/frontend/img/1p.png" alt="">
                                        </div>
                                        <div class="idesc">
                                            <div class="ititle">Hộp bánh kem xốp phủ sôcôla Caste</div>
                                            <div class="iprice">132.000 vnđ</div>
                                            <div class="ibuy"><i></i>Mua hàng</div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            @endif
        @endforeach
    @endif
</div>
