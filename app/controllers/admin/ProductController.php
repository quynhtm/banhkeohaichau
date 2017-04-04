<?php

/**
 * Created by PhpStorm.
 * User: QuynhTM
 */
class ProductController extends BaseAdminController
{
    private $permission_view = 'product_view';
    private $permission_full = 'product_full';
    private $permission_delete = 'product_delete';
    private $permission_create = 'product_create';
    private $permission_edit = 'product_edit';
    private $arrStatusUpdate = array(-1 => 'Trạng thái chuyển đổi',
        CGlobal::status_hide => 'Ẩn',
        CGlobal::status_show => 'Hiện',
        2 => 'Khóa SP',
        3 => 'Mở khóa SP',
        //4 => 'Set top SP',
        //product_is_hot: loại sản phẩm
        5 => 'Sản phẩm bình thường',
        6 => 'Sản phẩm nổi bật',
        7 => 'Sản phẩm giảm giá',
        );
    private $arrStatus = array(-1 => 'Chọn trạng thái', CGlobal::status_hide => 'Ẩn', CGlobal::status_show => 'Hiện');
    private $arrBlock = array(-1 => 'Chọn kiểu khóa SP', CGlobal::PRODUCT_NOT_BLOCK => 'Đang mở', CGlobal::PRODUCT_BLOCK => 'Đang khóa');
    private $arrTypePrice = array(CGlobal::TYPE_PRICE_NUMBER => 'Hiển thị giá bán', CGlobal::TYPE_PRICE_CONTACT => 'Liên hệ');
    private $arrTypeProduct = array(-1 => '--Chọn loại sản phẩm--', CGlobal::PRODUCT_NOMAL => 'Sản phẩm bình thường', CGlobal::PRODUCT_HOT => 'Sản phẩm nổi bật', CGlobal::PRODUCT_SELLOFF => 'Sản phẩm giảm giá');
    private $arrIsSale = array(CGlobal::PRODUCT_IS_SALE => 'Còn hàng', CGlobal::PRODUCT_NOT_IS_SALE => 'Hết hàng');
    private $error =  array();
    private $arrCategory = array();
    private $arrDepart = array();
    public function __construct()
    {
        parent::__construct();
        //Include style.
        FunctionLib::link_css(array(
            'lib/upload/cssUpload.css',
        ));

        //Include javascript.
        FunctionLib::link_js(array(
            'lib/upload/jquery.uploadfile.js',
            'lib/ckeditor/ckeditor.js',
            'lib/ckeditor/config.js',
            'js/common.js',
            'admin/js/admin.js',
            'lib/dragsort/jquery.dragsort.js',
            'lib/number/autoNumeric.js',
            //'frontend/js/site.js',
        ));

        //danh mục
        $arrCategoryAll = Category::buildTreeCategory(CGlobal::category_product);
        foreach($arrCategoryAll as $k =>$cat){
            $this->arrCategory[$cat['category_id']] = $cat['padding_left'].$cat['category_name'];
        }

        //láy thông tin depart_id
        $this->arrDepart = Department::getDepart();
    }

    public function view() {
        //Check phan quyen.
        if(!$this->is_root && !in_array($this->permission_full,$this->permission)&& !in_array($this->permission_view,$this->permission)){
            return Redirect::route('admin.dashboard',array('error'=>1));
        }
        CGlobal::$pageShopTitle = "Quản lý sản phẩm | ".CGlobal::web_name;
        $pageNo = (int) Request::get('page_no',1);
        $limit = CGlobal::number_limit_show;
        $offset = ($pageNo - 1) * $limit;
        $search = $data = array();
        $total = 0;

        $search['product_name'] = addslashes(Request::get('product_name',''));
        $search['product_status'] = (int)Request::get('product_status',-1);
        $search['product_is_hot'] = (int)Request::get('product_is_hot',-1);
        $search['category_id'] = (int)Request::get('category_id',-1);
        $search['depart_id'] = (int)Request::get('depart_id',-1);
        //$search['field_get'] = 'order_id,order_product_name,order_status';//cac truong can lay

        $dataSearch = Product::searchByCondition($search, $limit, $offset,$total);
        $paging = $total > 0 ? Pagging::getNewPager(3, $pageNo, $total, $limit, $search) : '';
        //FunctionLib::debug($search);

        $optionStatus = FunctionLib::getOption($this->arrStatus, $search['product_status']);
        $optionType = FunctionLib::getOption($this->arrTypeProduct, $search['product_is_hot']);
        $optionDepart = FunctionLib::getOption($this->arrDepart, $search['depart_id']);
        $optionStatusUpdate = FunctionLib::getOption($this->arrStatusUpdate, -1);
        $this->layout->content = View::make('admin.Product.view')
            ->with('paging', $paging)
            ->with('stt', ($pageNo-1)*$limit)
            ->with('total', $total)
            ->with('sizeShow', count($data))
            ->with('data', $dataSearch)
            ->with('search', $search)
            ->with('arrTypeProduct', $this->arrTypeProduct)
            ->with('optionStatus', $optionStatus)
            ->with('optionType', $optionType)
            ->with('optionDepart', $optionDepart)

            ->with('arrDepart', $this->arrDepart)
            ->with('arrIsSale', $this->arrIsSale)

            ->with('optionStatusUpdate', $optionStatusUpdate)
            ->with('is_root', $this->is_root)//dùng common
            ->with('permission_full', in_array($this->permission_full, $this->permission) ? 1 : 0)//dùng common
            ->with('permission_delete', in_array($this->permission_delete, $this->permission) ? 1 : 0)//dùng common
            ->with('permission_create', in_array($this->permission_create, $this->permission) ? 1 : 0)//dùng common
            ->with('permission_edit', in_array($this->permission_edit, $this->permission) ? 1 : 0);//dùng common
    }

    public function getProduct($id=0) {
        if(!$this->is_root && !in_array($this->permission_full,$this->permission) && !in_array($this->permission_edit,$this->permission) && !in_array($this->permission_create,$this->permission)){
            return Redirect::route('admin.dashboard',array('error'=>1));
        }

        $product = array();
        $arrViewImgOther = array();
        $imagePrimary = $imageHover = '';
        $product = Product::getProductByID($id);

        //lấy ảnh show
        if(sizeof($product) > 0){
            //lay ảnh khác của san phẩm
            if(!empty($product->product_image_other)){
                $arrImagOther = unserialize($product->product_image_other);
                if(sizeof($arrImagOther) > 0){
                    foreach($arrImagOther as $k=>$val){
                        $url_thumb = ThumbImg::getImageThumb(CGlobal::FOLDER_PRODUCT, $id, $val, CGlobal::sizeImage_100);
                        $arrViewImgOther[] = array('img_other'=>$val,'src_img_other'=>$url_thumb);
                    }
                }
            }
            //ảnh sản phẩm chính
            $imagePrimary = $product->product_image;
            $imageHover = $product->product_image_hover;
        }

        $optionCategory = FunctionLib::getOption(array(-1=>'---Chọn danh mục----') + $this->arrCategory,isset($product->category_id)? $product->category_id: -1);
        $optionDepart = FunctionLib::getOption(array(-1=>'---Chọn chuyên mục----') + $this->arrDepart,isset($product->depart_id)? $product->depart_id: -1);
        $optionStatus = FunctionLib::getOption($this->arrStatus,isset($product->product_status)? $product->product_status: CGlobal::status_hide);
        $optionTypePrice = FunctionLib::getOption($this->arrTypePrice,isset($product->product_type_price)? $product->product_type_price:CGlobal::TYPE_PRICE_NUMBER);
        $optionTypeProduct = FunctionLib::getOption($this->arrTypeProduct,isset($product->product_is_hot)? $product->product_is_hot:CGlobal::PRODUCT_NOMAL);
        $optionIsSale = FunctionLib::getOption($this->arrIsSale,isset($product->is_sale)? $product->is_sale:CGlobal::PRODUCT_IS_SALE);

        $this->layout->content = View::make('admin.Product.add')
            ->with('error', $this->error)
            ->with('id', $id)
            ->with('data', $product)
            ->with('arrViewImgOther', $arrViewImgOther)
            ->with('imagePrimary', $imagePrimary)
            ->with('imageHover', $imageHover)
            ->with('optionCategory', $optionCategory)
            ->with('optionDepart', $optionDepart)
            ->with('optionStatus', $optionStatus)
            ->with('optionTypePrice', $optionTypePrice)
            ->with('optionIsSale', $optionIsSale)
            ->with('optionTypeProduct', $optionTypeProduct);
    }
    public function postProduct($id = 0){

        if(!$this->is_root && !in_array($this->permission_full,$this->permission) && !in_array($this->permission_edit,$this->permission) && !in_array($this->permission_create,$this->permission)){
            return Redirect::route('admin.dashboard',array('error'=>1));
        }
        CGlobal::$pageAdminTitle = "Sửa sản phẩm | ".CGlobal::web_name;
        $arrViewImgOther = array();
        $imagePrimary = $imageHover = '';

        $dataSave['category_id'] = (int)(Request::get('category_id',-1));
        $dataSave['depart_id'] = (int)(Request::get('depart_id',-1));

        $dataSave['product_name'] = addslashes(Request::get('product_name'));
        $dataSave['product_selloff'] = addslashes(Request::get('product_selloff'));
        $dataSave['product_status'] = addslashes(Request::get('product_status'));
        $dataSave['product_type_price'] = addslashes(Request::get('product_type_price',CGlobal::TYPE_PRICE_NUMBER));

        $dataSave['product_sort_desc'] = addslashes(Request::get('product_sort_desc'));
        $dataSave['product_content'] = Request::get('product_content');
        $dataSave['product_order'] = (int)(Request::get('product_order',100));
        $dataSave['quality_input'] = (int)(Request::get('quality_input',0));

        $dataSave['product_price_sell'] = (int)str_replace('.','',Request::get('product_price_sell'));
        $dataSave['product_price_market'] = (int)str_replace('.','',Request::get('product_price_market'));
        $dataSave['product_price_input'] = (int)str_replace('.','',Request::get('product_price_input'));
        $dataSave['product_price_provider_sell'] = (int)str_replace('.','',Request::get('product_price_provider_sell'));

        $dataSave['product_image'] = $imagePrimary = addslashes(Request::get('image_primary'));
        $dataSave['product_image_hover'] = $imageHover = addslashes(Request::get('product_image_hover'));
        $dataSave['is_sale'] = addslashes(Request::get('is_sale',CGlobal::PRODUCT_IS_SALE));
        $dataSave['product_code'] = addslashes(Request::get('product_code'));
        $dataSave['product_is_hot'] = addslashes(Request::get('product_is_hot',CGlobal::PRODUCT_NOMAL));
        $dataSave['provider_id'] = addslashes(Request::get('provider_id'));

        //mac dinh
        $dataSave['is_shop'] = 1; //0: sp của shop thường, 1: sản phẩm của shop vip
        $dataSave['province_id'] = 0;
        $dataSave['is_block'] = CGlobal::PRODUCT_NOT_BLOCK;

        //check lại xem SP co phai cua Shop nay ko
        $id_hiden = Request::get('id_hiden',0);
        $product_id = ($id >0)? $id: $id_hiden;

        //danh sach NCC cua shop
        //$arrNCC = ($shopVip == 1)?Provider::getListProviderByShopId($this->inforUserShop->shop_id): array();

        //lay lai vi tri sap xep cua anh khac
        $arrInputImgOther = array();
        $getImgOther = Request::get('img_other',array());
        if(!empty($getImgOther)){
            foreach($getImgOther as $k=>$val){
                if($val !=''){
                    $arrInputImgOther[] = $val;
                    //show ra anh da Upload neu co loi
                    $url_thumb = ThumbImg::getImageThumb(CGlobal::FOLDER_PRODUCT, $product_id, $val, CGlobal::sizeImage_100);
                    $url_thumb_content = ThumbImg::getImageThumb(CGlobal::FOLDER_PRODUCT, $product_id, $val, CGlobal::sizeImage_600);
                    $arrViewImgOther[] = array('img_other'=>$val,'src_img_other'=>$url_thumb,'src_thumb_content'=>$url_thumb_content);
                }
            }
        }
        if (!empty($arrInputImgOther) && count($arrInputImgOther) > 0) {
            //neu ko co anh chinh, lay anh chinh la cai anh dau tien
            if($dataSave['product_image'] == ''){
                $dataSave['product_image'] = $arrInputImgOther[0];
            }
            //neu ko co anh hove, lay anh hove la cai anh dau tien
            if($dataSave['product_image_hover'] == ''){
                $dataSave['product_image_hover'] = (isset($arrInputImgOther[1]))?$arrInputImgOther[1]:$arrInputImgOther[0];
            }
            $dataSave['product_image_other'] = serialize($arrInputImgOther);
        }

        //FunctionLib::debug($dataSave);
        if($this->validInforProduct($dataSave) && empty($this->error)) {
            $dataSave['category_name'] = Category::getCategoryNameByID($dataSave['category_id']);
            if($product_id > 0) {
                //cap nhat
                $dataSave['time_update'] = time();
                $dataSave['user_id_update'] =  !empty($this->user)? $this->user['user_id']: 0;
                $dataSave['user_name_update'] =  !empty($this->user)? $this->user['user_name']: '';
                if(Product::updateData($product_id, $dataSave)) {
                    return Redirect::route('admin.productView');
                }
            } else {
                //them moi
                $dataSave['time_created'] = time();
                $dataSave['user_id_creater'] =  !empty($this->user)? $this->user['user_id']: 0;
                $dataSave['user_name_creater'] =  !empty($this->user)? $this->user['user_name']: '';
                $submit = Product::addData($dataSave);
                if($submit) {
                    return Redirect::route('admin.productView');
                }else{
                    $this->error[] = $submit;
                }
            }
        }

        //FunctionLib::debug($dataSave);
        //$optionNCC = FunctionLib::getOption(array(-1=>'---Chọn nhà cung cấp ----') + $arrNCC, $dataSave['provider_id']);
        $optionCategory = FunctionLib::getOption(array(-1=>'---Chọn danh mục----') + $this->arrCategory,$dataSave['category_id']);
        $optionStatus = FunctionLib::getOption($this->arrStatus,$dataSave['product_status']);
        $optionTypePrice = FunctionLib::getOption($this->arrTypePrice,$dataSave['product_type_price']);
        $optionTypeProduct = FunctionLib::getOption($this->arrTypeProduct,$dataSave['product_is_hot']);
        $optionDepart = FunctionLib::getOption(array(-1=>'---Chọn chuyên mục----') + $this->arrDepart,$dataSave['depart_id']);
        $optionIsSale = FunctionLib::getOption($this->arrIsSale,$dataSave['is_sale']);

        $this->layout->content = View::make('admin.Product.add')
            ->with('error', $this->error)
            ->with('id', $product_id)
            ->with('data', $dataSave)
            ->with('arrViewImgOther', $arrViewImgOther)
            ->with('imagePrimary', $imagePrimary)
            ->with('imageHover', $imageHover)

            ->with('optionCategory', $optionCategory)
            ->with('optionIsSale', $optionIsSale)
            ->with('optionDepart', $optionDepart)
            ->with('optionStatus', $optionStatus)
            ->with('optionTypePrice', $optionTypePrice)
            ->with('optionTypeProduct', $optionTypeProduct);
    }
    private function validInforProduct($data=array()) {
        if(!empty($data)) {
            if(isset($data['product_name']) && trim($data['product_name']) == '') {
                $this->error[] = 'Tên sản phẩm không được bỏ trống';
            }
            if(isset($data['product_image']) && trim($data['product_image']) == '') {
                $this->error[] = 'Chưa up ảnh sản phẩm';
            }
            if(isset($data['category_id']) && $data['category_id'] == -1) {
                $this->error[] = 'Chưa chọn danh mục';
            }
            if(isset($data['depart_id']) && $data['depart_id'] == -1) {
                $this->error[] = 'Chưa chọn chuyên mục';
            }
            if(isset($data['product_type_price']) && $data['product_type_price'] == CGlobal::TYPE_PRICE_NUMBER) {
                if(isset($data['product_price_sell']) && $data['product_price_sell'] <= 0) {
                    $this->error[] = 'Chưa nhập giá bán';
                }
            }
            return true;
        }
        return false;
    }

    //ajax
    public function deleteMultiProduct(){
        $data = array('isIntOk' => 0);
        if(!$this->is_root && !in_array($this->permission_full,$this->permission) && !in_array($this->permission_delete,$this->permission)){
            return Response::json($data);
        }
        $dataId = Request::get('dataId',array());
        $arrData['isIntOk'] = 0;
        if(empty($dataId)) {
            return Response::json($data);
        }
        if(sizeof($dataId) > 0){
            foreach($dataId as $k =>$id){
                if ($id > 0 && Product::deleteData($id)) {
                    $data['isIntOk'] = 1;
                }
            }
        }
        return Response::json($data);
    }

    public function setStastusBlockProduct(){
        $data = array('isIntOk' => 0);
        if(!$this->is_root && !in_array($this->permission_full,$this->permission) && !in_array($this->permission_delete,$this->permission)){
            return Response::json($data);
        }
        $valueInput = (int)Request::get('valueInput',-1);
        $dataId = Request::get('dataId',array());
        $arrData['isIntOk'] = 0;
        if(empty($dataId)) {
            return Response::json($data);
        }
        if(sizeof($dataId) > 0 && $valueInput > -1){
            $arrUpdate = array();
            switch( $valueInput ) {
                case 0://ẩn sản phẩm
                case 1://hiển thị sản phẩm
                    $arrUpdate['product_status'] = $valueInput;
                    break;
                case 2://Khóa sản phẩm
                case 3://Mở khóa sản phẩm
                    $arrUpdate['is_block'] = ($valueInput == 2)? CGlobal::PRODUCT_BLOCK : CGlobal::PRODUCT_NOT_BLOCK;
                    break;
                case 4://Set top san phẩm
                    $arrUpdate['time_update'] = time();
                    break;
                /**
                 * product_is_hot
                 *  5 => 'Sản phẩm bình thường',
                    6 => 'Sản phẩm nổi bật',
                    7 => 'Sản phẩm giảm giá',
                 */
                case 5:
                case 6:
                case 7:
                    $product_is_hot = CGlobal::PRODUCT_NOMAL;
                    if($valueInput == 6){
                        $product_is_hot = CGlobal::PRODUCT_HOT;
                    }elseif($valueInput == 7){
                        $product_is_hot = CGlobal::PRODUCT_SELLOFF;
                    }
                    $arrUpdate['product_is_hot'] = $product_is_hot;
                    break;
                default:
                    break;
            }
            if(sizeof($arrUpdate) > 0){
                foreach($dataId as $k =>$id){
                    if ($id > 0 && Product::updateData($id,$arrUpdate)) {
                        $data['isIntOk'] = 1;
                    }
                }
            }
        }
        return Response::json($data);
    }
}