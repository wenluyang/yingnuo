@extends('admin.layouts.app')
@section('content')
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading">产品列表</div>
            <div class="panel-body">
                <div class="box-body table-responsive">
                    <div id="datatables_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">

                        <div class="row">
                            <div class="col-sm-12">
                                <table id="datatables" class="table table-bordered table-striped dataTable no-footer" role="grid"
                                       aria-describedby="datatables_info" style="width: 100%;">
                                    <thead>
                                    <tr role="row">
                                        <td class="text-center sorting_disabled" rowspan="1" colspan="1" aria-label=""
                                            style="width: 27.8px;">ID</td>
                                        <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                                            aria-label="商品名称: activate to sort column ascending" style="width: 146.6px;">商品名称
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                                            aria-label="价格(元): activate to sort column ascending" style="width: 96.2px;">价格(元)
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                                            aria-label="分类名称: activate to sort column ascending" style="width: 103.4px;">分类名称
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                                            aria-label="上架: activate to sort column ascending" style="width: 61px;">返现比率
                                        </th>

                                        <th class="sorting_desc" rowspan="1" colspan="1" aria-label="预览图" style="width: 83.4px;">
                                            预览图
                                        </th>

                                        <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="操作"
                                            style="width: 147.6px;">操作
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($goods as $item)
                                        <tr role="row" class="odd">
                                            <td class=" text-center">{{$item->id}}</td>
                                            <td>{{$item->name}}</td>
                                            <td>{{$item->price}}</td>
                                            <td>校园外卖</td>
                                            <td>{{$item->rebate}}</td>
                                            <td class="sorting_1"><img
                                                        src="{{buildPicUrl($item->image)}}"
                                                        alt="" width="100px" height="100px"></td>

                                            <td>
                                                <a href="{{route('admin.goods.edit',['goods'=>$item->id])}}" class="btn btn-info edit">编辑</a>
                                                <a href="{{route('admin.goods.info',['goods'=>$item->id])}}" class="btn btn-success edit">记录</a>
                                                <a   class="btn btn-danger del" href="{{route('admin.goods.delete',['goods'=>$item->id])}}">删除</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

