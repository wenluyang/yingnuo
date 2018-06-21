<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Route;
use Auth;

/**
 * 后台管理导航菜单数据
 */
class AdminNav
{
    public function compose(View $view)
    {
        if ($admin = Auth::user()) {
            $nav = [];

            // 超级管理员有管理员权限
            if ($admin->id == 1) {
                $nav = array_merge($nav, [
                    'home' => [
                        'name' => '后台首页',
                        'route' => 'admin.home.index',

                    ],

                    'config' => [
                        'name' => '系统设置',
                        'route' => 'admin.banner.index',
                        'functions' => [
                            'banner' => ['name' => '首页轮播图管理', 'route' => 'admin.banner.index', 'display' => true],
                            'banner.show' => ['name' => '轮播图更新', 'route' => 'admin.banner.show', 'display' => false],

                        ],

                    ],

                    'page' => [
                        'name' => '单页管理',
                        'route' => 'admin.page.index',
                        'functions' => [
                            'index' => ['name' => '单页列表', 'route' => 'admin.page.index', 'display' => true],
                            'create' => ['name' => '创建单页面', 'route' => 'admin.page.create', 'display' => false],
                            'show'   => ['name' => '单页内容详情', 'route' => 'admin.page.show', 'display' => false],
                        ],
                    ],



                    'news' => [
                        'name' => '新闻管理',
                        'route' => 'admin.newscat.index',
                        'functions' => [
                            'index' => ['name' => '新闻列表', 'route' => 'admin.news.index', 'display' => true],
                            'create' => ['name' => '新闻创建', 'route' => 'admin.news.create', 'display' => true],
                            'show'   => ['name' => '新闻详情', 'route' => 'admin.news.show', 'display' => false],
                            'category' => ['name' => '新闻分类', 'route' => 'admin.newscat.index', 'display' => true],
                            'catshow'   => ['name' => '新闻分类详情', 'route' => 'admin.newscat.show', 'display' => false],
                        ],
                    ],



                    'shcool' => [
                        'name' => '商学院管理',
                        'route' => 'admin.articlecat.index',
                        'functions' => [
                            'index' => ['name' => '商学院文章列表', 'route' => 'admin.article.index', 'display' => true],
                            'create' => ['name' => '商学院文章创建', 'route' => 'admin.article.create', 'display' => true],
                            'show'   => ['name' => '商学院文章详情', 'route' => 'admin.article.show', 'display' => false],
                            'category' => ['name' => '商学院分类', 'route' => 'admin.articlecat.index', 'display' => true],
                            'catshow'   => ['name' => '商学院分类详情', 'route' => 'admin.articlecat.show', 'display' => false],
                        ],
                    ],



                    'category' => [
                        'name' => '产品分类管理',
                        'route' => 'admin.category.index',
                        'functions' => [
                            'index' => ['name' => '产品分类列表', 'route' => 'admin.category.index', 'display' => true],
                            'show'   => ['name' => '产品分类详情', 'route' => 'admin.category.show', 'display' => false],
                            'catgegorybanner'   => ['name' => '产品分类轮播', 'route' => 'admin.catbanner.index', 'display' => true],
                            'catgegorybanner.edit'   => ['name' => '产品分类轮播修改', 'route' => 'admin.catbanner.show', 'display' => false],

                        ],
                    ],


                    'product' => [
                        'name' => '产品管理',
                        'route' => 'admin.goods.index',
                        'functions' => [
                            'index' => ['name' => '产品列表', 'route' => 'admin.goods.index', 'display' => true],
                            'create'   => ['name' => '产品添加', 'route' => 'admin.goods.create', 'display' => true],
                            'edit'   => ['name' => '产品编辑', 'route' => 'admin.goods.edit', 'display' => false],

                        ],
                    ],










                    //'users' => [
                    //    'name' => '用户管理',
                    //    'route' => 'admin.articlecat.index',
                    //    'functions' => [
                    //        'index' => ['name' => '用户列表', 'route' => 'admin.article.index', 'display' => true],
                    //        'create' => ['name' => '商学院文章创建', 'route' => 'admin.article.create', 'display' => true],
                    //        'show'   => ['name' => '商学院文章详情', 'route' => 'admin.article.show', 'display' => false],
                    //        'category' => ['name' => '商学院分类', 'route' => 'admin.articlecat.index', 'display' => true],
                    //        'catshow'   => ['name' => '商学院分类详情', 'route' => 'admin.articlecat.show', 'display' => false],
                    //    ],
                    //],
                    //
                    //
                    //
                    //
                    //'orders' => [
                    //    'name' => '订单管理',
                    //    'route' => 'admin.articlecat.index',
                    //    'functions' => [
                    //        'index' => ['name' => '商学院文章列表', 'route' => 'admin.article.index', 'display' => true],
                    //        'create' => ['name' => '商学院文章创建', 'route' => 'admin.article.create', 'display' => true],
                    //        'show'   => ['name' => '商学院文章详情', 'route' => 'admin.article.show', 'display' => false],
                    //        'category' => ['name' => '商学院分类', 'route' => 'admin.articlecat.index', 'display' => true],
                    //        'catshow'   => ['name' => '商学院分类详情', 'route' => 'admin.articlecat.show', 'display' => false],
                    //    ],
                    //],




                    //
                    //'user' => [
                    //    'name' => '用户管理',
                    //    'route' => 'admin.user.index',
                    //    'functions' => [
                    //        'index' => ['name' => '用户列表', 'route' => 'admin.user.index', 'display' => true],
                    //        'guanxi' => ['name' => '推荐关系表', 'route' => 'admin.tjuser.index', 'display' => true],
                    //        'recomlog'   => ['name' => '推荐日志', 'route' => 'admin.user.recomlog', 'display' => true],
                    //    ],
                    //],
                    //
                    //
                    //
                    //'order' => [
                    //    'name' => '财务管理',
                    //    'route' => 'admin.finance.index',
                    //    'functions' => [
                    //        'index' => ['name' => '订单列表', 'route' => 'admin.finance.index', 'display' => true],
                    //        'payinfo' => ['name' => '订单详情', 'route' => 'admin.finance.payinfo', 'display' => false],
                    //
                    //    ],
                    //],


                ]);
            }

            $navActive = [
                'route'    => Route::currentRouteName(),
                'module'   => null,
                'function' => null,
                'action'   => null,
            ];

            foreach ($nav as $moduleKey => $module) {
                if ($module['route'] == $navActive['route']) {
                    $navActive['module'] = $moduleKey;
                }
                if (isset($module['functions'])) {
                    foreach ($module['functions'] as $functionKey => $function) {
                        if ($function['route'] == $navActive['route']) {
                            $navActive['module'] = $moduleKey;
                            $navActive['function'] = $functionKey;
                        }
                        if (isset($function['actions'])) {
                            foreach ($function['actions'] as $actionKey => $action) {
                                if ($action['route'] == $navActive['route']) {
                                    $navActive['module'] = $moduleKey;
                                    $navActive['function'] = $functionKey;
                                    $navActive['action'] = $actionKey;
                                    break;
                                }
                            }
                            if ($navActive['function']) {
                                break;
                            }
                        }
                    }
                    if ($navActive['module']) {
                        break;
                    }
                }
            }

            $view->with(compact('nav', 'navActive'));
        }
    }
}
