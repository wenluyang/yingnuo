<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryBanner;
use App\Models\Goods;

class CategoryController extends Controller
{
    public function index()
    {
        // 用于分享的参数
        $title = config('盈诺产品中心');
        $imgUrl = config('webinfo.imgUrl');
        $desc = config('webinfo.desc');
        $category = Category::where(['is_show' => 1])->orderBy('sort', 'desc')->get();
        $banners = CategoryBanner::orderBy('sort','desc')->get();
        return home_view('category.index', compact('category','banners','title','imgUrl','desc'));
    }

    public function show(Category $category)
    {
        $banners = CategoryBanner::orderBy('sort','desc')->get();


        return home_view('category.show', compact('category','banners'));
    }
}