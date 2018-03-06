<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    public $fillable = [
        'content',
        'publish_timestamp'
    ];
}
