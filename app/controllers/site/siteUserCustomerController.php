<?php
/*
* @Created by: DUYNX
* @Author    : nguyenduypt86@gmail.com
* @Date      : 11/2016
* @Version   : 1.0
*/
if(session_status() == PHP_SESSION_NONE){
	session_start();
}
class SiteUserCustomerController extends BaseSiteController{
    protected $user_customer = array();
	private $arrStatusProduct = array(-1 => '---- Trạng thái----',CGlobal::status_show => 'Hiển thị',CGlobal::status_hide => 'Ẩn');
	private $arrTypePrice = array(CGlobal::TYPE_PRICE_NUMBER => 'Hiển thị giá bán', CGlobal::TYPE_PRICE_CONTACT => 'Liên hệ với người đăng');
	private $arrTypeAction = array(CGlobal::ITEMS_TYPE_ACTION_1 => 'Cần bán/ Tuyển sinh', CGlobal::ITEMS_TYPE_ACTION_2 => 'Cần mua/ Tuyển dụng');
	private $error = array();

	public function __construct(){
		parent::__construct();

		if(Session::has('user_customer')){
			$this->user_customer = Session::get('user_customer');
		}

		//seo
		$meta_title = CGlobal::web_name;
		$meta_keywords = CGlobal::web_name;
		$meta_description = CGlobal::web_name;;
		$meta_img= '';
		FunctionLib::SEO($meta_img, $meta_title, $meta_keywords, $meta_description);
	}
	//Register - Login
    public function pageLogin($url=''){
    	if(Session::has('user_customer')){
    		return Redirect::route('site.home');
    	}
    	$token = addslashes(Request::get('token', ''));
    	$mail = addslashes(Request::get('sys_login_mail', ''));
    	$pass = addslashes(Request::get('sys_login_pass', ''));
    	$error = '';
    	if(Session::token() === $token){
	    	if($mail != '' && $pass != ''){
	    		$checkMail = ValidForm::checkRegexEmail($mail);
				if(!$checkMail) {
	    			$error = 'Email đăng nhập không đúng!';
	    		}else{
	    			$customer = UserCustomer::getUserCustomerByEmail($mail);
	    			if(sizeof($customer) > 0){
	    				if($customer->customer_status == CGlobal::status_hide || $customer->customer_status == CGlobal::status_block){
	    					$error = 'Tài khoản đang bị khóa!';
	    				}elseif($customer->customer_status == CGlobal::status_show){
	    					$encode_password = UserCustomer::encode_password($pass);
	    					if($customer->customer_password == $encode_password){
	    						$timeLogin = time();
	    						Session::put('user_customer', $customer, 60*24);
	    						Session::save();
	    						$dataUpdate = array(
	    								'is_login'=>CGlobal::is_login,
	    								'customer_time_login'=>$timeLogin,
	    						);
	    						UserCustomer::updateData($customer->customer_id, $dataUpdate);
	    					}else{
	    						$error = 'Mật khẩu chưa đúng!';
	    					}
	    				}
	    			}else{
	    				$error = 'Không tồn tại tên đăng nhập!';
	    			}
	    		}
	    	}else{
	    		$error = 'Thông tin đăng nhập chưa đúng!';
	    	}
    	}else{
    		$error = 'Phiên làm việc hết hạn!';
    	}
    	echo $error;die;
    }
    public function logout(){
    	if(Session::has('user_customer')){
    		$dataSess = Session::get('user_customer');
    		if(isset($dataSess['customer_id']) && (int)$dataSess['customer_id'] > 0){
    			$dataUpdate = array(
    					'is_login'=>CGlobal::not_login,
    					'customer_time_logout'=>time(),
    			);
    			UserCustomer::updateData($dataSess['customer_id'], $dataUpdate);
    		}
    		Session::forget('user_customer');
        }
        return Redirect::route('site.home');
    }
    public function pageRegister(){
    	
    	if(Session::has('user_customer')){
    		return Redirect::route('site.home');
    	}
    	
    	$token = addslashes(Request::get('token', ''));
    	$mail = addslashes(Request::get('sys_reg_email', ''));
    	$pass = addslashes(Request::get('sys_reg_pass', ''));
    	$repass = addslashes(Request::get('sys_reg_re_pass', ''));
    	$fullname = addslashes(Request::get('sys_reg_full_name', ''));
    	$phone = addslashes(Request::get('sys_reg_phone', ''));
    	$address = addslashes(Request::get('sys_reg_address', ''));
    	$error = '';
    	$hash_pass = '';
    	
    	if(Session::token() === $token){
    		//Mail
    		if($mail != ''){
	    		$checkMail = ValidForm::checkRegexEmail($mail);
	    		if(!$checkMail) {
	    			$error .= 'Email đăng nhập không đúng!';
	    		}
    		}else{
    			$error .= 'Email đăng nhập không được trống!';
    		}
    		//Pass
    		if($pass != '' && ($pass === $repass)){
    			$check_valid_pass = ValidForm::checkRegexPass($pass, 5);
    			if($check_valid_pass){
    				$hash_pass = UserCustomer::encode_password($pass);
    			}else{
    				$error .= 'Mật không được ít hơn 5 ký tự và không được có dấu!'.'<br/>';
    			}
    		}
    		if($pass == '' && $repass == ''){
    			$error .= 'Mật khẩu không được trống!'.'<br/>';
    		}elseif($pass != $repass){
    			$error .= 'Mật khẩu không khớp!'.'<br/>';
    		}
    		
    		//Check Member Exists
    		$check = UserCustomer::getUserCustomerByEmail($mail);
    		if(sizeof($check) > 0){
    			$error .= 'Email đăng nhập này đã tồn tại!'.'<br/>';
    		}else{
				if($mail != '' && $pass != '' && $repass != '' && $fullname != '' && $phone != '' && $address != ''){
					if($error == ''){
						$data = array(
							'customer_email'=>$mail,
							'customer_password'=>$hash_pass,
							'customer_name'=>$fullname,
							'customer_phone'=>$phone,
							'customer_address'=>$address,
							'customer_time_created'=>time(),
							'is_login'=>1,
							'customer_time_login'=>time(),
							'is_customer' => CGlobal::CUSTOMER_FREE,
							'customer_status'=>CGlobal::status_show,
						);
						$id = UserCustomer::addData($data);
						//Send mail active
						if($id > 0){
							//tam thời cho login luôn
							$customer = UserCustomer::getByID($id);
							Session::put('user_customer', $customer, 60*24);
							Session::save();

							$key_secret = base64_encode($mail .'/'.$phone.'/'.$id);
							$emails = [$mail, CGlobal::emailAdmin];
							$dataTheme = array(
									'key_secret'=>$key_secret,
									'customer_email'=>$mail,
									'customer_password'=>$pass,
									'customer_name'=>$fullname,
							);
							Mail::send('emails.userCustomerRegister', array('data'=>$dataTheme), function($message) use ($emails){
								$message->to($emails, 'user_customer')
										->subject('Kích hoạt tài khoản trên website '.CGlobal::web_name.' '.date('d/m/Y h:i',  time()));
							});
						}
					}
				}else{
					$error .= 'Thông tin đăng ký chưa đầy đủ!';
				}
			}
    	}else{
    		$error .= 'Phiên làm việc hết hạn. Bạn refresh lại trang web!';
    	}
    	echo $error;die;
    }
    public function pageActiveRegister(){
    	$key = Request::get('k', '');
    	if($key != ''){
    		$strKey = base64_decode($key);
    		$arrKey = explode('/', $strKey);
    		if(count($arrKey) == 3){
    			$customer_id =  (int)$arrKey[2];
    			$dataUpdate = array(
    					'customer_status'=>CGlobal::status_show,
    					'is_login'=>CGlobal::is_login,
    					'customer_time_active'=>time(),
    					'customer_time_login'=>time(),
    			);
    			UserCustomer::updateData($customer_id, $dataUpdate);
    			$customer = UserCustomer::getByID($customer_id);
    			if(sizeof($customer) > 0){
    				Session::put('user_customer', $customer, 60*24);
    				Session::save();
    				FunctionLib::messages('messages', 'Kích hoạt tài khoản thành công!', 'success');
    				return Redirect::route('site.home');
    			}
    		}
    	}
    	echo "Liên kết kích hoạt tài khoản không đúng!";die;
    }
	//Change Info - Chage Pass
	public function pageChageInfo(){
		if(!Session::has('user_customer')){
    		return Redirect::route('site.home');
    	}
		$this->header();
        $dataShow = $dataNew = array();
		$messages = '';
		$this->user_customer = $dataShow = Session::get('user_customer');

		$customer_province_id = isset($this->user_customer['customer_province_id'])?$this->user_customer['customer_province_id']: 0;
		$customer_district = isset($this->user_customer['customer_district_id'])?$this->user_customer['customer_district_id']: 0;
		//khi sửa thông tin KH
		if(isset($_POST) && !empty($_POST) && !empty($this->user_customer)){
			$token = Request::get('_token', '');
			$dataUpdate['customer_name'] = Request::get('customer_name', '');
			$dataUpdate['customer_phone'] = Request::get('customer_phone', '');
			$customer_email = Request::get('customer_email', '');
			$dataUpdate['customer_show_email'] = Request::get('customer_show_email', 0);
			$dataUpdate['customer_address'] = Request::get('customer_address', '');
			$dataUpdate['customer_birthday'] = Request::get('customer_birthday', '');
			$dataUpdate['customer_about'] = Request::get('customer_about', '');
			$dataUpdate['customer_province_id'] = Request::get('customer_province_id', 0);
			$dataUpdate['customer_district_id'] = Request::get('customer_district_id', 0);
			$dataUpdate['customer_gender'] = Request::get('customer_gender', 0);

			$error = $this->validChageInfo($dataUpdate);
			if(Session::token() === $token){
				$sessionMail = isset($this->user_customer['customer_email']) ? $this->user_customer['customer_email']:'';
				if($sessionMail == $customer_email){
					if(!empty($error)){
						$messages = FunctionLib::alertMessage($error, 'error');
					}else{
						if(UserCustomer::updateData($this->user_customer['customer_id'],$dataUpdate)){
							$dataNew = UserCustomer::getByID($this->user_customer['customer_id']);
							Session::forget('user_customer');
							Session::put('user_customer', $dataNew, 60*24);
							Session::save();
							$messages = FunctionLib::alertMessage('Bạn đã cập nhật thành công!', 'success');
						}
					}
				}else{
					$messages = FunctionLib::alertMessage('Email của bạn không đúng!', 'error');
				}
			}
			$dataUpdate['customer_email'] = $customer_email;
            $dataShow = $dataNew;
		}
		//thong tin tinh thanh
		$province = Province::getAllProvince();
		$optionProvince = FunctionLib::getOption(array(0=>'---Chọn tỉnh thành----') + $province, $customer_province_id);
		$district = ($customer_province_id > 0)?Districts::getDistrictByProvinceId($customer_province_id): array();
		$optionDistrict = FunctionLib::getOption(array(0=>'---Chọn quận huyện----') + $district,$customer_district);

		$this->layout->content = View::make('site.CustomerLayouts.EditCustomer')
								->with('user_customer',$dataShow)
								->with('optionProvince',$optionProvince)
								->with('optionDistrict',$optionDistrict)
								->with('messages',$messages);
		$this->footer();
	}
	private function validChageInfo($data=array()) {
		$error = array();
		if(!empty($data)) {
			if(isset($data['customer_name']) && trim($data['customer_name']) == '') {
				$error[] = 'Tên khách hàng không được bỏ trống';
			}
			if(isset($data['customer_address']) && trim($data['customer_address']) == '') {
				$error[] = 'Địa chỉ không được bỏ trống';
			}
			if(isset($data['customer_phone']) && trim($data['customer_phone']) == '') {
				$error[] = 'Số điện thoại không được bỏ trống';
			}
			if(isset($data['customer_province_id']) && trim($data['customer_province_id']) == 0) {
				$error[] = 'Bạn chưa chọn tỉnh thành';
			}
			if(isset($data['customer_district_id']) && trim($data['customer_district_id']) == 0) {
				$error[] = 'Bạn chưa chọn quận huyện';
			}
		}
		return $error;
	}
	//lay thong tin quận huyện cua KH
	public function getDistrictCustomer(){
		$data = array('isIntOk' => 0,'msg' => 'Không lấy được thông tin quận huyện');
		$customer_province_id = (int)Request::get('customer_province_id', 0);
		if ($customer_province_id > 0) {
			$district = Districts::getDistrictByProvinceId($customer_province_id);
			if(!empty($district)){
				$str_option = '<option value="">Chọn quận/huyện</option>';
				foreach($district as $dis_id =>$dis_name){
					$str_option .='<option value="'.$dis_id.'">'.$dis_name.'</option>';
				}
				$data['html_option'] = $str_option;
				$data['isIntOk'] = 1;
			}
		}
		return Response::json($data);
	}
	public function pageChagePass(){
		$data = array('isIntOk' => 0,'msg' => 'Không thay đổi được pass');
		if (!UserCustomer::isLogin()) {
			return Response::json($data);
		}
		$customer_password = trim(Request::get('customer_password', ''));
		if(!empty($this->user_customer) && $customer_password != ''){
			$dataUpdate['customer_password'] = UserCustomer::encode_password($customer_password);
			if(UserCustomer::updateData($this->user_customer['customer_id'],$dataUpdate)){
				//Send mail
				if($this->user_customer['customer_email'] != ''){
					$emails = [$this->user_customer['customer_email'], CGlobal::emailAdmin];
					$dataTheme = array(
						'customer_email'=>$this->user_customer['customer_email'],
						'customer_name'=>$this->user_customer['customer_name'],
						'customer_password'=>$customer_password,
					);
					Mail::send('emails.ForgetPass', array('data'=>$dataTheme), function($message) use ($emails){
						$message->to($emails, 'mailUserCustomer')
							->subject('Thay đổi mật khẩu tại '.date('d/m/Y h:i',  time()));
					});
					$data['isIntOk'] = 1;
					$data['msg'] = 'Đã cập nhật mật khẩu thành công';
					return Response::json($data);
				}
			}
		}
	}
	public function pageForgetPass(){
		if(Session::has('user_customer')){
    		return Redirect::route('site.home');
    	}
    	$token = addslashes(Request::get('token', ''));
    	$mail = addslashes(Request::get('sys_forget_mail', ''));
		$error = '';
     	if(Session::token() === $token){
    		if($mail != ''){
    			$checkMail = ValidForm::checkRegexEmail($mail);
    			if(!$checkMail) {
    				$error .= 'Email đăng nhập không đúng!';
    			}
    		}else{
    			$error .= 'Email đăng nhập không được trống!';
    		}
    		//Check mail exists
    		$arrUser = UserCustomer::getUserCustomerByEmail($mail);
    		if(sizeof($arrUser) != 0){
    			//Send mail
    			$password = FunctionLib::randomString(5);
    			$customer_id = $arrUser->customer_id;
    			if($password != ''){
    				$dataUpdate = array(
    					'customer_password'=>UserCustomer::encode_password($password),
    				);
    				UserCustomer::updateData($customer_id, $dataUpdate);
    				//Send mail
    				$emails = [$mail, CGlobal::emailAdmin];
    				$dataTheme = array(
    						'customer_email'=>$mail,
    						'customer_name'=>$arrUser->customer_name,
    						'customer_password'=>$password,
    				);
    				Mail::send('emails.ForgetPass', array('data'=>$dataTheme), function($message) use ($emails){
    					$message->to($emails, 'mailUserCustomer')
    							->subject('Hướng dẫn thay đổi mật khẩu '.date('d/m/Y h:i',  time()));
    				});
    				echo 1; die;
    			}else{
    				$error = 'Không tồn tại chuỗi bảo mật!';
    			}
    		}
    	}else{
    		$error = 'Phiên làm việc hết hạn!';
    	}
    	
    	echo $error;die;
	}
    public function historyBuy(){
        if(!Session::has('user_customer')){
            return Redirect::route('site.home');
        }
        $this->header();
        $dataShow = array();
        $messages = '';
        $this->user_customer = Session::get('user_customer');

        $this->layout->content = View::make('site.CustomerLayouts.HistoryBuy')
                        ->with('messages',$messages)->with('user_customer',$this->user_customer);
        $this->footer();
    }
	//Login Facebook - Google
	public function loginFacebook(){
		
		$fb = new Facebook\Facebook ([
				'app_id' => CGlobal::facebook_app_id,
				'app_secret' => CGlobal::facebook_app_secret,
				'default_graph_version' => CGlobal::facebook_default_graph_version,
				'persistent_data_handler' => 'session'
				]);
			
		$helper = $fb->getRedirectLoginHelper();
			
		try{
			$accessToken = $helper->getAccessToken();
		}catch(Facebook\Exceptions\FacebookResponseException $e) {
			//When Graph returns an error
			echo 'Graph returned an error: ' . $e->getMessage();
			exit;
		}catch(Facebook\Exceptions\FacebookSDKException $e) {
			//When validation fails or other local issues
			echo 'Facebook SDK returned an error: ' . $e->getMessage();
			exit;
		}
			
		if (!isset($accessToken)) {
			$permissions = array('public_profile','email'); //Optional permissions
			$loginUrl = $helper->getLoginUrl(Config::get('config.WEB_ROOT').'facebooklogin', $permissions);
			header("Location: ".$loginUrl);
			exit;
		}
			
		try{
			//Returns a 'Facebook\FacebookResponse' object
			$fields = array('id', 'name', 'email','first_name', 'last_name', 'birthday', 'gender', 'locale');
			$response = $fb->get('/me?fields='.implode(',', $fields).'', $accessToken);
		}catch(Facebook\Exceptions\FacebookResponseException $e) {
			echo 'Graph returned an error: ' . $e->getMessage();
			exit;
		}catch(Facebook\Exceptions\FacebookSDKException $e) {
			echo 'Facebook SDK returned an error: ' . $e->getMessage();
			exit;
		}
			
		$user = $response->getGraphUser();
		
		if(sizeof($user) > 0){
			$data = array();
			
			if(isset($user['id'])){
				$data['customer_id_facebook'] = $user['id'];
			}
			if(isset($user['email'])){
				$data['customer_email'] = $user['email'];
			}
			if(isset($user['name'])){
				$data['customer_name'] = $user['name'];
			}else{
				$data['customer_name'] = '';
			}
			if(isset($user['gender'])){
				if($user['gender'] == 'male'){
					$data['customer_gender'] = 1;//Nam
				}else{
					$data['customer_gender'] = 0;//Nu
				}
			}else{
				$data['customer_gender'] = 0;//Nu
			}
			if(isset($data['customer_id_facebook']) && $data['customer_id_facebook'] != ''){
				if(isset($data['customer_email']) && $data['customer_email'] != ''){
			
					$customer = UserCustomer::getUserCustomerByEmail($data['customer_email']);
					if(sizeof($customer) > 0){
						if(($customer->customer_id_facebook == '' || $customer->customer_id_facebook == null) && $customer->customer_status != CGlobal::status_block){
							$dataUpdate = array(
									'customer_id_facebook' => $data['customer_id_facebook'],
									'customer_status' => CGlobal::status_show,
									'is_login' => CGlobal::is_login,
									'customer_time_login' => time(),
							);
							UserCustomer::updateData($customer->customer_id, $dataUpdate);
							$customer = UserCustomer::getUserCustomerByEmail($data['customer_email']);
						}
					}else{
						$data['customer_time_created'] = time();
						$data['customer_status'] = CGlobal::status_show;
						$data['customer_time_login'] = time();
						$data['customer_phone'] = '';
						$data['customer_address'] = '';
						$data['customer_id_facebook'] = $data['customer_id_facebook'];
						$data['customer_email'] = $data['customer_email'];
						$data['customer_gender'] = $data['customer_gender'];
						$data['customer_name'] = $data['customer_name'];
						$data['is_customer'] = CGlobal::CUSTOMER_FREE;
						$data['is_login'] = CGlobal::is_login;
						$data['customer_province_id'] = CGlobal::province_id_hanoi;
						
						UserCustomer::addData($data);
						$customer = UserCustomer::getUserCustomerByEmail($data['customer_email']);
					}
			
					Session::put('user_customer', $customer, 60*24);
					Session::save();
			
				}else{
					echo '<script>alert("Bạn chưa công khai email!"); window.close();</script>';
				}
			}
			
			echo '<script>window.close();</script>';
		}
	}
	public function loginGoogle(){
		$client_id = CGlobal::google_client_id;
		$client_secret = CGlobal::google_client_secret;
		$redirect_uri = Config::get('config.WEB_ROOT').'googlelogin';
		
		$client = new Google_Client();
		$client->setClientId($client_id);
		$client->setClientSecret($client_secret);
		$client->setRedirectUri($redirect_uri);
		$client->addScope("email");
		$client->addScope("profile");
		
		$service = new Google_Service_Oauth2($client);
		$access_token = '';
		$customer = array();
		
		if(isset($_GET['code'])){
			
			$client->authenticate($_GET['code']);
			$access_token = $client->getAccessToken();
			
			$client->setAccessToken($access_token);
			$user = $service->userinfo->get();
			
			if(sizeof($user) > 0){
				$data = array();
				
				if(isset($user['id'])){
					$data['customer_id_google'] = $user['id'];
				}
				if(isset($user['email'])){
					$data['customer_email'] = $user['email'];
				}
				if(isset($user['name'])){
					$data['customer_name'] = $user['name'];
				}else{
					$data['customer_name'] = '';
				}
				if(isset($user['gender'])){
					if($user['gender'] == 'male'){
						$data['customer_gender'] = 1;//Nam
					}else{
						$data['customer_gender'] = 0;//Nu
					}
				}else{
					$data['customer_gender'] = 0;//Nu
				}
				
				if(isset($data['customer_id_google']) && $data['customer_id_google'] != ''){
					if(isset($data['customer_email']) && $data['customer_email'] != ''){
						
						$customer = UserCustomer::getUserCustomerByEmail($data['customer_email']);
						if(sizeof($customer) > 0){
							if(($customer->customer_id_google == '' || $customer->customer_id_google == null) && $customer->customer_status != CGlobal::status_block){
								$dataUpdate = array(
									'customer_id_google' => $data['customer_id_google'],
									'customer_status' => CGlobal::status_show,
									'is_login' => CGlobal::is_login,
									'customer_time_login' => time(),
								);
								UserCustomer::updateData($customer->customer_id, $dataUpdate);
								$customer = UserCustomer::getUserCustomerByEmail($data['customer_email']);
							}
						}else{
							$data['customer_time_created'] = time();
							$data['customer_status'] = CGlobal::status_show;
							$data['customer_time_login'] = time();
							$data['customer_phone'] = '';
							$data['customer_address'] = '';
							$data['customer_id_google'] = $data['customer_id_google'];
							$data['customer_email'] = $data['customer_email'];
							$data['customer_gender'] = $data['customer_gender'];
							$data['customer_name'] = $data['customer_name'];
							$data['is_customer'] = CGlobal::CUSTOMER_FREE;
							$data['is_login'] = CGlobal::is_login;
							$data['customer_province_id'] = CGlobal::province_id_hanoi;

							UserCustomer::addData($data);
							$customer = UserCustomer::getUserCustomerByEmail($data['customer_email']);
						}
						
						Session::put('user_customer', $customer, 60*24);
						Session::save();
						
					}
				}
			}
			echo '<script>window.close();</script>';
		}else{
			$authUrl = $client->createAuthUrl();
			header("Location: ".$authUrl);
		}
		die;
	}
}