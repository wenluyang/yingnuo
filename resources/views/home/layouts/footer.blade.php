<!--底部导航-->

<div class="foot-black"></div>
<div class="weui-tabbar wy-foot-menu">
    <a href="{{route('home')}}" class="weui-tabbar__item weui-bar__item--on">
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
    <a href="{{route('goods.cart')}}" class="weui-tabbar__item">
        @if ($count>0)
        <span class="weui-badge" style="position: absolute;top: -.4em;right: 1em;">{{$count}}</span>
        @endif
        <div class="weui-tabbar__icon foot-menu-cart"></div>
        <p class="weui-tabbar__label">购物车</p>
    </a>
    <a href="{{route('user.index')}}" class="weui-tabbar__item">
        <div class="weui-tabbar__icon foot-menu-member"></div>
        <p class="weui-tabbar__label">用户中心</p>
    </a>
</div>
