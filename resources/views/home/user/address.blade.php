@extends('home.layouts.web')

@section('content')
    <div class="page_title clearfix">
        <span>常用收货地址</span>
    </div>

    @if ($data)

    <ul class="address_list">
        @foreach( $data as $_item )
        <li>
            <p><span><?=$_item['nickname'];?></span><?=$_item['mobile'];?></p>
            <p><?=$_item['address'];?></p>
            <div class="addr_op">
                <em class="del" data="<?=$_item['id'];?>"><i class="del_icon"></i>删除</em>
                <a href="{{route('user.address_set',['id'=>$_item['id']])}}"><i class="edit_icon"></i>编辑</a>
                <?php if( $_item['is_default'] ):?>
                <span class="default_set aon"><i class="check_icon"></i>默认地址</span>
                <?php else:?>
                <span class="set_default" data="<?=$_item['id'];?>">设为默认地址 </span>
                <?php endif;?>
            </div>
        </li>
       @endforeach
    </ul>

    @else
    <div class="no-data">
        连个收货地址都没有，干什么互联网哇
    </div>
    @endif

    <div class="op_box">
        <a href="{{route('user.address_set')}}" class="red_btn" style="color: #ffffff;">添加新地址</a>
    </div>

@stop

@section('js')
    <script src="/js/user/address.js?ver=20170317170401"></script>
@stop