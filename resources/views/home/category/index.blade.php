@extends('home.layouts.app',['isshare'=>false,'hasfooter'=>true])


@section('content')

@foreach($category as $item)
产品组名称：{{$item->name}}  <br>
产品图片：{{$item->image}}<br>
产品描述：{{$item->description}}
链接： {{route('category.show',['category'=>$item->id])}}

@endforeach




@stop

@section('css')

@stop