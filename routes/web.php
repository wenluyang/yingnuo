<?php
Route::any('/wechat', 'WeChatController@serve');
Route::get('/menu', 'WechatController@menu');
Route::get('/qr', 'WechatController@qrcode');

Route::group([], function(){
    Route::get('/', 'HomeController@index')->name('home');

    #商学院
    Route::get('/article', 'ArticleController@index')->name('article');
    Route::get('/article/search','ArticleController@search')->name('news.search');
    Route::get('/article/{article}/show','ArticleController@show')->name('article.show');


    #新闻中心
    Route::get('/news', 'NewsController@index')->name('news');
    Route::get('/news/search','NewsController@search')->name('news.search');
    Route::get('/news/{news}/show','NewsController@show')->name('news.show');

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
    #收藏
    Route::get('/user/fav','UserController@fav')->name('user.fav');
    #地址
    Route::get('/user/address','UserController@address')->name('user.address');
    Route::get('/user/address_set','UserController@address_set')->name('user.address_set');
    Route::post('/user/address_set','UserController@address_set')->name('user.address_set.store');
    Route::post('/user/address_ops','UserController@address_ops')->name('user.address.ops');
    #省市区联动
    Route::get('/city/cascade','UserController@cascade')->name('user.city.cascade');

    #用户中心
    Route::get('/user','UserController@index')->name('user.index');

    #订单
    Route::get('/user/order', 'UserController@order')->name('user.order');
    Route::post('/user/order/ops', 'OrderController@ops')->name('user.order.ops');



});
