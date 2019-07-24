<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = [];

    public function owner()
    {
        $this->belongsTo(User::class, 'user_id');
    }
}
