<div class="container">
	<div class="post-page">
		<div class="col-lg-8 col-md-8 col-sm-12 content-post-line">
			<h1 class="title-head cat">
				<a href="{{FunctionLib::buildLinkCategory($arrCat->category_id, $arrCat->category_name)}}" title="{{$arrCat->category_name}}">{{$arrCat->category_name}}</a>
			</h1>
			@if(isset($arrItem) && sizeof($arrItem) > 0)
				@if(count($arrItem) > 1)
				<div class="list-item-post">
					@foreach($arrItem as $item)
					<div class="item-post ">
						<a class="post-title" title="{{$item['news_title']}}" href="{{FunctionLib::buildLinkDetailNews($item['news_category_name'], $item['news_title'], $item['news_id'])}}">
							@if($item['news_image'] != '')
							<div class="col-lg-3 col-md-3 col-sm-12">
								<div class="row">
									<div class="post-img">
										<img alt="{{$item['news_title']}}" src="{{ThumbImg::getImageThumb(CGlobal::FOLDER_NEWS, $item['news_id'], $item['news_image'], CGlobal::sizeImage_500)}}">
										<div class="post-format">
											<i class="fa fa-file-text"></i>
										</div>
									</div>
								</div>
							</div>
							@endif
							<div class="col-lg-9 col-md-9 col-sm-9 line-post-data">
								<div class="post-data">
									<h2 class="post-title">{{stripslashes($item['news_title'])}}</h2>
									<div class="date">
										<i class="icon-date"></i>
										{{date('h:i', $item['news_create'])}} ngày {{date('d/m/Y', $item['news_create'])}}
									</div>
									<div class="post-content">
										@if($item['news_intro'] != '')
											{{FunctionLib::substring(stripslashes($item['news_intro']), 300, '...') }}
										@else
											{{FunctionLib::substring(stripslashes($item['news_content']), 300, '...') }}
										@endif
									</div>
									<div class="redmore">Xem thêm</div>
								</div>
							</div>
						</a>
					</div>
					@endforeach
					<div class="show-box-paging">{{$paging}}</div>
				</div>
				@else

				@endif
			@endif
		</div>
		<div class="col-lg-4 col-md-4 col-sm-12 box-right">
			<div class="title-box-right"><a title="Giới thiệu" href="http://vinasugar1.com.vn/gioi-thieu-564.html">Giới thiệu</a></div>
			<ul class="post-in-cat">
				<li><i class="fa fa-angle-right"></i> <a title="Văn phòng tổng công ty" href="http://vinasugar1.com.vn/tin-tuc/van-phong-tong-cong-ty-503.html">Văn phòng tổng công ty</a></li>
				<li><i class="fa fa-angle-right"></i> <a title="Giới thiệu chung" href="http://vinasugar1.com.vn/tin-tuc/gioi-thieu-chung-496.html">Giới thiệu chung</a></li>
				<li><i class="fa fa-angle-right"></i> <a title="Thông điệp lãnh đạo" href="http://vinasugar1.com.vn/tin-tuc/thong-diep-lanh-dao-497.html">Thông điệp lãnh đạo</a></li>
			</ul>
			<div class="item-box-right">
				<div class="title-box-right">Tin nổi bật</div>
				<ul class="ul-post">
					<li>
						<div class="img-thumb-right">
							<a title="Giá USD giảm mạnh, xuống thấp nhất gần 2 tháng" href="http://vinasugar1.com.vn/tin-tuc/gia-usd-giam-manh-xuong-thap-nhat-gan-2-thang-532.html">
								<img alt="Giá USD giảm mạnh, xuống thấp nhất gần 2 tháng" src="http://vinasugar1.com.vn/uploads/thumbs/news/532/400x400/01-55-06-04-04-2017-usd-19-12.jpg">
							</a>
						</div>
						<div class="intro-right">
							<div class="title-right"><a href="http://vinasugar1.com.vn/tin-tuc/gia-usd-giam-manh-xuong-thap-nhat-gan-2-thang-532.html">Giá USD giảm mạnh, xuống thấp nhất gần 2 tháng</a></div>
						</div>
					</li>
					<li>
						<div class="img-thumb-right">
							<a title="Bia rượu " href="http://vinasugar1.com.vn/tin-tuc/bia-ruou-531.html">
								<img alt="Bia rượu " src="http://vinasugar1.com.vn/uploads/thumbs/news/531/400x400/05-25-30-03-04-2017-bia-viger.jpg">
							</a>
						</div>
						<div class="intro-right">
							<div class="title-right"><a href="http://vinasugar1.com.vn/tin-tuc/bia-ruou-531.html">Bia rượu </a></div>
						</div>
					</li>
					<li>
						<div class="img-thumb-right">
							<a title="Sản phẩm Đường" href="http://vinasugar1.com.vn/tin-tuc/san-pham-duong-530.html">
								<img alt="Sản phẩm Đường" src="http://vinasugar1.com.vn/uploads/thumbs/news/530/400x400/10-44-29-03-04-2017-img0382.jpg">
							</a>
						</div>
						<div class="intro-right">
							<div class="title-right"><a href="http://vinasugar1.com.vn/tin-tuc/san-pham-duong-530.html">Sản phẩm Đường</a></div>
						</div>
					</li>
					<li>
						<div class="img-thumb-right">
							<a title="Các sản phẩm tiêu biểu " href="http://vinasugar1.com.vn/tin-tuc/cac-san-pham-tieu-bieu-529.html">
								<img alt="Các sản phẩm tiêu biểu " src="http://vinasugar1.com.vn/uploads/thumbs/news/529/400x400/03-53-46-31-03-2017-haichau1.jpg">
							</a>
						</div>
						<div class="intro-right">
							<div class="title-right"><a href="http://vinasugar1.com.vn/tin-tuc/cac-san-pham-tieu-bieu-529.html">Các sản phẩm tiêu biểu </a></div>
						</div>
					</li>
					<li>
						<div class="img-thumb-right">
							<a title="Các sản phẩm Nước trái cây" href="http://vinasugar1.com.vn/tin-tuc/cac-san-pham-nuoc-trai-cay-528.html">
								<img alt="Các sản phẩm Nước trái cây" src="http://vinasugar1.com.vn/uploads/thumbs/news/528/400x400/02-23-34-31-03-2017-traicay3.jpg">
							</a>
						</div>
						<div class="intro-right">
							<div class="title-right"><a href="http://vinasugar1.com.vn/tin-tuc/cac-san-pham-nuoc-trai-cay-528.html">Các sản phẩm Nước trái cây</a></div>
						</div>
					</li>
				</ul>
			</div>
			<div class="item-box-right extbg">
				<div class="title-box-right">Hỗ trợ trực tuyến</div>
				<div class="item-support">
					<div class="name-support">Phòng kinh doanh</div>
					<div class="phone-support">(04) 3862-4057</div>
				</div>
				<div class="item-support">
					<div class="name-support">Phòng hành chính</div>
					<div class="phone-support">(04) 3862-4057</div>
				</div>
			</div>
		</div>
	</div>
</div>