<?php

namespace App\Http\Controllers;


use App\Models\City;
use App\Models\Goods;
use App\Models\MemberAddress;
use App\Models\MemberFav;
use App\Models\PayOrder;
use App\Models\PayOrderItem;
use App\Models\Product;
use App\Models\SmsCaptcha;
use App\Repositories\ConstantMapRes;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //用户首页
    public function index()
    {

        $userinfo=User::where(['id'=>CurrentUserId()])->first();
        if( !$userinfo ){
            return renderJSON( [],'系统繁忙，请稍后再试~~',-1 );
        }

        return home_view('user.index',compact('userinfo'));
    }

    //订单
    public function order(){
        $pay_order_list = PayOrder::where([ 'user_id' => CurrentUserId() ])
            ->orderBy('id','desc')->get()->toArray();

        $list = [];
        if( $pay_order_list ) {
            $pay_order_items_list = PayOrderItem::where(['user_id' => CurrentUserId()])
                ->whereIn('pay_order_id',array_column($pay_order_list, 'id'))
                ->get()->toArray();




            $pay_order_items_mapping = [];
            foreach ($pay_order_items_list as $_pay_order_item) {
                $tmp_product_info = Goods::where(['id'=>$_pay_order_item['target_id']])->first();
                if (!isset( $pay_order_items_mapping[ $_pay_order_item['pay_order_id'] ] ) ) {
                    $pay_order_items_mapping[$_pay_order_item['pay_order_id']] = [];
                }
                $pay_order_items_mapping[$_pay_order_item['pay_order_id']][] = [
                    'pay_price'       => $_pay_order_item['price'],
                    'product_name'       => $tmp_product_info['name'],
                    'product_main_image' => buildPicUrl($tmp_product_info['image']),
                    'product_id' => $_pay_order_item['target_id'],
                    'comment_status' => $_pay_order_item['comment_status']
                ];
            }


            foreach ($pay_order_list as $_pay_order_info) {

                $list[] = [
                    'id' => $_pay_order_info['id'],
                    'sn' => date("Ymd", strtotime($_pay_order_info['created_at'])) . $_pay_order_info['id'],
                    'pay_order_id' => $_pay_order_info['id'],
                    'items' => $pay_order_items_mapping[$_pay_order_info['id']],
                    'created_time' => $_pay_order_info['created_at'],
                    'status' => $_pay_order_info[ 'status'],
                    'express_name' => ConstantMapRes::$express[$_pay_order_info[ 'express_id']],
                    'status_desc' => ConstantMapRes::$pay_status_mapping[$_pay_order_info[ 'status' ]],
                    'express_status' => $_pay_order_info[ 'express_status' ],
                    'express_status_desc' => ConstantMapRes::$express_status_mapping_for_member[ $_pay_order_info[ 'express_status' ] ],
                    'express_info' => $_pay_order_info[ 'express_info' ],
                ];
            }


        }


        return home('user.order',compact('list'));

    }

    //收藏

    public function fav(){
        $list = MemberFav::where([ 'user_id' => CurrentUserId() ])->orderBy('id','desc')->get();
        $data = [];
        if( $list ){
            foreach( $list as $_item ){
                $book_mapping = $_item->belongsToProduct;
                $data[] = [
                    'id' => $_item['id'],
                    'product_id' => $_item['product_id'],
                    'product_price' => $book_mapping['price'],
                    'product_name' => $book_mapping['name'],
                    'product_main_image' => buildPicUrl($book_mapping['image'])
                ];
            }
        }
         return home_view('user.fav',compact('data'));
    }

    //地址列表
    public function address()
    {
        $list = MemberAddress::where([ 'user_id' => CurrentUserId(),'status' => 1 ])
            ->orderBy('is_default' , 'desc')->orderBy('id','desc')->get();
        $data = [];
        if( $list ){
            foreach( $list as $_item){
                $area_mapping =$_item->belongsToCity;
                $tmp_area = $area_mapping->province.$area_mapping->city;
                if( $_item['province_id'] != $_item['city_id'] ){
                    $tmp_area .= $area_mapping->area;
                }

                $data[] = [
                    'id' => $_item['id'],
                    'is_default' => $_item['is_default'],
                    'nickname' =>  $_item['nickname'],
                    'mobile' =>  $_item['mobile'] ,
                    'address' => $_item['address'],
                ];
            }
        }
        return home_view('user.address',compact('data'));
    }

    // 添加地址
    public function address_set(Request $request)
    {
        if($request->isMethod('get')){
            $id = intval( $request->get('id',0));
            $info = [];
            if( $id ){
                $info = MemberAddress::where([ 'id' => $id,'user_id' => CurrentUserId() ])->first();
            }

            $province_mapping= self::getProvinceMapping();
            return home_view('user.address_set',compact('info','province_mapping'));
        }

        $id = intval( $request->input('id',0) );
        $nickname = trim($request->input('nickname','') );
        $mobile = trim($request->input('mobile','') );
        $province_id = intval($request->input('province_id','0'));
        $city_id = intval($request->input('city_id',''));
        $area_id = intval($request->input('area_id',0));
        $address = trim($request->input('address',''));
        if( mb_strlen( $nickname,"utf-8" ) < 1 ){
            return renderJSON([],"请输入符合规范的收货人姓名~~",-1);
        }

        if( !preg_match("/^[1-9]\d{10}$/",$mobile) ){
            return renderJSON([],"请输入符合规范的收货人手机号码~~",-1);
        }

        if( $province_id < 1 ){
            return renderJSON([],"请选择省~~",-1);
        }

        if( $city_id < 1 ){
            return renderJSON([],"请选择市~~",-1);
        }

        if( $area_id < 1 ){
            return renderJSON([],"请选择区~~",-1);
        }

        if( mb_strlen( $address,"utf-8" ) < 3 ){
            return renderJSON([],"请输入符合规范的收货人详细地址~~",-1);
        }

        $info = [];
        if( $id ){
            $info = MemberAddress::where([ 'id' => $id,'user_id' => CurrentUserId() ])->first();
        }

        if( $info ){
            $model_address = $info;
        }else{
            $model_address = new MemberAddress();
            $model_address->user_id = CurrentUserId();
            $model_address->status = 1;
        }
        $model_address->nickname = $nickname;
        $model_address->mobile = $mobile;
        $model_address->province_id = $province_id;
        $model_address->city_id = $city_id;
        $model_address->area_id = $area_id;
        $model_address->address = $address;
        $model_address->save();
        return renderJSON([],"操作成功");

    }

    //地址操作
    public function address_ops(Request $request){
        $act = trim( $request->input('act','') );
        $id = intval($request->input('id',0));

        if( !in_array( $act,[ "del","set_default" ] ) ){
            return renderJSON( [],'系统忙，请稍后操作~~',-1 );
        }

        if( !$id ){
            return renderJSON( [],'系统忙，请稍后操作~~',-1 );
        }

        $info = MemberAddress::where([ 'user_id' => CurrentUserId(),'id' => $id ])->first();
        switch ( $act ){
            case "del":
                $info->is_default = 0;
                $info->status = 0;
                break;
            case "set_default":
                $info->is_default = 1;
                break;
        }


        $info->update(  );

        if( $act == "set_default" ){
            $memberaddress= MemberAddress::where(['user_id' => CurrentUserId(),'status'=>1])
                ->where('id','!=',$id)->get();

            foreach ($memberaddress as $address){
                $address->is_default=0;
                $address->save();
            }

        }
        return renderJSON( [],"操作成功~~" );
    }

    //省份 todo
    public static function getProvinceMapping() {
        $ret = [];
        $province_list = City::where(['city_id' => 0])->orderBy("id", "asc")->get();
        if( $province_list ){
            foreach( $province_list as $_province_info ){
                $ret[ $_province_info['id'] ] = $_province_info['province'];
            }
        }
        return $ret;
    }

    //联动 todo
    public function Cascade(Request $request){
        $province_id = $request->input('id',0);
        $tree_info = self::getProvinceCityTree($province_id);
        return renderJSON($tree_info);
    }

    //可以考虑加入缓存 todo
    public static function getProvinceCityTree($province_id, $use_cache = true){
        $zhixiashi_city_id = [110000,120000,310000,500000];

        $key = "pro_city_distr_{$province_id}";
        $city_list = City::where(['province_id' => $province_id ])
            ->orderBy('id','asc')
            ->get();

        $city_tree = [
            "city" => [],
            "district" => []
        ];
        if ($city_list) {
            foreach ($city_list as $_city_item) {
                if( in_array( $province_id,$zhixiashi_city_id ) ){
                    if( $_city_item['city_id'] == 0  ){
                        $city_tree['city'][] = [
                            'id' => $_city_item['id'],
                            'name' => $_city_item['name']
                        ];
                    }else{
                        $city_tree['district'][$province_id][] = [
                            'id' => $_city_item['id'],
                            'name' => $_city_item['name']
                        ];
                    }
                }else{
                    if( $_city_item['city_id'] == 0  ){
                        continue;
                    }

                    if( $_city_item['area_id'] == 0 ){
                        $city_tree['city'][] = [
                            'id' => $_city_item['id'],
                            'name' => $_city_item['name']
                        ];
                    }else{
                        $tmp_prefix_key = $_city_item['city_id'];
                        if( !isset( $city_tree['district'][$tmp_prefix_key] ) ){
                            $city_tree['district'][$tmp_prefix_key] = [];
                        }

                        $city_tree['district'][$tmp_prefix_key ][] = [
                            'id' => $_city_item['id'],
                            'name' => $_city_item['name']
                        ];
                    }
                }

            }
        }

        return $city_tree;
    }

    //用户验证
    public function userauth(Request $request)
    {
        if($request->isMethod('get')){
            $auth_user= User::where('id',CurrentUserId())->where('mobile','<>','')->first();

            return home_view('user.auth',compact('auth_user'));
        }

        $mobile = trim($request->input('mobile'));
        $realname = trim($request->input('realname'));
        $captcha_code = trim($request->input('captcha_code'));
        $date_now = date("Y-m-d H:i:s");

        if( mb_strlen($mobile,"utf-8") < 1 || !preg_match("/^[1-9]\d{10}$/",$mobile) ){
            return renderJSON([],"请输入符合要求的手机号码~~",-1);
        }



        if (mb_strlen( $captcha_code, "utf-8") < 1) {
            return renderJSON([], "请输入符合要求的手机验证码~~", -1);
        }


        if ( !SmsCaptcha::checkCaptcha($mobile, $captcha_code ) ) {
            return renderJSON([], "请输入正确的手机验证码~~", -1);
        }

        $member_info = User::where([ 'mobile' => $mobile])->first();

        if( $member_info ){
               renderJSON([], "手机号码已注册，请更换一个手机号码来验证~~", -1);
        }

        if(!$member_info){
            $user= User::where(['id'=>CurrentUserId()])->first();
            $user->mobile=$mobile;
            $user->realname=$realname;
            $user->save();
            renderJSON([], "认证信息已经提交，请等待客户的审核~~", -1);

        }

    }


}