@extends('home.layouts.app',['isshare'=>false,'hasfooter'=>true])


@section('title')
    {{$article->title}}
@stop

@section('content')
    <div style="background:#fff;" class='weui-content'>
        <img class="con_neirong_fm" src="{{buildPicUrl($article->image)}}" />
        <!--<div class="shoucang">收<br />藏</div>-->
        <!--内容-->
        <div class="m2-crumbs-1"><a href="{{route('home')}}">首页</a>><a href="{{route('article')}}">商学院</a>><span>{{$article->title}}</span></div>
        <div class="con_neirong_tit"><h2>{{$article->title}}</h2><p>文章来源:盈诺医疗<span>浏览量：{{$article->view_count}}次</span></p>
            <p>发布时间：{{$article->created_at}}</p>
        </div>
        <div class="con_neirong">

            <p>
                {!! $article->content !!}
            </p>
        </div>

    </div>
@stop
