<?php

namespace Selfreliance\iblog\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News_Data extends Model
{
    //
    use SoftDeletes;
    
    public function news(){
        return $this->hasOne('Selfreliance\Iblog\Models\News', 'id', 'news_id');
    }
}
