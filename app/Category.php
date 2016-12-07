<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'user_id', 'title', 'description'
    ];
    public function user()
    {
       return $this->belongsTo('App\User','user_id');
    }
    public function post()
    {
       return $this->hasMany('App\Posts','categories_id','id');
    }

}
