<?php
/*
* @Created by: DUYNX
* @Author    : nguyenduypt86@gmail.com
* @Date      : 11/2016
* @Version   : 1.0
*/
//Index
Route::any('/', array('as' => 'site.home','uses' => 'SiteHomeController@index'));
Route::get('404.html',array('as' => 'site.page404','uses' =>'SiteHomeController@page404'));
Route::get('tim-kiem.html',array('as' => 'site.searchItems','uses' =>'SiteHomeController@searchItems'));
Route::match(['GET','POST'],'lien-he.html',array('as' => 'site.pageContact','uses' =>'SiteHomeController@pageContact'));
//Video
Route::get('video.html',array('as' => 'site.pageVideo','uses' =>'SiteHomeController@pageVideo'));
Route::match(['GET','POST'],'thu-vien-video/{video_title}-{video_id}.html',array('as' => 'site.pageVideoDetail','uses' =>'SiteHomeController@pageVideoDetail'))->where('video_title', '[A-Z0-9a-z_\-]+')->where('video_id', '[0-9]+');
//Type Product
Route::get('phan-loai/{name}-{id}.html',array('as' => 'site.actionTypeProduct','uses' =>'SiteHomeController@actionTypeProduct'))->where('name', '[A-Z0-9a-z_\-]+')->where('id', '[0-9]+');
//Category
Route::get('{name}-{id}.html',array('as' => 'site.actionRouter','uses' =>'SiteHomeController@actionRouter'))->where('name', '[A-Z0-9a-z_\-]+')->where('id', '[0-9]+');
//Product Detail
Route::get('san-pham/{name}-{id}.html',array('as' => 'site.pageDetailProduct','uses' =>'SiteHomeController@pageDetailProduct'))->where('name', '[A-Z0-9a-z_\-]+')->where('id', '[0-9]+');
Route::get('tim-kiem.html',array('as' => 'site.pageSearchProduct','uses' =>'SiteHomeController@pageSearchProduct'));
//News Detail
Route::get('{catname}/{news_title}-{new_id}.html',array('as' => 'site.pageDetailNew','uses' =>'SiteHomeController@pageDetailNews'))->where('catname', '[A-Z0-9a-z_\-]+')->where('news_title', '[A-Z0-9a-z_\-]+')->where('new_id', '[0-9]+');
//Care Customer
Route::get('cham-soc-khach-hang.html',array('as' => 'site.pageCareCustomer','uses' =>'SiteHomeController@pageCareCustomer'));
//Captcha
Route::match(['GET','POST'], 'captcha', array('as' => 'site.linkCaptcha','uses' =>'SiteHomeController@linkCaptcha'));
Route::match(['GET','POST'], 'captchaCheckAjax', array('as' => 'site.captchaCheckAjax','uses' =>'SiteHomeController@captchaCheckAjax'));
//Register - Login Site
Route::match(['GET','POST'],'dang-ky.html', array('as' => 'customer.pageRegister','uses' => 'SiteUserCustomerController@pageRegister'));
Route::match(['GET','POST'],'kich-hoat-tai-khoan.html', array('as' => 'customer.pageActiveRegister','uses' => 'SiteUserCustomerController@pageActiveRegister'));
Route::match(['GET','POST'],'dang-nhap.html', array('as' => 'customer.pageLogin','uses' => 'SiteUserCustomerController@pageLogin'));
Route::match(['GET','POST'],'thanh-vien-thoat.html', array('as' => 'customer.logout','uses' => 'SiteUserCustomerController@logout'));
Route::match(['GET','POST'],'quen-mat-khau.html', array('as' => 'customer.pageForgetPass','uses' => 'SiteUserCustomerController@pageForgetPass'));
//Login Facebook - Google
Route::match(['GET','POST'], 'facebooklogin', array('as' => 'customer.loginFacebook','uses' => 'SiteUserCustomerController@loginFacebook'));
Route::match(['GET','POST'], 'googlelogin', array('as' => '.customer.loginGoogle','uses' => 'SiteUserCustomerController@loginGoogle'));
//Info customer
Route::match(['GET','POST'],'thay-doi-thong-tin.html', array('as' => 'customer.pageChageInfo','uses' => 'SiteUserCustomerController@pageChageInfo'));
Route::match(['GET','POST'],'thay-doi-mat-khau.html', array('as' => 'customer.pageChagePass','uses' => 'SiteUserCustomerController@pageChagePass'));
Route::post('thong-tin-quan-huyen-cua-khach.html',array('as' => 'customer.getDistrictCustomer','uses' =>'SiteUserCustomerController@getDistrictCustomer'));
//Cart
Route::post('them-vao-gio-hang.html', array('as' => 'site.ajaxAddCart','uses' => 'SiteOrderController@ajaxAddCart'));
Route::match(['GET','POST'], 'gio-hang.html',array('as' => 'site.listCartOrder','uses' =>'SiteOrderController@listCartOrder'));
Route::match(['GET','POST'], 'xoa-mot-san-pham-trong-gio-hang.html', array('as' => 'site.deleteOneItemInCart','uses' => 'SiteOrderController@deleteOneItemInCart'));
Route::match(['GET','POST'], 'xoa-gio-hang.html', array('as' => 'site.deleteAllItemInCart','uses' => 'SiteOrderController@deleteAllItemInCart'));
Route::match(['GET','POST'], 'gui-don-hang.html',array('as' => 'site.sendCartOrder','uses' =>'SiteOrderController@sendCartOrder'));
Route::get('cam-on-da-mua-hang.html',array('as' => 'site.thanksBuy','uses' =>'SiteOrderController@thanksBuy'));
Route::get('san-pham-yeu-thich.html',array('as' => 'site.favoriteProduct','uses' =>'SiteOrderController@favoriteProduct'));
Route::get('lich-su-mua-hang.html',array('as' => 'customer.historyBuy','uses' =>'SiteOrderController@historyBuy'));



