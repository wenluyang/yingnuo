@extends('home.layouts.app',['isshare'=>true,'hasfooter'=>true])
@section('title')
    新闻中心
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
                    <li><a href="{{route('news')}}">全部文章</a></li>

                    @foreach($newscats as $newscat)
                        <li><a href="{{route('news',['category_id'=>$newscat->id])}}">{{$newscat->name}}</a></li>
                    @endforeach

                </ul>
            </div>
        </div>

        <div class="probox">
            <div class="con_new">
                <ul class="prolist clearfix">
                    @foreach($data as $_item)

                        <li>
                            <a href="{{route('news.show',['news'=>$_item['id']])}}">
                                <img class="con_new_hd" src="{{$_item['news_image_url']}}" />
                            </a>
                            <div class="con_new_con">
                                <a href="{{route('news.show',['news'=>$_item['id']])}}"> {{$_item['title']}}</a>
                                <p>{{$_item['description']}}</p>
                            </div>
                        </li>
                        </a>
                    @endforeach
                </ul>

            </div>
        </div>
        <!--底部导航-->
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
            <script type="text/javascript" src="{{asset_url('js/news/list.js')}}"></script>
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