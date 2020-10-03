<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{

    protected $guarded = [];
    // protected $dates = ["created_at"];
    // public function users()
    // {
    //     return $this->belongsToMany('App\User', 'user_has_message', 'message_id', 'user_id');
    // }
    public function user()
    {
        return $this->belongsTo("App\User", "sender_id" );
    }
    public function recipient()
    {
        return $this->belongsTo("App\User", "recipient_id");
    }
}
