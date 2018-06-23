<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Goods;
use App\Models\PayOrder;
use App\Models\ProductStockChangeLog;
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


    public function info(Goods $goods)
    {
        //销售记录
        $pay_order = PayOrder::where(['target_type'=>$goods->id])->get();

        //库存变更历史
        $stock_change_lists = ProductStockChangeLog::where([ 'product_id' => $goods->id ])
            ->orderBy('id','desc')->get();
        return admin_view('goods.info',compact('goods','stock_change_lists'));
    }
}