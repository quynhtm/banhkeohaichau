<div class="container">
	<div class="post-page">
		<div class="col-lg-12 col-md-2 col-sm-12 content-post-line-product">
			<h1 class="title-head cat">
				@if(sizeof($type) > 0)
				<a href="{{FunctionLib::buildLinkTypeProduct($type->department_id, $type->department_name)}}" title="{{stripslashes($type->department_name)}}">{{stripslashes($type->department_name)}}</a>
				@endif
			</h1>
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
								<div class="ibuy" dataid="{{$item->product_id}}"><i></i>Mua hàng</div>
							</div>
						@endforeach
					@endif
				</div>
				<div class="show-box-paging">{{$paging}}</div>
			@endif
		</div>
	</div>
</div>