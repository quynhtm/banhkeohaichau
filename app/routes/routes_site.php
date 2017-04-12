<?php
/*
* @Created by: DUYNX
* @Author    : nguyenduypt86@gmail.com
* @Date      : 11/2016
* @Version   : 1.0
*/

//Home
Route::any('/', array('as' => 'site.home','uses' => 'SiteHomeController@index'));
Route::get('404.html',array('as' => 'site.page404','uses' =>'SiteHomeController@page404'));
Route::get('tim-kiem.html',array('as' => 'site.searchItems','uses' =>'SiteHomeController@searchItems'));
Route::match(['GET','POST'],'lien-he.html',array('as' => 'site.pageContact','uses' =>'SiteHomeController@pageContact'));

//Video
Route::get('video.html',array('as' => 'site.pageVideo','uses' =>'SiteHomeController@pageVideo'));
Route::match(['GET','POST'],'thu-vien-video/{video_title}-{video_id}.html',array('as' => 'site.pageVideoDetail','uses' =>'SiteHomeController@pageVideoDetail'))->where('video_title', '[A-Z0-9a-z_\-]+')->where('video_id', '[0-9]+');

//Category News
Route::get('{name}-{id}.html',array('as' => 'site.pageCategory','uses' =>'SiteHomeController@pageCategory'))->where('name', '[A-Z0-9a-z_\-]+')->where('id', '[0-9]+');
Route::get('{catname}/{news_title}-{new_id}.html',array('as' => 'site.pageDetailNew','uses' =>'SiteHomeController@pageDetailNew'))->where('catname', '[A-Z0-9a-z_\-]+')->where('news_title', '[A-Z0-9a-z_\-]+')->where('new_id', '[0-9]+');

//Care Customer
Route::get('cham-soc-khach-hang.html',array('as' => 'site.pageCareCustomer','uses' =>'SiteHomeController@pageCareCustomer'));

//Captcha
Route::match(['GET','POST'], 'captcha', array('as' => 'site.linkCaptcha','uses' =>'SiteHomeController@linkCaptcha'));
Route::match(['GET','POST'], 'captchaCheckAjax', array('as' => 'site.captchaCheckAjax','uses' =>'SiteHomeController@captchaCheckAjax'));



