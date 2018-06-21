<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryBanner;
use Illuminate\Http\Request;

class CategoryBannerController extends Controller
{
    public function index()
    {
        $banners = CategoryBanner::orderBy('sort', 'desc')->get();
        $category= Category::orderBy('sort','desc')->get();
        return admin_view('categorybanner.index', compact('banners','category'));
    }

    public function store(Request $request)
    {
        $category_id= $request->get('category_id','0');
        $title= $request->get('title','');
        $url = $request->get('url','');
        $image=$request->get('image','');
        $slideshow= new CategoryBanner();
        $slideshow->title= $title;
        $slideshow->category_id= $category_id;
        $slideshow->url= $url;
        $slideshow->image= $image;
        $slideshow->save();
        return ['status'=>true];
    }

    public function show(CategoryBanner $categoryBanner)
    {

        $banners = CategoryBanner::orderBy('sort','desc')->get();
        $category= Category::orderBy('sort','desc')->get();

        return admin_view('categorybanner.index',compact('banners','category','categoryBanner'));
    }


    public function update(Request $request, CategoryBanner $categoryBanner)
    {
        $title= $request->get('title','');
        $url = $request->get('url','');
        $image=$request->get('image','');

        $categoryBanner->title= $title;
        $categoryBanner->url= $url;
        $categoryBanner->image= $image;
        $categoryBanner->save();
        return ['status'=>true];
    }

    public function destroy(CategoryBanner $categoryBanner)
    {
        $categoryBanner->delete();
        return ['status'=>true];
    }


    public function sort(CategoryBanner $categoryBanner,Request $request)
    {
        $categoryBanner->sort=$request->sort;
        $categoryBanner->update();
        return ['status'=>true];
    }
}