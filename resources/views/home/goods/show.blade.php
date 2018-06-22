@extends('home.layouts.web')

@section('content')


<div style="min-height: 500px;">
    <div class="pro_tab clearfix">
        <span>{{$goods->name}}</span>
    </div>
    <div class="proban">
        <div id="slideBox" class="slideBox">
            <div class="bd">
                <ul>
                    <li><img src="{{buildPicUrl($goods->image)}}"/></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="pro_header">
        <div class="pro_tips">
            <h2>{{$goods->name}}</h2>
            <h3><b>¥{{$goods->price}}</b><font>库存量：{{$goods->stock}}</font></h3>
        </div>
        <span class="share_span"><i class="share_icon"></i><b>分享商品</b></span>
    </div>
    <div class="pro_express">销量：{{$goods->buy_count}}</div>
    <div class="pro_virtue">
        <div class="pro_vlist">
            <b>数量</b>
            <div class="quantity-form">
                <a class="icon_lower"></a>
                <input type="text" name="quantity" class="input_quantity" value="1" readonly="readonly" max="101"/>
                <a class="icon_plus"></a>
            </div>
        </div>
    </div>
    <div class="pro_warp">
        <p>
            {!!$goods->content!!}
        </p>
    </div>
    <div class="pro_fixed clearfix">
        <a href="/"><i class="sto_icon"></i><span>首页</span></a>
        <a class="fav" href="javascript:void(0);" data="{{$goods->id}}"><i class="keep_icon"></i><span>收藏</span></a>
        <input type="button" value="立即订购" class="order_now_btn" data="{{$goods->id}}"/>
        <input type="button" value="加入购物车" class="add_cart_btn" data="{{$goods->id}}"/>
        <input type="hidden" name="id" value="{{$goods->id}}">
    </div>
</div>


<div class="layout_hide_wrap hidden">
    <input type="hidden" id="share_info" value='{"title":"\u7f16\u7a0b\u6d6a\u5b50\u5fae\u4fe1\u56fe\u4e66\u5546\u57ce","desc":"\u7f16\u7a0b\u6d6a\u5b50\u5fae\u4fe1\u56fe\u4e66\u5546\u57ce","img_url":"http:\/\/book.54php.cn\/images\/common\/qrcode.jpg"}'>
</div>

@stop

@section('js')
    <script src="{{asset_url('js/product/info.js')}}"></script>
@stop

