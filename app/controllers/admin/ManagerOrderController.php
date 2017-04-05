<?php
/*
* @Author    : QuynhTM
* @Date      : 06/2016
* @Version   : 1.0
*/
class ManagerOrderController extends BaseAdminController
{
    private $permission_view = 'managerOrder_view';
    private $permission_full = 'managerOrder_full';
    private $permission_delete = 'managerOrder_delete';
    private $permission_create = 'managerOrder_create';
    private $permission_edit = 'managerOrder_edit';
    private $permission_view_detail = 'managerOrder_view_detail';
    private $arrStatus = array(-1 => 'Chọn trạng thái', CGlobal::status_hide => 'Ẩn', CGlobal::status_show => 'Hiện');

    private $arrCodOder = array(
        CGlobal::order_cod_chuagiao => 'Chưa giao hàng',//0
        CGlobal::order_cod_da_gan => 'Cod đang giữ hàng',//1
        CGlobal::order_cod_danggiao => 'Đang giao hàng',//2
        CGlobal::order_cod_da_giaohang => 'Đã giao hàng',//3
        CGlobal::order_cod_hoantra => 'Cod hoàn trả');//4
        //
    private $arrStatusOder = array(
        CGlobal::order_status_new => 'Đơn hàng mới',//1
        CGlobal::order_status_confirm => 'Đơn hàng đã xác nhận',//2
        CGlobal::order_status_succes => 'Đơn hàng hoàn thành',//3
        CGlobal::order_status_remove => 'Đơn hàng hủy');//4

    private $arrTypeOder = array(
        CGlobal::order_type_site => 'Đặt mua từ site',//0
        CGlobal::order_type_shop => 'Mua từ hệ thống bán hàng');//1

    public function __construct()
    {
        parent::__construct();

        //Include javascript.
        FunctionLib::link_js(array(
            'lib/ckeditor/ckeditor.js',
            'lib/ckeditor/config.js',
            'admin/js/admin.js',
            'admin/js/order.js',
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

        $search['order_id'] = addslashes(Request::get('order_id',''));
        $search['order_product_name'] = addslashes(Request::get('order_product_name',''));
        $search['order_customer_name'] = addslashes(Request::get('order_customer_name',''));
        $search['order_customer_phone'] = addslashes(Request::get('order_customer_phone',''));
        $search['order_customer_email'] = addslashes(Request::get('order_customer_email',''));
        $search['time_start_time'] = addslashes(Request::get('time_start_time',''));
        $search['time_end_time'] = addslashes(Request::get('time_end_time',''));
        $search['order_status'] = (int)Request::get('order_status',-1);
        $search['order_user_shop_id'] = (int)Request::get('order_user_shop_id',-1);

        $data = Order::searchByCondition($search, $limit, $offset,$total);
        $paging = $total > 0 ? Pagging::getNewPager(3, $pageNo, $total, $limit, $search) : '';
        //FunctionLib::debug($data);

        $arrStatusOrder = array(-1 => '---- Trạng thái đơn hàng ----',
            CGlobal::ORDER_STATUS_NEW => 'Đơn hàng mới',
            CGlobal::ORDER_STATUS_CHECKED => 'Đơn hàng đã xác nhận',
            CGlobal::ORDER_STATUS_SUCCESS => 'Đơn hàng thành công',
            CGlobal::ORDER_STATUS_CANCEL => 'Đơn hàng hủy');
        $optionStatus = FunctionLib::getOption($arrStatusOrder, $search['order_status']);

        $this->layout->content = View::make('admin.ManagerOrder.view')
            ->with('paging', $paging)
            ->with('stt', ($pageNo-1)*$limit)
            ->with('total', $total)
            ->with('sizeShow', count($data))
            ->with('data', $data)
            ->with('search', $search)
            ->with('optionStatus', $optionStatus)
            ->with('arrStatus', $arrStatusOrder)

            ->with('is_root', $this->is_root)//dùng common
            ->with('permission_full', in_array($this->permission_full, $this->permission) ? 1 : 0)//dùng common
            ->with('permission_delete', in_array($this->permission_delete, $this->permission) ? 1 : 0)//dùng common
            ->with('permission_create', in_array($this->permission_create, $this->permission) ? 1 : 0)//dùng common
            ->with('permission_view_detail', in_array($this->permission_view_detail, $this->permission) ? 1 : 0)//dùng common
            ->with('permission_edit', in_array($this->permission_edit, $this->permission) ? 1 : 0);//dùng common
    }

    public function detailOrder($order_id=0) {
        if(!$this->is_root && !in_array($this->permission_full,$this->permission) && !in_array($this->permission_view_detail,$this->permission)){
            return Redirect::route('admin.dashboard',array('error'=>1));
        }
        $data = array();
        if($order_id > 0) {
            $data = Order::getOrderById($order_id);
            if(!$data){
                return Redirect::route('admin.managerOrderView');
            }
        }
        $this->layout->content = View::make('admin.ManagerOrder.detailOrder')
            ->with('id', $order_id)
            ->with('data', $data)
            ->with('arrCodOder', $this->arrCodOder)
            ->with('arrStatusOder', $this->arrStatusOder)
            ->with('arrTypeOder', $this->arrTypeOder)
            ->with('arrStatus', $this->arrStatus);
    }

    public function getOrder($order_id=0) {
        if(!$this->is_root && !in_array($this->permission_full,$this->permission) && !in_array($this->permission_edit,$this->permission) && !in_array($this->permission_create,$this->permission)){
            return Redirect::route('admin.dashboard',array('error'=>1));
        }
        $data = array();
        if($order_id > 0) {
            $data = Order::getOrderById($order_id);
        }
        $optionCodOder = FunctionLib::getOption($this->arrCodOder, CGlobal::order_cod_chuagiao);
        $optionStatusOder = FunctionLib::getOption($this->arrStatusOder, CGlobal::order_status_new);
        $optionTypeOder = FunctionLib::getOption($this->arrTypeOder, CGlobal::order_type_shop);

        $this->layout->content = View::make('admin.ManagerOrder.addOrder')
            ->with('id', $order_id)
            ->with('data', $data)
            ->with('arrCodOder', $this->arrCodOder)
            ->with('arrStatusOder', $this->arrStatusOder)
            ->with('arrTypeOder', $this->arrTypeOder)
            ->with('optionCodOder', $optionCodOder)
            ->with('optionStatusOder', $optionStatusOder)
            ->with('optionTypeOder', $optionTypeOder)
            ->with('arrStatus', $this->arrStatus);
    }
    //load ajax
    public function getInforProduct() {
        if(!$this->is_root && !in_array($this->permission_full,$this->permission) && !in_array($this->permission_edit,$this->permission) && !in_array($this->permission_create,$this->permission)){
            return Redirect::route('admin.dashboard',array('error'=>1));
        }
        $inforProduct = array();
        $order_product_id = Request::get('order_product_id','');

        if($order_product_id != ''){
            $arrOrderProductId = explode(',',$order_product_id);
            $arrProductId = array();
            if(!empty($arrOrderProductId)){
                foreach($arrOrderProductId as $pro){
                    $arrProductId[] = (int)trim($pro);
                }
            }
            if(!empty($arrProductId)){
                $field_get = array('product_id','product_code', 'product_name', 'category_name','category_id',
                    'product_price_sell', 'product_price_market', 'product_price_input', 'product_price_provider_sell','product_type_price',);
                $inforProduct = Product::getProductByArrayProId($arrProductId,$field_get);
            }
            //FunctionLib::debug($inforProduct);
        }
        if($inforProduct){
            $html = View::make('admin.ManagerOrder.listInforProduct')->with('inforProduct', $inforProduct)->render();
            $arrAjax = array('intReturn' => 1, 'html' => $html);
        }else{
            $arrAjax = array('intReturn' => -1, 'msg' => 'Không có danh sách sale');
        }

        return Response::json($arrAjax);
    }

    public function deleteOrderShop(){
        $data = array('isIntOk' => 0);
        if(!$this->is_root){
            return Response::json($data);
        }
        $id = (int)Request::get('id', 0);
        if ($id > 0 && Order::deleteData($id)) {
            $data['isIntOk'] = 1;
        }
        return Response::json($data);
    }

    private function valid($data=array()) {
        if(!empty($data)) {
            if(isset($data['order_product_name']) && $data['order_product_name'] == '') {
                $this->error[] = 'Tên đơn hàng không được trống';
            }
            if(isset($data['order_status']) && $data['order_status'] == -1) {
                $this->error[] = 'Bạn chưa chọn trạng thái cho đơn hàng';
            }
            return true;
        }
        return false;
    }

}