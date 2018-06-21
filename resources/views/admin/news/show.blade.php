@extends('admin.layouts.app')
@section('content')
    <div class="row" style="">
        <form id="form-article" style="">
            <div class="col-md-12" style="margin-bottom: 22px;">
                <span class="btn btn-success cmd-save">保存</span>
            </div>

            <div class="col-md-4 form-horizontal">
                <div class="panel panel-info">
                    <div class="panel-heading">基本信息</div>
                    <div class="panel-body">


                        <div class="form-group">
                            <label class="col-xs-3 control-label">所属栏目</label>
                            <div class="col-xs-9">
                                <select class="form-control" name="newscat_id">
                                    <option value="0">--- 请选择 ---</option>
                                    @foreach($newscats as $sc)
                                        <option value="{{$sc->id}}" {{(isset($news)&&$news->newscat_id==$sc->id)?'selected':''}} >{{$sc->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-xs-3 control-label">新闻描述</label>
                            <div class="col-xs-9">
                                <textarea name="description" class="form-control" cols="28"
                                          rows="6">{{isset($news)?$news->description:''}}</textarea>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-xs-3 control-label">视频地址</label>
                            <div class="col-xs-9">
                                <input type="text" data-upload name="video" id="video" class="form-control"
                                       value="{{isset($news)?$news->video:''}}" placeholder="点击上传视频" data-upload'>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-xs-3 control-label">新闻封面</label>
                            <div class="clearfix col-xs-9">
                                <div class="image-upload">
                                    <input class="cmd-cover" type="file" name="file"
                                           accept="image/png, image/jpg, image/jpeg">
                                    <img src="{{isset($news)?buildPicUrl($news->image):'/images/default.png'}}"
                                         class="img-thumbnail">
                                    <input type="hidden" name="image" value="{{isset($news)?$news->image:''}}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8" style="">
                <div class="panel panel-success" style="">
                    <div class="panel-heading">新闻内容</div>
                    <div class="panel-body" style="">
                        <div class="form-group">
                            <label>标题</label>
                            <input type="text" name="title" class="form-control"
                                   value="{{isset($news)?$news->title:''}}" placeholder="请输入文章标题">
                        </div>

                        <div class="form-group">
                            <label>TAGS</label>
                            <input type="text" name="tags" class="form-control" value="{{isset($news)?$news->tags:''}}"
                                   placeholder="请输入文章TAG,多个用,分割，利于搜素">
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
                                {!! isset($news)?$news->content:''  !!}
                            </script>

                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <input type="hidden" name="id" class="form-control" value="{{isset($news)?$news->id:'0'}}">

                    <span class="btn btn-success pull-right cmd-save">保存</span>
                </div>
        </form>
    </div>




@stop

@section('css')
    @include('vendor.ueditor.assets')
    <link rel="stylesheet" href="https://cdn.asilu.com/bootstrap.css,github.css">
    <link rel="stylesheet" href="{{asset_url('plugins/tagsinput/jquery.tagsinput.min.css')}}">

@endsection


@section('js')
    <script type="text/javascript" src="{{asset_url('js/uploader.js')}}"></script>
    <script type="text/javascript" src="{{asset_url('js/admin/upload.js')}}"></script>
    <script type="text/javascript" src="{{asset_url('js/ja.upload.js')}}"></script>
    <script type="text/javascript" src="{{asset_url('js/qiniu.js')}}"></script>
    <script type="text/javascript" src="{{asset_url('plugins/tagsinput/jquery.tagsinput.min.js')}}"></script>
    <script type="text/javascript" src="{{asset_url('js/admin/news.js')}}"></script>
@endsection