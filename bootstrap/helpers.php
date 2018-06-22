<?php

#获取后台的网址
function admin_url($uri)
{
    return url('admin/'.$uri);
}

#获取后台视图
function admin_view($name)
{
    $args = func_get_args();
    $args[0] = 'admin.'.$name;

    return call_user_func_array('view', $args);
}

#获取前台的网址
function home_url($uri)
{
    return url('home/'.$uri);
}

#获取静态资源的的网址
function asset_url($uri)
{
    return url('/'.$uri);
}

#获取前台视图
function home_view($name)
{
    $args = func_get_args();
    $args[0] = 'home.'.$name;

    return call_user_func_array('view', $args);
}

# 图片URL
function buildPicUrl($file_key)
{
    return "/".$file_key;
}

#输出json 为了方便product  article
function renderJSON($data = [], $msg = "ok", $code = 200)
{
    header('Content-type: application/json');
    echo json_encode([
        "code" => $code,
        "msg" => $msg,
        "data" => $data,
        "req_id" => uniqid(),
    ]);
}


//统一js提醒
function renderJS($msg,$url = "/")
{
    return view("common.js", ['msg' => $msg, 'location' => $url]);
}

//对数组进行升序排列并已,分隔转化为字符串
function sortOrImplode($arr){
    sort($arr, 1);
    return implode(',', $arr);
}

//获取当前登录用户的ID
function CurrentUserId()
{

    return \Auth::user()->id;


}
