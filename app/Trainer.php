<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;


class Trainer extends Model
{

    use Searchable;

    protected $guarded = [];

    public function searchableAs()
    {
        return 'trainers_index';
    }

    public function user ()
    {
        return $this->belongsTo("App\User");
    }
}
