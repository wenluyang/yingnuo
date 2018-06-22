<?php
Route::any('/wechat', 'WeChatController@serve');
Route::get('/menu', 'WechatController@menu');
Route::get('/qr', 'WechatController@qrcode');

Route::group([], function(){
    Route::get('/', 'HomeController@index');

    #产品分类
    Route::get('/category', 'CategoryController@index');
    Route::get('/category/{category}/show', 'CategoryController@show')->name('category.show');
    #型号详情
    Route::get('/category/{category}/product/{product}/show', 'GoodsController@show')->name('goods.show');

});
