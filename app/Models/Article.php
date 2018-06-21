<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public function belongsToArticleCat()
    {
        return $this->belongsTo('App\Models\ArticleCat','articlecat_id','id');
    }
}
