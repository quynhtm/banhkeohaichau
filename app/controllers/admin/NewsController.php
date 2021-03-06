<?php

/**
 * Created by PhpStorm.
 * User: QuynhTM
 */
class NewsController extends BaseAdminController
{
    private $permission_view = 'news_view';
    private $permission_full = 'news_full';
    private $permission_delete = 'news_delete';
    private $permission_create = 'news_create';
    private $permission_edit = 'news_edit';
    private $arrStatus = array(-1 => 'Chọn trạng thái', CGlobal::status_hide => 'Ẩn', CGlobal::status_show => 'Hiện');
    private $arrHot = array(-1 => 'Chọn nổi bật', CGlobal::status_hide => 'Không', CGlobal::status_show => 'Có');
    private $error = array();
    private $arrCategoryNew = array();
    private $arrTypeNew = array();

    public function __construct()
    {
        parent::__construct();

        //$this->arrCategoryNew = Category::getAllParentCateWithType(CGlobal::category_new);
        $arrCategoryAll = Category::buildTreeCategory(CGlobal::category_new);
        foreach($arrCategoryAll as $k =>$cat){
            $this->arrCategoryNew[$cat['category_id']] = $cat['padding_left'].$cat['category_name'];
        }


        $this->arrTypeNew = CGlobal::$arrTypeNew;

        //Include style.
        FunctionLib::link_css(array(
            'lib/upload/cssUpload.css',
        ));

        //Include javascript.
        FunctionLib::link_js(array(
            'lib/upload/jquery.uploadfile.js',
            'lib/ckeditor/ckeditor.js',
            'lib/ckeditor/config.js',
            'lib/dragsort/jquery.dragsort.js',
            'js/common.js',
        ));
    }

    public function view() {
        //Check phan quyen.
        if(!$this->is_root && !in_array($this->permission_full,$this->permission)&& !in_array($this->permission_view,$this->permission)){
            return Redirect::route('admin.dashboard',array('error'=>1));
        }
        $pageNo = (int) Request::get('page_no',1);
        $limit = CGlobal::number_limit_show;
        $offset = ($pageNo - 1) * $limit;
        $search = $data = array();
        $total = 0;

        $search['news_title'] = addslashes(Request::get('news_title',''));
        $search['news_status'] = (int)Request::get('news_status',-1);
        $search['news_hot'] = (int)Request::get('news_hot',-1);
        //$search['field_get'] = 'category_id,news_title,news_status';//cac truong can lay

        $dataSearch = News::searchByCondition($search, $limit, $offset,$total);
        $paging = $total > 0 ? Pagging::getNewPager(3, $pageNo, $total, $limit, $search) : '';

        //FunctionLib::debug($dataSearch);
        $optionStatus = FunctionLib::getOption($this->arrStatus, $search['news_status']);
        $optionHot = FunctionLib::getOption($this->arrHot, $search['news_hot']);
        $this->layout->content = View::make('admin.News.view')
            ->with('paging', $paging)
            ->with('stt', ($pageNo-1)*$limit)
            ->with('total', $total)
            ->with('sizeShow', count($data))
            ->with('data', $dataSearch)
            ->with('search', $search)
            ->with('optionStatus', $optionStatus)
            ->with('arrStatus', $this->arrStatus)
            ->with('optionHot', $optionHot)
            ->with('arrHot', $this->arrHot)
            ->with('arrCategoryNew', $this->arrCategoryNew)

            ->with('is_root', $this->is_root)//dùng common
            ->with('permission_full', in_array($this->permission_full, $this->permission) ? 1 : 0)//dùng common
            ->with('permission_delete', in_array($this->permission_delete, $this->permission) ? 1 : 0)//dùng common
            ->with('permission_create', in_array($this->permission_create, $this->permission) ? 1 : 0)//dùng common
            ->with('permission_edit', in_array($this->permission_edit, $this->permission) ? 1 : 0);//dùng common
    }

    public function getNews($id=0) {
        if(!$this->is_root && !in_array($this->permission_full,$this->permission) && !in_array($this->permission_edit,$this->permission) && !in_array($this->permission_create,$this->permission)){
            return Redirect::route('admin.dashboard',array('error'=>1));
        }
        $data = array();
        $arrViewImgOther = array();
        $imageOrigin = $urlImageOrigin = '';
        if($id > 0) {
            $data = News::getNewByID($id);
            if(sizeof($data) > 0){
                //lay ảnh khác của san phẩm
                $arrViewImgOther = array();
                if($data->news_image_other != ''){
                    $arrImagOther = (trim($data->news_image_other) != '') ? unserialize($data->news_image_other) : array();
                    if(sizeof($arrImagOther) > 0){
                        foreach($arrImagOther as $k=>$val){
                            $url_thumb = ThumbImg::getImageThumb(CGlobal::FOLDER_NEWS, $id, $val, CGlobal::sizeImage_100,  '', true, CGlobal::type_thumb_image_banner, false);
                            $arrViewImgOther[] = array('img_other'=>$val,'src_img_other'=>$url_thumb);
                        }
                    }
                }
                //ảnh sản phẩm chính
                $imageOrigin = $data->news_image;
            }
        }
        $optionStatus = FunctionLib::getOption($this->arrStatus, isset($data['news_status'])? $data['news_status'] : CGlobal::status_show);
        $optionCategory = FunctionLib::getOption($this->arrCategoryNew, isset($data['news_category'])? $data['news_category'] : 0);
        $optionType = FunctionLib::getOption($this->arrTypeNew, isset($data['news_type'])? $data['news_type'] : CGlobal::NEW_TYPE_TIN_TUC);
        $optionHot = FunctionLib::getOption($this->arrHot, isset($data['news_hot'])? $data['news_hot'] : CGlobal::status_hide);

        $this->layout->content = View::make('admin.News.add')
            ->with('id', $id)
            ->with('data', $data)
            ->with('imageOrigin', $imageOrigin)
            ->with('urlImageOrigin', $urlImageOrigin)
            ->with('arrViewImgOther', $arrViewImgOther)
            ->with('optionStatus', $optionStatus)
            ->with('optionCategory', $optionCategory)
            ->with('optionType', $optionType)
            ->with('optionHot', $optionHot)
            ->with('arrStatus', $this->arrStatus);
    }
    public function postNews($id=0) {
        if(!$this->is_root && !in_array($this->permission_full,$this->permission) && !in_array($this->permission_edit,$this->permission) && !in_array($this->permission_create,$this->permission)){
            return Redirect::route('admin.dashboard',array('error'=>1));
        }
        $dataSave['news_title'] = addslashes(Request::get('news_title'));
        $dataSave['meta_title'] = addslashes(Request::get('meta_title'));
        $dataSave['meta_description'] = addslashes(Request::get('meta_description'));
        $dataSave['meta_keywords'] = addslashes(Request::get('meta_keywords'));
        $dataSave['news_desc_sort'] = addslashes(Request::get('news_desc_sort'));
        $dataSave['news_content'] = FunctionLib::strReplace(Request::get('news_content'), '\r\n', '');
        $dataSave['news_type'] = addslashes(Request::get('news_type',CGlobal::NEW_TYPE_TIN_TUC));
        $dataSave['news_category'] = (int)(Request::get('news_category',0));
        $dataSave['news_status'] = (int)Request::get('news_status', 0);
        $dataSave['news_hot'] = (int)Request::get('news_hot', 0);
        $dataSave['new_infor_other'] = addslashes(Request::get('new_infor_other'));

        $id_hiden = (int)Request::get('id_hiden', 0);

        //ảnh chính
        $image_primary = addslashes(Request::get('image_primary'));
        //ảnh khác
        $getImgOther = Request::get('img_other',array());
        if(!empty($getImgOther)){
            foreach($getImgOther as $k=>$val){
                if($val !=''){
                    $arrInputImgOther[] = $val;
                }
            }
        }
        if (!empty($arrInputImgOther) && count($arrInputImgOther) > 0) {
            //nếu không chọn ảnh chính, lấy ảnh chính là cái đầu tiên
            $dataSave['news_image'] = ($image_primary != '')? $image_primary: $arrInputImgOther[0];
            $dataSave['news_image_other'] = serialize($arrInputImgOther);
        }

        //FunctionLib::debug($dataSave);
        if($this->valid($dataSave) && empty($this->error)) {
            $id = ($id == 0)?$id_hiden: $id;
            $dataSave['news_category_name'] = Category::getCategoryNameByID($dataSave['news_category']);
            $dataSave['news_category_parent'] = Category::getParentIdByCategoryId($dataSave['news_category']);
            if($id > 0) {
                //cap nhat
                $dataSave['news_update'] = time();
                $dataSave['news_user_update'] =  !empty($this->user)? $this->user['user_name']: '';
                if(News::updateData($id, $dataSave)) {
                    return Redirect::route('admin.newsView');
                }
            } else {
                //them moi
                $dataSave['news_create'] = time();
                $dataSave['news_user_create'] = !empty($this->user)? $this->user['user_name']: '';
                $submit = News::addData($dataSave);
                if($submit) {
                    return Redirect::route('admin.newsView');
                }else{
                    $this->error[] = $submit;
                }

            }
        }

        $optionStatus = FunctionLib::getOption($this->arrStatus, isset($dataSave['news_status'])? $dataSave['news_status'] : -1);
        $optionHot = FunctionLib::getOption($this->arrHot, isset($dataSave['news_hot'])? $dataSave['news_hot'] : -1);
        $this->layout->content =  View::make('admin.News.add')
            ->with('id', $id)
            ->with('data', $dataSave)
            ->with('optionStatus', $optionStatus)
            ->with('optionHot', $optionHot)
            ->with('error', $this->error)
            ->with('arrStatus', $this->arrStatus);
    }

    public function deleteNews(){
        $data = array('isIntOk' => 0);
        if(!$this->is_root && !in_array($this->permission_delete,$this->permission)){
            return Response::json($data);
        }
        $id = (int)Request::get('id', 0);
        if ($id > 0 && News::deleteData($id)) {
            $data['isIntOk'] = 1;
        }
        return Response::json($data);
    }

    private function valid($data=array()) {
        if(!empty($data)) {
            if(isset($data['news_category']) && $data['news_category'] == '') {
                $this->error[] = 'Chưa chọn danh mục tin';
            }
            if(isset($data['news_title']) && $data['news_title'] == '') {
                $this->error[] = 'Tiêu đề tin không được bỏ trống';
            }
            return true;
        }
        return false;
    }

}