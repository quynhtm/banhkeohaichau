<div class="line-middle">
    <div class="container">
        <div class="wrapp-line-bottom-head">
            <div class="line-bottom-head second">
            <div class="box-list-category">
                <ul>
                    <li><a href="">Bánh hộp tết</a></li>
                    <li><a href="">Bánh trung thu</a></li>
                    <li><a href="">Bánh Kem xốp</a></li>
                    <li>
                        <a href="">Bánh Quy và cookies <i class="fa fa-angle-down"></i></a>
                        <ul class="sub">
                            <li><a href="">Bánh Quy</a></li>
                            <li><a href="">Cookies</a></li>
                        </ul>
                    </li>
                    <li><a href="">Bột canh và Hạt nêm</a></li>
                    <li><a href="">Lương Khô</a></li>
                    <li><a href="">Kẹo hộp</a></li>
                    <li><a href="">Kẹo cứng</a></li>
                    <li><a href="">Kẹo mềm</a></li>
                    <li><a href="">Kẹo dẻo</a></li>
                    <li><a href="">Đường - sữa</a></li>
                    <li><a href="">Sản phẩm khác</a></li>
                </ul>
                <div class="link-last"><a href="">Xem tất cả</a></div>
            </div>
            <div class="box-right-bottom-head">
                <div class="line-top-head">
                    @if(sizeof($arrBannerSlider) > 0)
                    <div class="box-slider-banner">
                        <?php $rands = array('cube', 'cubeRandom', 'block', 'cubeStop', 'showBars', 'horizontal', 'fadeFour', 'paralell', 'blind', 'directionTop', 'directionBottom', 'directionRight'); ?>
                        <div class="skitter-large-box">
                            <div class="skitter skitter-large _sliders">
                                <ul>
                                    @foreach($arrBannerSlider as $item)
                                        @if($item->banner_image != '')
                                            <?php $rand_item = $rands[array_rand($rands, 1)]; ?>
                                            <li>
                                                <a href="#{{$rand_item}}" @if($item->banner_is_rel == CGlobal::LINK_NOFOLLOW) rel="nofollow" @endif title="{{$item->banner_name}}">
                                                    <img class="{{$rand_item}}" src="{{ThumbImg::thumbImageBannerNormal($item->banner_id,$item->banner_parent_id, $item->banner_image, CGlobal::sizeImage_1000,CGlobal::sizeImage_200, $item->banner_name,true,true)}}" alt="{{$item->banner_name}}" />
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <script type="text/javascript" language="javascript">
                        $(document).ready(function() {
                            $('._sliders').skitter({
                                numbers: false,
                                dots: true
                            });
                        });
                    </script>
                    @endif
                    @if(sizeof($arrBannerSubRight) > 0)
                    <div class="box-sub-banner">
                        @foreach($arrBannerSubRight as $item)
                        <div class="item-sub-banner">
                            <a href="{{$item->banner_link}}" @if($item->banner_is_rel == CGlobal::LINK_NOFOLLOW) rel="nofollow" @endif title="{{$item->banner_name}}">
                                <img src="{{ThumbImg::thumbImageBannerNormal($item->banner_id,$item->banner_parent_id, $item->banner_image, CGlobal::sizeImage_300,CGlobal::sizeImage_300, $item->banner_name,true,true)}}" alt="{{$item->banner_name}}" />
                            </a>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
				<div class="line-sologan-content ">
					<div class="line-sologan">
						<div class="col-xs-12 col-md-3">
							<div class="bg-icon icon1">
								<span class="text1">Sản phẩm</span><br>
								<span class="text2">Chất lượng</span>
							</div>
						</div>
						<div class="col-xs-12 col-md-3">
							<div class="bg-icon icon2">
								<span class="text1">Phục vụ</span><br>
								<span class="text2">chu đáo</span>
							</div>
						</div>
						<div class="col-xs-12 col-md-3">
							<div class="bg-icon icon4">
								<span class="text1">Thủ tục</span><br>
								<span class="text2">Nhanh gọn</span>
							</div>
						</div>
						<div class="col-xs-12 col-md-3">
							<div class="bg-icon icon3">
								<span class="text1">Giao hàng</span><br>
								<span class="text2">Nhanh chóng</span>
							</div>
						</div>
					</div>
				</div>
            </div>
        </div>
        </div>
    </div>
</div>