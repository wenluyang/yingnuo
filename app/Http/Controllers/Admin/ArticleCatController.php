<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ArticleCat;
use Illuminate\Http\Request;

class ArticleCatController extends Controller
{
    public function index()
    {
        $articlecats = ArticleCat::orderBy('sort', 'desc')->get();

        return admin_view('articlecat.index', compact('articlecats'));
    }

    public function store(Request $request)
    {
        ArticleCat::create($request->all());

        return ['status' => true];
    }

    public function show(ArticleCat $articleCat)
    {

        $articlecats = ArticleCat::orderBy('sort', 'desc')->get();

        return admin_view('articlecat.index', compact('articlecats', 'articleCat'));
    }

    public function update(ArticleCat $articleCat, Request $request)
    {
        $articleCat->update($request->all());

        return ['status' => true];
    }

    public function delete(ArticleCat $articleCat)
    {
        $articleCat->delete();

        return ['status' => true];
    }

    public function hide(ArticleCat $articleCat)
    {
        $articleCat->status = 0;
        $articleCat->update();

        return ['status' => true];
    }

    public function display(ArticleCat $articleCat)
    {
        $articleCat->status = 1;
        $articleCat->update();

        return ['status' => true];
    }

    public function sort(ArticleCat $articleCat, Request $request)
    {
        $articleCat->sort = $request->sort;
        $articleCat->update();

        return ['status' => true];
    }
}