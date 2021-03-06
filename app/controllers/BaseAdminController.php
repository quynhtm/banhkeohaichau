<?php
class BaseAdminController extends BaseController
{
    protected $layout = 'admin.AdminLayouts.index';
    protected $permission = array();
    protected $user = array();
    protected $is_root = false;
    protected $is_boss = false;
    protected $user_group_depart = '';

    public function __construct()
    {
        if (!User::isLogin()) {
            Redirect::route('admin.login',array('url'=>self::buildUrlEncode(URL::current())))->send();
        }

        $this->user = User::user_login();
        if($this->user){
            if(sizeof($this->user['user_permission']) > 0) {
                $this->permission = $this->user['user_permission'];
            }
            $this->user_group_depart = $this->user['user_group_depart'];
        }
        //FunctionLib::debug($this->user);
        //boss admin
        if(in_array('is_boss',$this->permission)){
            $this->is_boss = true;
        }
        //quản trị viên
        if(in_array('root',$this->permission)){
            $this->is_root = true;
        }
        $menu = $this->menu();
        View::share('menu',$menu);
        View::share('aryPermission',$this->permission);
        View::share('user',$this->user);
        View::share('user_group_depart',$this->user_group_depart);
        View::share('is_root',$this->is_root);
        View::share('is_boss',$this->is_boss);
    }

    public function menu(){
        $menu[] = array(
            'name'=>'QL user Admin',
            'link'=>'javascript:void(0)',
            'icon'=>'fa fa-user',
            'arr_link_sub'=>array('admin.user_view','admin.permission_view','admin.groupUser_view','admin.typeSettingView','admin.sizeImageView'),//dung de check menu left action
            'sub'=>array(
                array('name'=>'Tài khoản Admin', 'RouteName'=>'admin.user_view', 'icon'=>'fa fa-user icon-4x', 'showcontent'=>1,'showMenu'=>1, 'permission'=>'user_view'),
                array('name'=>'Danh sách quyền', 'RouteName'=>'admin.permission_view', 'icon'=>'fa fa-user icon-4x', 'showcontent'=>0,'showMenu'=>0, 'permission'=>'permission_full'),
                array('name'=>'Danh sách nhóm quyền', 'RouteName'=>'admin.groupUser_view', 'icon'=>'fa fa-user icon-4x', 'showcontent'=>0,'showMenu'=>0, 'permission'=>'group_user_view'),
                array('name'=>'Type Setting', 'RouteName'=>'admin.typeSettingView', 'icon'=>'fa fa-wrench icon-4x', 'showcontent'=>0,'showMenu'=>0, 'permission'=>'setting_site_full'),
                array('name'=>'Size ảnh', 'RouteName'=>'admin.sizeImageView', 'icon'=>'fa fa-camera icon-4x', 'showcontent'=>0,'showMenu'=>0, 'permission'=>'sizeImage_full'),
            ),
        );

        /*$menu[] = array(
            'name'=>'Setting site',
            'link'=>'javascript:void(0)',
            'icon'=>'fa fa-cogs',
            'arr_link_sub'=>array('admin.typeSettingView'),
            'sub'=>array(
                array('name'=>'Type Setting', 'RouteName'=>'admin.typeSettingView', 'icon'=>'fa fa-wrench icon-4x', 'showcontent'=>1,'showMenu'=>1, 'permission'=>'setting_site_full'),
                array('name'=>'Size ảnh', 'RouteName'=>'admin.sizeImageView', 'icon'=>'fa fa-camera icon-4x', 'showcontent'=>1,'showMenu'=>1, 'permission'=>'sizeImage_full'),
            ),
        );*/

        $menu[] = array(
            'name'=>'QL Sản phẩm',
            'link'=>'javascript:void(0)',
            'icon'=>'fa fa-gift',
            'arr_link_sub'=>array('admin.productView','admin.providerView','admin.categoryView','admin.department_list',),
            'sub'=>array(
                array('name'=>'Phân loại sản phẩm', 'RouteName'=>'admin.department_list', 'icon'=>'fa fa-codepen icon-4x', 'showcontent'=>1, 'showMenu'=>1,'permission'=>'department_full'),
                array('name'=>'Danh mục sản phẩm', 'RouteName'=>'admin.categoryView','param'=>array('category_type'=>CGlobal::category_product), 'icon'=>'fa fa-indent icon-4x', 'showcontent'=>1,'showMenu'=>1, 'permission'=>'category_full'),
                array('name'=>'Sản phẩm', 'RouteName'=>'admin.productView', 'icon'=>'fa fa-cubes icon-4x', 'showcontent'=>1, 'showMenu'=>1,'permission'=>'product_full'),
                //array('name'=>'QL nhà cung cấp', 'RouteName'=>'admin.providerView', 'icon'=>'fa fa-indent icon-4x', 'showcontent'=>1,'showMenu'=>1, 'permission'=>'provider_full'),
            ),
        );

        /*Quản lý hệ thống bán hàng*/
        $menu[] = array(
            'name'=>'Thông kê bán hàng',
            'link'=>'javascript:void(0)',
            'icon'=>'fa fa-bar-chart',
            'arr_link_sub'=>array('admin.managerOrderView','admin.reportView'),
            'sub'=>array(
                array('name'=>'Danh sách đơn hàng', 'RouteName'=>'admin.managerOrderView', 'icon'=>'fa fa-bar-chart icon-4x', 'showcontent'=>1,'showMenu'=>1, 'permission'=>'managerOrder_full'),
                array('name'=>'Báo cáo bán hàng', 'RouteName'=>'admin.reportView', 'icon'=>'fa fa-bar-chart icon-4x', 'showcontent'=>0,'showMenu'=>0, 'permission'=>'Report_view'),
            ),
        );

        $menu[] = array(
            'name'=>'QL site',
            'link'=>'javascript:void(0)',
            'icon'=>'fa fa-location-arrow',
            'arr_link_sub'=>array('admin.info','admin.customerView','admin.contract'),
            'sub'=>array(
                array('name'=>'Danh sách khách hàng', 'RouteName'=>'admin.customerView', 'icon'=>'fa fa-user icon-4x', 'showcontent'=>1,'showMenu'=>1, 'permission'=>'user_customer_full'),
                array('name'=>'Liên hệ quản trị', 'RouteName'=>'admin.contract', 'icon'=>'fa fa-envelope-o icon-4x', 'showcontent'=>1,'showMenu'=>1, 'permission'=>'contract_view'),
                array('name'=>'Thông tin chung', 'RouteName'=>'admin.info', 'icon'=>'fa fa-cogs icon-4x', 'showcontent'=>1,'showMenu'=>1, 'permission'=>'abc'),
            ),
        );

        /*$menu[] = array(
            'name'=>'QL khoa nghành',
            'link'=>'javascript:void(0)',
            'icon'=>'fa fa-gift',
            'arr_link_sub'=>array('admin.department_list',),
            'sub'=>array(
                array('name'=>'Chuyên mục', 'RouteName'=>'admin.department_list', 'icon'=>'fa fa-users icon-4x', 'showcontent'=>1, 'showMenu'=>1,'permission'=>'department_full'),
            ),
        );*/

        $menu[] = array(
            'name'=>'QL nội dung',
            'link'=>'javascript:void(0)',
            'icon'=>'fa fa-book',
            'arr_link_sub'=>array('admin.newsView','admin.bannerView','admin.videoView','admin.libraryImageView','admin.provinceView',),
            'sub'=>array(
                array('name'=>'Danh mục tin tức', 'RouteName'=>'admin.categoryView','param'=>array('category_type'=>CGlobal::category_new), 'icon'=>'fa fa-indent icon-4x', 'showcontent'=>1,'showMenu'=>1, 'permission'=>'category_full'),
                array('name'=>'Tin tức', 'RouteName'=>'admin.newsView', 'icon'=>'fa fa-book icon-4x', 'showcontent'=>1,'showMenu'=>1, 'permission'=>'news_full'),
                array('name'=>'Banner quảng cáo', 'RouteName'=>'admin.bannerView', 'icon'=>'fa fa-globe icon-4x', 'showcontent'=>1,'showMenu'=>1, 'permission'=>'banner_full'),
                array('name'=>'Video', 'RouteName'=>'admin.videoView', 'icon'=>'fa fa-video-camera icon-4x', 'showcontent'=>1,'showMenu'=>1, 'permission'=>'video_full'),
                array('name'=>'Thư viện ảnh', 'RouteName'=>'admin.libraryImageView', 'icon'=>'fa fa-picture-o icon-4x', 'showcontent'=>1,'showMenu'=>1, 'permission'=>'libraryImage_full'),
                array('name'=>'Tỉnh/Thành', 'RouteName'=>'admin.provinceView', 'icon'=>'fa fa-map-marker icon-4x', 'showcontent'=>1, 'permission'=>'province_full'),
            ),
        );
        return $menu;
    }

    public function getControllerAction(){
        return $routerName = Route::currentRouteName();
    }
}