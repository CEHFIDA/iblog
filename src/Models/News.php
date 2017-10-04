<?php

namespace Selfreliance\iblog\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function  news_data()
    {
        return $this->hasMany('iblog\Models\News_Data');
    }
}
