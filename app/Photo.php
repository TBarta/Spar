<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $guarded = [];
    public function group() 
    {
        return $this->belongsTo("App\Group");
    }
    public function user() 
    {
        return $this->belongsTo("App\User");
    }
    public function post ()
    {
        return $this->hasOne("App\Post");
    }
}
