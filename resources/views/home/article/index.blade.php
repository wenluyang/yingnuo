@extends('home.layouts.app',['isshare'=>true,'hasfooter'=>true])


@section('title')
    商学院
@stop


@section('content')
    <a href="{{route('home')}}">
        <img style="float:left;text-align:center" src="/images/icon-02.png">
    </a>
    @include('home.layouts.top')
<!--内容-->
<div style="background:#fff;" class='weui-content'>
        <div class="page" style="display: none">
            <input type="text" name="category_id" value="{{request()->category_id}}">
        </div>


    <!--列表页导航栏目-->

    <div class="wrapper wrapper04" id="sass">
        <div class="scroller">
            <ul class="clearfix plan_title">
            <li><a href="{{route('article')}}">全部文章</a></li>

            @foreach($articlecats as $articlecat)
                <li><a href="{{route('article',['category_id'=>$articlecat->id])}}">{{$articlecat->name}}</a></li>
                @endforeach

            </ul>
        </div>
    </div>






    <div class="probox">
    <div class="con_sxy">
        <ul class="prolist clearfix">
            @foreach($data as $_item)
            <li>
                <img class="con_sxy_hd" src="{{$_item['news_image_url']}}" />
                <div class="con_sxy_con">
                    <a href="#">{{$_item['title']}}</a>
                    <p>{{str_limit($_item['description'],48,'...')}}<a style="color:#e50012;" href="{{route('article.show',['article'=>$_item['id']])}}">【点击详情】</a></p>
                </div>
            </li>
            @endforeach
        </ul>

    </div>
    </div>
    <!--底部导航-->

    <div class="foot-black"></div>
    <div class="weui-tabbar wy-foot-menu">
        <a href="#" class="weui-tabbar__item weui-bar__item--on">
            <div class="weui-tabbar__icon foot-menu-home"></div>
            <p class="weui-tabbar__label">首页</p>
        </a>
        <a href="#" class="weui-tabbar__item">
            <div class="weui-tabbar__icon foot-menu-list"></div>
            <p class="weui-tabbar__label">创新平台</p>
        </a>
        <a href="#" class="weui-tabbar__item">
            <div class="weui-tabbar__icon foot-menu-jifen"></div>
            <p class="weui-tabbar__label">积分商城</p>
        </a>
        <a href="#" class="weui-tabbar__item">
            <span class="weui-badge" style="position: absolute;top: -.4em;right: 1em;">10</span>
            <div class="weui-tabbar__icon foot-menu-cart"></div>
            <p class="weui-tabbar__label">购物车</p>
        </a>
        <a href="#" class="weui-tabbar__item">
            <div class="weui-tabbar__icon foot-menu-member"></div>
            <p class="weui-tabbar__label">用户中心</p>
        </a>
    </div>




 @stop

@section('css')
        <link href="/css/nav.css" rel="stylesheet">
@stop

@section('js')
    <!--非公用-->
        <script src="js/swiper/swiper.jquery.min.js"></script>
        <script type="text/javascript" src="/js/flexible.js"></script>
        <script type="text/javascript" src="/js/iscroll.js"></script>
        <script type="text/javascript" src="/js/navbarscroll.js"></script>
        <script type="text/javascript" src="{{asset_url('js/article/list.js')}}"></script>
    <script >

        $('.plan_title').find('a').each(function () {
            if (this.href == document.location.href || document.location.href.search(this.href) >= 1) {
                $(this).parent().addClass('active');

            }
        });


        $(function () {
            var banner = new Swiper('.banner',{
                autoplay: 5000,
                pagination : '.swiper-pagination',
                paginationClickable: true,
                lazyLoading : true,
                loop:true
            });

            mui('.pop-schwrap .sch-input').input();
            var deceleration = mui.os.ios?0.003:0.0009;
            mui('.pop-schwrap .scroll-wrap').scroll({
                bounce: true,
                indicators: true,
                deceleration:deceleration
            });
            $('.top-sch-box .fdj,.top-sch-box .sch-txt,.pop-schwrap .btn-back').on('click',function () {
                $('html,body').toggleClass('holding');
                $('.pop-schwrap').toggleClass('on');
                if($('.pop-schwrap').hasClass('on')) {;
                    $('.pop-schwrap .sch-input').focus();
                }
            });

        });

        $(function(){
            //demo用于页面中可能有多个导航的情况
            $('.wrapper').navbarscroll();
        });
    </script>
@stop