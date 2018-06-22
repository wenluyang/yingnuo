

<div style="background:#e50012; height:1.44rem;" class="search_header">
    <div class="downmenu f-fr"> <img src="/images/t_ico.png" title=""> </div>
    <!-- 下拉菜单 -->
    <section class="menu2" id="menu">
        <div class="slideMenu">
            <ul>
                <li> <a href="/" title=""> 首页 </a> </li>
                <li> <a href="#" title=""> 关于盈诺 </a> </li>
                <li> <a href="{{route('category')}}" title=""> 产品中心 </a> </li>
                <li> <a href="{{route('article')}}" title=""> 商学院 </a> </li>
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
                <div class="sch-txt">{{request()->get('kw')?request()->get('kw'):'请输入搜索关键词'}}</div>
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
                            <input class="sch-input mui-input-clear" value="{{request()->get('kw')}}" type="text" name="kw" id="kw" placeholder="请输入搜索关键词" />
                        </div>
                    </div>
                    <span class="mui-btn mui-btn-primary sch-submit">搜索</span>
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