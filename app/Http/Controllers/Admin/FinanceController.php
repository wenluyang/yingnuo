<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
//use App\Models\Kuaidi;
use App\Models\MemberAddress;
use App\Models\PayOrder;
use App\Models\PayOrderItem;
use App\Models\Goods;
use App\Repositories\CityRes;
use App\Models\User;
use App\Repositories\StockChangeLogRes;
use Illuminate\Http\Request;
use App\Repositories\ConstantMapRes;
use EasyWeChat\Kernel\Messages\Text;

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

        //确认订单后给该订单的用户发送消息
        $open_id= User::where(['id'=>$query->user_id])->first()->open_id;
        $app = app('wechat.official_account');
        $message="您的订单已经完成，在使用我们产品过程中如有任何问题，请拨打我们的客服电话：0531-88032833";
        $app->customer_service->message($message)->to($open_id)->send();



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


        $sn=date("Ymd",strtotime( $payorder->created_at ) ).$payorder->id;

        //此订单的一些信息
        $order_item_list = PayOrderItem::where([ 'pay_order_id' =>  $payorder->id ])->get()->toArray();
        $product_mapping = Goods::whereIn('id',array_column( $order_item_list,"target_id" ))->get()->toArray();




        $pay_order_items = [];
        foreach( $order_item_list as $_order_item_info ){
            $tmp_product_info =Goods::where(['id'=>$_order_item_info['target_id']])->first();


            $pay_order_items[] = [
                'name' => $tmp_product_info['name'],
                'quantity' => $_order_item_info['quantity'],
                'price' => $_order_item_info['price'],
            ];
        }


        $message_address="您的收件信息为:\r\n";
        $data_pay_order_info = [
            'address_new' => $payorder->address_new,
            'reciver_new' => $payorder->reciver_new,
            'mobile_new' => $payorder->mobile_new,
            'express_address_id' => $payorder->express_address_id,
        ];

        if($data_pay_order_info['reciver_new']==null){
            $address_info = MemberAddress::where([ 'id' => $data_pay_order_info['express_address_id'] ])->first();
            $area_info = City::where([ 'id' => $address_info['area_id']  ])->first();
            $area = $area_info['province'].$area_info['city'];
            if( $address_info['province_id'] != $address_info['city_id'] ){
                $area .= $area_info['area_id'];
            }
            $reciver=$address_info->nickname;
            $mobile=$address_info->mobile;
            $address=$address_info->address;

            $message_address=$message_address."收件人:".$reciver."\r\n 联系电话:".$mobile."\r\n收件地址：".$area.$address.'\r\n\r\n';
        }else{
            $message_address=$message_address."收件人:".$data_pay_order_info['reciver_new']."\r\n 联系电话:".$data_pay_order_info['mobile_new']."\r\n收件地址：".$data_pay_order_info['address_new'].'\r\n\r\n';
        }

        $message_goods="您订购的产品为:\r\n";
          foreach ($pay_order_items as $k){
              $message_goods=$message_goods."产品名称:".$k['name']."\r\n 订购数量:".$k['quantity']."\r\n";
          }



        //确认订单后给该订单的用户发送消息
        $open_id= User::where(['id'=>$payorder->user_id])->first()->open_id;
        $app = app('wechat.official_account');
        $message="您的订单已经审核！\r\n------------------------------订单号:".$sn."\r\n".$message_goods."\r\n------------------------------".$message_address;
        $app->customer_service->message($message)->to($open_id)->send();



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


        //确认订单后给该订单的用户发送消息
        $open_id= User::where(['id'=>$payorder->user_id])->first()->open_id;
        $express_id=$payorder->express_id;
        $kuaidi= ConstantMapRes::$express[$express_id];
        $express_info=$payorder->express_info;



        $app = app('wechat.official_account');
        $message="您的订单已经发货！\r\n------------------------------委托快递:".$kuaidi."\r\n快递单号".$express_info."\r\n";
        $app->customer_service->message($message)->to($open_id)->send();


        $payorder->express_status = -6;
        $payorder->save();
        return ['status'=>true,'msg'=>'该订单发货成功'];
    }
}