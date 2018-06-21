@extends('admin.layouts.app')
@section('content')
    <div class="row" style="">
        <form id="form-product" class="form-horizontal" style="">
            <div class="col-md-12" style="margin-bottom: 22px;">
                <span class="btn btn-success cmd-save">保存</span>
            </div>

            <div class="col-md-5">
                <div class="panel panel-info">
                    <div class="panel-heading">产品信息</div>
                    <div class="panel-body">



                        <div class="form-group">
                            <label class="col-xs-3 control-label">产品分类</label>
                            <div class="col-xs-9">
                                <select class="form-control" name="category_id">
                                    <option value="0">--- 请选择 ---</option>
                                    @foreach($category as $item)
                                        <option value="{{$item->id}}" {{isset($goods)&&$goods->category_id==$item->id?'selected':''}} >{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-xs-3 control-label">产品名称</label>
                            <div class="col-xs-9">
                                <input type="text" name="name" class="form-control" value="{{isset($goods)?$goods->name:''}}">
                                <input type="hidden" name="id" class="form-control" value="{{isset($goods)?$goods->id:'0'}}">
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-xs-3 control-label">产品库存</label>
                            <div class="col-xs-9">
                                <input type="text" name="stock" class="form-control" value="{{isset($goods)?$goods->stock:''}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-xs-3 control-label">产品价格</label>
                            <div class="col-xs-9">
                                <input type="text" name="price" class="form-control" value="{{isset($goods)?$goods->price:''}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-xs-3 control-label">返现比率</label>
                            <div class="col-xs-9">
                                <input type="text" name="rebate" class="form-control" value="{{isset($goods)?$goods->rebate:''}}">
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-xs-3 control-label">产品描述</label>
                            <div class="col-xs-9">
                                <textarea type="text" name="description" class="form-control">{{isset($goods)?$goods->description:''}}</textarea>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-xs-3 control-label">产品视频</label>
                            <div class="col-xs-9">
                                <input type="text" name="video" class="form-control" value="{{isset($goods)?$goods->video:''}}">
                            </div>
                        </div>



                        <div class="form-group">
                            <label class="col-xs-3 control-label">产品封面</label>
                            <div class="clearfix col-xs-9">
                                <div class="image-upload">
                                    <input class="cmd-cover" type="file" name="file" accept="image/png, image/jpg, image/jpeg">
                                    <img src="{{isset($goods)?buildPicUrl($goods->image):'/images/default.png'}}" class="img-thumbnail">
                                    <input type="hidden" name="image" value="{{isset($goods)?$goods->image:''}}">
                                </div>
                            </div>
                        </div>



                    </div>
                </div>
            </div>

            <div class="col-md-7" style="">
                <div class="panel panel-success" style="">
                    <div class="panel-heading">基本信息</div>
                    <div class="panel-body" style="">
                        <script type="text/javascript">
                            var ue = UE.getEditor('content', {
                                toolbars: [
                                    ['source', 'bold', 'italic', 'underline', 'strikethrough', 'blockquote', 'insertunorderedlist', 'insertorderedlist', 'justifyleft', 'justifycenter', 'justifyright', 'link', 'insertimage', 'fullscreen']
                                ],
                                initialFrameHeight: 460,
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


                        </script>

                    </div>
                </div>

            </div>

            <div class="col-md-12">
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
    <script type="text/javascript" src="{{asset_url('js/admin/upload.js')}}"></script>
    <script type="text/javascript" src="{{asset_url('js/ja.upload.js')}}"></script>
    <script type="text/javascript" src="{{asset_url('js/qiniu.js')}}"></script>
    <script type="text/javascript" src="{{asset_url('js/admin/goods.js')}}"></script>
@endsection