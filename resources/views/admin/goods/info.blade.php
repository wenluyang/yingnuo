@extends('admin.layouts.app')

@section('css')
    <style type="text/css">
        .thumb {
            position: relative;
            text-align: center;
            width: 100%;
            height: 150px;
            background-repeat: no-repeat;
            background-position: 50% 50%;
            background-size: cover;
        }

        #add-file .thumb {
            width: 100%;
            overflow: hidden;
            background-repeat: no-repeat;
            background-size: cover;
            background-color: #e3e9e6;
            background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAfQAAAH0AQMAAADxGE3JAAAAA3NCSVQICAjb4U/gAAAABlBMVEX///////9VfPVsAAAAAnRSTlMA/1uRIrUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAAcdEVYdFNvZnR3YXJlAEFkb2JlIEZpcmV3b3JrcyBDUzbovLKMAAAAFnRFWHRDcmVhdGlvbiBUaW1lADA1LzMwLzE3jDoW9QAAAHBJREFUeJzty7ERABAQADAbGOlXt9mruNNRIulTCgAAAAAAwDcih+b7vu/7vu/7vu/7vu/7vu/7vu/7/vGvucP3fd/3fd/3fd/3fd/3/Rv/KuZou8X3fd/3fd/3fd/3fd/3fd/3fd/3fQAAAAAAgJd0e88ZtdVd1W4AAAAASUVORK5CYII=');
        }

        .caption {
            text-align: center;
            height: 54px;
            line-height: 36px;
        }

        .thumb span {
            display: block;
            position: absolute;
            top: 10px;
            right: 10px;
            opacity: 0.7;
        }

        #uploader {
            opacity: 0;
            font-size: 999px;
        }

        .thumbnail .progress {
            height: 100%;
            width: 100%;
            background: #000;
            bottom: 0;
            left: 0;
            opacity: 0.3;
            position: absolute;
            margin: 0;
        }

        .nav-tabs {
            margin-bottom: 22px;
        }

        .current > a:before {
            content: '当前产品: ';
        }

        .current > a {
            color: #555;
        }

        .nav-tabs > li.current > a:hover {
            background-color: inherit;
            border: 1px solid transparent;
        }
    </style>
@endsection

@section('content')
    <ul class="nav nav-tabs">
        <li class="current"><a>{{$goods->name}}</a></li>
        <li class="active"><a href="#tab-info" data-toggle="tab">销售历史</a></li>
        <li><a href="#tab-images" data-toggle="tab">库存变更</a></li>


    </ul>
    <div class="tab-content">
        <div class="row tab-pane active" id="tab-info">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th style="width: 40px;"></th>
                    <th>产品名称</th>
                    <th>添加时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>

                    </td>
                    <td>
                        <a href="/product/300" title="新窗口打开" target="_blank">
                            希腊国家银行拟出售塞浦路斯分公司
                            <span class="glyphicon glyphicon-new-window"></span>
                        </a>
                    </td>
                    <td>2018-05-31</td>
                    <td data-id="300">
                        <a href="/admin/merchant/367/product/300/show" class="btn btn-xs btn-primary" target="_top">详情</a>
                        <span class="btn btn-xs btn-danger cmd-delete">删除</span>
                    </td>
                </tr>
                <tr>
                    <td>
                    <span class="btn btn-success btn-xs cmd-copy-url" title="复制 URL 地址" data-clipboard-text="/product/299">
                        <span class="glyphicon glyphicon-link"></span>
                    </span>
                    </td>
                    <td>
                        <a href="/product/299" title="新窗口打开" target="_blank">
                            帕福斯四星海滨酒店
                            <span class="glyphicon glyphicon-new-window"></span>
                        </a>
                    </td>
                    <td>2018-05-30</td>
                    <td data-id="299">
                        <a href="/admin/merchant/367/product/299/show" class="btn btn-xs btn-primary" target="_top">详情</a>
                        <span class="btn btn-xs btn-danger cmd-delete">删除</span>
                    </td>
                </tr>
                <tr>
                    <td>
                    <span class="btn btn-success btn-xs cmd-copy-url" title="复制 URL 地址" data-clipboard-text="/product/296">
                        <span class="glyphicon glyphicon-link"></span>
                    </span>
                    </td>
                    <td>
                        <a href="/product/296" title="新窗口打开" target="_blank">
                            服务主体&amp;专注领域
                            <span class="glyphicon glyphicon-new-window"></span>
                        </a>
                    </td>
                    <td>2018-05-29</td>
                    <td data-id="296">
                        <a href="/admin/merchant/367/product/296/show" class="btn btn-xs btn-primary" target="_top">详情</a>
                        <span class="btn btn-xs btn-danger cmd-delete">删除</span>
                    </td>
                </tr>
                <tr>
                    <td>
                    <span class="btn btn-success btn-xs cmd-copy-url" title="复制 URL 地址" data-clipboard-text="/product/292">
                        <span class="glyphicon glyphicon-link"></span>
                    </span>
                    </td>
                    <td>
                        <a href="/product/292" title="新窗口打开" target="_blank">
                            塞浦路斯待售酒店（运营中）清单
                            <span class="glyphicon glyphicon-new-window"></span>
                        </a>
                    </td>
                    <td>2018-05-28</td>
                    <td data-id="292">
                        <a href="/admin/merchant/367/product/292/show" class="btn btn-xs btn-primary" target="_top">详情</a>
                        <span class="btn btn-xs btn-danger cmd-delete">删除</span>
                    </td>
                </tr>
                <tr>
                    <td>
                    <span class="btn btn-success btn-xs cmd-copy-url" title="复制 URL 地址" data-clipboard-text="/product/291">
                        <span class="glyphicon glyphicon-link"></span>
                    </span>
                    </td>
                    <td>
                        <a href="/product/291" title="新窗口打开" target="_blank">
                            CCCI(塞浦路斯全国商工会)
                            <span class="glyphicon glyphicon-new-window"></span>
                        </a>
                    </td>
                    <td>2018-05-28</td>
                    <td data-id="291">
                        <a href="/admin/merchant/367/product/291/show" class="btn btn-xs btn-primary" target="_top">详情</a>
                        <span class="btn btn-xs btn-danger cmd-delete">删除</span>
                    </td>
                </tr>
                <tr>
                    <td>
                    <span class="btn btn-success btn-xs cmd-copy-url" title="复制 URL 地址" data-clipboard-text="/product/290">
                        <span class="glyphicon glyphicon-link"></span>
                    </span>
                    </td>
                    <td>
                        <a href="/product/290" title="新窗口打开" target="_blank">
                            CIPA（塞浦路斯投资促进署）
                            <span class="glyphicon glyphicon-new-window"></span>
                        </a>
                    </td>
                    <td>2018-05-28</td>
                    <td data-id="290">
                        <a href="/admin/merchant/367/product/290/show" class="btn btn-xs btn-primary" target="_top">详情</a>
                        <span class="btn btn-xs btn-danger cmd-delete">删除</span>
                    </td>
                </tr>
                <tr>
                    <td>
                    <span class="btn btn-success btn-xs cmd-copy-url" title="复制 URL 地址" data-clipboard-text="/product/289">
                        <span class="glyphicon glyphicon-link"></span>
                    </span>
                    </td>
                    <td>
                        <a href="/product/289" title="新窗口打开" target="_blank">
                            税务筹划
                            <span class="glyphicon glyphicon-new-window"></span>
                        </a>
                    </td>
                    <td>2018-05-28</td>
                    <td data-id="289">
                        <a href="/admin/merchant/367/product/289/show" class="btn btn-xs btn-primary" target="_top">详情</a>
                        <span class="btn btn-xs btn-danger cmd-delete">删除</span>
                    </td>
                </tr>
                <tr>
                    <td>
                    <span class="btn btn-success btn-xs cmd-copy-url" title="复制 URL 地址" data-clipboard-text="/product/288">
                        <span class="glyphicon glyphicon-link"></span>
                    </span>
                    </td>
                    <td>
                        <a href="/product/288" title="新窗口打开" target="_blank">
                            商业规则&amp;商业成本
                            <span class="glyphicon glyphicon-new-window"></span>
                        </a>
                    </td>
                    <td>2018-05-28</td>
                    <td data-id="288">
                        <a href="/admin/merchant/367/product/288/show" class="btn btn-xs btn-primary" target="_top">详情</a>
                        <span class="btn btn-xs btn-danger cmd-delete">删除</span>
                    </td>
                </tr>
                <tr>
                    <td>
                    <span class="btn btn-success btn-xs cmd-copy-url" title="复制 URL 地址" data-clipboard-text="/product/287">
                        <span class="glyphicon glyphicon-link"></span>
                    </span>
                    </td>
                    <td>
                        <a href="/product/287" title="新窗口打开" target="_blank">
                            商业枢纽
                            <span class="glyphicon glyphicon-new-window"></span>
                        </a>
                    </td>
                    <td>2018-05-28</td>
                    <td data-id="287">
                        <a href="/admin/merchant/367/product/287/show" class="btn btn-xs btn-primary" target="_top">详情</a>
                        <span class="btn btn-xs btn-danger cmd-delete">删除</span>
                    </td>
                </tr>
                <tr>
                    <td>
                    <span class="btn btn-success btn-xs cmd-copy-url" title="复制 URL 地址" data-clipboard-text="/product/286">
                        <span class="glyphicon glyphicon-link"></span>
                    </span>
                    </td>
                    <td>
                        <a href="/product/286" title="新窗口打开" target="_blank">
                            专业服务
                            <span class="glyphicon glyphicon-new-window"></span>
                        </a>
                    </td>
                    <td>2018-05-28</td>
                    <td data-id="286">
                        <a href="/admin/merchant/367/product/286/show" class="btn btn-xs btn-primary" target="_top">详情</a>
                        <span class="btn btn-xs btn-danger cmd-delete">删除</span>
                    </td>
                </tr>
                <tr>
                    <td>
                    <span class="btn btn-success btn-xs cmd-copy-url" title="复制 URL 地址" data-clipboard-text="/product/285">
                        <span class="glyphicon glyphicon-link"></span>
                    </span>
                    </td>
                    <td>
                        <a href="/product/285" title="新窗口打开" target="_blank">
                            法律框架
                            <span class="glyphicon glyphicon-new-window"></span>
                        </a>
                    </td>
                    <td>2018-05-28</td>
                    <td data-id="285">
                        <a href="/admin/merchant/367/product/285/show" class="btn btn-xs btn-primary" target="_top">详情</a>
                        <span class="btn btn-xs btn-danger cmd-delete">删除</span>
                    </td>
                </tr>
                <tr>
                    <td>
                    <span class="btn btn-success btn-xs cmd-copy-url" title="复制 URL 地址" data-clipboard-text="/product/284">
                        <span class="glyphicon glyphicon-link"></span>
                    </span>
                    </td>
                    <td>
                        <a href="/product/284" title="新窗口打开" target="_blank">
                            政府激励
                            <span class="glyphicon glyphicon-new-window"></span>
                        </a>
                    </td>
                    <td>2018-05-28</td>
                    <td data-id="284">
                        <a href="/admin/merchant/367/product/284/show" class="btn btn-xs btn-primary" target="_top">详情</a>
                        <span class="btn btn-xs btn-danger cmd-delete">删除</span>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="row tab-pane" id="tab-images">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th style="width: 40px;"></th>
                    <th>ID</th>
                    <th>库存变更数量</th>
                    <th>现有库存量</th>
                    <th>备注</th>
                    <th>时间</th>
                </tr>
                </thead>
                <tbody>
                @if (!$stock_change_lists)
                    暂无库存变更
                @else
                    @foreach($stock_change_lists as $stock_change_list)
                        <tr>
                            <td></td>
                            <td>
                                {{$stock_change_list->id}}
                            </td>
                            <td>{{$stock_change_list->unit}}</td>
                            <td>{{$stock_change_list->total_stock}}</td>
                            <td>{{$stock_change_list->note}}</td>
                            <td data-id="300">
                                {{$stock_change_list->created_at}}
                            </td>
                        </tr>
                    @endforeach
                @endif

                </tbody>

            </table>
        </div>



    </div>




@endsection


