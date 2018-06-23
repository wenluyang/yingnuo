<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(Request $request)
    {
        $id= $request->get('id');
        $page= Page::where(['id'=>$id])->first();
        return home_view('page.index',compact('page'));
    }
}