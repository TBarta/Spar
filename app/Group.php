<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Group extends Model
{

    use Searchable;

    protected $guarded = [];

    public function searchableAs()
    {
        return 'groups_index';
    }

    public function users(){
        return $this->belongsToMany('App\User', 'user_has_group', 'group_id', 'user_id');
    }
    public function photos()
    {
        return $this->hasMany("App\Photo");
    }
}
