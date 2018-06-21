<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $cats = Category::orderBy('sort', 'desc')->get();

        return admin_view('category.index', compact('cats'));
    }

    public function store(Request $request)
    {
        $name = $request->get('name');
        $description = $request->get('description');
        $content = $request->get('content');
        $image = $request->get('image');
        $category = new Category();
        $category->name = $name;
        $category->image = $image;
        $category->description = $description;
        $category->content = $content;
        $category->save();

        return ['status' => true];
    }

    public function show(Category $category)
    {
        $cats = Category::orderBy('sort', 'desc')->get();

        return admin_view('category.index', compact('cats', 'category'));
    }

    public function update(Request $request, Category $category)
    {
        $name = $request->get('name');
        $description = $request->get('description');
        $content = $request->get('content');
        $image = $request->get('image');
        $category->name = $name;
        $category->image = $image;
        $category->description = $description;
        $category->content = $content;
        $category->save();

        return ['status' => true];
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return ['status' => true];
    }

    public function hide(Category $category)
    {
        $category->is_show = 0;
        $category->update();

        return ['status' => true];
    }

    public function display(Category $category)
    {
        $category->is_show = 1;
        $category->update();

        return ['status' => true];
    }

    public function sort(Category $category, Request $request)
    {
        $category->sort = $request->sort;
        $category->update();

        return ['status' => true];
    }
}