<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];
    public function photo() 
    {
        return $this->belongsTo("App\Photo");
    }
    public function article() 
    {
        return $this->belongsTo("App\GroupArticles");
    }
}
