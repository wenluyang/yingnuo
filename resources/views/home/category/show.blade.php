@extends('home.layouts.app',['isshare'=>false,'hasfooter'=>true])

@section('content')
当前的产品分类名称： {{$category->name}}  <br>
产品分类幻灯图片组：<br>

@foreach($banners as $banner)
{{$banner->image}}<br>
@endforeach
产品分类描述：<br>
{!! $category->content !!}

    <br>
    <br>
    <br>
    <br>
产品列表：<br>



  @foreach($category->goods as $goods)
    产品名称：{{$goods->name}}<br>
      产品图片:{{$goods->image}}<br>
      产品价格:{{$goods->price}}<br>
      产品库存:{{$goods->stock}}<br>
      产品链接： {{route('goods.show',['goods'=>$goods->id,'category'=>$category->id])}}
    @endforeach
@stop