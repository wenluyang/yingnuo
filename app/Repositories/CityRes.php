<?php

namespace App\Repositories;

use App\Models\City;
use Illuminate\Http\Request;

class CityRes
{
    //省份 todo
    public static function getProvinceMapping()
    {
        $ret = [];
        $province_list = City::where(['city_id' => 0])->orderBy("id", "asc")->get();
        if ($province_list) {
            foreach ($province_list as $_province_info) {
                $ret[$_province_info['id']] = $_province_info['province'];
            }
        }

        return $ret;
    }

    //联动 todo
    public function Cascade(Request $request)
    {
        $province_id = $request->input('id', 0);
        $tree_info = self::getProvinceCityTree($province_id);

        return renderJSON($tree_info);
    }

    //可以考虑加入缓存 todo
    public static function getProvinceCityTree($province_id, $use_cache = true)
    {
        $zhixiashi_city_id = [110000, 120000, 310000, 500000];

        $key = "pro_city_distr_{$province_id}";
        $city_list = City::where(['province_id' => $province_id])->orderBy('id', 'asc')->get();

        $city_tree = [
            "city" => [],
            "district" => [],
        ];
        if ($city_list) {
            foreach ($city_list as $_city_item) {
                if (in_array($province_id, $zhixiashi_city_id)) {
                    if ($_city_item['city_id'] == 0) {
                        $city_tree['city'][] = [
                            'id' => $_city_item['id'],
                            'name' => $_city_item['name'],
                        ];
                    } else {
                        $city_tree['district'][$province_id][] = [
                            'id' => $_city_item['id'],
                            'name' => $_city_item['name'],
                        ];
                    }
                } else {
                    if ($_city_item['city_id'] == 0) {
                        continue;
                    }

                    if ($_city_item['area_id'] == 0) {
                        $city_tree['city'][] = [
                            'id' => $_city_item['id'],
                            'name' => $_city_item['name'],
                        ];
                    } else {
                        $tmp_prefix_key = $_city_item['city_id'];
                        if (! isset($city_tree['district'][$tmp_prefix_key])) {
                            $city_tree['district'][$tmp_prefix_key] = [];
                        }

                        $city_tree['district'][$tmp_prefix_key][] = [
                            'id' => $_city_item['id'],
                            'name' => $_city_item['name'],
                        ];
                    }
                }
            }
        }

        return $city_tree;
    }
}