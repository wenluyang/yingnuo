@extends('admin.layouts.app')

@section('content')

   <div class="row">
        <div class="col-md-3">
            <a class="btn btn-success" href="/admin/merchant/create"><span class="glyphicon glyphicon-plus"></span>导出订单</a>
        </div>
        <form class="form-inline wrap_search">

        {{--<div class="col-md-3 col-xs-3 pull-right">--}}
            {{--<div class="input-group">--}}
                {{--<span class="input-group-addon">订单筛选</span>--}}
                {{--<select class="form-control" name="status">--}}
                    {{--<option value="-9">全部订单</option>--}}
                    {{--@foreach($pay_status_mapping as $_status => $_title)--}}
                        {{--<option value="{{$_status}}" {{$search_conditions['status']  == $_status?"selected":'' }}> {{$_title}}</option>--}}
                    {{--@endforeach--}}
                {{--</select>--}}
            {{--</div>--}}
        {{--</div>--}}
        </form>
    </div>

    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th style="width: 40px;"></th>
            <th style="width: 40px;">ID</th>
            <th style="width: 200px;">下单人</th>
            <th>订购产品名称</th>
            <th style="width: 80px;">价格</th>
            <th>收件人信息</th>
            <th>下单时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>


        @foreach($data as $_item)

        <tr style="font-size: 12px">
            <td>
                    <span class="btn btn-success btn-xs cmd-copy-url" data-toggle="collapse" href="#collapse{{$_item['id']}}" >
                        <span class="glyphicon glyphicon-plus"></span>
                    </span>
            </td>
            <td>
                {{$_item['sn']}}
            </td>
            <td>

               名称： {{$_item['realname']}}<br>
                电话：{{$_item['user_mobile']}}<br>
                会员等级:22<br>


            </td>
            <td>
                @foreach($_item['items'] as $_order_item)
                {{$_order_item["name"]}}× {{$_order_item["quantity"]}}<br/>
                @endforeach
            </td>
            <td>{{$_item['total_price']}}</td>
            <td>

                收件人：{{isset($_item['reciver_new'])?$_item['reciver_new']:$_item['receiver']}}<br>
                电话：{{isset($_item['mobile_new'])?$_item['mobile_new']:$_item['mobile']}}<br>
                
                @if (isset($_item['address_new']))
                    {{$_item['address_new']}}
                @else
                地址：{{$_item['provide']}}{{$_item['city']}}{{$_item['area']}}{{$_item['address']}}
                @endif
            </td>
            {{--<td>{{$_item['status_desc']}}</td>--}}
            <td>{{$_item['created_time']}}</td>

            <td data-id="{{$_item['id']}}">
                @if ($_item['express_status']==0)
                    <a class="btn btn-xs btn-info">{{$_item['express_status_desc']}}</a>

                @elseif ($_item['express_status']==-8)
                    <a class="btn btn-xs btn-success">{{$_item['express_status_desc']}}</a>
                    <a class="btn btn-xs btn-danger quxiao" >点击取消订单</a>
                @elseif ($_item['express_status']==-7)
                    <a class="btn btn-xs btn-danger">{{$_item['express_status_desc']}}</a>
                @elseif ($_item['express_status']==-6)
                    <a class="btn btn-xs btn-default">{{$_item['express_status_desc']}}</a>
                    <a class="btn btn-xs btn-danger wancheng" >点击完成订单</a>

                @elseif ($_item['express_status']==1)
                    <a class="btn btn-xs btn-primary">{{$_item['express_status_desc']}}</a>
                @endif
                <a  target="_blank" href="{{route('admin.finance.payinfo',['id'=>$_item['id']])}}" class="btn btn-xs btn-primary">详情</a>

            </td>
        </tr>

            <tr>
                <td colspan="8">
                    <div id="collapse{{$_item['id']}}" class="collapse bg-primary" data-parent="#accordion">
                        <table class="table table-bordered table-sm text-danger bg-info">

                            <tbody>
                            <tr>
                                <td>下单人信息</td>
                                <td>
                                    名称： {{$_item['realname']}}<br>
                                    电话：{{$_item['user_mobile']}}
                                </td>
                            </tr>
                            <tr>
                                <td>收件人信息</td>
                                <td>
                                    收件人：{{isset($_item['reciver_new'])?$_item['reciver_new']:$_item['receiver']}}<br>
                                    电话：{{isset($_item['mobile_new'])?$_item['mobile_new']:$_item['mobile']}}<br>

                                    @if (isset($_item['address_new']))
                                        {{$_item['address_new']}}
                                    @else
                                        地址：{{$_item['provide']}}{{$_item['city']}}{{$_item['area']}}{{$_item['address']}}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>订购产品信息</td>
                                <td>
                                    @foreach($_item['items'] as $_order_item)
                                        {{$_order_item["name"]}}× {{$_order_item["quantity"]}}<br/>
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <td>订购产品总价格</td>
                                <td>
                                    {{$_item['total_price']}}元
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </td>

            </tr>
            @endforeach

        </tbody>
    </table>

    <ul class="pagination">

        {!! $list->appends($linkParams)->links() !!}
    </ul>
@stop

@section('js')
    <script type="text/javascript">

        //确认订单
        $('.wancheng').click(function () {

            var $this = $(this);

            $.post(
                '/admin/orders/wancheng?id=###'.replace('###', $this.parent().data('id')),
                {_method: 'POST'},
                function (response) {
                    if (response.status) {
                        layer.msg(response.msg, {time: 1000},function () {
                            window.location.reload();
                        });

                    }
                },
                'json'
            );

        })



        //确认订单
        $('.quxiao').click(function () {

            var $this = $(this);

            $.post(
                '/admin/orders/quxiao?id=###'.replace('###', $this.parent().data('id')),
                {_method: 'POST'},
                function (response) {
                    if (response.status) {
                        layer.msg(response.msg, {time: 1000},function () {
                            window.location.reload();
                        });

                    }
                },
                'json'
            );

        })


        var finance_index_ops = {
            init:function(){
                this.eventBind();
            },
            eventBind:function(){
                var that = this;
                $(".wrap_search select[name=status]").change( function(){
                    $(".wrap_search").submit();
                });
            }
        };

        $(document).ready( function(){
            finance_index_ops.init();
        });
    </script>
@stop