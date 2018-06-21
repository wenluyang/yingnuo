<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>盈诺</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta name="description" content="">
    <!--共用css、js-->
    <link href="css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="css/weui.min.css">
    <link rel="stylesheet" href="css/jquery-weui.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="css/iconfont/iconfont.css" rel="stylesheet">
    <link href="css/nav.css" rel="stylesheet">
    <script src="js/rem.js"></script>
    <script src="js/mui.min.js"></script>
    <script src="js/jquery-1.11.3.min.js" type="text/javascript"></script>
    <script src="js/nav.js" type="text/javascript"></script>
    <script src="js/jquery-weui.js"></script>
    <script src="js/swiper.js"></script>

</head>
<body>
@yield('content')

@yield('js')
@include('home.layouts.footer')
@if ($isshare)
    @include('home.layouts.share')
@else
    @include('home.layouts.noshare')
@endif

</body>
</html>









{{--
首页
产品分类列表页面
产品分类页面
产品型号详情页面
新闻列表页面
新闻内容页面
都得要有title desc
--}}

