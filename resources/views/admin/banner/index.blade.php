@extends('admin.layouts.app')

@section('content')
    <div class="col-md-6">
        <div class="panel panel-success">
            <div class="panel-heading">
                首页轮播图列表
            </div>
         
            @if (count($banners)>0)
            <div class="list-group" id="category-tags">
                @foreach($banners as $slide)
                    <div class="list-group-item" data-id="{{$slide->id}}"><span class="name">{{$slide->title}}</span>
                        <span class="btn btn-xs btn-danger pull-right cmd-slideshow-delete" title="删除"><span class="glyphicon glyphicon-remove"></span> 删除</span>
                        <span class="btn btn-xs btn-warning pull-right cmd-sortord" title="排序" data-sortord="{{$slide->sort}}">
                        <span class="glyphicon glyphicon-eye-close"></span>排序</span>
                        <a class="btn btn-xs btn-primary pull-right" title="编辑" href="{{route('admin.banner.show',['slideshow'=>$slide->id])}}"><span class="glyphicon glyphicon-edit"></span> 编辑</a>
                    </div>
                @endforeach
            </div>
            @else
                <div class="list-group-item">暂时还没有添加任何幻灯图片</div>
            @endif


        </div>
    </div>

    <div class="col-md-6">
        <div class="panel panel-info">
            <div class="panel-heading">轮播图信息</div>
            <div class="panel-body">
                <form id="form-slideshow" class="form-horizontal">
                    <div class="form-group">
                        <label class="col-xs-3 control-label">轮播图标题</label>
                        <div class="col-xs-8">
                            <input type="text" class="form-control" name="title" value="{{isset($banner)?$banner->title:''}}" placeholder="轮播图标题">
                            <input type="hidden" class="form-control" name="id" value="{{isset($banner)?$banner->id:''}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-xs-3 control-label">轮播图网址</label>
                        <div class="col-xs-8">
                            <input type="text" class="form-control" name="url" value="{{isset($banner)?$banner->url:''}}" placeholder="轮播图网址">
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-xs-3 control-label">轮播图图片</label>
                        <div class="clearfix col-xs-8">
                            <div class="image-upload">
                                <input class="cmd-cover" type="file" name="file" accept="image/png, image/jpg, image/jpeg">
                                <img class="img-thumbnail" src="{{isset($banner)?buildPicUrl($banner->image):'/images/default.png'}}">
                                <input type="hidden" name="image" value="{{isset($banner)?$banner->image:''}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-9 col-xs-offset-3">
                            <span class="btn btn-success" id="cmd-slideshow-save">保存</span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script src="{{asset_url('js/uploader.js')}}"></script>
    <script src="{{asset_url('js/admin/upload.js')}}"></script>
    <script src="{{asset_url('js/admin/banner.js')}}"></script>
@stop