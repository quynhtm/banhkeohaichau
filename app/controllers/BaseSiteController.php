<?php
/*
* @Created by: DUYNX
* @Author    : nguyenduypt86@gmail.com
* @Date      : 11/2016
* @Version   : 1.0
*/

class BaseSiteController extends BaseController{
    protected $layout = 'site.BaseLayouts.index';
    protected $userAdmin = array();
    protected $user_customer = array();

    public function __construct(){
    	FunctionLib::site_css('font-awesome/4.2.0/css/font-awesome.min.css', CGlobal::$POS_HEAD);
    	FunctionLib::site_js('frontend/js/site.js', CGlobal::$POS_END);
        FunctionLib::site_css('frontend/css/usercustomer.css', CGlobal::$POS_HEAD);
        FunctionLib::site_js('frontend/js/usercustomer.js', CGlobal::$POS_END);
        FunctionLib::site_js('frontend/js/cart.js', CGlobal::$POS_END);
        FunctionLib::site_css('lib/jAlert/jquery.alerts.css', CGlobal::$POS_HEAD);
        FunctionLib::site_js('lib/jAlert/jquery.alerts.js', CGlobal::$POS_END);
        $this->userAdmin = User::user_login();
        $this->user_customer = Session::has('user_customer') ? Session::get('user_customer') : array();
    }
    public function header($catid=0){

        $messages = FunctionLib::messages('messages');
        $user_customer = $this->user_customer;
        if(empty($user_customer)){
            $this->popupHide();
        }

        $keyword = addslashes(Request::get('keyword',''));

        $hotline = '';
        $arrHotline = Info::getItemByKeyword('SITE_NUM_NICK_SUPPORT_ONLINE');
        if(sizeof($arrHotline) > 0){
            $hotline = strip_tags(stripslashes($arrHotline->info_content));
        }
        //Cagegory Horizontal
        $numCategoryHorizontal = 0;
        $numCategoryShowHorizontal = Info::getItemByKeyword('SITE_NUM_CATEGORY_HORIZONTAL');
        if(sizeof($numCategoryShowHorizontal) > 0){
            $numCategoryHorizontal = (int)strip_tags(stripslashes($numCategoryShowHorizontal->info_content));
        }
        $menuCateHorizontal = Category::getAllCategoryByType(CGlobal::category_new, $numCategoryHorizontal);
        $menuCateVertical = Category::getAllCategoryByType(CGlobal::category_product, 0);

        $numCart = $this->countNumCart();
        $numFavorite = $this->countNumFavorite();

    	$this->layout->header = View::make("site.BaseLayouts.header")
                                ->with('catid', $catid)
                                ->with('hotline', $hotline)
                                ->with('menuCateHorizontal', $menuCateHorizontal)
                                ->with('menuCateVertical', $menuCateVertical)
                                ->with('user_customer', $user_customer)
                                ->with('messages', $messages)
                                ->with('keyword', $keyword)
                                ->with('numCart', $numCart)
                                ->with('numFavorite', $numFavorite);
    }
    public function middle(){

        FunctionLib::site_css('lib/skitter-master/skitter.css', CGlobal::$POS_HEAD);
        FunctionLib::site_js('lib/skitter-master/jquery.easing.1.3.js', CGlobal::$POS_END);
        FunctionLib::site_js('lib/skitter-master/jquery.skitter.min.js', CGlobal::$POS_END);

        $arrBanner = Banner::getBannerAdvanced(CGlobal::BANNER_TYPE_SLIDE);
        $arrBannerSlider = $this->getBannerWithPosition($arrBanner);

        $arrBannerSub = Banner::getBannerAdvanced(CGlobal::BANNER_TYPE_SLIDE_SUB);
        $arrBannerSubRight = $this->getBannerWithPosition($arrBannerSub);

        $menuCateVertical = Category::getAllCategoryByType(CGlobal::category_product, 0);

        $this->layout->middle = View::make("site.BaseLayouts.middle")
                                ->with('arrBannerSlider', $arrBannerSlider)
                                ->with('arrBannerSubRight', $arrBannerSubRight)
                                ->with('menuCateVertical', $menuCateVertical);
    }
    public function consult(){

        //y Kien Khach Hang
        $data_yKien_khachHang = $this->getCategoryAndPostByKeyword('SITE_NUM_ID_CATEGORY_YKIEN_KHACHHANG', 3, 1);

        $hotline = '';
        $arrHotline = Info::getItemByKeyword('SITE_NUM_NICK_SUPPORT_ONLINE');
        if(sizeof($arrHotline) > 0){
            $hotline = strip_tags(stripslashes($arrHotline->info_content));
        }

        //Get news Hot
        $dataNewsSearch['news_hot'] = CGlobal::status_show;
        $arrNewsHot = News::getPostHot($dataNewsSearch, 5);

        $this->layout->consult = View::make("site.BaseLayouts.consult")
                                ->with('data_yKien_khachHang', $data_yKien_khachHang)
                                ->with('arrNewsHot', $arrNewsHot)
                                ->with('hotline', $hotline);
    }
	public function footer(){
        $address = '';
        $arrAddress = Info::getItemByKeyword('SITE_ADDRESS_FOOTER');
        if(sizeof($arrAddress) > 0){
            $address = strip_tags(stripslashes($arrAddress->info_content));
        }

        $phone = '';
        $arrPhone = Info::getItemByKeyword('SITE_PHONE_FOOTER');
        if(sizeof($arrPhone) > 0){
            $phone = strip_tags(stripslashes($arrPhone->info_content));
        }

		$this->layout->footer = View::make("site.BaseLayouts.footer")->with('address', $address)->with('phone', $phone);
	}

    public function popupHide(){
        $this->layout->popupHide = View::make("site.BaseLayouts.popupHide");
    }

    public static function getPostInCategoryId($cat_id=0, $limit_post=0){
        $result = array();
        if($cat_id > 0 && $limit_post > 0){
            $arrCats = array();
            Category::makeListCatId($cat_id, 0, $arrCats);
            $arrCats[] = $cat_id;
            if(sizeof($arrCats) > 0){
                $arrPost = News::getPostInCategoryParent($arrCats, $limit_post);
                $result = $arrPost;
            }
        }
        return $result;
    }
    public function getBannerWithPosition($arrBanner = array()){
        $arrBannerShow = array();
        if(sizeof($arrBanner) > 0){
            foreach($arrBanner as $id_banner =>$valu){
                $banner_is_run_time = 1;
                if($valu->banner_is_run_time == CGlobal::BANNER_NOT_RUN_TIME){
                    $banner_is_run_time = 1;
                }else{
                    $banner_start_time = $valu->banner_start_time;
                    $banner_end_time = $valu->banner_end_time;
                    $date_current = time();
                    if($banner_start_time > 0 && $banner_end_time > 0 && $banner_start_time <= $banner_end_time){
                        if($banner_start_time <= $date_current && $date_current <= $banner_end_time){
                            $banner_is_run_time = 1;
                        }
                    }else{
                        $banner_is_run_time = 0;
                    }
                }
                if($banner_is_run_time == 1){
                    $arrBannerShow[$valu->banner_id] = $valu;
                }
            }
        }
        return $arrBannerShow;
    }

    public function getCategoryAndPostByKeyword($cat_keyword='', $limit_post=0, $get_a_cat=0){
        $result = array();
        $catid = 0;
        if($cat_keyword != '' && $limit_post>0){
            $result_cat = Info::getItemByKeyword($cat_keyword);
            if(sizeof($result_cat) > 0){
                $catid = strip_tags(stripslashes($result_cat->info_content));
                if($catid != '') {
                    if ($get_a_cat == 1){
                        $dataCat = Category::getByID((int)$catid);
                        if(sizeof($dataCat) > 0) {
                            //Data Category
                            $result['cat'] = array(
                                'category_id' => $dataCat->category_id,
                                'category_name' => $dataCat->category_name,
                            );
                        }
                    }
                    //Data Post In Category
                    $arrCat = array((int)$catid);
                    $arrPost = News::getPostInCategoryParent($arrCat, $limit_post);
                    $result['post'] = $arrPost;
                }
            }
        }
        return $result;
    }

    public function countNumCart(){
        $cartItem = 0;
        if(Session::has('cart')){
            $data = Session::get('cart');
            foreach($data as $v){
                if($v){
                    $cartItem += $v;
                }
            }
        }
        return $cartItem;
    }

    public function countNumFavorite(){
        $favoriteItem = 0;
        if(Session::has('favorite')){
            $data = Session::get('favorite');
            foreach($data as $v){
                if($v){
                    $favoriteItem += $v;
                }
            }
        }
        return $favoriteItem;
    }
}