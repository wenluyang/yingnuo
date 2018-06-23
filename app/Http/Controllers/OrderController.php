<?php

namespace App\Http\Controllers;


use App\Models\PayOrder;
use App\Models\PayOrderItem;
use Illuminate\Http\Request;
use App\Repositories\StockChangeLogRes;

class OrderController extends Controller
{
    public function ops(Request $request)
    {

        $act = $request->get('act', '');
        $id = intval($request->get('id', 0));



        if (! in_array($act, ["close", "confirm_express"])) {
            return renderJSON([], '系统忙，请稍后再试~', -1);
        }

        if (! $id) {
            return renderJSON([], '系统忙，请稍后再试~', -1);
        }

        $pay_order_info = PayOrder::where(['id' => $id, 'user_id' => CurrentUserId()])->first();
        if (! $pay_order_info) {
            return renderJSON([], '系统忙，请稍后再试~', -1);
        }



        switch ($act) {
            case "close":

                if ($pay_order_info['status'] == -8) {
                    self::closeOrder($pay_order_info['id']);
                }
                break;
            case "confirm_express":
                $pay_order_info->express_status = 1;
                $pay_order_info->save();
                break;
        }

        return renderJSON([], "操作成功~~");
    }

    //关闭订单操作
    public static function closeOrder($pay_order_id = 0)
    {
        $pay_order_info = PayOrder::where(['id' => $pay_order_id, 'status' => -8])->first();


        if (! $pay_order_info) {
            return "指定订单不存在";
        }

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

        $pay_order_info->status = 0;
        $pay_order_info->express_status = 0;

        return $pay_order_info->save();
    }
}