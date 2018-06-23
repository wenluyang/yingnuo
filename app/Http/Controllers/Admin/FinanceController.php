<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Kuaidi;
use App\Models\MemberAddress;
use App\Models\PayOrder;
use App\Models\PayOrderItem;
use App\Models\Goods;
use App\Repositories\CityRes;
use App\Models\User;
use App\Repositories\StockChangeLogRes;
use Illuminate\Http\Request;
use App\Repositories\ConstantMapRes;

class FinanceController extends Controller
{
    //订单列表
    public function index(Request $request)
    {
        $status = intval($request->input('status', '-9'));
        $pay_status_mapping = ConstantMapRes::$pay_status_mapping;

        $linkParams = [];
        $linkParams['status'] = $status;
        if ($status>-9) {
            $query = PayOrder::where(['status' => $status])->orderBy('id', 'desc');

        }else
        {
            $query = PayOrder::orderBy('id', 'desc');
        }



        $list = $query->paginate(11);

        $all_list = PayOrder::orderBy('id', 'desc')->get()->toArray();

        $data = [];
        if ($list) {
            $order_item_list = PayOrderItem::whereIn('pay_order_id', array_column($all_list, "id"))->get()->toArray();

            $pay_order_mapping = [];
            foreach ($order_item_list as $_order_item_info) {

                $tmp_product_info = Goods::where(['id' => $_order_item_info['target_id']])->first();

                if (! isset($pay_order_mapping[$_order_item_info['pay_order_id']])) {
                    $pay_order_mapping[$_order_item_info['pay_order_id']] = [];
                }

                $pay_order_mapping[$_order_item_info['pay_order_id']][] = [
                    'name' => $tmp_product_info['name'],
                    'quantity' => $_order_item_info['quantity'],
                ];
            }



            foreach ($list as $_item) {

                $data[] = [
                    'id' => $_item['id'],
                    'realname' => User::where(['id'=>$_item['user_id']])->first()->realname,

                    'user_mobile' => User::where(['id'=>$_item['user_id']])->first()->mobile,
                    'sn' => date("Ymd", strtotime($_item['created_at'])).$_item['id'],
                    'total_price' => $_item['total_price'],

                    'receiver' => MemberAddress::where(['id'=>$_item['express_address_id']])->first()->nickname,
                    'reciver_new' => PayOrder::where(['id'=> $_item['id']])->first()->reciver_new,
                    'mobile' => MemberAddress::where(['id'=>$_item['express_address_id']])->first()->mobile,
                    'mobile_new' => PayOrder::where(['id'=> $_item['id']])->first()->mobile_new,
                    'address' => MemberAddress::where(['id'=>$_item['express_address_id']])->first()->address,
                    'address_new' => PayOrder::where(['id'=> $_item['id']])->first()->address_new,



                    'provide' => MemberAddress::where(['id'=>$_item['express_address_id']])->first()->belongsToCity->province,
                    'city' => MemberAddress::where(['id'=>$_item['express_address_id']])->first()->belongsToCity->city,
                    'area' => MemberAddress::where(['id'=>$_item['express_address_id']])->first()->belongsToCity->area,
                    'express_status' => $_item['express_status'],
                    'express_status_desc' => ConstantMapRes::$express_status_mapping[$_item['express_status']],
                    'status_desc' => ConstantMapRes::$pay_status_mapping[$_item['status']],
                    'status' => $_item['status'],
                    'pay_time' => date("Y-m-d H:i", strtotime($_item['pay_time'])),
                    'created_time' => date("Y-m-d H:i", strtotime($_item['created_at'])),
                    'items' => isset($pay_order_mapping[$_item['id']]) ? $pay_order_mapping[$_item['id']] : [],
                ];
            }
        }

        $search_conditions= ['status' => $status];


        return admin_view('finance.index', compact('list','data','pay_status_mapping','search_conditions','linkParams'));
    }



    //待审核订单列表
    public function dshenhe(Request $request)
    {
        $status = -8;
        $pay_status_mapping = ConstantMapRes::$pay_status_mapping;

        $linkParams = [];
        $linkParams['status'] = $status;
        if ($status>-9) {
            $query = PayOrder::where(['status' => $status])->orderBy('id', 'desc');

        }else
        {
            $query = PayOrder::orderBy('id', 'desc');
        }



        $list = $query->paginate(11);

        $all_list = PayOrder::orderBy('id', 'desc')->get()->toArray();

        $data = [];
        if ($list) {
            $order_item_list = PayOrderItem::whereIn('pay_order_id', array_column($all_list, "id"))->get()->toArray();

            $pay_order_mapping = [];
            foreach ($order_item_list as $_order_item_info) {

                $tmp_product_info = Goods::where(['id' => $_order_item_info['target_id']])->first();

                if (! isset($pay_order_mapping[$_order_item_info['pay_order_id']])) {
                    $pay_order_mapping[$_order_item_info['pay_order_id']] = [];
                }

                $pay_order_mapping[$_order_item_info['pay_order_id']][] = [
                    'name' => $tmp_product_info['name'],
                    'quantity' => $_order_item_info['quantity'],
                ];
            }



            foreach ($list as $_item) {

                $data[] = [
                    'id' => $_item['id'],
                    'realname' => User::where(['id'=>$_item['user_id']])->first()->realname,
                    'user_mobile' => User::where(['id'=>$_item['user_id']])->first()->mobile,
                    'sn' => date("Ymd", strtotime($_item['created_at'])).$_item['id'],
                    'total_price' => $_item['total_price'],
                    'receiver' => MemberAddress::where(['id'=>$_item['express_address_id']])->first()->nickname,
                    'reciver_new' => PayOrder::where(['id'=> $_item['id']])->first()->reciver_new,
                    'mobile' => MemberAddress::where(['id'=>$_item['express_address_id']])->first()->mobile,
                    'mobile_new' => PayOrder::where(['id'=> $_item['id']])->first()->mobile_new,
                    'address' => MemberAddress::where(['id'=>$_item['express_address_id']])->first()->address,
                    'address_new' => PayOrder::where(['id'=> $_item['id']])->first()->address_new,
                    'provide' => MemberAddress::where(['id'=>$_item['express_address_id']])->first()->belongsToCity->province,
                    'city' => MemberAddress::where(['id'=>$_item['express_address_id']])->first()->belongsToCity->city,
                    'area' => MemberAddress::where(['id'=>$_item['express_address_id']])->first()->belongsToCity->area,
                    'express_status' => $_item['express_status'],
                    'express_status_desc' => ConstantMapRes::$express_status_mapping[$_item['express_status']],
                    'status_desc' => ConstantMapRes::$pay_status_mapping[$_item['status']],
                    'status' => $_item['status'],
                    'pay_time' => date("Y-m-d H:i", strtotime($_item['pay_time'])),
                    'created_time' => date("Y-m-d H:i", strtotime($_item['created_at'])),
                    'items' => isset($pay_order_mapping[$_item['id']]) ? $pay_order_mapping[$_item['id']] : [],
                ];
            }
        }

        $search_conditions= ['status' => $status];


        return admin_view('finance.index', compact('list','data','pay_status_mapping','search_conditions','linkParams'));
    }



    //已审核订单列表
    public function yqueren(Request $request)
    {
        $status = 1;
        $pay_status_mapping = ConstantMapRes::$pay_status_mapping;

        $linkParams = [];
        $linkParams['status'] = $status;
        if ($status>-9) {
            $query = PayOrder::where(['status' => $status,'express_status'=>-7])->orderBy('id', 'desc');

        }else
        {
            $query = PayOrder::orderBy('id', 'desc');
        }



        $list = $query->paginate(11);

        $all_list = PayOrder::orderBy('id', 'desc')->get()->toArray();

        $data = [];
        if ($list) {
            $order_item_list = PayOrderItem::whereIn('pay_order_id', array_column($all_list, "id"))->get()->toArray();

            $pay_order_mapping = [];
            foreach ($order_item_list as $_order_item_info) {

                $tmp_product_info = Goods::where(['id' => $_order_item_info['target_id']])->first();

                if (! isset($pay_order_mapping[$_order_item_info['pay_order_id']])) {
                    $pay_order_mapping[$_order_item_info['pay_order_id']] = [];
                }

                $pay_order_mapping[$_order_item_info['pay_order_id']][] = [
                    'name' => $tmp_product_info['name'],
                    'quantity' => $_order_item_info['quantity'],
                ];
            }



            foreach ($list as $_item) {

                $data[] = [
                    'id' => $_item['id'],
                    'realname' => User::where(['id'=>$_item['user_id']])->first()->realname,
                    'user_mobile' => User::where(['id'=>$_item['user_id']])->first()->mobile,
                    'sn' => date("Ymd", strtotime($_item['created_at'])).$_item['id'],
                    'total_price' => $_item['total_price'],
                    'receiver' => MemberAddress::where(['id'=>$_item['express_address_id']])->first()->nickname,
                    'reciver_new' => PayOrder::where(['id'=> $_item['id']])->first()->reciver_new,
                    'mobile' => MemberAddress::where(['id'=>$_item['express_address_id']])->first()->mobile,
                    'mobile_new' => PayOrder::where(['id'=> $_item['id']])->first()->mobile_new,
                    'address' => MemberAddress::where(['id'=>$_item['express_address_id']])->first()->address,
                    'address_new' => PayOrder::where(['id'=> $_item['id']])->first()->address_new,
                    'provide' => MemberAddress::where(['id'=>$_item['express_address_id']])->first()->belongsToCity->province,
                    'city' => MemberAddress::where(['id'=>$_item['express_address_id']])->first()->belongsToCity->city,
                    'area' => MemberAddress::where(['id'=>$_item['express_address_id']])->first()->belongsToCity->area,
                    'express_status' => $_item['express_status'],
                    'express_status_desc' => ConstantMapRes::$express_status_mapping[$_item['express_status']],
                    'status_desc' => ConstantMapRes::$pay_status_mapping[$_item['status']],
                    'status' => $_item['status'],
                    'pay_time' => date("Y-m-d H:i", strtotime($_item['pay_time'])),
                    'created_time' => date("Y-m-d H:i", strtotime($_item['created_at'])),
                    'items' => isset($pay_order_mapping[$_item['id']]) ? $pay_order_mapping[$_item['id']] : [],
                ];
            }
        }

        $search_conditions= ['status' => $status];


        return admin_view('finance.index', compact('list','data','pay_status_mapping','search_conditions','linkParams'));
    }



    //已审核订单列表
    public function yfahuo(Request $request)
    {
        $status = 1;
        $pay_status_mapping = ConstantMapRes::$pay_status_mapping;

        $linkParams = [];
        $linkParams['status'] = $status;
        if ($status>-9) {
            $query = PayOrder::where(['status' => $status,'express_status'=>-6])->orderBy('id', 'desc');

        }else
        {
            $query = PayOrder::orderBy('id', 'desc');
        }



        $list = $query->paginate(11);

        $all_list = PayOrder::orderBy('id', 'desc')->get()->toArray();

        $data = [];
        if ($list) {
            $order_item_list = PayOrderItem::whereIn('pay_order_id', array_column($all_list, "id"))->get()->toArray();

            $pay_order_mapping = [];
            foreach ($order_item_list as $_order_item_info) {

                $tmp_product_info = Goods::where(['id' => $_order_item_info['target_id']])->first();

                if (! isset($pay_order_mapping[$_order_item_info['pay_order_id']])) {
                    $pay_order_mapping[$_order_item_info['pay_order_id']] = [];
                }

                $pay_order_mapping[$_order_item_info['pay_order_id']][] = [
                    'name' => $tmp_product_info['name'],
                    'quantity' => $_order_item_info['quantity'],
                ];
            }



            foreach ($list as $_item) {

                $data[] = [
                    'id' => $_item['id'],
                    'realname' => User::where(['id'=>$_item['user_id']])->first()->realname,
                    'user_mobile' => User::where(['id'=>$_item['user_id']])->first()->mobile,
                    'sn' => date("Ymd", strtotime($_item['created_at'])).$_item['id'],
                    'total_price' => $_item['total_price'],
                    'receiver' => MemberAddress::where(['id'=>$_item['express_address_id']])->first()->nickname,
                    'reciver_new' => PayOrder::where(['id'=> $_item['id']])->first()->reciver_new,
                    'mobile' => MemberAddress::where(['id'=>$_item['express_address_id']])->first()->mobile,
                    'mobile_new' => PayOrder::where(['id'=> $_item['id']])->first()->mobile_new,
                    'address' => MemberAddress::where(['id'=>$_item['express_address_id']])->first()->address,
                    'address_new' => PayOrder::where(['id'=> $_item['id']])->first()->address_new,
                    'provide' => MemberAddress::where(['id'=>$_item['express_address_id']])->first()->belongsToCity->province,
                    'city' => MemberAddress::where(['id'=>$_item['express_address_id']])->first()->belongsToCity->city,
                    'area' => MemberAddress::where(['id'=>$_item['express_address_id']])->first()->belongsToCity->area,
                    'express_status' => $_item['express_status'],
                    'express_status_desc' => ConstantMapRes::$express_status_mapping[$_item['express_status']],
                    'status_desc' => ConstantMapRes::$pay_status_mapping[$_item['status']],
                    'status' => $_item['status'],
                    'pay_time' => date("Y-m-d H:i", strtotime($_item['pay_time'])),
                    'created_time' => date("Y-m-d H:i", strtotime($_item['created_at'])),
                    'items' => isset($pay_order_mapping[$_item['id']]) ? $pay_order_mapping[$_item['id']] : [],
                ];
            }
        }

        $search_conditions= ['status' => $status];


        return admin_view('finance.index', compact('list','data','pay_status_mapping','search_conditions','linkParams'));
    }



    //已完成订单列表
    public function ywancheng(Request $request)
    {
        $status = 1;
        $pay_status_mapping = ConstantMapRes::$pay_status_mapping;

        $linkParams = [];
        $linkParams['status'] = $status;
        if ($status>-9) {
            $query = PayOrder::where(['status' => $status,'express_status'=>1])->orderBy('id', 'desc');

        }else
        {
            $query = PayOrder::orderBy('id', 'desc');
        }



        $list = $query->paginate(11);

        $all_list = PayOrder::orderBy('id', 'desc')->get()->toArray();

        $data = [];
        if ($list) {
            $order_item_list = PayOrderItem::whereIn('pay_order_id', array_column($all_list, "id"))->get()->toArray();

            $pay_order_mapping = [];
            foreach ($order_item_list as $_order_item_info) {

                $tmp_product_info = Goods::where(['id' => $_order_item_info['target_id']])->first();

                if (! isset($pay_order_mapping[$_order_item_info['pay_order_id']])) {
                    $pay_order_mapping[$_order_item_info['pay_order_id']] = [];
                }

                $pay_order_mapping[$_order_item_info['pay_order_id']][] = [
                    'name' => $tmp_product_info['name'],
                    'quantity' => $_order_item_info['quantity'],
                ];
            }



            foreach ($list as $_item) {

                $data[] = [
                    'id' => $_item['id'],
                    'realname' => User::where(['id'=>$_item['user_id']])->first()->realname,
                    'user_mobile' => User::where(['id'=>$_item['user_id']])->first()->mobile,
                    'sn' => date("Ymd", strtotime($_item['created_at'])).$_item['id'],
                    'total_price' => $_item['total_price'],
                    'receiver' => MemberAddress::where(['id'=>$_item['express_address_id']])->first()->nickname,
                    'reciver_new' => PayOrder::where(['id'=> $_item['id']])->first()->reciver_new,
                    'mobile' => MemberAddress::where(['id'=>$_item['express_address_id']])->first()->mobile,
                    'mobile_new' => PayOrder::where(['id'=> $_item['id']])->first()->mobile_new,
                    'address' => MemberAddress::where(['id'=>$_item['express_address_id']])->first()->address,
                    'address_new' => PayOrder::where(['id'=> $_item['id']])->first()->address_new,
                    'provide' => MemberAddress::where(['id'=>$_item['express_address_id']])->first()->belongsToCity->province,
                    'city' => MemberAddress::where(['id'=>$_item['express_address_id']])->first()->belongsToCity->city,
                    'area' => MemberAddress::where(['id'=>$_item['express_address_id']])->first()->belongsToCity->area,
                    'express_status' => $_item['express_status'],
                    'express_status_desc' => ConstantMapRes::$express_status_mapping[$_item['express_status']],
                    'status_desc' => ConstantMapRes::$pay_status_mapping[$_item['status']],
                    'status' => $_item['status'],
                    'pay_time' => date("Y-m-d H:i", strtotime($_item['pay_time'])),
                    'created_time' => date("Y-m-d H:i", strtotime($_item['created_at'])),
                    'items' => isset($pay_order_mapping[$_item['id']]) ? $pay_order_mapping[$_item['id']] : [],
                ];
            }
        }

        $search_conditions= ['status' => $status];


        return admin_view('finance.index', compact('list','data','pay_status_mapping','search_conditions','linkParams'));
    }


    //已取消订单列表
    public function yguanbi(Request $request)
    {
        $status = 0;
        $pay_status_mapping = ConstantMapRes::$pay_status_mapping;

        $linkParams = [];
        $linkParams['status'] = $status;
        if ($status>-9) {
            $query = PayOrder::where(['status' => $status,'express_status'=>0])->orderBy('id', 'desc');

        }else
        {
            $query = PayOrder::orderBy('id', 'desc');
        }



        $list = $query->paginate(11);

        $all_list = PayOrder::orderBy('id', 'desc')->get()->toArray();

        $data = [];
        if ($list) {
            $order_item_list = PayOrderItem::whereIn('pay_order_id', array_column($all_list, "id"))->get()->toArray();

            $pay_order_mapping = [];
            foreach ($order_item_list as $_order_item_info) {

                $tmp_product_info = Goods::where(['id' => $_order_item_info['target_id']])->first();

                if (! isset($pay_order_mapping[$_order_item_info['pay_order_id']])) {
                    $pay_order_mapping[$_order_item_info['pay_order_id']] = [];
                }

                $pay_order_mapping[$_order_item_info['pay_order_id']][] = [
                    'name' => $tmp_product_info['name'],
                    'quantity' => $_order_item_info['quantity'],
                ];
            }



            foreach ($list as $_item) {

                $data[] = [
                    'id' => $_item['id'],
                    'realname' => User::where(['id'=>$_item['user_id']])->first()->realname,
                    'user_mobile' => User::where(['id'=>$_item['user_id']])->first()->mobile,
                    'sn' => date("Ymd", strtotime($_item['created_at'])).$_item['id'],
                    'total_price' => $_item['total_price'],
                    'receiver' => MemberAddress::where(['id'=>$_item['express_address_id']])->first()->nickname,
                    'reciver_new' => PayOrder::where(['id'=> $_item['id']])->first()->reciver_new,
                    'mobile' => MemberAddress::where(['id'=>$_item['express_address_id']])->first()->mobile,
                    'mobile_new' => PayOrder::where(['id'=> $_item['id']])->first()->mobile_new,
                    'address' => MemberAddress::where(['id'=>$_item['express_address_id']])->first()->address,
                    'address_new' => PayOrder::where(['id'=> $_item['id']])->first()->address_new,
                    'provide' => MemberAddress::where(['id'=>$_item['express_address_id']])->first()->belongsToCity->province,
                    'city' => MemberAddress::where(['id'=>$_item['express_address_id']])->first()->belongsToCity->city,
                    'area' => MemberAddress::where(['id'=>$_item['express_address_id']])->first()->belongsToCity->area,
                    'express_status' => $_item['express_status'],
                    'express_status_desc' => ConstantMapRes::$express_status_mapping[$_item['express_status']],
                    'status_desc' => ConstantMapRes::$pay_status_mapping[$_item['status']],
                    'status' => $_item['status'],
                    'pay_time' => date("Y-m-d H:i", strtotime($_item['pay_time'])),
                    'created_time' => date("Y-m-d H:i", strtotime($_item['created_at'])),
                    'items' => isset($pay_order_mapping[$_item['id']]) ? $pay_order_mapping[$_item['id']] : [],
                ];
            }
        }

        $search_conditions= ['status' => $status];


        return admin_view('finance.index', compact('list','data','pay_status_mapping','search_conditions','linkParams'));
    }


    //管理员手动完成订单
    public function wancheng(Request $request)
    {
        $id= $request->get('id');
        $query = PayOrder::where(['status' => 1,'id'=>$id])->orderBy('id', 'desc')->first();
        $query->express_status=1;
        $query->save();
        return ['status'=>true,'msg'=>'该订单已经被手动完成!'];

    }



    //管理员手动取消订单
    public function quxiao(Request $request)
    {
        $pay_order_id= $request->get('id');
        $query = PayOrder::where(['status' => -8,'id'=>$pay_order_id])->orderBy('id', 'desc')->first();

        $pay_order_items = PayOrderItem::where(['pay_order_id' => $pay_order_id])->get();

        if ($pay_order_items) {
            foreach ($pay_order_items as $_order_item_info) {

                switch ($_order_item_info['target_type']) {
                    case 1:

                        StockChangeLogRes::setStockChangeLog($_order_item_info['target_id'], $_order_item_info['quantity'], "订单取消或过期释放库存");
                        break;
                }
            }
        }

        $query->status=0;
        $query->express_status=0;
        $query->save();



        return ['status'=>true,'msg'=>'该订单已经被手动取消!'];

    }



    //订单详情
    public function payinfo(Request $request)
    {

        $id = intval( $request->input('id',0));
        $reback_url = route('admin.finance.index');
        if( !$id ){
            return redirect($reback_url);
        }


        $pay_order_info = PayOrder::where([ 'id' => $id ])->first();
        if( !$pay_order_info ){
            return redirect($reback_url);
        }

        $order_item_list = PayOrderItem::where([ 'pay_order_id' =>  $id ])->get()->toArray();
        $product_mapping = Goods::whereIn('id',array_column( $order_item_list,"target_id" ))->get()->toArray();




        $pay_order_items = [];
        foreach( $order_item_list as $_order_item_info ){
            $tmp_product_info =Goods::where(['id'=>$_order_item_info['target_id']])->first();


            $pay_order_items[] = [
                'name' => $tmp_product_info['name'],
                'quantity' => $_order_item_info['quantity'],
                'price' => $_order_item_info['price'],
                'image' => buildPicUrl($tmp_product_info['image']),
            ];
        }



        $data_pay_order_info = [
            'id' => $pay_order_info['id'],
            'sn' => date("Ymd",strtotime( $pay_order_info['created_at'] ) ).$pay_order_info['id'],
            'total_price' => $pay_order_info['total_price'],
            'status_desc' => ConstantMapRes::$pay_status_mapping[ $pay_order_info['status'] ],
            'status' => $pay_order_info['status'],
            'address_new' => $pay_order_info['address_new'],
            'reciver_new' => $pay_order_info['reciver_new'],
            'mobile_new' => $pay_order_info['mobile_new'],
            'express_address_id' => $pay_order_info['express_address_id'],
            'express_status_desc' => ConstantMapRes::$express_status_mapping[ $pay_order_info['express_status'] ],
            'express_status' => $pay_order_info['express_status'],
            'express_id' => $pay_order_info['express_id'],
            'express_name' => ConstantMapRes::$express[$pay_order_info['express_id']],
            'express_info' => $pay_order_info['express_info'],
            'pay_time' => date("Y-m-d H:i",strtotime( $pay_order_info['pay_time'] ) ),
            'created_time' => date("Y-m-d H:i",strtotime( $pay_order_info['created_at'] ) ),
        ];



        $member_info = User::where([ 'id' => $pay_order_info['user_id'] ])->first();
        $data_member_info = [
            'nickname' => $member_info['nickname'],
            'realname' => $member_info['realname'],
            'mobile' => $member_info['mobile'],
        ];

        $address_info = MemberAddress::where([ 'id' => $pay_order_info['express_address_id'] ])->first();
        $area_info = City::where([ 'id' => $address_info['area_id']  ])->first();
        $area = $area_info['province'].$area_info['city'];
        if( $address_info['province_id'] != $address_info['city_id'] ){
            $area .= $area_info['area_id'];
        }

        $data_address_info = [
            'nickname' => $address_info['nickname'],
            'mobile' => $address_info['mobile'],
            'address' => $area.$address_info['address']
        ];


        //快递
        $kuaidis=ConstantMapRes::$express;
        $province_mapping= CityRes::getProvinceMapping();
        return admin_view('finance.info',compact([
            'data_pay_order_info',
            'pay_order_items',
            'data_member_info',
            'data_address_info',
            'kuaidis',
            'province_mapping'
        ]));


    }

    // 订单确认
    public function confirm(Request $request)
    {
        $id= $request->get('id');
        $payorder=PayOrder::where(['id'=>$id])->first();
        $payorder->status=1;
        $payorder->pay_time=date('Y-m-d H:i:s', time());
        $payorder->express_status=-7;
        $payorder->save();
        return ['status'=>true,'msg'=>'订单确认成功!'];
    }

    //发货确认
    public function send(Request $request)
    {
        $id= $request->get('id');
        $payorder=PayOrder::where(['id'=>$id])->first();
        if(!$payorder->express_id){
            return ['status'=>false,'msg'=>'快递信息：物流公司未选择'];
        }

        if(!$payorder->express_info){
            return ['status'=>false,'msg'=>'快递信息：快递单号未填写'];
        }

        $payorder->express_status = -6;
        $payorder->save();
        return ['status'=>true,'msg'=>'该订单发货成功'];
    }
}