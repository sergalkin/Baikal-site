<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected  $guarded = [];

    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
