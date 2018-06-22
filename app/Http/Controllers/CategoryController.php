<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryBanner;
use App\Models\Goods;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::where(['is_show' => 1])->orderBy('sort', 'desc')->get();

        return home_view('category.index', compact('category'));
    }

    public function show(Category $category)
    {
        $banners = CategoryBanner::orderBy('sort','desc')->get();


        return home_view('category.show', compact('category','banners'));
    }
}