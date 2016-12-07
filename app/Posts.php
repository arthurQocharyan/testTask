<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    protected $fillable = [
        'user_id', 'title', 'description','categories_id','publish_date','avatar'
    ];
    public function category()
    {
        return $this->belongsTo('App\Category','categories_id','id');
    }
}
