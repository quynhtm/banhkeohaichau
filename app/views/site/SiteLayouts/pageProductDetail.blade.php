<div class="container">
    <div class="post-page">
        <div class="content-post-line-product-view">
            @if(sizeof($arrCat) > 0)
                <h2 class="title-head cat">
                    <a href="{{FunctionLib::buildLinkCategory($arrCat->category_id, $arrCat->category_name)}}" title="{{$arrCat->category_name}}">{{$arrCat->category_name}}</a>
                </h2>
            @endif
            @if(sizeof($data) > 0)
            <div class="line-view">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-12 item-img-main">
                        <div id="gallery">
                           @if($data->product_image != '')
                            <div class="img-main-view">
                                <a href="{{ThumbImg::getImageThumb(CGlobal::FOLDER_PRODUCT, $data->product_id, $data->product_image, CGlobal::sizeImage_1000, '', true, 1, false)}}" title="{{stripslashes($data->product_name)}}">
                                    <img src="{{ThumbImg::getImageThumb(CGlobal::FOLDER_PRODUCT, $data->product_id, $data->product_image, CGlobal::sizeImage_600, '', true, 1, false)}}" alt="{{stripslashes($data->product_name)}}">
                                </a>
                            </div>
                            @endif
                            @if($data->product_image_other != '')
                                <?php  $product_image_other = unserialize($data->product_image_other); ?>
                                @if(is_array($product_image_other) && sizeof($product_image_other) > 0)
                                <div class="arr-img">
                                    <div id="slick">
                                        @foreach($product_image_other as $img)
                                        <div class="item-one-img-view">
                                            <a href="{{ThumbImg::getImageThumb(CGlobal::FOLDER_PRODUCT, $data->product_id, $img, CGlobal::sizeImage_1000, '', true, 1, false)}}" title="{{stripslashes($data->product_name)}}">
                                                <img src="{{ThumbImg::getImageThumb(CGlobal::FOLDER_PRODUCT, $data->product_id, $img, CGlobal::sizeImage_600, '', true, 1, false)}}" alt="{{stripslashes($data->product_name)}}">
                                            </a>
                                        </div>
                                        @endforeach
                                    </div>
                                    <script type="text/javascript">
                                        $(document).ready(function(){
                                            $("#slick").slick({
                                                dots: false,
                                                infinite: true,
                                                slidesToShow: 5,
                                                slidesToScroll: 3
                                            });
                                        });
                                    </script>
                                </div>
                                @endif
                            @endif
                        </div>
                        <div class="social-share-view">
                            <div class="div-share">
                                <div id="fb-root"></div>
                                <script>(function(d, s, id) {
                                        var js, fjs = d.getElementsByTagName(s)[0];
                                        if (d.getElementById(id)) return;
                                        js = d.createElement(s); js.id = id;
                                        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4";
                                        fjs.parentNode.insertBefore(js, fjs);
                                    }(document, 'script', 'facebook-jssdk'));</script>
                                <div class="fb-like" data-href="{{FunctionLib::buildLinkDetailProduct($data->product_id, $data->product_name)}}" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true"></div>
                            </div>
                            <div class="div-share google">
                                <script src="https://apis.google.com/js/platform.js" async defer></script>
                                <g:plus action="share" annotation="bubble"></g:plus>
                                <div class="g-plusone" data-size="medium"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-12">
                        <h1 class="show-title">{{stripslashes($data->product_name)}}</h1>
                        <div class="show-intro">
                            {{stripslashes($data->product_sort_desc)}}
                            <div class="group-price">
                                <div class="line-price">
                                    <span class="lb">Giá bán:</span>
                                    <span class="num-sale">
                                        @if($data->product_price_sell > 0)
                                            {{FunctionLib::numberFormat($data->product_price_sell)}} VNĐ
                                        @else
                                            Liên hệ
                                        @endif
                                    </span>
                                </div>
                                <div class="list-button-view">
                                    <div class="ibuy" dataid="{{$data->product_id}}"><i></i>Thêm vào giỏ hàng</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <div class="line-view">
                <div class="row">
                    <div class="col-lg-9 col-md-9 col-sm-9 left-post-view-more">
                        <div class="conditions-tab">
                            <ul>
                                <li data="ttct" class="selected">Thông tin chi tiết</li>
                                <li data="hdmhnhtt">Hướng dẫn mua hàng - Nhận hàng - Thanh toán</li>
                            </ul>
                            <div class="content-tab">
                                <div class="item-tab ttct act">
                                    {{stripslashes($data->product_content)}}
                                </div>
                                <div class="item-tab hdmhnhtt">
                                    {{$guide}}
                                </div>
                            </div>
                        </div>
                        <div class="title-post-same">Sản phẩm cùng loại</div>
                        <div class="box-list-item view">
                            @if(sizeof($productSame) > 0)
                                @foreach($productSame as $item)
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
                                            <div class="ititle">{{stripslashes($item->product_name)}}</div>
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
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <div class="list-item-block">
                            <div class="item-block-product">
                                <div class="title-hot-other">Bạn có thể quan tâm</div>
                                @if(sizeof($dataProductHot) > 0)
                                    @foreach($dataProductHot as $item)
                                    <div class="item-product">
                                        <a href="{{FunctionLib::buildLinkDetailProduct($item->product_id, $item->product_name)}}" title="{{stripslashes($item->product_name)}}">
                                            <div class="product-img">
                                                @if($item->product_image != '')
                                                    <img src="{{ThumbImg::getImageThumb(CGlobal::FOLDER_PRODUCT, $item->product_id, $item->product_image, CGlobal::sizeImage_600, '', true, 1, false)}}" alt="{{stripslashes($item->product_name)}}" />
                                                @endif
                                            </div>
                                            <div class="product-info">
                                                <div class="product-name">{{stripslashes($item->product_name)}}</div>
                                                <div class="product-price">
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
                                                <div class="ibuy" dataid="3"><i></i>Mua hàng</div>
                                            </a>
                                        </a>
                                    </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    jQuery(document).ready(function() {
        jQuery('#gallery').magnificPopup({
            delegate: 'a',
            type: 'image',
            tLoading: 'Tải ảnh...',
            mainClass: 'mfp-img-mobile',
            gallery: {
                enabled: true,
                navigateByImgClick: true,
                preload: [0,1],
            },
            image: {
                tError: 'không thể tải ảnh!',
                titleSrc: function(item) {
                    return item.el.attr('title') + '<small>{{CGlobal::web_name}}</small>';
                }
            }
        });
    });
</script>