<?php

namespace App\Repositories;

class ConstantMapRes
{
    public static $client_type_wechat = 1;

    public static $default_avatar = 'default_avatar';
    public static $default_password = '******';
    public static $default_time_stamps = '0000-00-00 00:00:00';
    public static $default_syserror = '系统繁忙，请稍后再试~~';


    public static $status_default = -1;
    public static $status_mapping = [
        1 => '正常',
        0 => '已删除'
    ];

    public static $sex_mapping = [
        1 => '男',
        2 => '女',
        0 => '未填写'
    ];

    public static $pay_status_mapping = [
        1 => '订单已审核',
        -8 => '待确认',
        0 => '已关闭'
    ];

    public static $express_status_mapping = [
        1 => '会员已签收,该订单已完成',
        -6 => '已发货待签收',
        -7 => '订单已确认等待发货',
        -8 => '订单等待审核',
        0 => '订单已关闭'
    ];

    public static $express_status_mapping_for_member = [
        1  => '已签收',
        -6 => '已发货',
        -7 => '等待商家发货',
        -8 => '订单等待审核',
        0 => '已关闭'
    ];


    public static $express = [
        1  => '申通',
        2 => '圆通',
        3 => '顺丰',
        0 => '未填写快递信息'
    ];


    public static $jibie = [
        1  => '普通会员',
        2 => '银牌会员',
        3 => '金牌会员',
        4 => '钻石会员',
        5 => '初级代理商',
        6 => '中级代理商',
        7 => '高级代理商'
    ];



}