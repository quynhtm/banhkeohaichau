<?php
class SiteHomeController extends BaseSiteController{
    public function __construct(){
        parent::__construct();
    }

	//Trang chu
    public function index(){

        FunctionLib::site_css('lib/fancybox/jquery.fancybox.css', CGlobal::$POS_HEAD);
        FunctionLib::site_js('lib/fancybox/jquery.fancybox.min.js', CGlobal::$POS_END);

    	//Meta title
    	$meta_title='';
    	$meta_keywords='';
    	$meta_description='';
    	$meta_img='';
    	$arrMeta = Info::getItemByKeyword('SITE_SEO_HOME');
    	if(!empty($arrMeta)){
    		$meta_title = $arrMeta->meta_title;
    		$meta_keywords = $arrMeta->meta_keywords;
    		$meta_description = $arrMeta->meta_description;
    		$meta_img = $arrMeta->info_img;
    		if($meta_img != ''){
    			$meta_img = ThumbImg::thumbBaseNormal(CGlobal::FOLDER_INFO, $arrMeta->info_id, $arrMeta->info_img, 550, 0, '', true, true);
    		}
    	}
    	FunctionLib::SEO($meta_img, $meta_title, $meta_keywords, $meta_description);
        //Get Chuyen mục: banh, kẹo, luong kho...
        $arrType = Department::siteGetAllDepart();
        $arrAllCategoryProduct = Category::getAllCategoryByType(CGlobal::category_product);

    	$this->header();
    	$this->middle();
    	$this->consult();
        $this->layout->content = View::make('site.SiteLayouts.Home')
                                ->with('arrType', $arrType)
                                ->with('arrAllCategoryProduct', $arrAllCategoryProduct);
        $this->footer();
    }
    public function actionRouter($catname, $catid){
        if($catid > 0 && $catname != ''){
            $arrCat = Category::getById($catid);
            if(sizeof($arrCat) > 0){
                $typeId = $arrCat->category_type;
                if($typeId == CGlobal::category_product){
                    return self::pageCategoryProduct($catname, $catid);
                }elseif($typeId == CGlobal::category_new){
                    return self::pageCategoryNews($catname, $catid);
                }
            }else{
                return Redirect::route('site.page404');
            }
        }else{
            return Redirect::route('site.page404');
        }
    }
    public function actionTypeProduct($type_name='', $type_id=0){
        FunctionLib::site_css('lib/fancybox/jquery.fancybox.css', CGlobal::$POS_HEAD);
        FunctionLib::site_js('lib/fancybox/jquery.fancybox.min.js', CGlobal::$POS_END);
        $arrCat = array(
            'category_id'=>0,
            'category_name'=>'',
        );
        $type = $arrItem = array();
        $paging = '';
        $meta_title = $meta_keywords = $meta_description = CGlobal::web_name;
        $meta_img = '';
        if($type_id > 0){
            $type = Department::getByID($type_id);
            if(sizeof($type) > 0){
                $meta_title = stripslashes($type->department_name);
                $meta_keywords = stripslashes($type->department_name);
                $meta_description = stripslashes($type->department_name);
            }

            $pageNo = (int) Request::get('page_no',1);
            $limit = CGlobal::number_show_20;
            $offset = ($pageNo - 1) * $limit;
            $search = $data = array();
            $total = 0;

            $search['category_name'] = strtolower(FunctionLib::safe_title($type->department_name));
            $search['depart_id'] = (int)$type_id;
            $arrItem = Product::searchByConditionSite($search, $limit, $offset,$total);
            $paging = $total > 0 ? Pagging::getNewPager(3, $pageNo, $total, $limit, $search) : '';
        }
        FunctionLib::SEO($meta_img, $meta_title, $meta_keywords, $meta_description);

        $this->header(0);
        $this->layout->content = View::make('site.SiteLayouts.pageTypeProduct')
                                ->with('type', $type)
                                ->with('arrItem', $arrItem)
                                ->with('arrCat', $arrCat)
                                ->with('paging', $paging);
        $this->consult();
        $this->footer();
    }
    public function pageCategoryProduct($catname='', $caid=0){
        FunctionLib::site_css('lib/fancybox/jquery.fancybox.css', CGlobal::$POS_HEAD);
        FunctionLib::site_js('lib/fancybox/jquery.fancybox.min.js', CGlobal::$POS_END);
        $arrCat = array(
            'category_id'=>0,
            'category_name'=>'',
        );
        $arrItem = array();
        $paging = '';
        $meta_title = $meta_keywords = $meta_description = CGlobal::web_name;
        $meta_img = '';

        if($caid > 0){
            $arrCat = Category::getByID($caid);
            if(sizeof($arrCat) > 0){
                $meta_title = stripslashes($arrCat->category_name);
                $meta_keywords = stripslashes($arrCat->category_meta_keywords);
                $meta_description = stripslashes($arrCat->category_meta_description);
            }

            $pageNo = (int) Request::get('page_no',1);
            $limit = CGlobal::number_show_20;
            $offset = ($pageNo - 1) * $limit;
            $search = $data = array();
            $total = 0;

            $search['category_name'] = $catname;
            $search['category_id'] = (int)$caid;

            $arrItem = Product::searchByConditionSite($search, $limit, $offset,$total);
            $paging = $total > 0 ? Pagging::getNewPager(3, $pageNo, $total, $limit, $search) : '';

        }
        FunctionLib::SEO($meta_img, $meta_title, $meta_keywords, $meta_description);

        $this->header($caid);
        $this->layout->content = View::make('site.SiteLayouts.pageCategoryProduct')
            ->with('arrItem', $arrItem)
            ->with('arrCat', $arrCat)
            ->with('paging', $paging);
        $this->consult();
        $this->footer();
    }
    public function pageDetailProduct($title='', $id=0){

        FunctionLib::site_css('lib/slickslider/slick.css', CGlobal::$POS_HEAD);
        FunctionLib::site_js('lib/slickslider/slick.min.js', CGlobal::$POS_END);

        FunctionLib::site_css('lib/slidermagnific/magnific-popup.css', CGlobal::$POS_HEAD);
        FunctionLib::site_js('lib/slidermagnific/magnific-popup.min.js', CGlobal::$POS_END);

        $item = array();
        $arrCat = array();
        $meta_title = $meta_keywords = $meta_description = '';
        $meta_img = '';
        $newsSame = array();
        $catid = 0;

        if($id > 0){
            $item = Product::getProductByID($id);
            if(sizeof($item) > 0){
                $arrCat = Category::getByID($item->category_id);
                if(sizeof($arrCat) > 0){
                    $catid = $arrCat->category_id;
                }
                $meta_title = stripslashes($item->product_name);
                $meta_keywords = stripslashes($item->product_name);
                $meta_description = stripslashes($item->product_sort_desc);
                $productSame = Product::getSameProduct(array(), $item->category_id, $item->product_id, CGlobal::number_show_20, 0);
            }
        }
        FunctionLib::SEO($meta_img, $meta_title, $meta_keywords, $meta_description);

        $guide = '';
        $arrGuide = Info::getItemByKeyword('SITE_GUIDE_BUY');
        if(sizeof($arrGuide) > 0){
            $guide = stripslashes($arrGuide->info_content);
        }

        $dataProductHot = Product::getProductHotRandom($id, CGlobal::number_show_5);

        $this->header($catid);
        $this->layout->content = View::make('site.SiteLayouts.pageProductDetail')
            ->with('data', $item)
            ->with('arrCat', $arrCat)
            ->with('productSame', $productSame)
            ->with('guide', $guide)
            ->with('dataProductHot', $dataProductHot);
        $this->footer();
    }
    public function pageSearchProduct(){
        $keyword = addslashes(Request::get('keyword',''));

        $arrItem = array();
        $paging = '';
        $meta_title = $meta_keywords = $meta_description = 'Tìm kiếm '.CGlobal::web_name;
        $meta_img = '';

        if($keyword != ''){
            FunctionLib::site_css('lib/fancybox/jquery.fancybox.css', CGlobal::$POS_HEAD);
            FunctionLib::site_js('lib/fancybox/jquery.fancybox.min.js', CGlobal::$POS_END);

            $pageNo = (int) Request::get('page_no',1);
            $limit = CGlobal::number_show_20;
            $offset = ($pageNo - 1) * $limit;
            $search = $data = array();
            $total = 0;

            $search['product_name'] = $keyword;
            $arrItem = Product::searchByConditionSite($search, $limit, $offset,$total);
            $paging = $total > 0 ? Pagging::getNewPager(3, $pageNo, $total, $limit, $search) : '';
        }
        FunctionLib::SEO($meta_img, $meta_title, $meta_keywords, $meta_description);

        $this->header(0);
        $this->layout->content = View::make('site.SiteLayouts.pageSearchProduct')
            ->with('arrItem', $arrItem)
            ->with('paging', $paging);
        $this->consult();
        $this->footer();
    }
	public function pageCategoryNews($catname='', $caid=0){
        $arrCat = array(
            'category_id'=>0,
            'category_name'=>'',
        );
        $arrItem = array();
        $paging = '';
        $meta_title = $meta_keywords = $meta_description = CGlobal::web_name;
        $meta_img = '';

        if($caid > 0){
            $arrCat = Category::getByID($caid);
            if(sizeof($arrCat) > 0){
                $meta_title = stripslashes($arrCat->category_name);
                $meta_keywords = stripslashes($arrCat->category_meta_keywords);
                $meta_description = stripslashes($arrCat->category_meta_description);
            }

            $pageNo = (int) Request::get('page_no',1);
            $limit = CGlobal::number_show_20;
            $offset = ($pageNo - 1) * $limit;
            $search = $data = array();
            $total = 0;
            $search['news_category_name'] = $catname;
            $search['news_category_id'] = (int)$caid;
            $arrItem = News::searchByConditionSite($search, $limit, $offset,$total);
            $paging = $total > 0 ? Pagging::getNewPager(3, $pageNo, $total, $limit, $search) : '';
        }
        FunctionLib::SEO($meta_img, $meta_title, $meta_keywords, $meta_description);

        //Get Menu category News Right
        $searchCateRight['category_menu_right'] = CGlobal::status_show;
        $searchCateRight['category_type'] = CGlobal::category_new;
        $arrCatRight = Category::searchCategoryRightByCondition($searchCateRight, CGlobal::number_show_5);

        //Get news Hot
        $dataNewsSearch['news_hot'] = CGlobal::status_show;
        $arrNewsHot = News::getPostHot($dataNewsSearch, 10);

        $this->header($caid);
        $this->layout->content = View::make('site.SiteLayouts.pageNews')
                                ->with('arrItem', $arrItem)
                                ->with('arrCat', $arrCat)
                                ->with('paging', $paging)
                                ->with('arrNewsHot', $arrNewsHot)
                                ->with('arrCatRight', $arrCatRight);
        $this->footer();
	}
    public function pageDetailNews($catname='', $title='', $id=0){
        $item = array();
        $arrCat = array();
        $meta_title = $meta_keywords = $meta_description = '';
        $meta_img = '';
        $newsSame = array();
        $catid = 0;

        if($id > 0){
            $item = News::getNewByID($id);
            if(sizeof($item) > 0){
                $arrCat = Category::getByID($item->news_category);
                if(sizeof($arrCat) > 0){
                    $catid = $arrCat->category_id;
                }
                $meta_title = stripslashes($item->news_title);
                $meta_keywords = stripslashes($item->news_title);
                $meta_description = stripslashes($item->news_desc_sort);
                $newsSame = News::getSameNews($dataField='', $item->news_category, $item->news_id, CGlobal::number_show_15, 0);
            }
        }
        FunctionLib::SEO($meta_img, $meta_title, $meta_keywords, $meta_description);


        //Get Menu category News Right
        $searchCateRight['category_menu_right'] = CGlobal::status_show;
        $searchCateRight['category_type'] = CGlobal::category_new;
        $arrCatRight = Category::searchCategoryRightByCondition($searchCateRight, CGlobal::number_show_5);

        //Get news Hot
        $dataNewsSearch['news_hot'] = CGlobal::status_show;
        $arrNewsHot = News::getPostHot($dataNewsSearch, 10);

        $this->header($catid);
        $this->layout->content = View::make('site.SiteLayouts.pageNewsDetail')
            ->with('data', $item)
            ->with('arrCat', $arrCat)
            ->with('newsSame', $newsSame)
            ->with('arrNewsHot', $arrNewsHot)
            ->with('arrCatRight', $arrCatRight);
        $this->footer();
    }
    public function pageContact(){
        //Meta title
        $meta_title='';
        $meta_keywords='';
        $meta_description='';
        $meta_img='';
        $info = '';
        $arrInfo = Info::getItemByKeyword('SITE_INFO_CONTACT');
        if(!empty($arrInfo)){
            $info = stripslashes($arrInfo->info_content);
            $meta_title = $arrInfo->meta_title;
            $meta_keywords = $arrInfo->meta_keywords;
            $meta_description = $arrInfo->meta_description;
            $meta_img = $arrInfo->info_img;
            if($meta_img != ''){
                $meta_img = ThumbImg::thumbBaseNormal(CGlobal::FOLDER_INFO, $arrInfo->info_id, $arrInfo->info_img, 550, 0, '', true, true);
            }
        }
        FunctionLib::SEO($meta_img, $meta_title, $meta_keywords, $meta_description);

        $messages = FunctionLib::messages('messages');
        if(!empty($_POST)){
            $token = Request::get('_token', '');
            if(Session::token() === $token){
                $contact_name = addslashes(Request::get('txtName', ''));
                $contact_phone = addslashes(Request::get('txtMobile', ''));
                $contact_email = addslashes(Request::get('txtEmail', ''));
                $contact_content = addslashes(Request::get('txtMessage', ''));
                $get_code = addslashes(Request::get('captcha', ''));
                $contact_created = time();
                $code = '';
                if(Session::has('security_code')){
                    $code = Session::get('security_code');
                }
                if($contact_name != '' && $contact_phone !=''  && $contact_content !='' && $get_code != '' && $code == $get_code){
                    $dataInput = array(
                        'contact_user_name_send'=>$contact_name,
                        'contact_phone_send'=>$contact_phone,
                        'contact_email_send'=>$contact_email,
                        'contact_title'=>$contact_name,
                        'contact_content'=>$contact_content,
                        'contact_time_creater'=>$contact_created,
                        'contact_status'=>0,
                    );
                    $query = Contact::addData($dataInput);
                    if($query > 0){
                        $messages = FunctionLib::messages('messages', 'Cảm ơn bạn đã gửi thông tin liên hệ. Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất!');
                        return Redirect::route('site.pageContact');
                    }
                }else{
                    $messages = FunctionLib::messages('messages', 'Mã xác nhận chưa đúng!', 'error');
                    return Redirect::route('site.pageContact');
                }

            }
        }

        $this->header();
        $this->layout->content = View::make('site.SiteLayouts.pageContact')
                                ->with('info', $info)
                                ->with('arrInfo', $arrInfo)
                                ->with('messages', $messages);
        $this->footer();
    }
	public function linkCaptcha(){
		$captchaImages = new captchaImages(60,30,4);
	}
	function captchaCheckAjax(){
		$code = '';
		if(Session::has('security_code')){
			$code = Session::get('security_code');
		}
		$get_code = addslashes(Request::get('captcha', ''));
		if($get_code != '' && $code == $get_code){
			echo 1;
		}else{
			echo 0;
			Session::forget('security_code');
		}
		exit();
	}
	public function pageCareCustomer(){

        $meta_title = $meta_keywords = $meta_description = 'Chăm sóc khách hàng';
        $meta_img = '';

        $arrCareCustomer = Info::getItemByKeyword('SITE_CARE_CUSTOMER');
        if(sizeof($arrCareCustomer) > 0){
            $meta_title = stripslashes($arrCareCustomer->meta_title);
            $meta_keywords = stripslashes($arrCareCustomer->meta_keywords);
            $meta_description = stripslashes($arrCareCustomer->meta_description);
            $meta_img = $arrCareCustomer->info_img;
            if($meta_img != ''){
                $meta_img = ThumbImg::thumbBaseNormal(CGlobal::FOLDER_INFO, $arrCareCustomer->info_id, $arrCareCustomer->info_img, 550, 0, '', true, true);
            }
        }

        FunctionLib::SEO($meta_img, $meta_title, $meta_keywords, $meta_description);

        //Get Menu category News Right
        $searchCateRight['category_menu_right'] = CGlobal::status_show;
        $searchCateRight['category_type'] = CGlobal::category_new;
        $arrCatRight = Category::searchCategoryRightByCondition($searchCateRight, CGlobal::number_show_5);

        //Get news Hot
        $dataNewsSearch['news_hot'] = CGlobal::status_show;
        $arrNewsHot = News::getPostHot($dataNewsSearch, 10);

        $this->header();
        $this->layout->content = View::make('site.SiteLayouts.pageCareCustomer')
            ->with('data', $arrCareCustomer)
            ->with('arrNewsHot', $arrNewsHot)
            ->with('arrCatRight', $arrCatRight);
        $this->footer();
    }
    public function pageVideo(){

        //Meta title
        $meta_title='';
        $meta_keywords='';
        $meta_description='';
        $meta_img='';
        $arrMeta = Info::getItemByKeyword('SITE_SEO_VIDEO');
        if(!empty($arrMeta)){
            $meta_title = $arrMeta->meta_title;
            $meta_keywords = $arrMeta->meta_keywords;
            $meta_description = $arrMeta->meta_description;
            $meta_img = $arrMeta->info_img;
            if($meta_img != ''){
                $meta_img = ThumbImg::thumbBaseNormal(CGlobal::FOLDER_INFO, $arrMeta->info_id, $arrMeta->info_img, 550, 0, '', true, true);
            }
        }
        FunctionLib::SEO($meta_img, $meta_title, $meta_keywords, $meta_description);

        $pageNo = (int) Request::get('page_no',1);
        $limit = CGlobal::number_show_20;
        $offset = ($pageNo - 1) * $limit;
        $search = $data = array();
        $total = 0;

        $arrItem = Video::searchByConditionSite($search, $limit, $offset,$total);
        $paging = $total > 0 ? Pagging::getNewPager(3, $pageNo, $total, $limit, $search) : '';

        //Get Menu category News Right
        $searchCateRight['category_menu_right'] = CGlobal::status_show;
        $searchCateRight['category_type'] = CGlobal::category_new;
        $arrCatRight = Category::searchCategoryRightByCondition($searchCateRight, CGlobal::number_show_5);

        //Get news Hot
        $dataNewsSearch['news_hot'] = CGlobal::status_show;
        $arrNewsHot = News::getPostHot($dataNewsSearch, 10);

        $this->header();
        $this->layout->content = View::make('site.SiteLayouts.pageVideo')
            ->with('arrItem', $arrItem)
            ->with('paging', $paging)
            ->with('arrNewsHot', $arrNewsHot)
            ->with('arrCatRight', $arrCatRight);
        $this->footer();
    }
    public function pageVideoDetail($title='', $id=0){
        $data = $dataSame = array();
        if($id > 0){
            $data = Video::getById($id);
            if(sizeof($data) != 0){
                $dataField['field_get'] = '';
                $dataSame = Video::getSameVideo($dataField, $data->video_id, CGlobal::number_show_8, 0);
            }else{
                return Redirect::route('site.page404');
            }
        }

        //Meta title
        if(sizeof($data) != 0){
            $meta_title = $data->video_name;
            $meta_keywords = $data->video_name;
            $meta_description = FunctionLib::substring($data->video_content, 200, '...');
            $meta_img = '';
            FunctionLib::SEO($meta_img, $meta_title, $meta_keywords, $meta_description);
        }

        //Get Menu category News Right
        $searchCateRight['category_menu_right'] = CGlobal::status_show;
        $searchCateRight['category_type'] = CGlobal::category_new;
        $arrCatRight = Category::searchCategoryRightByCondition($searchCateRight, CGlobal::number_show_5);

        //Get news Hot
        $dataNewsSearch['news_hot'] = CGlobal::status_show;
        $arrNewsHot = News::getPostHot($dataNewsSearch, 10);

        $this->header();
        $this->layout->content = View::make('site.SiteLayouts.pageVideoDetail')
            ->with('item',$data)
            ->with('dataSame',$dataSame)
            ->with('arrNewsHot', $arrNewsHot)
            ->with('arrCatRight', $arrCatRight);
        $this->footer();

    }
}
