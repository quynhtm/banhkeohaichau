<?php

/**
 * Created by PhpStorm.
 * User: QuynhTM
 */
class AjaxCommonController extends BaseSiteController
{
    private  $sizeImageShowUpload = CGlobal::sizeImage_100;

    function uploadImage() {
        $id_hiden = Request::get('id', 0);
        $type = Request::get('type', 1);
        $dataImg = $_FILES["multipleFile"];
        $aryData = array();
        $aryData['intIsOK'] = -1;
        $aryData['msg'] = "Data not exists!";
        switch( $type ){
            case 1://img news
                $aryData = $this->uploadImageToFolder($dataImg, $id_hiden, CGlobal::FOLDER_NEWS, $type);
                break;
            case 2://img product
                $aryData = $this->uploadImageToFolder($dataImg, $id_hiden, CGlobal::FOLDER_PRODUCT, $type);
                break;
            case 3://img banner
                $this->sizeImageShowUpload = CGlobal::sizeImage_300;
                $aryData = $this->uploadImageToFolder($dataImg, $id_hiden, CGlobal::FOLDER_BANNER, $type);
                break;
            case 4://img thông tin seo
                	$aryData = $this->uploadImageToFolder($dataImg, $id_hiden, CGlobal::FOLDER_INFORSEO, $type);
                	break;
            default:
                break;
        }
        echo json_encode($aryData);
        exit();
    }

    function uploadImageToFolder($dataImg, $id_hiden, $folder, $type){
        $aryData = array();
        $aryData['intIsOK'] = -1;
        $aryData['msg'] = "Upload Img!";
        $item_id = 0; // id doi tuong dang upload

        if (!empty($dataImg)) {
            if($id_hiden == 0){
                switch( $type ){
                    case 1://img news
                        $new_row['news_create'] = time();
                        $new_row['news_user_create'] = !empty($this->userAdmin)? $this->userAdmin['user_name']: '';
                        $new_row['news_status'] = CGlobal::IMAGE_ERROR;
                        $item_id = News::addData($new_row);
                        break;
                    case 2://img Item
                        $new_row['time_created'] = time();
                        $new_row['product_status'] = CGlobal::status_hide;
                        $new_row['user_id_creater'] =  !empty($this->userAdmin)? $this->userAdmin['user_id']: 0;
                        $new_row['user_name_creater'] =  !empty($this->userAdmin)? $this->userAdmin['user_name']: '';
                        $item_id = Product::addData($new_row);
                        break;
                    case 3://img banner
                        $new_row['banner_create_time'] = time();
                        $new_row['banner_status'] = CGlobal::IMAGE_ERROR;
                        $item_id = Banner::addData($new_row);
                        break;
                    case 4://img inforSeo
                        $new_row['info_created'] = time();
                        $new_row['info_status'] = CGlobal::IMAGE_ERROR;
                        $item_id = Info::addData($new_row);
                        break;
                    default:
                        break;
                }
            }elseif($id_hiden > 0){
                $item_id = $id_hiden;
            }
            if($item_id > 0){
                $aryError = $tmpImg = array();
                $file_name = Upload::uploadFile('multipleFile',
                    $_file_ext = 'jpg,jpeg,png,gif',
                    $_max_file_size = 10*1024*1024,
                    $_folder = $folder.'/'.$item_id);

                if ($file_name != '' && empty($aryError)) {
                    $tmpImg['name_img'] = $file_name;
                    $tmpImg['id_key'] = rand(10000, 99999);
                    $url_thumb = ThumbImg::getImageThumb($folder, $item_id, $file_name, $this->sizeImageShowUpload, '', true, CGlobal::type_thumb_image_banner, false);
                    $tmpImg['src'] = $url_thumb;

					//Cap nhat DB de quan ly file anh new
                    if($type == 1 ){
                    	//img news
                   		$inforNews = News::getNewByID($item_id);
                    	if($inforNews){
                    		$arrImagOther = unserialize($inforNews->news_image_other);
                    		$arrImagOther[] = $file_name;//gan anh vua upload
                    		$proUpdate['news_image_other'] = serialize($arrImagOther);
                            $proUpdate['news_update'] = time();
                            $proUpdate['news_user_update'] = !empty($this->userAdmin)? $this->userAdmin['user_name']: '';
                    		News::updateData($item_id,$proUpdate);
                    	}
                    }

                    //cap nhat DB de quan ly cac file anh Sản Phẩm
                    if( $type == 2 ){
                        //img Product get mang anh other
                        $inforItem = Product::getProductByID($item_id);
                        if($inforItem){
                            $arrImagOther = unserialize($inforItem->product_image_other);
                            $arrImagOther[] = $file_name;//gan anh vua upload

                            $itemUpdate['product_image_other'] = serialize($arrImagOther);
                            $itemUpdate['time_update'] = time();
                            $itemUpdate['user_id_update'] =  !empty($this->userAdmin)? $this->userAdmin['user_id']: 0;
                            $itemUpdate['user_name_update'] =  !empty($this->userAdmin)? $this->userAdmin['user_name']: '';
                            Product::updateData($item_id, $itemUpdate);
                        }
                    }

                    if($type == 3){//anh banner
                        $banner = Banner::getBannerByID($item_id);
                        if($banner){
                            if($banner->banner_image != ''){//xoa anh c?
                                //xoa anh upload
                                FunctionLib::deleteFileUpload($banner->banner_image,$item_id,CGlobal::FOLDER_BANNER);
                                //xóa anh thumb
                                $arrSizeThumb = CGlobal::$arrBannerSizeImage;
                                foreach($arrSizeThumb as $k=>$size){
                                    $sizeThumb = $size['w'].'x'.$size['h'];
                                    FunctionLib::deleteFileThumb($banner->banner_image,$item_id,CGlobal::FOLDER_BANNER,$sizeThumb);
                                }
                            }
                            Banner::updateData($item_id,array('banner_image'=>$file_name));//cap nhat anh moi
                        }
                    }
                    if($type == 4){//anh logo shop
                    	$logo = Info::getByID($item_id);
                    	if($logo){
                    		if($logo->info_img != ''){//xoa anh cũ
                    			//xoa anh upload
                    			FunctionLib::deleteFileUpload($logo->info_img,$item_id,CGlobal::FOLDER_INFORSEO);
                    			//xoa anh thumb
                                $sizeThumb = $this->sizeImageShowUpload.'x'.$this->sizeImageShowUpload;
                                FunctionLib::deleteFileThumb($logo->info_img,$item_id,CGlobal::FOLDER_INFORSEO,$sizeThumb);
                    		}
                            Info::updateData($item_id,array('info_img'=>$file_name));//cap nhat anh moi
                    	}
                    }
                }
                $aryData['intIsOK'] = 1;
                $aryData['id_item'] = $item_id;
                $aryData['info'] = $tmpImg;
            }elseif($item_id==0){
                $aryData['intIsOK'] = -1;
                $aryData['id_item'] = $item_id;
                $aryData['msg'] = "Shop đã hết lượt đăng sản phẩm";
            }
        }
        echo json_encode($aryData);
        die();
    }

    public function removeImageCommon(){
        $item_id = (int)Request::get('id',0);
        $type = (int)Request::get('type',1);
        $nameImage = trim(Request::get('nameImage',''));
        $key = trim(Request::get('key',''));
        $aryData = array();
        $aryData['intIsOK'] = -1;

        if($item_id > 0 && $nameImage != '' && $key != ''){
            switch( $type ){
                case 1:
                    //img news
                    $inforNews = News::getNewByID($item_id);
                    if(sizeof($inforNews) >0){
                        $arrImagOther = unserialize($inforNews->news_image_other);
                        if(!empty($arrImagOther)){
                            foreach($arrImagOther as $k=>$v){
                                if($v == $nameImage){
                                    unset($arrImagOther[$k]);
                                    //xoa anh upload
                                    FunctionLib::deleteFileUpload($nameImage,$item_id,CGlobal::FOLDER_NEWS);

                                    //xóa anh thumb
                                    $arrSizeThumb = CGlobal::$arrSizeImage;
                                    foreach($arrSizeThumb as $k=>$size){
                                        $sizeThumb = $size['w'].'x'.$size['h'];
                                        FunctionLib::deleteFileThumb($nameImage,$item_id,CGlobal::FOLDER_NEWS,$sizeThumb);
                                    }
                                }
                            }
                        }
                        $proUpdate['news_image_other'] = serialize($arrImagOther);
                        News::updateData($item_id,$proUpdate);
                    }
                    $aryData['intIsOK'] = 1;
                    break;
                case 2:
                    //img product
                    $inforProduct = Product::getProductByID($item_id);
                    if(sizeof($inforProduct) >0){
                        $arrImagOther = unserialize($inforProduct->product_image_other);
                        if(!empty($arrImagOther)){
                            foreach($arrImagOther as $k=>$v){
                                if($v == $nameImage){
                                    unset($arrImagOther[$k]);
                                    //xoa anh upload
                                    FunctionLib::deleteFileUpload($nameImage,$item_id,CGlobal::FOLDER_PRODUCT);

                                    //xóa anh thumb
                                    $arrSizeThumb = CGlobal::$arrSizeImage;
                                    foreach($arrSizeThumb as $k=>$size){
                                        $sizeThumb = $size['w'].'x'.$size['h'];
                                        FunctionLib::deleteFileThumb($nameImage,$item_id,CGlobal::FOLDER_PRODUCT,$sizeThumb);
                                    }
                                }
                            }
                        }
                        $proUpdate['product_image_other'] = serialize($arrImagOther);
                        Product::updateData($item_id,$proUpdate);
                    }
                    $aryData['intIsOK'] = 1;
                    break;
                case 5:
                	//img thu vien anh
                	$inforImage = LibraryImage::getById($item_id);
                	if(sizeof($inforImage) >0){
                        $arrImagOther = unserialize($inforImage->image_image_other);
                        if(!empty($arrImagOther)){
                            foreach($arrImagOther as $k=>$v){
                                if($v == $nameImage){
                                    unset($arrImagOther[$k]);
                                    //xoa anh upload
                                    FunctionLib::deleteFileUpload($nameImage,$item_id,CGlobal::FOLDER_LIBRARY_IMAGE);

                                    //xóa anh thumb
                                    $arrSizeThumb = CGlobal::$arrSizeImage;
                                    foreach($arrSizeThumb as $k=>$size){
                                        $sizeThumb = $size['w'].'x'.$size['h'];
                                        FunctionLib::deleteFileThumb($nameImage,$item_id,CGlobal::FOLDER_LIBRARY_IMAGE,$sizeThumb);
                                    }
                                }
                            }
                        }
                        $proUpdate['image_image_other'] = serialize($arrImagOther);
                        LibraryImage::updateData($item_id,$proUpdate);
                    }
                	$aryData['intIsOK'] = 1;
                	break;
                case 3 ://xoa anh banner
                    $banner = Banner::getBannerByID($item_id);
                    if($banner){
                        if($banner->banner_image != '' && strcmp(trim($banner->banner_image),$nameImage) == 0){//xoa anh c?
                            //xoa anh upload
                            FunctionLib::deleteFileUpload($banner->banner_image,$item_id,CGlobal::FOLDER_BANNER);
                            //xóa anh thumb
                            $arrSizeThumb = CGlobal::$arrBannerSizeImage;
                            foreach($arrSizeThumb as $k=>$size){
                                $sizeThumb = $size['w'].'x'.$size['h'];
                                FunctionLib::deleteFileThumb($banner->banner_image,$item_id,CGlobal::FOLDER_BANNER,$sizeThumb);
                            }
                            $aryData['intIsOK'] = 1;
                        }
                    }
                    break;
                case 4 ://xoa ảnh infor
                    $data = Info::find($item_id);
                    if($data != null){
                        //Remove Img
                        $info_img = ($data->info_img != '') ? $data->info_img : '';
                        if($info_img != ''){
                            //xoa anh upload
                            FunctionLib::deleteFileUpload($data->info_img,$data->info_id,CGlobal::FOLDER_INFORSEO);
                            //x�a anh thumb
                            $arrSizeThumb = CGlobal::$arrBannerSizeImage;
                            foreach($arrSizeThumb as $k=>$size){
                                $sizeThumb = $size['w'].'x'.$size['h'];
                                FunctionLib::deleteFileThumb($data->info_img,$data->info_id,CGlobal::FOLDER_INFORSEO,$sizeThumb);
                            }
                        }
                        //End Remove Img
                        $aryData['intIsOK'] = 1;
                    }
                    break;
                default:
                    break;
            }
        }
        return Response::json($aryData);
    }
	
    //getImgContent
    function getImageContentCommon(){
    	 $id_hiden = Request::get('id', 0);
         $type = Request::get('type', 1);
         $data = array('isIntOk' => 0);
         $arrImg = $arrViewImgOther = array();
    	 switch($type){
            case 1://img news
            	$inforNews = News::getNewByID($id_hiden);
            	if(sizeof($inforNews) >0){
            		$arrImg = unserialize($inforNews->news_image_other);
            		foreach($arrImg as $k=>$val){
            			$url_thumb = ThumbImg::getImageThumb(CGlobal::FOLDER_NEWS, $id_hiden, $val, CGlobal::sizeImage_100);
            			$url_thumb_content = ThumbImg::getImageThumb(CGlobal::FOLDER_NEWS, $id_hiden, $val, CGlobal::sizeImage_600);
            			$arrViewImgOther[] = array(
            					'post_title'=>$inforNews->news_title,
            					'src_img_other'=>$url_thumb,
            					'src_thumb_content'=>$url_thumb_content);
            		}
            		
            	}
            	$data['dataImage'] = $arrViewImgOther;
            	$data['isIntOk'] = 1;
            	return Response::json($data);
            	break;
             case 2://img Product
            	$inforProduct = Product::getProductByID($id_hiden);
            	if(sizeof($inforProduct) >0){
            		$arrImg = unserialize($inforProduct->product_image_other);
            		foreach($arrImg as $k=>$val){
            			$url_thumb = ThumbImg::getImageThumb(CGlobal::FOLDER_PRODUCT, $id_hiden, $val, CGlobal::sizeImage_100);
            			$url_thumb_content = ThumbImg::getImageThumb(CGlobal::FOLDER_PRODUCT, $id_hiden, $val, CGlobal::sizeImage_600);
            			$arrViewImgOther[] = array(
            					'post_title'=>$inforProduct->product_name,
            					'src_img_other'=>$url_thumb,
            					'src_thumb_content'=>$url_thumb_content);
            		}

            	}
            	$data['dataImage'] = $arrViewImgOther;
            	$data['isIntOk'] = 1;
            	return Response::json($data);
            	break;
            default:
                break;
        }
        return Response::json($data);
    }
    function sendEmail(){
        // Test gửi mail
        Mail::send('emails.test_email', array('firstname'=>'Trương Manh Quỳnh'), function($message){
            $message->to('nguyenduypt86@gmail.com', 'Trương Manh Quỳnh')
                ->subject('Test gửi mail!');
        });

        die();
    }
    function getProductFromOtherSite(){
    	$result = array();
   		
    	$search['product_status'] = isset($_POST['product_status']) ? (int)$_POST['product_status'] : -1;
    	$search['user_shop_id'] = isset($_POST['user_shop_id']) ? (int)$_POST['user_shop_id'] : -1;
    	$limit = isset($_POST['product_limit']) ? (int)$_POST['product_limit'] : 0;
    	$search['field_get'] = '';
    	
    	if($search['user_shop_id'] > 0 && $limit > 0){
    		$pageNo = 1;
    		$offset = $total = 0;
    		$search = $data = array();
    		$data = Product::getProductForSite($search, $limit, $offset, $total);
    		$paging = $total > 0 ? Pagging::getNewPager(3, $pageNo, $total, $limit, $search) : '';
    		
    		if(sizeof($data) > 0){
    			foreach($data as $v){
    				$item = array(
    						'product_id'=>$v->product_id,
    						'product_id'=>$v->product_id,
    						'product_name'=>$v->product_name,
    						'category_name'=>$v->category_name,
    						'category_id'=>$v->category_id,
    						'product_image'=>ThumbImg::getImageThumb(CGlobal::FOLDER_PRODUCT, $v->product_id, $v->product_image, CGlobal::sizeImage_450, '', true, CGlobal::type_thumb_image_banner, false),
    						'product_price_sell'=>$v->product_price_sell,
    						'product_price_market'=>$v->product_price_market,
    						'product_type_price'=>$v->product_type_price,
    						'product_selloff'=>$v->product_selloff,
    						'product_link'=>FunctionLib::buildLinkDetailProduct($v->product_id, $v->product_name, $v->category_name),
    				);
    				$result[] = $item;
    			}
    		}
    		
    	}
    	return json_encode($result);
    }
    //Duy add
    function upload(){
        $action = addslashes(Request::get('act', ''));
        switch( $action ){
            case 'upload_file' :
                $this->upload_file();
                break;
            case 'remove_file' :
                $this->remove_file();
                break;
            default:
                $this->nothing();
                break;
        }
    }
    function upload_file() {
        $id_hiden =  Request::get('id', 0);
        $type = Request::get('type', 1);
        $dataImg = $_FILES["multipleFile"];
        $aryData = array();
        $aryData['intIsOK'] = -1;
        $aryData['msg'] = "Data not exists!";

        switch( $type ){
            case 10 ://File Document
                $aryData = $this->uploadDocumentToFolder($dataImg, $id_hiden, CGlobal::FOLDER_NEWS, $type);
                break;
            default:
                break;
        }
        echo json_encode($aryData);
        exit();
    }
    function uploadDocumentToFolder($dataImg, $id_hiden, $folder, $type){
        $aryData = array();
        $aryData['intIsOK'] = -1;
        $aryData['msg'] = "Upload Img!";
        $item_id = 0;
        $name_key = 0;
        if (!empty($dataImg)) {
            if($id_hiden == 0){

                switch($type){
                    case 10://File document
                        $new_row['news_create'] = time();
                        $new_row['news_status'] = CGlobal::IMAGE_ERROR;
                        $item_id = News::addData($new_row);
                        break;
                    default:
                        break;
                }
            }elseif($id_hiden > 0){
                $item_id = $id_hiden;
            }
            if($item_id > 0){
                $aryError = $tmpImg = array();
                $file_name = Upload::uploadFile('multipleFile',
                    $_file_ext = 'xls,xlsx,doc,docx,pdf,rar,zip,tar,mp4,flv,avi,3gp,mov',
                    $_max_file_size = 50*1024*1024,
                    $_folder = $folder.'/'.$item_id,
                    $type_json=0);
                if($file_name != '' && empty($aryError)) {
                    $tmpImg['name_file'] = $file_name;
                    $tmpImg['id_key'] = rand(10000, 99999);

                    switch($type){
                        case 10://File Document
                            $result = News::getNewByID($item_id);
                            if($result != null){
                                $arr_file = ($result->news_files != '') ? unserialize($result->news_files) : array();
                                $arr_file[] = $file_name;
                                $new_row['news_files'] = serialize($arr_file);
                                News::updateData($item_id, $new_row);
                                $url_file = Config::get('config.WEB_ROOT').'uploads/'.$folder.'/'.$item_id.'/'.$file_name;
                                $tmpImg['src'] = $url_file;
                                foreach($arr_file as $_k=>$_v){
                                    if($_v == $file_name){
                                        $tmpImg['name_key'] = $_k;;
                                    }
                                }
                            }
                            break;
                        default:
                            break;
                    }

                    $aryData['intIsOK'] = 1;
                    $aryData['id_item'] = $item_id;
                    $aryData['info'] = $tmpImg;
                }
            }
        }
        return $aryData;
    }
    function remove_file(){

        $id = (int)Request::get('id', 0);
        $key = (int)Request::get('key', 0);
        $nameImage = Request::get('nameImage', '');
        $type = (int)Request::get('type', 1);

        $aryData = array();
        $aryData['intIsOK'] = -1;
        $aryData['msg'] = "Remove Img!";
        $aryData['nameImage'] = $nameImage;

        switch( $type ){
            case 10://File Document
                $folder_image = 'uploads/'.CGlobal::FOLDER_NEWS;
                if($id > 0 && $nameImage != '' && $folder_image != ''){
                    $delete_action = $this->delete_image_item($id, $key, $nameImage, $folder_image, $type);
                    if($delete_action == 1){
                        $aryData['intIsOK'] = 1;
                        $aryData['msg'] = "Remove Img!";
                    }
                }
                break;
            default:
                $folder_image = '';
                break;
        }
        echo json_encode($aryData);
        exit();
    }
    function delete_image_item($id, $key, $nameImage, $folder_image, $type){
        $delete_action = 0;
        $aryImages  = array();
        //get img in DB and remove it
        switch( $type ){
            case 10://File Document
                $result = News::getNewByID($id);
                if($result != ''){
                    $aryImages = ($result->news_files != '') ? unserialize($result->news_files) : array();
                }
                break;
            default:
                $folder_image = '';
                break;
        }

        if(is_array($aryImages) && count($aryImages) > 0) {
            $this->unlinkFileAndFolder($nameImage, $id, $folder_image, true);
            unset($aryImages[$key]);
            if(!empty($aryImages)){
                $aryImages = serialize($aryImages);
            }else{
                $aryImages = '';
            }
            switch( $type ){
                case 10://File Document
                    $new_row['news_files'] = $aryImages;
                    News::updateData($id, $new_row);
                    break;
                default:
                    $folder_image = '';
                    break;
            }
            $delete_action = 1;
        }
        return $delete_action;
    }
    function unlinkFileAndFolder($file_name = '', $id = 0, $folder = '', $is_delDir = 0){

        if($file_name != '') {
            //Remove Img In Database
            $paths = '';
            if($folder != '' && $id >0){
                $path = Config::get('config.DIR_ROOT').'/'.$folder.'/'.$id;
            }

            if($file_name != ''){
                if($path != ''){
                    if(is_file($path.'/'.$file_name)){
                        @unlink($path.'/'.$file_name);
                    }
                }
            }
            //Remove Folder Empty
            if($is_delDir) {
                if($path != ''){
                    if(is_dir($path)) {
                        @rmdir($path);
                    }
                }
            }
        }
    }
}