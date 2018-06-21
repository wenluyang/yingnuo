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
                            <label class="col-xs-3 control-label">选择用户</label>
                            <div class="col-xs-9">
                                <input id="input-merchant" type="text" class="form-control" readonly placeholder="不选择默认管理员发布" value="{{isset($article)?$article->user_id:'0'}}" data-toggle="modal" data-target="#modal-search-users"  name="user_id"  />
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-xs-3 control-label">所属栏目</label>
                            <div class="col-xs-9">
                                <select class="form-control" name="articlecat_id">
                                    <option value="0">--- 请选择 ---</option>
                                    @foreach($articlecats as $sc)
                                        <option value="{{$sc->id}}" {{(isset($article)&&$article->articlecat_id==$sc->id)?'selected':''}} >{{$sc->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-xs-3 control-label">文章描述</label>
                            <div class="col-xs-9">
                                <textarea name="description"  class="form-control" cols="33" rows="5">{{isset($article)?$article->description:''}}</textarea>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-xs-3 control-label">视频地址</label>
                            <div class="col-xs-9">
                                <input type="text" data-upload name="video" id="video" class="form-control" value="{{isset($article)?$article->video:''}}" placeholder="点击上传视频" data-upload'>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-xs-3 control-label">文章封面</label>
                            <div class="clearfix col-xs-9">
                                <div class="image-upload">
                                    <input class="cmd-cover" type="file" name="file" accept="image/png, image/jpg, image/jpeg">
                                    <img src="{{isset($article)?buildPicUrl($article->image):'/images/default.png'}}" class="img-thumbnail">
                                    <input type="hidden" name="image" value="{{isset($article)?$article->image:''}}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8" style="">
                <div class="panel panel-success" style="">
                    <div class="panel-heading">文章内容</div>
                    <div class="panel-body" style="">
                        <div class="form-group">
                            <label>标题</label>
                            <input type="text" name="title" class="form-control" value="{{isset($article)?$article->title:''}}" placeholder="请输入文章标题">
                        </div>

                        <div class="form-group">
                            <label>TAGS</label>
                            <input type="text" name="tags" class="form-control" value="{{isset($article)?$article->tags:''}}" placeholder="请输入文章TAG,多个用,分割，利于搜素">
                        </div>


                        <div class="form-group" style="">
                            <label>正文</label>
                            <script type="text/javascript">
                                var ue = UE.getEditor('content', {
                                    toolbars: [
                                        ['bold', 'italic', 'underline', 'strikethrough', 'blockquote', 'insertunorderedlist', 'insertorderedlist', 'justifyleft','justifycenter', 'justifyright',  'link', 'insertimage', 'fullscreen']
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
                                {!! isset($article)?$article->content:''  !!}
                            </script>

                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <input type="hidden" name="id" class="form-control" value="{{isset($article)?$article->id:'0'}}">

                    <span class="btn btn-success pull-right cmd-save">保存</span>
                </div>
        </form>
    </div>



    <div class="modal fade" id="modal-search-users" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">搜索用户</h4>
                </div>
                <div class="modal-body">
                    <div class="row" style="margin-bottom: 20px;">

                        <div class="col-xs-12">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="搜索用户名称、联系人、电话" />
                                <span class="input-group-btn">
                                <span class="btn btn-primary" id="cmd-search-merchant">搜索</span>
                            </span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-xs-8 col-xs-offset-2">
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-striped active" style="width: 100%">加载中……</div>
                                    </div>
                                </div>
                            </div>
                            <div class="data" style="display: none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
    <script type="text/javascript" src="{{asset_url('js/admin/article.js')}}"></script>
@endsection