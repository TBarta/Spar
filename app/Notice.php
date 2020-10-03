<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Notice extends Model
{

    use Searchable;

    protected $fillable = [
        'title', 'text', 'user_id'
    ];

    public function searchableAs()
    {
        return 'notices_index';
    }

    public function user()
    {
        return $this->belongsTo("App\User");
    }
}
