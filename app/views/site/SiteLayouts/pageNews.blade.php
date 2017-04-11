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
					@foreach($arrItem as $item)
						<h1 class="title-view">{{$item->news_title}}</h1>
						<div class="date"><i class="icon-other icon-date"></i>{{date('h:i', $item['news_create'])}} ngày {{date('d/m/Y', $item['news_create'])}}</div>
						@if($item->news_desc_sort != '')
							<div class="library-intro">
								<b>{{stripslashes($item['news_desc_sort'])}}</b>
							</div>
						@endif
						@if($item->news_content != '')
							<div class="library-intro">
								{{stripslashes($item['news_content'])}}
							</div>
						@endif
					@endforeach
				@endif
			@endif
		</div>
		<div class="col-lg-4 col-md-4 col-sm-12 box-right">
			@if(sizeof($arrCatRight) > 0)
			@foreach($arrCatRight as $item)
				<?php $arrItems = BaseSiteController::getPostInCategoryId($item['category_id'], $limit=10); ?>
				@if(sizeof($arrItems) > 0)
				<div class="item-box-right">
					<div class="title-box-right"><a title="{{$item['category_name']}}" href="{{FunctionLib::buildLinkCategory($item['category_id'], $item['category_name'])}}">{{$item['category_name']}}</a></div>
					<ul class="post-in-cat">
						@foreach($arrItems as $post)
						<li>
							<a title="{{$post['news_title']}}" href="{{FunctionLib::buildLinkDetailNews($post['news_category_name'], $post['news_title'], $post['news_id'])}}">{{stripslashes($post['news_title'])}}</a>
						</li>
						@endforeach
					</ul>
				</div>
				@endif
			@endforeach
			@endif
			@if(sizeof($arrNewsHot) > 0)
			<div class="item-box-right">
				<div class="title-box-right">Tin nổi bật</div>
				<ul class="ul-post">
					@foreach($arrNewsHot as $item)
					<li>
						@if($item['news_image'] != '')
						<div class="img-thumb-right">
							<a title="{{$item['news_title']}}" href="{{FunctionLib::buildLinkDetailNews($item['news_category_name'], $item['news_title'], $item['news_id'])}}">
								<img alt="{{$item['news_title']}}" src="{{ThumbImg::getImageThumb(CGlobal::FOLDER_NEWS, $item['news_id'], $item['news_image'], CGlobal::sizeImage_500)}}">
							</a>
						</div>
						@endif
						<div class="intro-right">
							<div class="title-right">
								<a title="{{$item['news_title']}}" href="{{FunctionLib::buildLinkDetailNews($item['news_category_name'], $item['news_title'], $item['news_id'])}}">{{stripslashes($item['news_title'])}}</a>
							</div>
						</div>
					</li>
					@endforeach
				</ul>
			</div>
			@endif
		</div>
	</div>
</div>