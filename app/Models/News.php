<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    public function belongsToNewsCat()
    {
        return $this->belongsTo('App\Models\NewsCat','newscat_id','id');
    }
}
