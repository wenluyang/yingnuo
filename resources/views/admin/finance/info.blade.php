@extends('admin.layouts.app')

@section('content')
    <div class="col-md-6">
        <div class="panel panel-info">
            <div class="panel-heading">订单详情


                @if ($data_pay_order_info['express_status'] == -8)
                    <span class="btn btn-xs btn-primary pull-right confirm-order"
                          data-id="{{$data_pay_order_info['id']}}">点击审核该订单</span>
                @endif
                @if ($data_pay_order_info['status'] == 1 && $data_pay_order_info['express_status'] == -7)
                    <span class="btn btn-xs btn-primary pull-right express_send"
                          data-id="{{$data_pay_order_info['id']}}">确认发货</span>
                @endif

                @if ($data_pay_order_info['status'] == 1 && $data_pay_order_info['express_status'] == -6)
                    <span class="btn btn-xs btn-primary pull-right" data-id="{{$data_pay_order_info['id']}}">订单已发货，等待客户确认</span>
                @endif

                @if ($data_pay_order_info['status'] == 1 && $data_pay_order_info['express_status'] == 1)
                    <span class="btn btn-xs btn-primary pull-right">客户已经签收</span>
                @endif


            </div>

            <div class="panel-body">
                <form id="form-cate" class="form-horizontal">
                    <input type="hidden" name="image_id" value="0">
                    <div class="form-group">
                        <label class="col-xs-3 control-label">订单编号</label>
                        <div class="col-xs-8">
                            <span type="text" class="form-control"> {{$data_pay_order_info['sn']}}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-3 control-label">会员昵称</label>
                        <div class="col-xs-8">
                            <span type="text" class="form-control"> {{$data_member_info['nickname']}}</span>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-xs-3 control-label">会员公司名称</label>
                        <div class="col-xs-8">
                            <span type="text" class="form-control"> {{$data_member_info['realname']}}</span>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-xs-3 control-label">会员手机</label>
                        <div class="col-xs-8">
                            <span type="text" class="form-control"> {{$data_member_info['mobile']}}</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-xs-3 control-label">订单总价格</label>
                        <div class="col-xs-8">
                            <span type="text" class="form-control"> {{$data_pay_order_info['total_price']}}元</span>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-xs-3 control-label">订单状态</label>
                        <div class="col-xs-8">
                            <span type="text" class="form-control"> {{$data_pay_order_info['status_desc']}}</span>
                        </div>
                    </div>

                    @if ($data_pay_order_info['status']==1)
                        <div class="form-group">
                            <label class="col-xs-3 control-label">快递状态</label>
                            <div class="col-xs-8">
                            <span type="text" class="form-control">
                    {{$data_pay_order_info['express_status_desc']}}
                            </span>
                            </div>
                        </div>
                    @endif


                    @if ($data_pay_order_info['status']==1)
                        <div class="form-group">
                            <label class="col-xs-3 control-label">确定时间</label>
                            <div class="col-xs-8">
                            <span type="text" class="form-control">
                                {{$data_pay_order_info['pay_time']}}
                            </span>
                            </div>
                        </div>
                    @endif


                    <div class="form-group">
                        <label class="col-xs-3 control-label">下单时间</label>
                        <div class="col-xs-8">
                            <span type="text" class="form-control"> {{$data_pay_order_info['created_time']}}</span>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-xs-3 control-label">收货人姓名</label>
                        <div class="col-xs-8">

                            @if ($data_pay_order_info['reciver_new'])
                                <span type="text" class="form-control"> {{$data_pay_order_info['reciver_new']}}</span>
                            @else
                                <span type="text" class="form-control"> {{$data_address_info['nickname']}}</span>
                            @endif
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-xs-3 control-label">收货人电话</label>
                        <div class="col-xs-8">
                            @if ($data_pay_order_info['mobile_new'])
                                <span type="text" class="form-control"> {{$data_pay_order_info['mobile_new']}}</span>
                            @else
                                <span type="text" class="form-control"> {{$data_address_info['mobile']}}</span>
                            @endif

                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-xs-3 control-label">收货人地址</label>
                        <div class="col-xs-8">

                            @if($data_pay_order_info['address_new'])
                                <textarea type="text"
                                          class="form-control"> {{$data_pay_order_info['address_new']}}</textarea>
                            @else
                                <textarea type="text" class="form-control"> {{$data_address_info['address']}}</textarea>
                            @endif


                            @if ($data_pay_order_info['express_status']<=-7)
                                <span class="btn btn-danger btn-xs pull-right" id="cmd-tag-create"
                                      data-id="{{$data_pay_order_info['express_address_id']}}">修改收货人信息</span>
                            @endif
                        </div>
                    </div>


                </form>
            </div>
        </div>
    </div>


    <div class="col-md-6">
        <div class="panel panel-success">
            <div class="panel-heading">
                订单商品

            </div>

            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th style="width: 40px;"></th>
                    <th>产品名称</th>
                    <th>产品封面</th>
                    <th>订购数量</th>
                    <th>产品价格</th>
                </tr>
                </thead>
                <tbody>

                @foreach($pay_order_items as $_order_item)
                    <tr>
                        <td>
                    <span class="btn btn-success btn-xs cmd-copy-url">
                        <span class="glyphicon glyphicon-link"></span>
                    </span>
                        </td>
                        <td>

                            {{$_order_item['name']}}

                        </td>
                        <td><img src="{{$_order_item['image']}}" width="20px" height="20px"></td>
                        <td>{{$_order_item['quantity']}} </td>
                        <td>{{$_order_item['price']}} 元</td>
                    </tr>

                @endforeach

                <tr>
                    <td colspan="5">
                        <div align="right" style="font-weight: bold">产品总价格： {{$data_pay_order_info['total_price']}}元
                        </div>
                    </td>
                </tr>

                </tbody>
            </table>
        </div>

        @if ($data_pay_order_info['status'] == 1 )
            <div class="panel panel-info">
                <div class="panel-heading">快递单信息
                    <span class="btn btn-xs btn-primary pull-right express_edit"
                          data-payorderid="{{$data_pay_order_info['id']}}">修改快递信息</span>
                </div>
                <div class="panel-body">

                    <div id="express-info">
                        @if (!empty($data_pay_order_info['express_info']))
                            委托快递公司：{{$data_pay_order_info['express_name']}}<br>
                            快递单号：{{$data_pay_order_info['express_info']}}
                        @endif
                    </div>

                    <form id="form-express"
                          class="form-horizontal" {{!empty($data_pay_order_info['express_info'])?'style=display:none':''}}>
                        <input type="hidden" name="image_id" value="0">
                        <div class="form-group kuaidi-content">
                            <label class="col-xs-3 control-label">选择快递公司</label>
                            <div class="col-xs-8">
                                <select class="form-control" name="express" id="express">
                                    <option value="0">--- 请选择 ---</option>
                                    @foreach($kuaidis as $kuaidi=>$v)
                                        <option value="{{$kuaidi}}">{{$v}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label">快递单号</label>
                            <div class="clearfix col-xs-8">
                                <input type="text" class="form-control" name="danhao" id="danhao" placeholder="请填写发货单号">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-9 col-xs-offset-3">
                                <span data-payorderid="{{$data_pay_order_info['id']}}" class="btn btn-success"
                                      id="cmd-express-save">保存快递信息</span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        @endif
    </div>


    {{--修改收货人信息--}}

    <div class="modal fade" id="modal-tag" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <form class="form-horizontal" id="form-tag">
                            <input type="hidden" name="image_id" value="0"/>
                            <div class="col-sm-10 col-sm-offset-1">
                                <div class="form-group row">
                                    <label class="col-sm-4 control-label">收货人：</label>
                                    <div class="col-sm-6">
                                        @if ($data_pay_order_info['reciver_new'])
                                            <input name="reciver_new" type="text" class="form-control"
                                                   value="{{$data_pay_order_info['reciver_new']}}"> </input>
                                        @else
                                            <input name="reciver_new" type="text" class="form-control"
                                                   value="{{$data_address_info['nickname']}}"> </input>
                                        @endif

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 control-label">联系电话：</label>
                                    <div class="col-sm-6">
                                        @if ($data_pay_order_info['mobile_new'])
                                            <input name="mobile_new" type="text" class="form-control"
                                                   value="{{$data_pay_order_info['mobile_new']}}"> </input>
                                        @else
                                            <input name="mobile_new" type="text"
                                                   value="{{$data_address_info['mobile']}}"
                                                   class="form-control"> </input>
                                        @endif
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label class="col-sm-4 control-label">详细地址</label>
                                    <div class="col-sm-6">
                                        <div>
                                            @if($data_pay_order_info['address_new'])
                                                <textarea name="address_new" type="text"
                                                          class="form-control"> {{$data_pay_order_info['address_new']}}</textarea>
                                            @else
                                                <textarea name="address_new" type="text"
                                                          class="form-control"> {{$data_address_info['address']}}</textarea>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <input   name="payorder_id" type="text" class="form-control hidden"
                                       value="{{$data_pay_order_info['id']}}"> </input>

                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>

                    <button type="button" class="btn btn-success" id="action-tag-save">保存
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{--修改收货人信息--}}
@stop


@section('js')

    <script src="/js/admin/finance.js"></script>

    <script type="text/javascript">
        //修改快递信息

        $('.express_edit').click(function () {

            $('#express-info').hide();
            $('#form-express').show();

            $('#express').val({{$data_pay_order_info['express_id']}}).end();
            $('#danhao').val({{$data_pay_order_info['express_info']}}).end();

        });


        // // 修改收件人信息
        // $('#cmd-tag-create').click(function () {
        //   $('#modal-tag').modal('show');
        // });
        //
        //
        //
        // $('#action-tag-save').click(function () {
        //     if ($('#modal-tag').find('[name=reciver_new]').val() == 0) {
        //         layer.alert('收件人姓名必须填写', function (index) {
        //             layer.close(index);
        //         });
        //         return false;
        //     }
        //     if ($('#modal-tag').find('[name=mobile_new]').val() == 0) {
        //         layer.alert('收件人电话必须填写', function (index) {
        //             layer.close(index);
        //         });
        //         return false;
        //     }
        //
        //     if ($('#modal-tag').find('[name=address_new]').val() == 0) {
        //         layer.alert('收件人地址必须填写', function (index) {
        //             layer.close(index);
        //         });
        //         return false;
        //     }
        // });
        //
        // var data={
        //     reciver_new:$('#modal-tag').find('[name=reciver_new]').val(),
        //     mobile_new:$('#modal-tag').find('[name=mobile_new]').val(),
        //     address_new:$('#modal-tag').find('[name=address_new]').val()
        // };
        //
        //
        // $.ajax({
        //     url:'/admin/address/update',
        //     type:'POST',
        //     dataType:'json',
        //     data:data,
        //     success:function( res ){
        //         if(res.satus){
        //             alert('312321');
        //             window.location.href = window.location.href;
        //         }
        //     }
        // });


    </script>

@stop