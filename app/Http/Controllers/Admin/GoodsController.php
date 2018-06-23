<?php

namespace App\Http\Controllers\Admin;

use App\Models\Fenji;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Goods;
use App\Models\Jibie;
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

    public function edit(Request $request, Goods $goods)
    {
        $category = Category::orderBy('sort', 'desc')->get();

        return admin_view('goods.show', compact('goods', 'category'));
    }

    public function update(Request $request, Goods $goods)
    {
        $goods->update($request->all());

        return ['status' => true];
    }

    public function destroy(Goods $goods)
    {
        $goods->delete();

        return renderJS('删除成功', route('admin.goods.index'));
    }

    # 产品记录
    public function info(Goods $goods)
    {
        //销售记录
        $pay_order = PayOrder::where(['target_type' => $goods->id])->get();

        //库存变更历史
        $stock_change_lists = ProductStockChangeLog::where(['product_id' => $goods->id])->orderBy('id', 'desc')->get();

        return admin_view('goods.info', compact('goods', 'stock_change_lists'));
    }

    #设置各级会员的价格
    public function price(Goods $goods)
    {
        $fenji_price = Fenji::where('goods_id', $goods->id)->get()->pluck('jb_price', 'jibie');



        $fenji_rebase = Fenji::where('goods_id', $goods->id)->get()->pluck('jb_rebase', 'jibie');
        $jibie = Jibie::orderBy('id', 'desc')->get();

        return admin_view('goods.price', compact('goods', 'jibie', 'fenji_price', 'fenji_rebase'));
    }

    #保存各级会员的价格

    public function saveprice(Request $request, Goods $goods)
    {


        $jb_price = $request->get('jb_price');
        $jb_rebase = $request->get('jb_rebase');
        $jibie = $request->get('jibie');

        if (Fenji::where(['goods_id' => $goods->id])->get()->count() > 0) {
            Fenji::where(['goods_id' => $goods->id])->delete();
        }

        foreach ($jb_price as $id => $number) {
            $model = new Fenji();
            $model->goods_id = $goods->id;
            $model->jibie = $jibie[$id];
            $model->jb_price = $jb_price[$id];
            $model->jb_rebase = $jb_rebase[$id];
            $model->save();
        }

        return renderJS('更新成功', route('admin.goods.index'));
    }
}