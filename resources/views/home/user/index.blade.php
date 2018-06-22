@extends('home.layouts.app',['isshare'=>false,'hasfooter'=>true])
@section('title')
    用户中心
@stop
@section('content')
    <div class='weui-content'>
        <div class="wy-center-top">
            <div class="weui-media-box weui-media-box_appmsg">
                <div class="wy_tx"><img src="{{\Auth::user()->avatar}}" /></div>
            </div>
            <div class="wy_wa">
                <h2>{{\Auth::user()->nickname}}</h2>
                <p>积分：<span>{{\Auth::user()->score}}</span></p><span>等级：普通会员</span>
            </div>

        </div>
        <div class="weui-panel weui-panel_access">
            <div class="weui-panel__bd">
                <div class="weui-flex">
                    <div class="weui-flex__item">
                        <a href="#" class="center-ordersModule">
                            <span class="weui-badge" style="position: absolute;top:5px;right:25px; font-size:10px;">2</span>
                            <div class="imgicon"><img src="images/center-icon-order-dsh.png" /></div>
                            <div class="name">待确认</div>
                        </a>
                    </div>
                    <div class="weui-flex__item">
                        <a href="#" class="center-ordersModule">
                            <span class="weui-badge" style="position: absolute;top:5px;right:25px; font-size:10px;">1</span>
                            <div class="imgicon"><img src="images/center-icon-order-dfh.png" /></div>
                            <div class="name">已确认</div>
                        </a>
                    </div>
                    <div class="weui-flex__item">
                        <a href="{{route('user.order')}}" class="center-ordersModule">
                            <div class="imgicon"><img src="images/center-icon-order-dd.png" /></div>
                            <div class="name">我的订单</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="weui-panel">
            <div class="weui-panel__bd">
                <div class="weui-media-box weui-media-box_small-appmsg">
                    <div class="weui-cells">
                        <a class="weui-cell weui-cell_access" href="{{route('user.fav')}}">
                            <div class="weui-cell__hd"><img src="images/center-icon-sc.png" alt="" class="center-list-icon"></div>
                            <div class="weui-cell__bd weui-cell_primary">
                                <p class="center-list-txt">我的收藏</p>
                            </div>
                            <span class="weui-cell__ft"></span>
                        </a>
                        <a class="weui-cell weui-cell_access" href="#">
                            <div class="weui-cell__hd"><img src="images/center-icon-dlmm.png" alt="" class="center-list-icon"></div>
                            <div class="weui-cell__bd weui-cell_primary">
                                <p class="center-list-txt">我的推荐</p>
                            </div>
                            <span class="weui-cell__ft"></span>
                        </a>
                        <a class="weui-cell weui-cell_access" href="#">
                            <div class="weui-cell__hd"><img src="images/center-icon-fy.png" alt="" class="center-list-icon"></div>
                            <div class="weui-cell__bd weui-cell_primary">
                                <p class="center-list-txt">我的返佣</p>
                            </div>
                            <span class="weui-cell__ft"></span>
                        </a>
                        <a class="weui-cell weui-cell_access" href="#">
                            <div class="weui-cell__hd"><img src="images/center-icon-fb.png" alt="" class="center-list-icon"></div>
                            <div class="weui-cell__bd weui-cell_primary">
                                <p class="center-list-txt">我要发布</p>
                            </div>
                            <span class="weui-cell__ft"></span>
                        </a>
                        <a class="weui-cell weui-cell_access" href="{{route('user.address')}}">
                            <div class="weui-cell__hd"><img src="images/center-icon-dz.png" alt="" class="center-list-icon"></div>
                            <div class="weui-cell__bd weui-cell_primary">
                                <p class="center-list-txt">我的地址</p>
                            </div>
                            <span class="weui-cell__ft"></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
