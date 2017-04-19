<div class="line-consult">
    <div class="container mb">
        <div class="row">
            <div class="col-lg-9 col-md-9 col-sm-12">
                @if(sizeof($data_yKien_khachHang) > 0)
                    @if(isset($data_yKien_khachHang['cat']))
                    <div class="title-customer-post"><a @if(isset($data_yKien_khachHang['cat']['category_id']) && $data_yKien_khachHang['cat']['category_id'] > 0) href="{{FunctionLib::buildLinkCategory($data_yKien_khachHang['cat']['category_id'], $data_yKien_khachHang['cat']['category_name'])}}" @endif title="{{$data_yKien_khachHang['cat']['category_name']}}">{{$data_yKien_khachHang['cat']['category_name']}}</a></div>
                    @endif
                    <div class="box-customer-post">
                        @if(isset($data_yKien_khachHang['post']))
                            @foreach($data_yKien_khachHang['post'] as $k=>$item)
                            <div class="col-lg-4 col-md-4 col-sm-12 item-customer">
                                @if($item['news_image'] != '')
                                <div class="cthumb">
                                    <img alt="{{$item['news_title']}}" src="{{ThumbImg::getImageThumb(CGlobal::FOLDER_NEWS, $item['news_id'], $item['news_image'], CGlobal::sizeImage_500)}}">
                                </div>
                                @endif
                                <div class="cdesc">
                                    <div class="cname">
                                        <a class="post-title" title="{{$item['news_title']}}" href="{{FunctionLib::buildLinkDetailNews($item['news_category_name'], $item['news_title'], $item['news_id'])}}">{{stripslashes($item['news_title'])}}</a>
                                    </div>
                                    <div class="caddress">{{stripslashes($item['new_infor_other'])}}</div>
                                    <div class="csay">
                                       <i class="bg"></i>
                                       @if($item['news_intro'] != '')
                                            {{FunctionLib::substring(stripslashes($item['news_intro']), 300, '...') }}
                                       @else
                                            {{FunctionLib::substring(stripslashes($item['news_content']), 300, '...') }}
                                       @endif
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @endif
                        <div class="line-line-support">
                            <div class="txt-line-support"></div>
                        </div>
                        <div class="text-support">
                            HÃY GỌI CHO CHÚNG TÔI ĐỂ ĐƯỢC TƯ VẤN MIỄN PHÍ
                        </div>
                        <div class="text-phone-support">
                            <div class="wrap-text-phone-support">
                                Hotline: <span>{{$hotline}}</span>
                                <i class="bg"></i>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 post-consult-right">
                @if(sizeof($arrNewsHot) > 0)
                <div class="title-customer-post ext">Tin tức nổi bật</div>
                <div class="box-customer-post">
                    <ul class="ul-post index">
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
                    <div class="link-last-consult"><a href="{{URL::route('site.home')}}/tin-tuc-33.html">Xem tất cả</a></div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>