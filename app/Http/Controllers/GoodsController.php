<?php

namespace App\Http\Controllers;

use App\Models\Fenji;
use App\Models\MemberAddress;
use App\Models\Category;
use App\Models\Goods;
use App\Models\MemberCart;
use App\Models\MemberFav;
use App\Repositories\PayOrderRes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GoodsController extends Controller
{
    public function show(Goods $goods)
    {
        //根据会员级别获得当前的价格体系
        $jibie = \Auth::user()->jibie;
        $price= Fenji::where(['jibie'=>$jibie,'goods_id'=>$goods->id])->first();
        return home_view('goods.show',compact('category','goods','price'));
    }

    //浏览量
    public function ops(Request $request)
    {
        $act = $request->get('act');
        $product_id = intval($request->get('product_id', 0));
        $product_info = Goods::where(['id'=>$product_id])->first();
        if (! $product_info) {
            return renderJSON([], '系统繁忙，请稍后再试~~', -1);
        }
        $product_info->view_count += 1;
        $product_info->save();

        return renderJSON([]);
    }

    //产品收藏
    public function fav(Request $request)
    {


        $act = $request->get('act');
        $id = intval($request->get('id', 0));
        $product_id = intval($request->get('product_id', 0));

        if (! in_array($act, ["del", "set"])) {
            return renderJSON([], '系统繁忙，请稍后再试~~', -1);
        }

        if ($act == "del") {
            if (! $id) {
                return renderJSON([], '系统繁忙，请稍后再试~~', -1);
            }

            $fav_info = MemberFav::where(['user_id' => CurrentUserId(), 'id' => $id])->first();
            if ($fav_info) {
                $fav_info->delete();
            }

            return renderJSON([], "操作成功~~");
        }

        if (! $product_id) {
            return renderJSON([], '系统繁忙，请稍后再试~~', -1);
        }

        $has_faved = MemberFav::where(['user_id' => CurrentUserId(), 'product_id' => $product_id])->count();
        if ($has_faved) {
            return renderJSON([], "已收藏~~", -1);
        }

        $model_fav = new MemberFav();
        $model_fav->user_id = Auth::user()->id;
        $model_fav->product_id = $product_id;
        $model_fav->save();

        return renderJSON([], "收藏成功~~");
    }

    //购物车
    public function cart(Request $request)
    {

        if ($request->isMethod('get')) {
            $list = MemberCart::where(['user_id' => CurrentUserId()])->orderBy('id', 'desc')->get();


            //根据会员级别获得当前的价格体系
            $jibie = \Auth::user()->jibie;
            $price= Fenji::where(['jibie'=>$jibie])->get()->pluck('jb_price','goods_id');

            $data = [];
            if ($list) {
                foreach ($list as $_item) {
                    $product_mapping = $_item->belongsToProduct;
                    $data[] = [
                        'id' => $_item['id'],
                        'quantity' => $_item['quantity'],
                        'product_id' => $_item['product_id'],
                        'product_price' => $price[$_item['product_id']],
                        'product_stock' => $product_mapping['stock'],
                        'product_name' => $product_mapping['name'],
                        'product_main_image' => buildPicUrl($product_mapping['image']),
                    ];
                }
            }

            return home_view("goods.cart", compact('data'));
        }

        $act = $request->get('act', '');
        $id = intval($request->get('id', 0));
        $product_id = intval($request->get('product_id', 0));
        $quantity = intval($request->get('quantity', 0));

        if (! in_array($act, ["del", "set"])) {
            return renderJSON([], '系统繁忙，请稍后再试~~', -1);
        }

        if ($act == "del") {
            $cart_info = MemberCart::where(['user_id' => CurrentUserId(), 'id' => $id])->first();
            if ($cart_info) {
                $cart_info->delete();
            }

            return renderJSON([], "操作成功~~");
        }

        if (! $product_id || ! $quantity) {
            return renderJSON([], '系统繁忙，请稍后再试~~', -1);
        }

        $product_info = Goods::where(['id' => $product_id])->first();
        //dd($product_info);
        if (! $product_info) {
            return renderJSON([], '系统繁忙，请稍后再试~~', -1);
        }

        $cart_info = MemberCart::where(['user_id' => CurrentUserId(), 'product_id' => $product_id])->first();
        if ($cart_info) {
            $model_cart = $cart_info;
        } else {
            $model_cart = new MemberCart();
            $model_cart->user_id = CurrentUserId();
        }

        $model_cart->product_id = $product_id;
        $model_cart->quantity = $quantity;

        $model_cart->save();

        return renderJSON([], "操作成功~~");
    }


    //下单
    public function order(Request $request)
    {
        //根据会员级别获得当前的价格体系
        $jibie = \Auth::user()->jibie;
        $price= Fenji::where(['jibie'=>$jibie])->get()->pluck('jb_price','goods_id');


        if ($request->isMethod('get')) {
            $product_id = intval($request->get('id', 0));
            $quantity = intval($request->get('quantity', 0));
            $sc = $request->get('sc', 'product');//sc source 来源
            $product_list = [];
            $total_pay_money = 0;
            if ($product_id) {
                $product_info = Goods::where(['id' => $product_id])->first();

                if ($product_info) {
                    $product_list[] = [
                        'id' => $product_info['id'],
                        'name' => $product_info['name'],
                        'quantity' => $quantity,
                        'price' => $price[$product_info['id']],
                        'main_image' => buildPicUrl($product_info['image']),
                    ];
                    $total_pay_money += $product_info['price'] * $quantity;
                }
            } else {//从购物车中获取商品信息
                $cart_list = MemberCart::where(['user_id' => CurrentUserId()])->get();
                if ($cart_list) {
                    foreach ($cart_list as $_item) {
                        $product_mapping = $_item->belongsToProduct;
                        $product_list[] = [
                            'id' => $_item['product_id'],
                            'name' => $product_mapping->name,
                            'quantity' => $_item['quantity'],
                            'price' =>$price[$_item['product_id']],
                            'main_image' => buildPicUrl($product_mapping->image),
                        ];
                        $total_pay_money += $product_mapping->price * $_item['quantity'];
                    }
                }
            }

            $address_list = MemberAddress::where([
                'user_id' => CurrentUserId(),
                'status' => 1,
            ])->orderBy('is_default', 'desc')->orderBy('id', 'desc')->get();


            $data_address = [];
            if ($address_list) {

                foreach ($address_list as $_item) {
                    $area_mapping = $_item->belongsToCity;
                    $tmp_area = $area_mapping->province.$area_mapping->city;
                    if ($_item['province_id'] != $_item['city_id']) {
                        $tmp_area .= $area_mapping->area;
                    }

                    $data_address[] = [
                        'id' => $_item['id'],
                        'is_default' => $_item['is_default'],
                        'nickname' => $_item['nickname'],
                        'mobile' => $_item['mobile'],
                        'address' => $area_mapping->address,
                    ];
                }
            }

            return home_view('goods.order', compact('product_list', 'address_list', 'sc', 'total_pay_money'));
        }

        $sc = trim($request->input('sc', ''));
        $product_items = $request->input('product_items', []);
        $address_id = intval($request->input('address_id', 0));

        if (! $address_id) {
            return renderJSON([], "请选择收货地址~~", -1);
        }

        if (! $product_items) {
            return renderJSON([], "请选择商品之后在提交~~", -1);
        }

        $product_ids = [];
        foreach ($product_items as $_item) {
            $tmp_item_info = explode("#", $_item);
            $product_ids[] = $tmp_item_info[0];
        }

        $product_mapping = Goods::where('id', 'in', $product_ids)->get();

        if (! $product_mapping) {
            return renderJSON([], "请选择商品之后在提交~~", -1);
        }

        $target_type = 1;
        $items = [];
        foreach ($product_items as $_item) {
            $tmp_item_info = explode("#", $_item);
            $tmp_product_info = Goods::where('id', '=', $tmp_item_info[0])->first();

            $items[] = [
                'price' => $price[$tmp_item_info[0]] * $tmp_item_info[1],
                'quantity' => $tmp_item_info[1],
                'target_type' => $target_type,
                'target_id' => $tmp_item_info[0],
            ];
        }

        $params = [
            'pay_type' => 1,
            'pay_source' => 2,
            'target_type' => $target_type,
            'note' => '购买产品',
            'status' => -8,
            'express_address_id' => $address_id,
        ];

        $ret = PayOrderRes::createPayOrder(CurrentUserId(), $items, $params);

        if (! $ret) {
            return renderJSON([], "提交失败", -1);
        }

        if ($sc == "cart") {//如果从购物车创建订单，需要清空购物车了
            MemberCart::where(['user_id' => CurrentUserId()])->delete();
        }

        return renderJSON([], "成功下单~~ 请等待客服人员的确认");
    }



}