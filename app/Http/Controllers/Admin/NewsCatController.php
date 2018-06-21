<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsCat;
use Illuminate\Http\Request;

class NewsCatController extends Controller
{
    public function index()
    {
        $newscats = NewsCat::orderBy('sort','desc')->get();
        return admin_view('newscat.index',compact('newscats'));
    }

    public function store(Request $request)
    {
        $name = $request->get('name');
        $newscat = new NewsCat();
        $newscat->name= $name;
        $newscat->save();
        return ['status'=>true];
    }


    public function show(NewsCat $newsCat)
    {
        $newscats = NewsCat::orderBy('sort','desc')->get();
        return admin_view('newscat.index',compact('newscats','newsCat'));
    }

    public function update(NewsCat $newsCat,Request $request)
    {
        $name = $request->get('name');
        $newsCat->name= $name;
        $newsCat->save();
        return ['status'=>true];
    }

    public function hide(NewsCat $newsCat)
    {
        $newsCat->status=0;
        $newsCat->update();
        return ['status' => true];
    }

    public function display(NewsCat $newsCat)
    {
        $newsCat->status=1;
        $newsCat->update();
        return ['status' => true];
    }

    public function delete(NewsCat $newsCat)
    {
        $newsCat->delete();
        return ['status' => true];
    }

    public function sort(NewsCat $newsCat,Request $request)
    {
        $newsCat->sort=$request->sort;
        $newsCat->update();
        return ['status'=>true];

    }
}