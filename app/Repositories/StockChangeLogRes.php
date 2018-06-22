<?php

namespace App\Repositories;

use App\Models\Goods;
use App\Models\ProductStockChangeLog;

class StockChangeLogRes
{
    //库存
    public static function setStockChangeLog($product_id = 0, $unit = 0, $note = '')
    {

        if (! $product_id || ! $unit) {
            return false;
        }

        $info = Goods::where(['id' => $product_id])->first();



        if (! $info) {
            return false;
        }
        $info->stock = $info['stock'] + $unit;
        $info->save();



        $new_info = Goods::where(['id' => $product_id])->first();

        $model_stock = new ProductStockChangeLog();
        $model_stock->product_id = $product_id;
        $model_stock->unit = $unit;
        $model_stock->total_stock = $new_info['stock'];
        $model_stock->note = $note;

        return $model_stock->save();
    }
}