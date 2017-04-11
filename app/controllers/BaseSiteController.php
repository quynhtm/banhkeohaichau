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
    public function __construct(){
    	FunctionLib::site_css('font-awesome/4.2.0/css/font-awesome.min.css', CGlobal::$POS_HEAD);
    	FunctionLib::site_js('frontend/js/site.js', CGlobal::$POS_END);
        $this->userAdmin = User::user_login();
    }
    public function header($catid=0){
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
    	$this->layout->header = View::make("site.BaseLayouts.header")
                                ->with('catid', $catid)
                                ->with('hotline', $hotline)
                                ->with('menuCateHorizontal', $menuCateHorizontal);
    }
    public function middle(){
        $this->layout->middle = View::make("site.BaseLayouts.middle");
    }
    public function consult(){
        $this->layout->consult = View::make("site.BaseLayouts.consult");
    }
	public function footer(){
        $footer = '';
        $arrFooter = Info::getItemByKeyword('SITE_FOOTER_LEFT');
        if(sizeof($arrFooter) > 0){
            $footer = stripslashes($arrFooter->info_content);
        }
		$this->layout->footer = View::make("site.BaseLayouts.footer")->with('footer', $footer);
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
}