@extends('home.layouts.app',['isshare'=>true,'hasfooter'=>true])

@section('title')
    首页
@stop

@section('content')
    <div style="background:#e50012; height:1.44rem;">
        <div class="downmenu f-fr"> <img src="images/t_ico.png" title=""> </div>
        <!-- 下拉菜单 -->
        <section class="menu2" id="menu">
            <div class="slideMenu">
                <ul>
                    <li> <a href="/" title=""> 首页 </a> </li>
                    <li> <a href="#" title=""> 关于盈诺 </a> </li>
                    <li> <a href="" title=""> 产品中心 </a> </li>
                    <li> <a href="#" title=""> 商学院 </a> </li>
                    <li> <a href="#" title=""> 经销商故事 </a> </li>
                    <li> <a href="#" title=""> 创新平台 </a> </li>
                </ul>
            </div>
        </section>
        <!--顶部搜索-->
        <header class="mui-bar mui-bar-nav" id="header">
            <div class="top-sch-box flex-col">
                <div class="centerflex">
                    <i class="fdj iconfont icon-search"></i>
                    <div class="sch-txt">请输入搜索关键词</div>
                </div>
            </div>

        </header>

        <div id="main" class="mui-clearfix">
            <!-- 搜索层 -->
            <div class="pop-schwrap">
                <div class="ui-scrollview">
                    <div class="mui-bar mui-bar-nav clone">
                        <a class="btn btn-back" href="javascript:;"></a>
                        <div class="top-sch-box flex-col">
                            <div class="centerflex">
                                <input class="sch-input mui-input-clear" type="text" name="" id="" placeholder="请输入搜索关键词" />
                            </div>
                        </div>
                        <a class="mui-btn mui-btn-primary sch-submit" href="#">搜索</a>
                    </div>
                    <div class="scroll-wrap">
                        <div class="mui-scroll">
                            <div class="sch-cont">
                                <div class="section ui-border-b">
                                    <div class="tit">热门搜索</div>
                                    <div class="tags">
                                        <span class="tag">外套</span><span class="tag">连衣裙</span><span class="tag">运动鞋</span><span class="tag">睡衣</span>
                                    </div>
                                </div>
                                <div class="section">
                                    <div class="tit"></i>最近搜索</div>
                                    <div class="tags">
                                        <span class="tag">外套</span><span class="tag">连衣裙</span><span class="tag">运动鞋</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--内容-->
    <div class='weui-content'>
        <!--顶部轮播-->
        <div class="swiper-container swiper-banner">
            <div class="swiper-wrapper">
                @foreach($banners as $banner)
                <div class="swiper-slide"><a href="{{$banner->title}}"><img src="{{$banner->image}}" /></a></div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
        </div>

        <!--图标分类-->
        <div class="weui-flex wy-iconlist-box">
            <div class="weui-flex__item"><a href="#" class="wy-links-iconlist"><div class="img"><img src="images/icon-link1.png"></div><p>关于盈诺</p></a></div>
            <div class="weui-flex__item"><a href="#" class="wy-links-iconlist"><div class="img"><img src="images/icon-link2.png"></div><p>产品中心</p></a></div>
            <div class="weui-flex__item"><a href="#" class="wy-links-iconlist"><div class="img"><img src="images/icon-link3.png"></div><p>商学院</p></a></div>
            <div class="weui-flex__item"><a href="#" class="wy-links-iconlist"><div class="img"><img src="images/icon-link4.png"></div><p>经销商故事</p></a></div>
        </div>
        <!--头条切换-->
        <div class="wy-ind-news">
            <div class="news-icon-laba">盈诺头条：</div>
            <div class="swiper-container swiper-news">
                <div class="swiper-wrapper">
                    @foreach($news as $item)
                    <div class="swiper-slide"><a style="font-size:14px;" href="#">{{$item->title}}</a></div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>
            <a href="#" class="newsmore"><i class="news-icon-more"></i></a>
        </div>
        <!--产品展示-->
        <div class="wy-Module">
            <div class="wy-Module-tit">
                <span>产品展示</span><p>Product display</p>
                <div style=" width:100%;border-bottom:1px solid #d0cece; margin:0 auto;"></div>
                <div style=" width:40%; margin:0 auto; margin-top:-1px;border-bottom:1px solid #e50012;"></div>
            </div>
            <div class="product">
                <ul>
                    <li><a href="#"><img src="images/cczs_01.jpg" /><p>一次性滑移垫</p></a></li>
                    <li><a href="#"><img src="images/cczs_02.jpg"  /><p>一次性滑移垫</p></a></li>
                    <li><a href="#"><img src="images/cczs_03.jpg" /><p>一次性滑移垫</p></a></li>
                    <li><a href="#"><img src="images/cczs_04.jpg"/><p>一次性滑移垫</p></a></li>
                </ul>
            </div>
        </div>
        <div class="clear"></div>
        <!--为什么选择盈诺-->
        <div class="wy-Module">
            <div class="wy-Module-tit">
                <span>为什么选择盈诺？</span><p>Why do you choose us？</p>
                <div style=" width:100%;border-bottom:1px solid #d0cece; margin:0 auto;"></div>
                <div style=" width:40%; margin:0 auto; margin-top:-1px;border-bottom:1px solid #e50012;"></div>
            </div>
            <div class="youshi">
                <ul>
                    <li>
                        <img class="youshi_hd" src="images/ys_01.jpg" />
                        <div class="youshi_con">
                            <span>市场优势</span>
                            <p>唯一一款适用于全外科手术冲洗的冲洗产品，被广泛应用在千余家医院手术室。</p>
                        </div>
                    </li>
                    <li>
                        <div  style="float:left; padding-left:1%;"class="youshi_con">
                            <span>创新搭配</span>
                            <p>轻便且具有同冲同吸功能的管道设计，配备防溅罩和脚踏开关设置更安全洁净。</p>
                        </div>
                        <img class="youshi_hd" src="images/ys_02.jpg" />
                    </li>
                    <li>
                        <img class="youshi_hd" src="images/ys_03.jpg" />
                        <div class="youshi_con">
                            <span>人机设计</span>
                            <p>公司集医疗器械研发、生产、销是术室、外科辅助器材的专业制造商。</p>
                        </div>
                    </li>
                    <li>
                        <div  style="float:left; padding-left:1%;"class="youshi_con">
                            <span>经济实惠</span>
                            <p>相比于同行业，价格更易于被医院及患者接受，且在强制降价的背景下产品依然保质保量。</p>
                        </div>
                        <img class="youshi_hd" src="images/ys_04.jpg" />
                    </li>
                </ul>
            </div>
        </div>
        <!--精彩活动-->
        <div class="wy-Module">
            <div class="wy-Module-tit">
                <span>精彩活动</span><p>Wonderful activities</p>
                <div style=" width:100%;border-bottom:1px solid #d0cece; margin:0 auto;"></div>
                <div style=" width:40%; margin:0 auto; margin-top:-1px;border-bottom:1px solid #e50012;"></div>
            </div>
            <div class="swiper-container swiper-huodong" style="padding-top:10px;">
                <div class="swiper-wrapper">
                    <div class="swiper-slide"><a href="#"><img src="images/hd_01.jpg" /></a></div>
                    <div class="swiper-slide"><a href="#"><img src="images/hd_02.jpg" /></a></div>
                    <div class="swiper-slide"><a href="#"><img src="images/hd_03.jpg" /></a></div>
                    <div class="swiper-slide"><a href="#"><img src="images/hd_02.jpg" /></a></div>
                    <div class="swiper-slide"><a href="#"><img src="images/hd_01.jpg" /></a></div>
                    <div class="swiper-slide"><a href="#"><img src="images/hd_03.jpg" /></a></div>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>

        <!--商学院-->
        <div class="wy-Module">
            <div class="wy-Module-tit">
                <span>商学院</span><p>Business School</p>
                <div style=" width:100%;border-bottom:1px solid #d0cece; margin:0 auto;"></div>
                <div style=" width:40%; margin:0 auto; margin-top:-1px;border-bottom:1px solid #e50012;"></div>
            </div>
            <div class="School">
                @foreach($articles as $article)
                <li>
                    <img class="School_hd" src="{{$article->image}}" />
                    <div class="School_con">
                        <a href="#">{{str_limit($article->title,24,'...')}}</a>
                        <p>{{str_limit($article->description,48,'...')}}<a style="color:#e50012;" href="#">【点击详情】</a></p>
                    </div>
                </li>
                 @endforeach
            </div>
        </div>
        <!--积分商城-->
        <div class="wy-Module">
            <div class="wy-Module-tit">
                <span>积分商城</span><p>Integral mall</p>
                <div style=" width:100%;border-bottom:1px solid #d0cece; margin:0 auto;"></div>
                <div style=" width:40%; margin:0 auto; margin-top:-1px;border-bottom:1px solid #e50012;"></div>
            </div>
            <div class="swiper-container swiper-jifen" style="padding-top:10px;">

                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <a href="#"><img src="images/hd_01.jpg" />
                            <span>脉冲冲洗仪及管路耗材</span><p>库存：20 <span>20000积分</span></p></a>
                    </div>

                    <div class="swiper-slide">
                        <a href="#"><img src="images/hd_02.jpg" />
                            <span>脉冲冲洗仪及管路耗材</span><p>库存：20 <span>177积分</span></p></a>
                    </div>

                    <div class="swiper-slide">
                        <a href="#"><img src="images/hd_03.jpg" />
                            <span>脉冲冲洗仪及管路耗材</span><p>库存：20 <span>20积分</span></p></a>
                    </div>

                    <div class="swiper-slide">
                        <a href="#"><img src="images/hd_02.jpg" />
                            <span>脉冲冲洗仪及管路耗材</span><p>库存：20 <span>2777积分</span></p></a>
                    </div>

                    <div class="swiper-slide">
                        <a href="#"><img src="images/hd_01.jpg" />
                            <span>脉冲冲洗仪及管路耗材</span><p>库存：20 <span>2400积分</span></p></a>
                    </div>

                    <div class="swiper-slide">
                        <a href="#"><img src="images/hd_03.jpg" />
                            <span>脉冲冲洗仪及管路耗材</span><p>库存：20 <span>1500积分</span></p></a>
                    </div>
                </div>
            </div>

        </div>
    </div>
@stop

@section('js')
    <script>
        $(".swiper-banner").swiper({
            loop: true,
            autoplay: 3000
        });
        $(".swiper-news").swiper({
            loop: true,
            direction: 'vertical',
            paginationHide :true,
            autoplay: 4000
        });
        $(".swiper-huodong").swiper({
            pagination: '.swiper-pagination1',
            loop: true,
            paginationType:'fraction',
            slidesPerView:3,
            paginationClickable: true,
            spaceBetween: 2
        });
        $(".swiper-jifen").swiper({
            pagination: '.swiper-pagination1',
            loop: true,
            paginationType:'fraction',
            slidesPerView:2,
            paginationClickable: true,
            spaceBetween: 2
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

    </script>

@stop