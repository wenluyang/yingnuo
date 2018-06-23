@extends('home.layouts.app',['isshare'=>false,'hasfooter'=>true])
@section('title')
    {{$category->name}}
@stop
@section('content')
    <div style="background:#fff;" class='weui-content'>
        <!--顶部轮播-->
        <div class="swiper-container swiper-banner">
            <div class="swiper-wrapper">
                @foreach($banners as $banner)
                <div class="swiper-slide"><a href="#"><img src="{{buildPicUrl($banner->image)}}" /></a></div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
        </div>
        <!--内容-->
        <div class="m2-crumbs-1">
            <a href="{{route('home')}}">首页</a>><a href="{{route('category')}}">产品中心</a>><span>{{$category->name}}</span>
        </div>

        {{--<div class="prod_nr">--}}
            {{--{!! $category->content !!}--}}
        {{--</div>--}}

        <div class="m2-prod-list-content-2">
            @foreach($category->goods as $goods)
            <a class="s-babg" href="{{route('goods.show',['goods'=>$goods->id])}}" title="">
                <dl>
                    <dt><img src="{{buildPicUrl($goods->image)}}"> </dt>
                    <dd>
                        <h3 class="s-wc">{{$goods->name}}</h3>
                        <div class="m2-prod-list-content-2-desc">以前从车/床/台之间转移病人通常需要多人手脚并用，非常吃力，特别对于重病人、肥胖病人、手术后病人等，尤其费神费力，地</div>
                    </dd>
                </dl> </a>
            @endforeach


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