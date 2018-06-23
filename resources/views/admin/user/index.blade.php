@extends('admin.layouts.app')


@section('content')
    <div class="row">
        {{--<div class="col-md-3">--}}
            {{--<span class="btn btn-success" id="cmd-show-group-send"><span class="glyphicon glyphicon-plus"></span> 群发消息</span>--}}
        {{--</div>--}}

        <div class="col-md-5 col-xs-5 pull-right">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="根据用户昵称、手机搜索" value="">
                <span class="input-group-btn">
                <span class="btn btn-primary" id="cmd-search">搜索</span>
            </span>
            </div>
        </div>
    </div>
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th></th>
            <th>昵称</th>
            <th>手机号</th>
            <th>公司名称</th>
            <th>注册时间</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr data-id="94">
                <td class="avatar"><img src="{{$user->avatar}}"></td>
                <td>{{$user->nickname}}</td>
                <td>{{$user->mobile}}</td>
                <td>{{$user->realname}}</td>
                <td>{{$user->created_at}}</td>
                <td>{{$user->created_at}}</td>
                <td>
                    <span class="btn btn-success btn-xs cmd-send-msg">编辑</span>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
@stop

@section('css')
    <style type="text/css">
        .avatar {width: 39px;}
        .avatar img {width: 23px; height: 23px;}
    </style>
@stop