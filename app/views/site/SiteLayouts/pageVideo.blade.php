<div class="container">
	<div class="post-page">
		<div class="col-lg-8 col-md-8 col-sm-12 content-post-line">
			<h1 class="title-head cat">
				<a href="{{URL::route('site.pageVideo')}}" title="Video">Video</a>
			</h1>
			<div class="list-item-post row">
			@if(isset($arrItem) && sizeof($arrItem) > 0)
				@foreach($arrItem as $k=>$item)
					<div class="col-lg-6 col-sm-6 item-video">
						<a title="{{stripslashes($item->video_name)}}" href="{{FunctionLib::buildLinkDetailVideo($item->video_name, $item->video_id)}}">
							<div>
								<?php
								$_video = str_replace('https://www.youtube.com/watch?v=', 'https://www.youtube.com/embed/', $item->video_link);
								$embed = '<iframe width="100%" height="250" src="'.$_video.'?rel=0" frameborder="0" allowfullscreen></iframe>';
								echo $embed;
								?>
							</div>
							<div class="titleL">{{stripslashes($item->video_name)}}</div>
						</a>
					</div>
				@endforeach
				<div class="show-box-paging">{{$paging}}</div>
			@else
				<div class="update">Đang cập nhật...</div>
			@endif
			</div>
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