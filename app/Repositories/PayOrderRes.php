<?php

namespace App\Repositories;
use App\Models\PayOrder;
use App\Models\PayOrderItem;



class PayOrderRes
{
    //下单操作
    public static function createPayOrder($user_id, $items = [], $params = [])
    {
        $total_price = 0;
        $continue_cnt = 0;
        foreach ($items as $_item) {
            if ($_item['price'] < 0) {
                $continue_cnt += 1;
                continue;
            }
            $total_price += $_item['price'];
        }

        if ($continue_cnt >= count($items)) {
            return "商品items为空~~";
        }

        $total_price = sprintf("%.2f", $total_price);

        $model_pay_order = new PayOrder();
        $model_pay_order->order_sn = self::generate_order_sn();;
        $model_pay_order->user_id = $user_id;
        $model_pay_order->target_type = isset($params['target_type']) ? $params['target_type'] : 0;
        $model_pay_order->status = isset($params['status']) ? $params['status'] : -8;
        $model_pay_order->express_status = isset($params['express_status']) ? $params['express_status'] : -8;
        $model_pay_order->express_address_id = isset($params['express_address_id']) ? $params['express_address_id'] : 0;
        $model_pay_order->note = isset($params['note']) ? $params['note'] : '';
        $model_pay_order->total_price = $total_price;
        if (! $model_pay_order->save()) {
            return "创建订单失败~~";
        }

        foreach ($items as $_item) {
            $new_item = new PayOrderItem();
            $new_item->pay_order_id = $model_pay_order->id;
            $new_item->user_id = $user_id;
            $new_item->quantity = $_item['quantity'];
            $new_item->price = $_item['price'];
            $new_item->target_type = $_item['target_type'];
            $new_item->target_id = $_item['target_id'];
            $new_item->status = isset($_item['status']) ? $_item['status'] : 1;
            $new_item->note = isset($_item['note']) ? $_item['note'] : "";

            if (! $new_item->save()) {
                return "创建订单失败~~";
            }

            //库存变化
            StockChangeLogRes::setStockChangeLog($_item['target_id'], -$_item['quantity'], "在线购买");
        }

        return [
            'id' => $model_pay_order->id,
            'order_sn' => $model_pay_order->order_sn,
            'pay_money' => $model_pay_order->pay_price,
        ];
    }


    //自生成订单编号
    public static function generate_order_sn()
    {
        do {
            $sn = md5(microtime(1).rand(0, 9999999).'!@%egg#$');
        } while (PayOrder::where(['order_sn' => $sn])->first());

        return $sn;
    }
}