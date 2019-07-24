<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected  $guarded = [];

    public function path()
    {
        return "/article/{$this->slug}";
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);

    }
    public function addComment($comment)
    {
        $this->comments()->create($comment);
    }
}
