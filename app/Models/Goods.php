<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    protected $guarded=[];

    public function Category()
    {
        return $this->belongsTo('App\Models\Category');
    }

}
