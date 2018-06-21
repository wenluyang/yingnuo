<?php

namespace App\Http\ViewComposers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use EasyWeChat;

class JssdkComposer
{
    public function compose(View $view)
    {
        $json = self::jssdk();
        $current_url =  url()->current();
        $user_id = Auth::user()->id;
        $user = User::where(['id' => $user_id])->first();
        $userid = $user->id;
        $url = $current_url.'?userid='.$userid;
        $view->with(compact('topuser','json', 'url'));
    }

    public static function jssdk()
    {
        $officialAccount = EasyWeChat::officialAccount();
        $json = $officialAccount->jssdk->buildConfig(['onMenuShareTimeline','onMenuShareAppMessage','onMenuShareQQ','onMenuShareWeibo','onMenuShareQZone'], false);
        return $json;
    }
}