@extends('home.layouts.app',['isshare'=>false,'hasfooter'=>true])
@section('title')
    {{$page->title}}
@stop

@section('content')

    <style type="text/css">
        .con_page{ width:98%; margin:0 auto;}
        .con_page img{ width:100%; height:auto;}
    </style>
    <div  class="con_page">
        {!! $page->content !!}
    </div>

@stop

