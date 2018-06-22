@extends('home.layouts.web')

@section('content')

    <div class="page_title clearfix">
        <span>产品收藏</span>
    </div>
    @if ($data)
        <ul class="fav_list">
            @foreach($data as $_item)
                <li>
                    <a href="{{route('goods.show',['goods'=>$_item['product_id']])}}">
                        <i class="pic"><img src="<?=$_item["product_main_image"];?>" style="height: 100px;width: 100px;" /></i>
                        <h2><?=$_item["product_name"];?></h2>
                        <b><?=$_item["product_price"];?></b>
                    </a>
                    <span class="del_fav" data="<?=$_item["id"];?>"><i class="del_fav_icon"></i></span>
                </li>
            <?php endforeach;?>
        </ul>
        <?php else:?>
        <div class="no-data">
           暂时没有收藏！
        </div>
    @endif


@stop

@section('js')
    <script src="/js/user/fav.js"></script></body>
@stop
