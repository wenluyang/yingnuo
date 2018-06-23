<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PayOrder;
use Illuminate\Http\Request;

class KuaidiController extends Controller
{
    public function store(Request $request)
    {
        $orderid= $request->get('orderid',0);
        $payorder=PayOrder::where(['id'=>$orderid])->first();
        $payorder->express_id= $request->get('express_id');
        $payorder->express_info= $request->get('express_info');
        $payorder->save();
        return ['status'=>true,'msg'=>'保存快递信息成功!'];
    }
}