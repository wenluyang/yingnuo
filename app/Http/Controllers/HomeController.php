<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Banner;
use App\Models\Category;
use App\Models\News;

class HomeController extends Controller
{
    public function index()
    {
        // 用于分享的参数
        $title = config('webinfo.title');
        $imgUrl = config('webinfo.imgUrl');
        $desc = config('webinfo.desc');
        //首页幻灯
        $banners = Banner::orderBy('sort', 'desc')->get();
        //4条推荐的商学院信息
        $articles = Article::where(['recom' => 1, 'status' => 1])->orderBy('id', 'desc')->limit(4)->get();
        // 5条推荐的公司新闻
        $news = News::where(['recom' => 1, 'status' => 1])->orderBy('id', 'desc')->limit(5)->get();
        //4个产品分类
        $category = Category::where(['is_show' => 1])->orderBy('sort', 'desc')->limit(4)->get();

        return home_view('index', [
            'title' => $title,
            'imgUrl' => $imgUrl,
            'desc' => $desc,
            'banners' => $banners,
            'articles' => $articles,
            'news' => $news,
            'category' => $category,

        ]);
    }
}