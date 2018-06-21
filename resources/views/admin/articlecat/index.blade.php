@extends('admin.layouts.app')

@section('content')
    <div class="col-md-6">
        <div class="panel panel-success">
            <div class="panel-heading">
                栏目分类

            </div>
            <div class="list-group" id="category-tags">
                @foreach($articlecats as $_item)
                    <div class="list-group-item" data-id="{{$_item->id}}"><span class="name">{{$_item->name}}</span><span
                                class="btn btn-xs btn-danger pull-right cmd-category-tag-delete" title="删除"><span
                                    class="glyphicon glyphicon-remove"></span> 删除</span>
                        @if (!$_item->status)
                            <span class="btn btn-xs btn-success pull-right cmd-category-tag-show" title="显示"  >
                        <span class="glyphicon glyphicon-eye-open"></span> 已隐藏</span></span>
                        @endif

                        @if ($_item->status)
                            <span class="btn btn-xs btn-warning pull-right cmd-category-tag-hide" title="隐藏">
                        <span class="glyphicon glyphicon-eye-close"></span> 隐藏</span></span>
                        @endif
                        <a class="btn btn-xs btn-primary pull-right cmd-category-tag-edit" title="编辑" href="{{route('admin.articlecat.show',['shcoolcat'=>$_item])}}"><span
                                    class="glyphicon glyphicon-edit"></span> 编辑</a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>



    <div class="col-md-6">
        <div class="panel panel-info">
            <div class="panel-heading">栏目信息</div>
            <div class="panel-body">
                <form id="form-cate" class="form-horizontal">
                    <div class="form-group">
                        <label class="col-xs-3 control-label">名称</label>
                        <div class="col-xs-8">
                            <input type="text" class="form-control" name="name" value="{{isset($articleCat)?$articleCat->name:''}}" placeholder="栏目的显示名称">
                            <input  type="hidden" class="form-control" name="id" value="{{isset($articleCat)?$articleCat->id:'0'}}" >
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-9 col-xs-offset-3">
                            <span class="btn btn-success" id="cmd-cate-save">保存</span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop


@section('js')
    <script type="text/javascript" src="{{asset_url('js/admin/articlecat.js')}}"></script>
@stop