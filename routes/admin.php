<?php
route::group(['prefix' => 'admin','namespace'=>'Admin'], function () {
    Route::get('/', 'DefaultController@index')->name('admin.default');
    Route::get('/login', 'DefaultController@login')->name('admin.loginform');
    Route::post('/login', 'DefaultController@login')->name('admin.login');
    Route::post('/logout', 'DefaultController@logout')->name('admin.logout');
    Route::get('/city/cascade','CityController@Cascade');

    Route::group(['middleware' => 'auth:admin'], function () {

        #上传图片统一路由
        Route::post('images/upload','UploadController@image');
        #后台首页
        Route::get('home', 'HomeController@index')->name('admin.home.index');
        #修改密码
        Route::get('changepass', 'DefaultController@changepass')->name('admin.changepass');
        #幻灯图片管理
        Route::get('banner','BannerController@index')->name('admin.banner.index');
        Route::post('banner/store','BannerController@store')->name('admin.banner.store');
        Route::get('banner/{banner}/show','BannerController@show')->name('admin.banner.show');
        Route::post('banner/{banner}/update','BannerController@update')->name('admin.banner.update');
        Route::delete('banner/{banner}/delete','BannerController@destroy')->name('admin.banner.destroy');
        Route::post('banner/{banner}/sort','BannerController@sort')->name('admin.banner.sort');
        #单页面管理
        Route::get('page','PageController@index')->name('admin.page.index');
        Route::get('page/create','PageController@create')->name('admin.page.create');
        Route::post('page/store','PageController@store')->name('admin.page.store');
        Route::get('page/{page}/show','PageController@show')->name('admin.page.show');
        Route::post('page/{page}/update','PageController@update')->name('admin.page.update');
        #新闻分类
        Route::get('newscat','NewsCatController@index')->name('admin.newscat.index');
        Route::post('newscat/store','NewsCatController@store')->name('admin.newscat.store');
        Route::get('newscat/{newsCat}/show','NewsCatController@show')->name('admin.newscat.show');
        Route::post('newscat/{newsCat}/update','NewsCatController@update')->name('admin.newscat.update');
        Route::patch('newscat/{newsCat}/hide','NewsCatController@hide')->name('admin.newscat.hide');
        Route::patch('newscat/{newsCat}/display','NewsCatController@display')->name('admin.newscat.display');
        Route::delete('newscat/{newsCat}/delete','NewsCatController@delete')->name('admin.newscat.delete');
        Route::post('newscat/{newsCat}/sort','NewsCatController@sort')->name('admin.newscat.sort');
        #新闻管理
        Route::get('news','NewsController@index')->name('admin.news.index');
        Route::get('news/create','NewsController@create')->name('admin.news.create');
        Route::post('news/store','NewsController@store')->name('admin.news.store');
        Route::get('news/{news}/show', 'NewsController@show')->name('admin.news.show');
        Route::post('news/{news}/update', 'NewsController@update')->name('admin.news.update');
        Route::post('news/{news}/recom', 'NewsController@recom')->name('admin.news.recom');
        Route::post('news/{news}/unrecom', 'NewsController@unrecom')->name('admin.news.unrecom');
        Route::post('news/{news}/shenhe', 'NewsController@shenhe')->name('admin.news.shenhe');
        Route::post('news/{news}/unshenhe', 'NewsController@unshenhe')->name('admin.news.unshenhe');
        Route::delete('news/{news}/delete', 'NewsController@destroy')->name('admin.news.destroy');
        Route::post('news/{news}/sort', 'NewsController@sort')->name('admin.news.sort');
        #文章分类
        Route::get('articlecat','ArticleCatController@index')->name('admin.articlecat.index');
        Route::post('articlecat/store','ArticleCatController@store')->name('admin.articlecat.store');
        Route::get('articlecat/{articleCat}/show','ArticleCatController@show')->name('admin.articlecat.show');
        Route::post('articlecat/{articleCat}/update','ArticleCatController@update')->name('admin.articlecat.update');
        Route::patch('articlecat/{articleCat}/hide','ArticleCatController@hide')->name('admin.articlecat.hide');
        Route::patch('articlecat/{articleCat}/display','ArticleCatController@display')->name('admin.articlecat.display');
        Route::delete('articlecat/{articleCat}/delete','ArticleCatController@delete')->name('admin.articlecat.delete');
        #文章中心
        Route::get('article', 'ArticleController@index')->name('admin.article.index');
        Route::get('article/create', 'ArticleController@create')->name('admin.article.create');
        Route::post('article/store', 'ArticleController@store')->name('admin.article.store');
        Route::get('article/{article}/show', 'ArticleController@show')->name('admin.article.show');
        Route::post('article/{article}/recom', 'ArticleController@recom')->name('admin.article.recom');
        Route::post('article/{article}/update', 'ArticleController@update')->name('admin.article.update');
        Route::post('article/{article}/unrecom', 'ArticleController@unrecom')->name('admin.article.unrecom');
        Route::post('article/{article}/shenhe', 'ArticleController@shenhe')->name('admin.article.shenhe');
        Route::post('article/{article}/unshenhe', 'ArticleController@unshenhe')->name('admin.article.unshenhe');
        Route::delete('article/{article}/delete', 'ArticleController@delete')->name('admin.article.delete');
        Route::post('article/{article}/sort', 'ArticleController@sort')->name('admin.article.sort');
        #产品分类
        Route::get('category','CategoryController@index')->name('admin.category.index');
        Route::post('category/store','CategoryController@store')->name('admin.category.store');
        Route::get('category/{category}/show','CategoryController@show')->name('admin.category.show');
        Route::post('category/{category}/update','CategoryController@update')->name('admin.category.update');
        Route::patch('category/{category}/hide','CategoryController@hide')->name('admin.category.hide');
        Route::patch('category/{category}/display','CategoryController@display')->name('admin.category.display');
        Route::delete('category/{category}/delete','CategoryController@destroy')->name('admin.category.delete');
        Route::post('category/{category}/sort','CategoryController@sort')->name('admin.category.sort');
        #产品分类幻灯
        Route::get('catbanner','CategoryBannerController@index')->name('admin.catbanner.index');
        Route::get('catbanner/{categoryBanner}/show','CategoryBannerController@show')->name('admin.catbanner.show');
        Route::post('catbanner/store','CategoryBannerController@store')->name('admin.catbanner.store');
        Route::post('catbanner/{categoryBanner}/update','CategoryBannerController@update')->name('admin.catbanner.update');
        Route::delete('catbanner/{categoryBanner}/delete','CategoryBannerController@destroy')->name('admin.catbanner.destroy');
        Route::post('catbanner/{categoryBanner}/sort','CategoryBannerController@sort')->name('admin.catbanner.sort');



        #产品管理
        Route::get('goods', 'GoodsController@index')->name('admin.goods.index');
        Route::get('goods/create', 'GoodsController@create')->name('admin.goods.create');
        Route::post('goods/store', 'GoodsController@store')->name('admin.goods.store');
        Route::get('goods/{goods}/edit', 'GoodsController@edit')->name('admin.goods.edit');
        Route::post('goods/{goods}/update', 'GoodsController@update')->name('admin.goods.update');
        Route::get('goods/{goods}/delete', 'GoodsController@destroy')->name('admin.goods.delete');

        #产品记录
        Route::get('goods/{goods}/info', 'GoodsController@info')->name('admin.goods.info');
        #设置产品的各级会员价格
        Route::get('goods/{goods}/price', 'GoodsController@price')->name('admin.goods.price');
        Route::post('goods/{goods}/saveprice', 'GoodsController@saveprice')->name('admin.goods.saveprice');


        #财务管理
        Route::get('finance','FinanceController@index')->name('admin.finance.index');
        Route::get('finance/dshenhe','FinanceController@dshenhe')->name('admin.finance.dshenhe');
        Route::get('finance/yqueren','FinanceController@yqueren')->name('admin.finance.yqueren');
        Route::get('finance/yfahuo','FinanceController@yfahuo')->name('admin.finance.yfahuo');
        Route::get('finance/ywancheng','FinanceController@ywancheng')->name('admin.finance.ywancheng');
        Route::get('finance/yguanbi','FinanceController@yguanbi')->name('admin.finance.yguanbi');
        Route::get('finance/payinfo','FinanceController@payinfo')->name('admin.finance.payinfo');

        # 修改收货人地址
        Route::get('/address','AddressController@index')->name('admin.address.edit');
        Route::post('/address/update','AddressController@update')->name('admin.address.update');

        #订单管理
        Route::post('orders/confirm','FinanceController@confirm')->name('admin.order.confirm');
        Route::post('orders/send','FinanceController@send')->name('admin.order.send');
        Route::post('orders/wancheng','FinanceController@wancheng')->name('admin.order.wancheng');
        Route::post('orders/quxiao','FinanceController@quxiao')->name('admin.order.quxiao');

        Route::get('orders','OrderController@index')->name('admin.order.index');
        Route::post('orders/{order}/access','Admin\OrderController@access')->name('admin.order.access');
        Route::post('orders/{order}/deliver','Admin\OrderController@deliver')->name('admin.order.deliver');
        Route::post('orders/{order}/complete','Admin\OrderController@complete')->name('admin.order.complete');

        #快递
        Route::post('express','KuaidiController@store');
        Route::get('express/edit','KuaidiController@edit');

        #用户
        Route::get('users','UserController@index')->name('admin.user.index');
        Route::get('tuijian_users','UserController@getTuijian')->name('admin.tjuser.index');
        Route::post('users/{user}/message','UserController@message')->name('admin.user.message');
        Route::get('users/recomlog','RecomLogController@index')->name('admin.user.recomlog');





        //#产品类型管理
        //Route::get('type', 'TypeController@index')->name('admin.type.index');
        //Route::post('type/store', 'TypeController@store')->name('admin.type.store');
        //Route::get('type/{type}/show', 'TypeController@show')->name('admin.type.show');
        //Route::post('type/{type}/update', 'TypeController@update')->name('admin.type.update');
        //Route::delete('type/{type}/delete', 'TypeController@delete')->name('admin.type.delete');
        //#商品属性
        //Route::get('type/{type}/attributes', 'AttributeController@index')->name('admin.attributes.index');
        //Route::post('type/{type}/attributes/store', 'AttributeController@store')->name('admin.attributes.store');
        //Route::get('type/{type}/attributes/{attribute}/show', 'AttributeController@show')->name('admin.attributes.show');
        //Route::post('type/{type}/attributes/{attribute}/update', 'AttributeController@update')->name('admin.attributes.update');
        //Route::delete('type/attributes/{attribute}/delete', 'AttributeController@delete')->name('admin.attributes.delete');
        //
        //
        //#**************
        //Route::get('/types/ajax_types','TypeController@ajaxTypes')->name('goods.create');
        //Route::get('/types/{type_id}/attributes/ajax_attributes','AttributeController@ajaxAttributes')->name('goods.create');
        //Route::get('/types/{type_id}/attributes/ajax_edit_attr','AttributeController@ajaxEditAttr')->name('goods.edit');
        //
        //
        //#*************
        //
        ////商品库存管理
        //Route::get('/goods/{goods_id}/numbers', 'NumberController@index')->name('admin.numbers.index');
        //Route::post('/goods/{goods_id}/numbers', 'NumberController@store')->name('numbers.index');
        //




    });

});