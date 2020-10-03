<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function users()
    {
        return $this->belongsToMany('App\User', 'user_has_tag', 'tag_id', 'user_id');
    }
}
