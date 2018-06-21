<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Goods;
use Illuminate\Http\Request;

class GoodsController extends Controller
{
    public function index()
    {
        $goods = Goods::orderBy('sort', 'desc')->get();

        return admin_view('goods.index', compact('goods'));
    }

    public function create()
    {
        $category = Category::orderBy('sort', 'desc')->get();

        return admin_view('goods.show', compact('category'));
    }

    public function store(Request $request)
    {
        Goods::create($request->all());

        return ['status' => true];
    }


    public function edit(Request $request,Goods $goods)
    {
        $category = Category::orderBy('sort', 'desc')->get();

        return admin_view('goods.show', compact('goods','category'));
    }

    public function update(Request $request,Goods $goods)
    {
        $goods->update($request->all());
        return ['status' => true];

    }

    public function destroy(Goods $goods)
    {
        $goods->delete();
        return renderJS('删除成功',route('admin.goods.index'));

    }
}