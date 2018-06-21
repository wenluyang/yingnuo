<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use EasyWeChat\Kernel\Messages\News;
use EasyWeChat\Kernel\Messages\NewsItem;

class WeChatController extends Controller
{
    /**
     *处理微信请求
     *关注后 自动发送消息
     * @return string
     *
     */
    public function serve()
    {
        Log::info('request arrived.');

        $app = app('wechat.official_account');

        //发送一个欢迎内容
        $app->server->push(function ($message) use ($app) {
            $user = $app->user->get($message['FromUserName']);

            switch ($message['MsgType']) {
                case 'event':
                    switch ($message['Event']) {
                        case 'subscribe'://订阅
                            // 先判断OPEN_ID 是否存在这个用户
                            $userinfo = User::where(['open_id' => $user['openid']])->first();
                            $eventKey = $message['EventKey'];
                            $userId = str_replace('qrscene_', '', $eventKey);
                            //如果不存在就入库
                            if ($userinfo == null) {
                                $model = new User();
                                $model->open_id = $user['openid'];
                                $model->nickname = $user['nickname'];
                                $model->avatar = $user['headimgurl'];
                                $model->city = '3213';
                                $model->province = '321';
                                $model->p1 = isset($p) ? $p->id : 0; //上级ID
                                $model->p2 = isset($p) ? $p->p1 : 0; //爷爷级ID
                                $model->save();
                                //获得用户总数
                                $count = $model->count();
                                $content = "嗨，亲爱的".$user['nickname']."，我是盈诺医疗公司客服，欢迎关注盈诺医疗公司公众号，您是关注的第".$count."位粉丝
在此你可以成为盈诺分销微客";
                            }
                            return $userId;
                        case 'SCAN'://扫码

                            return '恭喜你加入的团队';
                            break;
                    }
                    break;
                default:
                    return "欢迎关注";
                    break;
            }
        });

        ////发送一个图文内容
        //$app->server->push(function ($message) use ($app) {
        //    $user = $app->user->get($message['FromUserName']);
        //    $items = [
        //        new NewsItem([
        //            'title' => '加入盈诺商城推荐人，获几分赢大奖',
        //            'description' => '在此你可以成为盈诺分销微客，通过在微商城推荐商品给他人购买可以获得销售折扣',
        //            'url' => 'http://www.baidu.com',
        //            'image' => $user['headimgurl'],
        //
        //        ]),
        //
        //    ];
        //
        //    $news = new News($items);
        //
        //    $app->customer_service->message($news)->to($user['openid'])->send();
        //});

        return $app->server->serve();
    }


    //微信公众号菜单
    public function menu()
    {
        $app = app('wechat.official_account');
        $buttons = [
            [
                "type" => "view",
                "name" => "产品中心",
                "url"  => url('http://yn.papahei.cn/product')
            ],
            [
                "type" => "view",
                "name" => "商学院",
                "url" => 'http://yn.papahei.cn/article',
            ],
            [
                "type" => "view",
                "name" => "会员中心",
                "url"  => url('http://yn.papahei.cn/user')
            ],
        ];
        $result = $app->menu->create($buttons);
        return $result;
    }

    public function qrcode()
    {
        $app = app('wechat.official_account');
        $result = $app->qrcode->temporary('foo', 6 * 24 * 3600);
        $url = $app->qrcode->url($result['ticket']);
        dd($url);
    }
}