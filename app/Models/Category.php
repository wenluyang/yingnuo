<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function Goods()
    {
        return $this->hasMany('App\Models\Goods')->orderBy('sort','desc');
    }
}
