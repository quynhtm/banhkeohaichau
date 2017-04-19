<?php

class SiteOrderController extends BaseSiteController
{
    public function __construct(){
        parent::__construct();
        FunctionLib::site_css('font-awesome/4.2.0/css/font-awesome.min.css', CGlobal::$POS_HEAD);
    }

    private $str_field_product_get = '';


	/*********************************************************************************************************************************
	 * Phần đặt hàng
	 *********************************************************************************************************************************
	 */
	public function ajaxAddCart(){
		
		if(empty($_POST)){
			return Redirect::route('site.home');
		}
		
		$pid = (int)Request::get('pid');
		$pnum = (int)Request::get('pnum');
		$data = array();
		
		if($pid > 0 && $pnum > 0){
			$result = Product::getProductByID($pid);
			//Tam Het Hang
			if($result->is_sale != CGlobal::PRODUCT_IS_SALE){
				echo 'Tạm hết hàng!'; exit();
			}
			if($result->is_block == CGlobal::PRODUCT_BLOCK){
				echo 'Sản phẩm đang bị khóa!'; exit();
			}
			//Tam Het Hang
			if(sizeof($result) != 0){
				if(Session::has('cart')){
					$data = Session::get('cart');
					if(isset($data[$pid])){
						$data[$pid] += $pnum;
						if($data[$pid] > CGlobal::max_num_buy_item_product){
							$data[$pid] = CGlobal::max_num_buy_item_product;
						}
					}else{
						$data[$pid] = 1;
					}
				}else{
					$data[$pid] = 1;
				}
				Session::put('cart', $data, 60*24);
				echo 1;
			}else{
				if(Session::has('cart')){
					$data = Session::get('cart');
					if(isset($data[$pid])){
						unset($data[$pid]);
					}
					Session::put('cart', $data, 60*24);
				}
				echo 'Không tồn tại sản phẩm!';
			}

			Session::save();
		}
		exit();
	}
    public function listCartOrder(){
    	$meta_title = $meta_keywords = $meta_description = 'Thông tin giỏ hàng';
    	$meta_img = '';
    	FunctionLib::SEO($meta_img, $meta_title, $meta_keywords, $meta_description);

    	$dataCart = array();
    	//Update Cart
    	if(!empty($_POST)){
    		$token = Request::get('_token', '');
    		if(Session::token() === $token){
    			$updateCart = Request::get('listCart', array());
    			$dataCart = Session::get('cart');
    			foreach($updateCart as $k=>$v){
	    			if($v == 0){
	    				if(isset($dataCart[$k])){
	    					unset($dataCart[$k]);
	    				}
	    				if(empty($dataCart[$k])){
	    					unset($dataCart[$k]);
	    				}
	    			}else{
	    				if(isset($dataCart[$k])){
	    					$dataCart[$k] = $v;
	    					if($dataCart[$k] > CGlobal::max_num_buy_item_product){
	    						$dataCart[$k] = CGlobal::max_num_buy_item_product;
	    					}
	    				}
	    			}
    			}
    	
    			Session::put('cart', $dataCart);
    			Session::save();
    			unset($_POST);
    			return Redirect::route('site.listCartOrder');
    		}
    	}
    	//End Update Cart
    	
    	if(Session::has('cart')){
    		$dataCart = Session::get('cart');
    	}
    	//Config Page
    	$pageNo = (int) Request::get('page', 1);
    	$pageScroll = CGlobal::num_scroll_page;
    	$limit = CGlobal::number_show_30;
    	$offset = ($pageNo - 1) * $limit;
    	$search = $dataItem = array();
    	$total = 0;
    	$paging = '';
    	
    	if(!empty($dataCart)){
    		$arrId = array_keys($dataCart);
    		$paging = '';
    		if(!empty($arrId)){
    			$search['product_id'] = $arrId;
    			$search['field_get'] = $this->str_field_product_get;
    			$dataItem = Product::searchByConditionSite($search, $limit, $offset, $total);
    			$paging = $total > 0 ? Pagging::getNewPager($pageScroll, $pageNo, $total, $limit, $search) : '';
    		}
    	}

        $this->header(0);
    	$this->layout->content = View::make('site.SiteOrder.listCartOrder')
    	->with('dataCart',$dataCart)
    	->with('dataItem',$dataItem)
    	->with('paging',$paging);
    	$this->footer();
 
    }
    public function deleteOneItemInCart(){
    
    	if(empty($_POST)){
    		return Redirect::route('site.home');
    	}
    
    	$id = (int)Request::get('id', 0);
    	if($id > 0){
    		if(Session::has('cart')){
    			$data = Session::get('cart');
    			if(isset($data[$id])){
    				unset($data[$id]);
    			}
    			Session::put('cart', $data, 60*24);
    			Session::save();
    		}
    	}
    	echo 'ok';exit();
    }
    public function deleteAllItemInCart(){
    	if(empty($_POST)){
    		return Redirect::route('site.home');
    	}
    	$dell = addslashes(Request::get('delAll', ''));
    	if($dell == 'delAll'){
    		if(Session::has('cart')){
    			Session::forget('cart');
    			Session::save();
    		}
    	}
    	echo 'ok';exit();
    }
    public function sendCartOrder(){
    	$meta_title = $meta_keywords = $meta_description = 'Gửi thông tin đơn hàng';
    	$meta_img = '';
    	FunctionLib::SEO($meta_img, $meta_title, $meta_keywords, $meta_description);

    	if(!Session::has('cart')){
    		return Redirect::route('site.home');
    	}
        $this->user_customer = Session::get('user_customer');

        $dataCart = $arrId = $search = $dataItem = array();

    	if(Session::has('cart')){
    		$dataCart = Session::get('cart');
    	}
        //FunctionLib::debug($dataCart);die;
    	if(!empty($dataCart)){
    		$arrId = array_keys($dataCart);
    		if(!empty($arrId)){
    			$search['product_id'] = $arrId;
    			$search['field_get'] = $this->str_field_product_get;
    			$dataItem = Product::getAllCartProduct($search);
    		}
    	}
    	
    	if(!empty($_POST) && sizeof($arrId) > 0){
    		$token = Request::get('_token', '');
    		if(Session::token() === $token){
    			$txtName = addslashes(Request::get('txtName', ''));
    			$txtMobile = addslashes(Request::get('txtMobile', ''));
    			$txtEmail = addslashes(Request::get('txtEmail', ''));
    			$txtAddress = addslashes(Request::get('txtAddress', ''));
    			$txtMessage = addslashes(Request::get('txtMessage', ''));
    			//Check Mail Regex
    			$regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
    			if(!preg_match($regex, $txtEmail)){
    				$txtEmail = '';	
    			}
    			
    			if($txtName!= '' && $txtMobile != '' && $txtAddress != ''){
                    $arrOrderProductId = $arrId;
                    $total_money = $total_product = 0;
                    $productOrder = $dataOrder = array();
                    if(sizeof($arrOrderProductId) > 0){
                        $arrProductId = array();
                        if(!empty($arrOrderProductId)){
                            foreach($arrOrderProductId as $pro){
                                $arrProductId[] = (int)trim($pro);
                            }
                        }
                        if(!empty($arrProductId)){
                            $field_get = array('product_id','product_code', 'product_name', 'category_name','category_id', 'product_image',
                                'product_price_sell', 'product_price_market', 'product_price_input', 'product_price_provider_sell','product_type_price',);
                            $inforProduct = Product::getProductByArrayProId($arrProductId,$field_get);

                            if(!empty($inforProduct)){
                                foreach($inforProduct as $k => $pro){
                                    $number_buy = isset($dataCart[$pro->product_id]) ? (int)$dataCart[$pro->product_id] : 0;
                                    $total_product +=  $number_buy;
                                    $total_money += $number_buy*$pro->product_price_sell;
                                    $productOrder[$pro->product_id] = array(
                                        'product_id'=>$pro->product_id,
                                        'product_name'=>$pro->product_name,
                                        'product_price_sell'=>$pro->product_price_sell,
                                        'product_price_input'=>$pro->product_price_input,
                                        'product_category_id'=>$pro->product_category_id,
                                        'product_category_name'=>$pro->product_category_name,
                                        'product_type_price'=>$pro->product_type_price,
                                        'number_buy'=> $number_buy,
                                        'product_image'=>$pro->product_image,
                                        'product_category_id'=>$pro->category_id,
                                        'product_category_name'=>$pro->category_name,
                                    );
                                }
                            }
                        }

                        $dataUserOrder = array(
                            'order_customer_name'=>$txtName,
                            'order_customer_phone'=>$txtMobile,
                            'order_customer_email'=>$txtEmail,
                            'order_customer_address'=>$txtAddress,
                            'order_customer_note'=>$txtMessage,
                            'order_product_id'=>implode(',', $arrId),
                            'order_total_buy'=>$total_product,
                            'order_total_money'=>$total_money,
                            'order_type' => CGlobal::order_type_site,
                            'order_time_creater'=>time(),
                            'order_status'=>CGlobal::ORDER_STATUS_NEW,
                        );

                        $order_id = Order::addData($dataUserOrder);
                        foreach($productOrder as $key => $item){
                            $item['order_id'] = $order_id;
                            OrderItem::addData($item);
                            $dataOrder[] = $item;
                        }
                    }

					//Gui Mail cho Khach Mua Hang
					if($txtEmail != '' && sizeof($dataItem) > 0){
						$dataCustomer = array(
							'txtName'=>$txtName,
							'txtMobile'=>$txtMobile,
							'txtEmail'=>$txtEmail,
							'txtAddress'=>$txtAddress,
							'txtMessage'=>$txtMessage,
							'dataItem'=>$dataOrder,
						);
						$emailsCustomerShop = [$txtEmail];
						Mail::send('emails.SendOrderToMailCustomer', array('data'=>$dataCustomer), function($message) use ($emailsCustomerShop){
							$message->to($emailsCustomerShop, 'OrderToCustomer')
									->subject(CGlobal::web_name.' - Bạn đã đặt mua sản phẩm '.date('d/m/Y h:i',  time()));
						});
					}

    				if(Session::has('cart')){
    					Session::forget('cart');
    					return Redirect::route('site.thanksBuy');
    				}
    			}
    		}
    	}

        $this->header();
    	$this->layout->content = View::make('site.SiteOrder.sendCartOrder')
    	->with('dataCart',$dataCart)
    	->with('dataItem',$dataItem)
        ->with('user_customer', $this->user_customer);
    	$this->footer();
    }
    public function thanksBuy(){
    	
    	$meta_title = $meta_keywords = $meta_description = 'Cảm ơn bạn đã mua hàng';
    	$meta_img = '';
    	FunctionLib::SEO($meta_img, $meta_title, $meta_keywords, $meta_description);
    	
    	$this->header();
    	$this->layout->content = View::make('site.SiteOrder.thanksBuy');
    	$this->footer();
    }
    public function historyBuy(){
        if(!Session::has('user_customer')){
            return Redirect::route('site.home');
        }

        $meta_title = $meta_keywords = $meta_description = 'Lịch sử mua hàng';
        $meta_img = '';
        FunctionLib::SEO($meta_img, $meta_title, $meta_keywords, $meta_description);

        $messages = '';
        $this->user_customer = Session::get('user_customer');
        $data = array();

        $pageNo = (int) Request::get('page_no',1);
        $limit = CGlobal::number_limit_show;
        $offset = ($pageNo - 1) * $limit;
        $search = $data = array();
        $total = 0;

        $search['order_customer_phone'] = isset($this->user_customer['customer_phone'])? $this->user_customer['customer_phone'] : '';
        $search['order_customer_email'] = isset($this->user_customer['customer_email'])? $this->user_customer['customer_email'] : '';

        if($search['order_customer_phone'] != '' && $search['order_customer_email'] != '') {
            $data = Order::searchByCondition($search, $limit, $offset, $total);
            $paging = $total > 0 ? Pagging::getNewPager(3, $pageNo, $total, $limit, $search) : '';
        }

        $this->header();
        $this->layout->content = View::make('site.CustomerLayouts.HistoryBuy')
                                ->with('messages',$messages)
                                ->with('user_customer',$this->user_customer)
                                ->with('data',$data)
                                ->with('total', $total)
                                ->with('stt', ($pageNo-1)*$limit)
                                ->with('paging', $paging);
        $this->footer();
    }
    public function favoriteProduct(){
        echo "Updating...";die;
    }
}

