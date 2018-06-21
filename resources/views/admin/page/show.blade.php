@extends('admin.layouts.app')

@section('content')
    <div class="row" style="">
        <form id="form-page" style="">
            <div class="col-md-12" style="margin-bottom: 22px;">
                <span class="btn btn-success cmd-save">保存</span>
            </div>

            <div class="col-md-4 form-horizontal">
                <div class="panel panel-info">
                    <div class="panel-heading">基本信息</div>
                    <div class="panel-body">



                        <div class="form-group">
                            <label class="col-xs-3 control-label">封面1</label>
                            <div class="clearfix col-xs-9">
                                <div class="image-upload">
                                    <input class="cmd-cover" type="file" name="file" accept="image/png, image/jpg, image/jpeg">
                                    <img src="{{isset($page)?buildPicUrl($page->image):'/images/default.png'}}" class="img-thumbnail">
                                    <input type="hidden" name="image" value="{{isset($page)?$page->image:''}}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8" style="">
                <div class="panel panel-success" style="">
                    <div class="panel-heading">单页内容</div>
                    <div class="panel-body" style="">
                        <div class="form-group">
                            <label>标题</label>
                            <input type="text" name="title" class="form-control" value="{{isset($page)?$page->title:''}}" placeholder="请输入文章标题">
                        </div>

                        <div class="form-group" style="">
                            <label>正文</label>
                            <script type="text/javascript">
                                var ue = UE.getEditor('content', {
                                    toolbars: [
                                        ['source', 'bold', 'italic', 'underline', 'strikethrough', 'blockquote', 'insertunorderedlist', 'insertorderedlist', 'justifyleft', 'justifycenter', 'justifyright', 'link', 'insertimage', 'fullscreen']
                                    ],
                                    initialFrameHeight: 260,
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
                                {!! isset($page)?$page->content:''  !!}
                            </script>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <input type="hidden" name="id" class="form-control" value="{{isset($page)?$page->id:''}}">

                <span class="btn btn-success cmd-save pull-right">保存</span>
            </div>
        </form>
    </div>
@stop

@section('css')
    @include('vendor.ueditor.assets')

@endsection


@section('js')
    <script type="text/javascript" src="{{asset_url('js/uploader.js')}}"></script>
    <script type="text/javascript" src="{{asset_url('js/admin/page.js')}}"></script>
    <script type="text/javascript" src="{{asset_url('js/admin/upload.js')}}"></script>
@endsection