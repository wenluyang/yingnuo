@extends('admin.layouts.app')
@section('content')
    <ul class="nav nav-tabs">
        <li class="current"><a>当前产品名称：{{$goods->name}}</a></li>



    </ul>
    <form action="{{route('admin.goods.saveprice',['goods'=>$goods->id])}}" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    <table class="table table-hover">
        <thead>
        <tr>
            <th style="width: 15%">会员级别</th>
            <th style="width: 15%">会员价格</th>
            <th style="width: 15%">会员返现比率</th>
        </tr>
        </thead>
        <tbody>
        @foreach($jibie as $item)
        <tr>
            <td>
                <input type="hidden" required=""  class="form-control" name="jibie[]" value="{{$item->id}}" required>
                <select name="" id="" class="form-control" disabled>
                    <option value="{{$item->id}}" >
                        {{$item->jibie_name}}
                    </option>

                </select>


                </div>
            </td>
            <td>
                <div class="form-group ">
                    <input type="text" required=""  class="form-control" name="jb_price[]" value="{{$fenji_price[$item->id]}}" required>
                </div>
            </td>
            <td>
                <div class="form-group ">
                    <input type="text" class="form-control" name="jb_rebase[]" value="{{$fenji_rebase[$item->id]}}" required>
                </div>
            </td>
        </tr>
            @endforeach
        </tbody>
    </table>
    <hr>
    <div class="box-footer">
        <div class="col-md-2 col-md-offset-4">
            <a href="/admin/goods" class="btn btn-block btn-default btn-flat">返回</a>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-block btn-primary btn-flat">更新</button>
        </div>
    </div>

   </form>
@stop