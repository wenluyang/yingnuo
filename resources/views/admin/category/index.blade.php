@extends('admin.layouts.app')

@section('content')
    <div id="app">
        <div class="col-md-6">
            <div class="panel panel-success">
                <div class="panel-heading">
                    产品分类

                </div>
                <div class="list-group" id="category-tags">
                    @foreach($cats as $_item)
                        <div class="list-group-item" data-id="{{$_item->id}}">
                            <span class="name">{{$_item->name}}</span><span
                                    class="btn btn-xs btn-danger pull-right cmd-category-tag-delete" title="删除"><span
                                        class="glyphicon glyphicon-remove"></span> 删除</span>
                            @if (!$_item->is_show)
                                <span class="btn btn-xs btn-success pull-right cmd-category-tag-show" title="显示"  >
                        <span class="glyphicon glyphicon-eye-open"></span> 已隐藏</span></span>
                            @endif

                            @if ($_item->is_show)
                                <span class="btn btn-xs btn-warning pull-right cmd-category-tag-hide" title="隐藏">
                        <span class="glyphicon glyphicon-eye-close"></span> 隐藏</span></span>
                            @endif
                            <a class="btn btn-xs btn-primary pull-right cmd-category-tag-edit" title="编辑" href="{{route('admin.category.show',['category'=>$_item])}}"><span
                                        class="glyphicon glyphicon-edit"></span> 编辑</a>
                            <a class="btn btn-xs btn-info pull-right cmd-set-sort" title="排序" data-sort="{{$_item->sort}}" data-id="{{$_item->id}}"><span
                                        class="glyphicon glyphicon-education"></span> 排序</a>

                        </div>
                    @endforeach
                </div>
            </div>
        </div>



        <div class="col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading">产品分类信息</div>
                <div class="panel-body">
                    <form id="form-cate" class="form-horizontal">
                        <div class="form-group">
                            <label class="col-xs-3 control-label">名称</label>
                            <div class="col-xs-8">
                                <input type="text" class="form-control" name="name" value="{{isset($category)?$category->name:''}}" placeholder="栏目的显示名称">
                                <input type="hidden" class="form-control" name="id" value="{{isset($category)?$category->id:'0'}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-xs-3 control-label">列表描述</label>
                            <div class="col-xs-8">
                                <textarea class="form-control" name="description" cols="28" rows="5">{{isset($category)?$category->description:''}}
                                </textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-xs-3 control-label">文章封面</label>
                            <div class="clearfix col-xs-9">
                                <div class="image-upload">
                                    <input class="cmd-cover" type="file" name="file" accept="image/png, image/jpg, image/jpeg">
                                    <img src="{{isset($category)?buildPicUrl($category->image):'/images/default.png'}}" class="img-thumbnail">
                                    <input type="hidden" name="image" value="{{isset($category)?$category->image:'/images/default.png'}}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group" style="">
                            <label>正文</label>
                            <script type="text/javascript">
                                var ue = UE.getEditor('content', {
                                    toolbars: [
                                        ['source', 'bold', 'italic', 'underline', 'strikethrough', 'blockquote', 'insertunorderedlist', 'insertorderedlist', 'justifyleft', 'justifycenter', 'justifyright', 'link', 'insertimage', 'fullscreen']
                                    ],
                                    initialFrameHeight: 360,
                                    scaleEnabled: true,//设置不自动调整高度
                                    elementPathEnabled: false,
                                    enableContextMenu: false,
                                    autoClearEmptyNode: true,
                                    wordCount: false,
                                    imagePopup: false,
                                    autotypeset: {indent: true, imageBlockLine: 'center'}
                                });
                                ue.ready(function () {
                                    ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
                                });
                            </script>

                            <script id="content" name="content" type="text/plain">
                                {!!  isset($category)?$category->content:'' !!}
                            </script>

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
    </div>
@stop

@section('css')
    @include('vendor.ueditor.assets')
@endsection

@section('js')
    <script type="text/javascript" src="{{asset_url('js/uploader.js')}}"></script>
    <script type="text/javascript" src="{{asset_url('js/admin/upload.js')}}"></script>
    <script type="text/javascript" src="{{asset_url('js/admin/category.js')}}"></script>
@endsection