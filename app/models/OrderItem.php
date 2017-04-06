<?php
/*
* @Created by: HSS
* @Author    : nguyenduypt86@gmail.com
* @Date      : 06/2016
* @Version   : 1.0
*/
class OrderItem extends Eloquent
{
    protected $table = 'web_order_item';
    protected $primaryKey = 'order_item_id';
    public $timestamps = false;

    //cac truong trong DB
    protected $fillable = array('order_item_id','order_id',
        'product_id', 'product_name', 'product_price_sell',
        'product_price_input', 'product_image', 'product_category_id',
        'product_category_name', 'product_type_price', 'product_province', 'product_provider', 'number_buy');

    public function order()
    {
        return $this->belongsTo('Order');
    }

    public static function getByID($id) {
        $admin = OrderItem::where('order_item_id', $id)->first();
        return $admin;
    }


    public static function getOrderAll() {
        $categories = OrderItem::where('order_item_id', '>', 0)->get();
        $data = array();
        foreach($categories as $itm) {
            $data[$itm['order_item_id']] = $itm['order_product_name'];
        }
        return $data;
    }

    public static function searchByCondition($dataSearch = array(), $limit =0, $offset=0, &$total){

        try{
            $query = OrderItem::where('order_item_id','>',0);
            if (isset($dataSearch['order_product_name']) && $dataSearch['order_product_name'] != '') {
                $query->where('order_product_name','LIKE', '%' . $dataSearch['order_product_name'] . '%');
            }
            if (isset($dataSearch['order_customer_name']) && $dataSearch['order_customer_name'] != '') {
                $query->where('order_customer_name','LIKE', '%' . $dataSearch['order_customer_name'] . '%');
            }
            if (isset($dataSearch['order_customer_phone']) && $dataSearch['order_customer_phone'] != '') {
                $query->where('order_customer_phone','LIKE', '%' . $dataSearch['order_customer_phone'] . '%');
            }
            if (isset($dataSearch['order_customer_email']) && $dataSearch['order_customer_email'] != '') {
                $query->where('order_customer_email','LIKE', '%' . $dataSearch['order_customer_email'] . '%');
            }
            if (isset($dataSearch['time_start_time']) && $dataSearch['time_start_time'] != '') {
                $query->where('order_time','>=' . strtotime($dataSearch['time_start_time']));
            }
            if (isset($dataSearch['time_end_time']) && $dataSearch['time_end_time'] != '') {
                $query->where('order_time','<=' . strtotime($dataSearch['time_end_time']));
            }
            if (isset($dataSearch['order_status']) && $dataSearch['order_status'] != -1) {
                $query->where('order_status', $dataSearch['order_status']);
            }
            if (isset($dataSearch['order_user_shop_id']) && $dataSearch['order_user_shop_id'] != -1) {
                $query->where('order_user_shop_id', $dataSearch['order_user_shop_id']);
            }
            $total = $query->count();
            $query->orderBy('order_item_id', 'desc');

            //get field can lay du lieu
            $fields = (isset($dataSearch['field_get']) && trim($dataSearch['field_get']) != '') ? explode(',',trim($dataSearch['field_get'])): array();
            if(!empty($fields)){
                $result = $query->take($limit)->skip($offset)->get($fields);
            }else{
                $result = $query->take($limit)->skip($offset)->get();
            }

            return $result;

        }catch (PDOException $e){
            throw new PDOException();
        }
    }

    /**
     * @desc: Tao Data.
     * @param $data
     * @return bool
     * @throws PDOException
     */
    public static function addData($dataInput)
    {
        try {
            DB::connection()->getPdo()->beginTransaction();
            $data = new OrderItem();
            if (is_array($dataInput) && count($dataInput) > 0) {
                foreach ($dataInput as $k => $v) {
                    $data->$k = $v;
                }
            }
            if ($data->save()) {
                DB::connection()->getPdo()->commit();
                return $data->order_item_id;
            }
            DB::connection()->getPdo()->commit();
            return false;
        } catch (PDOException $e) {
            DB::connection()->getPdo()->rollBack();
            throw new PDOException();
        }
    }

    /**
     * @desc: Update du lieu
     * @param $id
     * @param $data
     * @return bool
     * @throws PDOException
     */
    public static  function updateData($id, $dataInput)
    {
        try {
            DB::connection()->getPdo()->beginTransaction();
            $dataSave = OrderItem::find($id);
            if (!empty($dataInput)){
                $dataSave->update($dataInput);
            }
            DB::connection()->getPdo()->commit();
            return $dataSave->order_item_id;
        } catch (PDOException $e) {
            DB::connection()->getPdo()->rollBack();
            throw new PDOException();
        }
    }

    /**
     * @desc: Update Data.
     * @param $id
     * @param $status
     * @return bool
     * @throws PDOException
     */
    public static function deleteData($id){
        try {
            DB::connection()->getPdo()->beginTransaction();
            $dataSave = OrderItem::find($id);
            $dataSave->delete();
            DB::connection()->getPdo()->commit();
            return true;
        } catch (PDOException $e) {
            DB::connection()->getPdo()->rollBack();
            throw new PDOException();
        }
    }

}