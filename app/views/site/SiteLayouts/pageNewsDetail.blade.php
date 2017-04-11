<div class="container">
    <div class="post-page">
        <div class="col-lg-8 col-md-8 col-sm-12 content-post-line">
            @if(sizeof($data) != 0)
                <div class="article-main">
                    <h1 class="title-view">{{$data->news_title}}</h1>
                    <h2 class="title-head">
                        <i class="fa fa-pencil"> </i><span class="date-post">({{date('d/m/Y', $data->news_create)}})</span>
                        <a class="title-cate" title="{{$data->news_category_name}}" href="{{FunctionLib::buildLinkCategory($data->news_category, $data->news_category_name)}}">{{$data->news_category_name}}</a>

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
                                <div class="fb-like" data-href="{{FunctionLib::buildLinkCategory($data->news_category, $data->news_category_name)}}" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true"></div>
                            </div>
                        </div>

                    </h2>
                    <div class="view-item-post">
                        @if($data->news_desc_sort != '')
                            <div class="intro-view">{{stripslashes($data->news_desc_sort)}}</div>
                        @endif
                        @if($data->news_desc_sort != '')
                        <div class="content-view">{{stripslashes($data->news_content)}}</div>
                        @endif
                    </div>

                    @if(sizeof($newsSame) != 0)
                        <div class="same-content-news">
                            <div class="same-title">Bài viết khác:</div>
                            <ul>
                                @foreach($newsSame as $item)
                                    <li>
                                        <i class="fa fa-angle-right"></i> <a title="{{$item['news_title']}}" href="{{FunctionLib::buildLinkDetailNews($item['news_category_name'], $item['news_title'], $item['news_id'])}}">{{$item['news_title']}}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
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