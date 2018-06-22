@extends('home.layouts.app',['isshare'=>false,'hasfooter'=>true])
@section('title')
    {{$news->title}}
@stop

@section('content')
    <div style="background:#fff;" class='weui-content'>
        <img class="con_neirong_fm" src="{{buildPicUrl($news->image)}}" />

        <div class="m2-crumbs-1"><a href="{{route('home')}}">首页</a>><a href="{{route('news')}}">新闻中心</a>><span>{{$news->title}}</span></div>
        <div class="con_neirong_tit"><h2>{{$news->title}}</h2><p>文章来源:盈诺医疗<span>浏览量：{{$news->view_count}}次</span></p>
            <p>发布时间：{{$news->created_at}}</p>
        </div>
        <div class="con_neirong">

            <p>
                {!! $news->content !!}
            </p>
        </div>

    </div>
@stop