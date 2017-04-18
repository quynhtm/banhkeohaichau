<div class="container mb">
    @if(sizeof($arrType) > 0)
        @foreach($arrType as $k=>$type)
            @if($type->department_status_home == 1)
            <div class="box-item-line">
                <div class="line-title-menu-post">
                    <div class="box-line-title-menu-post @if($k==1) blue @elseif($k==2) green @elseif($k==3) blue @elseif($k==4) brown @endif">{{$type->department_name}}</div>
                    <ul class="btn-more-title">
                        <li><a href="{{FunctionLib::buildLinkTypeProduct($type->department_id, $type->department_name)}}" title="{{stripslashes($type->department_name)}}"><i class="fa fa-angle-double-right icon-more-font"></i> Xem tất cả</a></li>
                    </ul>
                    @if(sizeof($arrAllCategoryProduct) > 0)
                    <ul class="list-cate-post">
                        <?php $i=1; ?>
                        @foreach($arrAllCategoryProduct as $cat)
                            @if($cat->category_menu_right == 1 && $cat->category_depart_id == $type->department_id && $i <= CGlobal::number_show_5)
                                <?php $i++; ?>
                                <li><a href="{{FunctionLib::buildLinkCategory($cat->category_id, $cat->category_name)}}">{{$cat->category_name}}</a></li>
                            @endif
                        @endforeach
                    </ul>
                    @endif
                </div>
                <?php
                    $arrBannerTopLeft = Banner::getBannerAdvanced(CGlobal::BANNER_TYPE_LEFT_TOP, $type->department_id, 0, 0);
                    $arrBannerBottomLeft = Banner::getBannerAdvanced(CGlobal::BANNER_TYPE_LEFT_BOTTOM, $type->department_id, 0, 0);
                    $arrBannerCenter = Banner::getBannerAdvanced(CGlobal::BANNER_TYPE_CENTER, $type->department_id, 0, 0);
                    if(sizeof($arrBannerTopLeft) > 0 && sizeof($arrBannerBottomLeft) > 0){
                        $arrItem  = Product::getProductForSiteIndex($type->department_id, $limit =4);
                    }else{
                        $arrItem  = Product::getProductForSiteIndex($type->department_id, $limit =5);
                    }
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
                        @if(sizeof($arrItem) > 0)
                            @foreach($arrItem as $item)
                            <div class="one-item">

                                <div class="ithumb">
                                    @if($item->product_image != '')
                                        <a href="{{FunctionLib::buildLinkDetailProduct($item->product_id, $item->product_name)}}" title="{{stripslashes($item->product_name)}}">
                                            <img src="{{ThumbImg::getImageThumb(CGlobal::FOLDER_PRODUCT, $item->product_id, $item->product_image, CGlobal::sizeImage_600, '', true, 1, false)}}" alt="{{stripslashes($item->product_name)}}" />
                                        </a>
                                    @endif
                                    <a class="fancybox" href="{{ThumbImg::getImageThumb(CGlobal::FOLDER_PRODUCT, $item->product_id, $item->product_image, CGlobal::sizeImage_1000, '', true, 1, false)}}"><i class="fa fa-search-plus"></i></a>
                                </div>
                                <div class="idesc">
                                    <div class="ititle"><a href="{{FunctionLib::buildLinkDetailProduct($item->product_id, $item->product_name)}}" title="{{stripslashes($item->product_name)}}">{{stripslashes($item->product_name)}}</a></div>
                                    <div class="iprice">
                                        @if($item->product_type_price == CGlobal::TYPE_PRICE_NUMBER)
                                            @if((int)$item->product_price_sell > 0)
                                                {{FunctionLib::numberFormat((int)$item->product_price_sell)}} vnđ
                                            @else
                                                Liên hệ
                                            @endif
                                        @else
                                            Liên hệ
                                        @endif
                                    </div>
                                </div>
                                <a href="{{FunctionLib::buildLinkDetailProduct($item->product_id, $item->product_name)}}" title="{{stripslashes($item->product_name)}}">
                                    <div class="ibuy" dataid="{{$item->product_id}}"><i></i>Mua hàng</div>
                                </a>
                            </div>
                            @endforeach
                        @endif
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
                                @if(sizeof($arrItem) > 0)
                                    @foreach($arrItem as $item)
                                        <div class="one-item">
                                            <div class="ithumb">
                                                @if($item->product_image != '')
                                                    <a href="{{FunctionLib::buildLinkDetailProduct($item->product_id, $item->product_name)}}" title="{{stripslashes($item->product_name)}}">
                                                        <img src="{{ThumbImg::getImageThumb(CGlobal::FOLDER_PRODUCT, $item->product_id, $item->product_image, CGlobal::sizeImage_600, '', true, 1, false)}}" alt="{{$item->product_name}}" />
                                                    </a>
                                                 @endif
                                                <a class="fancybox" href="{{ThumbImg::getImageThumb(CGlobal::FOLDER_PRODUCT, $item->product_id, $item->product_image, CGlobal::sizeImage_1000, '', true, 1, false)}}"><i class="fa fa-search-plus"></i></a>
                                            </div>
                                            <div class="idesc">
                                                <div class="ititle"><a href="{{FunctionLib::buildLinkDetailProduct($item->product_id, $item->product_name)}}" title="{{stripslashes($item->product_name)}}">{{stripslashes($item->product_name)}}</a></div>
                                                <div class="iprice">
                                                    @if($item->product_type_price == CGlobal::TYPE_PRICE_NUMBER)
                                                        @if((int)$item->product_price_sell > 0)
                                                            {{FunctionLib::numberFormat((int)$item->product_price_sell)}} vnđ
                                                        @else
                                                            Liên hệ
                                                        @endif
                                                    @else
                                                        Liên hệ
                                                    @endif
                                                </div>
                                            </div>
                                            <a href="{{FunctionLib::buildLinkDetailProduct($item->product_id, $item->product_name)}}" title="{{stripslashes($item->product_name)}}">
                                                <div class="ibuy" dataid="{{$item->product_id}}"><i></i>Mua hàng</div>
                                            </a>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            @endif
        @endforeach
    @endif
</div>
<script>
    $(document).ready(function(){
        $("a.fancybox").fancybox({
            'transitionIn'	:	'elastic',
            'transitionOut'	:	'elastic',
            'speedIn'		:	600,
            'speedOut'		:	200,
            'overlayShow'	:	false
        });
    });
</script>