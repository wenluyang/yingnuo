@extends('home.layouts.app',['isshare'=>true,'hasfooter'=>true])

@section('title')
    盈诺商品中心
@stop

@section('content')
    <div style="background:#fff;" class='weui-content'>
        <!--顶部轮播-->
        <div class="swiper-container swiper-banner">
            <div class="swiper-wrapper">
                @foreach($banners as $banner)
                <div class="swiper-slide"><a href="#"><img src="{{$banner->image}}" /></a></div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
        </div>
        <!--内容-->
        <div class="m2-crumbs-1">
            <a href="{{route('home')}}">首页</a>><span>产品中心</span>
        </div>
        <div class="con_prod">
            <ul>
                @foreach($category as $item)
                <li><a href="{{route('category.show',['category'=>$item->id])}}"><img src="{{$item->image}}" /><p>{{$item->name}}</p></a></li>
                @endforeach

            </ul>
        </div>

    </div>




@stop

@section('js')
    <script src="/js/swiper.js"></script>
    <script>
        $(".swiper-banner").swiper({
            loop: true,
            autoplay: 3000
        });
    </script>
@stop