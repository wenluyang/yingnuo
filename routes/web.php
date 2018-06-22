<?php
Route::any('/wechat', 'WeChatController@serve');
Route::get('/menu', 'WechatController@menu');
Route::get('/qr', 'WechatController@qrcode');

Route::group([], function(){
    Route::get('/', 'HomeController@index');

    #商学院
    Route::get('/article', 'ArticleController@index')->name('article');
    Route::get('/article/search','ArticleController@search')->name('news.search');

    #产品分类
    Route::get('/category', 'CategoryController@index')->name('category');
    Route::get('/category/{category}/show', 'CategoryController@show')->name('category.show');
    #型号详情
    Route::get('/goods/{goods}/show', 'GoodsController@show')->name('goods.show');
    Route::post('/goods/ops', 'GoodsController@ops')->name('goods.ops');
    Route::post('/goods/fav', 'GoodsController@fav')->name('goods.fav');
    Route::post('/goods/cart', 'GoodsController@cart')->name('goods.cartstore');
    Route::get('/goods/cart', 'GoodsController@cart')->name('goods.cart');
    Route::get('/goods/order', 'GoodsController@order')->name('goods.order');
    Route::post('/goods/order', 'GoodsController@order')->name('goods.orderstore');

    #地址
    Route::get('/user/address','UserController@address')->name('user.address');
    Route::get('/user/address_set','UserController@address_set')->name('user.address_set');
    Route::post('/user/address_set','UserController@address_set')->name('user.address_set.store');
    Route::post('/user/address_ops','UserController@address_ops')->name('user.address.ops');
    #省市区联动
    Route::get('/city/cascade','UserController@cascade')->name('user.city.cascade');



});
