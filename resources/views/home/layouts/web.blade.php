<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <!-- Set render engine for 360 browser -->
    <meta name="renderer" content="webkit">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{env('APP_NAME')}}</title>
    <link href="http://book.54php.cn/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="http://book.54php.cn/css/m/css_style.css" rel="stylesheet">
    <link href="http://book.54php.cn/css/m/app.css?ver=20170317170401" rel="stylesheet">
    @yield('css')

</head>
<body>
@yield('content')

<script src="http://book.54php.cn/plugins/jquery-2.1.1.js"></script>
<script src="http://book.54php.cn/js/m/TouchSlide.1.1.js"></script>
<script src="{{asset_url('js/common.js')}}"></script>
<script type="text/javascript">
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
</script>
@yield('js')
</body>
</html>

