<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupArticles extends Model
{
    protected $guarded = [];
    public function user() 
    {
        return $this->belongsTo("App\User");
    }
    public function post ()
    {
        return $this->hasOne("App\Post");
    }
}
