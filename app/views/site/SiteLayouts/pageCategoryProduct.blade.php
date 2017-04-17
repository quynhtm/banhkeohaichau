<div class="container">
	<div class="post-page">
		<div class="content-post-line-product">
			@if(sizeof($arrCat) > 0)
			<h1 class="title-head cat">
				<a href="{{FunctionLib::buildLinkCategory($arrCat->category_id, $arrCat->category_name)}}" title="{{$arrCat->category_name}}">{{$arrCat->category_name}}</a>
			</h1>
			@endif
			@if(sizeof($arrItem) > 0)
			<div class="box-list-item">
				@if(sizeof($arrItem) > 0)
					@foreach($arrItem as $item)
						<div class="one-item">
							<a href="{{FunctionLib::buildLinkDetailProduct($item->product_id, $item->product_name)}}" title="{{stripslashes($item->product_name)}}">
								<div class="ithumb">
									@if($item->product_image != '')
										<img src="{{ThumbImg::getImageThumb(CGlobal::FOLDER_PRODUCT, $item->product_id, $item->product_image, CGlobal::sizeImage_600, '', true, 1, false)}}" alt="{{stripslashes($item->product_name)}}" />
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
							</a>
							<a href="{{FunctionLib::buildLinkDetailProduct($item->product_id, $item->product_name)}}" title="{{stripslashes($item->product_name)}}">
								<div class="ibuy" dataid="{{$item->product_id}}"><i></i>Mua hàng</div>
							</a>
						</div>
					@endforeach
				@endif
			</div>
			<div class="show-box-paging">{{$paging}}</div>
			@endif
		</div>
	</div>
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