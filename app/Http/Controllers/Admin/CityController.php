<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\CityRes;
use Illuminate\Http\Request;

class CityController extends Controller
{
    //联动 todo
    public function Cascade(Request $request)
    {
        $province_id = $request->input('id', 0);
        $tree_info = CityRes::getProvinceCityTree($province_id);

        return renderJSON($tree_info);
    }
}