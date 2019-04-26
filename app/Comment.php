<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function post()
    {
    	return $this->hasOne(Post::class);
    }

    public function author()
    {
    	return $this->hasOne(User::class);
    }
}
