<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MemberAddress;
use App\Models\PayOrder;
use Illuminate\Http\Request;
use App\Repositories\CityRes;

class AddressController extends Controller
{
    public function index(Request $request)
    {
        $id= $request->get('id');

         $address= MemberAddress::where(['id'=>$id])->first();
         $province_mapping= CityRes::getProvinceMapping();
         return ['address'=>$address];
    }

    public function update(Request $request)
    {
        $payorder_id= $request->get('payorder_id');
        $payorder_info = PayOrder::where(['id'=>$payorder_id])->first();
        $payorder_info->reciver_new= $request->get('reciver_new');
        $payorder_info->mobile_new= $request->get('mobile_new');
        $payorder_info->address_new= $request->get('address_new');
        $payorder_info->save();

        return ['status'=>true];
    }
}