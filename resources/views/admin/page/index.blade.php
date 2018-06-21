@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-3 col-xs-3">
            <a class="btn btn-success" href="{{route('admin.page.create')}}"><span
                        class="glyphicon glyphicon-plus"></span> 新增</a>
        </div>

    </div>

    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th style="width: 40px;"></th>
            <th>标 题</th>
            <th>添加时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>

        @if(count($pages)>0)
        @foreach($pages as $page)
            <tr>
                <td>
                    <span class="btn btn-success btn-xs cmd-copy-url">
                        <span class="glyphicon glyphicon-link"></span>
                    </span>
                </td>
                <td>

                    {{$page->title}}

                </td>

                <td>2018-06-13 14:33:00</td>
                <td data-id="2">


                    <a href="{{route('admin.page.show',['page'=>$page])}}" class="btn btn-xs btn-primary">详情</a>
                    <span class="btn btn-danger btn-xs cmd-delete">删除</span>
                </td>
            </tr>
        @endforeach
            @else
            <tr><td colspan="4">暂时还未添加任何单页面</td></tr>
        @endif
        </tbody>
    </table>
@stop