@extends('admin.layouts.app')


@section('content')
    <div class="row">
        <div class="col-md-3 col-xs-3">
            <a class="btn btn-success" href="{{route('admin.news.create')}}"><span class="glyphicon glyphicon-plus"></span> 新增</a>
        </div>
        <div class="col-md-3 col-md-offset-3 col-xs-4 col-xs-offset-2">
            <div class="input-group">
                <span class="input-group-addon">栏目筛选</span>
                <select class="form-control" id="category-filter">
                    <option value="">选择栏目</option>
                    @foreach($newscats as $cat)
                        <option value="{{$cat->id}}">{{$cat->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-3 col-xs-3 pull-right">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="根据文章标题搜索" value="">
                <span class="input-group-btn">
                <span class="btn btn-primary" id="cmd-search">搜索</span>
            </span>
            </div>
        </div>
    </div>


    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th style="width: 40px;"></th>
            <th>新闻标题</th>
            <th>所属栏目</th>
            <th>序号</th>
            <th>添加时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($news as $list)
            <tr>
                <td>
                    <span class="btn btn-success btn-xs cmd-copy-url">
                        <span class="glyphicon glyphicon-link"></span>
                    </span>
                </td>
                <td>

                    {{$list->title}}

                </td>
                <td>{{$list->belongsToNewsCat->name}}</td>
                <td>{{$list->sort}}</td>
                <td>{{$list->created_at}}</td>
                <td data-id="{{$list->id}}">

                    <span class="btn btn-xs btn-success cmd-set-sort" data-sort="{{$list->sort}}">排序</span>

                    @if($list->recom)
                        <span class="btn btn-warning btn-xs cmd-untuijian">消推</span>
                    @else
                        <span class="btn btn-info btn-xs cmd-tuijian">推荐</span>
                    @endif

                    @if($list->status)
                        <span class="btn btn-primary btn-xs cmd-unshenhe">已审核</span>
                    @else
                        <span class="btn btn-danger btn-xs cmd-shenhe">待审核</span>
                    @endif

                    <a href="{{route('admin.news.show',['id'=>$list->id])}}" class="btn btn-xs btn-primary">详情</a>
                    <span class="btn btn-danger btn-xs cmd-delete">删除</span>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {!! $news->render() !!}
@stop


@section('js')
    <script type="text/javascript" src="{{asset_url('js/admin/news_list.js')}}"></script>
@stop