<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Page;

class PageController extends Controller
{

    public function index()
    {
        $pages = Page::orderBy('id', 'desc')->get();
        return admin_view('page.index',compact('pages'));
    }


    public function create()
    {
        return admin_view('page.show');
    }


    public function store(Request $request)
    {
        $title = $request->get('title');
        $content = $request->get('content');
        $image = $request->get('image');

        $page = new Page();
        $page->title = $title;
        $page->content = $content;
        $page->image = $image;
        $page->save();
        return ['status' => true];
    }


    public function show(Page $page)
    {
        return admin_view('page.show',compact('page'));
    }



    public function update(Request $request, Page $page)
    {
        $title = $request->get('title');
        $content = $request->get('content');
        $image = $request->get('image');

        $page->title = $title;
        $page->content = $content;
        $page->image = $image;
        $page->save();
        return ['status' => true];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
