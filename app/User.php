<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Scout\Searchable;

class User extends Authenticatable
{
    use Notifiable;
    use Searchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'about', 'photo', 'address', 'phone'
    ];



    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function tags()
    {
        return $this->belongsToMany('App\Tag', 'user_has_tag', 'user_id', 'tag_id');
    }

    public function messages()
    {
        return $this->hasMany('App\Message', "messages" , "recipient_id" , "id");
    }

    public function searchableAs()
    {
        return 'users_index';
    }

    public function groups()
    {
        return $this->belongsToMany('App\Message', 'user_has_group', 'user_id', 'group_id');
    }

    public function grouparticles()
    {
        return $this->hasMany("App\GroupArticles");
    }

    public function photos()
    {
        return $this->hasMany("App\Photo");
    }

    public function trainer() 
    {
        return $this->hasOne("App\Trainer");
    }
    public function friends()
    {
        return $this->belongsToMany("App\User","Friendlists","user_id","friend_id")->wherePivot("accepted",1);
    }

    public function notices()
    {
        return $this->hasMany('App\Notice');
    }

}
