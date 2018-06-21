<?php
Route::any('/wechat', 'WeChatController@serve');
Route::get('/menu', 'WechatController@menu');
Route::get('/qr', 'WechatController@qrcode');

Route::group(['middleware' => ['wechat.oauth:snsapi_userinfo']], function(){
    Route::get('/', 'HomeController@index');
});
