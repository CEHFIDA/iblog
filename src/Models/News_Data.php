<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News_Data extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function news()
    {
        return $this->belongsTo('App\Models\News');
    }
}
