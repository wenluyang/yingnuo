<?php

namespace App\Http\Controllers\Admin;

use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BannerController extends Controller
{

    public function index()
    {
        $banners = Banner::orderBy('sort','desc')->get();
        return admin_view('banner.index',compact('banners'));
    }




    public function store(Request $request)
    {
        $title= $request->get('title','');
        $url = $request->get('url','');
        $image=$request->get('image','');
        $slideshow= new Banner();
        $slideshow->title= $title;
        $slideshow->url= $url;
        $slideshow->image= $image;
        $slideshow->save();
        return ['status'=>true];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
        $banners = Banner::orderBy('sort','desc')->get();

        return admin_view('banner.index',compact('banners','banner'));
    }




    public function update(Request $request, Banner $banner)
    {
        $title= $request->get('title','');
        $url = $request->get('url','');
        $image=$request->get('image','');

        $banner->title= $title;
        $banner->url= $url;
        $banner->image= $image;
        $banner->save();
        return ['status'=>true];
    }


    public function destroy(Banner $banner)
    {
        $banner->delete();
        return ['status'=>true];
    }


    public function sort(Banner $banner,Request $request)
    {
        $banner->sort=$request->sort;
        $banner->update();
        return ['status'=>true];
    }
}
