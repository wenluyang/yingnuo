@extends('home.layouts.web')


@section('content')

    <div class="order_pro_box">

        @if($data)
            <ul class="order_pro_list">

                @foreach($data as $_item)
                    <li data-price="{{$_item["product_price"]}}">
                        <a href="{{route('goods.show',['goods'=>$_item['product_id']])}}" class="pic" >
                            <img src="{{$_item["product_main_image"]}}" style="height: 100px;width: 100px;"/>
                        </a>
                        <h2><a href="{{route('goods.show',['goods'=>$_item['product_id']])}}">{{$_item["product_name"]}}</a></h2>
                        <div class="order_c_op">
                            <b>¥{{$_item["product_price"]}}</b>
                            <span class="delC_icon" data="{{$_item['id']}}" data-product-id="{{$_item['product_id']}}"></span>
                            <div class="quantity-form">
                                <a class="icon_lower" data-product-id="{{$_item['product_id']}}" ></a>
                                <input type="text" name="quantity" class="input_quantity" value="{{$_item['quantity']}}" readonly="readonly" max="{{$_item['product_stock']}}" />
                                <a class="icon_plus" data-product-id="{{$_item['product_id']}}"></a>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
            <div class="no-data">
                好可怜，购物车空空的
            </div>
        @endif
    </div>
    <div class="cart_fixed">
        <a href="{{route('goods.orderstore',['sc'=>'cart'])}}" class="billing_btn">提交下单</a>
        <b>合计：<strong>¥</strong><font id="price">0.00</font></b>
    </div>


@stop('content')

@section('js')
    <script src="/js/product/cart.js"></script>
@stop
