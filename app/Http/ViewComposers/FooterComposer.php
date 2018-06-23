<?php

namespace App\Http\ViewComposers;
use App\Models\MemberCart;
use Illuminate\View\View;

class FooterComposer
{
    public function compose(View $view)
    {
        $count = MemberCart::where(['user_id'=>CurrentUserId()])->get()->count();
        $view->with(compact('count'));
    }

}