<?php

/**
 * Created by PhpStorm.
 * User: QuynhTM
 */
class CategoryController extends BaseAdminController
{
    private $permission_full = 'category_full';
    private $permission_view = 'category_view';
    private $permission_delete = 'category_delete';
    private $permission_create = 'category_create';
    private $permission_edit = 'category_edit';
    private $arrStatus = array(-1 => '----Chọn trạng thái----', CGlobal::status_hide => 'Ẩn', CGlobal::status_show => 'Hiện');
    private $arrShowHide = array(CGlobal::status_hide => 'Ẩn', CGlobal::status_show => 'Hiện thị');
    private $arrMenuRight = array(-1 => '----Chọn trạng thái----', CGlobal::status_hide => 'Ẩn', CGlobal::status_show => 'Hiện');

    private $arrTypeCategory = array();
    private $arrCategoryParent = array();
    private $arrCategoryDepart = array();
    private $category_type = CGlobal::category_product;


    public function __construct()
    {
        parent::__construct();

        $this->arrTypeCategory = TypeSetting::getTypeSettingWithGroup('group_category',true);
        $this->category_type = (int)Request::get('category_type', 0);
        $this->arrCategoryParent = Category::getAllParentCateWithType($this->category_type);
        $this->arrCategoryDepart = Department::getDepart();
    }

    public function view() {
        //Check phan quyen.
        if(!$this->is_root && !in_array($this->permission_full,$this->permission)&& !in_array($this->permission_view,$this->permission)){
            return Redirect::route('admin.dashboard',array('error'=>1));
        }
        $pageNo = (int) Request::get('page_no',1);
        $limit = CGlobal::number_limit_show;
        $offset = ($pageNo - 1) * $limit;
        $search = $data = $treeCategroy = array();
        $total = 0;

        $search['category_id'] = addslashes(Request::get('category_id',''));
        $search['category_name'] = addslashes(Request::get('category_name',''));
        $search['category_status'] = (int)Request::get('category_status',-1);
        $search['category_depart_id'] = (int)Request::get('category_depart_id',-1);
        $search['category_type'] = (int)Request::get('category_type',0);
        $search['category_menu_right'] = (int)Request::get('category_menu_right',-1);

        $dataSearch = Category::searchByCondition($search, 500, $offset,$total);
        if(!empty($dataSearch)){
            $data = Category::getTreeCategory($dataSearch);
            $data = !empty($data)? $data :$dataSearch;
        }
        $paging = '';

        $optionStatus = FunctionLib::getOption($this->arrStatus, $search['category_status']);
        $optionMenuRight = FunctionLib::getOption($this->arrMenuRight, $search['category_menu_right']);

        $this->layout->content = View::make('admin.Category.view')
            ->with('paging', $paging)
            ->with('stt', ($pageNo-1)*$limit)
            ->with('total', $total)
            ->with('data', $data)
            ->with('search', $search)
            ->with('category_type', $this->category_type)
            ->with('optionStatus', $optionStatus)
            ->with('optionMenuRight', $optionMenuRight)

            ->with('arrCategoryParent', $this->arrCategoryParent)
            ->with('is_root', $this->is_root)//dùng common
            ->with('is_boss', $this->is_boss)//dùng common
            ->with('permission_full', in_array($this->permission_full, $this->permission) ? 1 : 0)//dùng common
            ->with('permission_delete', in_array($this->permission_delete, $this->permission) ? 1 : 0)//dùng common
            ->with('permission_create', in_array($this->permission_create, $this->permission) ? 1 : 0)//dùng common
            ->with('permission_edit', in_array($this->permission_edit, $this->permission) ? 1 : 0);//dùng common
    }

    public function getItem($id=0) {
        if(!$this->is_root && !in_array($this->permission_full,$this->permission) && !in_array($this->permission_edit,$this->permission) && !in_array($this->permission_create,$this->permission)){
            return Redirect::route('admin.dashboard',array('error'=>1));
        }
        $data = array();
        $type = $this->category_type;
        if($id > 0) {
            $data = Category::find($id);
            $type = isset($data['category_type'])?$data['category_type']: $type;
        }
        $category_type = (int)Request::get('category_type', $type);
        $this->arrCategoryParent = Category::getAllParentCateWithType($category_type);
        //FunctionLib::debug($data);
        $optionStatus = FunctionLib::getOption($this->arrStatus, isset($data['category_status'])? $data['category_status'] : CGlobal::status_show);
        $optionMenuStatus = FunctionLib::getOption($this->arrStatus, isset($data['category_menu_status'])? $data['category_menu_status'] : CGlobal::status_hide);
        $optionCategoryParent = FunctionLib::getOption($this->arrCategoryParent, isset($data['category_parent_id'])? $data['category_parent_id'] : 0);
        $optionCategoryDepart = FunctionLib::getOption($this->arrCategoryDepart, isset($data['category_depart_id'])? $data['category_depart_id'] : 0);
        $optionTypeCategory = FunctionLib::getOption($this->arrTypeCategory, isset($data['category_type'])? $data['category_type'] : $this->category_type);
        $optionMenuRight = FunctionLib::getOption($this->arrStatus, isset($data['category_menu_right'])? $data['category_menu_right'] : CGlobal::status_hide);
        $this->layout->content = View::make('admin.Category.add')
            ->with('id', $id)
            ->with('data', $data)
            ->with('optionStatus', $optionStatus)
            ->with('optionMenuStatus', $optionMenuStatus)
            ->with('category_type', $category_type)
            ->with('optionTypeCategory', $optionTypeCategory)
            ->with('optionCategoryDepart', $optionCategoryDepart)
            ->with('arrShowHide', $this->arrShowHide)
        	->with('optionCategoryParent', $optionCategoryParent)
            ->with('optionMenuRight', $optionMenuRight);
    }

    public function postItem($id=0) {
        if(!$this->is_root && !in_array($this->permission_full,$this->permission) && !in_array($this->permission_edit,$this->permission) && !in_array($this->permission_create,$this->permission)){
            return Redirect::route('admin.dashboard',array('error'=>1));
        }

        $data['category_name'] = addslashes(Request::get('category_name'));
        $data['category_status'] = (int)Request::get('category_status', 0);
        $data['category_menu_status'] = (int)Request::get('category_menu_status', 0);
        $data['category_parent_id'] = (int)Request::get('category_parent_id', 0);
        $data['category_depart_id'] = (int)Request::get('category_depart_id', 0);
        $data['category_order'] = (int)Request::get('category_order', 0);
        $data['category_type'] = (int)Request::get('category_type', 0);
        $data['category_level'] = 1;
        $data['category_menu_right'] = (int)Request::get('category_menu_right', 0);

        if($this->valid($data) && empty($this->error)) {
            if($data['category_parent_id'] > 0){
                $data['category_depart_id'] = Category::getDepartIdByCategoryId($data['category_parent_id']);
            }
            if($id > 0) {
                if(Category::updateData($id, $data)) {
                    return Redirect::route('admin.categoryView',array('category_type'=>$data['category_type']));
                }
            } else {
                //them moi
                if(Category::addData($data)) {
                    return Redirect::route('admin.categoryView',array('category_type'=>$data['category_type']));
                }
            }
        }
        $this->arrCategoryParent = Category::getAllParentCateWithType($data['category_type']);
        $optionStatus = FunctionLib::getOption($this->arrStatus, isset($data['category_status'])? $data['category_status'] : CGlobal::status_show);
        $optionMenuStatus = FunctionLib::getOption($this->arrStatus, isset($data['category_menu_status'])? $data['category_menu_status'] : CGlobal::status_hide);
        $optionCategoryParent = FunctionLib::getOption(array(0=>'--- Chọn danh mục cha ---')+$this->arrCategoryParent, isset($data['category_parent_id'])? $data['category_parent_id'] : -1);
        $optionTypeCategory = FunctionLib::getOption($this->arrTypeCategory, isset($data['category_type'])? $data['category_type'] : -1);
        $optionCategoryDepart = FunctionLib::getOption($this->arrCategoryDepart, isset($data['category_depart_id'])? $data['category_depart_id'] : 0);
        $optionMenuRight = FunctionLib::getOption($this->arrStatus, isset($data['category_menu_right'])? $data['category_menu_right'] : CGlobal::status_hide);
        $this->layout->content =  View::make('admin.Category.add')
            ->with('id', $id)
            ->with('data', $data)
            ->with('optionStatus', $optionStatus)
            ->with('optionMenuStatus', $optionMenuStatus)
            ->with('category_type', $data['category_type'])
            ->with('optionTypeCategory', $optionTypeCategory)
            ->with('optionCategoryDepart', $optionCategoryDepart)
            ->with('error', $this->error)
            ->with('arrShowHide', $this->arrShowHide)
        	->with('optionCategoryParent', $optionCategoryParent)
            ->with('optionMenuRight', $optionMenuRight);
    }

    private function valid($data=array()) {
        if(!empty($data)) {
            if(isset($data['category_name']) && $data['category_name'] == '') {
                $this->error[] = 'Tên danh mục không được trống';
            }
            if(isset($data['category_status']) && $data['category_status'] == -1) {
                $this->error[] = 'Bạn chưa chọn trạng thái cho danh mục';
            }
            if(isset($data['category_parent_id']) && $data['category_parent_id'] == 0) {
                if(isset($data['category_depart_id']) && $data['category_depart_id'] == 0) {
                    if(isset($data['category_type']) && $data['category_type'] == CGlobal::category_product) {
                        $this->error[] = 'Bạn chưa chuyên mục';
                    }
                }
            }
            return true;
        }
        return false;
    }

    //ajax
    public function deleteCategory()
    {
        $result = array('isIntOk' => 0);
        if(!$this->is_root && !in_array($this->permission_full,$this->permission) && !in_array($this->permission_delete,$this->permission)){
            return Response::json($result);
        }
        $id = (int)Request::get('id', 0);
        if ($id > 0 && Category::deleteData($id)) {
            $result['isIntOk'] = 1;
        }
        return Response::json($result);
    }

    //ajax
    public function updateStatusCategory()
    {
        $id = (int)Request::get('id', 0);
        $category_status = (int)Request::get('status', CGlobal::status_hide);
        $result = array('isIntOk' => 0);
        if(!$this->is_root && !in_array($this->permission_full,$this->permission) && !in_array($this->permission_edit,$this->permission)){
            return Response::json($result);
        }

        if ($id > 0) {
            $data['category_status'] = ($category_status == CGlobal::status_hide)? CGlobal::status_show : CGlobal::status_hide;
            if(Category::updateData($id, $data)) {
                $result['isIntOk'] = 1;
            }
        }
        return Response::json($result);
    }

    //ajax
    public function updatePositionStatusCategory()
    {
        $id = (int)Request::get('id', 0);
        $category_status = (int)Request::get('status', CGlobal::status_hide);
        $position = (int)Request::get('position', 1);
        $result = array('isIntOk' => 0);
        if(!$this->is_root && !in_array($this->permission_full,$this->permission) && !in_array($this->permission_edit,$this->permission)){
            return Response::json($result);
        }

        if ($id > 0) {
            switch( $position ){
                case 1://top
                    $data['category_show_top'] = ($category_status == CGlobal::status_hide)? CGlobal::status_show : CGlobal::status_hide;
                    break;
                case 2://left
                    $data['category_show_left'] = ($category_status == CGlobal::status_hide)? CGlobal::status_show : CGlobal::status_hide;
                    break;
                case 3://right
                    $data['category_show_right'] = ($category_status == CGlobal::status_hide)? CGlobal::status_show : CGlobal::status_hide;
                    break;
                case 4://center
                    $data['category_show_center'] = ($category_status == CGlobal::status_hide)? CGlobal::status_show : CGlobal::status_hide;
                    break;
                default:
                    $data['category_show_top'] = ($category_status == CGlobal::status_hide)? CGlobal::status_show : CGlobal::status_hide;
                    break;
            }

            if(Category::updateData($id, $data)) {
                $result['isIntOk'] = 1;
            }
        }
        return Response::json($result);
    }

}